@extends('backend.home')
@section('title', 'Applicants')
@section('content')
    <style>
        /* .ms-panel-header p{
                        margin-left: -35px;
                    } */

        .job_detail {
            font-size: 15px;
            cursor: pointer;
        }

        .modal_cross_icon {
            padding: 2px 15px !important;
            margin: -38px -15px !important;
        }

        p ul {
            list-style: inside !important;
        }

        .job_title {
            font-size: 20px;
            font-weight: 700;
        }

        p {
            margin-top: 0;
            margin-bottom: 6px;
        }

        span.job_detail.badge.badge-outline-dark {
            margin-top: 6px;
        }

        .shadowCss {
            background: aliceblue;
            padding: 0px 5px;
            border-radius: 5px;
        }

    </style>


    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}"><i class="material-icons">home</i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/jobs') }}">Jobs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">applicants</li>
                    </ol>
                </nav>
                <div class="message"></div>

                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Applicant List</h6>
                            </div>
                            <a href="{{ route('jobs') }}">
                                <button type="button" class="btn btn-sm btn-pill btn-dark has-icon clientBtn" title="Back">
                                    Back</button>
                            </a>

                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="ms-header-text">
                                <h6>{{ $job->title }} </h6>
                                <p class="mt-2 job_description">{!! $job->formated_description !!}....</p>
                                <span class="job_detail badge badge-outline-dark"
                                    onclick="jobDetail({{ $job->id }})">See details</span>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-pill btn-success has-icon save_candidate">Save Candidate</button>
                        </div>
                        <input type="hidden" value="{{ $job->id }}" id="job_id">
                    </div>
                    <div class="ms-panel-body">
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="applicantTable">
                                <thead>
                                    <tr>
                                        <th class="package_no">Package No</th>
                                        <th class=""style=" width: 10%;">Select Candidate</th>
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
                                        <th scope="col" style="width: 5%;">CV</th>
                                        <th scope="col" style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if (!empty($applicants))
                                        @foreach ($applicants as $applicant)
                                            <tr class="item{{ $applicant->id }}">
                                                <td class="">{{ $applicant->name }}</td>
                                                <td class="">{{ $applicant->contact }}</td>
                                                <td class="">{{ $applicant->email }}</td>
                                                <td class="">
                                                   <a href="{{ asset('backend/' . $applicant->cv) }}" target="blank">
                                                        <button type='button' class='ms-btn-icon btn-dark'>
                                                             <i class='fas fa-eye'></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="ms-btn-icon btn-info viewData"
                                                        data-id="{{$applicant->id}}">
                                                    <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                                <td class="actionBtn">

                                                    <button type='button' class='ms-btn-icon btn-danger'
                                                        onclick='deleteItem({{ $applicant->id }},{{ $job->id }})'>
                                                        <i class='flaticon-trash'></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>





    <!--- view modal--->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title has-icon text-white text-center" id="viewCategory">Job Details </h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                {{-- <label for="name"><strong>Title:</strong></label> --}}
                                <p id="view_title" class="text-center job_title"></p>
                                <p class="text-center">Posted Date : <span class="post_date"> </span></p>
                                <p class="text-center">Deadline : <span class="last_date"> </span></p>
                                <p class="text-center">Total Applicants : <span>{{ $job->applicants->count() }} </span>
                                </p>

                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"><strong>Location:</strong></label>
                                <p id="view_location"></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Description:</strong> </label>
                                <p id="view_description"></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Requirement:</strong> </label>
                                <p id="view_requirement"></p>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="ms-form-group">
                                <label for="name"> <strong>Responsibility:</strong> </label>
                                <p id="view_responsibility"></p>
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
                <div class="modal-header bg-secondary d-block">
                    <h5 class="modal-title job-title has-icon text-white text-center" id="viewCategory">Applicant Details</h5>
                    <button type="button" class="close modal_cross_icon" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
                            {{-- <label for="name"><strong>Title:</strong></label> --}}
                            {{-- <p id="view_title" class="text-center">__Applicant Information__</p><br> --}}
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
                                                                                                    <p
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
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
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
                                                                                                    <p
                                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                                        Lorem ipsum dolor
                                                                                                        sit, amet
                                                                                                        consectetur
                                                                                                        adipisicing elit.
                                                                                                        Laborum aperiam
                                                                                                        veritatis
                                                                                                        eveniet!</p>
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
                                                                                                        src=""
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
                                                    <table
                                                        style="width: 100%; border-spacing: 0; border: 1px solid #000000">
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <h5
                                                                    style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">
                                                                    প্রার্থীর জন্য নির্দেশাবলী</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।
                                                                    পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে
                                                                    হবে। প্রবেশপত্র ব্যাতিত পরীক্ষার্তীকে পরীক্ষার হলে
                                                                    প্রবেশ করতে দেওয়া হবেনা। </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।
                                                                    পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে
                                                                    হবেনা।</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।
                                                                    পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে
                                                                    হবে। প্রবেশপত্র ব্যাতিত পরীক্ষার্তীকে পরীক্ষার </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।
                                                                    পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে
                                                                    হবে। </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।
                                                                    পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে
                                                                    হবে। প্রবেশপত্র ব্যাতিত </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 100%; border-spacing: 0; padding: 0; padding: 2px 8px;">
                                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">১।
                                                                    পরীক্ষার হলে প্রবেশের সময় অবশ্যই প্রবেশ পত্র সাথে আনতে
                                                                    হবে। </p>
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
                                                                                Lorem, ipsum dolor.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td
                                                                            style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                                            <p
                                                                                style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                Lorem, ipsum.</p>
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
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            var href = window.location.href;
            if (href) {
                // alert('sdsd');
                $('.menu-item').find('.job').addClass('active');
                $('.menu-item').find('.job_collapse').addClass('show');
            }
        });
        var config = {
            routes: {
                delete: "{!! route('job.applicant.delete') !!}",
                view: "{!! route('job.view') !!}",
                uploadAdmitCard: "{!! route('upload.admit.card') !!}",
                viewAdmitCard: "{!! route('view.admit.card') !!}",
                saveCandidate: "{!! route('save.selected.candidate') !!}",
                selectCandidate: "{!! route('select.candidate') !!}",
                getApplicants: "{!! route('package_no.applicants') !!}"
            }
        };

        // data table


        // job details
        function jobDetail(id) {
            $.ajax({
                url: config.routes.view,
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    console.log(response.data);
                    if (response.success == true) {
                        $('#view_title').html(response.data.title);
                        $('#view_location').html(response.data.location);
                        $('#view_description').html(response.data.description);
                        $('#view_requirement').html(response.data.requirement);
                        $('#view_responsibility').html(response.data.responsibility);
                        $('.post_date').html(response.data.posted_date);
                        $('.last_date').html(response.data.dedline);
                        $('#viewModal').modal('show');

                    } //success end

                },
                beforeSend: function() {
                    $('.loader').empty();
                    $('.loader').addClass('ajax_loader').append(
                        `<div class="spinner spinner-7">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>`
                    );
                },
                complete: function() {
                    $('.loader').removeClass('ajax_loader').empty();
                }
            }); //ajax end
        }






        // data table
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.mother_name').hide();
            $('.father_name').hide();
            $('.religion').hide();
            $('.dob').hide();
            $('.education').hide();
            $('.work').hide();
            $('.nid').hide();
            $('.package_no').hide();
            var job_id = $('#job_id').val();
            var url = '{{ route('job.applicant', ':id') }}';
            url = url.replace(':id', job_id);
            dataTable(url);

        });


        // delete
        function deleteItem(id) {
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
                    $('.job-title').html(response.title);
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
                        $('.admit_roll_number').html(response.data.roll_number);
                        $('.admit_job_title').html(response.data.job_title);
                        $('.admit_applicant_name').html(response.data.applicant.name);
                        $('#admit_nid').val(response.data.applicant.nid);
                        $('.nid_no').html(response.data.applicant.nid);
                        $('.date_of_birth').html(response.data.applicant.dob);
                        $('.mobile_no').html(response.data.applicant.contact);
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
                        toastr.error('Something went wrong. please try again');
                    }
                }, //success end
            });

        }

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
            $.ajax({
                url: config.routes.saveCandidate,
                method: "POST",
                data: {
                    unselected_id: unselected_id,
                    selected_id: selected_id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#applicantTable').DataTable().clear().destroy();
                        var job_id = $('#job_id').val();
                        var url = '{{ route('job.applicant', ':id') }}';
                        url = url.replace(':id', job_id);
                        dataTable(url);
                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.error);
                    }
                }, //success end
            });
        });



        function dataTable(url) {
            var main_url = window.location.origin;
            var table = $('#applicantTable').DataTable({
                ordering: false,
                lengthMenu: [10, 25, 50, 75, 100],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    // filename: value, 
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                    },

                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        // $('row c[r*="2"]', sheet).attr('s', '2');
                        $('row c[r^="A"]', sheet).attr('s', '55'); //<-- left aligned text
                        $('row c[r^="B"]', sheet).attr('s', '55', ); //<-- left aligned text
                        $('row c[r^="C"]', sheet).attr('s', '55'); //<-- wrapped text

                        $('row c[r^="D"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="E"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="F"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="G"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="H"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="I"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="J"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="K"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="L"]', sheet).attr('s', '55'); //<-- wrapped text
                        $('row c[r^="M"]', sheet).attr('s', '55'); //<-- wrapped text       
                        $('row c[r^="N"]', sheet).attr('s', '55'); //<-- wrapped text       
                    }

                }, ],
                processing: true,
                serverSide: true,
                ajax: url,

                columns: [{
                        data: 'package_no',

                    },
                    {
                        data: 'selected_cadidate',
                        // render: function(data, type, full, meta) {
                        //     return `<label class="ms-checkbox-wrap ms-checkbox-dark">
                    //   <input type="checkbox" class='candidateCheckbox'  name="candidate[${data}]" value="${data}" data-id="${data}"> <i class="ms-checkbox-check"></i>
                    // </label>`;
                        // }

                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'location'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'contact'
                    },
                    {
                        data: 'email'
                    },
                    {
                        class: 'religion',
                        data: 'religion'
                    },
                    {
                        class: 'dob',
                        data: 'dob'
                    },
                    {
                        class: 'nid',
                        data: 'nid'
                    },
                    {
                        class: 'father_name',
                        data: 'father_name'
                    },
                    {
                        class: 'mother_name',
                        data: 'mother_name'
                    },

                    {
                        class: 'education',
                        data: 'education',
                    },
                    {
                        class: 'work',
                        data: 'work',
                    },
                    {
                        data: 'cv',
                        render: function(data, type, full, meta) {
                            return `<a href='${main_url}/backend/${data}' target='blank'>
                                 <button type='button' class='ms-btn-icon btn-dark'>
                                    <i class='fas fa-eye'></i>
                                </button></a>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            let column0 = table.column(0); // here is the index of the column, starts with 0
            column0.visible(false); // this should be either true or false
            let column13 = table.column(13);
            column13.visible(false);
            let column7 = table.column(7);
            column7.visible(false);
            let column8 = table.column(8);
            column8.visible(false);
            let column9 = table.column(9);
            column9.visible(false);
            let column10 = table.column(10);
            column10.visible(false);
            let column11 = table.column(11);
            column11.visible(false);
            let column12 = table.column(12);
            column12.visible(false);
        }

        // select candidate by checkbox
        $(document).on('click', '.candidateCheckbox', function() {
            if ($(this).is(":checked")) {
                var val = 1;
            } else {
                var val = 0;
            }
            var id = $(this).data('id');
            $.ajax({
                url: config.routes.selectCandidate,
                method: "POST",
                data: {
                    id: id,
                    val: val,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        if (response.data.is_selected == 1) {
                            $('.view_admit_card_btn' + response.data.id).prop('disabled', false);
                        } else {
                            $('.view_admit_card_btn' + response.data.id).prop('disabled', true);
                        }

                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.error);
                    }
                }, //success end
            });

        });


        $(document).on('click', '.download_admit_btn', function() {
            var id = $('#admit_nid').val();
            var download_url = '{{ route('download', ':id') }}';
            download_url = download_url.replace(':id', id);
            window.location = download_url;
        });
    </script>
@endsection
