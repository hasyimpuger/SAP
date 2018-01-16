<!DOCTYPE html>
<html>
<head>
  <title>Sistem Akuntansi Pertokoan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('photo/favicon-32x32.png')}}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::to('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ URL::to('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
    <!-- Main content -->
    <div class="row">
      <div class="container">
        <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
  
        <div class="error-content" style="padding-top: 30px">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="{{ route('home.dashboard') }}">return to Home</a> or try using the search form.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
      </div>
    </div>
</body>
</html>