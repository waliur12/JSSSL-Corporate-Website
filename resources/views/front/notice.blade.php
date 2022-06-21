@extends('layouts.frontend.master')
@section('title')
    Notices
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/career.css') }}">
@endsection
@section('content')
    <style>
        .pagination_career {
            display: flex;
            justify-content: center;
            align-items: baseline;
            margin-top: 50px;
        }

        .page-link {
            padding: 8px 20px;
            line-height: 1.5;
            border: 2px solid #dee2e6;
        }

        .page-item.active .page-link {
            background-color: #8b4449;
            border-color: #83252e;
        }

    </style>
    <section class="career hero-pt">
        <div class="container">
            <div class="title-box">
                <h1 class="sc-title">
                    <span>Job Opportunities</span>
                </h1>
                <p class="text">This is dummy subtitle.</p>
            
            </div>
            {{-- @foreach ($jobs as $job) --}}
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">1. Operation Support/CS Supervisor</h1>
                                <p class="job-location ">Vacancy: 02</p>
                      
                                {{-- <p class="text">{!! \Illuminate\Support\Str::limit($job->description, 309, $end = '...') !!}</p> --}}
                                
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                   
                                    {{-- <a href="{{ url('job/' . $job->id . '/result') }}" class="box-btn"> --}}
                                    <a href="{{ url('notices/1') }}" class="box-btn">
                                            <span>View Results</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">02. Operation Support/CS</h1>
                                <p class="job-location ">Vacancy: 10</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    <a href="{{ url('notices/2') }}" class="box-btn">
                                            <span>View Results</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">03. Content Writers</h1>
                                <p class="job-location ">Vacancy: 02</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    <a href="{{ url('notices/3') }}" class="box-btn">
                                            <span>View Results</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">04. Graphic Designer</h1>
                                <p class="job-location ">Vacancy: 02</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    <a href="{{ url('notices/4') }}" class="box-btn">
                                            <span>View Results</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">05. Video Editor</h1>
                                <p class="job-location ">Vacancy: 02</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    <a href="{{ url('notices/5') }}" class="box-btn">
                                            <span>View Results</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">06. Marketing Executive</h1>
                                <p class="job-location ">Vacancy: 02</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    <a href="{{ url('notices/6') }}" class="box-btn">
                                            <span>View Results</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- <div class="pagination_career">
                {{ $jobs->links() }}
            </div> --}}


        </div>
    </section>
   
   

@endsection
@section('pageScripts')
    <script type="text/javascript">
        // $(window).on('load', function() {
        //     $('#myModal').modal('show');
        // });
        var config = {
            routes: {
                downloadAdmitCard: "{!! route('admit.card.download') !!}",
            }
        };
        $(".admitCardownloadForm").validate({
            rules: {
                nid: {
                    required: true,
                    maxlength: 30
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
        });

        var id;
        $(document).on('click', '.download_btn', function() {
            id = $(this).data('id');
            $('.admitCardownloadForm').trigger('reset');
        });

        //download admit card
        $(document).on('submit', '.admitCardownloadForm', function(e) {
            e.preventDefault();
            var nid = $('.nid_number').val();
            if(nid != ''){
                $.ajax({
                url: config.routes.downloadAdmitCard,
                method: "POST",
                data: {
                    id: id,
                    nid: nid,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        var download_url = '{{ route('download', ':id') }}';
                        download_url = download_url.replace(':id', response.data.nid);


                        window.location = download_url; 
                        $('#admit_card_modal').modal('hide');
                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.message);
                    }
                }, //success end
            });
            }
        });
    </script>
@endsection
