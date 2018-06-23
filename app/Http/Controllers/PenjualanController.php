<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Ecpos;
use App\Laba;
use App\PTrans;
use App\Pelanggan;
use App\Pemasukan;
use App\Toko;
use App\Transaksi;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use PDF;
// use Fpdf;

class PenjualanController extends Controller
{
    //transaksi
    public function getTransaksi() {
        // dd('stop');
        $barang = Barang::where('stok', '>', 0)->get()->toArray();
    	$pelanggan = Pelanggan::get()->toArray();
    	$transaksi = Transaksi::groupBy('invoice_id')->orderBy('tgl_transaksi', 'desc')->orderBy('invoice_id', 'desc')->get()->toArray();
    	$totalTransaksi = Transaksi::groupBy('invoice_id')->get()->toArray();
    	$transaksiHariIni = Transaksi::where('tgl_transaksi', '=', date('Y-m-d'))->groupBy('invoice_id')->get()->toArray();
    	// dd($barang);
        return view('penjualan.transaksi.index', [
            'barang' => $barang,
           	'pelanggan' => $pelanggan,
           	'transaksi' => $transaksi,
           	'totalTransaksi' => $totalTransaksi,
           	'transaksiHariIni' => $transaksiHariIni
        ]);
    }

    public function getDataTransaksi(Request $request) {
    	$dataId = Transaksi::select('id')->get()->max();
            // dd($dataId);
    	if ($dataId['id'] == null) {

    		$dataId['id'] = 1;
    	             $invoice_id = "Inv" . $dataId['id'];
                     // dd($invoice_id);
             }else{
                $invoice_id = "Inv" . ($dataId['id'] + 1);
                // dd($invoice_id);
             }
    	// dd($invoice_id);
    	$barang_id = $request['id_barang'];
    	$nama_barang = $request['nama_barang'];
        $pelanggan = $request['id_pelanggan'];
        $harga_reseller = $request['harga_reseller'];
        if ($harga_reseller) {
           $harga_jual = $harga_reseller;
        }else {
            $harga_jual = $request['harga_jual'];
        }

    	$qty = $request['qty'];
        if ($pelanggan) {
            for ($i=0; $i <count($barang_id) ; $i++) {
                $sub_total[] = $harga_reseller[$i] * $qty[$i];
            }

            $data_pelanggan = Pelanggan::find($pelanggan);
            $id_pelanggan = $pelanggan;
            $nama_pelanggan = $data_pelanggan['nama'];

        }else {
            for ($i=0; $i <count($barang_id) ; $i++) {
                $sub_total[] = $harga_jual[$i] * $qty[$i];
            }

            $nama_pelanggan = null;
            $id_pelanggan = null;
        }

    	$toko = Toko::first();
    	// dd(array_sum($sub_total));
    	return view('penjualan.transaksi.invoice', [
    		'barang_id' => $barang_id,
    		'harga_jual' => $harga_jual,
            'id_pelanggan' => $id_pelanggan,
            'nama_pelanggan' => $nama_pelanggan,
    		'qty' => $qty,
    		'nama_barang' => $nama_barang,
    		'sub_total' => $sub_total,
    		'invoice_id' => $invoice_id,
    		'toko'	=> $toko
    	]);
    }

    public function postTransaksi(Request $request) {
        // dd($request->all());
    	$barang_id = $request['barang_id'];
    	$tgl_transaksi = $request['tgl_transaksi'];
    	$jumlah_bayar = $request['jumlah_bayar'];
    	$total_bayar = $request['total_bayar'];
        $id_pelanggan = $request['id_pelanggan'];
    	$qty = $request['qty'];
    	$invoice_id = $request['invoice_id'];
        $kembalian = $request['kembalian'];
        $nBarang = [];
    	for ($i=0; $i < count($barang_id); $i++) {
    		$barang = Barang::with('kategori')->find($barang_id[$i]);
    		$jumlahStokBaru = $barang->stok - $qty[$i];
    		// $barang->update(['stok' => $jumlahStokBaru]);
            $laba_masuk = (((float)$barang['harga_jual'] - (float)$barang['harga_beli']) *
                $qty[$i]);
            $laba = new Laba;
            $laba->invoice_id = $invoice_id[$i];
            $laba->tgl_masuk = $tgl_transaksi;
            $laba->laba_masuk = $laba_masuk;
            $laba->save();

    		$transaksi = Transaksi::create([
    			'barang_id' => $barang_id[$i],
    			'tgl_transaksi' => $tgl_transaksi,
                'invoice_id' => $invoice_id[$i],
                'pelanggan_id' => $id_pelanggan,
    			'qty' => $qty[$i],
    			'jumlah_bayar' => $jumlah_bayar,
    			'total_bayar' => $total_bayar,
                'kembalian' => $kembalian,
    		]);
            $b = $barang->kategori->kategori . ' '. $barang->nama_barang .
                ' (qty: ' . $qty[$i] . ')';

            array_push($nBarang, $b);
    	}

        // dd($nBarang);

        $test = implode(", ", $nBarang);
        $pemasukan = new Pemasukan;
        $pemasukan->tgl_pemasukan = $request['tgl_transaksi'];
        $pemasukan->jumlah_uang = $request['jumlah_bayar'];
        $pemasukan->invoice_id = $transaksi->invoice_id;
        $pemasukan->keterangan = $test;
        $pemasukan->save();
        // $test = json_encode($nBarang);
        // $str = $json = str_replace(['"', '[', ']'],'', (string) $test);

            $transaksi = Transaksi::with('barang')->where('invoice_id', '=', $invoice_id)->get()->toArray();
            if ($id_pelanggan) {
                $data_pelanggan = Pelanggan::find($id_pelanggan);
                $nama_pelanggan = $data_pelanggan['nama'];
            }else {
                $nama_pelanggan = null;
            }



           $toko = Toko::first();

           // === with pdf ===//
           $size = array(0,0,204,650);
           $pdf = PDF::loadView('penjualan.transaksi.invoice-pdf', [
                        'toko' => $toko,
                        'transaksi' => $transaksi,
                        'invoice_id' => $invoice_id[0],
                        'sub_total' => $total_bayar,
                        'nama_pelanggan' => $nama_pelanggan,
                        'tgl_transaksi' => $tgl_transaksi,
                        'jumlah_bayar' => $jumlah_bayar,
                        'kembalian' => $kembalian
                        ])->setOptions(['dpi' => 72,'defaultFont' => 'sans-serif']);
           return $pdf->stream('Print Transaksi.pdf');
           // $location = public_path('trans_pdf/'.'trans_'.$invoice_id[0].'_'.$tgl_transaksi.'.pdf');
           // Storage::put('Transaksi.pdf');
           // $pdf->save($location);
           // dd($transaksi);
    	// return redirect()->route('transaksi.print')->with([
     //        'toko' => $toko,
     //        'transaksi' => $transaksi,
     //        'invoice_id' => $invoice_id[0],
     //        'sub_total' => $total_bayar,
     //        'tgl_transaksi' => $tgl_transaksi,
     //        'jumlah_bayar' => $jumlah_bayar,
     //        'kembalian' => $kembalian
     //    ]);
     // return response()->json($request->all());


     // === with ecpos === //
     // $ecpos = Ecpos::first();

     //    $ip = $ecpos->ip;
     //    $printer = $ecpos->nama_printer;
     //    $pdfFile = $location;
     //    $connector = null;
     //    $printer = new Printer($connector);
     // try {
     //    $pages = ImagickEscposImage::loadPdf($pdfFile);
     //    foreach ($pages as $page) {
     //        $printer->graphics($page);
     //    }
     //    $printer->cut();
     // } catch (Exception $e) {
     //    echo $e->getMessage() . "\n";
     //    return response()->json(false);
     // } finally {
     //    $printer->close();
     //    return response()->json(true);
     // }

    }

    public function invoicePDF($invoice_id) {
        $transaksi = Transaksi::where('invoice_id', $invoice_id)
                   ->first();
        $toko = Toko::first();

        // === with pdf ===//
        $size = array(0,0,204,650);
        $pdf = PDF::loadView('penjualan.transaksi.invoice-pdf', [
                    'toko' => $toko,
                    'transaksi' => $transaksi,
                    'invoice_id' => $transaksi[0]['invoice_id'],
                    'sub_total' => $transaksi[0]['total_bayar'],
                    'tgl_transaksi' => $transaksi[0]['tgl_transaksi'],
                    'jumlah_bayar' => $transaksi[0]['tgl_transaksi'],
                    'kembalian' => $transaksi[0]['kembalian']
                    ])->setPaper($size)->setOptions(['dpi' => 72,'defaultFont' => 'sans-serif']);
         return $pdf->stream('Print Transaksi.pdf');
        // $location = public_path('trans_pdf/'.'trans_'.$transaksi['invoice_id'].'_'.$transaksi['tgl_transaksi'].'.pdf');
        // Storage::put('Transaksi.pdf');

        // === with ecpos === //
         // $ecpos = Ecpos::first();

         //    $ip = $ecpos->ip;
         //    $printer = $ecpos->nama_printer;
         //    $pdfFile = $location;
         //    $connector = null;
         //    $printer = new Printer($connector);
         // try {
         //    $pages = ImagickEscposImage::loadPdf($pdfFile);
         //    foreach ($pages as $page) {
         //        $printer->graphics($page);
         //    }
         //    $printer->cut();
         // } catch (Exception $e) {
         //    echo $e->getMessage() . "\n";
         //    return response()->json(false);
         // } finally {
         //    $printer->close();
         //    return response()->json(true);
         // }
    }

    public function printTransaksi() {
        $data = ['data' => Session::get('transaksi')];
        return view('penjualan.transaksi.invoice-pdf', [
            'toko' => Session::get('toko'),
            'transaksi' => $data,
            'invoice_id' => Session::get('invoice_id'),
            'sub_total' => Session::get('sub_total'),
            'tgl_transaksi' => Session::get('tgl_transaksi'),
            'jumlah_bayar' => Session::get('jumlah_bayar'),
            'kembalian' => Session::get('kembalian'),
        ]);
    }

    public function getTransaksiEdit($Inv) {
    	$transaksi = Transaksi::with('barang')->where('invoice_id', '=', $Inv)->get()->toArray();
    	// dd($transaksi);
            $id = Transaksi::select('id')->get()->last();
    	$barang = Barang::where('stok', '>', 3)->get()->toArray();
    	return view('penjualan.transaksi.invoice-edit', [
    		'transaksi' => $transaksi,
    		 'invoice_id' => $Inv,
    		 'barang' => $barang,
             'id' => $id
    	]);
    }

    // public function invoicePDF(Request $request) {
    //     $pdf = PDF::loadView('penjualan.transaksi.invoice-pdf')->setPaper('a4');
    //     return $pdf->stream('Print Transaksi.pdf');
    // }

    public function postTransaksiEdit(Request $request) {
    	// dd($request->all());
                $barang_id = $request->barang_id;
                $tgl_transaksi = $request->tgl_transaksi;
                $qty    = $request->qty;
                $jumlah_bayar = $request->jumlah_bayar;
                $kembalian = $request->kembalian;
                $invoice_id = $request->invoice_id;
                $total_bayar = $request->total_bayar;
                // dd(count($barang_id));
                for ($i=0; $i <count($barang_id) ; $i++) {
                    // echo $request['harga_jual-'.$i] . '<br>';
                    $trans = Transaksi::find($request['transaksi_id'][$i]);
                    if ($qty[$i] > $trans['qty']) {
                        $barang = Barang::find($barang_id[$i]);
                        $qty_barang = $barang->stok;
                        $hasil = $qty_barang - ($qty[$i] - $trans['qty']);
                        // echo $hasil . '<br>';
                        $barang->update(['stok' => $hasil]);
                    }elseif($qty[$i] < $trans['qty']) {
                        $barang = Barang::find($barang_id[$i]);
                        $qty_barang = $barang->stok;
                        $hasil = $qty_barang + ($trans['qty'] - $qty[$i]);
                        // echo $hasil . '<br>';
                        $barang->update(['stok' => $hasil]);
                    }
                    $data = Transaksi::where('id', '=', $request['transaksi_id'][$i])->update([
                        'jumlah_bayar' => $jumlah_bayar,
                        'tgl_transaksi' => $tgl_transaksi,
                        'qty' => $qty[$i],
                        'barang_id' => $barang_id[$i],
                        'total_bayar' => $total_bayar,
                        'kembalian' => $kembalian,
                    ]);

                    // $pemasukan = Pemasukan::
                }
                // die();
                return response()->json($data);
    }

    public function getDataBarang(Request $request, Barang $barang) {
        $data = $barang->find($request->id);
        // dd($data);
        return response()->json($data);
    }

    public function exportExcelTransaksi(Request $request, $type) {
        // dd($data);
        Excel::create('Data Transaksi ' . date('F-Y', strtotime($request['bulan'] . $request['tahun'])), function ($excel) use($request){
            $excel->sheet('Data Transaksi ' . date('F-Y', strtotime($request['bulan'] . $request['tahun'])), function ($sheet)  use($request){
                $arr = array();
                $transaksi = Transaksi::with('barang')->whereMonth('tgl_transaksi', $request['bulan'])->whereYear('tgl_transaksi', $request['tahun'])->get()->toArray();
                foreach ($transaksi as $data) {
                    $data_arr = array(
                        $data['invoice_id'],
                        $data['tgl_transaksi'],
                        $data['barang']['nama_barang'],
                        $data['qty'],
                        $data['total_bayar'],
                        $data['jumlah_bayar'],
                    );
                    array_push($arr, $data_arr);
                }
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                    'Invoice Id',
                    'Tanggal Transaksi',
                    'Nama Barang',
                    'Qty',
                    'Total bayar',
                    'Jumlah Bayar'
                ));
            });
        })->download($type);

    }

    public function getTransaksiDelete(Request $request) {
    	$transaksi = Transaksi::where('invoice_id', $request->invoice_id)->delete();
    	return redirect()->back();
    }

    public function getOneTransDelete(Request $request) {
        $transaksi = Transaksi::find($request->id)->delete();
        return redirect()->back();
    }

    public function exportTransaksiPDF(Request $request) {
        $transaksi = Transaksi::with('barang')->whereMonth('tgl_transaksi', $request['bulan'])
                              ->whereYear('tgl_transaksi', $request['tahun'])
                              ->get();
        $cari_total = Transaksi::with('barang')->whereMonth('tgl_transaksi', $request['bulan'])
                              ->whereYear('tgl_transaksi', $request['tahun'])
                              ->groupBy('invoice_id')
                              ->get();
        // dd($transaksi->sum('total_bayar'));
        $total_bayar = $cari_total->sum('total_bayar');
         $pdf = PDF::loadView('penjualan.transaksi.pdf', ['transaksi' => $transaksi, 'total_bayar' => $total_bayar, 'bulan' => $request['bulan'], 'tahun' => $request['tahun']])->setPaper('a4');
        // $pdf = PDF::render();
        return $pdf->stream('Data Transaksi ' . date('F-Y') . '.pdf');
    }

    // Laporan
    public function getLaporan(Request $request) {
        $transaksi = Transaksi::with('barang')
                     ->whereBetween('tgl_transaksi', [$request->start, $request->end])
                     ->get()
                     ->toArray();
        return view('penjualan.transaksi.laporan', [
            'transaksi' => $transaksi,
            'start' => $request->start,
            'end' => $request->end,
        ]);
    }

    public function postLaporanPdf($start, $end) {
        $transaksi = Transaksi::with('barang')
                     ->whereBetween('tgl_transaksi', [$start, $end])
                     ->get();
        $cari_total = Transaksi::with('barang')
                        ->whereBetween('tgl_transaksi', [$start, $end])
                        ->groupBy('invoice_id')
                        ->get();
        $total_bayar = $cari_total->sum('total_bayar');
        // dd($total_bayar);
        // $group = DB::table('transaksi')
        //             ->whereBetween('tgl_transaksi', [$start, $end])
        //             ->join('barang', 'transaksi.barang_id', '=', 'barang.id')
        //             ->select('transaksi.*', DB::raw('count(transaksi.invoice_id) AS total'), 'barang.*')
        //             // ->having('total', '>', 1)
        //             ->groupBy('invoice_id')
        //             ->get();
        // dd($group);
        $pdf = PDF::loadView('penjualan.transaksi.laporan-pdf', [
                    'transaksi' => $transaksi,
                    // 'group' => $group,
                    'total_bayar' => $total_bayar,
                    'start' => $start,
                    'end' => $end
                    ])
                    ->setPaper('a4');
        return $pdf->stream('Laporan Transaksi.pdf');
    }
}
