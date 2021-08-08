<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['users_id','products_id','comment'];


    public function user ()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
