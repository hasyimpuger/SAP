<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail Data</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label for="">ID</label>
                    <input type="text" name="id" id="id" class="form-control">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label for="">Nama Distributor</label>
                    <input type="text" name="nama_distributor" id="nama_distributor" class="form-control">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="">Telp</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            <input type="text" class="form-control" name="telp" id="telp">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="">Kode Pos</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-id-card"></i></div>
                            <input type="text" class="form-control" id="kode_pos">
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->