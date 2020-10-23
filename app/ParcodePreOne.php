<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParcodePreOne extends Model 
{
    use SoftDeletes;

    protected $table = 'parcodes_pre_one';
    public $timestamps = true;
    protected $fillable = array('barcode', 'supply_order_id','active', 'sub_product_id','warehouse_id','order_id');

    public function SupplyOrder()
    {
        return $this->belongsTo('\SupplyOrder', 'supply_order_id');
    }

    public function SubProduct()
    {
        return $this->belongsTo('App\SubProduct', 'sub_product_id');
    }

    public function Warehouse()
    {
        return $this->belongsTo('App\Warehouse', 'warehouse_id');
    }

}