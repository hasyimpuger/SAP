<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Distributor;
use App\Transaksi;
use App\Pemasukan;
use App\Pengeluaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home.index');
    }

    public function getDashboard() {
        $totalBarang = Barang::select(['id', 'stok'])->get();
        $distributor = Distributor::get();
        $penjualan = Transaksi::select('tgl_transaksi')->get();
        $countPenjualan = Transaksi::select('tgl_transaksi')->where('tgl_transaksi', date('Y-m-d'))->get();
        $pemasukan = Pemasukan::select('jumlah_uang')->get();
        $pengeluaran = Pengeluaran::select('jumlah_uang')->get();
        $hasil = $pemasukan->sum('jumlah_uang') - $pengeluaran->sum('jumlah_uang');

        $a = Pemasukan::select(['jumlah_uang', 'tgl_pemasukan'])
               ->whereMonth('tgl_pemasukan', date('m'))
               ->whereYear('tgl_pemasukan', date('Y'))
               ->get();
        $b = Pengeluaran::select(['jumlah_uang', 'tgl_pengeluaran'])
               ->whereMonth('tgl_pengeluaran', date('m'))
               ->whereYear('tgl_pengeluaran', date('Y'))
               ->get();

        $totalPemasukanHariIni = Pemasukan::select(['jumlah_uang', 'tgl_pemasukan'])
               ->whereDate('tgl_pemasukan', date('Y-m-d'))
               ->get();
        $totalPengeluaranHariIni = Pengeluaran::select(['jumlah_uang', 'tgl_pengeluaran'])
               ->whereDate('tgl_pengeluaran', date('Y-m-d'))
               ->get();
        $laba = $a->sum('jumlah_uang') - $b->sum('jumlah_uang');
        return view('home.dashboard', [
            'totalBarang' => $totalBarang,
            'distributor' => $distributor,
            'penjualan' => $penjualan,
            'countPenjualan' => $countPenjualan,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'hasil' => $hasil,
            'laba' => $laba,
            'totalPemasukanHariIni' => $totalPemasukanHariIni,
            'totalPengeluaranHariIni' => $totalPengeluaranHariIni,
            'totalPemasukanBulanIni' => $a,
            'totalPengeluaranBulanIni' => $b,
        ]);
    }
}
