@extends('layouts.frontend.master')
@section('title')
Career
@endsection
@section('pageCss')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/career.css') }}">
    <style>ul {list-style: unset!important;}
        /* label#fullName-error, label#email-error,label#fatherName-error,label#motherName-error,label#contact-error,label#nidNo-error,label#dateOfBirth-error,label#religion-error,label#workingExp-error,label#uploadPicture-error,label#uploadCv-error,label#degree_sk1-error,label#gpsubject\[\]-error,label#institute\[\]-error,label#result\[\]-error,label#passingyear\[\]-error{
            color: #e10f0f;
            font-size: 14px;
            font-weight: 400;
        } */
        .error.mt-2.text-danger {
            font-size: 13px;
            font-weight: 500;
        }
        .ajax_loader {
     /* visibility: hidden;
      background-color: rgba(255,255,255,0.7);
      position: absolute;
      z-index: +100 !important;
      width: 100%;
      height:100%;*/
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      position: fixed;
      background: rgba(255,255,255,0.7);
      width: 100%;
      height: 100% !important;
      z-index: 1050;
      visibility: hidden;
    }
    
    .ajax_loader img {
      top: 50%;
      left: 50%;
      position: absolute;
      color: white;
      transform: translate(-50%, -50%);
    }
        </style>
@endsection

@section('content')
   


    {{-- <div></div> --}}
    {{-- style="display:none;" --}}
    <div class="ajax_loader centered" > <img class="img-responsive" src='{{asset("frontend/loader.gif")}}'/></div>
    <section class="career-details hero-pt">
  
        <div class="container">
            <div class="title-box">
                <h1 class="sc-title">
                    <span>{{$job_id->title}}</span>
                </h1>
                <p class="job-location">{{$job_id->location}}</p>
            </div>
            @if ($selected_applicant>0)
            <div class="col-12 col-lg-3 float-right">
                <div class="content-inner">
                    <div class="details-button-wrapper">
                        <a href="" class="box-btn download_btn"  data-toggle="modal" data-target="#admit_card_modal">
                            <span>Download Admit Card</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            {{-- <div class="details-button-wrapper">
                <a href="{{route('donwload',['19948117243000062'])}}" class="box-btn download_btn"  >
                    <span>Download Admit Card</span>
                </a>
            </div> --}}

            <div class="description">
                <p class="text">{!! $job_id->description !!}</p>
            </div>
            <div class="keypoints-wrapper">
                <div class="key-points">
                    <h2 class="title">কাজের বিবরণ</h2>
                   @if(!empty($job_id->responsibilities))
                   @foreach($job_id->responsibilities as $resp )
                        {!! $resp->responsibility !!}
                    @endforeach
                   @endif
                </div>
                <div class="key-points">
                    <h2 class="title">যোগ্যতা</h2>
                   @if (!empty($job_id->requirements))
                   @foreach($job_id->requirements as $resp )
                   {!! $resp->requirement !!}
                        @endforeach
                   @endif
                </div>

                <div class="key-points">
                    <h2 class="title">নির্দেশনা</h2>
                   @if (!empty($job_id->instruction))
                   @foreach($job_id->instruction as $instruction )
                   {!! $instruction->instructions !!}
               @endforeach
                   @endif
                </div>
            </div>

            <div class="apply-form-wrapper">
                {!!Form::open(['class' => 'form-horizontal','id'=>'applicantStore'])!!}
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="fullName">Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullname" placeholder="Full Name">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="fatherName">Father Name</label>
                            <input type="text" class="form-control" id="fatherName" name="fathername" placeholder="Father Name">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="motherName">Mother Name</label>
                            <input type="text" class="form-control" id="motherName" name="mothername" placeholder="Mother Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="contact">Mobile Number</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Mobile Number">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="nidNo">NID</label>
                            <input type="text" class="form-control" id="nidNo" name="nid" placeholder="NID Number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" name="dob">
                            <input type="hidden" class="form-control" value="{{$job_id->id}}" name="job_id">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="religion">Religion</label>
                            <select id="religion" class="form-control" name="religion">
                                <option value="">Select...</option>
                                <option value="Islam">Islam</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Christianity">Christianity</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row other_religion_div">
                        <div class="form-group col-12 col-md-12">
                            <label for="nidNo">Religion</label>
                            <input type="text" disabled class="form-control other_religion"  name="religion" placeholder="Type your religion here..">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-12 col-md-12">
                            <label for="nidNo">Address(According to NID Card)</label>
                            <textarea name="address" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="religion">&nbsp; Educational Qualification</label>
                        <div class="form-group col-12 col-md-12">
                            <div class="table-responsive">

                                <table class="table" id="skill_table_edit">
                                    <thead>
                                        <tr>
                                            <th>Degree</th>
                                            <th>Group / Subject</th>
                                            <th>Institute</th>
                                            <th>Result</th>
                                            <th>Passing Year</th>
                                        </tr>
                                    </thead>
                                    <tbody ody id="skill_edit_tbody">
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-icon-text" onclick="add_row_skill_edit();">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="form-row">
                        <label for="religion">&nbsp; Working Experience</label>
                        <div class="form-group col-12 col-md-12">
                            <div class="table-responsive">

                                <table class="table" id="working_table_edit">
                                    <thead>
                                        <tr>
                                            <th>Designation</th>
                                            <th>Company Name</th>
                                            <th>Joining Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="skill_edit_tbody">
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-icon-text" onclick="add_row_working_edit();">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{--  --}}

                    <div class="form-row">
                        <div class="form-group col-12 col-md-4">
                            <label for="uploadPicture">Upload Picture (300 x 300)</label>
                            {{-- <input type="file" class="" accept="image/png, image/gif, image/jpeg"  name="image"> --}}
                            <input type="file" name="image" id="uploadPicture" class="form-control file-input dropify" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="0.6M" data-errors-position="outside">
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="uploadPicture">Upload Signature (300 x 80)</label>
                            {{-- <input type="file" class="" accept="image/png, image/gif, image/jpeg"  name="image"> --}}
                            <input type="file" name="signature" id="uploadSignature" class="form-control file-input dropify" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="0.6M" data-errors-position="outside">
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="uploadCv">Upload Complete CV</label>
                           {{--  <input type="file" class="form-control file-input" id="uploadCv" accept="application/pdf" name="uploadcv"> --}}
                           <input type="file" name="uploadcv" id="uploadCv" class="form-control file-input dropify"  data-errors-position="outside">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <button type="submit" class="form-control sub-btn">save</button>
                            {{-- <button type="submit" class="form-control sub-btn" id="save_btn">save</button> --}}
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <button type="reset" class="form-control sub-btn">cancel</button>
                        </div>
                    </div>
                {!!Form::close()!!}
            </div>

            <!-- <div class="apply-info-wrapper">
                <div class="apply-info-inner">
                    <p>To apply, send your CV at</p>
                    <a href="mailto:info@jsssl.com">info@jsssl.com</a>
                </div>
            </div> -->
        </div>



    </section>
@endsection
@section('pageScripts')
    <script src="{{asset('frontend/assets/js/education.js')}}"></script>
    <script src="{{asset('frontend/assets/js/workingexp.js')}}"></script>
    <script>

        var config = {
            routes: {
                downloadAdmitCard: "{!! route('admit.card.download') !!}",
            }
        };

$('.other_religion_div').hide();
        $(document).ready( function () {
            $('.dropify').dropify();


            $("#applicantStore").validate({
                rules: {
                    fullname: {
                        required:true,
                        maxlength:80
                    },
                    email: {
                        required:true,
                        email:true,

                    },
                    address: {
                        required:true,

                    },
                    fathername: {
                        required:true,
                        maxlength:80

                    },
                    mothername: {
                        required:true,
                        maxlength:80

                    },

                    contact: {
                        required:true,
                        minlength:11,
                        maxlength:11
                    },
                    nid: {
                        required:true,
                    },
                    dob: {
                        required:true,
                    },
                    religion: {
                        required:true,
                    },
                    workingexp: {
                        required:true,
                    },
                    uploadcv: {
                        required:true,
                    },
                    image: {
                        required:true,
                    },
                    signature: {
                        required:true,
                    },
                    "degree[]":{
                        required:true
                    },
                    "gpsubject[]":{
                        required:true
                    },
                    "institute[]":{
                        required:true
                    },
                    "result[]":{
                        required:true
                    },
                    "passingyear[]":{
                        required:true
                    },
                    "designation[]":{
                        required:true
                    },
                    "company_name[]":{
                        required:true
                    },
                    "joining_date[]":{
                        required:true
                    },

                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
            $(".admitCardownloadForm").validate({
                rules: {
                    phone: {
                        required:true,
                        maxlength:30
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });

        });


        //save data
        $('#applicantStore').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('jobapplied.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    console.log('save', response);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if(response.status == 0){
                        $.each(response.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status = true){
                            toastr.success('Your Information Inserted Successfully');
                            $('#applicantStore').trigger('reset');
                            $('.dropify-preview').hide()
                            // $("#applicantStore").load(location.href + " #applicantStore>*", "");
                        }
                    }
                },
                 beforeSend: function() {
                    
                   $('.ajax_loader').css("visibility", "visible");
                },
                complete: function() {
                  $('.ajax_loader').css("visibility", "hidden");  
                }

            });

        });

      $(document).on('change','#religion',function() {
         var val = $(this).val();
         if(val == 'Others'){
             
             $('.other_religion').prop( "disabled", false );
             $('.other_religion_div').show();
         }else{
            $('.other_religion_div').hide();
            $('.other_religion').prop( "disabled", true );
         }
      }) ;


      $(document).on('submit','.admitCardownloadForm',function(e){
          e.preventDefault();
          $.ajax({
                url: config.routes.downloadAdmitCard,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if (response.success == true) {
                        // var url = window.location.origin;

                        var download_url = '{{ route('download', ':id') }}';
                        download_url = download_url.replace(':id', response.data.id);


                        window.location = download_url; 
                        $('#admit_card_modal').modal('hide');
                       
                        toastr.success(response.data.message);
                    } else {
                        $('#admit_card_modal').modal('hide');
                        // alert(response.data.message);
                        toastr.error(response.data.message);
                    }
                }, //success end
            });
         
      }); 
    </script>
@endsection
