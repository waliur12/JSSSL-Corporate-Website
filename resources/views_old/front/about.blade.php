@extends('layouts.frontend.master')
@section('title')
    About-Us
@endsection
@section('pageCss')
<link rel="stylesheet" href="{{asset('frontend/assets/css/about-us.css')}}">
@endsection
@section('content')
<section class="about-hero hero-pt">
    <div class="container">
        <div class="content-wrapper">
            <div class="inner-content">
                <h1 class="sc-title">
                    <span>Serving You Since 1994</span>
                </h1>
                <p class="text">JSS Services Ltd, one of the pioneers and a leading Security firm, dealing with trust and confidence not only in the Capital Market but across the country with utmost dedication. Since its inception is providing best services to the clients by a smart and dedicated working team with a high technical support.</p>
            </div>
            <div class="inner-image">
                <img class="img-fluid" src="{{asset('frontend/assets//img/about-us/serving-you.png')}}" alt="serving">
            </div>
        </div>
    </div>
</section>


<section class="reach-history">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5 order-1 order-lg-0">
                <div class="image-wrapper">
                    <img class="img-fluid" src="{{asset('frontend/assets//img/about-us/rich-history.png')}}" alt="rich history">
                </div>
            </div>
            <div class="col-12 col-lg-7 order-0 order-lg-1">
                <div class="content-wrapper">
                    <h1 class="sc-title">Our Rich History</h1>
                    <p class="text">JSS Services Ltd. (Jamuna Safety & Security Services Ltd.) is a local manpower outsourcing firm founded by its Owner and Chairman Lt. Col. Md. Zillur Rahman (Retd) in July 1994, incorporated in the year 2000 under the Companies Act 1994 of Bangladesh. To build a financially successful, growth-oriented business that provides specialized safe & security protective in Dhaka and across the country. The trust behind the entrepreneurial decision was confidence, tenacity and a vision that is relentlessly pursued while facing incredible challenges to his nurtured dream and to the business that has been established. The company is one of the pioneers and leading security service providers in the country. “Agile and Vigilant like Tiger” – that is the motto in our heart.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="our-mvg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-steps">
                <div class="content-wrapper">
                    <h2 class="title">Our Mission</h2>
                    <p class="text">Prevention of Crime with professionalism rather than accusations with a view to upgrade the highest standards of security services to International level based on trust and confidence.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 col-steps">
                <div class="content-wrapper">
                    <h2 class="title">Our Vision</h2>
                    <p class="text">SSSL’S Vision is to be the most professional security leader in the industry by exceeding our customers’ expectations and creating client-agency partnerships, while valuing each and everyone.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 col-steps">
                <div class="content-wrapper">
                    <h2 class="title">Our Goal</h2>
                    <p class="text">Building a topmost position in the security horizon with commitment and excellence.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="why-different">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 order-1 order-lg-0">
                <div class="image-wrapper">
                    <img class="img-fluid" src="{{asset('frontend/assets//img/about-us/why-different.png')}}" alt="different">
                </div>
            </div>
            <div class="col-12 col-lg-8 order-0 order-lg-1">
                <div class="content-wrapper">
                    <h1 class="sc-title">
                        <span>Why are we different</span>
                    </h1>
                    <ul class="checkmark">
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">One of the pioneers of the security industry with 24 years experience.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">Trust, Honesty, reliability is what makes JSSSL successful.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">We provide customized security solutions to our clients.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">We value our ability to act instantly, no matter what the situation is.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">We are quicker to response under any circumstances all over the country</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">We are capable of handling extremely challenging and high risk situations.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">Top-Notch service quality.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">Our flexibility to work to your needs is what our clients and customers value immensely.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{asset('frontend/assets//img/icon-svg/checkmark.svg')}}" alt="checkmark">
                            </p>
                            <p class="text">Don’t just believe us- Believe our satisfied customers.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="board-of-director">
    <div class="container">
        <div class="founder-chairman">
            @if (!empty($founder_speach))
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="content-wrapper editor-description-box">
                        <h1>{{$founder_speach->designation}}</h1>
                        <p class="text">{!!$founder_speach->description!!}</p>       
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="image-wrapper">
                        <img src="{{asset($founder_speach->image)}}" alt="founder&chairman">
                    </div>
                </div>
            </div>
            @endif          
        </div>
        <div class="comp-members">
            <div class="row no-gutters custom-margin">
                @if (!empty($founder_speach))
                @foreach ($board_members as $board_member)
                <div class="col-12 col-md-6 col-lg-4 custom-padding">
                    <div class="content-wrapper">
                        <img src="{{asset($board_member->board_member_image)}}" alt="" class="img-fluid">
                        <h2 class="title">{{$board_member->board_member_name}}</h2>
                        <p>{{$board_member->board_member_designation}}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>


<section class="index-cne">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-steps">
                <div class="content-wrapper">
                    <img class="img-fluid" src="{{asset('frontend/assets//img/home/career-thumb.png')}}" alt="career">
                    <h2>Terms & Policies</h2>
                    <p class="text">JSS services Ltd. has been focusing on a wide range of security services at
                        different
                        levels.</p>
                    <div class="cne-btn-wrapper">
                        <!--<a href="{{ route('terms.policy') }}" class="box-btn">-->
                        <a href="" class="box-btn">
                            <span>Learn More</span>
                            <span><img src="{{asset('frontend/assets//img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-steps">
                <div class="content-wrapper">
                    <img class="img-fluid" src="{{asset('frontend/assets//img/home/ne-thumb.png')}}" alt="News Events">
                    <h2>Ethical Code of Conduct</h2>
                    <p class="text">JSS services Ltd. has been focusing on a wide range of security services at
                        different
                        levels.</p>
                    <div class="cne-btn-wrapper">
                        <a href="{{ route('ethical.code') }}" class="box-btn">
                            <span>Learn More</span>
                            <span><img src="{{asset('frontend/assets//img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection