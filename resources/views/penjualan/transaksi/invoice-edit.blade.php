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
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Edit Invoice ({{ $invoice_id }})
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <form  method="post" id="frm-invoice-edit">
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <div class="form-group">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tgl_transaksi" class="form-control" value="{{ $transaksi[0]['tgl_transaksi'] }}">
              <input type="hidden" name="invoice_id" value="{{ $invoice_id }}">
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-6">
        {{-- <a class="btn btn-primary btn-flat"  role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapseExample">
            Tambah Barang <i class="fa fa-plus"></i>
        </a> --}}

          <div class="collapse" id="collapse-tambah" style="margin-top: 5px">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Pilih Barang</h3>
                </div>
                  <div class="panel-body">

                      <div class="form-group">
                        <label class="sr-only" for="">Pilih Barang</label>
                        <select name="barang" class="form-control select2" id="barang_id" style="width: 100% !important" required="required">
                          <option disabled="" selected="">- Pilih Barang -</option>
                          @foreach($barang as $data)
                              <option value="{{$data['id']}}">{{$data['nama_barang']}}</option>
                          @endforeach
                        </select>
                      </div>
                      <a class="btn btn-primary btn-pilih">Pilh</a>
                  </div>
              </div>
          </div>

          <table class="table table-striped">
            <thead>
            <tr>
              <th>No. </th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Total Per Item</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody id="daftar">
            {{ csrf_field() }}
            <?php $no = 1; $angka = 1; $a = 1; $b =1; $c = 1;$e=1;$d = 0;$f=1;$g=1;$h=1;?>
            @foreach($transaksi as $trans)
		<tr class="baris-{{$trans['id']}}" data-id={{$a++}} >
			<td>{{ $no++ }}</td>
			<td>
                        {{ $trans['barang']['nama_barang'] }}
                        <input type="hidden" name="barang_id[]" class="data-barang" value="{{$trans['barang']['id']}}">
                        <input type="hidden" name="transaksi_id[]" value="{{$trans['id']}}">
                   </td>
            			<td id="harga-{{$b++}}">{{ $trans['barang']['harga_jual'] }}</td>
            			<td><input type="text" name="qty[]" value="{{ $trans['qty'] }}" class="form-control" id="input-qty-{{$angka++}}"></td>
            			<td id="harga-lama-{{$e++}}"><input type="text" name="harga_jual-{{$d++}}" class="data-harga input-harga_jual-{{$f++}} form-control" readonly="" value="{{ $trans['barang']['harga_jual'] }}"></td>
                                <td>
                        {{-- <a href="#!" class="btn btn-danger btn-flat btn-hapus" data-id="{{$d++}}"><i class="fa fa-times"></i></a> --}}
                        <a href="#!" class="btn btn-danger btn-flat btn-hapus" data-id="{{ $trans['id'] }}"><i class="fa fa-times"></i></a>
                    </td>
		</tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Total Bayar</p>

          <div class="table-responsive">
            <table class="table" id="table-total">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td id="sub-total">{{ $transaksi[0]['total_bayar'] }}</td>
              </tr>
              <tr>
                <th>Total Bayar:</th>
                <td id="total"><input type="text" name="total_bayar" class="form-control" required="" value="{{$transaksi[0]['total_bayar']}}" id="total_bayar" readonly=""></td>
              </tr>
              <tr>
                <th>Jumlah Bayar : </th>
                <td><input type="text" name="jumlah_bayar" class="form-control" required="" value="{{$transaksi[0]['jumlah_bayar']}}" id="bayar"></td>
              </tr>
              <tr>
                <th>Kembalian : </th>
                <td><input type="text" name="kembalian" class="form-control" required="" value="{{$transaksi[0]['kembalian']}}" readonly="" id="kembalian"></td>
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
          <button type="submit" class="btn btn-warning pull-right btn-edit btn-flat">Simpan Perubahan <i class="fa fa-edit"></i>
          </button>
          {{-- <a class="btn btn-info btn-flat btn-print pull-right" style="margin-right: 10px">Print Ulang <i class="fa fa-print"></i></a> --}}
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
  <script src="{{URL::to('node_modules/preloader-js/assets/preloader.js')}}"></script>
  <script type="text/javascript">
      $(document).ready(function() {
        // var preloader = $('.preloader');
        // preloader.hide();
        //  // === Print Invoice === //
        //   $('.btn-print').on('click', function(e) {
        //     e.preventDefault();
        //     preloader.show();
        //     $.get("{{route('invoicePDF', $invoice_id)}}", function(data) {
        //       preloader.hide();
        //       if (data === true) {
        //         toastr.success('Success !', 'Print Invoice berhasil !');
        //       }else {
        //         toastr.error('Danger !', 'Print Invoice Gagal !');
        //       }
        //     })
        //   });

          // $('.btn-pilih').on('click', function(e) {
          //   e.preventDefault();
          //   var id = $('#barang_id').val();
          //   var table = ' ';
          //   var no = $('#daftar').find('tr').length;
          //   // alert(no+1);
            // $.get("route('getDataBarang')}}", {id:id}, function(data) {
          //     // alert(data.harga_jual);
          //       table += '<tr class="baris-'+(no+1)+'" data-id='+(no+1)+' ><td>'+(no+1)+'</td><td>'+data.nama_barang+' <input type="hidden" name="barang_id[]" value="'+data.id+'"></td><td id="harga-'+(no+1)+'">'+data.harga_jual+'</td><td><input type="text" name="qty[]" value="1" class="form-control" id="input-qty-'+(no+1)+'"></td><td id="harga-lama-'+(no+1)+'"><input type="text" name="harga_jual-'+(no+1)+'" class="input-harga_jual-'+(no+1)+' data-harga form-control" readonly="" value="'+data.harga_jual+'"></td><td><a href="#!" class="btn btn-danger btn-flat btn-hapus" data-id="'+(no+1)+'"><i class="fa fa-times"></i></a></td></tr>';
          //     $('#daftar').append(table);
          //   });
          // });

          $('.btn-hapus').click(function() {
            var id = $(this).data('id');
            $.confirm({
                    title: 'Alert !',
                    content: 'Apakah anda yakin ingin menghapus data ini ?',
                    buttons: {
                        confirm: function () {
                            toastr.success('Success !', 'Data berhasil di hapus');
                            $.get("{{ route('getOneTransDelete') }}", {id: id}, function (data) {
                              location.reload();
                            });
                        },
                        cancel: function () {
                            $.alert('Batal!');
                        },
                    }
                });
          });

          // $('#daftar').on('click', '.btn-hapus', function(e) {
          //   e.preventDefault();
          //   var id = $(this).data('id');
          //   // alert(id);
          //   var baris = $('#daftar tr.baris-'+id).remove();
          //   return false;
          // });

          $('#daftar').on('click', 'tr',function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            // alert(id);
            $(this).on('keyup', '#input-qty-'+id, function() {
              var nilai = $(this).val();
              var harga = $('#harga-'+id).text();
              // alert(harga);
              var hasil = parseFloat(harga) * parseFloat(nilai);
              // $('#harga-lama-'+id).text(hasil);
              $('.input-harga_jual-'+id).val(hasil);

              var arr = {};
              $('.data-harga').each(function() {
                  arr[$(this).attr('name')] = $(this).val();
              });

              var total = 0;
             $.each(arr,function(){total+=parseFloat(this) || 0;})
             $('#sub-total').text(total);
             $('#total_bayar').val(total);

            });
          });

          $('#table-total').on('keyup', '#bayar', function() {
              var total_bayar = $('#table-total').find("input[name='total_bayar']").val();
                var bayar = $('#bayar').val();
                // alert(total_bayar + ' ' + bayar);
                var hasil =   parseFloat(bayar) - parseFloat(total_bayar);
                // alert(hasil);
                  $('#kembalian').val(hasil);
                // }
          });

          $('#frm-invoice-edit').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            // console.log(data);
            $.post("{{ route('postTransaksiEdit') }}", data, function(data) {
              toastr.success('Success !', 'Data berhasil di update !');
              $('.btn-edit').prop('disabled', true);
            });
          });
          var barang_id = {};
          $('.data-barang').each(function() {
            barang_id[$(this).attr('name')] = $(this).val();
          });
          // console.log(barang_id);
      });

  </script>
@endsection