<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\User;
use App\DelivaryCompany;
use App\SubProduct;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\WarehouseStoreRequest;
use App\Http\Requests\WarehouseUpdateRequest;

// use getCollection;
class WarehousesController extends Controller
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
        $Warehouses = Warehouse::get()->toArray();
        $Users = User::permission('warehouse')->get(); // Returns only users with the permission 'edit articles' (inherited or directly)
        return view('Warehouse.Warehouse.index', compact('Warehouses','Users'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseStoreRequest $request)
    {
        //

        $Warehouse = new Warehouse; // اضافة مورد جديد
        $columns = ['stockman']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $Warehouse = $this->persist($Warehouse);// اضافه للمورد
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
    public function show(Warehouse $Warehouse , Request $Request)
    {
        // $ivntorys = ParcodePreOne::where('warehouse_id' , $Warehouse->id)->where('active' , 1)->unique('sub_product_id')->paginate(1);
        $ivntorys = SubProduct::whereHas('barcodes', function ($query) use($Warehouse){
            $query->where('warehouse_id' , $Warehouse->id)->where('active' , 1);
        })->paginate(1);
        // dd($ivntorys);
        return view('Warehouse.Warehouse.show', compact('ivntorys','Warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $Warehouse)
    {
        if ($Warehouse != null) {
            $Warehouse = $Warehouse->statistics() ;
            return response()->json(['status' => true,'data' => $Warehouse , 'message' => ' type has been deleted successfully']);
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
    public function update(WarehouseUpdateRequest $request, Warehouse $Warehouse)
    {
        //
        $columns = ['stockman']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $Warehouse = $this->persist($Warehouse);// اضافه للمورد
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
    public function destroy(Warehouse $Warehouse)
    {
        if ($Warehouse != null) {
            $Warehouse->delete();
            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }


    private function persist(Warehouse $Warehouse)// اضافة المورد او التعديل
    {
        // dd(request('stockman'));
        $columns = ['name','address'];

        foreach ($columns as $column) {
            $Warehouse->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $Warehouse->save();
        //  name
        //  address
        //  stockman
        $Users = User::find(request('stockman'));
        if(request()->isMethod('put')){// تعديل
            $Warehouse->Users()->sync($Users);
        }else{ // اضافة
            $Warehouse->Users()->attach($Users);
        }

        return $Warehouse;
    }    

    public function getCustomFilterData(Request $request)
    {

        $Warehouses = Warehouse::select('*');

        return Datatables::of($Warehouses)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
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
                $botton = ' <button type="button" edit-url="'. route('warehouse.edit',$query->name) .'"   class="mr-2 edit-Btn edit btn">
                                <span><i class="fas fa-edit fa-fw"></i></span>
                            </button>

                            <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('warehouse.index').'/'.$query->name .'">
                                <span><i class="fas fa-times fa-fw"></i></span>
                            </button>';
                return $botton;
            })
            ->addColumn('Users', function ($query) {
                $options = '';
                foreach ($query->Users as $User) {
                    $options .= '<span>'. $User->name. '</span> ,';
                }
                return $options;
            }) 
           ->rawColumns(['action','Users'])
            ->make(true);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function ReportOfDeliveryCompany( Request $Request)
    {
        $ivntorys = DelivaryCompany::with('Orders')->paginate(1);
        // dd($ivntorys);
        return view('Warehouse.Warehouse.ReportOfDeliveryCompany', compact('ivntorys'));
    }

}
