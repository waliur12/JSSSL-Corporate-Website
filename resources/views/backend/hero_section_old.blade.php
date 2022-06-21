@extends('backend.home')
@section('title','Admin | Hero Section')
@section('style')
    <style>
            .modal_cross_icon {
         padding: 2px 15px !important;
         margin: -38px -15px !important;
     }
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
                        <li class="breadcrumb-item"><a href="{{ route('main.page') }}"><i
                                    class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">HomePage</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us hero</li>
                    </ol>
                </nav>
                <div class="message"></div>

                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>About Us hero</h6>
                                {{-- <p>Quick overview on your social media platforms</p> --}}
                            </div>
                            {{-- <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" name="button"
                                id="addButton" data-toggle="modal" data-target="#add">  <i class="fa fa-plus"></i> Add
                                New
                            </button> --}}
                            {{-- <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target="#add">Sub Service</button> --}}
                        </div>

                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="heroTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 25%;">Image</th>
                                        <th scope="col" style="width: 25%;">Title</th>
                                        <th scope="col" style="width: 25%;">Description</th>
                                        <th scope="col" style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($hero_sections))
                                        @foreach ($hero_sections as $hero_section)
                                            <tr class="item{{ $hero_section->id }}">
                                                <td>
                                                    <img class='img-fluid'
                                                        src="{{ asset('/backend/' . $hero_section->image) }}" alt=""
                                                        style='width: 120px; height: 70px;'>
                                                </td>
                                                <td class="">{!! $hero_section->formated_title !!}</td>
                                                <td class="">{!! $hero_section->formated_description !!}...</td>
                                                <td class="actionBtn">
                                                    <button type='button' class='ms-btn-icon btn-dark mr-3'
                                                        onclick='viewItem({{ $hero_section->id }})'> <i
                                                            class='fas fa-eye'></i></button>
                                                    <button type='button' class='ms-btn-icon btn-dark mr-3'
                                                        onclick='editItem({{ $hero_section->id }})'> <i
                                                            class='flaticon-pencil'></i></button>

                                                    {{-- <button type='button' class='ms-btn-icon btn-danger'
                                                        onclick='deleteItem({{ $hero_section->id }})'> <i
                                                            class='flaticon-trash'></i></button> --}}
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
                    <h5 class="modal-title has-icon text-white text-center" id="NoteModal">Add New</h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="sliderErrorMsg_addform"></span>
                <form id="heroAddForm" method="POST" enctype="multipart/form-data"> @csrf
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
                                <textarea name="description" class="form-control description" id="description" cols="30"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input dropify" data-max-file-size="1.0M" data-errors-position="outside">
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
                    <h5 class="modal-title has-icon text-white text-center" id="NoteModal">Update</h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="updateheroForm" method="POST" enctype="multipart/form-data"> @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id" value="">
                    <div class="modal-body">
                        <div class="ms-form-group flex_css">
                            <label for="name">Title</label>
                            <textarea  class="form-control title" name="title" id="edit_title" value=""></textarea>

                        </div>
                        <div class="form-group row flex_css">
                            <label for="name" >Description</label>
                                <textarea name="description" class="form-control description" id="edit_description" cols="30" rows="10" placeholder="Description Here..."></textarea>
                        </div>

                        {{-- <div class="ms-form-group">
                            <label for="name">Description</label>
                            <textarea name="description" id="edit_description" class="form-control description" cols="30"
                                rows="3"></textarea>
                        </div> --}}
                        <div class="ms-form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="edit_image" class="custom-file-input dropify" data-max-file-size="1.0M" data-errors-position="outside"/>

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
                    <h5 class="modal-title has-icon text-white text-center" id="viewCategory">Details </h5>
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
                                <label for="name"> <strong>Image:</strong> </label> <br>

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

@section('js')

<script>
        var config = {
            routes: {
                add: "{!! route('hero.section.add') !!}",
                edit: "{!! route('hero.section.edit') !!}",
                view: "{!! route('hero.section.view') !!}",
                update: "{!! route('hero.section.update') !!}",
                delete: "{!! route('hero.section.delete') !!}",
            }
        };
        // data table
        $(document).ready(function() {
            $('#heroTable').DataTable({
                "ordering": false
            });
           

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
            $("#heroAddForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength:100,
                    },
                    description: {
                        required: true,
                        maxlength:1000,
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
    //     $('.dropify').change(function(){
    //     if(Math.round(this.files[0].size/(1024*1024)) > 1) {
    //         alert('Please select image size less than 2 MB');
    //     }else{
    //         alert('success');
    //     }
    // });

        // add  request
        $(document).off('submit', '#heroAddForm');
        $(document).on('submit', '#heroAddForm', function(event) {
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
                        var heroTable = $('#heroTable').DataTable();
                        var trDOM = heroTable.row.add([
                            "<img class='img-fluid' src='/backend/" + response.data
                            .image + "'style='width: 120px; height: 70px;'>",
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

                        if (response.data.message) {
                            toastr.success(response.data.message);

                        }



                    } else {
                        toastr.error(response.data.error);
                    }
                }, //success end

                beforeSend: function() {
                    $('#add').modal('hide');
                    // $('.loader').empty();
                    // $('.loader').addClass('ajax_loader').append(
                    //         `<div class="spinner spinner-7">
                    //             <div class="bounce1"></div>
                    //             <div class="bounce2"></div>
                    //             <div class="bounce3"></div>
                    //         </div>`
                    //     );
                   },
                complete: function() {
                    //  $('.loader').removeClass('ajax_loader').empty();
                }
            });
        });

        //request end

        var path = "{{ url('/') }}" + '/backend/';
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
                        $('#view_title').html(response.data.title);
                        $('#view_description').html(response.data.formated_description);
                        $("#view_image").attr("src", path + response.data.image);
                        $('#viewModal').modal('show');

                    } //success end

                }
            }); //ajax end
        }




        // Update product
        //validation
        $(document).ready(function() {
            $("#updateheroForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength:100,
                    },
                    description: {
                        required: true,
                        maxlength:1000,
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

                        $('#edit_description').val(response.data.description);
                        try {
                            CKEDITOR.instances['edit_description'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('edit_description');

                        $('#edit_title').val(response.data.title);
                        try {
                            CKEDITOR.instances['edit_title'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('edit_title');


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
            $(document).off('submit', '#updateheroForm');
            $(document).on('submit', '#updateheroForm', function(event) {
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
                            $('.item' + response.data.id).html(
                                "<td><img class='img-fluid' src='/backend/" +
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
                                toastr.success(response.data.message);
                            }
        
                        } else {
                            toastr.error(response.data.error);

                        }

                    }, //success end

                    beforeSend: function() {
                        $('#edit_modal').modal('hide');
                        // $('.loader').empty();
                        // $('.loader').addClass('ajax_loader').append(
                        //     `<div class="spinner spinner-7">
                        //         <div class="bounce1"></div>
                        //         <div class="bounce2"></div>
                        //         <div class="bounce3"></div>
                        //     </div>`
                        // );
                   },
                    complete: function() {
                        // $('.loader').removeClass('ajax_loader').empty();
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
                                $('#heroTable').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
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
