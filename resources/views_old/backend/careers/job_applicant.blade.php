@extends('backend.home')
@section('title','Applicants')
@section('content')
    <style>
        /* .ms-panel-header p{
                margin-left: -35px;
            } */

        .job_detail {
            font-size: 15px;
            cursor: pointer;
        }

        .modal_cross_icon {
            padding: 2px 15px !important;
            margin: -38px -15px !important;
        }

        p ul {
            list-style: inside !important;
        }

        .job_title {
            font-size: 20px;
            font-weight: 700;
        }
        p {
            margin-top: 0;
            margin-bottom: 6px;
        }
        span.job_detail.badge.badge-outline-dark {
            margin-top: 6px;
        }
        .shadowCss {
            background: aliceblue;
            padding: 0px 5px;
            border-radius: 5px;
        }

    </style>


    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/admin/dashboard') }}"><i class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/jobs')}}">Jobs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">applicants</li>
                    </ol>
                </nav>
                <div class="message"></div>

                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Applicant List</h6>
                            </div>
                            <a href="{{ route('jobs') }}">

                            <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Back" > Back</button>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="ms-header-text">
                                <h6>{{ $job->title }} </h6>
                                <p class="mt-2 job_description">{!! $job->formated_description !!}....</p>
                                <span class="job_detail badge badge-outline-dark"
                                        onclick="jobDetail({{ $job->id }})">See details</span>
                            </div>
                        </div>

                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="applicantTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 30%;">Name</th>
                                        <th scope="col" style="width: 25%;">Contact</th>
                                        <th scope="col" style="width: 25%;">Email</th>
                                        <th scope="col" style="width: 10%;">CV</th>
                                        <th scope="col" style="width: 10%;">Details</th>
                                        <th scope="col" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($applicants))
                                        @foreach ($applicants as $applicant)
                                            <tr class="item{{ $applicant->id }}">
                                                <td class="">{{ $applicant->name }}</td>
                                                <td class="">{{ $applicant->contact }}</td>
                                                <td class="">{{ $applicant->email }}</td>
                                                <td class="">
                                                    {{-- <a href="{{route('pdf.view',[$applicant->cv])}}">open</a> --}}

                                                    <a href="{{ asset('backend/' . $applicant->cv) }}" target="blank">
                                                        <button type='button' class='ms-btn-icon btn-dark'>
                                                             <i class='fas fa-eye'></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="ms-btn-icon btn-info viewData"
                                                        data-id="{{$applicant->id}}">
                                                    <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                                <td class="actionBtn">

                                                    <button type='button' class='ms-btn-icon btn-danger'
                                                        onclick='deleteItem({{ $applicant->id }},{{ $job->id }})'>
                                                        <i class='flaticon-trash'></i></button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>





    <!--- view modal--->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title has-icon text-white text-center" id="viewCategory">Job Details </h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                {{-- <label for="name"><strong>Title:</strong></label> --}}
                                <p id="view_title" class="text-center job_title"></p>
                                <p class="text-center">Posted Date : <span class="post_date"> </span></p>
                                <p class="text-center">Deadline : <span class="last_date"> </span></p>
                                <p class="text-center">Total Applicants : <span>{{ $job->applicants->count() }} </span></p>

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"><strong>Location:</strong></label>
                                <p id="view_location"></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Description:</strong> </label>
                                <p id="view_description"></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Requirement:</strong> </label>
                                <p id="view_requirement"></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Responsibility:</strong> </label>
                                <p id="view_responsibility"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" aria-label="Close"
                            class="btn btn-block btn-success mb-2 close">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Applicant --}}
    <div class="modal fade" id="viewApplicant" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title has-icon text-white text-center" id="viewCategory">Applicant Details</h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                {{-- <label for="name"><strong>Title:</strong></label> --}}
                                <p id="view_title" class="text-center">__Applicant Information__</p><br>
                                <p class="text-center" id="viewImage"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"><strong>Name:&nbsp;&nbsp;</strong></label>
                                        <p id="viewName" class="shadowCss"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Email:&nbsp;&nbsp;</strong> </label>
                                        <p id="viewEmail" class="shadowCss"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Contact:&nbsp;&nbsp;</strong> </label>
                                        <p id="viewContact" class="shadowCss"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Religion:&nbsp;&nbsp;</strong> </label>
                                        <p id="viewRel" class="shadowCss"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Date Of Birth:&nbsp;&nbsp;</strong> </label>
                                        <p id="viewDob" class="shadowCss"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Nid:&nbsp;&nbsp;</strong> </label>
                                        <p id="viewNid" class="shadowCss"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Father Name:&nbsp;&nbsp;</strong> </label><br>
                                        <p id="viewFatherName" class="shadowCss"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ms-form-group">
                                        <label for="name"> <strong>Mother Name:&nbsp;&nbsp;</strong> </label>
                                        <p id="viewMotherName" class="shadowCss"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>&nbsp;&nbsp;&nbsp;&nbsp;Education:&nbsp;&nbsp;</strong> </label>
                                {{-- <div id="viewEducation"> --}}
                                <div>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th>Degree</th>
                                              <th>Grp/Subject</th>
                                              <th>Institution</th>
                                              <th>Result</th>
                                              <th>P.Year</th>
                                          </tr>
                                      </thead>
                                      <tbody id="educationAccess">

                                      </tbody>

                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>&nbsp;&nbsp;&nbsp;&nbsp;Working Experience:&nbsp;&nbsp;</strong> </label>
                                {{-- <div id="viewEducation"> --}}
                                <div>
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th>Designation</th>
                                              <th>Company Name</th>
                                              <th>Joining Date</th>
                                              <th>End Date</th>
                                          </tr>
                                      </thead>
                                      <tbody id="workAccess">

                                      </tbody>

                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection

@section('js')


    <script type='text/javascript'>
    $(document).ready(function() {
            var href = window.location.href;
            console.log(href);
            if (href) {
                // alert('sdsd');
                $('.menu-item').find('.job').addClass('active');
                $('.menu-item').find('.job_collapse').addClass('show');
            }
        });
        var config = {
            routes: {
                delete: "{!! route('job.applicant.delete') !!}",
                view: "{!! route('job.view') !!}",
            }
        };
        $(document).ready(function() {
            // var url = '{{ route('job.applicant', ':id') }}';
            var href = window.location.href;
            console.log(href);
            if (href) {
                // alert('sdsd');
                $('.menu-item').find('.job').addClass('active');
                $('.menu-item').find('.job_collapse').addClass('show');
            }
        });
        // data table
        $(document).ready(function() {
            $('#applicantTable').DataTable({
                "ordering": false
            });
            $('.ajax_loader').hide();
        });

        // job details
        function jobDetail(id) {
            $.ajax({
                url: config.routes.view,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    console.log(response.data);
                    if (response.success == true) {
                        $('#view_title').html(response.data.title);
                        $('#view_location').html(response.data.location);
                        $('#view_description').html(response.data.description);
                        $('#view_requirement').html(response.data.requirement);
                        $('#view_responsibility').html(response.data.responsibility);
                        $('.post_date').html(response.data.posted_date);
                        $('.last_date').html(response.data.dedline);
                        $('#viewModal').modal('show');

                    } //success end

                },
                beforeSend: function() {
                    $('.loader').empty();
                    $('.loader').addClass('ajax_loader').append(
                            `<div class="spinner spinner-7">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>`
                        );
                   },
                    complete: function() {
                        $('.loader').removeClass('ajax_loader').empty();
                    }
            }); //ajax end
        }

        //Applicant View===============================================================
        $(document).on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('applicant-detailsinfo')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewName').html(response.name);
                        $('#viewEmail').html(response.email);
                        $('#viewContact').html(response.contact);
                        $('#viewDob').html(response.dob);
                        $('#viewNid').html(response.nid);
                        $('#viewFatherName').html(response.father_name);
                        $('#viewMotherName').html(response.mother_name);
                        $('#viewRel').html(response.religion);
                        $('#viewExp').html(response.working_experience);

                        $('#educationAccess').empty();
                     $.each(response.get_education,function(key,value){
                        //  console.log('value',value);
                        $('#educationAccess').append("<tr><td>"+value.degree+"</td><td>"+value.subject+"</td><td>"+value.institution+"</td><td>"+value.result+"</td><td>"+value.passing_year+"</td></tr>")
                     });

                     $('#workAccess').empty();
                     $.each(response.get_work,function(key,value){
                         console.log('work',value);
                        $('#workAccess').append("<tr><td>"+value.designation+"</td><td>"+value.company_name+"</td><td>"+new Date(value.joining_date).toDateString()+"</td><td>"+new Date(value.end_date).toDateString()+"</td></tr>")
                     });
                        // for (const [key, value] of Object.entries(get_education)) {
                        // console.log(`key: ${key}, value: ${value}`)
                        // }

                        $('#viewImage').html(`<img width="300" height="300" class="img-fluid"   src="${url}/${response.photo}"/>`);

                        $('#viewApplicant').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });



        // delete
        function deleteItem(id, job_id) {
            // alert(job_id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: config.routes.delete,
                        data: {
                            id: id,
                            job_id: job_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {

                            if (response.success === true) {
                                Swal.fire(
                                    'Deleted!',
                                    "" + response.data.message + "",
                                    'success'
                                )
                                // swal("Done!", response.data.message, "success");
                                $('#applicantTable').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
                                if (response.data.button == true) {
                                    $('#addButton').prop('disabled', false);

                                }
                            } else {
                                Swal.fire("Error!", "Can't delete item", "error");
                            }
                        }
                    });

                }
            })


        }

        //end

    </script>
@endsection
