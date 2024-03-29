<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <!-- FontAwesome 4.3.0 -->
    @include('includes.head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('home')}}" class="logo"><b>Admin</b>LTE</a>
        @include('includes.header')
      </header>
      <!-- Left side column. contains the logo and sidebar -->
    @include('includes.nav')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        {{-- <div id="page-wrapper"> --}}
            <div id="content-inner">
        <!-- Content Header (Page header) -->
    @yield('content')
            </div>
        </div>
      </div><!-- /.content-wrapper -->
      @include('includes.footer')
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->

   
  </body>
</html>