@extends('backend.home')
@section('title', 'All Applicant')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                    class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Applicants</li>
                    </ol>
                </nav>
                <div class="message"></div>

                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Applicant List </h6>

                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-striped" id="applicantTable">
                                <thead>
                                    <tr>
                                        <th class="package_no">Package No</th>
                                        <th scope="col" style="width: 20%;">Job Title</th>
                                        <th scope="col" style="width: 10%;">Location</th>
                                        <th scope="col" style="width: 10%;">Name</th>
                                        <th scope="col" style="width: 10%;">Contact</th>
                                        <th scope="col" style="width: 10%;">Email</th>

                                        <th class="religion">Religion</th>
                                        <th class="dob">Date of Birth</th>
                                        <th class="nid">Nid</th>
                                        <th class="father_name">Father Name</th>
                                        <th class="mother_name">Mother Name</th>
                                        <th class="education">Education</th>
                                        <th class="work">Working Experience</th>


                                        <th scope="col" style="width: 10%;">CV</th>
                                        <th scope="col" style="width: 30%;">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($all_applications))
                                        @foreach ($all_applications as $applicant)
                                            <tr class="item{{ $applicant->id }}">
                                                <td class="package_no">{{ $applicant->package_no }}</td>
                                                <td class="">{{ $applicant->title }}</td>
                                                <td class="">{{ $applicant->location }}</td>
                                                <td>{{ $applicant->name }}</td>
                                                <td class="">{{ $applicant->contact }}</td>
                                                <td class="">{{ $applicant->email }}</td>
                                                <td>{{ $applicant->religion }}</td>
                                                <td class="dob">{{ $applicant->dob }}</td>
                                                <td class="nid">{{ $applicant->nid }}</td>
                                                <td class="father_name">{{ $applicant->father_name }}</td>
                                                <td class="mother_name">{{ $applicant->mother_name }}</td>
                                                <td class="education">
                                                    @foreach ($applicant->getEducation as $item)
                                                        Degree: {{ $item->degree }}, Passing Year:
                                                        {{ $item->passing_year }},Result:
                                                        {{ $item->result }},Institution:
                                                        {{ $item->institution }},Subject: {{ $item->subject }}
                                                    @endforeach
                                                </td>
                                                <td class="work">
                                                    @foreach ($applicant->getWork as $work)
                                                        Company Name: {{ $work->company_name }},Designation:
                                                        {{ $work->designation }},Joining Date:
                                                        {{ $work->joining_date }}
                                                        ,End Date: {{ $work->end_date }}
                                                    @endforeach
                                                </td>

                                                <td class="">
                                                    <a href="
                                                    {{ asset('backend/' . $applicant->cv) }}" target="blank">
                                                    <button type='button' class='ms-btn-icon btn-dark'>
                                                        <i class='fas fa-eye'></i>
                                                    </button>
                                                    </a>
                                                </td>



                                                <td class="actionBtn">
                                                    <button type="button" class="ms-btn-icon btn-info viewData"
                                                    data-id="{{ $applicant->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                    {{-- <button type='button' class='ms-btn-icon btn-danger'
                                                        onclick='deleteItem({{ $applicant->id }},{{ $applicant->job_id }})'>
                                                        <i class='flaticon-trash'></i></button>
                                                    </button> --}}
                                                    <button type='button' class='ms-btn-icon btn-info view_admit_card_btn{{$applicant->id}}' 
                                                         onclick='viewAdmitCard({{$applicant->id }})'>
                                                        <i class='fa fa-id-card'></i></button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
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


    <!-- Add  Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white te" id="NoteModal">Add New </h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="sliderErrorMsg_addform"></span>
                <form id="applicantAddForm" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" name="title" value="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label>Image</label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input"
                                        onchange="document.getElementById('output_image').src = window.URL.createObjectURL(this.files[0])">
                                    <label class="custom-file-label">Upload Image...</label>
                                    <!-- <p class="mt-2 font-weight-light  text-muted">Image min width should be 640 & min height should be 360
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </p> -->
                                    <!-- <div class="invalid-feedback">Example invalid custom file feedback</div> -->
                                    <img id="output_image" class="mt-3 modal_img">
                                </div> --}}
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input dropify">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-block btn-success mb-2">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white" id="NoteModal">Update </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <iframe src="{{ asset('backend/' . $applicant->cv)}}" frameborder="0"></iframe> --}}

            </div>
        </div>
    </div>




    <!--- view modal--->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white" id="viewCategory">View applicant Details </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"><strong>Title:</strong></label>
                                <p id="view_title"></p>
                                <!-- <input type="text" class="form-control" name="name"  value=""> -->

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Description:</strong> </label>

                                <!-- <input type="text" class="form-control" name="sub_title"  value=""> -->
                                <!-- <textarea class="form-control" name="description" ></textarea> -->
                                <p id="view_description"></p>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Image:</strong> </label>

                                <!-- <input type="text" class="form-control" name="sub_title"  value=""> -->
                                <!-- <textarea class="form-control" name="description" ></textarea> -->
                                <img src="" alt="not image" id="view_image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" aria-label="Close"
                            class="btn btn-block btn-success mb-2 close">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Applicant --}}
    <div class="modal fade" id="viewApplicant" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <div class="headCenter">
                        <h5 class="modal-title has-icon text-white text-center" id="viewCategory"></h5>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            {{-- <label for="name"><strong>Title:</strong></label> --}}
                            <p id="package_no" class="text-center">Package No : <span class="job_package_no"></span>
                            </p>
                            <br>
                            <p class="text-center" id="viewImage"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"><strong>Name:&nbsp;&nbsp;</strong></label>
                                    <p id="viewName" class="shadowCss"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Email:&nbsp;&nbsp;</strong> </label>
                                    <p id="viewEmail" class="shadowCss"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Contact:&nbsp;&nbsp;</strong> </label>
                                    <p id="viewContact" class="shadowCss"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Religion:&nbsp;&nbsp;</strong> </label>
                                    <p id="viewRel" class="shadowCss"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Date Of Birth:&nbsp;&nbsp;</strong> </label>
                                    <p id="viewDob" class="shadowCss"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Nid:&nbsp;&nbsp;</strong> </label>
                                    <p id="viewNid" class="shadowCss"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Father Name:&nbsp;&nbsp;</strong> </label><br>
                                    <p id="viewFatherName" class="shadowCss"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Mother Name:&nbsp;&nbsp;</strong> </label>
                                    <p id="viewMotherName" class="shadowCss"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                                <div class="ms-form-group">
                                    <label for="name"> <strong>Address:&nbsp;&nbsp;</strong> </label><br>
                                    <p id="viewAddress" class="shadowCss"></p>
                                </div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            <label for="name"> <strong>&nbsp;&nbsp;&nbsp;&nbsp;Education:&nbsp;&nbsp;</strong> </label>
                            {{-- <div id="viewEducation"> --}}
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Degree</th>
                                            <th>Grp/Subject</th>
                                            <th>Institution</th>
                                            <th>Result</th>
                                            <th>P.Year</th>
                                        </tr>
                                    </thead>
                                    <tbody id="educationAccess">

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="ms-form-group">
                        <label for="name"> <strong>&nbsp;&nbsp;&nbsp;&nbsp;Working Experience:&nbsp;&nbsp;</strong> </label>
                        {{-- <div id="viewEducation"> --}}
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Company Name</th>
                                        <th>Joining Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody id="workAccess">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <button class="excel">Download</button> --}}
        </div>
    </div>
    </div>
    <div class="modal fade" id="admit_card_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title has-icon text-white">Admit Card </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table align="center" border="0" cellpadding='0' cellspacing="0" class="admit_card_table"
                        style="max-width: 650px; width: 100%;  border-spacing: 0; background-color: #ffffff;">
                        <tbody>
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%; border-spacing: 0; padding: 72px 62px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 100%; border-spacing: 0;">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tr>
                                                            <td
                                                                style="width: 50%; border: 1px solid #000000; padding: 12px 16px;">
                                                                <h1
                                                                    style="font-size: 28px; line-height: 33px; font-weight: 700; margin: 0; text-align: center;">
                                                                    JSS Service Ltd.</h1>
                                                            </td>
                                                            <td
                                                                style="width: 50%; padding: 4px 16px; border-width: 1px 1px 1px 0; border-style: solid; border-color: #000000;">
                                                                <table style="width: 100%; border-spacing: 0;">
                                                                    <tr>
                                                                        <td style="width: 100%; border-spacing: 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">
                                                                                On behalf of</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 100%; border-spacing: 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">
                                                                                Bangladesh Election Commission</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 100%; border-spacing: 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">
                                                                                Secretariat IDEA Project (2nd Phase)</p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <!-- serial number -->
                                            <tr>
                                                <td style="width: 100%; border-spacing: 0; padding: 4px 0 24px;">
                                                    <h5
                                                        style="font-size: 14px; line-height: 16px; font-weight: 700; margin: 0; text-align: center; text-decoration: underline;">
                                                        NCS- <span class="admit_package_no"></span></h5>
                                                </td>
                                            </tr>

                                            <!-- admit card table -->
                                            <tr>
                                                <td style="width: 100%; border: 1px solid #000000;">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-bottom: 1px solid #000000; padding: 8px;">
                                                                <h6
                                                                    style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0; text-align: center; text-transform: uppercase;">
                                                                    admit card</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0;">
                                                                <table style="width: 100%; border-spacing: 0;">
                                                                    <tr>
                                                                        <td style="width: 75%; border-spacing: 0;">
                                                                            <table style="width: 100%; border-spacing: 0;">
                                                                                <tr>
                                                                                    <td
                                                                                        style="width: 100%; border-spacing: 0;">
                                                                                        <table
                                                                                            style="width: 100%; border-spacing: 0;">
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        Name of candidate:
                                                                                                    </p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class='candidate_name'
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                        Md. Soyful Islam</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        Roll No:</p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class="admit_roll_number"
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        NID No:</p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class="nid_no"
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        DOB:</p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class="date_of_birth"
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        Mobie No:</p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class="mobile_no"
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        Post Name:</p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class="admit_job_title"
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        Data Entry Operator
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        Exam Date & Time:
                                                                                                    </p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;"> ১৬ অক্টোবর, ২০২১ সকাল ১০.০০ ঘটিকা
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                                        পরীক্ষার কেন্দ্র:
                                                                                                    </p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                                    <p class="exam_venue"
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                        </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="width: 30%; border-right: 1px solid #000000; padding: 24px 8px;">
                                                                                                    <p
                                                                                                        style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                                        প্রার্থীর স্বাক্ষর
                                                                                                    </p>
                                                                                                </td>
                                                                                                <td
                                                                                                    style="width: 70%; border-right: 1px solid #000000; padding: 24px 8px; text-align: center;">
                                                                                                    <img style="width: 300px; max-width: 300px; height: 80px; margin: 0 auto;"
                                                                                                        class="applicant_signature">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                {{-- <tr>
                                                                                <td
                                                                                    style="width: 100%; border-right: 1px solid #000000; padding: 24px 8px;">
                                                                                    <p style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                        Lorem, ipsum.</p>
                                                                                </td>
                                                                            </tr> --}}
                                                                            </table>
                                                                        </td>
                                                                        <td
                                                                            style="width: 25%; vertical-align: top; text-align: center; padding:0 8px;">
                                                                            <img class="applicant_img"
                                                                                style="width: 100%; max-width: 300px; border-radius:0; margin-right:0;"
                                                                                alt="">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <!-- empty space -->
                                            <tr>
                                                <td style="width: 100%; border-spacing: 0; padding: 0; height: 32px;"></td>
                                            </tr>

                                            <!-- instructions table -->
                                            <tr>
                                                         <td style="width: 100%; border-spacing: 0; padding: 0;">
                                                    <table style="width: 100%; border-spacing: 0; border: 1px solid #000000">
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; border-bottom: 1px solid #000000; padding: 2px 8px; text-align: center;">
                                                                <h5 style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">প্রার্থীর জন্য নির্দেশাবলী</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।  পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে হবে। প্রবেশপত্র ব্যাতিত পরীক্ষার্তীকে পরীক্ষার হলে প্রবেশ করতে দেওয়া হবেনা। </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।  পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে হবেনা।</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।  পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে হবে। প্রবেশপত্র ব্যাতিত পরীক্ষার্তীকে পরীক্ষার  </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।  পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে হবে। </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।  পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে হবে। প্রবেশপত্র ব্যাতিত </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 100%; border-spacing: 0; padding: 0; padding: 2px 8px;">
                                                                <p style=" font-size: 12px; line-height: 14px; margin: 0;">১।  পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে হবে। </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <!-- empty space -->
                                            <tr>
                                                <td style="width: 100%; border-spacing: 0; padding: 0; height: 32px;"></td>
                                            </tr>


                                            <!-- signature wrapper -->
                                            <tr>
                                                <td style="width: 100%; border-spacing: 0; padding: 0;">
                                                    <table style="width: 100%; border-spacing: 0;">
                                                        <tr>
                                                            <td style="width: 75%; border-spacing: 0; padding: 0;"></td>
                                                            <td style="width: 25%; border-spacing: 0; padding: 0;">
                                                                <table style="width: 100%; border-spacing: 0;">
                                                                    <tr>
                                                                        <td
                                                                            style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                                            <img src="{{ asset('images/signature.png') }}"
                                                                                alt="signature">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                ফেরদৌসুর রহমান</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                পরিচালক ও সিইও</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                জে এস এস সার্ভিসেস লিমিটেড</p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="applicant_id" id="applicant_id">
                    <input type="hidden" id="admit_nid">
                    {{-- <p>NCS: <span class="admit_package_no"></span></p>
                    <p>Roll Number: <span class="admit_roll_number"></span></p>
                    <p>Applicant Name: <span class="admit_applicant_name"></span></p>
                    <p>Post Name: <span class="admit_job_title"></span></p> --}}
                    <div class="form-group m-b-0">
                        <div>
                            <button type="btn" class="btn btn-square btn-info download_admit_btn">
                                Download Admit Card
                            </button>
                            <button type="reset" class="btn btn-square btn-secondary waves-effect m-l-5"
                                data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script type='text/javascript'>
        var config = {
            routes: {
                delete: "{!! route('job.applicant.delete') !!}",
                // // updateSelectedStatus: "{!! route('job.applicant.selected.status') !!}",
                // uploadAdmitCard: "{!! route('upload.admit.card') !!}",
                viewAdmitCard: "{!! route('view.admit.card') !!}",

            }
        };


        // data table
        $(document).ready(function() {
            // $('.dropify').dropify();
            // $('.mother_name').hide();
            // $('.father_name').hide();
            // $('.religion').hide();
            // $('.dob').hide();
            // $('.education').hide();
            // $('.work').hide();
            // $('.nid').hide();
            // $('.package_no').hide();



            $('#applicantTable').DataTable({
                ordering: false,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control" style="width:130px;" id="package_no"><option value="">All Packages</option></select>'
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
                },
                "columnDefs": [
            {
                // "targets": [ 0 ],
                // "visible": false,
            },
            {
                "targets": [ 6 ],
                "visible": false
            },
            {
                "targets": [ 7 ],
                "visible": false
            },
            {
                "targets": [ 9 ],
                "visible": false
            },
            {
                "targets": [ 10 ],
                "visible": false
            },
            {
                "targets": [ 11 ],
                "visible": false
            },
            {
                "targets": [ 12 ],
                "visible": false
            },
        ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    // filename: value, 
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    }

                }, ],
            });
            // var value ='';
            // $('#package_no').on('change',function(){
            //         value =  $('#package_no').val();
            //       });
            $('#applicantTable tfoot tr').prependTo('#applicantTable thead');
            $('.ajax_loader').hide();

        });


        // delete
        function deleteItem(id, job_id) {
            // alert(job_id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: config.routes.delete,
                        data: {
                            id: id,
                            job_id: job_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'JSON',
                        success: function(response) {

                            if (response.success === true) {
                                Swal.fire(
                                    'Deleted!',
                                    "" + response.data.message + "",
                                    'success'
                                )
                                // swal("Done!", response.data.message, "success");
                                $('#applicantTable').DataTable().row('.item' + response.data.id)
                                    .remove()
                                    .draw();
                                if (response.data.button == true) {
                                    $('#addButton').prop('disabled', false);

                                }
                            } else {
                                Swal.fire("Error!", "Can't delete item", "error");
                            }
                        }
                    });

                }
            })


        }

        //end
        //Applicant View===============================================================
        $(document).on('click', '.viewData', function() {
            let id = $(this).attr('data-id');
            console.log('id--', id);
            $.ajax({
                url: "{{ url('applicant-detailsinfo') }}/" + id,
                method: "get",
                data: {},
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let url = window.location.origin;
                    // console.log('data', data);
                    $('.modal-title').html(response.title);
                    $('.job_package_no').html(response.package_no ?? 'N/A');
                    $('#viewName').html(response.name);
                    $('#viewAddress').html(response.address);
                    $('#viewEmail').html(response.email);
                    $('#viewContact').html(response.contact);
                    $('#viewDob').html(response.dob);
                    $('#viewNid').html(response.nid);
                    $('#viewFatherName').html(response.father_name);
                    $('#viewMotherName').html(response.mother_name);
                    $('#viewRel').html(response.religion);
                    $('#viewExp').html(response.working_experience);

                    $('#educationAccess').empty();
                    $.each(response.get_education, function(key, value) {
                        //  console.log('value',value);
                        $('#educationAccess').append("<tr><td>" + value.degree + "</td><td>" +
                            value.subject + "</td><td>" + value.institution + "</td><td>" +
                            value.result + "</td><td>" + value.passing_year + "</td></tr>")
                    });

                    $('#workAccess').empty();
                    $.each(response.get_work, function(key, value) {
                        console.log('work', value);
                        $('#workAccess').append("<tr><td>" + value.designation + "</td><td>" +
                            value.company_name + "</td><td>" + new Date(value.joining_date)
                            .toDateString() + "</td><td>" + new Date(value.end_date)
                            .toDateString() + "</td></tr>")
                    });
                    // for (const [key, value] of Object.entries(get_education)) {
                    // console.log(`key: ${key}, value: ${value}`)
                    // }

                    $('#viewImage').html(
                        `<img width="300" height="300" class="img-fluid"   src="${url}/${response.photo}"/>`
                    );

                    $('#viewApplicant').modal('show');
                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr.error('Not found!');
                    }
                }
            });
        });


        // selected status change
        // $(document.body).on('click', '.is_selected', function() {
        //             var id = $(this).attr('data-id');
        //             Swal.fire({
        //                 title: 'Are you sure?',
        //                 text: "You won't be able to revert this!",
        //                 icon: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 confirmButtonText: 'Yes, Change this status!'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     $.ajax({
        //                         url: config.routes.updateSelectedStatus,
        //                         method: "POST",
        //                         data: {
        //                             id: id,
        //                             _token: "{{ csrf_token() }}"
        //                         },
        //                         dataType: "json",
        //                         success: function(response) {
        //                             if (response.success == true) {
        //                                 toastr["success"](response.data.message)
        //                             } else {
        //                                 toastr["error"](response.data.message);
        //                             }
        //                         }, //success end

        //                     }); //ajax end
        //                 } else {
        //                     if ($('.status' + id + "").prop("checked") == true) {
        //                         $('.status' + id + "").prop('checked', false);
        //                     } else {
        //                         $('.status' + id + "").prop('checked', true);
        //                     }
        //                 }
        //             })
        //         });

        function uploadAdmitCard(id) {
            $('#applicant_id').val(id);
            $('#admit_card_modal').modal('show');

        }
        $(document).ready(function() {
            $(".admitCardForm").validate({
                rules: {
                    admit_card: {
                        required: true,
                    },
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 text-danger');
                    label.insertAfter(element);
                },
            });
        });

        $(document).off('submit','.admitCardForm')
        $(document).on('submit','.admitCardForm',function(e){
            e.preventDefault();
            $.ajax({
                url: config.routes.uploadAdmitCard,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#admit_card_modal').modal('hide');
                        $('.dropify-preview').hide();
                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.error);
                    }
                }, //success end
            });

        });

        function viewAdmitCard(id) {
            $('#applicant_id').val(id);
            $.ajax({
                url: config.routes.viewAdmitCard,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        var imagesUrl = window.location.origin
                        $('.admit_package_no').html(response.data.package_no);
                          $('.candidate_name').html(response.data.applicant.name);
                        $('.admit_roll_number').html(response.data.roll_number);
                        $('.admit_job_title').html(response.data.job_title);
                        $('.admit_applicant_name').html(response.data.applicant.name);
                        $('#admit_nid').val(response.data.applicant.nid);
                        $('.nid_no').html(response.data.applicant.nid);
                        $('.date_of_birth').html(response.data.applicant.dob);
                        $('.mobile_no').html(response.data.applicant.contact);
                        $('.exam_venue').html(response.data.exam_venue);
                        $('.applicant_img').attr('src', imagesUrl + '/' + response.data.applicant.photo);
                        if (response.data.applicant.signature != '') {
                            $('.applicant_signature').attr('src', imagesUrl + '/' + response.data.applicant
                                .signature);
                            $('.applicant_signature').show();
                        } else {
                            $('.applicant_signature').hide();
                        }

                        $('#admit_card_modal').modal('show');
                    } else {
                        toastr.error(response.data.message);
                    }
                }, //success end
            });


        }
        $(document).on('click', '.download_admit_btn', function() {
                var id = $('#applicant_id').val();
            var download_url = '{{ route('download_admit', ':id') }}';
            download_url = download_url.replace(':id', id);
            window.location = download_url;
        });

        $(document).on('click', '.save_candidate', function(e) {
            e.preventDefault();
            var unselected_id = [];
            $.each($("input[type='checkbox']:not(:checked)"), function() {
                unselected_id.push($(this).val());
            });

            var selected_id = [];
            $.each($("input[type='checkbox']:checked"), function() {
                selected_id.push($(this).val());
            });
            // log(selected_id)
            $.ajax({
                url: config.routes.delete,
                method: "POST",
                data: {
                    selected_id: selected_id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#applicantTable').DataTable().clear().destroy();
                        var job_id = $('#filter-package').val();
                        if (job_id == '') {
                            var url = "{{ url('admin/applications') }}";
                            customDataTable(url)
                        } else {
                            var url = '{{ route('job.applicant', ':id') }}';
                            url = url.replace(':id', job_id);
                            customDataTable(url);
                        }


                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.error);
                    }
                }, //success end
            });
        });
    </script>
@endsection
