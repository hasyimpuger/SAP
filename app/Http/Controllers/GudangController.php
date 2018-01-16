<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Distributor;
use App\HistoryStok;
use App\Kategori;
use App\Pengeluaran;
use Crypt;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use PDF;

class GudangController extends Controller
{

    //barang
    public function getBarang(){
        $totalBarang = Barang::select(['id', 'stok'])->get();
        $barang = Barang::with(['kategori', 'distributor'])->orderBy('tgl_masuk', 'desc')->get()->toArray();
        $barang2 = Barang::select(['stok', 'nama_barang'])
                            ->whereMonth('tgl_masuk', date('m'))
                            ->whereYear('tgl_masuk', date('Y'))
                            ->get()->toJson();
        $kategori = Kategori::get()->toArray();
        $distributor = Distributor::get()->toArray();
        // dd($barang);
        return view('gudang.barang.index', [
            'totalBarang' => $totalBarang,
            'barang' => $barang,
            'barang2' => $barang2,
            'kategori' => $kategori,
            'distributor'   =>  $distributor
        ]);
    }

    public function getStokBarang() {
        $barang = Barang::with(['kategori', 'distributor'])->where('stok','<=', 3)->get()->toArray();
        $id_barang = [];
        foreach ($barang as $key => $value) {
            array_push($id_barang,$value['id']);
        }
        $data = Barang::with(['kategori', 'distributor'])->whereNotIn('id', $id_barang)->orderBy('stok', 'desc')->get()->toArray();
        return view('gudang.stok-barang.stok-barang', [
            'barang' => $barang,
            'data' => $data
        ]);
    }

    public function postStokBarangEdit(Request $request) {
        // dd($request->all());
        $beli = $request->jumlah_beli_stok;
        $stok_sekarang = $request->stok;
        $hasil = $beli + $stok_sekarang;

        $dataBarang = Barang::find($request->id);
        $barang = $dataBarang->update(['stok' => $hasil]);
        $pengeluaran = Pengeluaran::create([
            'tgl_pengeluaran' => date('Y-m-d'),
            'jumlah_uang' => $request->biaya_pengeluaran,
            'keterangan' => 'Pembelian Stok ' . $request->nama_barang
        ]);

        // add stok to history
        $history = HistoryStok::create([
            'barang_id' => $dataBarang['id'],
            'beli_stok' => $stok_sekarang,
            'total_biaya' => $request['biaya_pengeluaran'],
            'tgl_history' => date('Y-m-d'),
            'keterangan' => 'Pembelian Stok'
        ]);
        return redirect()->back();
    }

    public function postBarang(Request $request) {
        $data = new Barang();
        $data->nama_barang = $request['nama_barang'];
        $data->kategori_id = $request['kategori_id'];
        $data->harga_beli = $request['harga_beli'];
        $data->harga_jual = $request['harga_jual'];
        $data->harga_reseller = $request['harga_reseller'];
        $data->distributor_id = $request['distributor_id'];
        $data->stok = $request['stok'];
        $data->tgl_masuk = $request['tgl_masuk'];

        $kategori = Kategori::where('id', $request['kategori_id'])->first();
        $distributor = Distributor::where('id', $request['distributor_id'])->first();
        $barcode = 'Nama Barang : '. $request['nama_barang'] .'                     '.
                            'Kategori : '. $kategori['kategori'] .'                     '.
                            'Harga Beli  : '. $request['harga_beli'] .'                     '.
                            'Harga Jual : '. $request['harga_jual'] .'                      '.
                            'Harga Reseller : '. $request['harga_reseller'] .'                      '.
                            'Distributor : '. $distributor['nama_distributor'] .'                       '.
                            'Stok : '. $request['stok'] .'                                                              '.
                            'Tgl. Masuk : '. $request['tgl_masuk'];
        $hasil = Crypt::encryptString($barcode);
        // // echo $barcode .'<br>';
        // echo 'panjang'. strlen($hasil) .'<br>';
        // echo Crypt::decrypt($hasil);
        // die();
        $data->barcode = $hasil;
        $data->save();

        // add barang to history
        $barang_id = Barang::orderBy('id', 'desc')->first();
        $history = HistoryStok::create([
            'barang_id' => $barang_id['id'],
            'beli_stok' =>  $request['stok'],
            'total_biaya' => $request['harga_beli'] * $request['stok'],
            'tgl_history' => date('Y-m-d'),
            'keterangan' => 'Penambahan Barang Baru'
        ]);

        return redirect()->route('barang.index');
    }

    public function postBarangEdit(Request $request) {
        $data = $request->except('_token');
        // dd($data);
        $barang = Barang::where('id', $data['id']);
        $barang->update($data);
        return redirect()->back();
    }

    // Kategori
    public function postKategori(Request $request, Kategori $jenisBarang) {
        if ($request->ajax()) {
            return response($jenisBarang->create($request->all()));
        }
    }

    public function getKategori() {
        $kategori = Kategori::get()->toArray();
        return view('gudang.kategori.index', ['kategori' => $kategori]);
    }

    public function postDataKategori(Request $request, Kategori $kategori) {
        if ($request->ajax()) {
            return response($kategori->create($request->all()));
        }
    }

    public function postKategoriDelete(Request $request, Kategori $kategori) {
        if ($request->ajax()) {
             $data = $kategori->find($request->id)->delete();
             return response()->json($data);
        }
    }

    public function postKategoriUpdate(Request $request, Kategori $kategori) {
        if ($request->ajax()) {
            $data = $kategori->find($request->id)->update($request->all());
            return response()->json($data);
        }
    }

    public function getHapusBarang(Request $request) {
        $barang = Barang::find($request->id)->delete();
        return redirect()->back();
    }

    public function exportBarang(Request $request, $type) {
        // dd($data);
        Excel::create('Data Barang Bulan '.$request->bulan. ' Tahun' .$request->tahun,  function ($excel) use($request){
            $excel->sheet('Data Barang Bulan '.$request->bulan. ' Tahun' .$request->tahun, function ($sheet)  use($request){
                  $bulan = $request->bulan;
                  $tahun = $request->tahun;
                $arr = array();
                $barang = Barang::with(['kategori', 'distributor'])
                                   ->whereMonth('tgl_masuk', $bulan)
                                   ->whereYear('tgl_masuk', $tahun)
                                   ->get()->toArray();
                foreach ($barang as $data) {
                    $data_arr = array(
                        $data['nama_barang'],
                        $data['kategori']['kategori'],
                        $data['harga_beli'],
                        $data['harga_jual'],
                        $data['stok'],
                        date('d-F-Y', strtotime($data['tgl_masuk'])),
                        $data['distributor']['nama_distributor']
                    );
                    array_push($arr, $data_arr);
                }
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                    'Nama Barang',
                    'Kategori Id',
                    'Harga Beli',
                    'Harga Jual',
                    'Stok',
                    'Tgl Masuk',
                    'Distributor Id'
                ));
            });
        })->download($type);

    }

    public function importBarang(Request $request) {
        // dd($request->all());
             if ($request->hasFile('import_file')) {
                    $path = $request->file('import_file')->getRealPath();
                    $data = Excel::load($path, function($render) {
                        Barang::select(['nama_barang', 'kategori_id', 'harga_beli', 'harga_jual', 'stok', 'distributor_id', 'tgl_masuk'])->insert($render->toArray());
                    });

                    return redirect()->back();
            }
    }

    public function exportBarangPDF(Request $request) {
         $bulan = $request->bulan;
         $tahun = $request->tahun;
         $barang = Barang::with(['kategori', 'distributor'])
                            ->whereMonth('tgl_masuk', $bulan)
                            ->whereYear('tgl_masuk', $tahun)
                            ->get()->toArray();
         $pdf = PDF::loadView('gudang.barang.pdf', ['barang' => $barang,'bulan' => $bulan, 'tahun' =>$tahun])->setPaper('a4');
        // $pdf = PDF::render();
        return $pdf->stream('Data Barang ' . $bulan. '-' . $tahun . '.pdf');
    }



    //---Distributor---//
    public function getDistributor() {
        $distributor = Distributor::get()->toArray();
        return view('gudang.distributor.index', [
            'distributor' => $distributor
        ]);
    }

    public function postDistributor(Request $request) {
       // dd($request->all());
        $data = new Distributor();
        $data->nama_distributor = $request->nama_distributor;
        $data->alamat = $request->alamat;
        $data->telp = $request->telp;
        $data->kode_pos = $request->kode_pos;
        $data->deskripsi = $request->deskripsi;
        if ($request->hasFile('photo')) {
            $file       =   $request->file('photo');
            $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
            $location   =   public_path('photo/distributor/'. $fileName);
            Image::make($file)->resize(800, 400)->save($location);
            $data->photo  =  $fileName;
        }
        $data->save();

        return redirect()->route('distributor.index');
    }

    public function postEditDistributor(Request $request) {
       // dd($request->all());
        $data = Distributor::find($request->id);
//        dd($data);
        $data->nama_distributor = $request->nama_distributor;
        $data->telp = $request->telp;
        $data->kode_pos = $request->kode_pos;
        $data->alamat = $request->alamat;
        $data->deskripsi = $request->deskripsi;
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
            $location   =   public_path('photo/distributor/'. $fileName);
            Image::make($file)->resize(800, 400)->save($location);
            //gambar lama
            $oldFileName = $data->photo;
            //gambar baru
            $data->photo = $fileName;
            //hapus gambar lama
            Storage::delete($oldFileName);

        }
        $data->save();
        return redirect()->back();
    }

    public function getDeleteDistributor(Request $request) {
        $data = Distributor::find($request->id)->delete();
        return response()->json($data);
    }

    public function exportExcelDistributor($type) {
            Excel::create('Data Distributor ' . date('F-Y'), function ($excel){
                $excel->sheet('Data Distributor ' . date('F-Y'), function ($sheet){
                    $arr = array();
                    $barang = Distributor::get()->toArray();
                    foreach ($barang as $data) {
                        $data_arr = array(
                            $data['nama_distributor'],
                            $data['telp'],
                            $data['alamat'],
                            $data['kode_pos'],
                            $data['deskripsi'],
                        );
                        array_push($arr, $data_arr);
                    }
                    $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'Nama Distributor',
                        'No. Telp',
                        'Alamat',
                        'Kode Pos',
                        'Deskripsi',
                    ));
                });
            })->download($type);
    }

    public function exportDistributorPDF() {
        $distributor = Distributor::get()->toArray();

         $pdf = PDF::loadView('gudang.distributor.pdf', ['distributor' => $distributor])->setPaper('a4');
        // $pdf = PDF::render();
        return $pdf->stream('Data Distributor ' . date('F-Y') . '.pdf');
    }

    // History
    public function getHistory() {
        $history = HistoryStok::with('barang')->orderBy('created_at', 'desc')->get()->toArray();
        return view('gudang.history.index', ['history' => $history]);
    }

    public function postCariHistory(Request $request) {
        $history = HistoryStok::with(['barang.distributor', 'barang.kategori'])->whereBetween('tgl_history', [$request['start'], $request['end']])->get()->toArray();
        return view('gudang.history.detail', ['history' => $history]);
    }

    public function getHistoryDetail($id) {
        $history = HistoryStok::with('barang')->find($id);
        if ($history == null) {
            abort(404);
        }
        return view('gudang.history.detail',['history' => $history]);
    }
}
