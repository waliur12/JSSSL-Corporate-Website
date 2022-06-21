<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap"
        rel="stylesheet">
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto%20Sans&subset=devanagari&fbclid=IwAR3djPA0QjV_KAQYD-QAq3IMz8IMpymDoJgug8qLEn_JTG2Zmae6Ink9dyo"> --}}
    <title>JSSSL</title>
    <style>
        body,
        td,
        input,
        textarea,
        select {
            margin: 0;
            padding: 0;
        }


        /* body { font-family: DejaVu Sans; } */
    </style>
</head>

<body style="margin: 0;">
    <table align="center" border="0" cellpadding='0' cellspacing="0"
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
                                            <td style="width: 50%; border: 1px solid #000000; padding: 12px 16px;">
                                                <h1
                                                    style="font-size: 28px; line-height: 33px; font-weight: 700; margin: 0; text-align: center;">
                                                    JSS Service Ltd.</h1>
                                            </td>
                                            <td
                                                style="width: 50%; padding: 4px 16px; border-width: 1px 1px 1px 0; border-style: solid; border-color: #000000;">
                                                <table style="width: 100%; border-spacing: 0;">
                                                    <tr>
                                                        <td style="width: 100%; border-spacing: 0;  text-align: center;">
                                                            <p
                                                                style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">
                                                                On behalf of</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 100%; border-spacing: 0;  text-align: center;">
                                                            <p
                                                                style="font-size: 12px; line-height: 14px; margin: 0; text-align: center;">
                                                                Bangladesh Election Commission</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 100%; border-spacing: 0;  text-align: center;">
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
                                <td style="width: 100%; border-spacing: 0; padding: 4px 0 24px; text-align: center; margin-top:3px;">
                                    <h5
                                        style="font-size: 14px; line-height: 16px; font-weight: 700; margin-top:3px; margin: 0; text-align: center; text-decoration: underline;">
                                        NCS-{{$package_no}}</h5>
                                </td>
                            </tr>

                            <!-- admit card table -->
                            <tr>
                                <td style="width: 100%; border: 1px solid #000000;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tr>
                                            <td style="width: 100%; border-bottom: 1px solid #000000; padding: 8px; text-align: center;">
                                                <h6
                                                    style="font-size: 11px; line-height: 13px; font-weight: 800; margin: 0; text-align: center; text-transform: uppercase;">
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
                                                                    <td style="width: 100%; border-spacing: 0;">
                                                                        <table style="width: 100%; border-spacing: 0;">
                                                                            <tr>
                                                                                <td
                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                        Name of candidate:</p>
                                                                                </td>
                                                                                <td
                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                        {{$applicant->name}}</p>
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
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;">
                                                                                        {{$roll_number}}</p>
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
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;"> {{$applicant->nid}}
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
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;"> {{$applicant->dob}}
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
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; margin: 0;"> {{$applicant->contact}}
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
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                        {{$job_title}}</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                    <p
                                                                                        style="font-size: 11px; line-height: 13px; font-weight: 700; margin: 0;">
                                                                                        Exam Date & Time:</p>
                                                                                </td>
                                                                                <td
                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                    <p
                                                                                        style="font-size: 12px; line-height: 14px; margin: 0;"> ১৬ অক্টোবর, ২০২১ সকাল ১০.০০ ঘটিকা
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="width: 30%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                    <p
                                                                                        style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                        পরীক্ষার কেন্দ্র:</p>
                                                                                </td>
                                                                                <td
                                                                                    style="width: 70%; border-style: solid; border-color: #000000; border-width: 0 1px 1px 0; padding: 8px">
                                                                                    <p
                                                                                        style="font-size: 12px; line-height: 14px; margin: 0;">
                                                                                        {{$exam_venue}}</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="width: 30%; border-right: 1px solid #000000; padding: 24px 8px;">
                                                                                    <p style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
                                                                                        প্রার্থীর স্বাক্ষর</p>
                                                                                </td>
                                                                                <td style="width: 70%; border-right: 1px solid #000000; padding: 24px 8px; text-align: center;">
                                                                                    @if ($applicant->signature != null)
                                                                                     <img style="width: 300px; max-width: 300px; height: 80px; margin: 0 auto;" src="{{url($applicant->signature)}}" class="applicant_signature">
                                                                                     {{-- <img style="width: 300px; max-width: 300px; height: 80px; margin: 0 auto;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($applicant->signature))) }}" class="applicant_signature"> --}}
                                                                                    @endif
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
                                                           
                                                            <table style="width: 100%; border-spacing: 0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 100%; border-spacing: 0;">
                                                                            <img src="{{url($applicant->photo)}}" alt="" style="width: 125px;border-radius:0; margin-right:0; margin-top:1px;">
                                                                            {{-- <img style="width: 125px; border-radius:0; margin-right:0; margin-top:1px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($applicant->photo))) }}" alt="" style="width: 100%; max-width: 300px; border-radius:0; margin-right:0;"> --}}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 100%; border-spacing: 0; height: 42px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 100%; border-spacing: 0;">
                                                                            <p style="font-size: 12px; line-height: 14px; margin: 0;">No Mask No Entry</p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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
                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">২। পরীক্ষার হলে মোবাইল ফোন বা যেকোনো ধরনের ইলেক্ট্রিক সামগ্রী বহন সম্পূর্ন নিষিদ্ধ।</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">৩। পরীক্ষা শুরুর ৩০ মিনিট পুর্বেই পরীক্ষার্থীকে পরীক্ষার হলে প্রবেশ করতে হবে।</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">৪। পরীক্ষার হলে পরীক্ষার্থী কোনও প্রকার অসদুপায় অবলম্বন করলে কর্তৃপক্ষ যেকোনো পদক্ষেপ নিতে বাধ্য থাকবে। এ ব্যাপারে কোনও প্রকার আনুগ্রহ কিংবা সুপারিশ গ্রহণযোগ্য হবে না। </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%; border-spacing: 0; padding: 0; border-bottom: 1px solid #000000; padding: 2px 8px;">
                                                <p style="font-size: 12px; line-height: 14px; margin: 0;">৫। মৌখিক পরীক্ষার জন্য পরীক্ষার্থীকে এই প্রবেশপত্র সংরক্ষণ করতে হবে।</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%; border-spacing: 0; padding: 0; padding: 2px 8px;">
                                                <p style=" font-size: 12px; line-height: 14px; margin: 0;">৬। পরীক্ষায় উপস্থিত হওয়ার জন্য প্রার্থীকে কোনও প্রকার টিএ/ডিএ প্রদান করা হবে না।  </p>
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
                                                        <td style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                            <img src="{{url('images/signature.png')}}" style="max-width:80px;" alt="signature">
                                                            {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/signature.png'))) }}" alt="signature"> --}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                            <p style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">ফেরদৌস উর রহমান</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                            <p style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">পরিচালক ও সিইও</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 100%; border-spacing: 0; text-align: center; padding: 8px 0;">
                                                            <p style="font-size: 12px; line-height: 14px; font-weight: 700; margin: 0;">
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
</body>