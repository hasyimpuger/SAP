<div class="collapse" id="collapse-distributor" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Data Distributor</h3>
        </div>
        <div class="panel-body">
            <form method="post" id="frm-distributor" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="">Nama Distributor</label>
                            <input type="text" name="nama_distributor" id="nama_distributor" placeholder="Nama Distributor" required class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">No. Telp</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" name="telp" id="telp" placeholder="No. Telp" required aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" onkeypress="return isNumber(event)" class="form-control" placeholder="Kode Pos" required maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="margin-top: 5px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Photo</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <img src="{{ URL::to('dist/img/file.jpg') }}" class="img-thumbnail" width="200px" height="200px" id="showPhoto" alt="">
                                <input type="file" name="photo" id="photo" class="form-control" accept="image/jpeg,image/png,image/jpg" value="{{ URL::to('dist/img/file.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <button class="btn btn-primary btn-flat btn-block btn-md" type="submit" id="simpan-distributor">Simpan <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>