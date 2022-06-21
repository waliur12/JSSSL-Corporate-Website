@extends('layouts.frontend.master')
@section('title')
    Career
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
                    <span>Available Jobs</span>
                </h1>
            </div>
            @foreach ($jobs as $job)
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="content-inner">
                                <h1 class="title">{{ $job->title }}</h1>
                                <p class="job-location">{{ $job->location }}</p>
                                <p class="text">{!! \Illuminate\Support\Str::limit($job->description, 309, $end = '...') !!}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="content-inner">
                                <div class="details-button-wrapper">
                                    @if ($job->deadline < date('Y-m-d'))
                                        <a class="box-btn mr-3">
                                            <span>Closed</span>
                                            {{-- <span><img src="{{asset('frontend/assets/img/icon-svg/right-arrow.svg')}}" alt="right-arrow"></span> --}}
                                        </a>
                                        <a href="javascript:void(0)" data-id='{{ $job->id }}'
                                            class="box-btn download_btn" data-toggle="modal"
                                            data-target="#admit_card_modal">
                                            <span>Download Admin Card</span>
                                        </a>
                                    @else
                                        <a href="{{ url('job/' . $job->id . '/apply') }}" class="box-btn">
                                            <span>View Details</span>
                                            <span><img src="{{ asset('frontend/assets/img/icon-svg/right-arrow.svg') }}"
                                                    alt="right-arrow"></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pagination_career">
                {{ $jobs->links() }}
            </div>


        </div>
    </section>
    {{-- <div class="modal" tabindex="-1" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title w-100">বিশেষ বিজ্ঞপ্তি</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <p>গত ১০/০৯/২০২১ প্রকাশিত নির্বাচন কমিশন সচিবালয়ের অধীনে IDEA প্রকল্প-২ এর NCS-3, NCS-5,NCS-6 ও NCS-8 এর নিয়োগ বিজ্ঞপ্তি সাময়িক সময়ের জন্য স্থগিত করা হয়েছে। সংশোধিত নিয়োগ বিজ্ঞপ্তি পরবর্তীতে পত্রিকার মাধ্যমে জানানো হবে।</p> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}
    <div class="modal fade" tabindex="-1" id="admit_card_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100">Download your admit card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="admitCardownloadForm" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nid no</label>
                            <input type="text" class="form-control nid_number" name="nid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary download_admit_card">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
