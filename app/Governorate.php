<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Governorate extends Model 
{

    protected $table = 'governorates';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');

    // public function CompnyPrices()
    // {
    //     return $this->hasMany('App\DelivaryCompanieDetails', 'city_id');
    // }

    public function getRouteKeyName()
    {
        return 'name';
    }
}