@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-12 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ count($pelanggan) }}</h3>
				<p>Jumlah Pelanggan</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-bottom: 5px">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a class="btn btn-primary btn-flat"  role="button" data-toggle="collapse" href="#collapse-kategori" aria-expanded="false" aria-controls="collapseExample">
			Tambah Pelanggan <i class="fa fa-plus"></i>
		</a>
		{{-- collapse --}}
		<div class="collapse" id="collapse-kategori" style="margin-top: 5px">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Tambah Pelanggan Baru</h3>
				</div>
				<div class="panel-body">
					<form method="post" id="frm-tambah">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="">Nama Pelanggan</label>
								<input type="text" required name="nama" id="nama" placeholder="Nama Pelanggan" class="form-control">
							</div>
							<div class="form-group">
								<label for="">No. Hp</label>
								<input type="text" required name="no_hp" id="no_hp" placeholder="No. Hp" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Alamat</label>
								<textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
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
				<h3 class="panel-title">Data Pelanggan</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" id="mytable">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Pelanggan</th>
								<th>No. Hp</th>
								<th>Alamat</th>
								<th>Action</th>
							</tr>
						</thead>
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
						<label>Nama Pelanggan</label>
						<input type="text" name="nama" id="nama" class="form-control">
						<input type="hidden" name="id" id="id" class="form-control">
					</div>
					<div class="form-group">
						<label for="">No. Hp</label>
						<input type="text" class="form-control" name="no_hp" id="no_hp">
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
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
	$('#mytable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{route('pelanggan.getDataPelanggan')}}',
		columns: [
			{data: 'DT_Row_Index', orderable: false, searchable: false},
			{data: 'nama'},
			{data: 'no_hp'},
			{data: 'alamat'},
			{data: 'action'},
			]
	});
	$('#frm-tambah').on('submit', function(e) {
		e.preventDefault();
		const data = $(this).serialize();
		$.post('{{route('pelanggan.store')}}', data, function(data) {
			$('#frm-tambah')[0].reset();
			$('#mytable').DataTable().ajax.reload();
			toastr.success('Success !', 'Data berhasil di hapus');
		});
	})
	$('#mytable').on('click', '.edit', function() {
		const id = $(this).data('id');
		const nama = $(this).data('nama');
		const no_hp = $(this).data('no_hp');
		const alamat = $(this).data('alamat');
		$('#modal-edit').find('#id').val(id);
		$('#modal-edit').find('#nama').val(nama);
		$('#modal-edit').find('#no_hp').val(no_hp);
		$('#modal-edit').find('#alamat').val(alamat);
	});
	$('#frm-edit').on('submit', function(e) {
		e.preventDefault();
		const data = $(this).serialize();
		$.post("{{route('pelanggan.update')}}", data, function() {
			$('#modal-edit').modal('hide');
			$('#mytable').DataTable().ajax.reload();
			toastr.success('Success !', 'Data berhasil di hapus');
		})
	});
	$('#mytable').on('click', '.delete', function() {
		const id = $(this).data('id');
		$.confirm({
title: 'Alert !',
content: 'Apakah anda ingin menghapus data ini ?',
buttons: {
confirm: function () {
$.post("{{ route('pelanggan.destroy') }}", {id: id}, function (data) {
								$('#mytable').DataTable().ajax.reload();
toastr.success('Success !', 'Data berhasil di hapus');
});
},
cancel: function () {
$.alert('Batal!');
},
}
});
	})
</script>
@endsection