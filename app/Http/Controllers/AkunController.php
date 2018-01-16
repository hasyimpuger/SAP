<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index() {
        $user = User::get()->toArray();
        return view('akun.index', compact('user'));
    }

    public function postAkun(Request $request) {
        $user = User::where('level', $request->level)->first();
        $user->username = $request['username'];
        if ($request['password']) {
            $user->password = bcrypt($request['password']);
        }
        $user->save();
        return redirect()->back()->with('success', 'Akun berhasil di update !');
    }
}
