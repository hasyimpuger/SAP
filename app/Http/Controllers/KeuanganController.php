<?php

namespace App\Http\Controllers;

use App\Laba;
use App\Pemasukan;
use App\Pengeluaran;
use Excel;
use Illuminate\Http\Request;
use PDF;

class KeuanganController extends Controller
{

   public function getKeuangan() {
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
      // $totalPemasukanBulanIni = Pemasukan::select(['jumlah_uang', 'tgl_pemasukan'])
      //          ->whereMonth('tgl_pemasukan', date('m'))
      //          ->whereYear('tgl_pemasukan', date('Y'))
      //          ->get();
      // $totalPengeluaranBulanIni = Pengeluaran::select(['jumlah_uang', 'tgl_pengeluaran'])
      //          ->whereMonth('tgl_pengeluaran', date('m'))
      //          ->whereYear('tgl_pengeluaran', date('Y'))
      //          ->get();
      // $laba = $a->sum('jumlah_uang') - $b->sum('jumlah_uang');
      $laba = Laba::select([
        'tgl_masuk',
        'laba_masuk'
      ])->whereMonth('tgl_masuk', date('m'))->sum('laba_masuk');
      // dd($a->sum('jumlah_uang'));

     	return view('keuangan.index', [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'hasil' => $hasil,
            'laba' => $laba,
            'totalPemasukanHariIni' => $totalPemasukanHariIni,
            'totalPengeluaranHariIni' => $totalPengeluaranHariIni,
            'totalPemasukanBulanIni' => $a,
            'totalPengeluaranBulanIni' => $b
        ]);
   }

   // Pemasukan
   public function getPemasukan() {
         $pemasukan = Pemasukan::get();
         $totalPerTahun = $pemasukan->sum('jumlah_uang');
         $totalPerHari = Pemasukan::where('tgl_pemasukan', date('Y-m-d'))->get()->sum('jumlah_uang');
         // dd($totalPerHari);
   	return view('keuangan.pemasukan.index', ['pemasukan' => $pemasukan, 'totalPerTahun' => $totalPerTahun, 'totalPerHari' => $totalPerHari]);
   }

   public function postPemasukan(Request $request, Pemasukan $pemasukan) {
   	$data = $pemasukan->create($request->all());
   	return response()->json($data);
   }

   public function getHapusPemasukan(Request $request, Pemasukan $pemasukan) {
         $data = $pemasukan->find($request->id)->delete();
         return response()->json($data);
   }

   public function postEditPemasukan(Request $request, Pemasukan $pemasukan) {
      $data = $pemasukan->find($request->id)->update($request->all());
      return response()->json($data);
   }

   public function exportExcelPemasukan(Request $request, $type) {
          Excel::create('Pemasukan Bulan ' . $request->bulan . ' Tahun '. $request->tahun, function ($excel) use($request){
            $excel->sheet('Pemasukan Bulan ' . $request->bulan . ' Tahun '. $request->tahun, function ($sheet)  use($request){
                $pemasukan = Pemasukan::whereMonth('tgl_pemasukan', $request->bulan)
                                          ->whereYear('tgl_pemasukan', $request->tahun)
                                          ->get();
                $invoice_id = Pemasukan::whereMonth('tgl_pemasukan', '=', $request->bulan)
                                    ->whereYear('tgl_pemasukan', '=', $request->tahun)
                                    ->groupBy('invoice_id')
                                    ->get()->toArray();
                $total =  Pemasukan::whereMonth('tgl_pemasukan', $request->bulan)
                                          ->whereYear('tgl_pemasukan', $request->tahun)
                                          ->groupBy('invoice_id')
                                          ->get()->sum('jumlah_uang');
                $arr = array();
                foreach ($pemasukan as $data) {
                    $data_arr = array(
                        date('d-F-Y', strtotime($data['tgl_pemasukan'])),
                        $data['jumlah_uang'],
                        $data['keterangan'],
                    );
                    array_push($arr, $data_arr);
                }
                // $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                //     'Tanggal Pemasukan',
                //     'Jumlah Uang',
                //     'Keterangan'
                // ));
                $sheet->loadView('keuangan.pemasukan.excel', ['pemasukan' => $pemasukan, 'bulan' => $request->bulan, 'tahun' => $request->tahun, 'total' => $total, 'invoice_id' => $invoice_id]);
            });
        })->download($type);
   }

   public function exportPDFPemasukan(Request $request) {
         $bulan = $request->bulan;
         $tahun = $request->tahun;

         $pemasukan = Pemasukan::whereMonth('tgl_pemasukan', '=', $bulan)
                                    ->whereYear('tgl_pemasukan', '=', $tahun)
                                    ->get();
         $invoice_id = Pemasukan::whereMonth('tgl_pemasukan', '=', $bulan)
                                    ->whereYear('tgl_pemasukan', '=', $tahun)
                                    ->groupBy('invoice_id')
                                    ->get()->toArray();
          $total = Pemasukan::whereMonth('tgl_pemasukan', '=', $bulan)
                                    ->whereYear('tgl_pemasukan', '=', $tahun)
                                    ->groupBy('invoice_id')
                                    ->get()->sum('jumlah_uang');
            // dd($pemasukan);
         $pdf = PDF::loadView('keuangan.pemasukan.pdf', ['total' => $total,'pemasukan' => $pemasukan, 'bulan' => $bulan, 'tahun' => $tahun, 'invoice_id' => $invoice_id])->setPaper('a4');
        // $pdf = PDF::render();
        return $pdf->stream('Data Pemasukan ' . $bulan .'-'. $tahun  . '.pdf');
   }

   public function exportPrintPemasukan(Request $request) {
        $bulan = $request->bulan;
         $tahun = $request->tahun;
          $invoice_id = Pemasukan::whereMonth('tgl_pemasukan', '=', $bulan)
                                    ->whereYear('tgl_pemasukan', '=', $tahun)
                                    ->groupBy('invoice_id')
                                    ->get()->toArray();
         $pemasukan = Pemasukan::whereMonth('tgl_pemasukan', '=', $bulan)
                                    ->whereYear('tgl_pemasukan', '=', $tahun)
                                    ->get();
         $total = Pemasukan::whereMonth('tgl_pemasukan', '=', $bulan)
                                    ->whereYear('tgl_pemasukan', '=', $tahun)
                                    ->groupBy('invoice_id')
                                    ->get()->sum('jumlah_uang');
            // dd($invoice_id);
            return view('keuangan.pemasukan.print', [
                    'total' => $total,
                    'invoice_id' => $invoice_id,
                    'pemasukan' => $pemasukan,
                    'bulan' => $bulan,
                    'tahun' => $tahun
              ]);
   }



   // Pengeluaran
   public function getPengeluaran() {
         $pengeluaran = Pengeluaran::get();
         $totalPerTahun = $pengeluaran->sum('jumlah_uang');
         $totalPerHari = Pengeluaran::where('tgl_pengeluaran', date('Y-m-d'))->get()->sum('jumlah_uang');
         // dd($totalPerHari);
    return view('keuangan.pengeluaran.index', ['pengeluaran' => $pengeluaran, 'totalPerTahun' => $totalPerTahun, 'totalPerHari' => $totalPerHari]);
   }

   public function postPengeluaran(Request $request, Pengeluaran $pengeluaran) {
    $data = $pengeluaran->create($request->all());
    return response()->json($data);
   }

   public function getHapusPengeluaran(Request $request, Pengeluaran $pengeluaran) {
         $data = $pengeluaran->find($request->id)->delete();
         return response()->json($data);
   }

   public function postEditPengeluaran(Request $request, Pengeluaran $pengeluaran) {
      $data = $pengeluaran->find($request->id)->update($request->all());
      return response()->json($data);
   }

  public function exportExcelPengeluaran(Request $request, $type) {
          Excel::create('Pengeluaran Bulan ' . $request->bulan . ' Tahun '. $request->tahun, function ($excel) use($request){
            $excel->sheet('Pengeluaran Bulan ' . $request->bulan . ' Tahun '. $request->tahun, function ($sheet)  use($request){
                $pengeluaran = Pengeluaran::whereMonth('tgl_pengeluaran', $request->bulan)
                                          ->whereYear('tgl_pengeluaran', $request->tahun)
                                          ->get()->toArray();
                $arr = array();
                foreach ($pengeluaran as $data) {
                    $data_arr = array(
                        date('d-F-Y', strtotime($data['tgl_pengeluaran'])),
                        $data['jumlah_uang'],
                        $data['keterangan'],
                    );
                    array_push($arr, $data_arr);
                }
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                    'Tanggal Pengeluaran',
                    'Jumlah Uang',
                    'Keterangan'
                ));
            });
        })->download($type);
   }

   public function exportPDFPengeluaran(Request $request) {
         $bulan = $request->bulan;
         $tahun = $request->tahun;

         $pengeluaran = Pengeluaran::whereMonth('tgl_pengeluaran', '=', $bulan)
                                    ->whereYear('tgl_pengeluaran', '=', $tahun)
                                    ->get()->toArray();
            // dd($pemasukan);
         $pdf = PDF::loadView('keuangan.pengeluaran.pdf', ['pengeluaran' => $pengeluaran, 'bulan' => $bulan, 'tahun' => $tahun])->setPaper('a4');
        // $pdf = PDF::render();
        return $pdf->stream('Data Pengeluaran ' . $bulan .'-'. $tahun  . '.pdf');
   }

   public function exportPrintPengeluaran(Request $request) {
        $bulan = $request->bulan;
         $tahun = $request->tahun;

         $pengeluaran = Pengeluaran::whereMonth('tgl_pengeluaran', '=', $bulan)
                                    ->whereYear('tgl_pengeluaran', '=', $tahun)
                                    ->get();
            // dd($pemasukan->sum('jumlah_uang'));
            return view('keuangan.pengeluaran.print', [
                    'pengeluaran' => $pengeluaran,
                    'bulan' => $bulan,
                    'tahun' => $tahun
              ]);
   }
}
