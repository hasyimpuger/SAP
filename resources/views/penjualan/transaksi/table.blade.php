<table class="table table-striped table-hover" id="mytable">
	<thead>
		<tr>
			<th>No.</th>
			<th>ID Transaksi</th>
			<th>Tgl. Transaksi</th>
			<th>Total Bayar</th>
			<th>Jumlah Bayar</th>
			<th>Uang Kembalian</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $no = 1; ?>
	@foreach($transaksi as $data)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data['invoice_id'] }}</td>
			<td>{{ $data['tgl_transaksi'] }}</td>
			<td>Rp. {{ number_format($data['total_bayar']) }}</td>
			<td>Rp. {{ number_format($data['jumlah_bayar']) }}</td>
			<td>Rp. {{ number_format($data['kembalian']) }}</td>
			<td>
				<a href="{{ route('getTransaksiEdit', $data['invoice_id']) }}" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
				<a  data-id="{{$data['invoice_id']}}" class="btn btn-danger btn-flat btn-delete"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>