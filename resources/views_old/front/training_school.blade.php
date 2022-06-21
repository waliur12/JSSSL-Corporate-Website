@extends('layouts.frontend.master')
@section('title')
   Training School
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/training-school.css') }}">
@endsection
@section('content')
<section class="school-hero hero-pt">
    <div class="container">
        <div class="content-wrapper">
            <div class="inner-content">
                <h1 class="sc-title">
                    <span>Welcome to JSSSL Training School</span>
                </h1>
                <p class="text">Figuring out the professional lacking of the employee, a willful plan for comprehensive training was conceived. Our training centre is located at Rupgonj, Narayangonj. It occupies 20 acres of land which is an ideal ground for such
                    a specialized training like that of defense forces.</p>
            </div>
            <div class="inner-image">
                <img src="{{ asset('frontend/assets/img/training-school/school-hero.png') }}" alt="training" class="img-fluid">
            </div>
        </div>
    </div>
</section>


<section class="professional-security">
    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-6">
                <div class="content-wrapper">
                    <h1 class="sc-title">
                        <span>Mentored by Bangladesh’s top security professionals</span>
                    </h1>
                    <p class="text">The duration of training has been made for five weeks. The whole tenure of training has been organized in such a way that trainees learn their professional lessons in details but under stress. All of our programs meet all local
                        requirements and will quickly get you on your way to your new career as a security personnel.</p>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="image-wrapper">
                    <img class="img-fluid" src="{{ asset('frontend/assets/img/training-school/prof-security.png') }}" alt="professional security">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="forms-of-training">
    <div class="container">
        <div class="title-box">
            <h1 class="sc-title">Forms of Training</h1>
        </div>
        <div class="row no-gutters custom-margin">
            <div class="col-12 col-md-4 custom-padding">
                <div class="content-wrapper">
                    <div class="image-wrapper position-relative">
                        <img src="{{ asset('frontend/assets/img/training-school/forms-of-training-1.png') }}" alt="" class="img-fluid">
                        <div class="box-number">
                            <span>1</span>
                        </div>
                    </div>
                    <h2>Discussion</h2>
                </div>
            </div>
            <div class="col-12 col-md-4 custom-padding">
                <div class="content-wrapper">
                    <div class="image-wrapper position-relative">
                        <img src="{{ asset('frontend/assets/img/training-school/forms-of-training-2.png') }}" alt="" class="img-fluid">
                        <div class="box-number">
                            <span>2</span>
                        </div>
                    </div>
                    <h2>Demonstration</h2>
                </div>
            </div>
            <div class="col-12 col-md-4 custom-padding">
                <div class="content-wrapper">
                    <div class="image-wrapper position-relative">
                        <img src="{{ asset('frontend/assets/img/training-school/forms-of-training-3.png') }}" alt="" class="img-fluid">
                        <div class="box-number">
                            <span>3</span>
                        </div>
                    </div>
                    <h2>Practical</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="training-objectives">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="content-wrapper">
                    <h1 class="sc-title">
                        <span>Training Objectives</span>
                    </h1>
                    <ul class="checkmark">
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Develop leadership quality, emotional stability & professional skills.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Gain a sense of responsibility and ultimately the physical and mental endurance.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Provide a safe and secure environment for all.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Affording dignity and respect to every individual.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Maintain a well-trained, community oriented and highly professional work force.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Decrease the amount of actual or perceived criminal activity via high visibility policing.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Eliminate citizen apathy about reporting a crime to the police.</p>
                        </li>
                        <li>
                            <p class="icon">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/icon-svg/checkmark.svg') }}" alt="checkmark">
                            </p>
                            <p class="text">Create an environment of teamwork through trust, commitment, collaboration, perspective, direction and cooperation.</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <img class="img-fluid" src="{{ asset('frontend/assets/img/training-school/training-objectives.png') }}" alt="different">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection