@extends('layouts.frontend.master')
@section('title')
    News & Event
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/news-events.css') }}">
@endsection
@section('content')
<section class="update-news news-events hero-pt">
    <div class="container">
        <div class="title-box">
            <h1 class="sc-title">News Updates</h1>
        </div>
        <div class="news-slide slide owl-carousel">
            @if (!empty($news))
                @foreach ($news as $item)
                <div class="item">
                    <div class="content-wrapper">
                        <a href="{{route('news.details',[$item->news_id])}}" class="d-block">
                            <img src="{{asset($item->news_image)}}" alt="slide-thumb" class="img-fluid" style="width: 323px; height: 246px;">
                            <p>{{$item->news_published_at->toFormattedDateString()}}</p>
                            <h3>{{$item->news_title}}</h3>
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
    

        </div>
    </div>
</section>



<section class="ongoing-events news-events">
    <div class="container">
        <div class="title-box">
            <h1 class="sc-title">Ongoing Events</h1>
        </div>
        <div class="news-slide slide owl-carousel">
            @if (!empty($events))
            @foreach ($events as $event)
            <div class="item">
                <div class="content-wrapper">
                    <a href="{{route('event.details',[$event->event_id])}}" class="d-block">
                        <img src="{{asset($event->event_image)}}" alt="slide-thumb" class="img-fluid" style="width: 323px; height: 246;">
                        <p>{{$event->event_dated_at->toFormattedDateString()}}</p>
                        <h3>{{$event->event_title}}</h3>
                    </a>
                </div>
            </div>
            @endforeach
        @endif   
        </div>
    </div>
</section>
@endsection