@extends('layouts.app')
{{-- {{ dd(count($penjualan)) }} --}}
@section('content')
{{--Data Gudang--}}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Gudang</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ count($totalBarang) }}</h3>
                            <p>Total Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <a href="{{route('barang.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $totalBarang->sum('stok') }}</h3>
                            <p>Total Stok Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cube"></i>
                        </div>
                        <a href="{{route('barang.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">        {{-- Data Penjualan --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Distributor</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-12 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ count($distributor) }}</h3>
                            <p>Total Distributor</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <a href="{{ route('distributor.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
</div>
{{--Data Pembukuan--}}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Penjualan</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ count($penjualan) }}</h3>
                            <p>Total Semua Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-area-chart"></i>
                        </div>
                        <a href="{{route('transaksi.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ count($countPenjualan) }}</h3>
                            <p>Tansaksi Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-refresh"></i>
                        </div>
                        <a href="{{route('transaksi.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
</div>
{{-- Data Keuangan --}}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Keuangan</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Rp. {{ number_format($hasil) }}</h3>
                            <p>Saldo Akhir</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-balance-scale"></i>
                        </div>
                        <a href="{{route('getKeuangan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Rp. {{ number_format($laba) }}</h3>
                            <p>Laba Bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-balance-scale"></i>
                        </div>
                        <a href="{{route('getKeuangan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Pemasukan</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>Rp. {{ number_format($totalPemasukanHariIni->sum('jumlah_uang')) }}</h3>
                            <p>Total Pemasukan Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                        <a href="{{route('getPemasukan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>Rp. {{ number_format($totalPemasukanBulanIni->sum('jumlah_uang')) }}</h3>
                            <p>Total Pemasukan Bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-download"></i>
                        </div>
                        <a href="{{route('getPemasukan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Pengeluaran</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Rp. {{ number_format($totalPengeluaranHariIni->sum('jumlah_uang')) }}</h3>
                            <p>Total Pengeluaran Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                        <a href="{{route('getPengeluaran')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Rp. {{ number_format($totalPengeluaranBulanIni->sum('jumlah_uang')) }}</h3>
                            <p>Total Pengeluaran Bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                        <a href="{{route('getPengeluaran')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
</div>
{{-- Pengaturan --}}
@if(Auth::user()->level == 'admin')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Pengaturan Toko</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-8 col-xs-12 col-lg-offset-2">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Setting Toko</h3>
                            <p>&nbsp;</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-gears"></i>
                        </div>
                        <a href="{{route('setting.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif
@endsection