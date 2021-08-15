<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;


use App\Cart;
use App\Transaction;
use App\TransactionDetail;



//untuk konfig midtrans

use Exception;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

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

        //hapus cart setelah transaksi
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
                // dd($serverKey);
            echo $e->getMessage();
            }

    }

    public function callback(Request $request)
    {
        //Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //Instance midtrans notification
        $notification = new Notification();

        // pecah order id agar masuk ke database
        $order = explode('-', $notification->order_id);

        //Assign ke variable untuk memudahkan coding
        // $order_id = $notification->order_id;
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $order[1]; 

        //Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        //Handle notification status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status ='PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        }
        else if($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        }
        else if($status == 'deny') {
            $transaction->transaction_status = 'FAILED';
        }
        else if($status == 'expire') {
            $transaction->transaction_status = 'EXPIRED';
        }
        else if($status == 'cancel') {
            $transaction->transaction_status = 'CANCELED';
        }

        //simpan transaksi
        $transaction->save();
    }

    public function finishRedirect(Request $request){
        return view('pages.success_trf');
    }

    public function unfinishRedirect(Request $request){
        return view('pages.unfinish_trf');
    }

    public function errorRedirect(Request $request){
        return view('pages.failed_trf');
    }
}
