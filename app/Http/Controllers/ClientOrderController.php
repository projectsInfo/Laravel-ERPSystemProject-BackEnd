<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Client;
use App\Warehouse;
use App\DelivaryCompany;
// use App\SupplerEmail as SupplerEmail;
use App\Product;
use App\Order;
use App\City;
use App\DelivaryPrice;
use App\SubProduct;
use App\OrderInformation;
use App\ParcodePreOne;
use App\Http\Requests\SupplerOrderStoreRequest;
use App\Http\Requests\SupplerUpdateRequest;
use DataTables;
use Str;
use JavaScript;
use Auth;
use PDF;

class ClientOrderController extends Controller
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
        if (request('warehouse')) {
            if(!Auth::user()->Warehouse->contains(request('warehouse'))){
                return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
            }
        }
        $DelivaryCompany = DelivaryCompany::get();
        return view('CRM.ClinteOrder.index', compact('DelivaryCompany'));
    }

    public function create()
    {
        //
        $City = DelivaryPrice::with('City')->get();
        $Client = Client::with('Mobiles','Address')->get();
        JavaScript::put([
            'Clients' => $Client,
        ]);
        return view('CRM.ClinteOrder.Create', compact('City'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        // dd( $request);
        
        $Order = new Order; // اضافة مورد جديد
        
        $columns = ['subproduct_id']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        // 'client_id', 'totle_of_order', 'shipping_fees', 'discount_id', 'state', 'date_to_delivery', 'note', 'invioce_number'
        $Order->client_id = request('client');
        $Order->type = request('status');
        $Order->state = 1;
        $Order->date_to_delivery = request('date_to_delivery');
        $Order->save();
        $orderID = $Order->id;
        $Order = $this->persist($Order);// اضافه للمورد
        return response()->json([
            'status' => true,
            'link' => route('clientorder.show', $orderID),
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $Order = Order::find($id);
        $Order = $Order->statistics();
        // dd($Order);
        return response()->json(['status' => true, 'Order' => $Order,'message' => ' type has been deleted successfully']);
    }

        
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stokeman( $id)
    {
        $Order = Order::find($id);
        $Order = $Order->statistics();
        // dd($Order);
        return view('CRM.ClinteOrder.stokeman', compact('Order'));
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
            dd($SupplyOrder);
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

    private function persist(Order $Order)// اضافة المورد او التعديل
    {
        for ($i=0; $i < count(request('subproduct_id')); $i++) { 
            $SubProduct = SubProduct::where('id' , request('subproduct_id')[$i])->first();
            $OrderInformation = new OrderInformation; // اضافة مورد جديد
            $OrderInformation->order_id = $Order->id;
            $OrderInformation->product_id = request('subproduct_id')[$i];
            $OrderInformation->quantity = request('quantity')[$i];
            $OrderInformation->price =  $SubProduct->selling_price;
            $OrderInformation->save();
        }
        return $OrderInformation;
    }    




    public function getCustomFilterData(Request $request)
    {

        $Order = Order::select('*');
        return Datatables::of($Order)
            ->filter(function ($query) use ($request) {
                if($request->has('warehouse')){
                    if($request->warehouse !== null){
                        // if ($request->has('option')) {
                        //     if ($request->get('input') != null) {
                        //         if ($request->option == 'OrderID') {
                        //             $query->where('warehouse_id', $request->warehouse )->where('id',$request->get('input'));
                        //         }else if ($request->option == 'SupplierName') {
                        //             $input = $request->input;
                        //             $query->where('warehouse_id', $request->warehouse )->whereHas("Suppler", function($q) use($input){ $q->where("name",'like', "%{$input}%" ); });
                        //         }else if ($request->option == 'OrderDate') {
                        //             $query->where('warehouse_id', $request->warehouse )->where("created_at",'like', "%{$request->get('input')}%");
                        //         }
                        //     }
                        // }
                        $query->where ('warehouse_id', $request->warehouse );
                    }
                }else{
                    $query;
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) use ($request) {
                if($request->warehouse == null){
                    $botton = '
                    <button type="button" show-url="'. route('clientorder.show',$query->id) .'"   class="mr-2 show-Btn edit btn">
                    <span><i class="fas fa-edit fa-eye"></i></span>
                    </button>

                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('supplerorder.index').'/'.$query->id .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>

                    <a href="'. route('clientorder.edit',$query->id) .'"><button type="button" edit-url=""   class="mr-2 edit-Btn edit btn">
                        <span><i class="fas fa-edit fa-fw"></i></span>
                    </button></a>
                    <input type="checkbox" name="vehicle1[]" value="'.$query->id.'">
                    ';

                    if ($query->state > 2) {
                        return  ' <a href="'. route('clientorder.show',$query->id) .'"><button type="button" edit-url=""   class="mr-2 show-Btn edit btn">
                        <span><i class="fas fa-edit fa-eye"></i></span>
                        </button></a>
                        
                        ';
                    }

                //    if ($query->state == 1) {
                //         return  ' <input type="checkbox" name="vehicle1[]" value="'.$query->id.'">';
                //     }
                }else{
                    $botton = '
                    <a href="'. route('clientorder.stokeman',$query->id) .'"><button type="button" edit-url=""   class="mr-2 show-Btn edit btn">
                    <span><i class="fas fa-edit fa-eye"></i></span>
                    </button></a>
                   ';

                   if ($query->state == 4) {
                    return  ' <input type="checkbox" name="vehicle1[]" value="'.$query->id.'">';
                    }
                }
            
                return $botton;
            })
            ->addColumn('client_name', function ($query) {
                return $query->Client->name;
            }) 
            ->addColumn('client_phone', function ($query) {
                $options = '';
                foreach ($query->Client->Mobiles as $Mobiles) {
                    $options .= '<span>'. $Mobiles->mobile. '</span> ,';
                }
                return $options;
            }) 
            ->addColumn('Totalprice', function ($query) {
                return $query->totalPrice()->Price;
            }) 
            ->addColumn('type', function ($query) {
                if ($query->type == 1) {
                    return  '<span>Urgent</span>';
                } else if ($query->type == 2) {
                    return  '<span>Normal</span>';
                } else if ($query->type == 3) {
                    return  '<span>Hold</span>';
                }
            }) 
            ->addColumn('state', function ($query) {
                if ($query->state == 1) {
                    return  '<span>Holding</span>';
                } else if ($query->state == 2) {
                    return  '<span>Approved</span>';
                } else if ($query->state == 3) {
                    return  '<span>PreProcessing</span>';
                } else if ($query->state == 4) {
                    return  '<span>Cashing</span>';
                } else if ($query->state == 5) {
                    return  '<span>Delivaryed</span>';
                }
                
            }) 
           ->rawColumns(['action','Suppler_name','state','Totalprice','client_phone','type'])
            ->make(true);
    }


                  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Approved($id)
    {
        $Order = Order::find($id);
        if($Order != Null){
            if($Order->state > 1 ){
                return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
            }
            $Order->state = 2;
            $Order->warehouse_id = 1;
            $Order->save();
            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
        }else{
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }


              /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Cashing($barcode , $orderId)
    {
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
                      
                        if($Products[0]->active == 0){
                            return response()->json(['status' => false, 'message' => 'لم يتم استلام هذه القطعه من قبل']);
                        }else if ($Products[0]->active == 2){
                            return response()->json(['status' => false, 'message' => 'تم صرف هذه القطعه من قبل']);
                        }else if ($Products[0]->active == 1){
                            $Order = Order::find($orderId);
                            $CountOfOrder = $Order->Order_products->where('product_id', $Products[0]->sub_product_id)->first()->quantity;
                            $CountOfAllCashing = ParcodePreOne::where('order_id',$Order->id)->count();
                            if ($Order->totalQuantity() <= $CountOfAllCashing ) {
                                $Order->state = 4 ;
                                $Order->save();
                                return response()->json(['status' => 'Done', 'message' => 'تم صرف كامل الفاتوره']);
                            }
                            $Order->state = 3 ;
                            $Order->save();
                            $CountOfCashing = ParcodePreOne::where('sub_product_id',$Products[0]->sub_product_id)->where('order_id',$Order->id)->count();
                            if($CountOfOrder <= $CountOfCashing ){
                                return response()->json(['status' => false, 'message' => 'تم صرف كامل المنتج من قبل']);
                            }else{
                                $Products[0]->active = 2;
                                $Products[0]->order_id = $Order->id;
                                $Products[0]->save();
                                $SubProducts =ParcodePreOne::where('active' ,2)->where('sub_product_id' , $Products[0]->sub_product_id)->where('order_id', $Order->id)->where('warehouse_id' , 1);
                                $conutOfCashingByProducts = $SubProducts->count();
                                $parcode_pre_all = $Products[0]->SubProduct->parcode_pre_all;
                                $CountOfAllCashing = ParcodePreOne::where('order_id',$Order->id)->count();
                                if ($Order->totalQuantity() <= $CountOfAllCashing ) {
                                    $Order->state = 4 ;
                                    $Order->save();
                                    return response()->json(['status' => 'Done','CountOfCashing' => $conutOfCashingByProducts , 'parcode_pre_all' =>  $parcode_pre_all, 'message' => 'تم صرف كامل الفاتوره']);
                                }
                                return response()->json(['status' => true,'CountOfCashing' => $conutOfCashingByProducts , 'parcode_pre_all' =>  $parcode_pre_all, 'message' => ' type has been deleted successfully']);
                            }
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


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delivarycompany(Request $request)
    {
        foreach ($request->orders as $order) {
            $Order = Order::find($order);
            $Order->delivary_id = $request->DelivaryCompany;
            $Order->state = 5;
            $Order->save();
        }
        return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);

    }


         /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DelivaryPrice( $id)
    {
        $Order = DelivaryPrice::find($id);
        $Price = $Order->price;
        // $Order->state = 5;
        // $Order->save();
        return response()->json(['status' => true, 'Price' => $Price, 'message' => ' type has been deleted successfully']);

    }
    

                      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function MltieApproved(Request $request)
    {
        foreach ($request->orders as $order) {
            $Order = Order::find($order);
            if($Order != Null){

                if($Order->state > 1 ){
                    return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
                }
                $Order->state = 2;
                $Order->warehouse_id = 1;
                $Order->save();
            }
        }
        return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
      
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPdf(Request $request)
    {
        $Orders = Order::whereIn('id',$request->orders)->get();
        if($Orders->count() > 0){
            $pdf = PDF::loadView('preintOrders',compact('Orders'))->setPaper('A4');
            $pdf->save(public_path('/uploads/orders_filename.pdf'));
        }
        return response()->json([
            'status' => false,
            'message' => 'لا يوجد'
        ]);
    }


}
