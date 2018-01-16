<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print Data</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::to('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::to('dist/css/AdminLTE.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
 
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header" align="center">
        <img class="pull-left" width="100" height="100" src="{{ URL::to('photo/toko/' . Auth::user()->getPhoto()) }}">
          {{ Auth::user()->getToko()->nama_toko }}<br>
          {{ Auth::user()->getToko()->deskripsi }}<br>
          <small>{{ Auth::user()->getToko()->alamat }}</small>
          <small>Telp. {{ Auth::user()->getToko()->telp }}</small>
          <small>Email : {{ Auth::user()->getToko()->email }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <!-- /.row -->

    <!-- Table row -->
   <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header" align="center">Laporan Pengeluaran Bulan {{ date('F', strtotime($bulan.$tahun)) . ' Tahun ' . date('Y', strtotime($bulan.$tahun)) }}</h2>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              
              <table class="table table-hover">
                  <thead>
                      <th class="text-center">No</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center">Jumlah Uang</th>
                  </thead>
                  <tfoot>
                      <th colspan="2"></th>
                      <th class="text-center">Total</th>
                      <th class="text-right">Rp. {{ number_format($pengeluaran->sum('jumlah_uang')) }}</th>
                  </tfoot>
                <tbody> 
                <?php $no =1; ?>
                @foreach($pengeluaran as $data)
                      <tr>                  
                        <td align="center">{{ $no++ }}</td>
                        <td align="center">{{ date('d-F-Y', strtotime($data['tgl_pengeluaran'])) }}</td>
                        <td align="center">{{ $data['keterangan'] }}</td>
                        <td align="right">Rp. {{ number_format($data['jumlah_uang']) }}</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    <!-- /.row -->

    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
