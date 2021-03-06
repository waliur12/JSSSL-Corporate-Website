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

                        {{-- <div class="addnewdata">
                            <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add"
                                data-toggle="modal" data-target="#addJob"><i class="fa fa-plus"></i> Job</button>
                        </div> --}}
                        <div class="service_list">
                            <h4 class="text-center display-4" style="font-size: 25px;">Applicant List</h4>
                        </div>

                    </div>
                    <button class="btn btn-info save_candidate">Delete</button>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-striped" id="jobTable">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">Job</th>
                                        <th style="width: 25%;">Name</th>
                                        <th style="width: 25%;">Nid</th>
                                        <th style="width: 20%;">Roll Number</th>
                                        <th style="width: 25%;">Delete</th>
                                        <th></th>
                
                                    </tr>
                                </thead>
                                <tbody id="loadnow">
                                    @if (!empty($job->applicants))
                                        @foreach ($job->applicants as $applicant)
                                    {{-- @if (!empty($uniqe))
                                        @foreach ($uniqe as $applicant) --}}
                                            <tr class="item{{ $applicant->id }}">
                                                <td>{{$job->title}}</td>
                                                <td>{{$applicant->name}}</td>
                                                <td>{{$applicant->nid}}</td>
                                                <td>{{$applicant->roll_number}}</td>
                                                <td>
                                                    <button type='button' class='ms-btn-icon btn-danger'
                                                    onclick='deleteItem({{ $applicant->id }},{{ $applicant->job_id }})'>
                                                    <i class='flaticon-trash'></i></button>
                                                </button>
                                                </td>
                                                <td>
                                                    <label class='ms-checkbox-wrap ms-checkbox-dark'>
                                                        <input type='checkbox' class='candidateCheckbox' value="{{$applicant->id}}" data-id='{{ $applicant->id }}'> <i class='ms-checkbox-check'></i>
                                                      </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </tfoot>
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
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
                                <div class="col-xl-4 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="package_no">Package No</label>
                                        <input type="text" class="form-control" name="package_no" id="package_no" value="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="launch_date">Precedence</label>
                                        <input type="number" class="form-control" name="precedence" id="precedence" value="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="launch_date">Deadline</label>
                                        <input type="date" class="form-control" name="last_date" value="">
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
                             <div class="ms-form-group">
                                <label for="instruction">Job Instruction</label> <br>
                                <textarea name="instruction" class="form-control" id="instruction" cols="30"
                                    rows="5"></textarea>
                            </div>
                            {{-- <div class="ms-form-group">
                                <label for="edit_instruction">Upload Admit Card</label><br>
                                <div class="custom-file">
                                    <input type="file" class="dropify" name="admit_card">
                                </div>
                            </div>
                             --}}
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    <form id="updateJobForm" method="POST" enctype="multipart/form-data"> @csrf
                        <input type="hidden" name="hidden_id" id="hidden_id" value="">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-xl-6 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="edit_title">Title</label>
                                        <input type="text" class="form-control" name="title" id="edit_title" value="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="edit_title">Location</label>
                                        <input type="text" class="form-control" name="location" id="edit_location" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-4 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="edit_package_no">Package No</label>
                                        <input type="text" class="form-control" name="package_no" id="edit_package_no" value="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="launch_date">Precedence</label>
                                        <input type="number" class="form-control" name="precedence" id="edit_precedence">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-12">
                                    <div class="ms-form-group">
                                        <label for="launch_date">Deadline</label>
                                        <input type="date" class="form-control edit_last_date" name="last_date" value="">
                                    </div>
                                </div>
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
                             <div class="ms-form-group">
                                <label for="edit_instruction">Instruction</label><br>
                                <textarea name="instruction" id="edit_instruction" class="form-control" cols="30"
                                    rows="3"></textarea>
                            </div>
                             {{-- <div class="ms-form-group">
                                <label for="edit_instruction">Upload Admit Card</label><br>
                                <div class="custom-file admit-card">
                                    <input type="file" name="admit_card" id="admit-card"
                                        class="custom-file-input input_image"
                                        data-errors-position="outside"
                                       >
                                </div>
                            </div> --}}
                            
                            
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
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
                     <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"> <strong>Instruction:</strong> </label>
                            <p id="view_instruction"></p>
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

        CKEDITOR.replace('instruction');
        var config = {
            routes: {
                add: "{!! route('job.add') !!}",
                edit: "{!! route('job.edit') !!}",
                view: "{!! route('job.view') !!}",
                update: "{!! route('job.update') !!}",
                delete: "{!! route('job.applicant.delete') !!}",
                getPrecedence: "{!! route('job.precedence') !!}",
            }
        };

        // data table
        $(document).ready(function() {
            // $('#jobTable').DataTable({
            //     "ordering": false
            // });
            $('.ajax_loader').hide();
            $('.dropify').dropify();
        });
        $(document).ready(function() {
            $('#jobTable').DataTable({
                "ordering": false,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control" style="width:160px;"><option value="">Filter by Package No</option></select>'
                                )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            $('#jobTable tfoot tr').prependTo('#jobTable thead');


        });

        $('.clientBtn').on('click', function() {
            $('#jobAddForm').trigger('reset');
            $('.dropify-preview').hide();
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
        $(document).off('submit', '#jobAddForm')
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
                            "" + response.data.package_no + "",
                            "" + response.data.title + "<a href=" + url +
                            "><span class='total_applicant badge badge-outline-secondary'>" +
                            response.data.applicants + "</span></a> ",
                            "" + response.data.location + "",
                           
                            "" + response.data.precedence + "",
                            "" + response.data.description + "...",
                            "" + response.data.requirement + "...",
                            // "" + response.data.responsibility + "...",
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
                        $('#view_job_code').html(response.data.package_no);
                        $('#view_title').html(response.data.title);
                        $('#view_location').html(response.data.location);
                        $('#view_description').html(response.data.description);
                        $('#view_requirement').html(response.data.requirement);
                        $('#view_responsibility').html(response.data.responsibility);
                         $('#view_instruction').html(response.data.job_instruction);
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
                    package_no: {
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
                    package_no: {
                        required: 'Please enter job packege no',
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
                        $('.dropify-preview').hide();
                        $('#edit_package_no').val(response.data.package_no);
                        $('#edit_title').val(response.data.title);
                        $('#edit_location').val(response.data.location);
                        $('#edit_precedence').val(response.data.precedence);
                        $('.edit_last_date').val(response.data.date);
                        // $('#edit_description').val(response.data.description);
                        // CKEDITOR.replace('edit_description');
                        
                         $('#edit_description').val(response.data.description);
                        try {
                            CKEDITOR.instances['edit_description'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('edit_description');
                        
                         $('#edit_responsibility').val(response.data.responsibility);
                        try {
                            CKEDITOR.instances['edit_responsibility'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('edit_responsibility');
                        
                        $('#edit_requirement').val(response.data.requirement);
                        try {
                            CKEDITOR.instances['edit_requirement'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('edit_requirement');
                        
                        $('#edit_instruction').val(response.data.job_instructions);
                        try {
                            CKEDITOR.instances['edit_instruction'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('edit_instruction');
                        
                        // if (response.data.admit_card) {
                        //     var path = "{{ url('/') }}" + '/files/';
                        //     var img_url = path + response.data.admit_card ;
                        //     $("#admit-card").attr("data-height", 275);
                        //     // $("#admit-card").attr("data-min-width", 450);
                        //     $("#admit-card").attr("data-default-file", img_url);

                        //     $('.admit-card').find('.dropify-wrapper').removeClass("dropify-wrapper").addClass(
                        //         "dropify-wrapper has-preview");
                        //     $('.admit-card').find(".dropify-preview").css('display', 'block');
                        //     $('.admit-card').find('.dropify-render').html('').html('<img src=" ' + img_url +
                        //         '">')
                        // } else {
                        //     $('#admit-card').find(".dropify-preview .dropify-render img").attr("src", "");
                        // }
                        // $('.input_image').dropify({
                        //     error: {
                        //         'fileSize': 'The file size is too big ( 600KB  max).',
                        //     }
                        // });

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
            $(document).off('submit', '#updateJobForm')
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

        function deleteItem(id) {
            // alert(job_id)\
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
                                // Swal.fire(
                                //     'Deleted!',
                                //     "" + response.data.message + "",
                                //     'success'
                                // )
                                // swal("Done!", response.data.message, "success");
                                toastr.success(response.data.message);
                                $('#jobTable').DataTable().row('.item' + response.data.id)
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
            // Swal.fire({
            //     title: 'Are you sure?',
            //     text: "You won't be able to revert this!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes, delete it!'
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         $.ajax({
            //             type: "POST",
            //             url: config.routes.delete,
            //             data: {
            //                 id: id,
            //                 _token: "{{ csrf_token() }}"
            //             },
            //             dataType: 'JSON',
            //             success: function(response) {

            //                 if (response.success === true) {
            //                     // Swal.fire(
            //                     //     'Deleted!',
            //                     //     "" + response.data.message + "",
            //                     //     'success'
            //                     // )
            //                     // swal("Done!", response.data.message, "success");
            //                     toastr.success(response.data.message);
            //                     $('#jobTable').DataTable().row('.item' + response.data.id)
            //                         .remove()
            //                         .draw();
            //                     if (response.data.button == true) {
            //                         $('#addButton').prop('disabled', false);

            //                     }
            //                 } else {
            //                     Swal.fire("Error!", "Can't delete item", "error");
            //                 }
            //             }
            //         });

            //     }
            // })


        }

        $(document).on('click', '.save_candidate', function(e) {
            e.preventDefault();
      

            var selected_id = [];
            $.each($("input[type='checkbox']:checked"), function() {
                selected_id.push($(this).val());
            });
            // log(selected_id)
            $.ajax({
                url: config.routes.delete,
                method: "POST",
                data: {
                    selected_id: selected_id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#jobTable').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();


                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.error);
                    }
                }, //success end
            });
        });

    </script>
@endsection
