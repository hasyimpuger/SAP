<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PelangganTransaksiController extends Controller
{
    public function index($id)
    {
        $id= $id;
        $transaksi = Transaksi::where('pelanggan_id', $id)->get()->toArray();
        return view('pelanggan.transaksi.index', compact('transaksi', 'id'));
    }

    public function getDataPelangganTransaksi($id) {
        $transaksi = Transaksi::where('pelanggan_id', $id)->groupBy('invoice_id')->orderBy('invoice_id', 'desc')->get()->toArray();
         $datatables = DataTables::of($transaksi)
            ->editColumn('invoice_id', function($transaksi) {
                return '<span class="badge">'.$transaksi['invoice_id'].'</span>';
            })
            ->editColumn('total_bayar', function($transaksi) {
                return 'Rp. '.number_format($transaksi['total_bayar']);
            })
            ->editColumn('jumlah_bayar', function($transaksi) {
                return 'Rp. '.number_format($transaksi['jumlah_bayar']);
            })
            ->editColumn('kembalian', function($transaksi) {
                return 'Rp. '.number_format($transaksi['kembalian']);
            })
            ->editColumn('tgl_transaksi', function($transaksi) {
                return date('d F Y', strtotime($transaksi['tgl_transaksi']));
            })
            ->addColumn('action', function($transaksi) {
                return '<a href="#modal-pembelian" data-toggle="modal" class="btn btn-info btn-md pembelian"
                        data-invoice_id="'.$transaksi['invoice_id'].'"
                        ><i class="fa fa-search"></i> Detail Pembelian</a>';
            })
            ->rawColumns(['action', 'invoice_id'])
            ->addIndexColumn();
        return $datatables->make(true);
    }

    public function getDataBarang(Request $request) {
    	$transaksi = Transaksi::select(['barang_id', 'qty'])->with('barang')->where('invoice_id', $request['invoice_id'])->get()->toArray();
    	return response()->json($transaksi);
    }
}
