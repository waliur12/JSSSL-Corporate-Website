@extends('backend.home')
@section('title','Profile')
@section('content')
<style>
    .btn {
        font-size: 14px;
        outline: none;
        padding: 0.325rem 1rem!important;
        min-width: 120px;
        margin-top:0!important;
    }
    .error{color:red;font-size: 14px;}
    .profileView {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 150px;
    }
    .card.profile_card {
        background: aliceblue;
    }
    .profileheading {
        text-align: center;
        margin-top: 25px;
    }
    h4.text-mute.mb-3.text-center {
        font-size: 16px;
        opacity: 0.4;
        font-weight: 700;
        padding-bottom: 5px;
    }
    .prof_image {
        text-align: center;
        padding-top: 15px;
    }
    .prof_image img {
        width: 100px;
        height: 100px;
        border: 2px solid #703f3f;
        border-radius: 50%;
        box-shadow: 0px 0px 4px 2px #888888;
    }
    .card_size {
        min-height: 450px;
        margin-top: 80px;
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
        </nav>

        <div class="ms-panel">
            <div class="container card profile_card">
                    <div class="col-md-8 offset-md-2">
                        <div class="card_size" id="loadnow">
                            <div class="profileheading">
                                <h4  style="opacity: .7;font-size:17px;">__Profile View__</h4>
                            </div>
                            <div class="prof_image">
                                <img src="{{asset('/'.Auth::user()->image)}}" alt="profile-image">
                            </div>
                            <div class="profileView">
                                <div class="col-md-3">
                                    <div class="name"><b>Name:</b> </div>
                                    <div class="email"><b>Email: </b></div>
                                    <div class="email"><b>Member Since: </b></div>
                                </div>
                                <div class="com-md-4">
                                    <div class="name_n">{{Auth::user()->name}}</div>
                                    <div class="email_e">{{Auth::user()->email}}</div>
                                    <div class="email_e">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('jS F, Y') }}</div>
                                </div>
                            </div>
                            {{-- data-toggle="modal" data-target="#myModalSave" --}}
                            <div class="update_prof text-center">
                                <button type="submit" class="btn btn-square btn-dark has-icon updateProfileBtn"  data-id="{{Auth::user()->id}}" title="Update Profile" >
                                    <i class="flaticon-reuse"></i>Update Profile</button><br><br>
                            </div>
                        </div>
                    </div>
                </div>

        </div>



<div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog passModel">
   <div class="modal-content">
       <div class="modal-header">
           <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Update Your Profile</h5></div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
        <div class="wrapper-page">

            <div class="p-3">

                {!!Form::open(['class' => 'form-horizontal','id'=>'ProfileUpdateForm'])!!}
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="name">Your Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name Here..."
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="email">Your Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Here..."
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="email">Your Image</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="image" id="image2"  class="dropify">
                        </div>
                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-success btn-square w-md waves-effect waves-light" type="submit">Update Profile</button>
                        </div>
                    </div>

                    {!!Form::close()!!}
            </div>


        </div>
       </div>
   </div>
</div>
</div>
        {{-- Modal End--}}

      </div>

    </div>
  </div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('#image2').dropify();
        $("#oldPassForm").validate({
            rules: {
                oldpass: {
                    required:true,
                }
            }
        });
        $("#newPassForm").validate({
            rules: {
                newPass: {
                    required:true,
                    minlength:8
                },
                confirmPass: {
                    required:true,
                    equalTo: "#newPass"
                }
            }
        });
    });
</script>
<script>
    $("#ProfileUpdateForm").validate({
        rules: {
            name: {
                required:true,
                maxlength:50
            },
            email: {
                required:true,
            },
        },
    });


    $('#ProfileUpdateForm').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('profile.update')}}",
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
                            $('#ProfileUpdateForm').trigger('reset');
                            $('#myModalSave').modal('hide');
                            toastr.success('Profile Updated Successfully');
                            $("#loadnow").load(location.href + " #loadnow>*", "");
                        }
                    }



                }
            });
        });

        //edit data
        $(document).on('click', '.updateProfileBtn', function () {
                let id = $(this).attr('data-id');
                console.log('id:',id);
                $.ajax({
                    url: "{{url('profile-update')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response);
                        $('#name').val(response.data.name);
                        $('#email').val(response.data.email);
                        if (response.data.image) {

                            var img_url = '{!!URL::to('/')!!}' + "/" + response.data.image;
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



                        $('#myModalSave').modal('show');
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });



</script>
@endsection

