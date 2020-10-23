<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class DelivaryPrice extends Model 
{

    protected $table = 'delivary_price';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('city_id', 'price');


    public function City()
    {
        return $this->belongsTo('App\City', 'city_id');
    }
    // public function statistics()
    // {
    //     $statistics = new stdClass;
    //     $statistics->id = $this->id;
    //     $statistics->Name = $this->Name;
    //     $statistics->Address = $this->Address;
    //     $statistics->Phone = $this->Phone;
    //     $statistics->Email = $this->Email;
    //     $statistics->Derails = $this->Derails;
    //     // dd($statistics->Product);
    //     return $statistics;
    // }

}