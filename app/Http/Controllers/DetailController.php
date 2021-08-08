<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Comment;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
                

        $product = Product::with(['galleries','user'])->where('slug', $id)->firstOrFail();
        $comment = Comment::where('products_id',$product->id)->with('user')->get();
        return view('pages.detail',[
            'product' => $product,
            'comment' => $comment
        ]);
        

        
    }

    public function add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
