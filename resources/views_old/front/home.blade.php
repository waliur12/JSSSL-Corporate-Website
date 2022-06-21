<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','JSSSL HomePage')</title>

    <!-- favicon type of .ico, .gif, .png, .svg -->
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/img/jsssl.png')}}"/>

    <!--fontawesome-5 icon-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.all.min.css')}}">

    <!--bootstrap css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/jquery-toast-plugin/jquery.toast.min.css')}}">

    <!--custom css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/career.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/index.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('frontend/assets/js/owl.carousel.min.js')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
     integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
     crossorigin="anonymous" />
    @yield('style')

</head>

<body>
    {{-- <div class="ajax_loader centered" > <img src='{{asset("frontend/loader.gif")}}'/></div> --}}
@include('front.inc.header')


@yield('content')


@include('layouts.frontend.footer')


<!--bootstrap js-->
<script src="{{asset('frontend/assets/js/vendor/jquery-3.4.1.min.js')}}"></script>
<!-- <script src="assets/js/vendor/jquery-1.12.4.min.js"></script> -->
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-toast-plugin/jquery.toast.min.js')}}"></script>

<!--owl-carousel js-->
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}" ></script>
{{-- scre --}}
<!--custom js-->
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
     integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
     crossorigin="anonymous"></script>
</body>
@yield('scripts')
</html>
