<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\TransactionDetail;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{    
    public function index()
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
                        ->whereHas('product', function($product){
                            $product->where('users_id', Auth::user()->id);
                        });

        $revenue = $transaction->get()->reduce(function ($carry,$item){
            return $carry  + $item->price;
        });

        $customer = User::where('roles', 'USER')->count();


        return view('pages.dashboard',[
            'transaction_count' => $transaction->count(),
            'transaction_data' => $transaction->get(),
            'revenue' => $revenue,
            'customer' => $customer
        ]);
    }
}
