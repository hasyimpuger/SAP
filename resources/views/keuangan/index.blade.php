@extends('layouts.app')
{{-- {{dd($pemasukan)}} --}}
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- small box -->
        <a href="{{ route('getPemasukan') }}">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Pemasukan</h3>
                    <p>Total Semua Pemasukan : Rp. {{ count($pemasukan) != 0 ? number_format($pemasukan->sum('jumlah_uang')) : '0'}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-download"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="{{route('getPengeluaran')}}">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Pengeluaran</h3>
                    <p>Total Semua Pengeluaran : Rp. {{ count($pengeluaran) != 0 ? number_format($pengeluaran->sum('jumlah_uang')) : '0'}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- small box -->
        <a href="{{ route('getPemasukan') }}">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Total Pemasukan Hari ini</h3>
                    <h4>Rp. {{ count($totalPemasukanHariIni) != 0 ? number_format($totalPemasukanHariIni->sum('jumlah_uang')) : '0'}}</h4>
                </div>
                <div class="icon">
                    <i class="fa fa-download"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="{{route('getPengeluaran')}}">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Total Pengeluaran Hari ini</h3>
                    <h4>Rp. {{ count($totalPengeluaranHariIni) != 0 ? number_format($totalPengeluaranHariIni->sum('jumlah_uang')) : '0'}}</h4>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- small box -->
        <a href="{{ route('getPemasukan') }}">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Total Pemasukan Bulan ini</h3>
                    <h4>Rp. {{ count($totalPemasukanBulanIni) != 0 ? number_format($totalPemasukanBulanIni->sum('jumlah_uang')) : '0'}}</h4>
                </div>
                <div class="icon">
                    <i class="fa fa-download"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="{{route('getPengeluaran')}}">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Total Pengeluaran Bulan ini</h3>
                    <h4>Rp. {{ count($totalPengeluaranBulanIni) != 0 ? number_format($totalPengeluaranBulanIni->sum('jumlah_uang')) : '0'}}</h4>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- small box -->
        <a href="#!">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Saldo Akhir</h3>
                    <p>Total Rp. {{ number_format($hasil) }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!-- small box -->
        <a href="{{route('laba.index')}}">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>Laba Bulan Ini</h3>
                    <p>Total Rp. {{ number_format($laba) }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-balance-scale"></i>
                </div>
            </div>
        </a>
    </div>
</div>
{{-- <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail Saldo tahun 2017</h3>
            </div>
            <div class="panel-body">
                <div id="chart-saldo" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>  --}}
@endsection
@section('customJs')
<script type="text/javascript">
$(document).ready(function() {
// dd()
//     // console.log(saldo);
//     Morris.Line({
//           // ID of the element in which to draw the chart.
//           element: 'chart-saldo',
//           // Chart data records -- each entry in this array corresponds to a point on
//           // the chart.
//           data: saldo,
//           // The name of the data record attribute that contains x-values.
//           xkey: 'bulan',
//           // A list of names of data record attributes that contain y-values.
//           ykeys: 'jumlah_uang',
//           // Labels for the ykeys -- will be displayed when you hover over the
//           // chart.
//           labels: 'Value',
//           hideHover: 'auto',
//           resize: true
//         });
});
</script>
@endsection