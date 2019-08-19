<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id','name','document_number','address','phone'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function products(){
        return $this->hasMany('App\Product','store_id');
    }
}
