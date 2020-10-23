<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Suppler extends Model 
{

    protected $casts = [
        'name' => 'string',
    ];

    protected $guarded = [];

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Products()
    {
        return $this->hasMany('App\SupplyOrder', 'suppler_id');
    }

    public function statistics()
    {
        $statistics = new stdClass;
        
        // $Supplers = Suppler::with('Mobiles','Emails','Address')->orderBy('id')->get();
        $statistics->id = $this->id;
        $statistics->name = $this->name;
        $statistics->Address = $this->Address;
        $statistics->Emails = $this->Emails;
        $statistics->Mobiles = $this->Mobiles;

        return $statistics;
    }

    public function Mobiles()
    {
        return $this->hasMany('App\SupplerMobile', 'suppler_id');
    }

    public function Emails()
    {
        return $this->hasMany('App\SupplerEmail', 'suppler_id');
    }

    public function Address()
    {
        return $this->hasMany('App\SupplerAddress', 'suppler_id');
    }


    public function getRouteKeyName()
    {
        return 'name';
    }

}