<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;
use Carbon\Carbon;
class Order extends Model 
{
    use SoftDeletes;

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id','delivary_id', 'totle_of_order', 'shipping_fees', 'discount_id','warehouse_id', 'state', 'date_to_delivery', 'note', 'type');

    public function Client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function Warehouse()
    {
        return $this->belongsTo('App\Warehouse', 'warehouse_id');
    }

    public function Order_products()
    {
        return $this->hasMany('App\OrderInformation', 'order_id');
    }

    public function totalPrice()
    {
        $Totalprice = new stdClass;
        $Totalprice->Price = 0;
        $TotalPrices = $this->Order_products;
        foreach ($TotalPrices as $TotalPrice) {
            $Totalprice->Price += $TotalPrice->price * $TotalPrice->quantity;
        }
        return $Totalprice;
    }

    public function totalQuantity()
    {
 
        $totalQuantity = $this->Order_products->sum('quantity');

        return $totalQuantity;
    }

    public function statistics()
    {
        $statistics = new stdClass;
        $statistics->id = $this->id;
        $statistics->Order_products = $this->Order_products;
        $statistics->state = $this->state;
        $statistics->date_to_delivery = $this->date_to_delivery;
        $statistics->type = $this->type;
        $statistics->created_at = $this->created_at;
        $statistics->TotalPrice = 0;
        $TotalPrices = $this->Order_products;
        $statistics->Quantity = $this->Order_products->sum('quantity');
        foreach ($TotalPrices as $TotalPrice) {
            $statistics->TotalPrice += $TotalPrice->price * $TotalPrice->quantity;
        }

        foreach ($statistics->Order_products as $Order_products) {
            # code...
            $Order_products["CountInWarehouse"] = $Order_products->SubProducts->barcodes->where('active' ,1)->where('warehouse_id' , 1)->count();
            $Order_products["Name"]  = $Order_products->SubProducts->product->name;
            $Order_products["Material"]  = $Order_products->SubProducts->product->material;
            $Order_products["Style"]  = $Order_products->SubProducts->product->Style->name;
            
        }


     
        // public function CountInWarehouse($warehouse_id)
        // {
        //     $q = $this->barcodes->where('active' ,1)->where('warehouse_id' , $warehouse_id);
        //     return $q->count();
        // }

        $statistics->client_id = $this->Client->id;
        $statistics->client = $this->Client;
        return $statistics;
    }


    public function CashingVlidtion()
    {

        $statistics->id = $this->id;
        $statistics->Order_products = $this->Order_products;
        $statistics->state = $this->state;
        $statistics->date_to_delivery = $this->date_to_delivery;
        $statistics->type = $this->type;
        $statistics->created_at = $this->created_at;
        $statistics->TotalPrice = 0;
        $TotalPrices = $this->Order_products;
        $statistics->Quantity = $this->Order_products->sum('quantity');
        foreach ($TotalPrices as $TotalPrice) {
            $statistics->TotalPrice += $TotalPrice->price * $TotalPrice->quantity;
        }
        $statistics->client_id = $this->Client->id;
        $statistics->client = $this->Client;
        return $statistics;
    }

    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
    // }

}