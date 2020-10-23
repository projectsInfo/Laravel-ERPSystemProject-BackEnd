<?php

namespace App\Http\Controllers;

use App\Governorate;
use DataTables;
use App\Mobiles;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Requests\GovernorateStoreRequest;
use App\Http\Requests\GovernorateUpdateRequest;
use JavaScript;
class GovernoratesController extends Controller
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
        $trans = [
            'create_user' => trans('mangeUser.create_user'),
        ];
        JavaScript::put([
            'manage' => $trans,
        ]);
        $Governorate = Governorate::orderBy('id')->paginate(10);
        return view('OutSourcing.Governorate.index', compact('Governorate'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('OutSourcing.Governorate.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GovernorateStoreRequest $request)
    {
        //

        $Governorate = new Governorate; // اضافة مورد جديد
        // $columns = ['mobile','address']; // input name and table name
        // if(fliter_arrays($columns) != false){
        //     return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        // }
        $Governorate = $this->persist($Governorate);// اضافه للمورد
        // $Governorate = Client::with('Mobiles','Address')->get();
        return response()->json([
            'status' => true,
            // 'Client' => $Client,
            'message' => trans('admin.response_message_add')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $Governorate)
    {
        if ($Governorate != null) {
            return response()->json(['status' => true,'data' => $Governorate , 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'Message' => ' No user']);
        }
  
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(GovernorateUpdateRequest $request, Governorate $Governorate)
    {
        //
        
        // $delete_ids_address = explode(',', $request->delete_ids['address']);
        // Address::destroy($delete_ids_address);
        
        // $delete_ids_mobile = explode(',', $request->delete_ids['mobile']);
        // Mobiles::destroy($delete_ids_mobile);
        // // dd($delete_ids_address);


        // // $Client = new Client; // اضافة مورد جديد
        // $columns = ['mobile','address']; // input name and table name
        // if(fliter_arrays($columns) != false){
        //     return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        // }
        $Governorate = $this->persist($Governorate);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add'),
            'link' => route('client.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $Governorate)
    {
        if ($Governorate != null) {
            $Governorate->delete();
            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }


    private function persist( $Governorate)// اضافة المورد او التعديل
    {
        $columns = ['name'];
        foreach ($columns as $column) {
            $Governorate->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $Governorate->save();

        return $Governorate;
    }    


    public function getCustomFilterData(Request $request)
    {

        $Governorate = Governorate::select('*');
        return Datatables::of($Governorate)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = '
                <button type="button" edit-url="'. route('governorate.edit',$query->name) .'"   class="mr-2 edit-Btn edit btn">
                    <span><i class="fas fa-edit fa-fw"></i></span>
                </button>
     
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('governorate.index').'/'.$query->name .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>';
                return $botton;
            })
           
            
           ->rawColumns(['action','mobile','id','address','social_accounts'])
            ->make(true);
    }
}
