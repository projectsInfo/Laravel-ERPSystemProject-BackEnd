<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model 
{
    use SoftDeletes;

    protected $table = 'images';
    public $timestamps = true;
    protected $fillable = array('img_url', 'product_id');

    public function product()
    {
        return $this->belongsTo('\Product', 'product_id');
    }

}