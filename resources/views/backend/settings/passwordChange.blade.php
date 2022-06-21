@extends('backend.home')
@section('title','Password Change')
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
</style>
<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Password Change</li>
          </ol>
        </nav>
        <div class="ms-panel">
          <div class="ms-panel-body">
            <h6 class="text-center" style="opacity: 0.6;">For Changing your password, you must have to varify your current password.</h6><br>

            <div class="col-md-12">
            {!!Form::open(['class' => 'form-horizontal','id'=>'oldPassForm'])!!}
             @csrf
             <div class="row flx">
                <div class="offset-md-2 col-md-5">
                    <div class="form-group row">
                        <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="Enter Current password" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-square btn-dark has-icon" title="Reset">
                        <i class="flaticon-reuse"></i> Password Change</button>
                </div>
             </div>
            {!!Form::close()!!}
            </div>
          </div>
        </div>



<div id="myModalSave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog passModel">
   <div class="modal-content">
       <div class="modal-header">
           <div class="headCenter"><h5 class="modal-title mt-0" id="myModalLabel">Password Change</h5></div>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
        <div class="wrapper-page">

            <div class="p-3">
                <h4 class="text-muted font-18 mb-3 text-center">Reset Password</h4>
                {!!Form::open(['class' => 'form-horizontal','id'=>'newPassForm'])!!}
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="OldPass">New Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newPass" name="newPass" placeholder="New password..."required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="OldPass">Confirm Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirmPass" id="confirmPass" placeholder="Confirm password..." required>
                        </div>
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary btn-square" type="submit"><i class="flaticon-reuse"></i> Reset</button>
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
    $('#oldPassForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        if(! $form.valid()) return false;
        $.ajax({
            url: "{{route('reset.check')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('data',data.success);
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000
                    // console.log();
                };
                if (data.success == true) {
                    $("#myModalSave").modal('show');
                    setTimeout(function () {
                        $('#oldPassForm').trigger('reset');
                        }, 500);
                }else{
                    toastr.error('Please enter the correct password');
                }
            }
        });
    });

    $('#newPassForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        if(! $form.valid()) return false;
        $.ajax({
            url: "{{route('newPass.change')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log('data',data.success);
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
                // toastr.error('Password must contain minimum 8 character!');
                $.each(data.error,function(key,value){
                toastr.error(value);
                })
            }else{
                if (data.success == true) {
                toastr.success('Password has been changed');
                $('#newPassForm').trigger('reset');
                $("#myModalSave").modal('hide');
                }else{
                    toastr.error('Not match with confirmation password');
                }
            }



            }
        });
    });
</script>
@endsection

