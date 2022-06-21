@extends('layouts.frontend.master')
@section('title')
   Home
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/index.css') }}">
@endsection
@section('content')
<section class="index-hero">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="content-wrapper">
                    <h1 class="sc-title">{!!$hero_section->title!!}
                        {{-- <span>{{$hero_section->middle_part_of_title}}</span>
                        {{$hero_section->last_part_of_title}} --}}
                    </h1>
                    <div class="description editor-description-box">
                        {!!($hero_section->description)!!}
                      </div>
                      
                    <div class="hcall-wrapper">
                        <a href="{{route('contact.us')}}" class="box-btn red-bg">
                            <span>Get In Touch</span>
                            <span><img src="{{asset('frontend/assets/img/icon-svg/headset-mic-whtie.svg')}}" alt="mic"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="image-wrapper">
                    <img src="{{asset('backend/'.$hero_section->image)}}" alt="man">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="index-serving">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-12 col-md-12 col-lg-6 order-1 order-lg-0">
                <div class="image-wrapper">
                    <div class="image-inner">
                        <img class="img-fluid" src="{{asset('frontend/assets/img/home/serving.png')}}" alt="serving man">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 order-0 order-lg-1">
                <div class="content-wrapper">
                    <div class="content-inner">
                        <h1 class="sc-title">
                            <span>Serving You Since 1994</span>
                        </h1>
                        <p class="text">JSS Services Ltd, one of the pioneers and a leading Security firm, dealing with
                            trust and
                            confidence not only in the Capital Market but across the country with utmost dedication.
                            Since its
                            inception is providing best services to the clients by a smart and dedicated working team
                            with a high
                            technical support.</p>
                        <div class="serving-btn-wrapper">
                            <a href="{{route('about.us')}}" class="box-btn">
                                <span>Learn About Us</span>
                                <span><img src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="client-solution">
    <div class="container">
        <div class="sc-title-wrapper">
            <div class="title-box">
                <h1 class="sc-title">We provide
                    <span>customized security solutions</span>
                    to our clients
                </h1>
            </div>
            <div class="view-btn-box d-none d-md-block">
                <a href="{{route('service.index')}}" class="box-btn">
                    <span>View All</span>
                    <span><img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                </a>
            </div>
        </div>
        <div class="body-wrapper">
            <div class="row no-gutters custom-margin">
                @foreach ($services as $service )
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="content-wrapper">
                            <img class="img-fluid" src="{{asset('./'.$service->service_image)}}" alt="physical-security">
                            <h2 class="title">{{$service->service_name}}</h2>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="container d-block d-md-none">
        <div class="view-btn-box-mobile">
            <a href="{{route('service.index')}}" class="box-btn">
                <div class="box-btn-inner">
                    <span>View Our Services</span>
                    <span><img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                </div>
            </a>
        </div>
    </div>
</section>


<section class="choose-us">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-2 col-md-4 order-1 order-sm-0">
                <div class="image-wrapper">
                    <img src="{{asset('frontend/assets/img/home/why-choose-us.png')}}" alt="choose-us">
                </div>
            </div>
            <div class="col-12 col-sm-10 col-md-8 order-0 order-sm-1">
                <div class="content-wrapper">
                    <h1 class="sc-title">Why choose us?</h1>
                    <div class="steps-wrapper">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-steps">
                                <div class="steps-inner">
                                    <div class="icon-box">
                                        <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/why-choose-us-icon-1.svg')}}"
                                             alt="icon-1">
                                    </div>
                                    <div class="content-box">
                                        <h2 class="title">Security Risk Management</h2>
                                        <p>Providing proactive identification & resolution of security risks to
                                            Businesses.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-steps">
                                <div class="steps-inner">
                                    <div class="icon-box">
                                        <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/why-choose-us-icon-2.svg')}}"
                                             alt="icon-2">
                                    </div>
                                    <div class="content-box">
                                        <h2 class="title">Customized
                                            solutions</h2>
                                        <p>We consult with you to understand your security needs and provide customized
                                            security
                                            solutions.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-steps">
                                <div class="steps-inner">
                                    <div class="icon-box">
                                        <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/why-choose-us-icon-3.svg')}}"
                                             alt="icon-3">
                                    </div>
                                    <div class="content-box">
                                        <h2 class="title">Difficult
                                            Situations</h2>
                                        <p>We have proven that we can handle extremely challenging and high-risk
                                            situations.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-steps">
                                <div class="steps-inner">
                                    <div class="icon-box">
                                        <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/why-choose-us-icon-4.svg')}}"
                                             alt="icon-4">
                                    </div>
                                    <div class="content-box">
                                        <h2 class="title">Super Fast
                                            Response</h2>
                                        <p>We can provide security solutions in less time than our competitors.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="our-clients">
    <div class="container">
        <div class="sc-title-wrapper">
            <div class="title-box">
                <h1 class="sc-title">Don’t just believe us,
                    <span>Believe in our satisfied customers.</span>
                </h1>
            </div>
            <div class="view-btn-box d-none d-md-block">
                <a href="{{route('our.client')}}" class="box-btn">
                    <span>View All Clients</span>
                    <span><img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="clients-slide owl-carousel">
            @foreach ($clients as $client)
                <div class="item">
                    <a href="#" class="logo">
                        <img src="{{asset('/'.$client->client_logo)}}" alt="client logo">
                    </a>
                </div>
            @endforeach

        </div>
      </div>
    <div class="container d-block d-md-none">
        <div class="view-btn-box-mobile">
            <a href="{{route('our.client')}}" class="box-btn">
                <div class="box-btn-inner">
                    <span>View All Clients</span>
                    <span><img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                </div>
            </a>
        </div>
    </div>
</section>


<section class="training-school">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="content-wrapper">
                    <div class="content-inner">
                        <h1 class="sc-title">
                            <span>Take a look at <br> our training school</span>
                        </h1>
                        <p class="text">Security guard training classes at JSSSL Training school are taught by
                            Bangladesh’s top
                            security professionals under the administrative oversight.</p>
                        <div class="training-btn-wrapper">
                            <a href="{{route('training.school')}}" class="box-btn">
                                <span>Learn More</span>
                                <span><img src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="image-wrapper">
                    <div class="image-inner">
                        <img class="img-fluid" src="{{asset('frontend/assets/img/home/training-school.png')}}" alt="training-school">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="index-cne">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-steps">
                <div class="content-wrapper">
                    <img class="img-fluid" src="{{asset('frontend/assets/img/home/career-thumb.png')}}" alt="career">
                    <h2>Terms & Policies</h2>
                    <p class="text">JSS services Ltd. has been focusing on a wide range of security services at
                        different
                        levels.</p>
                    <div class="cne-btn-wrapper">
                        <a href="{{ route('terms.policy') }}" class="box-btn">
                            <span>Learn More</span>
                            <span><img src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-steps">
                <div class="content-wrapper">
                    <img class="img-fluid" src="{{asset('frontend/assets/img/home/ne-thumb.png')}}" alt="News Events">
                    <h2>Ethical Code of Conduct</h2>
                    <p class="text">JSS services Ltd. has been focusing on a wide range of security services at
                        different
                        levels.</p>
                    <div class="cne-btn-wrapper">
                        <a href="{{ route('ethical.code') }}" class="box-btn">
                            <span>Learn More</span>
                            <span><img src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<div class="modal" id="notice_modal" tabindex="-1" role="dialog">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header text-center">-->
<!--        <h5 class="modal-title w-100" >নোটিশ</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        <p>অনিবার্য কারণ বশত বাংলাদেশ নির্বাচন কমিশনের আইডিএ - ২ এ ডাটা এন্ট্রি অপারেটর এবং ড্রাইভারদের আগামী ৬/১১/২০২১ তারিখে এবং ৭/১১/২০২১ তারিখে অনুষ্ঠিতব্য মৌখিক এবং ব্যবহারিক পরীক্ষা সাময়িক স্থগিত করা হল। পরবর্তীতে পরীক্ষার তারিখ অবগত করা হবে। </p>-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

@endsection

@section('pageScripts')
<script type="text/javascript">
    // // $(window).on('load', function() {
    // $( document ).ready(function() {
    //     $('#notice_modal').modal('show');
    // });
</script>

@endsection

