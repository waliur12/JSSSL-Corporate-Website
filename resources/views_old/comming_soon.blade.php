@extends('front.home')
@section('title','Jsssl | Cooing Soon')
@section('style')
<link rel="stylesheet" href="{{asset('frontend/assets/css/coming-soon.css')}}">
@endsection
@section('content')

<section class="coming-soon hero-pt">
    <div class="container">
        <div class="content-wrapper">
            <img src="{{asset('frontend/assets/img/coming-soon-security.png')}}" alt="coming-soon-security">
            <h1>The page is under development</h1>
            <p>It’s coming soon</p>
        </div>
    </div>
</section>
@endsection