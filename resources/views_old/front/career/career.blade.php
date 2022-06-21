@extends('layouts.frontend.master')
@section('title')
Career
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/career.css') }}">
@endsection
@section('content')
<style>.pagination_career {display: flex;justify-content: center;align-items: baseline;margin-top: 50px;}.page-link {padding: 8px 20px;line-height: 1.5;border: 2px solid #dee2e6;}.page-item.active .page-link {background-color: #8b4449;border-color: #83252e;}</style>
    <section class="career hero-pt">
        <div class="container">
            <div class="title-box">
                <h1 class="sc-title">
                    <span>Available Jobs</span>
                </h1>
            </div>
            @foreach($jobs as $job)
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">{{$job->title}}</h1>
                                <p class="job-location">{{$job->location}}</p>
                                <p class="text">{!! \Illuminate\Support\Str::limit($job->description , 309, $end='...') !!}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    <a href="{{url('job/'.$job->id.'/apply')}}" class="box-btn">
                                        <span>View Details</span>
                                        <span><img src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pagination_career">
                {{$jobs->links()}}
            </div>


        </div>
    </section>
@endsection
