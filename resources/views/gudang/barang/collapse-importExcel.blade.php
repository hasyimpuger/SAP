<div class="collapse" id="collapse-importExcel" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Import To Excel</h3>
        </div>
        <div class="panel-body">
           <form action="{{ route('importBarang') }}" method="post" id="frm-importExcel" enctype="multipart/form-data">
                {{ csrf_field() }}
               <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-offset-3">
                   <div class="form-group">
                       <label>Upload File Excel</label>
                       <input type="file" name="import_file" id="" class="form-control">
                   </div>
               </div>
               <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <button class="btn btn-warning btn-block btn-md btn-flat">Import With Excel <i class="fa fa-file-excel-o"></i></button>
               </div>
           </form>
        </div>
    </div>
</div>