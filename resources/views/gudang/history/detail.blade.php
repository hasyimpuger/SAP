@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(count($history) == 1)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail History</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td><b>Tanggal & Waktu</b></td>
                                <td>:</td>
                                <td><b>{{date('d/m/Y - H:i:s A', strtotime($history['created_at']))}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Nama Barang</b></td>
                                <td>:</td>
                                <td><b>{{$history['barang']['nama_barang']}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Pembelian Stok</b></td>
                                <td>:</td>
                                <td><b>{{$history['beli_stok']}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Biaya yang Dikeluarkan</b></td>
                                <td>:</td>
                                <td><b>Rp. {{number_format($history['total_biaya'])}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Keterangan</b></td>
                                <td>:</td>
                                <td><b>{{$history['keterangan']}}</b></td>
                            </tr>
                            <tr>
                                <td>Stok Barang saat ini</td>
                                <td>:</td>
                                <td>{{$history['barang']['stok']}}</td>
                            </tr>
                            <tr>
                                <td>Harga Beli</td>
                                <td>:</td>
                                <td>Rp. {{number_format($history['barang']['harga_beli'])}}</td>
                            </tr>
                            <tr>
                                <td>Harga Jual</td>
                                <td>:</td>
                                <td>Rp. {{number_format($history['barang']['harga_jual'])}}</td>
                            </tr>
                            <tr>
                                <td>Nama Distributor</td>
                                <td>:</td>
                                <td>{{$history['barang']['distributor']['nama_distributor']}}</td>
                            </tr>
                            <tr>
                                <td>Kategori Barang</td>
                                <td>:</td>
                                <td>{{$history['barang']['kategori']['kategori']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
            @foreach($history as $data)
                <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail History</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td><b>Tanggal & Waktu</b></td>
                                <td>:</td>
                                <td><b>{{date('d/m/Y - H:i:s A', strtotime($data['created_at']))}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Nama Barang</b></td>
                                <td>:</td>
                                <td><b>{{$data['barang']['nama_barang']}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Pembelian Stok</b></td>
                                <td>:</td>
                                <td><b>{{$data['beli_stok']}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Biaya yang Dikeluarkan</b></td>
                                <td>:</td>
                                <td><b>Rp. {{number_format($data['total_biaya'])}}</b></td>
                            </tr>
                            <tr>
                                <td><b>Keterangan</b></td>
                                <td>:</td>
                                <td><b>{{$data['keterangan']}}</b></td>
                            </tr>
                            <tr>
                                <td>Stok Barang saat ini</td>
                                <td>:</td>
                                <td>{{$data['barang']['stok']}}</td>
                            </tr>
                            <tr>
                                <td>Harga Beli</td>
                                <td>:</td>
                                <td>Rp. {{number_format($data['barang']['harga_beli'])}}</td>
                            </tr>
                            <tr>
                                <td>Harga Jual</td>
                                <td>:</td>
                                <td>Rp. {{number_format($data['barang']['harga_jual'])}}</td>
                            </tr>
                            <tr>
                                <td>Nama Distributor</td>
                                <td>:</td>
                                <td>{{$data['barang']['distributor']['nama_distributor']}}</td>
                            </tr>
                            <tr>
                                <td>Kategori Barang</td>
                                <td>:</td>
                                <td>{{$data['barang']['kategori']['kategori']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endforeach
            {{-- <span class="pull-right">
                {{$history->render()}}
            </span> --}}
        @endif
    </div>
</div>
@endsection