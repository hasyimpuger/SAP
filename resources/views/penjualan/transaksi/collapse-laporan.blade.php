<div class="collapse" id="collapse-laporan" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Buat Laporan</h3>
        </div>
        <div class="panel-body">
           <form action="{{ route('getLaporan') }}" method="post" id="frm-laporan" target="_blank">
                {{ csrf_field() }}
               <div class="col-lg-12">
                   <div class="form-group">
                       <label>Tanggal Laporan ?</label>
                       <input type="text" name="tgl_laporan" class="form-control daterangepicker" style="width: 100% !important;position: static;">
                       <input type="hidden" name="start" id="start">
                       <input type="hidden" name="end" id="end">
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2">
                    <button class="btn btn-info btn-block btn-md">Cetak Laporan <i class="fa fa-file-pdf"></i></button>
               </div>
           </form>
        </div>
    </div>
</div>
