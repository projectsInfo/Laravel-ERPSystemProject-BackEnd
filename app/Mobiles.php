<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobiles extends Model 
{
    use SoftDeletes;

    protected $table = 'mobile';
    public $timestamps = true;
    protected $fillable = array('mobile', 'client_id');

    public function Client()
    {
        return $this->belongsTo('\Client', 'client_id');
    }

}