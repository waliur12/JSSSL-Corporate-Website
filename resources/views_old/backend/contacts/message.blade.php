@extends('backend.home')
@section('title','Admin | Messages')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboarde</a></li>
            <li class="breadcrumb-item active" aria-current="page">Messages</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body"><br>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Message List</h4>
            </div><br>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100  dataTable no-footer table-striped" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center">Name</th>
                            <th class=" text-center">Email</th>
                            <th class=" text-center">Contact Number</th>
                            <th class=" text-center">Message</th>
                            <th class=" text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($messages as $message)
                        <tr role="row" class="item{{$message->message_id}}">
                            <td class="text-center">{{$message->message_name}}</td>
                            <td class="text-center">{{$message->message_email}}</td>
                            <td class="text-center">{{$message->message_contact}}</td>
                            <td class="text-center">{{ \Illuminate\Support\Str::limit($message->message_description, 20, $end='...') }}</td>
                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$message->message_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <a class="deletetag" data-id="{{$message->message_id}}">
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
                       <p><b>Name:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewName"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Email:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewMail"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Contact Number:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewContact"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Message:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewDescription"></div>
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
        // CRUD Operation

            //View===============================================================
            $('#reload-category').on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('messages')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response.data);
                        $('#viewName').html(response.data.message_name);
                        $('#viewMail').html(response.data.message_email);
                        $('#viewContact').html(response.data.message_contact);
                        $('#viewDescription').html(response.data.message_description);
                        $('#viewModal').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
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
                            url: "{!! route('messages.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                if (response.success === true) {
                                    toastr.success('Data Deleted Successfully');
                                    $('#socialMedia').DataTable().row('.item' + response.data.message_id).remove()
                                    .draw()
                                }
                                $("#loadnow").load(location.href + " #loadnow>*", "");
                            }

                        });
                    }
                }
            )
        });
    });
</script>
@endsection
