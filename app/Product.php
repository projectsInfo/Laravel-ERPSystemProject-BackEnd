<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model 
{
    use SoftDeletes;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'style_id', 'material', 'parcode_pre_all');

    public function Images()
    {
        return $this->hasMany('App\Image', 'product_id');
    }

    public function Style()
    {
        return $this->belongsTo('App\Style', 'style_id');
    }

    public function SubProducts()
    {
        return $this->hasMany('App\SubProduct', 'product_id');
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
}