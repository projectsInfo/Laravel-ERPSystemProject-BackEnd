<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;
class Warehouse extends Model 
{

    protected $table = 'warehouses';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'address');
    public function Users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function statistics()
    {
        $statistics = new stdClass;
        $statistics->id = $this->id;
        $statistics->name = $this->name;
        $statistics->Address = $this->address;
        $statistics->Users = $this->Users;
        // dd($statistics->Product);
        return $statistics;
    }

    public function statisProduct()
    {
        $Product = new stdClass;
        $Product->Item = $this->ProductBarcode->where('active' , 1)->unique('sub_product_id');
        $collection = collect();
        $i = 0 ;
        foreach ($Product->Item as $Item) {
            $q = $this->ProductBarcode->where('active' , 1)->where('sub_product_id' , $Item->sub_product_id);
            $SubProduct = $Item->SubProduct;
            $productName  =  $SubProduct->product->name ;
            $productSize  =  $SubProduct->size ;
            $productColor =  $SubProduct->colorName ;
            $productMaterial =  $SubProduct->product->material ;
            $productStyle =  $SubProduct->product->Style->name ;
            $productCount = $q->count();
            $items = $collection->pull('items');
            $items= [
                'productName' => $productName,
                'productMaterial' => $productMaterial,
                'productStyle' => $productStyle,
                'productSize' => $productSize,
                'productColor' => $productColor,
                'productCount' => $productCount,
            ];
            $collection->put($i,$items);
            $i++;
        }
        return $collection;
    }

    public function statisNotRscsteProduct()
    {
        $Product = new stdClass;
        $Product->Item = $this->ProductBarcode->where('active' , 0)->unique('sub_product_id');
        $collection = collect();
        $i = 0 ;
        foreach ($Product->Item as $Item) {
            $q = $this->ProductBarcode->where('active' , 0)->where('sub_product_id' , $Item->sub_product_id);
            $SubProduct = $Item->SubProduct;
            $productName  =  $SubProduct->product->name ;
            $productSize  =  $SubProduct->size ;
            $productColor =  $SubProduct->color ;
            $productCount = $q->count();
            $items = $collection->pull('items');
            $items= [
                'productName' => $productName,
                'productSize' => $productSize,
                'productColor' => $productColor,
                'productCount' => $productCount,
            ];
            $collection->put($i,$items);
            $i++;
        }
        return $collection;
    }


    public function GetUniqueSubProduct()
    {
        return $this->ProductBarcode->where('active' , 1)->unique('sub_product_id');
    }
    public function ProductBarcode()
    {
        return $this->hasMany('App\ParcodePreOne', 'warehouse_id');
    }
}