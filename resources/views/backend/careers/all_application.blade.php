
@extends('backend.home')
@section('title', 'All Applicant')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        tfoot {
            display: table-header-group;
        }

        .header-drop-down {
            width: 130px;
        }

        .admit_card_table td {
            margin: 0;
            padding: 0;
        }

        .ajax_loader {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 20009;
            /* background-color: #fff; */
            backdrop-filter: blur(1px);
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

    </style>

@endsection
@section('content')
    <div class="loader">

    </div>
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
                        <div class="form-group">
                            <select id='filter-package' class="form-control" style="width: 200px" data-column="5">
                                <option value="">Filter By Package</option>
                                @if (!empty($all_packages))
                                    @foreach ($all_packages as $key => $all_package)
                                        <option value="{{ $key }}">{{ $all_package }}</option>
                                    @endforeach

                                @endif

                            </select>
                        </div>


                        <div class="float-right">
                            <button type="button" class="btn btn-sm btn-pill btn-success save_candidate">Save
                                Candidate</button>
                        </div>
                        <span class="showError"></span>
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-striped" id="applicantTable">
                                <tfoot>
                                    <tr>
                                        <th>
                                        </th>
                                    </tr>
                                </tfoot>
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
                                    {{-- @if (!empty($all_applications))
                                        @foreach ($all_applications as $applicant)
                                            <tr class="item{{ $applicant->id }}">
                                                <td class="package_no">{{ $applicant->package_no }}</td>
                                                <td class="">{{ $applicant->title }}</td>
                                                <td class="">{{ $applicant->location }}</td>
                                                        <td class=" 
                                                    ">
                                                    {{ $applicant->name }}</td>
                                                <td class="">
                                                    {{ $applicant->contact }}</td>
                                                <td class="">{{ $applicant->email }}</td>

                                                    <td class="
                                                    
                                                    religion">
                                                    {{ $applicant->religion }}</td>
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
                                                <td>
                                                    <button type="button" class="ms-btn-icon btn-info viewData"
                                                        data-id="{{ $applicant->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>

                                                <td class="actionBtn">
                                                    <button type='button' class='ms-btn-icon btn-danger'
                                                        onclick='deleteItem({{ $applicant->id }},{{ $applicant->job_id }})'>
                                                        <i class='flaticon-trash'></i></button>
                                                </td>
                                                <td class="actionBtn">
                                                    <button type='button' class='ms-btn-icon btn-info'
                                                        onclick='uploadAdmitCard({{ $applicant->id }})'>
                                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
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

    <!-- admit card  Modal -->
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
                                                                    হবে।</p>
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
                        <h5 class="modal-title job-title has-icon text-white text-center" id="viewCategory"></h5>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-form-group">
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

@endsection

@section('js')
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script type='text/javascript'>
        var config = {
            routes: {
                delete: "{!! route('job.applicant.delete') !!}",
                // updateSelectedStatus: "{!! route('job.applicant.selected.status') !!}",
                uploadAdmitCard: "{!! route('upload.admit.card') !!}",
                viewAdmitCard: "{!! route('view.admit.card') !!}",
                saveCandidate: "{!! route('save.selected.candidate') !!}",
                selectCandidate: "{!! route('select.candidate') !!}",
                getApplicants: "{!! route('package_no.applicants') !!}"
            }
        };




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
            var url = "{{ url('admin/applications') }}";
            customDataTable(url);
            // dataTable(url);

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

        $(document).off('submit', '.admitCardForm')
        $(document).on('submit', '.admitCardForm', function(e) {
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

        // filter candidate by package no
        $(document).on('change', '#filter-package', function() {
            var id = $(this).val();
            if (id == '') {
                $('#applicantTable').DataTable().clear().destroy();
                var url = "{{ url('admin/applications') }}";
                customDataTable(url);
            } else {
                $('#applicantTable').DataTable().clear().destroy();
                var ajaxUrl = {
                    method: "POST",
                    url: config.routes.getApplicants,
                    // contentType: "application/json",
                    data: {
                        id: id,
                        // _token: "{{ csrf_token() }}"
                    },
                    
                    beforeSend: function() {
                        $('.loader').empty();
                        $('.loader').addClass('ajax_loader').append(
                            `<div class="spinner spinner-8">
                                <div class="ms-circle1 ms-child"></div>
                                <div class="ms-circle2 ms-child"></div>
                                <div class="ms-circle3 ms-child"></div>
                                <div class="ms-circle4 ms-child"></div>
                                <div class="ms-circle5 ms-child"></div>
                                <div class="ms-circle6 ms-child"></div>
                                <div class="ms-circle7 ms-child"></div>
                                <div class="ms-circle8 ms-child"></div>
                                <div class="ms-circle9 ms-child"></div>
                                <div class="ms-circle10 ms-child"></div>
                                <div class="ms-circle11 ms-child"></div>
                                <div class="ms-circle12 ms-child"></div>
                            </div>`
                        );
                    },
                    complete: function() {
                        $('.loader').removeClass('ajax_loader').empty();
                    }
                };
                customDataTable(ajaxUrl);
            }

        });

        $(document).on('click', '.download_admit_btn', function() {
            var id = $('#admit_nid').val();
            var download_url = '{{ route('download', ':id') }}';
            download_url = download_url.replace(':id', id);
            window.location = download_url;
        });



        function columnHide(table) {
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


        function customDataTable(ajaxUrl) {
            var main_url = window.location.origin;
            var table = $('#applicantTable').DataTable({
                ordering: false,
                lengthMenu: [10, 25, 50, 75, 100],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                    },

                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
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
                ajax: ajaxUrl,

                columns: [{
                        data: 'package_no',

                    },
                    {
                        data: 'selected_cadidate',

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
                ],

            });
            columnHide(table);
        }
    </script>
@endsection
