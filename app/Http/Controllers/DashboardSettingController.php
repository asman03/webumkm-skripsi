<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    //
    
     public function store()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard-settings',[
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $users = Auth::user();
        $villages = village::all();
        return view('pages.dashboard-account',[
           'users' => $users,
           'villages' => $villages
        ]);
        
        //  dd($villages);
    }

    public function update(Request $request, $redirect)
    {
        //ambil data
        $data = $request->all();
        //identifikasi user yang login
        $item = Auth::user();

        $item->update($data);
        // redirect sesuai dengan halaman yang dibuka sebelumnya
        return redirect()->route($redirect);

        // dd($request->all());
    }

   
}
