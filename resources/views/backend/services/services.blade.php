@extends('backend.home')
@section('title','Admin | Services')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon servieChoose clientBtn" title="Add" data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i>Service</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Service List</h4>
            </div><br>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped  dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center">Service Name </th>
                            <th class=" text-center">Service Precedence </th>
                            <th class=" text-center">Service Image </th>
                            <th class=" text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($services as $service)
                        <tr class="item{{$service->service_id}}" role="row">
                            <td class="text-center">{{$service->service_name}}</td>
                            <td class="text-center">{{$service->service_precedence}}</td>
                            <td class="text-center"><img src="{{asset($service->service_image)}}" style="width: 45px; height: 45px;" /></td>
                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$service->service_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$service->service_id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>
                                <a class="deletetag" data-id="{{$service->service_id}}">
                                    <button class="ms-btn-icon btn-primary category-delete"
                                            title="Delete"><i
                                            class="flaticon-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--modal content  Save-->
<div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <div class="headCenter">
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add New Service</h5></div>
             </div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf
             <div id="mediaSave">
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Service Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text"  name="service_name"
                               placeholder="Service Name...">
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Service Precedence</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" id="service_precedence" name="service_precedence"
                               placeholder="Service Precedence...">
                    </div>
                </div>
             </div>
             <div class="form-group row flex_css">
                <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Service Image(400*440)</label>
                <div class="col-sm-9">
                   <input type="file" name="image" data-allowed-file-extensions="png jpg jpeg"  class="dropify"/>
                </div>
            </div>



             <div class="form-group m-b-0">
                 <div>
                     <button type="submit" class="btn btn-square btn-info">
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter">
                    <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Service Update</h5></div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf
                <div id="upMedia">
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Service Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="service_name2"  name="service_name"
                                   placeholder="Service Name...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                        <label for="name" class="col-sm-3 col-form-label">Service Precedence</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="number" id="service_precedence2"  name="service_precedence"
                                   placeholder="Service Precedence...">
                        </div>
                    </div>
                </div>

                <div class="form-group row flex_css">
                    <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Service Image(400*440)</label>
                    <div class="col-sm-9">
                       <input type="file" name="image" id="image2" data-allowed-file-extensions="png jpg jpeg"  class="dropify"/>
                    </div>
                </div>
                <input type="hidden" name="category_id" id="category-edit-id" class="form-control">

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
 <div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <div class="headCenter">
            <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">Office Details</h5></div>
           </div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Service Name:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewName"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Service Precedence:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewPrecedence"></div>
                   </div>
               </div>
           </div><br>

       </div>
   </div>
</div>
</div>


@endsection
@section('js')

<script>
    $(document).ready( function () {
        $('.dropify').dropify();
        $('#socialMedia').DataTable({
            "ordering": false
        });

        $(".clientBtn").on('click', function () {
            $('.dropify-preview').hide();
            $('#mediaStore').trigger('reset');
            $("#mediaSave").load(location.href + " #mediaSave>*", "");
        });

        $("#mediaStore").validate({
        rules: {
            service_name: {
                required:true,
                maxlength:50
            },
            service_precedence: {
                required:true,
            },
            image: {
                required:true,
            },
        },
    });
    $("#mediaUpdate").validate({
        rules: {
            service_name: {
                required:true,
                maxlength:80
            },
        },
    });

        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('services')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#service_name2').val(response.data.service_name);
                        $('#service_precedence2').val(response.data.service_precedence);
                        $('#category-edit-id').val(response.data.service_id);
                        if (response.data.service_image) {
                            var img_url = '{!!URL::to('/')!!}' + "/" + response.data.service_image;
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
                    url: "{{url('services')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', response.data);
                        $('#viewName').html(response.data.service_name);
                        $('#viewPrecedence').html(response.data.service_precedence);
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
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('services.store')}}",
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

                    "" + response.data.service_name + "",
                    "" + response.data.service_precedence + "",
                    '<img src="'+response.data.service_image+'" style="width: 45px; height:45px;"/>',
                    `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.service_id}"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.service_id}" title="Edit"><i class="flaticon-pencil"></i></button>&nbsp;<a class="deletetag" data-id="${response.data.service_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
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
                            url: "{!! route('services.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                // console.log('tt',response);


                                if(response.status == 0){
                                    toastr.error('Delete this Sub Service first from Sub Services Section');
                                }else{
                                    if (response.success === true) {
                                        toastr.success('Data Deleted Successfully');
                                        $('#socialMedia').DataTable().row('.item' + response.data.service_id).remove()
                                    .draw()
                                    }
                                    $("#loadnow").load(location.href + " #loadnow>*", "");
                                }
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
            $.ajax({
                url: "{{route('services.updated')}}",
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

<script>
    // Set suggested value
    $(document).on('click', '.servieChoose', function (e) {
        e.preventDefault();
        let id = 1;
        // console.log(id);

        $.ajax({
            method: 'get',
            data: {
                id
            },
            url: '{{ url('max-precedence') }}/' + id,
            success: function (result) {
                console.log('valllll',result);

                var value = Object.values(result);
                var pass = parseInt(result) + 1;
                console.log(typeof (result));
                if (value.length == 0) {
                    $('#service_precedence').val("1");
                } else {
                    $('#service_precedence').val(pass);
                }
            },
            error: function (err) {
                console.log(err)
            }
        })

    });
</script>


<script>

    $(document).ready(function () {
        $("#service_precedence").on("change keyup paste", function () {
            let id = $(this).val();
            console.log('key_id',id);
            // alert(pos);

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('get-precedence') }}/' + id,
                success: function (result) {
                    console.log('keyup', result);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 200,
                        "fadeOut": 3000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if (result.message) {
                        toastr.error(result.message);
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            })

        });
    });


    $(document).ready(function () {
        $("#service_precedence2").on("change keyup paste", function () {
            let id = $(this).val();
            console.log(id);

            $.ajax({
                method: 'get',
                data: {
                    id
                },
                url: '{{ url('get-precedence-update') }}/' + id,
                success: function (result) {
                    console.log('keyup', result);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 200,
                        "fadeOut": 1000,
                        "timeOut": 1000,
                        "extendedTimeOut": 1000
                    };

                    if (result.message) {
                        toastr.error(result.message);
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            })

        });
    });

</script>
@endsection
