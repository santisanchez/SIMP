<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id','name','document_number','address','phone'
    ];

    /*
    * Returns the owner the store belongs to
    */
    public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }


    /*
    * Returns all the products of the current store
    */
    public function products(){
        return $this->hasMany('App\Product','store_id');
    }

    /*
    * Returns all the Bills of the current store
    */
    public function bills(){
        return $this->hasMany('App\Bill');
    }
}
