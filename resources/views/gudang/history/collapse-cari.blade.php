<div class="collapse" id="collapse-cari" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cari Berdasarkan Tanggal</h3>
        </div>
        <div class="panel-body">
           <form action="{{ route('postCariHistory') }}" method="post" target="_blank" id="frm-cari">
                {{ csrf_field() }}
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <div class="form-group">
                       <label>Tanggal ?</label>
                       <input type="text" name="bulan" class="form-control daterangepicker" style="position: static;width: 100% !important">
                       <input type="hidden" name="start" id="start">
                       <input type="hidden" name="end" id="end">
                   </div>
               </div>
               <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <button type="submit" class="btn btn-info btn-block btn-md">Cari History <i class="fa fa-search"></i></button>
               </div>
           </form>
        </div>
    </div>
</div>