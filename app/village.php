<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class village extends Model
{
    

    protected $fillable = [
        'villages_name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
