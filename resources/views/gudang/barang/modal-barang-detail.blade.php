<div class="modal fade" id="modal-detail-{{$data['id']}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail Data</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-lg- col-lg-offset-3">
                        <h4>Scan Dengan QR Barcode</h4>
                       <img src="data:image/png;base64,{{DNS2D::getBarcodePNG(Crypt::decryptString($data['barcode']), 'QRCODE')}}" width="250" height="250" alt="barcode" />
                   </div>
               </div>
                {{-- <form  method="post" id="frm-detail">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" required name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Masuk</label>
                        <input type="date" required name="tgl_masuk" id="tgl_masuk"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori Barang</label>
                        <select name="kategori_id" required id="kategori_id" class="form-control select2" style="width: 100% !important;">
                            <option selected disabled>- Pilih Kategori Barang -</option>
                            @foreach($kategori as $data)
                                <option value="{{ $data['id'] }}">{{ $data['kategori'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Harga Beli</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">Rp.</span>
                                <input type="text" class="form-control" required name="harga_beli" id="harga_satuan" placeholder="Harga Beli" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Harga Jual</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">Rp.</span>
                                <input type="text" class="form-control" required name="harga_jual" id="harga_jual" placeholder="Harga Jual" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Distributor Dari</label>
                        <select name="distributor_id" id="distributor_id" required class="form-control select2" style="width: 100% !important;">
                            <option disabled selected>- Pilih Distributor -</option>
                            @foreach($distributor as $data)
                                <option value="{{ $data['id'] }}">{{ $data['nama_distributor'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Stok</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-cubes"></i></span>
                            <input type="text" required class="form-control" name="stok" id="jumlah_stok" placeholder="Jumlah Stok" aria-describedby="basic-addon2" readonly="">
                        </div>
                    </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->