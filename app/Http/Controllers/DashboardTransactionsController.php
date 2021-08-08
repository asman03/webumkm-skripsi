<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionsController extends Controller
{
    //
    public function index()
    {
        $sellTransaction = TransactionDetail::with(['transaction.user','product.galleries'])
                        ->whereHas('product', function($product){
                            $product->where('users_id', Auth::user()->id);
                        })->get();
        
        $buyTransaction = TransactionDetail::with(['transaction.user','product.galleries'])
                        ->whereHas('transaction', function($transaction){
                            $transaction->where('users_id', Auth::user()->id);
                        })->get();


        return view('pages.dashboard-transactions',[
            'sellTransaction' => $sellTransaction,
            'buyTransaction' => $buyTransaction
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
                        ->findOrFail($id);
        return view('pages.dashboard-transactions-details',[
            'transaction' => $transaction
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrfail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-update',$id);
    }
}
