<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model 
{
    use SoftDeletes;

    protected $table = 'discounts';
    public $timestamps = true;
    protected $fillable = array('name', 'type', 'value');

}