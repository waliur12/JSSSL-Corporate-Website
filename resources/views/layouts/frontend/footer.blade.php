@php
use App\Http\Controllers\FrontController;
$medias = FrontController::socialMedias();
$office = FrontController::mainOffice();
$services = FrontController::allServices();

@endphp
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="content">
                <img src="{{asset('frontend/assets/img/icon-svg/security.svg')}}" alt="security">
                <p class="text">JSSSL is committed to protecting the privacy and security of your personal
                    information</p>
            </div>
        </div>
    </div>
    <div class="footer-mid">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-5">
                    <div class="flogo-wrapper">
                        <a href="index.html" class="display-block">
                            <img src="{{asset('frontend/assets/img/logo.png')}}" alt="logo">
                        </a>
                    </div>
                    <div class="social-wrapper">
                        <ul>
                            @foreach ($medias as $media )
                            <li>
                                <a href="{{$media->social_media_link}}" target="_blank">
                                    <img class="img-fluid" src="{{asset('/'.$media->social_media_icon)}}"/>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-7">
                    <div class="finfo-wrapper">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="link-box ft-title">
                                    <h6>About Us</h6>
                                    <ul>
                                        <li>
                                            <a href="{{route('about.us')}}">Who Are We</a>
                                        </li>
                                        <!--<li>-->
                                        <!--    <a href="{{route('terms.policy')}}">Terms & Policy</a>-->
                                        <!--</li>-->
                                        <li>
                                            <a href="{{route('ethical.code')}}">Ethical Code</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="link-box ft-title">
                                    <h6>Services</h6>
                                    <ul>
                                        @foreach ($services as $service)
                                        <li>
                                            <a href="{{route('service.index')}}#service{{$service->service_id}}">{{$service->service_name}}</a>
                                        </li>
                                        @endforeach
                                     
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="contact-box ft-title">
                                    <h6>Contact Info</h6>
                                    <ul>
                                        <li>
                                            <p class="icon">
                                                <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/land-phone.svg')}}"
                                                    alt="land-phone" />
                                            </p>
                                            <p>{{$office->contact}}</p>
                                        </li>
                                        <li>
                                            <p class="icon">
                                                <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/email.svg')}}"
                                                    alt="mail-box" />
                                            </p>
                                            <p>{{$office->email}}</p>
                                        </li>
                                        <li>
                                            <p class="icon">
                                                <img class="img-fluid" src="{{asset('frontend/assets/img/icon-svg/location.svg')}}"
                                                    alt="location" />
                                            </p>
                                            <p>{{$office->location}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                {{-- <p>Copyright 2020 -
                    <script>document.write(new Date().getFullYear())</script>
                </p>
                <div class="gray-round">
                    <div></div>
                </div> --}}
                <p>All rights reserved © Jamuna Safety and Security Services Limited. Designed and Developed by <a href="https://theantopolis.com/" target="blank">Antopolis</a></p>
            </div>
        </div>
    </div>
</footer>