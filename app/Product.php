<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id','name','price','quantity'
    ];


    /**
     * Return the store the product belongs to
     **/
    public function store(){
        return $this->belongsTo('App\Store','store_id');
    }

    /**
     *  Sells a given amount of this product
     *
     * @param $quantity Quantity of product to sell
     **/
    public function sell($quantity)
    {
        if($this->quantity >= $quantity){
            $this->quantity = $this->quantity - $quantity;
            $this->save();
        }
    }
}
