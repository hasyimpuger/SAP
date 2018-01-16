@extends('layouts.app')
@section('customCss')
  <link rel="stylesheet" href="{{URL::to('node_modules/preloader-js/assets/css/preloader.css')}}">
@endsection
@section('content')
{{-- preloader --}}
{{-- <div class="preloader">
  <div class="animation animation-rotating-square"></div>
</div> --}}
<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="margin-left: 120px;margin-bottom: 40px">
      <img src="{{ URL::to('photo/toko/', Auth::user()->getPhoto()) }}" width="150" height="150" style="float: left;margin: 0 40px">
      <div style="float: left;text-align: center;">
        <h2>
        {{ $toko->nama_toko }}
        </h2>
        <strong>{{$toko->deskripsi}}</strong><br>
        {{ $toko->alamat }} <br>
        No.Telp : {{ $toko->telp }} <br>
        Email: {{ $toko->email }} <br>
      </div>
    </div>
  </div>
  {{-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align: center;">

  </div> --}}
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <p class="lead">Daftar Barang</p>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No. </th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total Per Item</th>
          </tr>
        </thead>
        <tbody>
          <form action="{{ route('postTransaksi') }}" method="post" id="frm-transaksi" target="_blank">
            {{-- <form id="frm-transaksi" target="_blank"> --}}
              {{ csrf_field() }}
              <input type="hidden" name="tgl_transaksi" value="{{date('Y-m-d')}}" id="tgl_transaksi">
              <?php $no = 1; ?>
              @for($i = 0;$i < count($barang_id); $i++)
              {{-- {{ dd(count($bar)) }} --}}
              <input type="hidden" name="barang_id[]" value="{{$barang_id[$i]}}" id="barang_id">
              <input type="hidden" name="qty[]" value="{{$qty[$i]}}" id="qty">
              <input type="hidden" name="invoice_id[]" value="{{$invoice_id}}" id="invoice_id">
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $nama_barang[$i] }}</td>
                <td>{{ $harga_jual[$i] }}</td>
                <td>{{ $qty[$i] }}</td>
                <td>Rp. {{ $harga_jual[$i] * $qty[$i] }}</td>
              </tr>
              @endfor
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.col -->
      <div class="row">
        <div class="col-xs-12">
          <p class="lead">Total Bayar</p>
          <div class="table-responsive">
            <table class="table">
              @if($nama_pelanggan)
                <tr>
                  <th style="width:50%">Nama Pelanggan :</th>
                  <td>
                    <strong>{{ $nama_pelanggan }}</strong>
                    <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="{{$id_pelanggan}}">
                  </td>
                </tr>
              @endif
              <tr>
                <th style="width:50%">Tanggal Transaksi :</th>
                <td><strong>{{ date('d / F / Y') }}</strong></td>
              </tr>
              <tr>
                <th style="width:50%">ID Customer:</th>
                <td><strong>({{ $invoice_id }})</strong></td>
              </tr>
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rp. {{ array_sum($sub_total) }}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>Rp. {{ array_sum($sub_total) }} <input type="hidden" name="total_bayar" value="{{ array_sum($sub_total) }}" id="total_bayar"></td>
              </tr>
              <tr>
                <th>Jumlah Bayar :</th>
                <td><input type="text" id="bayar" name="jumlah_bayar" onkeyup="sum()" class="form-control" required=""></td>
              </tr>
              <tr>
                <th>Jumlah Kembalian :</th>
                <td id="kembalian"></td>
                <input type="hidden" name="kembalian" id="kembalian-input">
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{route('transaksi.index')}}" class="btn btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
          {{-- <a href="{{ route('invoicePDF') }}" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Print</a> --}}
          <button type="submit"  class="btn btn-success btn-flat pull-right simpan"><i class="fa fa-credit-card"></i> Simpan Pembayaran
          </button>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content -->
  @endsection
  @section('customJs')
  {{-- <script src="{{URL::to('node_modules/preloader-js/assets/preloader.js')}}"></script> --}}
  <script type="text/javascript">
    var k = $('#kembalian').text(0);
          function sum() {
            var total_bayar = $('#total_bayar').val();
            var bayar = $('#bayar').val();
            var hasil =   parseFloat(bayar) - parseFloat(total_bayar);
            if (!isNaN(hasil)) {
            $('#kembalian').text('Rp. '+hasil);
            $('#kembalian-input').val(hasil);
          }
        }
    // $(document).ready(function() {
    //     var preloader = $('.preloader');
    //     preloader.hide();
    //   $('.simpan').click(function(e) {
    //     e.preventDefault();
    //     preloader.show();
    //       var data = $('#frm-transaksi').serialize();
    //       $.post("{{ route('postTransaksi') }}", data, function(data) {
    //     preloader.hide();
    //          if (data == true) {
    //              $('.simpan').attr('disabled', true);
    //              toastr.success('Success !', 'Data berhasil di simpan !');
    //          }else {
    //              toastr.error('Danger !', 'Transaksi Gagal');
    //          }
    //       });
    //   });
    // });
  </script>
  @endsection