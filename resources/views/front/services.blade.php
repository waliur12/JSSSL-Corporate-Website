@extends('layouts.frontend.master')
@section('title')
    Services
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/services.css') }}">
    <style>
        .service-desc p{
            color: white;
        }
    </style>
@endsection
@section('content')
<section class="services-hero hero-pt">
    <div class="container">
        <div class="content-wrapper">
            <div class="inner-content">
                <h1 class="sc-title">
                    <span>We provide customized security solutions to our clients</span>
                </h1>
                <p class="text">JSS Services Ltd. has been focusing on a wide range of security services at different levels. Both at private and govt. levels we value the asset of our respected clients above anything.</p>
            </div>
            <div class="inner-image">
                <img class="img-fluid" src="{{asset('frontend/assets/img/services/services-hero.png')}}" alt="serving">
            </div>
        </div>
    </div>
</section>

<div class="d-none d-md-block">
    @if (!empty($services))
    @foreach ($services as $service)
    <section class="physical-security services-sc" id="service{{$service->service_id}}">
        <div class="container" >
            <div class="sc-head">
                <h1>{{$service->service_name}}</h1>
            </div>
            <div class="row no-gutters">
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="tab-wrapper">
                        <h2>What We Offer</h2>
                        <div class="nav flex-column nav-pills" id="ps-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($service->sub_services as  $key=>$sub_service)
                            <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="ps-tab-{{$sub_service->sub_service_id}}" data-toggle="pill" href="#ps-pills-{{$sub_service->sub_service_id}}" role="tab"
                                aria-controls="ps-pills-{{$sub_service->sub_service_id}}" aria-selected="true">{{$sub_service->sub_service_name}}</a>
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-9">
                    <div class="tab-content" id="ps-tabContent">
                        @foreach ($service->sub_services as $key=>$sub_service)
                        <div class="tab-pane fade show {{$key == 0 ? 'active' : ''}}" id="ps-pills-{{$sub_service->sub_service_id}}" role="tabpanel"
                            aria-labelledby="ps-tab-{{$sub_service->sub_service_id}}">
                            <div class="inner-content">
                                <img src="{{asset($sub_service->sub_service_image)}}" alt="security" class="img-fluid">
                                <div class="content service-desc">
                                    <h3 class="title">{{$sub_service->sub_service_name}}</h3>
                                    <p class="desc">{!!$sub_service->sub_service_description!!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    @endif



</div>

<!-- services for small devices -->
<div class="d-block d-md-none">
    @if (!empty($services))
    @foreach ($services as $service)
    <section class="physical-security services-sc" id="service{{$service->service_id}}">
        <div class="container">
            <div class="sc-head">
                <h1>{{$service->service_name}}</h1>
            </div>
            <div class="content-wrapper">
                @foreach ($service->sub_services as $key=>$sub_service)
                <div class="content-inner ">
                    <img src="{{asset($sub_service->sub_service_image)}}" alt="Security" class="img-fluid">
                    <h2>{{$sub_service->sub_service_name}}</h2>
                    <p class="text">{!!$sub_service->sub_service_description!!}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach
    @endif
</div>
@endsection