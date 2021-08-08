<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Transaction;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $customer = User::where('roles', 'USER')->count();        
        $penghasilan = Transaction::sum('total_price'); 
        $transaksi = Transaction::count();
        
        return view('pages.admin.dashboard',[
            'customer' => $customer,
            'penghasilan' => $penghasilan,
            'transaksi' => $transaksi
        ]);
    }
    /*menghitung berdasarkan transaksi yang sukses*/
/*//$penghasilan = Transaction::where('transaction_status','SUCCESS')->sum('total_price');*/
}
