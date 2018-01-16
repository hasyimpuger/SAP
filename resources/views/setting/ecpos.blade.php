@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Setting Ecpos</h3>
                </div>
                <div class="panel-body">
                    <form id="frm-ecpos" method="post">
                        <div class="form-group">
                            <label>IP Komputer untuk Ecpos</label>
                            <input type="text" name="ip" id="ip" class="form-control" placeholder="example: 192.168.111.11" value="{{$ecpos['ip']}}">
                            <input type="hidden" name="id" value="{{$ecpos['id']}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Printer / Ecpos</label>
                            <input type="text" name="nama_printer" id="nama_printer" class="form-control" placeholder="example : EPSON TM-U220 Receipt" value="{{$ecpos['nama_printer']}}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat">Simpan <i class="fa fa-save"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
<script type="text/javascript">
    $('#frm-ecpos').on('submit', function(e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.post("{{route('postEcpos')}}", data, function(data) {
            toastr.success('Success !', 'Konfigurasi sudah disimpan');
        })
    })
</script>
@endsection