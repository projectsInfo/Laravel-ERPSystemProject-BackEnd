<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ParcodePreOne;

class OrderInformation extends Model 
{

    protected $table = 'order_informations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('product_id','price', 'quantity', 'order_id');

    public function Order()
    {
        return $this->belongsTo('\Order', 'order_id');
    }

    public function SubProducts()
    {
        return $this->belongsTo('App\SubProduct', 'product_id');
    }

    public function ContOFscan($Orderid , $sub_product_id)
    {
        $SubProducts =ParcodePreOne::where('active' ,2)->where('sub_product_id' , $sub_product_id)->where('order_id' ,$Orderid)->where('warehouse_id' , 1);;
        return $SubProducts->count();;
    }
}