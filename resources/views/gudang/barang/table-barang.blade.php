@include('gudang.barang.modal-barang-edit')
<div class="panel panel-default" style="margin-top: 5px" id="panel-barang">
    <div class="panel-heading">
        <h3 class="panel-title">Daftar Barang</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped tabled-bordered" id="table-barang">
                <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal Masuk</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Distributor</th>
                <th>Stok Barang</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach($barang as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data['nama_barang'] }}</td>
                        <td>{{ date('d/F/Y', strtotime($data['tgl_masuk'])) }}</td>
                        <td data-kategori="{{ $data['kategori_id'] }}">{{ $data['kategori']['kategori'] }}</td>
                        <td>Rp. {{ number_format($data['harga_beli']) }}</td>
                        <td>Rp. {{ number_format($data['harga_jual']) }}</td>
                        <td data-dist="{{ $data['distributor_id'] }}">{{ $data['distributor']['nama_distributor'] }}</td>
                        <td>{{ $data['stok'] }}</td>
                        @include('gudang.barang.modal-barang-detail')

                        <td>
                            <a class="btn btn-info btn-sm btn-flat btn-detail" data-toggle="modal" href="#modal-detail-{{$data['id']}}" data-id="{{$data['id']}}" data-nama_barang="{{$data['nama_barang']}}" data-tgl="{{$data['tgl_masuk']}}" data-kategori="{{$data['kategori_id']}}" data-harga_beli="{{$data['harga_beli']}}"  data-harga_jual="{{$data['harga_jual']}}" data-distributor="{{$data['distributor_id']}}" data-stok="{{$data['stok']}}"
                            ><i class="fa fa-search"></i></a>
                            <a class="btn btn-warning btn-sm btn-flat btn-edit" data-toggle="modal" href="#modal-edit" data-id="{{$data['id']}}" data-nama_barang="{{$data['nama_barang']}}" data-tgl="{{$data['tgl_masuk']}}" data-kategori="{{$data['kategori_id']}}" data-harga_beli="{{$data['harga_beli']}}"  data-harga_jual="{{$data['harga_jual']}}" data-harga_reseller="{{$data['harga_reseller']}}" data-distributor="{{$data['distributor_id']}}" data-stok="{{$data['stok']}}"
                            ><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-flat btn-delete" data-id="{{$data['id']}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>