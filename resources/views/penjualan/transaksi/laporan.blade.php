@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <a href="{{route('postLaporanPdf', [$start, $end])}}" class="btn btn-danger btn-flat btn-sm pull-right">Cetak PDF <i class="fa fa-file-pdf-o"></i></a>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Laporan Transaksi Per Tgl {{$start}} - {{$end}}</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl. Transaksi</th>
                                <th>Invoice ID</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{date('d-m-Y', strtotime($value['tgl_transaksi']))}}</td>
                                    <td>{{$value['invoice_id']}}</td>
                                    <td>{{$value['barang']['nama_barang']}}</td>
                                    <td>{{$value['qty']}}</td>
                                    <td>Rp. {{number_format($value['total_bayar'])}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection