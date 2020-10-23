<?php

namespace App\Http\Controllers;

use App\DelivaryCompany;
use App\City;
use App\Order;
use App\DelivaryCompanieDetails;
use DataTables;

use Illuminate\Http\Request;
use App\Http\Requests\DelivaryCompanyStoreRequest;
use App\Http\Requests\DelivaryCompanyUpdateRequest;
class DelivaryCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('Department')) {
        //     return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        // }
        $DelivaryCompanys = DelivaryCompany::orderBy('id')->paginate(10);
        $City = City::get();
        // Returns only users with the permission 'edit articles' (inherited or directly)
        return view('OutSourcing.DelivaryCompany.index', compact('DelivaryCompanys','City'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DelivaryCompanyStoreRequest $request)
    {
        //
        // price
        $DelivaryCompany = new DelivaryCompany; // اضافة مورد جديد
        $columns = ['city']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $DelivaryCompany = $this->persist($DelivaryCompany);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(DelivaryCompany $DelivaryCompany)
    {
        dd($DelivaryCompany->statisProduct());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit($Name)
    {
        $DelivaryCompany = DelivaryCompany::where('Name' , $Name)->first();
        if ($DelivaryCompany != null) {
            $DelivaryCompany = $DelivaryCompany->statistics() ;
            return response()->json(['status' => true,'data' => $DelivaryCompany , 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'message' => ' No Suppler']);
         }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Name)
    {
        //
        $DelivaryCompany = DelivaryCompany::where('Name' , $Name)->first();
        $columns = ['city']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $delete_ids = explode(',', $request->delete_ids);
        DelivaryCompanieDetails::destroy($delete_ids);
        $DelivaryCompany = $this->persist($DelivaryCompany);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy( $Name)
    {
        $DelivaryCompany = DelivaryCompany::where('Name' , $Name)->first();

        if ($DelivaryCompany != null) {
            $Order = Order::where('delivary_id' , $DelivaryCompany->id )->get();
            if(count($Order) > 0 ){
                return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
            }
            $DelivaryCompany->delete();
            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }


    private function persist(DelivaryCompany $DelivaryCompany)// اضافة المورد او التعديل
    {
        // dd(request('stockman'));
        $columns = ['name','address','email','phone'];

        foreach ($columns as $column) {
            $DelivaryCompany->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $DelivaryCompany->save();
        $this->addDelivaryCompany($DelivaryCompany); // اضافة ارقام و بريد وعنوان المورد


        return $DelivaryCompany;
    }    


    private function addDelivaryCompany( $DelivaryCompany) {
        // dd(request('city')); // اضافة وتعديل ارقاام وعناوين و اميلات المورد
        for ($x = 0; $x < count(request('city')); $x++) {//اضافة او تعديل الكلاسات 
            if(request()->isMethod('put')){// تعديل
                $DelivaryCompanieDetails = DelivaryCompanieDetails::firstOrNew(['id'=>request('DelivaryCompanieDetailsId')[$x]]); // بحث ان كان الاي دي موجود
            }else{ // اضافة
                $DelivaryCompanieDetails = new DelivaryCompanieDetails;  // اضافة كلاس جديد
            }
            // $DelivaryCompanieDetails = new DelivaryCompanieDetails;  // اضافة كلاس جديد
            $DelivaryCompanieDetails->city_id = request('city')[$x]; // اضافة الرقم او العنوان او البريد
            $DelivaryCompanieDetails->price = request('price')[$x]; // اضافة الرقم او العنوان او البريد
            $DelivaryCompanieDetails->delivary_company_id =  $DelivaryCompany->id; // اضافة الرقم او العنوان او البريد
            $DelivaryCompanieDetails->save();//save
        }
    }


    public function getCustomFilterData(Request $request)
    {

        $DelivaryCompany = DelivaryCompany::select('*');

        return Datatables::of($DelivaryCompany)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('Name', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'STOCKMAN') {
                        $input = $request->input;
                        $query->whereHas("Users", function($q) use($input){ $q->where("name",'like', "%{$input}%" ); });
                    }else if ($request->option == 'Address') {
                        $query->where('address', 'like', "%{$request->get('input')}%");
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = ' <button type="button" edit-url="'. route('delivarycompany.edit',$query->Name) .'"   class="mr-2 edit-Btn edit btn">
                                <span><i class="fas fa-edit fa-fw"></i></span>
                            </button>

                            <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('delivarycompany.index').'/'.$query->Name .'">
                                <span><i class="fas fa-times fa-fw"></i></span>
                            </button>';
                return $botton;
            })
           ->rawColumns(['action','Users'])
            ->make(true);
    }

}
