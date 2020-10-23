<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Suppler;
use App\Warehouse;
// use App\SupplerEmail as SupplerEmail;
use App\Product;
use App\SupplyOrder;
use App\SupplyOrderData;
use App\ParcodePreOne;
use App\Http\Requests\SupplerOrderStoreRequest;
use App\Http\Requests\SupplerUpdateRequest;
use DataTables;
use Str;
use JavaScript;
use PDF;
use Auth;

class SupplerOrderController extends Controller
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
        // dd(Auth::user()->Warehouse->contains(request('warehouse')));
        if (request('warehouse')) {
            if(!Auth::user()->Warehouse->contains(request('warehouse'))){
                return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            }
        }
        $Supplers = Suppler::get();
        $Warehouses = Warehouse::get();
        return view('SupplerOrder.index', compact('Supplers','Warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplerOrderStoreRequest $request)
    {
        

 

        $SupplyOrder = new SupplyOrder; // اضافة مورد جديد
        $columns = ['subproduct_id']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $SupplyOrder->suppler_id = request('suppliers');
        $SupplyOrder->warehouse_id = request('warehouses');
        $SupplyOrder->save();
        $SupplyOrder = $this->persist($SupplyOrder);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProducts($barcode)
    {
        $Product = Product::where('parcode_pre_all' , 'like', "%{$barcode}%" )->with('SubProducts','Style')->get();
        if($Product->count() > 0){
            return response()->json([
                'status' => true,
                'Product' => $Product,
                'message' => trans('admin.response_message_add')
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'لا يوجد'
        ]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBarcodes($dataorder , $product)
    {
        $Products = ParcodePreOne::where('supply_order_id' ,$dataorder )->where('sub_product_id' ,$product )->get();
        if($Products->count() > 0){
            $customPaper = array(0,0,250,500);
            $pdf = PDF::loadView('preint',compact('Products'))->setPaper($customPaper, 'landscape');
            $pdf->save(storage_path().'_filename.pdf');
            return $pdf->stream('preint', [
                "Attachment" => true
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'لا يوجد'
        ]);
    }

    
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pdf($dataorder , $product)
    {
        $Products = ParcodePreOne::where('supply_order_id' ,$dataorder )->where('sub_product_id' ,$product )->get();
        return view('preint', compact('Products'));

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $SupplyOrder = SupplyOrder::find($id);
        $totalPrice = $SupplyOrder->totalPrice()->Price;
        $SupplyOrder = $SupplyOrder->statistics();
        // if (request('warehouse')) {
            if(!Auth::user()->Warehouse->contains($SupplyOrder->Warehouse_id)){
                return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            }
        // }
        // dd( $SupplyOrder->SupplyOrderData);
        return view('SupplerOrder.show', compact('SupplyOrder','totalPrice'));
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $SupplyOrder = SupplyOrder::find($id);
        if ($SupplyOrder != null) {
            $SupplyOrder = $SupplyOrder->statistics();
            // dd($SupplyOrder);
            $Supplers = Suppler::get();
            $Warehouses = Warehouse::get();
            $prevIds = SupplyOrderData::where('SupplyOrder_id',$id)->pluck('id')->all();
            JavaScript::put([
                'prevIds' => $prevIds,
            ]);
            return view('SupplerOrder.edit', compact('SupplyOrder','Supplers','Warehouses'));
         } else {
             return response()->json(['status' => false, 'message' => ' No SupplyOrder']);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplerUpdateRequest $request, Suppler $Suppler)
    {
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
    public function destroy($id)
    {
        $SupplyOrder= SupplyOrder::find($id);
        if ($SupplyOrder != null) {
            foreach ($SupplyOrder->SupplyOrderData as $SupplyOrderData) {
                $SupplyOrderData->ProductBarcode()->delete();
            }
            $SupplyOrder->SupplyOrderData()->delete();
            $SupplyOrder->delete();
             return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
         }
    }

    private function persist(SupplyOrder $SupplyOrder)// اضافة المورد او التعديل
    {
        for ($i=0; $i < count(request('subproduct_id')); $i++) { 
            # code...
            $SupplyOrderData = new SupplyOrderData; // اضافة مورد جديد
            $SupplyOrderData->SupplyOrder_id = $SupplyOrder->id;
            $SupplyOrderData->sub_product_id = request('subproduct_id')[$i];
            $SupplyOrderData->Quantity = request('quantity')[$i];
            $SupplyOrderData->Purchasing_price = request('price')[$i];
            $SupplyOrderData->save();
            $this->add_SupplyOrder($SupplyOrderData); // اضافة ارقام و بريد وعنوان المورد
        }
        return $SupplyOrder;
    }    

    private function add_SupplyOrder( $SupplyOrderData) {
        // اضافة وتعديل ارقاام وعناوين و اميلات المورد
            for ($x = 0; $x < $SupplyOrderData->Quantity; $x++) {//اضافة او تعديل الكلاسات 
                $ParcodePreOne = new ParcodePreOne;  // اضافة كلاس جديد
                $ParcodePreOne->barcode = $SupplyOrderData->SubProducts->parcode_pre_all.Str::random(3); // اضافة الرقم او العنوان او البريد
                $ParcodePreOne->supply_order_id = $SupplyOrderData->id; // اضافة الرقم او العنوان او البريد
                $ParcodePreOne->sub_product_id = $SupplyOrderData->SubProducts->id; // اضافة الرقم او العنوان او البريد
                $ParcodePreOne->warehouse_id = request('warehouses'); // اضافة الرقم او العنوان او البريد
                $ParcodePreOne->save();//save
            }
    }


    public function getCustomFilterData(Request $request)
    {

        $SupplyOrder = SupplyOrder::select('*');
        return Datatables::of($SupplyOrder)
            ->filter(function ($query) use ($request) {
                if($request->has('warehouse')){
                    if($request->warehouse !== null){
                        if ($request->has('option')) {
                            if ($request->get('input') != null) {
                                if ($request->option == 'OrderID') {
                                    $query->where('warehouse_id', $request->warehouse )->where('id',$request->get('input'));
                                }else if ($request->option == 'SupplierName') {
                                    $input = $request->input;
                                    $query->where('warehouse_id', $request->warehouse )->whereHas("Suppler", function($q) use($input){ $q->where("name",'like', "%{$input}%" ); });
                                }else if ($request->option == 'OrderDate') {
                                    $query->where('warehouse_id', $request->warehouse )->where("created_at",'like', "%{$request->get('input')}%");
                                }
                            }
                        }
                        $query->where ('warehouse_id', $request->warehouse );
                    }
                }else{
                    $query;
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) use ($request) {
                if($request->has('warehouse')){
                    if($request->warehouse == null){
                        $botton = '
                        <a href="'. route('supplerorder.edit',$query->id) .'"><button type="button" edit-url=""   class="mr-2 edit-Btn edit btn">
                            <span><i class="fas fa-edit fa-fw"></i></span>
                        </button></a>
                    
                        <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('supplerorder.index').'/'.$query->id .'">
                            <span><i class="fas fa-times fa-fw"></i></span>
                        </button>';
                    }else{
                        $botton = '
                        <a href="'. route('supplerorder.show',$query->id) .'"><button type="button" edit-url=""   class="mr-2 edit-Btn edit btn">
                            <span><i class="fas fa-edit fa-eye"></i></span>
                        </button></a>';
                    }
                 
                
                }

                return $botton;
            })
            ->addColumn('Suppler_name', function ($query) {
                return $query->Suppler->name;
            }) 
            ->addColumn('Warehouse_name', function ($query) {
                return $query->Warehouse->name;
            }) 
            ->addColumn('Totalprice', function ($query) {
                return $query->totalPrice()->Price;
            }) 
            ->addColumn('Quantity', function ($query) {
                return $query->statistics()->Quantity;
            }) 
           ->rawColumns(['action','Suppler_name','Warehouse_name','Totalprice','Quantity'])
            ->make(true);
    }



          /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Receipt($barcode)
    {
        // dd($barcode);
        $Products = ParcodePreOne::where('barcode','like', "%$barcode%")->get();
        // dd($Products);
        if($Products->count() > 0){
            if ($Products->count() > 1) {
                return response()->json(['status' => false, 'message' => 'غير صحيح']);
            }else{
                if(strlen($barcode) >= 9){
                    if(!Auth::user()->Warehouse->contains($Products[0]->warehouse_id)){
                        return response()->json(['status' => false, 'message' => 'انت فاكر نفسك شبح يعني كده']);
                    }else{
                        if($Products[0]->active == 1){
                            return response()->json(['status' => false, 'message' => 'تم تسجيله من قبل']);
                        }else{
                            $Products[0]->active = 1;
                            $Products[0]->save();
                            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
                        }
                    }
                }else{
                    return response()->json(['status' => false, 'message' => 'غير صحيح']);
                }
            }
        }else{
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }
}
