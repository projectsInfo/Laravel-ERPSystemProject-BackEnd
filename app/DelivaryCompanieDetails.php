<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DelivaryCompanieDetails extends Model 
{

    protected $table = 'delivary_companie_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('city_id', 'price', 'delivary_company_id');

    public function DelivaryCompanie()
    {
        return $this->belongsTo('App\DelivaryCompany', 'delivary_company_id');
    }

    public function City()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

}