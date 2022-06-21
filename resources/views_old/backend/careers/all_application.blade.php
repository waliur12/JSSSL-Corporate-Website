@extends('backend.home')
@section('title','All Applicant')
@section('content')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                    class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Applicants</li>
                    </ol>
                </nav>
                <div class="message"></div>

                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Applicant List</h6>

                            </div>
                        </div>

                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-striped" id="applicantTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20%;">Job Title</th>
                                        <th scope="col" style="width: 15%;">Name</th>
                                        <th scope="col" style="width: 15%;">Contact</th>
                                        <th scope="col" style="width: 15%;">Email</th>
                                        <th scope="col" style="width: 10%;">CV</th>
                                        <th scope="col" style="width: 10%;">Details</th>
                                        <th scope="col" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($all_applications))
                                        @foreach ($all_applications as $applicant)
                                            <tr class="item{{ $applicant->id }}">
                                                <td class="">{{ $applicant->title }}</td>
                                                <td class="">{{ $applicant->name }}</td>
                                                <td class="">{{ $applicant->contact }}</td>
                                                <td class="">{{ $applicant->email }}</td>
                                                <td class="">
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
                                                        onclick='deleteItem({{ $applicant->id }},{{ $applicant->job_id }})'>
                                                        <i class='flaticon-trash'></i></button>
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
            </div>
        </div>
    </div>


    <!-- Add  Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white te" id="NoteModal">Add New </h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="sliderErrorMsg_addform"></span>
                <form id="applicantAddForm" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" name="title" value="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label>Image</label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input"
                                        onchange="document.getElementById('output_image').src = window.URL.createObjectURL(this.files[0])">
                                    <label class="custom-file-label">Upload Image...</label>
                                    <!-- <p class="mt-2 font-weight-light  text-muted">Image min width should be 640 & min height should be 360
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </p> -->
                                    <!-- <div class="invalid-feedback">Example invalid custom file feedback</div> -->
                                    <img id="output_image" class="mt-3 modal_img">
                                </div> --}}
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input dropify">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-block btn-success mb-2">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white" id="NoteModal">Update </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <iframe src="{{ asset('backend/' . $applicant->cv)}}" frameborder="0"></iframe> --}}

            </div>
        </div>
    </div>


    <!--- view modal--->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white" id="viewCategory">View applicant Details </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"><strong>Title:</strong></label>
                                <p id="view_title"></p>
                                <!-- <input type="text" class="form-control" name="name"  value=""> -->

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Description:</strong> </label>

                                <!-- <input type="text" class="form-control" name="sub_title"  value=""> -->
                                <!-- <textarea class="form-control" name="description" ></textarea> -->
                                <p id="view_description"></p>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Image:</strong> </label>

                                <!-- <input type="text" class="form-control" name="sub_title"  value=""> -->
                                <!-- <textarea class="form-control" name="description" ></textarea> -->
                                <img src="" alt="not image" id="view_image">
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
        var config = {
            routes: {
                delete: "{!! route('job.applicant.delete') !!}",

            }
        };

        // data table
        $(document).ready(function() {

            $('#applicantTable').DataTable({
            initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value="">Search by Job Title</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });
    $('#applicantTable tfoot tr').prependTo('#applicantTable thead');
            $('.ajax_loader').hide();

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

    </script>
@endsection
