<?php

namespace App\Http\Controllers;

use App\Cart;
use App\village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $carts = Cart::with(['product.galleries','user'])->where('users_id', Auth::user()->id)->get();
        $villages = village::all();

        return view('pages.cart',[
           'users' => $users,
            'carts' => $carts,
           'villages' => $villages

        ]);
        // dd($carts);
        
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrfail($id);
        $cart->delete();

        return redirect()->route('cart');

    }

    public function increment($id){
        $transaction = Cart::find($id);

        $transaction->update([
            'qty'=>$transaction->qty + 1,
            'total'=>$transaction->product->price*($transaction->qty + 1)
        ]);
        return redirect()->route('cart');
        // dd($transaction);

    }
    public function decrement($id){
        $transaction = Cart::find($id);

        $transaction->update([
            'qty'=>$transaction->qty - 1,
            'total'=>$transaction->product->price*($transaction->qty - 1)
        ]);
        return redirect()->route('cart');
        // dd($transaction);

    }

    
}

