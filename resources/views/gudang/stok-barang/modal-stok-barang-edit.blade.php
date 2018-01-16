<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Beli stok Barang</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('postStokBarangEdit') }}" method="post" id="frm-edit">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" required name="nama_barang" id="nama_barang" readonly="" placeholder="Nama Barang" class="form-control">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Jumlah Stok</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-cubes"></i></span>
                            <input type="text" required class="form-control" name="stok" id="jumlah_stok" placeholder="Jumlah Stok" aria-describedby="basic-addon2" readonly="">
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Jumlah Beli Stok</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-cubes"></i></span>
                            <input type="text" required class="form-control" name="jumlah_beli_stok" id="jumlah_beli_stok" placeholder="Jumlah Stok" aria-describedby="basic-addon2">
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Harga Beli Barang</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Rp.</span>
                            <input type="text" required class="form-control" name="harga_beli" id="harga_beli"  aria-describedby="basic-addon2" readonly="">
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="">Biaya Pengeluaran</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Rp.</span>
                            <input type="text" required name="biaya_pengeluaran" id="biaya_pengeluaran" readonly="" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-flat" id="edit-barang" type="submit">Simpan <i class="fa fa-save"></i></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->