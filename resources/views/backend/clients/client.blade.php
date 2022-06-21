@extends('backend.home')
@section('title', 'Admin | Clients')
@section('content')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                class="material-icons">home</i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
            </nav>

            <div class="ms-panel">
                <div class="ms-panel-body">
                    <div class="addnewdata">
                        <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add"
                            data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i> Client</button>
                    </div>
                    <div class="service_list">
                        <h4 class="text-center display-4" style="font-size: 25px;">Client List</h4>
                    </div>
                    <div id="reload-category">
                        <table id="socialMedia" class="table w-100 table-striped dataTable no-footer" role="grid"
                            aria-describedby="data-table-4_info" style="width: 1098px;">
                            <thead>
                                <tr role="row">
                                    <th class=" text-center" style="width: 15%">Client Category</th>
                                    <th class=" text-center" style="width: 15%">Client Name</th>
                                    <th class=" text-center" style="width: 15%">Precedence</th>
                                    <th class=" text-center" style="width: 15%">Logo</th>
                                    <th class=" text-center" style="width: 15%">Description</th>
                                    <th class=" text-center" style="width: 25%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="loadnow">
                                @foreach ($clients as $client)
                                    <tr class="item{{ $client->client_id }}" role="row">
                                        <td class="text-center">{{ $client->getClientCat->client_category_name }}</td>
                                        <td class="text-center">{{ $client->client_name }}</td>
                                        <td class="text-center">{{ $client->client_precedence }}</td>
                                        <td class="text-center"><img src="{{ asset($client->client_logo) }}"
                                                style="width: 45px; height: 45px;" /></td>
                                        <td class="text-center">{!! \Illuminate\Support\Str::limit($client->formated_description, 15, $end = '...') !!}</td>
                                        <td class="text-center">
                                            <button type="button" class="ms-btn-icon btn-info viewData"
                                                data-id="{{ $client->client_id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button type="button" class="ms-btn-icon btn-success media-edit"
                                                data-id="{{ $client->client_id }}" title="Edit">
                                                <i class="flaticon-pencil"></i>
                                            </button>
                                            <a class="deletetag" data-id="{{ $client->client_id }}">
                                                <button class="ms-btn-icon btn-primary category-delete"
                                                    title="Delete"><i class="flaticon-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <th></th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal content  Save-->
<div id="myModalSave" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter">
                    <h5 class="modal-title mt-0" id="myModalLabel">Add New Client</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['class' => 'form-horizontal', 'id' => 'mediaStore']) !!}
                @csrf
                <div id="clientSave">
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Client Category</label>
                        <div class="col-sm-9">
                            <select style="width:100%;" id="cat" class=" form-control cat_selector"
                                name="client_category_id">
                                <option value="">Choose Category...</option>
                                @foreach ($clientcat as $cat)
                                    <option value="{{ $cat->client_category_id }}">{{ $cat->client_category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Client Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="client_name" placeholder="Client Name...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Precedence</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="number" id="precedence" name="client_precedence"
                                placeholder="Precedence...">
                        </div>
                    </div>

                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Client Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control description" id="description" name="client_description" cols="30" rows="10"
                                placeholder="Description here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Client Logo</label>
                    <div class="col-sm-9">
                        <input type="file" name="image" data-allowed-file-extensions="png jpg jpeg" class="dropify" />
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div>
                        <button type="submit" class="btn btn-square btn-info waves-effect waves-light">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-square btn-light waves-effect m-l-5" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>



<!--modal content Update -->
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter">
                    <h5 class="modal-title mt-0" id="myModalLabel"> Client Info Update</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['class' => 'form-horizontal', 'id' => 'mediaUpdate']) !!}
                @csrf
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Client Category</label>
                    <div class="col-sm-9">
                        <select style="width:100%;" id="cat2" class="form-control cat_selector"
                            name="client_category_id">
                            <option value="">Choose Category</option>
                            @foreach ($clientcat as $cat)
                                <option value="{{ $cat->client_category_id }}">{{ $cat->client_category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Client Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="client_name" name="client_name"
                            placeholder="Client Name...">
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Precedence</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" id="precedence2" name="client_precedence"
                            placeholder="Precedence">
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Client Logo</label>
                    <div class="col-sm-9">
                        <input type="file" name="image" id="image2" data-allowed-file-extensions="png jpg jpeg"
                            class="dropify" />
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Client Description</label>
                    <div class="col-sm-9">
                        <textarea name="client_description" class="form-control description" id="client_description"
                            cols="30" rows="10" placeholder="Description here..."></textarea>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div>
                        <button type="submit" class="btn btn-square btn-success waves-effect waves-light">
                            Update
                        </button>
                        <button type="reset" class="btn btn-square btn-secondary waves-effect m-l-5"
                            data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


{{-- View Modal --}}
<div id="viewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Client Details</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="background: #f5f5f5;">

                <div class="Catname">
                    <div class="d-flex">
                        <div class="col-md-4 p-0">
                            <p><b>Client Name:</b></p>
                        </div>
                        <div class="col-md-8 p-0">
                            <div id="viewClientName"></div>
                        </div>
                    </div>
                </div><br>
                <div class="Catname">
                    <div class="d-flex">
                        <div class="col-md-4 p-0">
                            <p><b>Precedence:</b></p>
                        </div>
                        <div class="col-md-8 p-0">
                            <div id="viewPrecedence"></div>
                        </div>
                    </div>
                </div><br>
                <div class="Catname">
                    <div class="d-flex">
                        <div class="col-md-4 p-0">
                            <p><b>Description:</b></p>
                        </div>
                        <div class="col-md-8 p-0">
                            <div id="viewDescription"></div>
                        </div>
                    </div>
                </div><br>
                <div class="Catname">
                    <div class="col-md-4 p-0">
                        <p><b>Image:</b></p>
                    </div>
                    <div class="col-md-12">
                        <div id="viewImage" class="text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
 CKEDITOR.replace('description');

    $(document).ready(function() {
        $('#socialMedia').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-control" style="width:180px;"><option value="">Search by Category</option></select>'
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
            },

            "ordering": false

        });

        $('#socialMedia tfoot tr').prependTo('#socialMedia thead');
        $('.loader').hide();

    });
    $(document).ready(function() {
        // $(".modal").on("hidden.bs.modal", function(){
        //          $(".modal-body").html("");
        //      });

        $('#socialMedia').DataTable();
        $('.dropify').dropify();
        $(".clientBtn").on('click', function() {
            // $("#clientSave").load(location.href + " #clientSave>*", "");
            $('.dropify-preview').hide();

        });
        $('#cat').select2({
            placeholder: "Select Client Category",
        });

        $("#mediaStore").validate({
            rules: {
                client_category_id: {
                    required: true,
                },
                client_name: {
                    required: true,
                    maxlength: 50
                },
                client_precedence: {
                    required: true,
                },
                image: {
                    required: true,
                },
                client_description: {
                    required: true,
                },
            },
        });
        $("#mediaUpdate").validate({
            rules: {
                client_category_id: {
                    required: true,
                },
                client_name: {
                    required: true,
                    maxlength: 50
                },
                client_precedence: {
                    required: true,
                },
                client_description: {
                    required: true,
                },
            },
        });

        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function() {
            let id = $(this).attr('data-id');
            // $("#mediaUpdate").load(location.href + " #mediaUpdate>*", "");
            $.ajax({
                url: "{{ url('client') }}/" + id + '/edit',
                method: "get",
                data: {},
                dataType: 'json',
                success: function(response) {
                    let url = window.location.origin;
                    console.log('data', response);
                    $('#cat2').val(response.data.client_category_id);
                    $('#client_name').val(response.data.client_name);
                    $('#precedence2').val(response.data.client_precedence);
                    $('#category-edit-id').val(response.data.client_id);


                    $('#client_description').val(response.data.client_description);
                        try {
                            CKEDITOR.instances['client_description'].destroy(true);
                    } catch (e) {}
                        CKEDITOR.replace('client_description');

                    if (response.data.client_logo) {
                        // var img_url = newURL+"/" + response.data.client_logo;
                        var img_url = '{!! asset('/') !!}' + response.data.client_logo;
                        console.log('img url: ', img_url);

                        $("#image2").attr("data-height", 100);
                        $("#image2").attr("data-default-file", img_url);

                        $(".dropify-wrapper").removeClass("dropify-wrapper").addClass(
                            "dropify-wrapper has-preview");
                        $(".dropify-preview").css('display', 'block');
                        $('.dropify-render').html('').html('<img src=" ' + img_url +
                            '" style="max-height: 100px;">')
                    } else {
                        $(".dropify-preview .dropify-render img").attr("src", "");
                    }
                    $("#image2").dropify();
                    $('#myModal').modal('show');

                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr.error('Not found!');
                    }
                }
            });
        });

        //View===============================================================
        $('#reload-category').on('click', '.viewData', function() {
            let id = $(this).attr('data-id');
            console.log('id--', id);
            $.ajax({
                url: "{{ url('client') }}/" + id,
                method: "get",
                data: {},
                dataType: 'json',
                success: function(response) {
                    let url = window.location.origin;
                    // console.log('data', data);
                    $('#viewCat').html(response.data.client_category_id);
                    $('#viewClientName').html(response.data.client_name);
                    $('#viewPrecedence').html(response.data.client_precedence);
                    $('#viewDescription').html(response.data.client_description);
                    $('#viewImage').html(
                        `<img width="300" height="300" class="img-fluid"  src="${url}/${response.data.client_logo}"/>`
                        );

                    $('#viewModal').modal('show');
                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr.error('Not found!');
                    }
                }
            });
        });

        //save data
        $('#mediaStore').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            if (!$form.valid()) return false;
            for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            $.ajax({
                url: "{{ route('client.store') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    // console.log('save', response);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if (response.status == 0) {
                        $.each(data.error, function(key, value) {
                            toastr.error(value);
                        })
                    } else {
                        if (response.status = true) {
                            $('#myModalSave').modal('hide');
                            toastr.success('Data Inserted Successfully');
                            $('#mediaStore').trigger('reset');
                            var content_table = $('#socialMedia').DataTable();
                            var tst = content_table.row.add([

                                "" + response.data.client_category_id + "",
                                "" + response.data.client_name + "",
                                "" + response.data.client_precedence + "",
                                '<img src="' + response.data.client_logo +
                                '" style="width: 45px; height:45px;"/>',
                                "" + response.data.formated_description + "",
                                `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.client_id}"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.client_id}" title="Edit"><i class="flaticon-pencil"></i></button>&nbsp;<a class="deletetag" data-id="${response.data.client_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
                            ]).draw().node();
                        }
                        $("#loadnow").load(location.href + " #loadnow>*", "");
                    }
                }

            });

        });


        //Delete data
        $(document).on('click', '.deletetag', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log('id: ', id);
            //alert(role);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(result => {
                if (result.value) {
                    $.ajax({
                        url: "{!! route('client.destroy') !!}",
                        type: "get",
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            console.log('tt', response);
                            if (response.success === true) {
                                toastr.success('Data Deleted Successfully');
                                $('#socialMedia').DataTable().row('.item' + response
                                        .data.client_id).remove()
                                    .draw()
                            }
                        }

                    });
                }
            })
        });


        // //Update data
        $('#mediaUpdate').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            if (!$form.valid()) return false;
            $.ajax({
                url: "{{ route('client.updated') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log('update', data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if (data.status == 0) {
                        $.each(data.error, function(key, value) {
                            toastr.error(value);
                        })
                    } else {
                        if (data.status = true) {
                            $('#myModal').modal('hide');
                            toastr.success('Data Updated Successfully');
                            $('#mediaUpdate').trigger('reset');
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }
                    }



                }
            });
        });
    });
</script>
@endsection
