<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Toko;
use App\Barang;
use Session;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {

        $data = ['username' => $request->username, 'password' => $request->password];

        if (Auth::attempt($data)) {
            // $toko = Toko::first();

            //     // if ($toko !== null) {
            //     //     Session::put('id', $toko['id']);
            //     //     Session::put('toko', $toko['nama_toko']);
            //     //     Session::put('email', $toko['email']);
            //     //     Session::put('alamat', $toko['alamat']);
            //     //     Session::put('telp', $toko['telp']);
            //     // }else{
            //     //     return redirect()->route('getRegisterToko');
            //     // }
        
            return redirect()->route('home.dashboard');
        }

        return redirect()->back()->with('error', 'Maaf Username / Password yang anda masukkan salah !');
    }

    public function getLogout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
