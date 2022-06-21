@extends('backend.home')
@section('title','Admin | Board Member')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Board Members</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i> Board Member</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Board Member List</h4>
            </div>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped  dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Customer ID: activate to sort column descending">Board Member Name </th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Customer ID: activate to sort column descending">Board Member Designation</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Customer ID: activate to sort column descending">Board Member Photo</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($members as $member)
                        <tr class="item{{$member->board_member_id}}" role="row">
                            <td class="text-center">{{$member->board_member_name}}</td>
                            <td class="text-center">{{$member->board_member_designation}}</td>
                           <td class="text-center">
                               
                            <img src="{{asset($member->board_member_image)}}" style="width: 45px; height: 45px;">
                        </td> 
                            <td class="text-center">

                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$member->board_member_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$member->board_member_id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>
                                <a class="deletetag" data-id="{{$member->board_member_id}}">
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
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add New Board Member</h5></div>
             </div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf
             <div class="form-group row flex_css">
                 <label for="name" class="col-sm-3 col-form-label">Board Member Name</label>
                 <div class="col-sm-9">
                     <input class="form-control" type="text"  name="board_member_name"
                            placeholder="Board Member Name...">
                 </div>
             </div>
             <div class="form-group row flex_css">
                 <label for="name" class="col-sm-3 col-form-label">Member Designation</label>
                 <div class="col-sm-9">
                     <input class="form-control" type="text"  name="board_member_designation"
                            placeholder="Board Member Designation...">
                 </div>
             </div>
             {{-- <input type="file" name="image" data-allowed-file-extensions="png jpg jpeg svg"  class="class_name"/> --}}
             {{-- <div class="form-group row ">
                <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Icon</label>
                <div class="col-sm-9">
                  
                </div>
            </div> --}}
             <div class="form-group row flex_css">
                <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Member Photo</label>
                <div class="col-sm-9">
                    <input type="file" class="dropify" name="board_member_image" data-allowed-file-extensions="png jpg jpeg svg" >
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
                <div class="headCenter">
                    <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel"> Board Member Update</h5></div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-4 col-form-label">Board Member Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="board_member_name" name="board_member_name"
                               placeholder="Client Category Name..." >
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-4 col-form-label">Board Member Designation</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="board_member_designation" name="board_member_designation"
                               placeholder="Client Category Name..." >
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-4 col-form-label">Board Member Photo</label>
                    <div class="col-sm-8">
                        <input type="file" name="board_member_image" id="edit_image" class="custom-file-input" data-errors-position="outside"  data-max-file-size="0.6M">

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
            <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">Board Member Details</h5></div>
           </div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Member Name:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewName"></div>
                   </div>
               </div>
           </div>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Designation:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewDesignation"></div>
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
    $(document).ready( function () {
        $('#socialMedia').DataTable();
        $(".clientBtn").on('click', function () {
            $('.dropify-preview').hide();
        });
        $('.dropify').dropify();


    $("#mediaStore").validate({
            rules: {
                board_member_name: {
                    required:true,
                    maxlength:80
                },
                board_member_designation: {
                    required:true,
                },
            },
        });
        $("#mediaUpdate").validate({
            rules: {
                board_member_name: {
                    required:true,
                    maxlength:80
                },
                board_member_designation: {
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
                    url: "{{url('member')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#board_member_name').val(response.data.board_member_name);
                        $('#board_member_designation').val(response.data.board_member_designation);
                        $('#category-edit-id').val(response.data.board_member_id);
                        var path = "{{ url('/') }}" + '/';
                        if (response.data.board_member_image) {
                            var img_url = path + response.data.board_member_image;
                            $("#edit_image").attr("data-default-file", img_url);

                            $(".dropify-wrapper").removeClass("dropify-wrapper").addClass(
                                "dropify-wrapper has-preview");
                            $(".dropify-preview").css('display', 'block');
                            $('.dropify-render').html('').html('<img src=" ' + img_url +
                                '">')
                        } else {
                            $(".dropify-preview .dropify-render img").attr("src", "");
                        }
                        $('#edit_image').dropify({
                            error: {
                                'fileSize': 'The file size is too big ( 600KB  max).',
                            }
                        });
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
                    url: "{{url('member')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewName').html(response.data.board_member_name);
                        $('#viewDesignation').html(response.data.board_member_designation);
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
                url: "{{route('member.store')}}",
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
                        $.each(data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status = true){
                            $('#myModalSave').modal('hide');
                            toastr.success('Data Inserted Successfully');
                            $('#mediaStore').trigger('reset');
                            var content_table = $('#socialMedia').DataTable();
                        var tst = content_table.row.add([

                    "" + response.data.board_member_name + "",
                    "" + response.data.board_member_designation + "",
                    '<img src="'+response.data.board_member_image+'" style="width: 45px; height:45px;"/>',
                    `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.board_member_id}"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.board_member_id}" title="Edit"><i class="flaticon-pencil"></i></button>&nbsp;<a class="deletetag" data-id="${response.data.board_member_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
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
                            url: "{!! route('member.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                if (response.success === true) {
                                    toastr.success('Data Deleted Successfully');
                                    $('#socialMedia').DataTable().row('.item' + response.data.board_member_id).remove()
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
            $.ajax({
                url: "{{route('member.updated')}}",
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
