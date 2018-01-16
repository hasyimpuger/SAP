<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Akuntansi Pertokoan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('photo/favicon-32x32.png')}}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::to('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::to('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="{{ URL::to('bower_components/Ionicons/css/ionicons.min.css') }}"> --}}
  {{--Select2--}}
  <link rel="stylesheet" href="{{ URL::to('bower_components/select2/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::to('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ URL::to('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ URL::to('bower_components/morris.js/morris.css') }}">
  {{-- Daterange picker --}}
  <link rel="stylesheet" href="{{ URL::to('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ URL::to('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  {{--Toastr--}}
  <link rel="stylesheet" href="{{ URL::to('bower_components/toastr/toastr.min.css') }}">
  {{--Datatables--}}
  <link rel="stylesheet" href="{{ URL::to('bower_components/datatables.net/dataTables.bootstrap.min.css') }}">
  {{--Jquery Confirm--}}
  <link rel="stylesheet" href="{{ URL::to('bower_components/jquery-confirm-master/dist/jquery-confirm.min.css') }}">
  @yield('customCss')
  <link rel="stylesheet" type="text/css" href="{{ URL::to('dist/css/style.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#!" class="logo">
      <!-- mini logo for  mini 50x50 pixels -->
       <span class="logo-mini"><b>S</b>AP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ Auth::user()->getToko()->nama_toko }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          @if(Auth::user()->level == 'admin' || Auth::user()->level == 'gudang')
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              @if(count(Auth::user()->getStok()) == 0) 
                <span class="label label-danger"></span>
              @else 
                <span class="label label-danger">{{count(Auth::user()->getStok())}}</span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki @if(Auth::user()->getStok()) {{ count(Auth::user()->countStok()) }} @else 0 @endif Pesan</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                @if(Auth::user()->getStok())
                  @foreach(Auth::user()->getStok() as $data)
                      <li><!-- start message -->
                        <a href="#">
                          <h4>
                            {{ $data['nama_barang'] }}
                            <small><i class="fa fa-cubes"></i> <strong>{{ $data['stok'] }}</strong></small>
                          </h4>
                        </a>
                      </li>
                    @endforeach
                      <li>
                        <a href="{{route('getStokBarang')}}" style="text-decoration: none;color: red">Lihat Semua Pesan</a>
                      </li>

                    @else
                        <li><!-- start message -->
                        <a href="#!">
                          Tidak memiliki pesan
                        </a>
                      </li>
                  @endif
                  <!-- end message -->
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          @endif
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ URL::to('photo/admin/avatar5.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ URL::to('photo/admin/avatar5.png') }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->username }}
                  <small>Halo Saya {{ Auth::user()->username }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->

  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sistem Akuntansi Pertokoan
        <small>Control panel</small>
      </h1>
    </section>
      
    <!-- Main content -->
    <section class="content">
      @include('layouts.alert')
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="#!">Sistem Akuntansi Pertokoan</a>.</strong>
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ URL::to('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::to('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::to('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::to('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::to('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::to('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
{{-- morris js --}}
<script src="{{ URL::to("bower_components/raphael/raphael.min.js") }}"></script>
<script src="{{ URL::to('bower_components/morris.js/morris.min.js') }}"></script>
{{--Toastr--}}
<script src="{{ URL::to('bower_components/toastr/toastr.min.js') }}"></script>
{{--Select2--}}
<script src="{{ URL::to('bower_components/select2/select2.min.js') }}"></script>
{{--datatables--}}
<script src="{{ URL::to('bower_components/datatables.net/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('bower_components/datatables.net/dataTables.bootstrap.min.js') }}"></script>
{{--Jquery confirm--}}
<script src="{{ URL::to('bower_components/jquery-confirm-master/dist/jquery-confirm.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.widget.bridge('uibutton', $.ui.button);
    $(".select2").select2();
    $('#mytable').DataTable();
    $('.bulan').datepicker( {
          format: "mm",
          viewMode: "months", 
          minViewMode: "months"
      });

      $('.tahun').datepicker( {
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years"
      });
  })
</script>
@yield('customJs')
</body>
</html>
