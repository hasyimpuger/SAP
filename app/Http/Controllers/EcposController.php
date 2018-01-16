<?php

namespace App\Http\Controllers;

use App\Ecpos;
use Illuminate\Http\Request;

class EcposController extends Controller
{
    public function getEcpos() {
        $ecpos = Ecpos::first();
        return view('setting.ecpos', compact('ecpos'));
    }

    public function postEcpos(Request $request) {
        if ($request->ajax()) {
            $id = $request['id'];
            $ip = $request['ip'];
            $nama_printer = $request['nama_printer'];

            $data = $this->findOrCreate($id, $ip, $nama_printer);
            return response()->json($data);
        }
    }

    public function findOrCreate($id, $ip, $nama_printer) {
        $ecpos = Ecpos::where('id', $id)->first();
        if ($ecpos) {
            return $ecpos->update([
                'ip' => $ip,
                'nama_printer' => $nama_printer
            ]);
        }
        // return $ecpos;
        return Ecpos::create([
                'ip' => $ip,
                'nama_printer' => $nama_printer
            ]);
    }
}
