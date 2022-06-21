@extends('layouts.admin.master')
@section('pageCss')
    <style>


    </style>
@endsection
@section('content')
    <div class="loader">

    </div>

    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Career Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Career</li>
                    </ol>
                </nav>
                <div class="message"></div>

                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Career</h6>
                                {{-- <p>Quick overview on your social media platforms</p> --}}
                            </div>

                            @if (count($careers) > 0)
                                <button type="button" class="btn btn-outline-secondary ms-graph-metrics" name="button"
                                    id="addButton" data-toggle="modal" data-target="#add" disabled> Add
                                    New
                                </button>
                                {{-- <button type="button" id="addButton" class="btn btn-secondary" disabled>Add
                                New</button> --}}
                            @else
                                <button type="button" class="btn btn-outline-secondary ms-graph-metrics" name="button"
                                    id="addButton" data-toggle="modal" data-target="#add"> Add
                                    New
                                </button>
                            @endif
                        </div>

                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="careerTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 25%;">Image</th>
                                        <th scope="col" style="width: 25%;">Title</th>
                                        <th scope="col" style="width: 25%;">Description</th>
                                        <th scope="col" style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($careers))
                                        @foreach ($careers as $career)
                                            <tr class="item{{ $career->id }}">
                                                <td>
                                                    <img class='img-fluid'
                                                        src="{{ asset('/backend/careerpage/' . $career->image) }}" alt=""
                                                        style='width: 120px; height: 70px;'>
                                                </td>
                                                <td class="">{{ $career->title }}</td>
                                                <td class="">{{ $career->formated_description }}...</td>
                                                <td class="actionBtn">
                                                    <button type='button' class='ms-btn-icon btn-dark mr-3'
                                                        onclick='viewItem({{ $career->id }})'> <i
                                                            class='fas fa-eye'></i></button>
                                                    <button type='button' class='ms-btn-icon btn-dark mr-3'
                                                        onclick='editItem({{ $career->id }})'> <i
                                                            class='flaticon-pencil'></i></button>

                                                    <button type='button' class='ms-btn-icon btn-danger'
                                                        onclick='deleteItem({{ $career->id }})'> <i
                                                            class='flaticon-trash'></i></button>
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


    <!-- Add  Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title has-icon text-white text-center" id="NoteModal">Add New </h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="sliderErrorMsg_addform"></span>
                <form id="careerAddForm" method="POST" enctype="multipart/form-data"> @csrf
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
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input dropify"data-max-file-size="0.6M" data-errors-position="outside">
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
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title has-icon text-white text-center" id="NoteModal">Update Header Section</h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="updateCareerForm" method="POST" enctype="multipart/form-data"> @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id" value="">
                    <div class="modal-body">
                        <div class="ms-form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" id="edit_title" value="">

                        </div>

                        <div class="ms-form-group">
                            <label for="name">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" cols="30"
                                rows="3"></textarea>
                        </div>
                        <div class="ms-form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="edit_image" class="custom-file-input dropify" data-max-file-size="0.6M" data-errors-position="outside">

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-block btn-success mb-2">Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--- view modal--->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title has-icon text-white text-center" id="viewCategory"> Career Header Section Details </h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
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

@endsection

@section('pageScripts')

    <script type='text/javascript'>
        var config = {
            routes: {
                add: "{!! route('career.add') !!}",
                edit: "{!! route('career.edit') !!}",
                view: "{!! route('career.view') !!}",
                update: "{!! route('career.update') !!}",
                delete: "{!! route('career.delete') !!}",
            }
        };
        // data table
        $(document).ready(function() {
            $('#careerTable').DataTable({
                "ordering": false
            });
            $('.ajax_loader').hide();
            $('.menu-item').find('.content_product_collapse').addClass('show');
            $('.dropify').dropify({
                error: {
                    'fileSize': 'The file size is too big ( 600KB  max).',
                }
            });
        });

        $('#addButton').on('click', function() {
            $('.dropify-preview').hide();
        });
        // add form validation
        $(document).ready(function() {
            $("#careerAddForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength:100,
                    },
                    description: {
                        required: true,
                        maxlength:500,
                    },
                    image: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'Please enter  title',
                    },
                    description: {
                        required: 'Please enter  description',
                    },
                    image: {
                        required: ' image is required',
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

        $(document).on('submit', '#careerAddForm', function(event) {
            event.preventDefault();
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
                        var careerTable = $('#careerTable').DataTable();
                        var trDOM = careerTable.row.add([
                            "<img class='img-fluid' src='/backend/careerpage/" + response.data
                            .image + "'>",
                            "" + response.data.title + "",
                            "" + response.data.description + "...",
                            "<button type='button' class='ms-btn-icon btn-dark mr-3' onclick='viewItem(" +
                            response.data.id +
                            ")'> <i class='fas fa-eye'></i></button><button type='button' class='ms-btn-icon btn-dark mr-3' onclick='editItem(" +
                            response.data.id +
                            ")'> <i class='flaticon-pencil'></i></button> <button type='button' class='ms-btn-icon btn-danger'  onclick='deleteItem(" +
                            response.data.id + ")'> <i  class='flaticon-trash'></i></button>"
                        ]).draw().node();
                        $(trDOM).addClass('item' + response.data.id + '');
                        $('#addButton').prop('disabled', true);

                        if (response.data.message) {
                            html =
                                '<div class="alert alert-success bg-success text-dark text-center" role="alert">' +
                                response.data.message + '</div>';
                            $('#careerAddForm').trigger('reset');

                        }
                        $('.showError').fadeIn(100).html(html);
                        $('.showError').fadeOut(3000);


                    } else {
                        html =
                            '<div class="alert alert-danger bg-danger text-danger text-center" role="alert">' +
                            response.data.error + '</div>';
                        // $('#addSlider').modal('hide');
                        $('.showError').fadeIn(100).html(html);
                        $('.showError').fadeOut(3000);
                    }
                }, //success end

                beforeSend: function() {
                    $('#add').modal('hide');
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
            });
        });

        //request end


        // view single
        function viewItem(id) {
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
                        $('#view_title').text(response.data.title);
                        $('#view_description').text(response.data.description);
                        $("#view_image").attr("src", '/backend/careerpage/' + response.data.image);
                        $('#viewModal').modal('show');

                    } //success end

                }
            }); //ajax end
        }




        // Update product
        //validation
        $(document).ready(function() {
            $("#updateCareerForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength:100,
                    },
                    description: {
                        required: true,
                        maxlength:500,
                    },
                },
                messages: {
                    title: {
                        required: 'Please enter title',
                    },
                    description: {
                        required: 'Please enter description',
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });


        function editItem(id) {
            var path = "{{ url('/') }}" + '/backend/careerpage/';
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

                        $('#edit_title').val(response.data.title)
                        $('#edit_description').val(response.data.description)
                        // $("#edit_image").attr("src", '/backend/homepage/' + response.data.image);
                        $('#hidden_id').val(response.data.id)

                        if (response.data.image) {
                            var img_url = path + response.data.image;

                            $("#edit_image").attr("data-height", 150);
                            $("#edit_image").attr("data-min-width", 450);
                            $("#edit_image").attr("data-default-file", img_url);

                            $(".dropify-wrapper").removeClass("dropify-wrapper").addClass(
                                "dropify-wrapper has-preview");
                            $(".dropify-preview").css('display', 'block');
                            $('.dropify-render').html('').html('<img src=" ' + img_url +
                                '">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        $('#edit_image').dropify();
                        $('#edit_modal').modal('show');

                    } //success end

                }
            });
            $(document).on('submit', '#updateCareerForm', function(event) {
                event.preventDefault();
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
                            $('.item' + response.data.id).html(
                                "<td><img class='img-fluid' src='/backend/careerpage/" +
                                response.data.image +
                                "' style='width: 120px; height: 70px;'></td><td>" + response.data
                                .title + "</td><td>" + response.data.description +
                                "...</td><td><button type='button' class='ms-btn-icon btn-dark mr-3' onclick='viewItem(" +
                                response.data.id +
                                ")'> <i class='fas fa-eye'></i></button><button type='button' class='ms-btn-icon btn-dark mr-3' onclick='editItem(" +
                                response.data.id +
                                ")'> <i class='flaticon-pencil'></i></button> <button type='button' class='ms-btn-icon btn-danger'  onclick='deleteItem(" +
                                response.data.id +
                                ")'> <i  class='flaticon-trash'></i></button></td>");
                            // $('#event_class_table').DataTable().draw();
                            // console.log(data);
                            if (response.data.message) {


                                html =
                                    '<div class="alert alert-success bg-success text-dark text-center" role="alert">' +
                                    response.data.message + '</div>';
                                $('#updateCareerForm')[0].reset();
                            }
                            $('.showError').fadeIn(100).html(html);
                            $('.showError').fadeOut(3000);
                            // setTimeout(function () {
                            //     $('#event_class_edit_form').modal('hide');
                            // }, 2800);
                        } else {
                            html =
                                '<div class="alert alert-danger bg-danger text-danger text-center" role="alert">' +
                                response.data.error + '</div>';
                            $('.showError').fadeIn(100).html(html);
                            $('.showError').fadeOut(3000);

                        }

                    }, //success end

                    beforeSend: function() {
                        $('#edit_modal').modal('hide');
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
                });
            });

        }



        // delete slider
        function deleteItem(id) {
            // alert(id)
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
                                $('#careerTable').DataTable().row('.item' + response.data.id)
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
