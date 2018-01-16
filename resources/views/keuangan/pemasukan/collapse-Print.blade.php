<div class="collapse" id="collapse-exportPrint" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Print Data</h3>
        </div>
        <div class="panel-body">
           <form action="{{ route('exportPrintPemasukan') }}" method="post">
                {{ csrf_field() }}
               <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                   <div class="form-group">
                       <label>Bulan ?</label>
                       <input type="text" name="bulan" class="form-control bulan">
                   </div>
               </div>
               <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                   <div class="form-group">
                       <label>Tahun ?</label>
                       <input type="text" name="tahun" class="form-control tahun">
                   </div>
               </div>
               <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <button class="btn btn-warning btn-block btn-flat btn-md">Print Data <i class="fa fa-print"></i></button>
               </div>
           </form>
        </div>
    </div>
</div>