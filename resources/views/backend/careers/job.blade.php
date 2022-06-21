@extends('backend.home')
@section('title','Admin | Jobs')
@section('content')
<style>
    .modal-dialog {
        max-width: 680px;
        margin: 1.75rem auto;
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="material-icons">home</i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jobs</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> Job</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">Job List</h4>
            </div>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100  dataTable no-footer table-striped" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Customer ID: activate to sort column descending">Job Title</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending">Location</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending">Short Desciption</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending">Long Desciption</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending">Deadline</th>
                            <th class=" text-center" tabindex="0" aria-controls="data-table-4" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($jobs as $job)
                        <tr class="item{{$job->id}}" role="row">
                            <td class="text-center">{{ \Illuminate\Support\Str::limit($job->job_title, 20, $end='...') }}</td>
                            <td class="text-center">{{ \Illuminate\Support\Str::limit($job->job_location, 20, $end='...') }}</td>
                            <td class="text-center">{!! \Illuminate\Support\Str::limit($job->job_short_description, 20, $end='...') !!}</td>
                            <td class="text-center">{!! \Illuminate\Support\Str::limit($job->job_long_description, 20, $end='...') !!}</td>
                            <td>{{ \Carbon\Carbon::parse($job->deadline)->format('jS F, Y') }}</td>

                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$job->id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$job->id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>
                                <a class="deletetag" data-id="{{$job->id}}">
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
<div id="myModalSave"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content lg">
         <div class="modal-header">
             <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add Job</h5></div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf
             <div id="jobSave">
                 <div class="form-group row flex_css">
                 <label for="Title" class="col-sm-3 col-form-label">Title</label>
                 <div class="col-sm-9">
                     <input class="form-control" type="text" name="job_title"
                            placeholder="Job Title...">
                 </div>
                 </div>
                 <div class="form-group row flex_css">
                     <label for="job_location" class="col-sm-3 col-form-label">Job Location</label>
                     <div class="col-sm-9">
                         <input class="form-control" type="text"  name="job_location"
                                placeholder="Job Location...">
                     </div>
                 </div>
                 <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Deadline</label>
                    <div class="col-sm-9">
                        <input type="date"  class="form-control" name="deadline">
                    </div>
                </div>
             </div>

             <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Short Description</label>
                <div class="col-sm-9">
                    <textarea name="job_short_description" id="job_short_description" cols="30" rows="10" ></textarea>
                </div>
            </div>
             <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Long Description</label>
                <div class="col-sm-9">
                    <textarea name="job_long_description" id="job_long_description" cols="30" rows="10" ></textarea>
                </div>
            </div>
            {{-- <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Responsibility</label>
                <div class="col-sm-9">
                    <textarea name="responsibility" cols="30" rows="10" ></textarea>
                </div>
            </div>
            <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">requirement</label>
                <div class="col-sm-9">
                    <textarea name="requirement" cols="30" rows="10" ></textarea>
                </div>
            </div> --}}
            <div class="form-group row flex_css">
                <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Upload Admin Card</label>
                <div class="col-sm-9">
                    <input type="file" class="dropify" name="board_member_image">
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
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel"> Job Info Update</h5></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf
                <div id="jobUpdate">
                    <div class="form-group row flex_css">
                    <label for="Title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="job_title" name="job_title"
                               placeholder="Job Title...">
                    </div>
                    </div>
                    <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                    <div class="form-group row flex_css">
                        <label for="job_location" class="col-sm-3 col-form-label">Job Location</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="job_location"   name="job_location"
                                   placeholder="Job Location...">
                        </div>
                    </div>
                    <div class="form-group row flex_css">
                       <label for="name" class="col-sm-3 col-form-label">Deadline</label>
                       <div class="col-sm-9">
                           <input type="date" id="deadline" class="form-control" name="deadline">
                       </div>
                   </div>
                </div>

                <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Short Description</label>
                   <div class="col-sm-9">
                       <textarea name="job_short_description" id="short_description" cols="30" rows="20" ></textarea>
                   </div>
               </div>
                <div class="form-group row flex_css">
                   <label for="name" class="col-sm-3 col-form-label">Long Description</label>
                   <div class="col-sm-9">
                       <textarea name="job_long_description" id="long_description" cols="30" rows="20" ></textarea>
                   </div>
               </div>

                <div class="form-group m-b-0">
                    <div>
                        <button type="submit" class="btn btn-square btn-success">
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
<div id="viewModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">Job Details</h5></div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">

           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Job Title:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewTitle"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Job Location:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewLocation"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Short Description:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewShort"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Long Description:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewLong"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Deadline:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewDeadline"></div>
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
    $(document).ready(function () {
        $("#mediaStore").validate({
            rules: {
                job_title: {
                    required:true,
                    maxlength:80
                },
                job_location: {
                    required:true,
                    maxlength:100
                },
                job_short_description: {
                    required:true,
                },
                job_long_description: {
                    required:true,
                },
                deadline: {
                    required:true,
                },
            },
        });
    $("#mediaUpdate").validate({
        rules: {
            job_title: {
                required:true,
                maxlength:80
            },
            job_location: {
                required:true,
                maxlength:100
            },

            deadline: {
                required:true,
            },
        },
    });
    });
</script>

<script>
    $(document).ready( function () {
        $('.dropify').dropify();
        $('#socialMedia').DataTable();
        $(".clientBtn").on('click', function () {
            $("#jobSave").load(location.href + " #jobSave>*", "");
        });
        // CRUD Operation

        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');
                $("#jobUpdate").load(location.href + " #jobUpdate>*", "");
                $.ajax({
                    url: "{{url('job')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#job_title').val(response.data.job_title);
                        $('#job_location').val(response.data.job_location);

                        $('#deadline').val(response.data.deadline);
                        $('#category-edit-id').val(response.data.id);
                        tinymce.get("short_description").setContent(response.data.job_short_description);
                        tinymce.get("long_description").setContent(response.data.job_long_description);

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
                    url: "{{url('job')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewTitle').html(response.data.job_title);
                        $('#viewLocation').html(response.data.job_location);
                        $('#viewShort').html(response.data.job_short_description);
                        $('#viewLong').html(response.data.job_long_description);
                        $('#viewDeadline').html(response.data.deadline);

                        $('#viewImage').html(`<img width="300" height="300" class="img-fluid"  src="${url}/${response.data.social_media_icon}"/>`);

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
                url: "{{route('job.store')}}",
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

                    "" + response.data.job_title + "",
                    "" + response.data.job_location + "",
                    "" + response.data.job_short_description + "",
                    "" + response.data.job_long_description + "",
                    "" + response.data.service_deadline + "",
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
                            url: "{!! route('job.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                if (response.success === true) {
                                    toastr.success('Data Deleted Successfully');
                                    $('#socialMedia').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
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
                url: "{{route('job.updated')}}",
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
