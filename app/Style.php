<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Style extends Model 
{
    use SoftDeletes;

    protected $table = 'styles';
    public $timestamps = true;
    protected $fillable = array('name');

    public function products()
    {
        return $this->hasMany('\Product', 'style_id');
    }

}