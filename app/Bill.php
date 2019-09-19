<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Bill extends Model
{
    protected $fillable = [
        'store_id','price'
    ];

    public function store(){

        return $this->belongsTo('App\Store','store_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'bill_products');
    }
}
