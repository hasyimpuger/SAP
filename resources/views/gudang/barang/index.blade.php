@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($totalBarang) }}</h3>

                    <p>Total Barang</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
            </div>
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $totalBarang->sum('stok') }}</h3>

                    <p>Total Stok Barang</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cube"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Barang Terbaru Bulan {{ date('F') }}</h3>
                </div>
                <div class="panel-body">
                    <div id="chart-barang" style="height: 250px;"></div>
                </div>
            </div>
        </div>
            
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a class="btn btn-primary btn-flat" id="col-barang" role="button" data-toggle="collapse" href="#collapse-barang" aria-expanded="false" aria-controls="collapseExample">
            Tambah Data Barang <i class="fa fa-plus"></i>
        </a>

        <a class="btn btn-primary btn-flat" role="button" data-toggle="collapse" href="#collapse-JenisBarang" aria-expanded="false" aria-controls="collapseExample">
            Tambah Data Kategori <i class="fa fa-plus"></i>
        </a>
        <a class="btn btn-success btn-flat" role="button" data-toggle="collapse" href="#collapse-exportExcel" aria-expanded="false" aria-controls="collapseExample">
            Export to Excel <i class="fa fa-file-excel-o"></i>
        </a>
        <a class="btn btn-warning btn-flat" role="button" data-toggle="collapse" href="#collapse-importExcel" aria-expanded="false" aria-controls="collapseExample">
            Import with Excel <i class="fa fa-file-excel-o"></i>
        </a>
        <a class="btn btn-danger btn-flat" role="button" data-toggle="collapse" href="#collapse-exportPDF" aria-expanded="false" aria-controls="collapseExample">
            Export to PDF <i class="fa fa-file-pdf-o"></i>
        </a>

        {{--Menu--}}
        @include('gudang.barang.collapse-barang')
        @include('gudang.barang.collapse-kategori')
        @include('gudang.barang.collapse-exportExcel')
        @include('gudang.barang.collapse-importExcel')
        @include('gudang.barang.collapse-PDF')
        {{--Table--}}
        @include('gudang.barang.table-barang')
    </div>
</div>    
@endsection

@section('customJs')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table-barang').DataTable();
            //---distributor---//
            $('#photo').on('change', function() {
                showFile(this, '#showPhoto');
            });

            //---barang---//
            $('#col-barang').on('click', function () {
                $('#panel-barang').show();
                $('#panel-jenis').hide();
            });

            $('#frm-barang').on('submit', function (e) {
                toastr.success('success', 'Data berhasil ditambahkan !');
            });
            //---JenisBarang---//
            $('#frm-JenisBarang').on('submit', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                // console.log(data);
//                var jenis_barang = $('#jenis_barang_id').empty();
                $.post("{{ route('postKategori') }}", data, function (data) {
                    $('#jenis_barang_id').append($('<option/>', {
                        value: data.id,
                        text: data.kategori
                    }));
                    toastr.success('Success', 'Data berhasil di update !');
                });
                $('#frm-JenisBarang')[0].reset();

            });

            //Edit modal
            $('#table-barang').on('click','.btn-edit',function() {
                var id = $(this).data('id');
                var stok = $(this).data('stok');
                var distributor = $(this).data('distributor');
                var harga_jual = $(this).data('harga_jual');
                var harga_beli = $(this).data('harga_beli');
                var harga_reseller = $(this).data('harga_reseller');
                var kategori = $(this).data('kategori');
                var nama_barang = $(this).data('nama_barang');
                var tgl = $(this).data('tgl');

                $('#frm-edit').find("input[name='nama_barang']").val(nama_barang);
                $('#frm-edit').find("select[name='kategori_id']").val(kategori).change();
                $('#frm-edit').find("input[name='harga_beli']").val(harga_beli);
                $('#frm-edit').find("input[name='harga_jual']").val(harga_jual);
                $('#frm-edit').find("input[name='harga_reseller']").val(harga_reseller);
                $('#frm-edit').find("select[name='distributor_id']").val(distributor).change();
                $('#frm-edit').find("input[name='stok']").val(stok);
                $('#frm-edit').find("input[name='id']").val(id);
                $('#frm-edit').find("input[name='tgl_masuk']").val(tgl);
            });

            $('#table-barang').on('click','.btn-detail', function() {
                var id = $(this).data('id');
                var stok = $(this).data('stok');
                var distributor = $(this).data('distributor');
                var harga_jual = $(this).data('harga_jual');
                var harga_beli = $(this).data('harga_beli')
                var harga_reseller = $(this).data('harga_reseller')
                var kategori = $(this).data('kategori');
                var nama_barang = $(this).data('nama_barang');
                var tgl = $(this).data('tgl');

                $('#frm-detail').find("input[name='nama_barang']").val(nama_barang);
                $('#frm-detail').find("select[name='kategori_id']").val(kategori).change();
                $('#frm-detail').find("input[name='harga_beli']").val(harga_beli);
                $('#frm-detail').find("input[name='harga_jual']").val(harga_jual);
                $('#frm-detail').find("input[name='harga_reseller']").val(harga_reseller);
                $('#frm-detail').find("select[name='distributor_id']").val(distributor).change();
                $('#frm-detail').find("input[name='stok']").val(stok);
                $('#frm-detail').find("input[name='id']").val(id);
                $('#frm-detail').find("input[name='tgl_masuk']").val(tgl);
            });

            $('#table-barang').on('click','.btn-delete', function () {
                var id = $(this).data('id');
                $.confirm({
                    title: 'Alert !',
                    content: 'Apakah anda ingin menghapus data ini ?',
                    buttons: {
                        confirm: function () {
                            $.get("{{ route('getHapusBarang') }}", {id: id}, function (data) {
                                toastr.success('Success !', 'Data berhasil di hapus');
                                location.href = "{{ route('barang.index') }}";
                            });
                        },
                        cancel: function () {
                            $.alert('Batal!');
                        },
                    }
                });
            })

            $("#edit-barang").on('click', function() {
                toastr.success('Success', 'Data berhasil di tambahkan !');
            });

            function showFile(fileInput, img, showName) {
                if (fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(img).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
                $('#showPhoto').text(fileInput.files[0].name)
            }

            // Chart barang
            var barang  = $.parseJSON('{!! $barang2 !!}');
            new Morris.Bar({
                      // ID of the element in which to draw the chart.
                      element: 'chart-barang',
                      // Chart data records -- each entry in this array corresponds to a point on
                      // the chart.
                      data: barang,
                      // The name of the data record attribute that contains x-values.
                      xkey: 'nama_barang',
                      // A list of names of data record attributes that contain y-values.
                      ykeys: ['stok'],
                      // Labels for the ykeys -- will be displayed when you hover over the
                      // chart.
                      labels: ['Value'],
                      hideHover: 'auto',
                      barColors: ['#00c0ef']
                    });
            
        })
    </script>
@endsection