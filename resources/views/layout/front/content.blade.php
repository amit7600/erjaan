<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Digital Survey</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- css -->
        <link rel="stylesheet" href="{{asset('/erjaanhtml/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtml/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtmlarbaic/css/owl.carousel.css')}}">

        <link rel="stylesheet" href="{{asset('/erjaanhtml/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtml/css/layout.css')}}">
        <link rel="stylesheet" href="{{asset('/erjaanhtml/css/responsive.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <!-- Js -->
        <script src="{{asset('/erjaanhtml/js/jquery.min.js')}}"></script>
        <script src="{{asset('/erjaanhtml/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/erjaanhtml/js/animated.js')}}"></script>
        <script src="{{asset('/erjaanhtml/js/parallax.min.js')}}"></script>
        <script src="{{asset('/erjaanhtml/js/wow.js')}}"></script>
        <script src="{{asset('/erjaanhtmlarbaic/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('/erjaanhtml/js/custom.js')}}"></script>

    </head>


    <!-- page header -->
    @include('layout.front.header')
    <!-- page header -->

    <!-- page content -->
    @yield('inner_body')
    <!-- /page content -->

    <!-- page footer -->
    @include('layout.front.footer')        
    <!-- page footer -->