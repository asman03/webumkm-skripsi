<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $products    = Product::with(['galleries'])->paginate(12);
        $categories = Category::all();
        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug',$slug)->firstOrfail();
        $products    = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(12);
        
        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
