<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplerAddress extends Model 
{

    protected $casts = [
        'address' => 'string',
        'suppler_id' => 'integer',
    ];
    protected $guarded = [];

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Suppler()
    {
        return $this->belongsTo('\Suppler', 'suppler_id');
    }

}