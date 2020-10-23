<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Suppler;
use App\SupplerMobile;
use App\SupplerEmail as SupplerEmail;
use App\SupplerAddress;
use App\Http\Requests\SupplerStoreRequest;
use App\Http\Requests\SupplerUpdateRequest;
use DataTables;


class SupplersController extends Controller
{


   /**
     * Display a listing of the resource.
     * index of Department
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('Department')) {
        //     return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        // }
        $Supplers = Suppler::with('Mobiles','Emails','Address')->orderBy('id')->paginate(10);
        return view('OutSourcing.Suppler.index', compact('Supplers'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplerStoreRequest $request)
    {
        $Suppler = new Suppler; // اضافة مورد جديد
        $columns = ['mobile','email','address']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $Suppler = $this->persist($Suppler);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Suppler $Suppler)
    {

        dd($Suppler);
        // $Suppler->deactivate();
        $subscriber->statistics = $subscriber->statistics();
        return view('subscribers.show', compact('subscriber'));
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppler $Suppler)
    {
        if ($Suppler != null) {
            $Suppler = $Suppler->statistics() ;
             return response()->json(['status' => true,'Suppler' => $Suppler , 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'message' => ' No Suppler']);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Suppler $Suppler , SupplerUpdateRequest $request)
    {
            $delete_ids_email = explode(',', $request->delete_ids['email']);
            SupplerEmail::destroy($delete_ids_email);

            $delete_ids_address = explode(',', $request->delete_ids['address']);
            SupplerAddress::destroy($delete_ids_address);

            $delete_ids_mobile = explode(',', $request->delete_ids['mobile']);
            SupplerMobile::destroy($delete_ids_mobile);

        $columns = ['mobile','email','address']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $Suppler = $this->persist($Suppler);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add')
        ]);
    }
      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppler $Suppler)
    {
        if ($Suppler != null) {
            $Suppler->delete();
             return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
         }
    }

    private function persist(Suppler $Suppler)// اضافة المورد او التعديل
    {
        $columns = ['name'];

        foreach ($columns as $column) {
            $Suppler->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $Suppler->save();
        $this->add_suppler($Suppler); // اضافة ارقام و بريد وعنوان المورد

        return $Suppler;
    }    

    private function add_suppler( $Suppler) { // اضافة وتعديل ارقاام وعناوين و اميلات المورد
        $columns = ['mobile','email','address']; // اسامي الانبوت واسامي الجداول
 
        $newOpject = ['App\SupplerMobile','App\SupplerEmail','App\SupplerAddress']; // كلاسات
        $i = 0; // number of array
        foreach ($columns as $column) { // الانبوت
            for ($x = 0; $x < count(request($column)); $x++) {//اضافة او تعديل الكلاسات 
                if(request()->isMethod('put')){// تعديل
                    $$column = $newOpject[$i]::firstOrNew(['id'=>request($column.'Id')[$x]]); // بحث ان كان الاي دي موجود
                }else{ // اضافة
                    $$column = new $newOpject[$i];  // اضافة كلاس جديد
                }
                $$column->$column = request($column)[$x]; // اضافة الرقم او العنوان او البريد
                $$column->suppler_id = $Suppler->id; // id of suppler
                $$column->save();//save
            }
            $i++ ; 
        }
    }


    public function getCustomFilterData(Request $request)
    {
        $Supplers = Suppler::select('*');
        return Datatables::of($Supplers)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'Phone') {
                        $input = $request->input;
                        $query->whereHas("Mobiles", function($q) use($input){ $q->where("mobile",'like', "%{$input}%" ); });
                    }else if ($request->option == 'Email') {
                        $input = $request->input;
                        $query->whereHas("Emails", function($q) use($input){ $q->where("email",'like', "%{$input}%" ); });
                    }else if ($request->option == 'Address') {
                        $input = $request->input;
                        $query->whereHas("Address", function($q) use($input){ $q->where("address",'like', "%{$input}%" ); });
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = '<button type="button" edit-url="'. route('suppler.edit',$query->name) .'"   class="mr-2 edit-Btn edit btn">
                        <span><i class="fas fa-edit fa-fw"></i></span>
                    </button>
    
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('suppler.index').'/'.$query->name .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>';
                return $botton;
            })
            ->addColumn('mobile', function ($query) {
                $options = '';
                foreach ($query->Mobiles as $Mobiles) {
                    $options .= '<span>'. $Mobiles->mobile. '</span> ,';
                }
                return $options;
            }) 
            ->addColumn('email', function ($query) {
                $options = '';
                foreach ($query->Emails as $Emails) {
                    $options .= '<span>'. $Emails->email. '</span> ,';
                }
                return $options;
            }) 
            ->addColumn('address', function ($query) {
                $options = '';
                foreach ($query->Address as $Address) {
                    $options .= '<span>'. $Address->address. '</span> ,';
                }
                return $options;
            }) 
            ->addColumn('products', function ($query) {
                $botton = '<span><i class="fas fa-box-open"></i></span>';
                return $botton;
            })
           ->rawColumns(['action','mobile','id','email','address','products'])
            ->make(true);
    }
}
