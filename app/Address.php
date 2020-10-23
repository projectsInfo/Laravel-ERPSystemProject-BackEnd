<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model 
{
    use SoftDeletes;

    protected $table = 'address';
    public $timestamps = true;
    protected $fillable = array('address', 'client_id');

    public function Client()
    {
        return $this->belongsTo('\Client', 'client_id');
    }

}