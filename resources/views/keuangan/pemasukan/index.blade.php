@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>Rp. <?php echo number_format($totalPerTahun); ?></h3>
				<p>Total Pemasukan</p>
			</div>
			<div class="icon">
				<i class="fa fa-balance-scale"></i>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>Rp. <?php echo number_format($totalPerHari); ?></h3>
				<p>Total Pemasukan Hari Ini</p>
			</div>
			<div class="icon">
				<i class="fa fa-handshake-o"></i>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<a class="btn btn-primary btn-flat" role="button" data-toggle="collapse" href="#collapse-tambah" aria-expanded="false" aria-controls="collapseExample">
			Tambah Pemasukan <i class="fa fa-plus"></i>
		</a>
		<a class="btn btn-success btn-flat" role="button" data-toggle="collapse" href="#collapse-exportExcel" aria-expanded="false" aria-controls="collapseExample">
			Export To Excel <i class="fa fa-file-excel-o"></i>
		</a>
		<a class="btn btn-warning btn-flat" role="button" data-toggle="collapse" href="#collapse-exportPrint" aria-expanded="false" aria-controls="collapseExample">
			Print Data <i class="fa fa-print"></i>
		</a>
		<a class="btn btn-danger btn-flat" role="button" data-toggle="collapse" href="#collapse-exportPDF" aria-expanded="false" aria-controls="collapseExample">
			Export To PDF <i class="fa fa-file-pdf-o"></i>
		</a>

		@include('keuangan.pemasukan.collapse-tambah')
		@include('keuangan.pemasukan.collapse-exportExcel')
		@include('keuangan.pemasukan.collapse-PDF')
		@include('keuangan.pemasukan.collapse-Print')
		<div class="panel panel-default" style="margin-top: 5px">
			<div class="panel-heading">
				<h3 class="panel-title">Data Pemasukan</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" id="table-custom">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kode Invoice/Nota</th>
								<th>Tanggal Pemasukan</th>
								<th>Jumlah Uang</th>
								<th>Keterangan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="table-pemasukan">
							<?php $no = 1; ?>
							@foreach ($pemasukan->toArray() as $data)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{$data['invoice_id']}}</td>
								<td>{{ date('d/F/Y', strtotime($data['tgl_pemasukan'])) }}</td>
								<td>Rp. {{ number_format($data['jumlah_uang']) }}</td>
								<td>{{ $data['keterangan'] }}</td>
								<td>
									<a href="#modal-edit" data-toggle="modal" class="btn btn-warning btn-flat btn-edit"
										data-id="{{$data['id']}}" data-tgl="{{$data['tgl_pemasukan']}}" data-uang="{{$data['jumlah_uang']}}" data-keterangan="{{$data['keterangan']}}"
									><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-flat hapus" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
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
	@include('keuangan.pemasukan.modal-edit')
	@endsection
	@section('customJs')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table-keuntungan').DataTable();
			$('#table-custom').DataTable();
			// Tambah Pemasukan
			$('#frm-pemasukan').on('submit', function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				var table = ' ';
				$.post("{{ route('postPemasukan') }}", data, function(data) {
					toastr.success('Success !', 'Data berhasil di simpan !');
					$('#frm-pemasukan')[0].reset();
					location.href = "{{ route('getPemasukan') }}";
				});
			});
			// hapus
			$('#table-custom').on('click','.hapus', function() {
				var id = $(this).data('id');
				$.confirm({
			title: 'Alert !',
			content: 'Apakah anda ingin menghapus data ini ?',
			buttons: {
			confirm: function () {
			$.get("{{ route('getHapusPemasukan') }}", {id: id}, function (data) {
			toastr.success('Success !', 'Data berhasil di hapus');
			location.href = "{{ route('getPemasukan') }}";
			});
			},
			cancel: function () {
			$.alert('Batal!');
			},
			}
			});
			});
			// edit
			$('#table-custom').on('click','.btn-edit', function() {
				var id = $(this).data('id');
				var tgl = $(this).data('tgl');
				var uang = $(this).data('uang');
				var keterangan = $(this).data('keterangan');
				// console.log(keterangan);
				$('#frm-edit-pemasukan').find("input[name='tgl_pemasukan']").val(tgl);
				$('#frm-edit-pemasukan').find("input[name='id']").val(id);
				$('#frm-edit-pemasukan').find("input[name='jumlah_uang']").val(uang);
				$('#frm-edit-pemasukan').find("input[name='keterangan']").val(keterangan);
			});
			// update
			$('#frm-edit-pemasukan').on('submit', function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				console.log(data);
				$.post("{{ route('postEditPemasukan') }}", data, function(data) {
					toastr.success('Success !', 'Data berhasil di update !');
					$('#modal-edit').modal('hide');
					location.href = "{{ route('getPemasukan') }}";
				});
			});
		});
	</script>
	@endsection