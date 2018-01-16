<div class="collapse" id="collapse-barang" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Data Barang</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('postBarang') }}" method="post" id="frm-barang">
                {{ csrf_field() }}
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" required name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="">Kategori Barang</label>
                        <select name="kategori_id" required id="jenis_barang_id" class="form-control select2" style="width: 100% !important;">
                            <option selected disabled>- Pilih Kategori Barang -</option>
                            @foreach($kategori as $data)
                                <option value="{{ $data['id'] }}">{{ $data['kategori'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group">
                        <label for="">Harga Beli</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Rp.</span>
                            <input type="text" class="form-control" required name="harga_beli" id="harga_satuan" placeholder="Harga Beli" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Rp.</span>
                            <input type="text" class="form-control" required name="harga_jual" id="harga_jual" placeholder="Harga Jual" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="form-group">
                        <label for="">Harga Reseller</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Rp.</span>
                            <input type="text" class="form-control" required name="harga_reseller" id="harga_reseller" placeholder="Harga Jual" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="">Distributor Dari</label>
                        <select name="distributor_id" id="distributor_id" required class="form-control select2" style="width: 100% !important;">
                            <option disabled selected>- Pilih Distributor -</option>
                            @foreach($distributor as $data)
                                <option value="{{ $data['id'] }}">{{ $data['nama_distributor'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Jumlah Stok</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-cubes"></i></span>
                            <input type="text" required class="form-control" name="stok" id="jumlah_stok" placeholder="Jumlah Stok" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label>Tanggal Masuk Barang</label>
                    <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control">
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <button class="btn btn-primary btn-flat btn-block btn-md" id="simpan-barang" type="submit">Simpan <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>