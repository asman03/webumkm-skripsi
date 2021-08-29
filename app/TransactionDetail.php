<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'products_id','transactions_id',
        'price','code','shipping_status','qty'
    ];

    protected $hidden = [

    ];

    public function product(){
        return $this->hasOne(Product::class, 'id','products_id');
    }

    public function transaction(){
        return $this->hasOne(Transaction::class, 'id','transactions_id');
    }
    public function village()
    {
        return $this->hasOne(village::class,'id','villages_id');
    }
}
