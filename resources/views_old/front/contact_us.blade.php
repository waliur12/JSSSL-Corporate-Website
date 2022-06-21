@extends('layouts.frontend.master')
@section('title')
    Contact-Us
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/contact-us.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')

    <section class="contact-us hero-pt">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 col-steps">
                    <div class="form-wrapper">
                        <div class="title-box">
                            <h1 class="sc-title">Let’s get in touch</h1>
                        </div>
                        <form class="message_form" method="POST">@csrf
                            <label id="name-error" class="error text-danger" for="name"></label>
                            <input name="name" class="input" type="text" placeholder="Your Name">
                            <label id="email-error" class="error text-danger" for="email"></label>
                            <input name="email" class="input" type="email" placeholder="Your Email Address">
                            <label id="phone-error" class="error text-danger" for="phone"></label>
                            <input name="phone" class="input" type="text" placeholder="Your Phone Number">
                            <label id="message-error" class="error text-danger" for="message"></label>
                            <textarea name="message" class="input" id="" rows="3"
                                placeholder="Write Your Message..."></textarea>
                            <button type="submit" class="btn-submit box-btn red-bg send_btn">
                                <div class="btn-submit-inner">
                                    <span>Send Your Message</span>
                                    <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow-white.svg') }}"
                                            alt="white arrow"></span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-steps">
                    <div class="map-wrapper">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14603.24575268219!2d90.40167963682391!3d23.789728087649372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a0f70deb73%3A0x30c36498f90fe23!2sGulshan%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1625569191112!5m2!1sen!2sbd"
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="address">
        <div class="container">
            <div class="row">
                @if (!empty($offices))
                    @foreach ($offices as $office)
                        <div class="col-12 col-md-4 col-steps">
                            <div class="address-wrapper">
                                <h3>{{ $office->office_title }}</h3>
                                <ul>
                                    <li>
                                        <p class="icon">
                                            <img src="{{ asset('frontend/assets/img/icon-svg/location-red.svg') }}"
                                                alt="location" class="img-fluid">
                                        </p>
                                        <p>{{ $office->office_address }}</p>
                                    </li>
                                    <li>
                                        <p class="icon">
                                            <img src="{{ asset('frontend/assets/img/icon-svg/mail-red.svg') }}" alt="mail"
                                                class="img-fluid">
                                        </p>
                                        <p>{{ $office->office_email }}</p>
                                    </li>
                                    <li>
                                        <p class="icon">
                                            <img src="{{ asset('frontend/assets/img/icon-svg/phone-in-talk-red.svg') }}"
                                                alt="phone" class="img-fluid">
                                        </p>
                                        <p>{{ $office->office_phone }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>
@endsection
@section('pageScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        var config = {
            routes: {
                sendMessage: "{!! route('message.store') !!}",
            }
        };

        $(document).ready(function() {

            $(".message_form").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    message: {
                        required: true,
                        maxlength: 10000,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    phone: {
                        required: true,
                        minlength: 11,
                        maxlength: 20
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter your name',
                    },
                    email: {
                        required: 'Please enter your email',
                        email: 'Email must be a valid email address',
                    },
                    message: {
                        required: 'Please type your message',
                    },
                    phone: {
                        required: 'Please enter your phone number',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('text-danger');
                    label.insertAfter(element);
                },
            });

        });

        $(document).on('submit', '.message_form', function(e) {
            e.preventDefault();
            // alert('sdsd');
            $.ajax({
                url: config.routes.sendMessage,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $(".message_form").trigger('reset');
                        if (response.data.message) {
                            toastr["success"](response.data.message);
                        }

                    } else {
                        toastr["error"]('Something went wrong');
                    }
                }, //success end
            });

        });
    </script>
@endsection
