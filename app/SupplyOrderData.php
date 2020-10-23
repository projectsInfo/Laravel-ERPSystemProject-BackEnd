<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplyOrderData extends Model 
{

    protected $table = 'supply_orders_data';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('SupplyOrder_id' , 'sub_product_id', 'Quantity', 'Purchasing_price');

    public function Suppler()
    {
        return $this->belongsTo('App\Suppler', 'suppler_id');
    }

    public function SupplyOrder()
    {
        return $this->belongsTo('App\SupplyOrderData', 'SupplyOrder_id');
    }

    public function SubProducts()
    {
        return $this->belongsTo('App\SubProduct', 'sub_product_id');
    }

    public function ProductBarcode()
    {
        return $this->hasMany('App\ParcodePreOne', 'supply_order_id');
    }

}