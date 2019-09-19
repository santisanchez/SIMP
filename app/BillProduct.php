<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    protected $table = 'bill_products';

    public $timestamps = false;

    protected $fillable = ['bill_id','product_id','quantity'];

    public function bill(){
        return $this->belongsTo('App\Bill','bill_id');
    }

    public function product(){
        return $this->belongsTo('App\Bill','product_id');
    }
}
