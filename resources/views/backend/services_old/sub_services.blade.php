@extends('backend.home')
@section('title','Admin | Sub-Services')
@section('content')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sub-Services</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i> Sub Service</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Sub Service List</h4>
            </div>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center">Service</th>
                            <th class=" text-center">Sub Service Name</th>
                            <th class=" text-center">Description</th>
                            <th class=" text-center">Image</th>
                            <th class=" text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($sub_services as $sub)
                        <tr class="item{{$sub->sub_service_id}}" role="row">
                            <td class="text-center">{{$sub->getService->service_name}}</td>
                            <td class="text-center">{{$sub->sub_service_name}}</td>
                            <td class="text-center">{!! \Illuminate\Support\Str::limit($sub->formated_description, 25, $end='...') !!}</td>
                            <td class="text-center"><img src="{{asset($sub->sub_service_image)}}" style="width: 45px; height: 45px;" /></td>

                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$sub->sub_service_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$sub->sub_service_id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>
                                <a class="deletetag" data-id="{{$sub->sub_service_id}}">
                                    <button class="ms-btn-icon btn-primary category-delete"
                                            title="Delete"><i
                                            class="flaticon-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
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
  <!--modal content  Save-->
<div id="myModalSave" class="modal fade"  role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header">
             <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add New Sub Service</h5></div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf
             <div id="upSave">
                 <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Services</label>
                <div class="col-sm-9">
                    <select style="width:100%;" id="cat" class=" form-control cat_selector" name="service_id">
                        <option value="">Choose Service...</option>
                        @foreach($servicesList as $service)
                            <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Sub Service Name</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="sub_service_name"
                           placeholder="Sub Service Name...">
                </div>
            </div>
             </div>
             <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                    <textarea name="sub_service_description" class="form-control" id="description" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="form-group row flex_css">
                <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Image (1070*720)</label>
                <div class="col-sm-9">
                   <input type="file" name="image" data-allowed-file-extensions="png jpg jpeg GIF"  class="dropify"/>
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
             {!!Form::close()!!}
         </div>
     </div>
 </div>
</div>



<!--modal content Update -->
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel"> Sub Service Update</h5></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf

                <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                <div id="ubUpdate">
                    <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Services</label>
                    <div class="col-sm-9">
                        <select style="width:100%;" id="cat2" class=" form-control cat_selector" name="service_id">
                            <option value="">Choose Service...</option>
                            @foreach($servicesList as $service)
                                <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Sub Service Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="sub_service_name" name="sub_service_name"
                               placeholder="Sub Service Name...">
                    </div>
                </div>
                </div>
     
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea name="sub_service_description" id="sub_service_description" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Image (1070*720)</label>
                    <div class="col-sm-9">
                       <input type="file" name="image"   id="image2" data-allowed-file-extensions="png jpg jpeg GIF" class="dropify"/>
                    </div>
                </div>



                <div class="form-group m-b-0">
                    <div>
                        <button type="submit" class="btn btn-square btn-success waves-effect waves-light">
                            Update
                        </button>
                        <button type="reset" class="btn btn-square btn-secondary waves-effect m-l-5" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>


{{-- View Modal --}}
<div id="viewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg"">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title mt-0" id="myLargeModalLabel">Client Details</h5>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Sub Service Name:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewName"></div>
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
    $(document).ready(function () {
        
        $('#cat').select2({
            placeholder: "Select Client Category",
        });
        $(".clientBtn").on('click', function () {
            $('.dropify-preview').hide();
            $("#upSave").load(location.href + " #upSave>*", "");
        });

        $("#mediaStore").validate({
        rules: {
            service_id: {
                required:true,
            },
            sub_service_name: {
                required:true,
                maxlength:80
            },
            image: {
                required:true,
            },
            sub_service_description: {
                required:true,
            },
        },
    });
    $("#mediaUpdate").validate({
        rules: {
            service_id: {
                required:true,
            },
            sub_service_name: {
                required:true,
                maxlength:80
            },
            sub_service_description: {
                required:true,
            },
        },
    });

    });
</script>
<script>
        $(document).ready(function() {
            $('#socialMedia').DataTable({
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control" style="width:160px;"><option value="">Search by Service</option></select>'
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

            $('#socialMedia tfoot tr').prependTo('#socialMedia thead');
            $('.loader').hide();

        });
    $(document).ready( function () {
        $('.dropify').dropify();
        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('sub-services')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#cat2').val(response.data.service_id);
                        $('#sub_service_name').val(response.data.sub_service_name);
                        $('#category-edit-id').val(response.data.sub_service_id);
           
                        $('#sub_service_description').val(response.data
                            .sub_service_description);
                        try {
                            CKEDITOR.instances['sub_service_description'].destroy(true);
                        } catch (e) {}
                        CKEDITOR.replace('sub_service_description');
                        if (response.data.sub_service_image) {
                            var img_url = '{!!URL::to('/')!!}' + "/" + response.data.sub_service_image;
                            console.log('img url: ',img_url);

                            $("#image2").attr("data-height", 100);
                            $("#image2").attr("data-default-file", img_url);

                            $(".dropify-wrapper").removeClass("dropify-wrapper").addClass("dropify-wrapper has-preview");
                            $(".dropify-preview").css('display', 'block');
                            $('.dropify-render').html('').html('<img src=" ' + img_url + '" style="max-height: 100px;">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        $("#image2").dropify();

                        $('#myModal').modal('show');


                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });

            //View===============================================================
            $('#reload-category').on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('sub-services')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewName').html(response.data.sub_service_name);
                        $('#viewDescription').html(response.data.sub_service_description);
                        $('#viewImage').html(`<img width="300" height="300" class="img-fluid"  src="${url}/${response.data.sub_service_image}"/>`);

                        $('#viewModal').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });

        //save data
        $('#mediaStore').on('submit', function (e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('subservices.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
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
                    if(response.status == 0){
                        $.each(response.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status = true){
                            $('#myModalSave').modal('hide');
                            toastr.success('Data Inserted Successfully');
                            $('#mediaStore').trigger('reset');
                            var content_table = $('#socialMedia').DataTable();
                            var tst = content_table.row.add([

                    "" + response.data.service_id + "",
                    "" + response.data.sub_service_name + "",
                    "" + response.data.formated_description + "",
                    '<img src="'+response.data.sub_service_image+'" style="width: 45px; height:45px;"/>',
                    `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.sub_service_id}"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.sub_service_id}" title="Edit"><i class="flaticon-pencil"></i></button>&nbsp;<a class="deletetag" data-id="${response.data.sub_service_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
                ]).draw().node();

                        }
                        $("#loadnow").load(location.href + " #loadnow>*", "");
                    }
                }

            });

        });


        //Delete data
        $(document).on('click', '.deletetag', function (e) {
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
                            url: "{!! route('subservices.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                if (response.success === true) {
                                    toastr.success('Data Deleted Successfully');
                                    $('#socialMedia').DataTable().row('.item' + response.data.sub_service_id).remove()
                                    .draw()
                                }
                                $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });


        // //Update data
        $('#mediaUpdate').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            $.ajax({
                url: "{{route('subservices.updated')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
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
                    if(data.status == 0){
                        $.each(data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(data.status = true){
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
