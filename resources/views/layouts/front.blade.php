<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    {{-- <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title> --}}
    @yield('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
@include('includes.web-head')

</head>

<body>
    @if (session()->has('success'))
         <div id="msg" class="alert alert-success">
             {{session()->get('success')}}
         </div>   
    @endif
    <!-- Start Main Top -->
    @include('includes.web-header')
    <!-- End Main Top -->

    <!-- Start Main Top -->
   @include('includes.web-nav')
    <!-- End Main Top -->

    <!-- Start Top Search -->
    @yield('content')
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
    @include('includes.web-footer')
</body>

</html>