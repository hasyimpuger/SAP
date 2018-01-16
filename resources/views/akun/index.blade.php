@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Setting Akun SAP</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped tabled-bordered" id="table-barang">
                        <thead>
                            <th>No</th>
                            <th>Username </th>
                            <th>Level</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($user as $key => $value)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$value['username']}}</td>
                                <td>{{$value['level']}}</td>
                                <td>
                                    <a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-md btn-flat btn-edit"
                                        data-username="{{$value['username']}}" data-level="{{$value['level']}}"
                                    ><i class="fa fa-edit"></i></a>
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
{{-- Modal edit --}}
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Akun</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('postAkun')}}" method="post" id="frm-edit">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                        <input type="hidden" name="level" id="level" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-barang').on('click', '.btn-edit', function() {
                var username = $(this).data('username');
                var level = $(this).data('level');
                $('#frm-edit').find('#username').val(username);
                $('#frm-edit').find('#level').val(level);
            })
        });

        @if(session()->has('success'))
            toastr.success('Success !', '{{session()->get('success')}}');
        @endif
    </script>
@endsection