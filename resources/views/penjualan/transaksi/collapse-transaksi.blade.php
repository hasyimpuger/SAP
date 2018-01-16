<div class="collapse" id="collapse-transaksi" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Data Transaksi</h3>
        </div> 
        <div class="panel-body">
            <form action="{{ route('getDataTransaksi') }}" method="post" id="frm-barang">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select class="form-control select2 list-barang" style="width: 100% !important" name="barang_id[]" multiple="multiple">
                                @foreach($barang as $data)
                                    <option class="sub-barang{{$data['id']}}" value="{{ $data['id'] }}"
                                        data-id="{{$data['id']}}" data-stok="{{$data['stok']}}" data-nama="{{$data['nama_barang']}}" data-harga_jual="{{$data['harga_jual']}}"
                                    >{{ $data['nama_barang'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label>Barang yang di pilih</label>
                        <table class="table table-bordered">
                            <thead>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah Stok</th>
                                    <th>Qty</th>
                                    <th>hapus</th>
                            </thead>
                            {{-- <tfoot>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td><input type="text" name="total_bayar" id="total_bayar"></td>
                                    <td><input type="text" name="qty" id="total_qty"></td>
                                </tr>
                            </tfoot> --}}
                            <tbody id="selected-barang">
                                
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <button class="btn btn-primary btn-flat btn-block btn-md" id="simpan-barang" type="submit">Selanjutnya <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div> 