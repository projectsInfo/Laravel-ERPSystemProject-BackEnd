<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name' ,'governorates_id');

    public function CompnyPrices()
    {
        return $this->hasMany('App\DelivaryCompanieDetails', 'city_id');
    }

    public function Governorate()
    {
        return $this->belongsTo('App\Governorate', 'governorates_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}