<div class="collapse" id="collapse-tambah" style="margin-top: 5px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tambah Stok Lain</h3>
        </div>
        <div class="panel-body">
           <div class="table-responsive">
             <table id="mytable" class="table table-hover table-striped">
               <thead>
                 <tr>
                    <th>No</th>  
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Distributor</th>
                    <th>Stok Barang</th>
                    <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                @foreach($data as $key => $value)
                 <tr>
                   <td>{{++$key}}</td>
                   <td>{{$value['nama_barang']}}</td>
                   <td>{{$value['kategori']['kategori']}}</td>
                   <td>{{$value['harga_beli']}}</td>
                   <td>{{$value['harga_jual']}}</td>
                   <td>{{$value['distributor']['nama_distributor']}}</td>
                   <td>{{$value['stok']}}</td>
                   <td>
                     <a class="btn btn-warning btn-sm btn-flat btn-edit" data-nama="{{$value['nama_barang']}}" data-stok="{{$value['stok']}}" data-id="{{$value['id']}}" data-harga_beli="{{$value['harga_beli']}}" data-toggle="modal" href="#modal-edit"><i class="fa fa-edit"></i></a>
                   </td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
        </div>
    </div>
</div>