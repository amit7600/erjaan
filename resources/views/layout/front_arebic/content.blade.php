<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>الأرجان</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- css -->
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/owl.carousel.css')}}">

        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/layout.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/rtlstyle.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css">

        <!-- Js -->
        <script src="{{asset('/erjaanhtmlarbaic/js/jquery.min.js')}}"></script>
        <script src="{{asset('/erjaanhtmlarbaic/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/erjaanhtmlarbaic/js/animated.js')}}"></script>
        <script src="{{asset('/erjaanhtmlarbaic/js/parallax.min.js')}}"></script>
        <script src="{{asset('/erjaanhtmlarbaic/js/wow.js')}}"></script>
        <script src="{{asset('/erjaanhtmlarbaic/js/owl.carousel.min.js')}}"></script>
        

        <script src="{{asset('/erjaanhtmlarbaic/js/custom.js')}}"></script>

    </head>


    <!-- page header -->
    @include('layout.front_arebic.header')
    <!-- page header -->

    <!-- page content -->
    @yield('inners_body')
    <!-- /page content -->

    <!-- page footer -->
    @include('layout.front_arebic.footer')        
    <!-- page footer -->