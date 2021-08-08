<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    // untuk menghilangkan notif tabel notfound laravel = protected $table = 'blog';

    protected $fillable = [
        'judul','photo','description','slug','tgl_publish'
    ];

    protected $hidden = [

    ];
}
