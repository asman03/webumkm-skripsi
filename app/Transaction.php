<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id','shipping_price','admin_price','transaction_status',
        'total_price','code'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id'); //tambah ->withTrashed() jika ingin kembalikan data yang dihapus
    }
}
