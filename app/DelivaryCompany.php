<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class DelivaryCompany extends Model 
{

    protected $table = 'delivary_companies';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('Name', 'Address', 'Phone', 'Email');

    public function Derails()
    {
        return $this->hasMany('App\DelivaryCompanieDetails', 'delivary_company_id');
    }


    public function Orders()
    {
        return $this->hasMany('App\Order', 'delivary_id');
    }
    
    public function getRouteKeyName()
    {
        return 'Name';
    }
    public function statistics()
    {
        $statistics = new stdClass;
        $statistics->id = $this->id;
        $statistics->Name = $this->Name;
        $statistics->Address = $this->Address;
        $statistics->Phone = $this->Phone;
        $statistics->Email = $this->Email;
        $statistics->Derails = $this->Derails;
        // dd($statistics->Product);
        return $statistics;
    }

}