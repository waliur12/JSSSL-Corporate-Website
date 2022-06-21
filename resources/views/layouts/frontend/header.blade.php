<div class="header-wrapper">
    <div class="header-left-box">
        <div class="left-box-inner">
            <div class="logo-wrapper">
                <a class="d-blcok" href="{{ route('home.page') }}">
                    <img class="" src="{{ asset('frontend/assets/img/logo.png') }}" alt="logo">
                </a>
            </div>
            <div class="icon-wrapper d-block d-lg-none">
                <div class="icon-inner">
                    <div class="line line-one"></div>
                    <div class="line line-two"></div>
                    <div class="line line-three"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle-box collapse">
        <div class="middle-box-inner">
            <ul class="main-menu">
                <li class="menu-item">
                    <a href="{{ route('about.us') }}"
                        class="link {{ url()->current() == route('about.us') ? 'active' : (url()->current() == route('terms.policy') ? 'active' : (url()->current() == route('ethical.code') ? 'active' : '')) }}"
                        onclick="return false">About Us
                        <span><img src="{{ asset('frontend/assets/img/icon-svg/chaveron-down.svg') }}"
                                alt="chaveron"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('about.us') }}" class="link">Who We Are</a>
                        </li>
                        <!--<li class="menu-item">-->
                        <!--    <a href="{{ route('terms.policy') }}" class="link">Terms & Policies</a>-->
                        <!--</li>-->
                        <li class="menu-item">
                            <a href="{{ route('ethical.code') }}" class="link ">Ethical Code</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('service.index') }}"
                        class="link {{ url()->current() == route('service.index') ? 'active' : '' }}">Services</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('training.school') }}"
                        class="link {{ url()->current() == route('training.school') ? 'active' : '' }}">Training
                        School</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('our.client') }}"
                        class="link {{ url()->current() == route('our.client') ? 'active' : '' }}">Our Clients</a>
                </li>
                {{--<li class="menu-item">
                    <a href="{{ route('career.page') }}"
                        class="link {{ url()->current() == route('career.page') ? 'active' : '' }}">Careers</a>
                </li>--}}
                <li class="menu-item">
                    <a href="{{ route('news.event') }}"
                        class="link {{ url()->current() == route('news.event') ? 'active' : '' }}">News & Events</a>
                </li>
                 {{-- <li class="menu-item">
                    <a href="{{ route('results.page') }}"
                        class="link {{ url()->current() == route('results.page') ? 'active' : '' }} result">Results</a>
                </li> --}}
                 <li class="menu-item">
                    <a href="{{ route('notice') }}"
                        class="link {{ url()->current() == route('notice') ? 'active' : '' }} notice">Notices</a>
                </li>
            </ul>
            <div class="call-btn-wrapper-mobile d-block d-lg-none">
                <a href="{{ route('contact.us') }}" class="box-btn red-bg">
                    <div class="box-btn-inner">
                        <span>Contact Us</span>
                        <span><img src="{{ asset('frontend/assets/img/icon-svg/headset-mic-whtie.svg') }}"
                                alt="mic"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="header-right-box d-none d-lg-block">
        <div class="right-box-inner">
            <div class="call-btn-wrapper">
                <a href="{{ route('contact.us') }}" class="box-btn">
                    <span>Contact Us</span>
                    <span><img src="{{ asset('frontend/assets/img/icon-svg/headset-mic-red.svg') }}"
                            alt="mic"></span>
                </a>
            </div>
        </div>
    </div>
</div>
