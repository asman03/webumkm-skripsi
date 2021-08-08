<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blog;

class BlogController extends Controller
{
    public function index()
    {

        // tampilkan berdasarkan tanggal publish terbaru
        $blogs = blog::orderBy('tgl_publish','desc')->get();
        $blog = blog::orderBy('tgl_publish','desc')->first();
        
        return view('pages.blog', [
            'blogs' => $blogs
        ]);
    }

    public function detail(Request $request, $id)
    {
        $blog = Blog::where('slug',$id)->first();
        return view('pages.blog-details',[
            'blog' => $blog
        ]);
    }
}
