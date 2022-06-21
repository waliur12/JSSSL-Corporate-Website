@extends('layouts.frontend.master')
@section('title')
   Our Clients
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/our-clients.css') }}">
@endsection
@section('content')
<section class="our-clients hero-pt">
    <div class="container">
        <div class="title-box">
            <h1 class="sc-title">Our Clients</h1>
        </div>
        <div class="our-clients-wrapper">
            @if (!empty($client_categories))
                @foreach ($client_categories as $client_category)
                <div class="content-wrapper">
                    <h2>{{$client_category->client_category_name}}</h2>
                    <div class="row">
                        @foreach ($client_category->clients as $client)
                        <div class="col-4 col-md-3 col-lg-2">
                            <div class="content-inner">
                                <a href="#" class="d-block">
                                    <img src="{{asset($client->client_logo)}}" alt="" class="img-fluid">
                                    <div class="client-title">
                                        <h5>{{$client->client_name}}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @endif
        

    </div>
    </div>
</section>
@endsection