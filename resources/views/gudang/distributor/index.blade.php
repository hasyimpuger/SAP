@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-xs-12 col-lg-offset-2">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ count($distributor) }}</h3>

                    <p>Total Distributor</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a class="btn btn-primary btn-flat" id="col-distributor" role="button" data-toggle="collapse" href="#collapse-distributor" aria-expanded="false" aria-controls="collapseExample">
                Tambah Data Distributor <i class="fa fa-plus"></i>
            </a>
            <a href="{{ route('exportExcelDistributor', 'xlsx') }}"  target="_blank" class="btn btn-success btn-flat">Export To Excel <i class="fa fa-file-excel-o"></i></a>
            <a href="{{ route('exportDistributorPDF') }}"  target="_blank" class="btn btn-danger btn-flat">Export To PDF <i class="fa fa-file-pdf-o"></i></a>
            {{--Menu--}}

            @include('gudang.distributor.collapse-distributor')


            <div class="panel panel-default" style="margin-top: 5px">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Distributor</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" id="mytable">
                            <thead>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Nama Distributor</th>
                                <th>Telp</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach($distributor as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><img src="{{ URL::to('photo/distributor/'. $data['photo']) }}" alt="" class="img-circle" width="80" height="80"></td>
                                    <td>{{ $data['nama_distributor'] }}</td>
                                    <td>{{ $data['telp'] }}</td>
                                    <td>
                                        <a class="btn btn-info detail" data-toggle="modal"  href="#modal-detail"
                                          data-id="{{$data['id']}}" data-alamat="{{$data['alamat']}}"
                                           data-nama="{{$data['nama_distributor']}}" data-telp="{{$data['telp']}}"
                                           data-kode="{{$data['kode_pos']}}" data-deskripsi="{{$data['deskripsi']}}"
                                        ><i class="fa fa-search"></i></a>
                                        <a class="btn btn-warning edit" data-toggle="modal"
                                           data-id="{{$data['id']}}" data-alamat="{{$data['alamat']}}"
                                           data-nama="{{$data['nama_distributor']}}" data-telp="{{$data['telp']}}"
                                           data-kode="{{$data['kode_pos']}}" data-deskripsi="{{$data['deskripsi']}}"
                                           href="#modal-edit"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger delete" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('gudang.distributor.modal-detail')
    @include('gudang.distributor.modal-edit')
@endsection

@section('customJs')
    <script type="text/javascript">
        $(document).ready(function() {
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

            //---distributor---//
            $('#photo').on('change', function() {
                showFile(this, '#showPhoto');
            });

            $('#simpan-distributor').on('click', function() {
                toastr.success('Success', 'Data berhasil ditambahkan !');
            });
            // $('#frm-distributor').on('submit', function() {
            //     var data = $(this).serialize();
            //     console.log(data);
            // });

            $('#mytable').on('click','.detail', function () {
                $('#modal-detail').find('#id').val($(this).data('id'));
                $('#modal-detail').find('#nama_distributor').val($(this).data('nama'));
                $('#modal-detail').find('#telp').val($(this).data('telp'));
                $('#modal-detail').find('#kode_pos').val($(this).data('kode'));
                $('#modal-detail').find('#alamat').text($(this).data('alamat'));
                $('#modal-detail').find('#deskripsi').text($(this).data('deskripsi'));
            });

            $('#mytable').on('click','.edit', function () {
                $('#modal-edit').find('#id').val($(this).data('id'));
                $('#modal-edit').find('#nama_distributor').val($(this).data('nama'));
                $('#modal-edit').find('#telp').val($(this).data('telp'));
                $('#modal-edit').find('#kode_pos').val($(this).data('kode'));
                $('#modal-edit').find('#alamat').text($(this).data('alamat'));
                $('#modal-edit').find('#deskripsi').text($(this).data('deskripsi'));
            });

            $('#frm-edit').on('submit', function() {
                toastr.success('Success !', 'Data berhasil di update !');
            });

            $('#mytable').on('click','.delete',function() {
                var id = $(this).data('id');
                            // console.log(id);
                $.confirm({
                    title: 'Alert !',
                    content: 'Apakah anda ingin menghapus data ini ?',
                    buttons: {
                        confirm: function () {
                            
                            $.get("{{ route('getDeleteDistributor') }}", {id: id}, function (data) {
                                location.href = "{{ route('distributor.index') }}";
                            });
                        },
                        cancel: function () {
                            $.alert('Batal!');
                        },
                    }
                });
            });

        })
    </script>
@endsection