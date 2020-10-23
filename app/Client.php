<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Client extends Model 
{
    use SoftDeletes;

    protected $table = 'clients';
    public $timestamps = true;

    protected $fillable = [
        'name', 'facebook_account','whats'
    ];
    // protected $fillable = array('name', 'note');

    public function statistics()
    {
        $statistics = new stdClass;
        
        // $Supplers = Suppler::with('Mobiles','Emails','Address')->orderBy('id')->get();
        $statistics->name = $this->name;
        $statistics->id = $this->id;
        $statistics->whats = $this->whats;
        $statistics->facebook_account = $this->facebook_account;
        $statistics->Address = $this->Address;
        $statistics->Mobiles = $this->Mobiles;

        return $statistics;
    }
    
    public function Mobiles()
    {
        return $this->hasMany('App\Mobiles', 'client_id');
    }

    public function Address()
    {
        return $this->hasMany('App\Address', 'client_id');
    }

    public function Orders()
    {
        return $this->hasMany('\Order', 'client_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

}