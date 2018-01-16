@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div style="margin-bottom: 5px">
            <a href="#collapse-cari" data-toggle="collapse" class="btn btn-info btn-flat">Cari Berdasarkan Tanggal <i class="fa fa-search"></i></a>

            @include('gudang.history.collapse-cari')
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">History Barang</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal & Waktu</th>
                                <th>Nama Barang</th>
                                <th>Keterangan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $key => $value)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{date('d/m/Y - H:i:s A', strtotime($value['created_at']))}}</td>
                                <td>{{$value['barang']['nama_barang']}}</td>
                                <td>{{$value['keterangan']}}</td>
                                <td>
                                    <a href="{{route('getHistoryDetail', $value['id'])}}" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></a>
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
@endsection

@section('customJs')
    <script type="text/javascript">
        $('.daterangepicker').daterangepicker({
               locale: {
                  format: 'DD/MM/YYYY'
                },
            },
            function (start, end, label) {
                $('#frm-cari').find('#start').val(start.format('YYYY-MM-DD'));
                $('#frm-cari').find('#end').val(end.format('YYYY-MM-DD'));
            });
    </script>
@endsection