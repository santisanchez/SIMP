<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'owner_id','name','document_number','address','phone'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }
}
