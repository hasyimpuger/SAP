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
            <h2 class="page-header" align="center">Laporan Pemasukan Bulan {{ date('F', strtotime($bulan.$tahun)) . ' Tahun ' . date('Y', strtotime($bulan.$tahun)) }}</h2>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

              <table class="table table-hover">
                  <thead>
                      <th class="text-center">No</th>
                      <th class="text-center">Kode Invoice/Nota</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center">Jumlah Uang</th>
                  </thead>
                <tbody>
                <?php $no =1; ?>
                @for($i=0;$i < count($invoice_id);$i++)
                      <tr>
                        <td align="center">{{ $no++ }}</td>
                        <td>{{ $invoice_id[$i]['invoice_id'] }}</td>
                        <td style="font-size: 15px">{{ date('d-m-Y', strtotime($invoice_id[$i]['tgl_pemasukan'])) }}</td>
                        <td style="font-size: 12px">
                          Dari penjualan
                          @foreach($pemasukan as $data)
                            @if($data['invoice_id'] == $invoice_id[$i]['invoice_id'])
                            {{ $data['keterangan'] }},
                            @endif
                          @endforeach
                        </td>
                        <td style="font-size: 12px">Rp. {{ number_format($invoice_id[$i]['jumlah_uang']) }}</td>
                      </tr>
                @endfor
                </tbody>
                <tfoot>
                      <th colspan="3"></th>
                      <th class="text-center">Total</th>
                      <th class="text-right">Rp. {{ number_format($total) }}</th>
                  </tfoot>
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
