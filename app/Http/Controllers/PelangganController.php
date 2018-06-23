<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::select('id')->get()->toArray();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function getDataPelanggan() {
        $pelanggan = Pelanggan::get()->toArray();
         $datatables = DataTables::of($pelanggan)
            ->addColumn('action', function($pelanggan) {
                return '<a href="'.route("pelanggan.transaksi", $pelanggan['id']).'" class="btn btn-info btn-md"><i class="fa fa-search"></i> Detail transaksi</a>&nbsp;
                <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-md edit"
                        data-id="'.$pelanggan['id'].'"
                        data-nama="'.$pelanggan['nama'].'"
                        data-no_hp="'.$pelanggan['no_hp'].'"
                        data-alamat="'.$pelanggan['alamat'].'"
                        ><i class="fa fa-edit"></i></a>&nbsp;
                        <a href="#!delete" class="btn btn-danger delete" data-id="'.$pelanggan['id'].'"><i class="fa fa-trash"></i></a>';
            })
            ->addIndexColumn();
        return $datatables->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelanggan = Pelanggan::create($request->all());
        return response()->json($pelanggan);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pelanggan = Pelanggan::find($request['id'])->update($request->all());
        return response()->json($pelanggan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pelanggan = Pelanggan::find($request['id'])->delete();
        return response()->json($pelanggan);
    }
}
