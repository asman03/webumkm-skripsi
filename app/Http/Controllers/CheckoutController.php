<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;



//untuk konfig midtrans

use Exception;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save users data, ambil id usernya
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses checkout
        $code = 'TOKO-' . mt_rand(0000,9999);
        $carts = Cart::with(['product','user'])->where('users_id',Auth::user()->id)->get();


        // Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'shipping_price' => 5000,
            'admin_price' => 2000,
            'total_price' => (int) $request->total_price + 5000 + 2000,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000,9999);

            TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'products_id' => $cart->product->id,
            'price' => $cart->product->price,
            'shipping_status' => 'PENDING',
            'code' => $trx
            ]);
        }

        //hapus cart ssetelah transaksi
        Cart::where('users_id', Auth::user()->id)->delete();



        // Konfigurasi midtrans

        Config::$serverKey = config('services.midtrans.serverKey');        
        Config::$isProduction = config('services.midtrans.isProduction');        
        Config::$isSanitized = config('services.midtrans.isSanitized');        
        Config::$is3ds = config('services.midtrans.is3ds');

        // Array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price + 5000 + 2000, 
            ],

            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],

            'enabled_payments' => [
                'gopay', 'bank_transfer','bca_va'
            ],
            'vtweb' => []
        ];

        try {
                // Get Snap Payment Page URL
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
                
                // Redirect to Snap Payment Page
                // header('Location: ' . $paymentUrl); -> jarang running

                return redirect($paymentUrl);
            }
            catch (Exception $e) {
            echo $e->getMessage();
            }

    }

    public function callback(Request $request)
    {
        
    }
}
