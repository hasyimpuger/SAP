<?php

namespace App\Http\Controllers;

use App\Laba;
use App\Transaksi;
use Illuminate\Http\Request;

class LabaController extends Controller
{
    public function index() {
		$totalLaba = Laba::select('laba_masuk')->sum('laba_masuk');
		$labaHariIni = Laba::select(['tgl_masuk', 'laba_masuk'], date('Y-m-d'))
			->sum('laba_masuk');
		$data = Laba::groupBy('invoice_id')
			->selectRaw('*, sum(laba_masuk) as labaTransaksi')
			->get()->toArray();

    	return view('keuangan.laba.index', [
			'totalLaba' => $totalLaba,
			'labaHariIni' => $labaHariIni,
			'data' => $data
    	]);
    }

    public function getLabaTransaksi(Request $request) {
		$invoice_id = $request['invoice_id'];

		$transaksi = Transaksi::
				select([
					'barang_id',
					'qty',
					'total_bayar',
					'kembalian',
					'jumlah_bayar'
				])
				->with([
					'barang' => function($query) {
						return $query->select(
							'id',
							'nama_barang',
							'harga_beli',
							'harga_jual'
						);
				 	}
				])
				->where('invoice_id', $invoice_id)
				->get()->toArray();

		return response()->json($transaksi);
    }
}
