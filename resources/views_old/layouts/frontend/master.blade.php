<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>JSSSL | @yield('title')</title>
    @include('layouts.frontend.css')

    @yield('pageCss')
</head>

<body>
@include('layouts.frontend.header')

@yield('content')


@include('layouts.frontend.footer')
@include('layouts.frontend.scripts')
@yield('pageScripts')
</body>

</html>