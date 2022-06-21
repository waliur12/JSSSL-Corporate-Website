@extends('layouts.frontend.master')
@section('title')
    Ethical Code
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
                                <span>Ethical Code of Conduct</span>
                            </h1>
                            <div id="list-example" class="list-group">
                                @if (!empty($ethical_codes))
                                    @foreach ($ethical_codes as $ethical_code)
                                        <a class="list-group-item list-group-item-action"
                                            href="#list-item-{{ $ethical_code->ethical_code_id }}">{{ $ethical_code->ethical_code_heading }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="title-box-mobile d-block d-md-none">
                            <h1 class="sc-title">
                                <span>Ethical Code of Conduct</span>
                            </h1>
                        </div>
                        <div data-spy="scroll" data-target="#list-example" data-offset="0"
                            class="scrollspy-example tp-content-wrapper">
                            @if (!empty($ethical_codes))
                                @foreach ($ethical_codes as $key => $ethical_code)
                                    @if ($key == 0)
                                        <div class="content-item editor-description-box" id="list-item-{{ $ethical_code->ethical_code_id }}">
                                            <h3>{{ $ethical_code->ethical_code_heading }}</h3>
                                            <p class="text">{!!$ethical_code->ethical_code_description !!}</p>
                                            @if (!empty($ceo))
                                                <div class="tbx-wrapper">
                                                    <div class="image-rapper">
                                                        <img src="{{ asset($ceo->board_member_image) }}" alt="ceo"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="content">
                                                        <h2 class="title">{{ $ceo->board_member_name }}</h2>
                                                        <p>{{ $ceo->board_member_designation }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="content-item editor-description-box" id="list-item-{{ $ethical_code->ethical_code_id }}">
                                            <h3>{{ $ethical_code->ethical_code_heading }}</h3>
                                            <p class="text">{!!$ethical_code->ethical_code_description!!}</p>
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
