@extends('layouts.app')
@section('content')
@include('gudang.stok-barang.modal-stok-barang-edit')
<a href="#collapse-tambah" data-toggle="collapse" class="btn btn-primary btn-flat">Tambah Stok Lainnya <i class="fa fa-plus"></i></a>
@include('gudang.stok-barang.collapse-tambah')
<div class="panel panel-default" style="margin-top: 5px" id="panel-barang">
    <div class="panel-heading">
        <h3 class="panel-title">Daftar Barang Stok Menipis</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped tabled-bordered" id="datatable">
                <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Distributor</th>
                    <th>Stok Barang</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($barang as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data['nama_barang'] }}</td>
                        <td>{{ $data['kategori']['kategori'] }}</td>
                        <td>{{ $data['harga_beli'] }}</td>
                        <td>{{ $data['harga_jual'] }}</td>
                        <td>{{ $data['distributor']['nama_distributor'] }}</td>
                        <td>{{ $data['stok'] }}</td>
                        <td data-id="{{ $data['id'] }}">
                            <a class="btn btn-warning btn-sm btn-flat btn-edit" data-nama="{{$data['nama_barang']}}" data-stok="{{$data['stok']}}" data-id="{{$data['id']}}" data-harga_beli="{{$data['harga_beli']}}" data-toggle="modal" href="#modal-edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('customJs')
    <script type="text/javascript">
        $('#datatable').DataTable();
         $('#datatable').on('click','.btn-edit', function() {
               var id = $(this).data('id');
               var nama_barang = $(this).data('nama');
                                var stok = $(this).data('stok');
               var harga_beli = $(this).data('harga_beli');
                    $('#frm-edit').find("input[name='nama_barang']").val(nama_barang);
                    $('#frm-edit').find("input[name='stok']").val(stok);
                             $('#frm-edit').find("input[name='id']").val(id);
                    $('#frm-edit').find("input[name='harga_beli']").val(harga_beli);
                });
         $('#mytable').on('click','.btn-edit', function() {
               var id = $(this).data('id');
               var nama_barang = $(this).data('nama');
                                var stok = $(this).data('stok');
               var harga_beli = $(this).data('harga_beli');
                    $('#frm-edit').find("input[name='nama_barang']").val(nama_barang);
                    $('#frm-edit').find("input[name='stok']").val(stok);
                             $('#frm-edit').find("input[name='id']").val(id);
                    $('#frm-edit').find("input[name='harga_beli']").val(harga_beli);
                });

          $('#jumlah_beli_stok').keyup(function() {
               var stok = $(this).val();
               var harga_beli = $('#harga_beli').val();
               var hasil = harga_beli * stok;
               $('#biaya_pengeluaran').val(hasil);
           });

         $('#edit-barang').on('click', function() {
            toastr.success('Success !', 'Data berhasil di update !');
         })
    </script>
@endsection