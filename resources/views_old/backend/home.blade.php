<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','JSSSL Dashboard')</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('vendors/iconic-fonts/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/flat-icons/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css')}}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/titleicon.png')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <!-- Page Specific CSS (Slick Slider.css) -->
    <link href="{{asset('assets/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet">
    <!-- Costic styles -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/jquery-toast-plugin/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
     integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
     crossorigin="anonymous" />
    @yield('style')

</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">
<!-- Preloader -->
<div id="preloader-wrap">
    <div class="spinner spinner-8">
        <div class="ms-circle1 ms-child"></div>
        <div class="ms-circle2 ms-child"></div>
        <div class="ms-circle3 ms-child"></div>
        <div class="ms-circle4 ms-child"></div>
        <div class="ms-circle5 ms-child"></div>
        <div class="ms-circle6 ms-child"></div>
        <div class="ms-circle7 ms-child"></div>
        <div class="ms-circle8 ms-child"></div>
        <div class="ms-circle9 ms-child"></div>
        <div class="ms-circle10 ms-child"></div>
        <div class="ms-circle11 ms-child"></div>
        <div class="ms-circle12 ms-child"></div>
    </div>
</div>
<!-- Overlays -->
<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity"
     data-toggle="slideRight"></div>
<!-- Sidebar Navigation Left -->
@include('backend.inc.leftsidebar')
<!-- Sidebar Right -->

<!-- Main Content -->
<main class="body-content">
    <!-- Navigation Bar -->
     @include('backend.inc.header')
    <div class="ms-content-wrapper">
      @yield('content')
    </div>
</main>
<!-- MODALS -->
<aside id="ms-quick-bar" class="ms-quick-bar fixed ms-d-block-lg">

{{--     <ul class="nav nav-tabs ms-quick-bar-list" role="tablist">

        <li class="ms-quick-bar-item ms-has-qa" role="presentation" data-toggle="tooltip" data-placement="left"
            title="Launch To-do-list" data-title="To-do-list">
            <a href="#qa-toDo" aria-controls="qa-toDo" role="tab" data-toggle="tab">
                <i class="flaticon-list"></i>

            </a>
        </li>
        <li class="ms-quick-bar-item ms-has-qa" role="presentation" data-toggle="tooltip" data-placement="left"
            title="Launch Reminders" data-title="Reminders">
            <a href="#qa-reminder" aria-controls="qa-reminder" role="tab" data-toggle="tab">
                <i class="flaticon-bell"></i>

            </a>
        </li>
        <li class="ms-quick-bar-item ms-has-qa" role="presentation" data-toggle="tooltip" data-placement="left"
            title="Launch Notes" data-title="Notes">
            <a href="#qa-notes" aria-controls="qa-notes" role="tab" data-toggle="tab">
                <i class="flaticon-pencil"></i>

            </a>
        </li>
        <li class="ms-quick-bar-item ms-has-qa" role="presentation" data-toggle="tooltip" data-placement="left"
            title="Invite Members" data-title="Invite Members">
            <a href="#qa-invite" aria-controls="qa-invite" role="tab" data-toggle="tab">
                <i class="flaticon-share-1"></i>

            </a>
        </li>
        <li class="ms-quick-bar-item ms-has-qa" role="presentation" data-toggle="tooltip" data-placement="left"
            title="Settings" data-title="Settings">
            <a href="#qa-settings" aria-controls="qa-settings" role="tab" data-toggle="tab">
                <i class="flaticon-gear"></i>

            </a>
        </li>
    </ul> --}}
</aside>


<!-- Global Required Scripts Start -->
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<!-- Global Required Scripts End -->
<!-- Page Specific Scripts Start -->

{{-- <script src="{{asset('assets/js/widgets.js')}}"></script> --}}
<script src="{{asset('assets/js/clients.js')}}"></script>

<script src="{{asset('assets/js/d3.v3.min.js')}}"></script>
<script src="{{asset('js/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
<script src="{{asset('assets/js/topojson.v1.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/data-tables.js')}}"></script>

<script src="{{asset('backend')}}/vendors/sweetalert/sweetalert.min.js"></script>
<!-- Page Specific Scripts Finish -->
<!-- Costic core JavaScript -->
<script src="{{asset('assets/js/framework.js')}}"></script>
<!-- Settings -->
<script src="{{asset('assets/js/settings.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
 --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
 integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
 crossorigin="anonymous"></script>
 <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function(){
        let url = window.location.origin+'/admin';
        console.log(url);
        if(url == "http://127.0.0.1:8000/admin"){
            $( ".menu-item" ).removeClass( "active");
        }
    });

</script>
@yield('js')
</body>


</html>
