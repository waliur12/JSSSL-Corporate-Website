@extends('layouts.frontend.master')
@section('title')
    JSSSL|404
@endsection
@section('pageCss')
<link rel="stylesheet" href="{{asset('frontend/assets/css/coming-soon.css')}}">
@endsection
@section('content')

<section class="coming-soon hero-pt">
    <div class="container">
        <div class="content-wrapper">
            {{-- <img src="{{asset('frontend/assets/img/coming-soon-security.png')}}" alt="coming-soon-security"> --}}
            <h1>404</h1>
            <p>Page not found!</p>
        </div>
    </div>
</section>
@endsection