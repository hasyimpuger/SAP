<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAP | Menu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('photo/favicon-32x32.png')}}">
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ URL::to('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::to('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::to('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::to('plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login">
    <div class="login-logo">
        <a href="../../index2.html"><b>{{ Auth::user()->getToko()->nama_toko }}</b></a><br>
        <img class="img-rounded" width="200" height="200" src="{{ URL::to('photo/toko', Auth::user()->getPhoto()) }}" />
    </div>
    <!-- /.login-logo -->
    <section class="error-wrapper text-center" >
        <div class="text-center">
            <a href="{{ route('barang.index') }}"><img src="{{ URL::to('dist/img/box.png') }}" /></a>
            <a href="{{ route('transaksi.index') }}"><img src="{{ URL::to('dist/img/bag.png') }}" /></a>
            {{-- <a ><img src="{{ URL::to('dist/img/book.png') }}" /></a> --}}
            <a href="{{ route('getKeuangan') }}"><img src="{{ URL::to('dist/img/money.png') }}" /></a>
            @if(Auth::user()->level == 'superadmin')
            <a href="{{ route('setting.index') }}"><img src="{{ URL::to('dist/img/setting.png') }}" /></a>
            @endif
            <br>
        </div>
    </section>
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="{{ URL::to('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::to('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::to('plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
