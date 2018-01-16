@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count($totalTransaksi) }}</h3>

                    <p>Total Transaksi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div> 
        </div>
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ count($transaksiHariIni) }}</h3>

                    <p>Transaksi Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fa fa-handshake-o"></i>
                </div>
            </div>
        </div> 
    </div>
        <div class="row">   
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a class="btn btn-primary btn-flat" id="col-barang" role="button" data-toggle="collapse" href="#collapse-transaksi" aria-expanded="false" aria-controls="collapseExample">
            Tambah Transaksi <i class="fa fa-plus"></i>
        </a>
        <a class="btn btn-warning btn-flat" id="col-barang" role="button" data-toggle="collapse" href="#collapse-transaksi-pelanggan" aria-expanded="false" aria-controls="collapseExample">
            Tambah Transaksi Pelanggan <i class="fa fa-plus"></i>
        </a>
        <a class="btn btn-success btn-flat" role="button" data-toggle="collapse" href="#collapse-exportExcel" aria-expanded="false" aria-controls="collapseExample">
            Export to Excel <i class="fa fa-file-excel-o"></i>
        </a>
        <a class="btn btn-danger btn-flat" role="button" data-toggle="collapse" href="#collapse-exportPDF" aria-expanded="false" aria-controls="collapseExample">
            Export to PDF <i class="fa fa-file-pdf-o"></i>
        </a>
        <a class="btn btn-info btn-flat" role="button" data-toggle="collapse" href="#collapse-laporan" aria-expanded="false" aria-controls="collapseExample">
            Buat Laporan <i class="fa fa-file"></i>
        </a>

        @include('penjualan.transaksi.collapse-transaksi')
        @include('penjualan.transaksi.collapse-transaksi-pelanggan')
        @include('penjualan.transaksi.collapse-exportExcel')
        @include('penjualan.transaksi.collapse-PDF')
        @include('penjualan.transaksi.collapse-laporan')
        <div class="panel panel-default" style="margin-top: 5px;">
            <div class="panel-heading">
                <h3 class="panel-title">Data Transaksi</h3>
            </div>
            <div class="panel-body">
                @include('penjualan.transaksi.table')
            </div>
            </div>
        </div>
        </div>
@endsection

@section('customJs')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.list-barang').change(function() {
                  $('.list-barang option:selected').each(function() {
                            var id = $(this).data('id');
                            var nama = $(this).data('nama');
                            var harga_jual = $(this).data('harga_jual');
                            var stok = $(this).data('stok');
                            
                            if ($(id == id)) {
                                $('.sub-barang'+id).remove();
                                var data = '<tr class="baris' +id+ '"></td><td>'+nama+' <input type="hidden" name="id_barang[]" value="'+id+'" /><input type="hidden" name="harga_jual[]" value="'+harga_jual+'" /><input type="hidden" name="nama_barang[]" value="'+nama+'" /></td><td class="harga_jual" data-harga="'+harga_jual+'">'+harga_jual+'</td><td>'+stok+'</td><td><input type="text" name="qty[]" value="1" class="form-control qty" /></td><td><center><a href="#!" class="btn btn-danger btn-flat hapus"><i class="fa fa-window-close"></i></a></center></td></tr>';
                                $('#selected-barang').append(data);       
                            }

                            $('.hapus').on('click', function() {
                                var option = '<option class="sub-barang'+id+'" value="'+id+'"data-id="'+id+'" data-nama="'+nama+'" data-harga_jual="'+harga_jual+'" data-stok="'+stok+'">'+nama+'</option>';
                                $('.list-barang').append(option);
                                $(this).closest('tr').remove();
                                return false;   

                            });
                  });
            });

            $('.list-barang-2').change(function() {
                  $('.list-barang-2 option:selected').each(function() {
                            var id = $(this).data('id');
                            var nama = $(this).data('nama');
                            var harga_jual = $(this).data('harga_jual');
                            var harga_reseller = $(this).data('harga_reseller');
                            var stok = $(this).data('stok');
                            
                            if ($(id == id)) {
                                $('.sub-barang'+id).remove();
                                var data = '<tr class="baris' +id+ '"></td><td>'+nama+' <input type="hidden" name="id_barang[]" value="'+id+'" /><input type="hidden" name="harga_jual[]" value="'+harga_jual+'" /><input type="hidden" name="harga_reseller[]" value="'+harga_reseller+'" /><input type="hidden" name="nama_barang[]" value="'+nama+'" /></td><td class="harga_jual" data-harga="'+harga_reseller+'">'+harga_reseller+'</td><td>'+stok+'</td><td><input type="text" name="qty[]" value="1" class="form-control qty" /></td><td><center><a href="#!" class="btn btn-danger btn-flat hapus-2"><i class="fa fa-window-close"></i></a></center></td></tr>';
                                $('#selected-barang-2').append(data);       
                            }

                            $('.hapus-2').on('click', function() {
                                var option = '<option class="sub-barang'+id+'" value="'+id+'"data-id="'+id+'" data-nama="'+nama+'" data-harga_jual="'+harga_jual+'" data-stok="'+stok+'">'+nama+'</option>';
                                $('.list-barang-2').append(option);
                                $(this).closest('tr').remove();
                                return false;   

                            });
                  });
            });
            // delete
            $('#mytable').on('click', '.btn-delete',function() {
                    var id = $(this).data('id');
                $.confirm({
                    title: 'Alert !',
                    content: 'Apakah anda ingin menghapus data ini ?',
                    buttons: {
                        confirm: function () {
                            $.get("{{ route('getTransaksiDelete') }}", {invoice_id: id}, function (data) {
                                toastr.success('Success !', 'Data berhasil di hapus');
                                location.href = "{{ route('transaksi.index') }}";
                            });
                        },
                        cancel: function () {
                            $.alert('Batal!');
                        },
                    }
                });
            }); 

            $('.daterangepicker').daterangepicker({
               locale: {
                  format: 'DD/MM/YYYY'
                },
            },
            function (start, end, label) {
                $('#frm-laporan').find('#start').val(start.format('YYYY-MM-DD'));
                $('#frm-laporan').find('#end').val(end.format('YYYY-MM-DD'));
            });
        })
    </script>
@endsection