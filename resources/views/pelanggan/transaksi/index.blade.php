@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12 col-xs-12">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ count($transaksi) }}</h3>
				<p>Jumlah Transaksi</p>
			</div>
			<div class="icon">
				<i class="fa fa-handshake-o"></i>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="{{route('pelanggan')}}" style="margin-bottom: 5px" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Data Transaksi</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" id="mytable">
						<thead>
							<tr>
								<th>No.</th>
								<th>ID Invoice</th>
								<th>Tgl. Transaksi</th>
								<th>Total Bayar</th>
								<th>Jumlah Bayar</th>
								<th>Kembalian</th>
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
<div class="modal fade" id="modal-pembelian">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail Pembelian</h4>
			</div>
			<div class="modal-body">
				<table class="table table-hover table-bordered" id="table-pembelian">
					<thead>
						<tr>
							<th>Nama Barang</th>
							<th>Jumlah Beli</th>
						</tr>
					</thead>
					<tbody id="isi-pembelian">
						<tr>
							<td>asa</td>
							<td>asa</td>
						</tr>
					</tbody>
				</table>
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
		ajax: '{{route('pelanggan.transaksi.data', $id)}}',
		columns: [
			{data: 'DT_Row_Index', orderable: false, searchable: false},
			{data: 'invoice_id'},
			{data: 'tgl_transaksi'},
			{data: 'total_bayar'},
			{data: 'jumlah_bayar'},
			{data: 'kembalian'},
			{data: 'action'},
		]
	});
	$('#mytable').on('click', '.pembelian', function() {
		let invoice_id = $(this).data('invoice_id');
		$.get("{{route('pelanggan.transaksi.barang', $id)}}", {invoice_id: invoice_id}, function(data) {
			$('#isi-pembelian').empty();
			$.each(data, function(k, v) {
				const row = '<tr>'+
							'<td>'+v.barang.nama_barang+'</td>'+
							'<td><span class="badge">'+v.qty+'</span></td>'+
						  '</tr>';

				$('#isi-pembelian').append(row);
			});
		});
	});
</script>
@endsection