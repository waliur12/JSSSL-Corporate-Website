@extends('layouts.frontend.master')
@section('title')
Terms & Policy
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/terms-policy.css') }}">
@endsection
@section('content')
    <section class="terms-policy ">
        <div class="container">
            <div class="terms-policy-wrapper">
                <div class="row">
                    <div class="col-12 col-md-4 d-none d-md-block">
                        <div class="tp-tab-wrapper">
                            <h1 class="sc-title">
                                <span>Terms & Policies</span>
                            </h1>
                            <div id="list-example" class="list-group">
                                @if (!empty($terms_policies))
                                    @foreach ($terms_policies as $terms_policy)
                                        <a class="list-group-item list-group-item-action"
                                            href="#list-item-{{ $terms_policy->terms_policy_id }}">
                                            {{ $terms_policy->terms_policy_heading }}
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="title-box-mobile d-block d-md-none">
                            <h1 class="sc-title">
                                <span>Terms & Policies</span>
                            </h1>
                        </div>
                        <div data-spy="scroll" data-target="#list-example" data-offset="0"
                            class="scrollspy-example tp-content-wrapper">
                            @if (!empty($terms_policies))
                                @foreach ($terms_policies as $key=>$terms_policy)
                                @if ($key == 0)
                                <div class="content-item editor-description-box" id="list-item-{{ $terms_policy->terms_policy_id }}">
                                    <h3>{{ $terms_policy->terms_policy_heading }}</h3>
                                    <p class="text">{!! $terms_policy->terms_policy_description!!}</p>
                                   @if (!empty($ceo))
                                   <div class="tbx-wrapper">
                                    <div class="image-rapper">
                                        <img src="{{ asset($ceo->board_member_image) }}" alt="ceo"
                                            class="img-fluid">
                                    </div>
                                    <div class="content">
                                        <h2 class="title">{{$ceo->board_member_name}}</h2>
                                        <p>{{$ceo->board_member_designation}}</p>
                                    </div>
                                </div>
                                   @endif
                             
                                </div>
                                @else 
                                <div class="content-item editor-description-box" id="list-item-{{ $terms_policy->terms_policy_id }}">
                                    <h3>{{ $terms_policy->terms_policy_heading }}</h3>
                                    <p class="text">{!! $terms_policy->terms_policy_description!!}</p>
                                </div>
                                @endif
                          
                                @endforeach
                            @endif
                        
                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
