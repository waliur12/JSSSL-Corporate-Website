@extends('backend.home')
@section('title','Admin | Clients')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Client Categories</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i> Client Category</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Client Category List</h4>
            </div>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped  dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Customer ID: activate to sort column descending">Client Category </th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($clientcat as $cat)
                        <tr class="item{{$cat->client_category_id}}" role="row">
                            <td class="text-center">{{$cat->client_category_name}}</td>
                            <td class="text-center">

                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$cat->client_category_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>&nbsp;
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$cat->client_category_id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>&nbsp;
                                <a class="deletetag" data-id="{{$cat->client_category_id}}">
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
             <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add New Client Category</h5></div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf
             <div class="form-group row flex_css">
                 <label for="name" class="col-sm-3 col-form-label">Client Category</label>
                 <div class="col-sm-9">
                     <input class="form-control" type="text"  name="client_category_name"
                            placeholder="Client Category Name...">
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel"> Client Category Update</h5></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Client Category</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="client_category_name" name="client_category_name"
                               placeholder="Client Category Name...">
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
           <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">Client Category Details</h5></div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Client Category:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewCat"></div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
</div>


@endsection
@section('js')
<script>
    $("#mediaStore").validate({
        rules: {
            client_category_name: {
                required:true,
                maxlength:100
            }
        },
    });
    $("#mediaUpdate").validate({
        rules: {
            client_category_name: {
                required:true,
                maxlength:100
            }
        },
    });
</script>
<script>
    $(document).ready( function () {
        $('#socialMedia').DataTable();
        $(".clientBtn").on('click', function () {
            $("#mediaStore").load(location.href + " #mediaStore>*", "");
        });
        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('clientcat')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#client_category_name').val(response.data.client_category_name);
                        $('#category-edit-id').val(response.data.client_category_id);
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
                    url: "{{url('clientcat')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewCat').html(response.data.client_category_name);
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
                url: "{{route('clientcat.store')}}",
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
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if(response.status == 0){
                        $.each(response.data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.data.status = true){
                            $('#mediaStore').trigger('reset');
                            $('#myModalSave').modal('hide');
                            toastr.success('Data Inserted Successfully');
                            var content_table = $('#socialMedia').DataTable();
                            var tst = content_table.row.add([

                    "" + response.data.client_category_name + "",
                    `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.client_category_id}"><i class="fa fa-eye"></i></button><button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.client_category_id}" title="Edit"><i class="flaticon-pencil"></i></button><a class="deletetag" data-id="${response.data.client_category_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
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
                            url: "{!! route('clientcat.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                // console.log('tt',response);
                                if(response.status == 0){
                                    toastr.error('Delete this client category first from Client Section');
                                }else{
                                    if (response.success === true) {
                                        toastr.success('Data Deleted Successfully');
                                        $('#socialMedia').DataTable().row('.item' + response.data.client_category_id).remove()
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
            // var $form = $(this);
            // if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('clientcat.updated')}}",
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
                            $('#mediaUpdate').trigger('reset');
                            $('#myModal').modal('hide');
                            toastr.success('Data Updated Successfully');
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
