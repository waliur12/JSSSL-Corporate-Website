@extends('backend.home')
@section('title','Admin | Offices')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Offices</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Main Office</h4>
            </div><br>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped  dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center">Contact </th>
                            <th class=" text-center">Email </th>
                            <th class=" text-center">Location</th>
                            <th class=" text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($offices as $office)
                        <tr class="item{{$office->id}}" role="row">
                            <td class="text-center">{{$office->contact}}</td>
                            <td class="text-center">{{$office->email}}</td>
                            <td class="text-center">{{$office->location}}</td>
                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$office->id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$office->id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>

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
<!--modal content Update -->
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headCenter">
                    <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Office Info Update</h5></div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Contact</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="contact"  name="contact"
                               placeholder="Contact Number...">
                    </div>
                </div>
                <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Email</label>
                   <div class="col-sm-9">
                       <input class="form-control" type="email" id="email"  name="email"
                              placeholder="Email Here...">
                   </div>
               </div>
               <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Location</label>
                   <div class="col-sm-9">
                        <textarea name="location" class="form-control" id="location" cols="30" rows="3" placeholder="Office Location..."></textarea>
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
            <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">Main Office Details</h5></div>
           </div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Email:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_email"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Phone Number:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_phone"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Office Location:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="view_address"></div>
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
    $('#socialMedia').DataTable();
    $("#mediaUpdate").validate({
        rules: {
            contact: {
                required:true,
            },
            email: {
                required:true,
            },
            location: {
                required:true,
                maxlength:100
            },


        },
    });

        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{url('main-office')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#contact').val(response.data.contact);
                        $('#email').val(response.data.email);
                        $('#location').val(response.data.location);
                        $('#category-edit-id').val(response.data.id);
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
                    url: "{{url('main-office')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', response.data);

                        $('#view_email').html(response.data.email);
                        $('#view_phone').html(response.data.contact);
                        $('#view_address').html(response.data.location);
                        $('#viewModal').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });



        // //Update data
        $('#mediaUpdate').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('mainoffice.updated')}}",
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
