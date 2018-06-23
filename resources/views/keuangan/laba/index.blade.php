@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>Rp. <?php echo number_format($totalLaba); ?></h3>
				<p>Total Laba</p>
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
				<h3>Rp. <?php echo number_format($labaHariIni); ?></h3>
				<p>Total Laba Hari Ini</p>
			</div>
			<div class="icon">
				<i class="fa fa-handshake-o"></i>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div>
			<a href="{{route('getKeuangan')}}" class="btn btn-danger">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
		</div>
		<div class="panel panel-default" style="margin-top: 5px">
			<div class="panel-heading">
				<h3 class="panel-title">Data Laba</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" id="table-custom">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kode Invoice/Nota</th>
								<th>Tanggal Masuk</th>
								<th>Total Laba Yang Didapat</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach ($data as $laba)
							<tr>
								<td>{{ $no++ }}</td>
								<td><span class="badge">{{$laba['invoice_id']}}</span></td>
								<td>{{ date('d/F/Y', strtotime($laba['tgl_masuk'])) }}</td>
								<td>Rp. {{ number_format($laba['labaTransaksi']) }}</td>
								<td>
									<a href="#modal-detail" data-toggle="modal" class="btn btn-info btn-flat btn-detail"
										data-id="{{$laba['id']}}"
										data-invoice_id="{{$laba['invoice_id']}}"
									><i class="fa fa-search"></i> Detail Laba Transaksi</a>
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

{{-- modal detail --}}
<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail Laba Transaksi</h4>
			</div>
			<div class="modal-body">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Nama Barang</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
							<th>Selisih Harga</th>
							<th>Qty</th>
						</tr>
					</thead>
					<tbody id="detail-laba">
					</tbody>
					<tfoot id="bayar-laba">

					</tfoot>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>


@endsection
@section('customJs')
<script type="text/javascript">
	$('#table-custom').DataTable();
	$('#table-custom').on('click', '.btn-detail', function() {
		const invoice_id = $(this).data('invoice_id');
		$.get("{{route('laba.transaksi')}}", {invoice_id: invoice_id}, function(data) {
			$("#detail-laba").empty();
			$("#bayar-laba").empty();
			for (var i = 0; i < data.length; i++) {
				let detail_laba = '<tr>'+
									'<td>'+data[i].barang.nama_barang+'</td>'+
									'<td>'+data[i].barang.harga_beli+'</td>'+
									'<td>'+data[i].barang.harga_jual+'</td>'+
									'<td>'+(parseFloat(data[i].barang.harga_jual) - parseFloat(data[i].barang.harga_beli))+'</td>'+
									'<td>'+data[i].qty+'</td>'+
								  '</tr>';
				$("#detail-laba").append(detail_laba);

			}
			let bayar_laba = '<tr>'+
								'<td></td>'+
								'<td></td>'+
								'<td></td>'+
								'<td>Total Bayar</td>'+
								'<td>Rp. <b>'+data[0].total_bayar+'</b></td>'+
							'</tr>'+
							'<tr>'+
								'<td></td>'+
								'<td></td>'+
								'<td></td>'+
								'<td>Jumlah Yang Dibayar</td>'+
								'<td>Rp. <b>'+data[0].jumlah_bayar+'</b></td>'+
							'</tr>'+
							'<tr>'+
								'<td></td>'+
								'<td></td>'+
								'<td></td>'+
								'<td>Uang Kembalian</td>'+
								'<td>Rp. <b>'+data[0].kembalian+'</b></td>'+
							'</tr>';
			$("#bayar-laba").append(bayar_laba);
		})
	})
</script>
@endsection