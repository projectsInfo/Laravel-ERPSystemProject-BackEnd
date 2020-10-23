<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubProduct extends Model 
{

    protected $table = 'Sub_Products';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('product_id', 'color','colorName', 'size', 'selling_price','parcode_pre_all');

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function SupplerOrder()
    {
        return $this->hasMany('\SupplyOrder', 'sub_product_id');
    }

    public function barcodes()
    {
        return $this->hasMany('App\ParcodePreOne', 'sub_product_id');
    }


    public function CountInWarehouse($warehouse_id)
    {
        $q = $this->barcodes->where('active' ,1)->where('warehouse_id' , $warehouse_id);
        return $q->count();
    }


}