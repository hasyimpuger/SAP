<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Toko;
use Session;
use Image;
use Storage;

class SettingController extends Controller
{
    public function getSetting() {
    	$data = Toko::first();
    	return view('setting.index', ['data' => $data]);
    }

    public function postSetting(Request $request) {
        // dd($request->all());
    	$toko = Toko::find($request->id);
            $toko->nama_toko = $request->nama_toko;
            $toko->alamat = $request->alamat;
            $toko->email = $request->email;
            $toko->telp = $request->telp;
            $toko->deskripsi = $request->deskripsi;
             if($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
                $location   =   public_path('photo/toko/'. $fileName);
                Image::make($file)->resize(800, 400)->save($location);
                //gambar lama
                $oldFileName = $toko->photo;
                //gambar baru
                $toko->photo = $fileName;
                //hapus gambar lama
                Storage::delete($oldFileName);

            }
            $toko->save();

    	$data = Toko::first();
    	if ($toko) {
    		Session::put('id', $data['id']);
	      	Session::put('toko', $data['nama_toko']);
	          Session::put('email', $data['email']);
	          Session::put('alamat', $data['alamat']);
                       Session::put('telp', $data['telp']);
		Session::put('deskripsi', $data['deskripsi']);
    	}

	return redirect()->back();
    }

    public function getRegisterToko() {
    	return view('setting.register');
    }

    public function postRegisterToko(Request $request) {
    	Toko::create($request->all());
    	$toko = Toko::first();
      	Session::put('id', $toko['id']);
      	Session::put('toko', $toko['nama_toko']);
             Session::put('email', $toko['email']);
              Session::put('alamat', $toko['alamat']);
            Session::put('deskripsi', $data['deskripsi']);
	Session::put('telp', $toko['telp']);
    	return redirect()->route('home.index');
    }
}
