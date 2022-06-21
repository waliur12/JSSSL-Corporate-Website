@extends('backend.home')
@section('title','Admin | News')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">News</li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="addnewdata">
                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Add" data-toggle="modal" data-target="#myModalSave"><i class="fa fa-plus"></i> News</button>
            </div>
            <div class="service_list">
                <h4 class="text-center display-4" style="font-size: 25px;">News List</h4>
            </div>
            <div id="reload-category">
                <table id="socialMedia" class="table w-100 table-striped dataTable no-footer" role="grid" aria-describedby="data-table-4_info" style="width: 1098px;">
                    <thead>
                        <tr role="row">
                            <th class=" text-center" style="width: 20%;">Title</th>
                            <th class=" text-center" style="width: 20%;">Description</th>
                            <th class=" text-center" style="width: 20%;">Image</th>
                            <th class=" text-center" style="width: 20%;">Published Date</th>
                            <th class=" text-center" style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadnow">
                        @foreach ($all_news as $val)
                        <tr role="row" class="item{{$val->news_id}}">
                            <td class="text-center">{{$val->news_title}}</td>
                            <td class="text-center">{{\Illuminate\Support\Str::limit($val->formated_description , 25, $end='...') }}</td>
                            <td class="text-center"><img src="{{asset($val->news_image)}}" style="width: 45px; height: 45px;" /></td>
                            <td>{{ \Carbon\Carbon::parse($val->news_published_at)->format('jS F, Y') }}</td>


                            <td class="text-center">
                                <button type="button"
                                        class="ms-btn-icon btn-info viewData"
                                        data-id="{{$val->news_id}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button"
                                        class="ms-btn-icon btn-success media-edit"
                                        data-id="{{$val->news_id}}" title="Edit">
                                    <i class="flaticon-pencil"></i>
                                </button>
                                <a class="deletetag" data-id="{{$val->news_id}}">
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
<div id="myModalSave" class="modal fade"  role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Add New News</h5></div>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mediaStore'])!!}
             @csrf

            <div id="newsSave">
                <div class="form-group row flex_css">
                <label for="name" class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="news_title"
                           placeholder="Title Name...">
                </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea   class="form-control " name="news_description" id="description"  cols="30" rows="10" placeholder="Description here..." required></textarea>
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Published Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="date" name="news_published_at">
                    </div>
                </div>
            </div>
            <div class="form-group row flex_css">
                <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                   <input type="file" name="image" data-allowed-file-extensions="png jpg jpeg GIF"  class="dropify"/>
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
                <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel"> Update News</h5></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!!Form::open(['class' => 'form-horizontal','id'=>'mediaUpdate'])!!}
                @csrf

                <input type="hidden" name="category_id" id="category-edit-id" class="form-control">
                <div id="newsUpdate">
                    <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="news_title" name="news_title"
                               placeholder="Title Name..." required>
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control description" name="news_description" id="news_description"  cols="30" rows="10" placeholder="Description here..."></textarea>
                    </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="name" class="col-sm-3 col-form-label">Published Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="date" id="news_published_at" name="news_published_at">
                    </div>
                </div>
                </div>
                <div class="form-group row flex_css">
                    <label for="portfolio_cat_icon" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                       <input type="file" name="image" id="image2" data-allowed-file-extensions="png jpg jpeg GIF"  class="dropify"/>
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
 <div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <div class="headCenter"><h5 class="modal-title mt-0" id="myLargeModalLabel">News Details</h5></div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body" style="background: #f5f5f5;">
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>News Title:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewTitle"></div>
                   </div>
               </div>
           </div><br>
           <div class="Catname">
               <div class="d-flex">
                   <div class="col-md-4 p-0">
                       <p><b>Published At:</b></p>
                   </div>
                   <div class="col-md-8 p-0">
                       <div id="viewPublished"></div>
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

<script>
  CKEDITOR.replace('description');
    $(document).ready( function () {
        $('#socialMedia').DataTable();
        $('.dropify').dropify();
        $(".clientBtn").on('click', function () {
            $('.description').empty();
            // $("#newsSave").load(location.href + " #newsSave>*", "");
            $('.dropify-preview').hide();
        });
        $("#mediaStore").validate({
        rules: {
            news_title: {
                required:true,
                maxlength:80
            },
            news_description: {
                required:true,
            },
            image: {
                required:true,
            },
            news_published_at: {
                required:true,
            },
        },
    });

    $("#mediaUpdate").validate({
        rules: {
            news_title: {
                required:true,
                maxlength:80
            },
            news_description: {
                required:true,
            },
            news_published_at: {
                required:true,
            },
        },
    });
        // CRUD Operation
        //edit data
        $('#reload-category').on('click', '.media-edit', function () {
                let id = $(this).attr('data-id');

                $.ajax({
                    url: "{{url('news')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        $('#news_title').val(response.data.news_title);
                        $('#news_published_at').val(response.data.published_date);
                        $('#category-edit-id').val(response.data.news_id);

                        $('#news_description').val(response.data.news_description);
                        CKEDITOR.replace('news_description');

                        if (response.data.news_image) {
                            var img_url = '{!!URL::to('/')!!}' + "/" + response.data.news_image;
                            // console.log('img url: ',img_url);
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
                    url: "{{url('news')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        // console.log('data', data);
                        $('#viewTitle').html(response.data.news_title);
                        $('#viewPublished').html(response.data.formated_date);
                        $('#viewDescription').html(response.data.news_description);
                        $('#viewImage').html(`<img width="300" height="300" class="img-fluid"  src="${url}/${response.data.news_image}"/>`);

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
            for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            $.ajax({
                url: "{{route('news.store')}}",
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

                    "" + response.data.news_title + "",
                    "" + response.data.formated_description + "",
                    '<img src="'+response.data.news_image+'" style="width: 45px; height:45px;"/>',
                    "" + response.data.news_published_at + "",
                    `<button type="button" class="ms-btn-icon btn-info viewData" data-id="${response.data.news_id}"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="ms-btn-icon btn-success media-edit" data-id="${response.data.news_id}" title="Edit"><i class="flaticon-pencil"></i></button>&nbsp;<a class="deletetag" data-id="${response.data.news_id}"><button class="ms-btn-icon btn-primary category-delete" title="Delete"><i class="flaticon-trash"></i></button> </a>`
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
                            url: "{!! route('news.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                if (response.success === true) {
                                    toastr.success('Data Deleted Successfully');
                                    $('#socialMedia').DataTable().row('.item' + response.data.news_id).remove()
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
                url: "{{route('news.updated')}}",
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
