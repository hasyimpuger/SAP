@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-12 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($kategori) }}</h3>

                    <p>Jumlah Kategori</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
            </div>
        </div>
	</div>
	<div class="row" style="margin-bottom: 5px">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a class="btn btn-primary btn-flat"  role="button" data-toggle="collapse" href="#collapse-kategori" aria-expanded="false" aria-controls="collapseExample">
		            Tambah Kategori <i class="fa fa-plus"></i>
		        </a>
		{{-- collapse --}}

		<div class="collapse" id="collapse-kategori" style="margin-top: 5px">
		    <div class="panel panel-default">
		        <div class="panel-heading">
		            <h3 class="panel-title">Tambah Kategori</h3>
		        </div>
		        <div class="panel-body">
		            <form method="post" id="frm-kategori">
		                {{ csrf_field() }}
		                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		                    <div class="form-group">
		                        <label for="">Nama Kategori</label>
		                        <input type="text" required name="kategori" id="kategori" placeholder="Nama Kategori" class="form-control">
		                    </div>
		                </div>
		                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
		                    <button type="submit" class="btn btn-primary btn-flat btn-block btn-md"  type="submit">Simpan <i class="fa fa-save"></i></button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Data Kategori</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover" id="mytable">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Kategori</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $no = 1; ?>
							@foreach($kategori as $data)
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $data['kategori'] }}</td>
									<td>
										<a class="btn btn-warning btn-flat btn-edit" data-toggle="modal" href='#modal-edit' data-id="{{$data['id']}}" data-nama="{{$data['kategori']}}"><i class="fa fa-edit"></i></a>
										<a href="#!" class="btn btn-danger btn-flat btn-hapus" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
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

	{{-- modal --}}
	<div class="modal fade" id="modal-edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Data</h4>
				</div>
				<div class="modal-body">
					<form method="post" role="form" id="frm-edit">
						<div class="form-group">
							<label>ID</label>
							<div class="input-group">
								<div class="input-group-addon">ID</div>
								<input type="text" name="id" id="id" class="form-control" readonly="">
							</div>
						</div>
						<div class="form-group">
							<label>Nama Kategori</label>
							<input type="text" name="kategori" id="kategori" class="form-control">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan <i class="fa fa-save"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('customJs')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#frm-kategori').on('submit', function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				$.post("{{route('postDataKategori')}}", data, function(data) {
					toastr.success('Success !', 'Data berhasil di tambahkan !');
					location.reload();
				});
			});

			$('#mytable').on('click','.btn-edit', function() {
				var id = $(this).data('id');
				var kategori = $(this).data('nama');
				// alert(kategori);
				$('#frm-edit').find('#id').val(id);
				$('#frm-edit').find('#kategori').val(kategori);
			});

			$('#frm-edit').on('submit', function(e) {
			    e.preventDefault();
				var data = $(this).serialize();
				$.post("{{route('postKategoriUpdate')}}", data, function(data) {
					toastr.success('Success !', 'Data berhasil di update');
					location.reload();
				});
			});

			$('#mytable').on('click','.btn-hapus', function(e) {
				e.preventDefault();
				var id = $(this).data('id');
				$.confirm({
			                    title: 'Alert !',
			                    content: 'Apakah anda ingin menghapus data ini ?',
			                    buttons: {
			                        confirm: function () {
			                            $.post("{{route('postKategoriDelete')}}", {id:id}, function(data) {
							toastr.success('Success !', 'Data berhasil di hapus !');
							location.reload();
						})
			                        },
			                        cancel: function () {
			                            $.alert('Batal!');
			                        },
			                    }
			                });
			});
		});
	</script>
@endsection