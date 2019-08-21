<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'image','feature_product','category_id'];

    public function categories()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
