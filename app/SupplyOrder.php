<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;
class SupplyOrder extends Model 
{

    protected $table = 'supply_orders';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('suppler_id','warehouse_id');

    public function Suppler()
    {
        return $this->belongsTo('App\Suppler', 'suppler_id');
    }

    public function Warehouse()
    {
        return $this->belongsTo('App\Warehouse', 'warehouse_id');
    }


    

    public function SupplyOrderData()
    {
        return $this->hasMany('App\SupplyOrderData', 'SupplyOrder_id');
    }

    public function statistics()
    {
        $statistics = new stdClass;
        $statistics->id = $this->id;
        $statistics->SupplyOrderData = $this->SupplyOrderData;

        // totalPrice += parseInt($(this).val() * $(this).siblings('input.qny').val());
        $statistics->TotalPrice = 0;
        $TotalPrices = $this->SupplyOrderData;
        $statistics->Quantity = $this->SupplyOrderData->sum('Quantity');
        foreach ($TotalPrices as $TotalPrice) {
            $statistics->TotalPrice += $TotalPrice->Purchasing_price * $TotalPrice->Quantity;
        }
        $statistics->Suppler_id = $this->Suppler->id;
        $statistics->Warehouse_id = $this->Warehouse->id;
        $statistics->Suppler = $this->Suppler->name;
        $statistics->Warehouse = $this->Warehouse->name;
        $statistics->Warehouse = $this->Warehouse->name;
        return $statistics;
    }


    public function totalPrice()
    {
        $Totalprice = new stdClass;
        $Totalprice->Price = 0;
        $TotalPrices = $this->SupplyOrderData;
        foreach ($TotalPrices as $TotalPrice) {
            $Totalprice->Price += $TotalPrice->Purchasing_price * $TotalPrice->Quantity;
        }
        return $Totalprice;
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

}