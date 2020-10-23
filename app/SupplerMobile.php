<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplerMobile extends Model 
{

    protected $casts = [
        'mobile' => 'string',
        'suppler_id' => 'integer',
    ];
    protected $guarded = [];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    // protected $fillable = array('mobile', 'suppler_id');

    public function Suppler()
    {
        return $this->belongsTo('\Suppler', 'suppler_id');
    }

}