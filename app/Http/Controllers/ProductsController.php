<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Product;
use App\Style;
use App\ParcodePreOne;

use DataTables;
use App\Http\Requests\ProductStoreRequest;
use Image;
use App\Image as ImagePrduct;

class ProductsController extends Controller
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
        $Products = Product::orderBy('id')->paginate(10);
        
        return view('Warehouse.Products.index', compact('Products'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        // dd($request);

        $Product = new Product; // اضافة منتج جديد
        $Product = $this->persist($Product);// اضافه للمنتج
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
    public function show(Product $Product)
    {

        dd($Product,$Product->Style,$Product->SubProducts);
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
    public function edit(Product $Product)
    {
        if ($Product != null) {
            $Product = $Product->statistics() ;
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
    public function update(ProductSUpdateRequest $request, Product $Product)
    {

        $Product = $this->persist($Product);// اضافه للمنتج
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
    public function destroy(Product $Product)
    {
        if ($Product != null) {
            $ParcodePreOne = ParcodePreOne::where('barcode' , 'like', "%{$Product->parcode_pre_all}%" )->get();
            if(count($ParcodePreOne) > 0 ){
                return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
            }
            $Product->delete();
             return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
         }
    }

    private function persist($Product)// اضافة المورد او التعديل
    {

        $Style = Style::where('name',request('style'))->get();
        if(count($Style) > 0){
            $Style = $Style[0];
        }else{
            $Style = new Style;
            $Style->name = request('style');
            $Style->save();
        }
        $columns = ['name','material'];
        

        foreach ($columns as $column) {
            $Product->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $Product->style_id = $Style->id;

        $parcode_name = str_split(request('name'))[0];
        $parcode_material = str_split(request('material'))[0];
        $parcode_style = str_split($Style->name)[0];

        $Product->parcode_pre_all = $parcode_name.$parcode_style;
        $Product->save();
        if (request()->file('images')) {
            $Size = range(0,count(request('images'))-1);
            $images = array_combine($Size, request('images'));
            for ($i=0; $i < count($images) ; $i++) { 
                $avatar = $images[$i];
                $profileImgIn =$parcode_name.time().'_'. $avatar->getClientOriginalName();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/products/' . $profileImgIn));
                $Images = new ImagePrduct;
                $Images->img_url = $profileImgIn;
                $Images->product_id =  $Product->id;
                $Images->save();
            }
        }
        $Size = range(request('sizeFrom'),request('sizeTo'));
        $this->add_product($Product,$Size); // اضافة ال
        return $Product;
    }
    
    private function add_product( $Product,$Size) { // اضافة وتعديل ارقاام وعناوين و اميلات المورد
        $newOpject = ['App\SubProduct']; // كلاسات
        for ($x = 0; $x < count(request('colorHex')); $x++) {//اضافة او تعديل الكلاسات 
            for ($i = 0; $i < count($Size); $i++) {
                $SubProduct = new $newOpject[0];  // اضافة كلاس جديد
                $SubProduct->color = request('colorHex')[$x];
                $SubProduct->colorName = request('colorName')[$x];
                $SubProduct->product_id =  $Product->id;
                $SubProduct->selling_price = request('sellingPrice');
                $SubProduct->size = $Size[$i];
                $parcode_color_1 = str_split(request('colorHex')[$x])[1];
                $parcode_color_2 = str_split(request('colorHex')[$x])[3];
                $parcode_color_3 = str_split(request('colorHex')[$x])[6];
                $parcode_color_4 = str_split(request('colorHex')[$x])[4];
                $parcode_Size = $Size[$i];
                $SubProduct->parcode_pre_all = $Product->parcode_pre_all.$parcode_color_1.$parcode_color_3.$parcode_Size;
                $SubProduct->save();//save
            }
        }
    }


    public function getCustomFilterData(Request $request)
    {
        $Products = Product::select('*');
        return Datatables::of($Products)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'Barcode') {
                        $query->where('parcode_pre_all', 'like', "%{$request->get('input')}%");
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = '<button type="button" edit-url="'. route('product.edit',$query->name) .'"   class="mr-2 edit-Btn edit btn">
                                <span><i class="fas fa-edit fa-fw"></i></span>
                            </button>

                            <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('product.index').'/'.$query->name .'">
                                <span><i class="fas fa-times fa-fw"></i></span>
                            </button>';
                return $botton;
            })
            ->addColumn('style', function ($query) {
                return $query->Style->name;
            }) 
           ->rawColumns(['action','style'])
            ->make(true);
    }
}
