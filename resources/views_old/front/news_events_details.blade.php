@extends('layouts.frontend.master')
@section('title')
    News & Event Details
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/news-events.css') }}">
@endsection
@section('content')
    @if (!empty($news))
        <section class="news-events-details hero-pt">
            <div class="container">
                <div class="content-wrapper">
                    <img src="{{ asset($news->news_image) }}" alt="details" class="img-fluid">
                    <div class="meta">
                        <p class="text">{{ $news->news_published_at->toFormattedDateString() }}</p>
                    </div>
                    <h1 class="sc-title">
                        <span>{{ $news->news_title }}</span>
                    </h1>
                    <div class="description editor-description-box">
                        <p class="text"> {!!$news->news_description !!}</p>

                    </div>
                </div>
            </div>
        </section>

        <section class="related-news news-events">
            <div class="container">
                <div class="title-box">
                    <h1 class="sc-title">Related News</h1>
                </div>
                <div class="related-news-slide owl-carousel">
                    @if (!empty($related_news))
                    @foreach ($related_news as $item)
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
    @endif
    @if (!empty($event))
        <section class="news-events-details hero-pt">
            <div class="container">
                <div class="content-wrapper">
                    <img src="{{ asset($event->event_image )}}" alt="details" class="img-fluid">
                    <div class="meta">
                        <p class="text">{{ $event->event_dated_at->toFormattedDateString() }}</p>
                    </div>
                    <h1 class="sc-title">
                        <span>{{ $event->event_title }}</span>
                    </h1>
                    <div class="description editor-description-box">
                        <p class="text">{!!$event->event_description !!}</p>

                    </div>
                </div>
            </div>
        </section>

        <section class="related-news news-events">
            <div class="container">
                <div class="title-box">
                    <h1 class="sc-title">Related Events</h1>
                </div>
                <div class="related-news-slide owl-carousel">
                    @if (!empty($related_events))
                    @foreach ($related_events as $event)
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
    @endif
@endsection
