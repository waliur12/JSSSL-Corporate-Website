@extends('backend.home')
@section('title', 'Jobs')
@section('content')
    <style>
        .total_applicant {
            position: absolute;
            margin: -15px 13px;
        }

        ul {
            list-style: inside;
        }

        .job_title {
            font-size: 20px;
            font-weight: 700;
        }

    </style>

    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                    class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jobs</li>
                    </ol>
                </nav>

                <div class="message"></div>

                <!-- All jobs section --->
                <div class="ms-panel">
                    <div class="ms-panel-header">

                        <div class="addnewdata">
                            <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add"
                                data-toggle="modal" data-target="#addJob"><i class="fa fa-plus"></i> Job</button>
                        </div>
                        <div class="service_list">
                            <h4 class="text-center display-4" style="font-size: 25px;">Job List</h4>
                        </div>

                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-striped" id="jobTable">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">Title</th>
                                        {{-- <th style="width: 15%;">Location</th> --}}
                                        <th style="width: 5%;">Precedence</th>
                                        <th style="width: 15%;">Description</th>
                                        <th style="width: 15%;">Requirement</th>
                                        <th style="width: 15%;">Responsibility</th>
                                        {{-- <th>Applicants</th> --}}
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="loadnow">
                                    @if (!empty($jobs))
                                        @foreach ($jobs as $job)
                                            @foreach ($job->requirements as $requirement)
                                                @foreach ($job->responsibilities as $responsibility)
                                                    <tr class="item{{ $job->id }}">
                                                        <td class="">
                                                            {{ \Illuminate\Support\Str::limit($job->title, 20, $end = '...') }}
                                                            <a href="{{ route('job.applicant', [$job->id]) }}">
                                                                <span
                                                                    class="total_applicant badge badge-outline-secondary">{{ $job->applicants->count() }}</span>
                                                            </a>
                                                        </td>
                                                        {{-- <td class="">{{ $job->location }}</td> --}}
                                                        {{-- <td>{!! \Illuminate\Support\Str::limit($job->short_description, 20, $end='...') !!}</td> --}}
                                                        <td>{{ $job->precedence }}</td>
                                                        <td class="">{{ $job->formated_description }}...</td>
                                                        <td class="">
                                                            {{ $requirement->formated_requirement }}...</td>

                                                        <td class="">
                                                            {{ $responsibility->formated_responsibility }}...
                                                        </td>
                                                        <td class="actionBtn">

                                                            <button type='button' class='ms-btn-icon btn-info '
                                                                onclick='viewJob({{ $job->id }})'>
                                                                <i class='fas fa-eye'></i></button>
                                                            <button type='button' class='ms-btn-icon btn-success'
                                                                onclick='editJob({{ $job->id }})'> <i
                                                                    class='flaticon-pencil'></i></button>

                                                            <button type='button' class='ms-btn-icon btn-danger'
                                                                onclick='deleteJob({{ $job->id }})'> <i
                                                                    class='flaticon-trash'></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- All job section end -->
            </div>

        </div>
    </div>


    <!-- Add  Modal -->
    <div class="modal fade" id="addJob" tabindex="-1" role="dialog" aria-labelledby="add">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="headCenter">
                        <h5 class="modal-title mt-0" id="myModalLabel">Add New Job</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <span id="sliderErrorMsg_addform"></span>
                <div class="modal-body">
                    <form id="jobAddForm" method="POST" enctype="multipart/form-data"> @csrf
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-xl-6 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="name">Job Title</label>
                                        <input type="text" class="form-control" name="title" value="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="location">Job Location</label>
                                        <input type="text" class="form-control" name="location" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="launch_date">Deadline</label>
                                        <input type="date" class="form-control" name="last_date" value="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="launch_date">Precedence</label>
                                        <input type="number" class="form-control" name="precedence" id="precedence" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="ms-form-group">
                                <label for="description">Long Description</label> <br>
                                <textarea name="description" class="form-control" id="description" cols="30"
                                    rows="5"></textarea>
                            </div>
                            <div class="ms-form-group">
                                <label for="requirement">Job Requirements</label> <br>
                                <textarea name="requirement" class="form-control" id="requirement" cols="30"
                                    rows="5"></textarea>
                            </div>
                            <div class="ms-form-group">
                                <label for="responsibilities">Job Responsibility</label> <br>
                                <textarea name="responsibility" class="form-control" id="responsibilities" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-square btn-info">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-square btn-secondary waves-effect m-l-5"
                                    data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="headCenter">
                        <h5 class="modal-title mt-0" id="myModalLabel">Update Job</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="updateJobForm" method="POST" enctype="multipart/form-data"> @csrf
                        <input type="hidden" name="hidden_id" id="hidden_id" value="">
                        <div class="modal-body">
                            <div class="ms-form-group">
                                <label for="edit_title">Title</label>
                                <input type="text" class="form-control" name="title" id="edit_title" value="">
                            </div>
                            <div class="ms-form-group">
                                <label for="edit_location">Location</label>
                                <input type="text" class="form-control" name="location" id="edit_location" value="">
                            </div>
                            <div class="ms-form-group">
                                <label for="launch_date">Deadline</label>
                                <input type="date" class="form-control edit_last_date" name="last_date" value="">
                            </div>
                            <div class="ms-form-group">
                                <label for="launch_date">Precedence</label>
                                <input type="number" class="form-control" name="precedence" id="edit_precedence">
                            </div>
                            {{-- <div class="ms-form-group">
                            <label for="description">Short Description</label> <br>
                            <textarea name="short_description" class="form-control" id="short_description" cols="30"
                                rows="5"></textarea>
                        </div> --}}
                            <div class="ms-form-group">
                                <label for="edit_description">Description</label> <br>
                                <textarea name="description" id="edit_description" class="form-control" cols="30"
                                    rows="3"></textarea>
                            </div>
                            <div class="ms-form-group">
                                <label for="edit_requirement">Requirements</label><br>
                                <textarea name="requirement" id="edit_requirement" class="form-control" cols="30"
                                    rows="3"></textarea>
                            </div>
                            <div class="ms-form-group">
                                <label for="edit_responsibility">Responsibility</label><br>
                                <textarea name="responsibility" id="edit_responsibility" class="form-control" cols="30"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-square btn-success">
                                    Update
                                </button>
                                <button type="reset" class="btn btn-square btn-secondary waves-effect m-l-5"
                                    data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--- view modal--->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="headCenter">
                        <h5 class="modal-title mt-0" id="myModalLabel">Job Details</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                {{-- <form method="POST" enctype="multipart/form-data">
                    @csrf --}}
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            {{-- <label for="name"><strong>Title:</strong></label> --}}
                            <p id="view_title" class="text-center job_title"></p>
                            <p class="text-center">Posted Date : <span class="post_date"> </span></p>
                            <p class="text-center">Deadline : <span class="last_date"> </span></p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"><strong>Location:</strong></label>
                            <p id="view_location"></p>
                        </div>
                    </div>
                    {{-- <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Short Description:</strong> </label>
                                <p id="view_short_description"></p>
                            </div>
                        </div> --}}
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
                {{-- </form> --}}
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script type='text/javascript'>
  CKEDITOR.replace('description');
        CKEDITOR.replace('requirement');
        CKEDITOR.replace('responsibility');
        var config = {
            routes: {
                add: "{!! route('job.add') !!}",
                edit: "{!! route('job.edit') !!}",
                view: "{!! route('job.view') !!}",
                update: "{!! route('job.update') !!}",
                delete: "{!! route('job.delete') !!}",
                getPrecedence: "{!! route('job.precedence') !!}",
            }
        };

        // data table
        $(document).ready(function() {
            $('#jobTable').DataTable({
                "ordering": false
            });
            $('.ajax_loader').hide();
            $('.dropify').dropify();
        });

        $('.clientBtn').on('click', function() {
            $('#jobAddForm').trigger('reset');
            // $('.dropify-preview').hide();
            $.ajax({
            url: config.routes.getPrecedence,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
            success: function (result) {

                console.log(result);
                if (result == 0) {
                    $('#precedence').val("1");
                } else {
                    $('#precedence').val(result+1);
                }
            },
            error: function (err) {
                console.log(err)
            }
        })
        });
        // add form validation
        $(document).ready(function() {
            $("#jobAddForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    // description: {
                    //     required: true,
                    // },
                    location: {
                        required: true,
                        maxlength: 100,
                    },
                    // requirement: {
                    //     required: true,
                    //     maxlength: 2000,
                    // },
                    // responsibility: {
                    //     required: true,
                    //     maxlength: 2000,
                    // },
                    last_date: {
                        required: true,
                    },
                },

                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });
        //end

        // add  request

        $(document).on('submit', '#jobAddForm', function(event) {
            event.preventDefault();
            for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            $.ajax({
                url: config.routes.add,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        var url = '{{ route('job.applicant', ':id') }}';
                        url = url.replace(':id', response.data.id);
                        var jobTable = $('#jobTable').DataTable();
                        var trDOM = jobTable.row.add([
                            "" + response.data.title + "<a href=" + url +
                            "><span class='total_applicant badge badge-outline-secondary'>" +
                            response.data.applicants + "</span></a> ",
                            // "" + response.data.location + "",
                            "" + response.data.precedence + "",
                            "" + response.data.description + "...",
                            "" + response.data.requirement + "...",
                            "" + response.data.responsibility + "...",
                            // "<a href='" + url +
                            // "'class='ms-btn-icon btn-dark'><span class='badge badge-pill badge-outline-dark'>0</span></a>",
                            "<button type='button' class='ms-btn-icon btn-info mr-1' onclick='viewJob(" +
                            response.data.id +
                            ")'> <i class='fas fa-eye'></i></button><button type='button' class='ms-btn-icon btn-success ' onclick='editJob(" +
                            response.data.id +
                            ")'> <i class='flaticon-pencil'></i></button> <button type='button' class='ms-btn-icon btn-danger'  onclick='deleteJob(" +
                            response.data.id + ")'> <i  class='flaticon-trash'></i></button>"
                        ]).draw().node();
                        $(trDOM).addClass('item' + response.data.id + '');


                        if (response.data.message) {
                            toastr.success(response.data.message);
                            $('#addJob').modal('hide');
                        }

                    } else {
                        toastr.success(response.data.error);
                    }
                }, //success end
            });
        });

        //request end


        // view single
        function viewJob(id) {
            $.ajax({
                url: config.routes.view,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
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
                    // $('.ajax_loader').show()
                },
                complete: function() {
                    // $('.ajax_loader').hide();
                }
            }); //ajax end
        }




        // Update product
        //validation
        $(document).ready(function() {
            $("#updateJobForm").validate({
                rules: {
                    ignore: [],
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                        maxlength: 2000,
                    },
                    location: {
                        required: true,
                        maxlength: 100,
                    },
                    requirement: {
                        required: true,
                        maxlength: 2000,
                    },
                    responsibility: {
                        required: true,
                        maxlength: 2000,
                    },
                    last_date: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'Please enter job title',
                    },
                    description: {
                        required: 'Please enter job description',
                    },
                    short_description: {
                        required: 'Please enter Short  description',
                    },
                    location: {
                        required: 'Please enter Long location',
                    },
                    requirement: {
                        required: 'Please enter job requirements',
                    },
                    responsibility: {
                        required: 'Please enter job responsibilities',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });


        function editJob(id) {
            $.ajax({
                url: config.routes.edit,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#edit_title').val(response.data.title);
                        $('#edit_location').val(response.data.location);
                        $('#edit_precedence').val(response.data.precedence);
                        $('.edit_last_date').val(response.data.date);
                        $('#edit_description').val(response.data.description);
                        CKEDITOR.replace('edit_description');
                        $('#edit_requirement').val(response.data.requirement);
                        CKEDITOR.replace('edit_requirement');
                        $('#edit_responsibility').val(response.data.responsibility);
                        CKEDITOR.replace('edit_responsibility');

                        $('#hidden_id').val(response.data.id);

                        $('#edit_modal').modal('show');

                    } //success end

                },
                beforeSend: function() {
                    // $('.ajax_loader').show()
                },
                complete: function() {
                    // $('.ajax_loader').hide();
                }
            });
            $(document).on('submit', '#updateJobForm', function(event) {
                event.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                $.ajax({
                    url: config.routes.update,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            // var url = '{{ route('job.applicant', ':id') }}';
                            // url = url.replace(':id', response.data.id);

                            // $('.item' + response.data.id).html(
                            //     "<td>" + response.data
                            //     .title + "<a href=" + url +
                            //     "><span class='total_applicant badge badge-outline-secondary'>" +
                            //     response.data.applicant + "</span></a></td><td>" + response.data
                            //     .location +
                            //     "</td><td>" + response.data.short_description +
                            //     "...</td><td>" + response.data.description +
                            //     "...</td><td>" + response.data.requirement +
                            //     "...</td><td>" + response.data.responsibility +
                            //     "...</td></td><td><button type='button' class='ms-btn-icon btn-info mr-1' onclick='viewJob(" +
                            //     response.data.id +
                            //     ")'> <i class='fas fa-eye'></i></button><button type='button' class='ms-btn-icon btn-success' onclick='editJob(" +
                            //     response.data.id +
                            //     ")'> <i class='flaticon-pencil'></i></button> <button type='button' class='ms-btn-icon btn-danger'  onclick='deleteJob(" +
                            //     response.data.id +
                            //     ")'> <i  class='flaticon-trash'></i></button></td>");

                            if (response.data.message) {
                                toastr.success(response.data.message);
                                $('#edit_modal').modal('hide');
                                $("#loadnow").load(location.href + " #loadnow>*", "");

                            }

                        } else {
                            toastr.error(response.data.error);
                        }

                    }
                });
            });

        }



        // delete
        function deleteJob(id) {
            // alert(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: config.routes.delete,
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {

                            if (response.success === true) {
                                toastr.success('Data Deleted Successfully');
                                // swal("Done!", response.data.message, "success");
                                $('#jobTable').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
                            } else {
                                toastr.error('Error!", "Can\'t delete item');
                            }
                        }
                    });

                }
            })


        }


        //end

    </script>
@endsection
