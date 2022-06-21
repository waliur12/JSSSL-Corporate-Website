<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Job;
use App\JobApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PDF;

class CareerController extends Controller {
    public function career() {
        $jobs = Job::orderBy('precedence', 'ASC')->paginate(5);
        return view('front.career.career', compact('jobs'));
    }

    public function careerDetails($id) {
                        return view('404page');

        // $job_id             = Job::with('applicants', 'responsibilities', 'requirements', 'instruction')->where('id', '=', $id)->first();
        // $selected_applicant = Job::where('id', $id)
        //     ->whereHas('applicants', function ($query) {
        //         $query->where('admit_card', '!=', 'null');
        //     })->count();

        // return view('front.career.career_details', compact('job_id', 'selected_applicant'));
    }
    
     public function results() {
        $jobs = Job::orderBy('precedence', 'ASC')->paginate(5);
        // dd($jobs);
        return view('front.career.results', compact('jobs'));
    }


    public function jobResult($id){
        // $pdf_url=asset('/frontend/Notice_for_Viva.pdf');
        // $pdf_url=asset('/frontend/Notice-Final_2.pdf');
        
        if ($id==10) {
          $pdf_url=asset('/frontend/NCS-3_WEB.pdf');
        }

        elseif($id==23){
            $pdf_url=asset('/frontend/NCS-5WEB.pdf');
        }
        elseif($id==25){
            $pdf_url=asset('/frontend/NCS-6_WEB.pdf');
        }
        elseif($id==28){
            $pdf_url=asset('/frontend/NCS-8WEB.pdf');
        }
        elseif($id==29){
            $pdf_url=asset('/frontend/NCS-8_DRIVER_WEB.pdf');
        }
        
        // dd($pdf_url);
         return view('front.career.job_result',compact('pdf_url'));
    }

    public function store(Request $request) {
                return view('404page');

        // dd($request->all());
        // $validator = Validator::make($request->all(), [

        //     'fullname'       => 'required|max:80',
        //     'email'          => 'required',
        //     'uploadcv'       => 'required|max:600',
        //     'fathername'     => 'required',
        //     'mothername'     => 'required',
        //     'dob'            => 'required',
        //     'nid'            => 'required',
        //     'religion'       => 'required',
        //     'image'          => 'required|dimensions:width=300px,height=300px|max:600',
        //     'signature'      => 'required|dimensions:width=300px,height=80px|max:600',
        //     'contact'        => 'required',
        //     'address'        => 'required',
        //     // 'degree'    => 'required|array',
        //     'degree'         => 'required|array',
        //     'degree.*'       => 'required|string',

        //     'gpsubject'      => 'required|array',
        //     'gpsubject.*'    => 'required|string',

        //     'institute'      => 'required|array',
        //     'institute.*'    => 'required|string',

        //     'result'         => 'required|array',
        //     'result.*'       => 'required|string',

        //     'passingyear'    => 'required|array',
        //     'passingyear.*'  => 'required|string',

        //     'designation'    => 'required|array',
        //     'designation.*'  => 'required|string',

        //     'company_name'   => 'required|array',
        //     'company_name.*' => 'required|string',

        //     'joining_date'   => 'required|array',
        //     'joining_date.*' => 'required|string',
        // ]);
        // if (!$validator->passes()) {
        //     return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        // } else {
        //     $applicant          = new Applicant();
        //     $applicant->name    = $request->fullname;
        //     $applicant->email   = $request->email;
        //     $applicant->address = $request->address;
        //     $cv                 = $request->file('uploadcv');
        //     $new_name           = time() . '.' . $cv->getClientOriginalExtension();
        //     $cv->move('backend/', $new_name);
        //     $applicant->cv                 = $new_name;
        //     $applicant->contact            = $request->contact;
        //     $applicant->father_name        = $request->fathername;
        //     $applicant->mother_name        = $request->mothername;
        //     $applicant->dob                = $request->dob;
        //     $applicant->nid                = $request->nid;
        //     $applicant->religion           = $request->religion;
        //     $applicant->working_experience = $request->workingexp;
        //     if ($request->hasFile('image')) {
        //         $path = 'images/appliedApplicants/';
        //         if (!is_dir($path)) {
        //             mkdir($path, 0755, true);
        //         }

        //         $image     = $request->image;
        //         $imageName = rand(100, 1000) . $image->getClientOriginalName();
        //         $image->move($path, $imageName);
        //         $applicant->photo = $path . $imageName;
        //     }
        //     if ($request->hasFile('signature')) {
        //         $upload_path = 'images/appliedApplicantsSignature/';
        //         if (!is_dir($upload_path)) {
        //             mkdir($upload_path, 0755, true);
        //         }

        //         $signature     = $request->signature;
        //         $signatureName = rand(100, 10000) . $signature->getClientOriginalName();
        //         $signature->move($upload_path, $signatureName);
        //         $applicant->signature = $upload_path . $signatureName;
        //     }
        //     //
        //     // return $applicant;
        //     $applicant->save();
        //     $applicant_Id = $applicant->id;
        //     // $education = new ApplicantsEducationalQualification();

        //     $degree      = $request->degree;
        //     $subject     = $request->gpsubject;
        //     $institute   = $request->institute;
        //     $result      = $request->result;
        //     $passingyear = $request->passingyear;

        //     if (!empty($degree)) {
        //         for ($i = 0; $i < count($degree); $i++) {
        //             $dataSave = [
        //                 'applicant_id' => $applicant_Id,
        //                 'degree'       => $degree[$i],
        //                 'passing_year' => $passingyear[$i],
        //                 'result'       => $result[$i],
        //                 'institution'  => $institute[$i],
        //                 'subject'      => $subject[$i],
        //             ];
        //             DB::table('applicants_educational_qualifications')->insert($dataSave);
        //         }
        //     }
        //     //Working Start
        //     $designation  = $request->designation;
        //     $company_name = $request->company_name;
        //     $joining_date = $request->joining_date;
        //     $end_date     = $request->end_date;

        //     if (!empty($company_name)) {
        //         for ($i = 0; $i < count($company_name); $i++) {
        //             $dataSave = [
        //                 'applicant_id' => $applicant_Id,
        //                 'designation'  => $designation[$i],
        //                 'company_name' => $company_name[$i],
        //                 'joining_date' => $joining_date[$i],
        //                 'end_date'     => $end_date[$i],
        //             ];
        //             DB::table('working_experiences')->insert($dataSave);
        //         }
        //     }
        //     $job_applicant               = new JobApplicant();
        //     $job_applicant->job_id       = $request->job_id;
        //     $job_applicant->applicant_id = $applicant_Id;
        //     $job_applicant->save();

        //     //Working End

        //     return response()->json(['status' => true, 'data' => $applicant]);
        // }

    }

    public function viewApplicant($id) {
        // $data=Applicant::find($id);
        $data = Applicant::with("getEducation", "getWork", "jobApplications")->where('id', $id)->first();
        foreach ($data->jobApplications as $job) {
            $data->title      = $job->title;
            $data->package_no = $job->package_no;
        }
        return response()->json($data);
    }

    public function downloadAdmitCard(Request $request) {
        // dd($request->all());
        $job = Job::with(['applicants'=> function($query) use($request){
            $query->where('nid', $request->nid);
            $query->where('is_selected','1');
        }])->findOrFail($request->id);
        // dd($job);
        // $applicants = Applicant::with(['jobApplications'=> function($query) use($request){
        //     $query->where('jobs.id', $request->id);
        // }])->where('nid', $request->nid)->first();
        // dd($applicants);
        if (count($job->applicants)>0) {
            if(Session::has('job_id')){
                Session::forget('job_id');
            }
            Session::put('job_id',$job->id);
            $data = [];
                $data['nid']     = $request->nid;
                $data['message'] = 'Success';
                return response()->json([
                    'success' => true,
                    'data'    => $data,
                ]);
            
          
            // if ($applicant->is_selected == 1) {
            //     $data['nid']     = $request->nid;
            //     $data['message'] = 'Success';
            //     return response()->json([
            //         'success' => true,
            //         'data'    => $data,
            //     ]);
            // } else {
            //     $data['message'] = 'Sorry! You are not selected';
            //     return response()->json([
            //         'success' => false,
            //         'data'    => $data,
            //     ]);
            // }
        } else {
            $data['message'] = 'Sorry! No data found.';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }

    }
    public function download($id) {
        // $job_id = Session::get('job_id');
        // $applicant = Applicant::with('jobApplications')->where('nid', $id)->first();
        // $job = Job::findOrFail($job_id);
        // $package_no = $job->package_no;
        // $job_title  = $job->title;
        // if($job->id ==10){
        //     $exam_venue = 'আগারগাঁও আদর্শ উচ্চ বিদ্যালয়, আগারগাঁও(তালতলা), শেরে বাংলা নগর, ঢাকা-১২০৭।';
        // }else if($job->id ==23){
        //     $exam_venue = 'প্রিমিয়ার আইডিয়াল হাইস্কুল,২০৩ কে.বি ইসমাইল রোড, ময়মনসিংহ।।';
        
        // }else if($job->id ==25){
        //     $exam_venue = 'হালিশহর বেগমজান বহুমুখী উচ্চ বিদ্যালয়, হালিশহর, চট্টগ্রাম।';
        // }else {
        //     $exam_venue = 'শেরেবাংলা নগর সরকারী বালক উচ্চ বিদ্যালয়, শেরে বাংলা নগর, ঢাকা-১২০৭।';
        // }
 
        // $package_no = substr($job->package_no, strpos($job->package_no, "-") + 1);
        // $number     = $this->convertToStandardNumber($package_no);

        // // $data = [
        // //     'applicant'   => $applicant,
        // //     'roll_number' => $number . $applicant->roll_number,
        // //     'package_no'  => $number,
        // //     'job_title'   => $job_title,
        // // ];
        // // return view('front.career.admit_card',$data);
        // // $pdf = PDF::loadView('front.career.admit_card', $data)->setOptions(['defaultFont' => 'HindSiliguri']);
        // // return $pdf->download($id . '.pdf');

        // $pdf        = PDF::loadView('front.career.admit_card', [
        //     'applicant'   => $applicant,
        //     'roll_number' => $number . $applicant->roll_number,
        //     'package_no'  => $number,
        //     'job_title'   => $job_title,
        //     'exam_venue'   => $exam_venue,
        // ], [], [
        //     'default_font' => 'nikosh',
        // ]);
        // return $pdf->download($id .'.pdf');
            $job_id = Session::get('job_id');
        $applicants = Applicant::with('jobApplications')->where('nid', $id)->get();
        foreach($applicants as $data){
            $job_applicant = JobApplicant::where('job_id',$job_id)->where('applicant_id',$data->id)->first();
        }
        if($job_applicant){
            $applicant = Applicant::where('id',$job_applicant->applicant_id)->first();
            $job = Job::findOrFail($job_id);
            $package_no = $job->package_no;
            $job_title  = $job->title;
            if($job->id ==10){
                $exam_venue = 'আগারগাঁও আদর্শ উচ্চ বিদ্যালয়, আগারগাঁও(তালতলা), শেরে বাংলা নগর, ঢাকা-১২০৭।';
            }else if($job->id ==23){
                $exam_venue = 'প্রিমিয়ার আইডিয়াল হাইস্কুল,২০৩ কে.বি ইসমাইল রোড, ময়মনসিংহ।।';
            
            }else if($job->id ==25){
                $exam_venue = 'হালিশহর বেগমজান বহুমুখী উচ্চ বিদ্যালয়, হালিশহর, চট্টগ্রাম।';
            }else {
                $exam_venue = 'শেরেবাংলা নগর সরকারী বালক উচ্চ বিদ্যালয়, শেরে বাংলা নগর, ঢাকা-১২০৭।';
            }
     
            $package_no = substr($job->package_no, strpos($job->package_no, "-") + 1);
            $number     = $this->convertToStandardNumber($package_no);
    
    
            $pdf        = PDF::loadView('front.career.admit_card', [
                'applicant'   => $applicant,
                'roll_number' => $number . $applicant->roll_number,
                'package_no'  => $number,
                'job_title'   => $job_title,
                'exam_venue'   => $exam_venue,
            ], [], [
                'default_font' => 'nikosh',
            ]);
            return $pdf->download($id .'.pdf');
        }else{
            $data['message'] = 'Sorry! No data found.';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }
    
        public function downloadCard($id) {
        $applicant = Applicant::with('jobApplications')->where('nid', $id)->where('is_selected','1')->first();
        foreach ($applicant->jobApplications as $job) {
            $package_no = $job->package_no;
            $job_title  = $job->title;
            if($job->id ==10){
            $exam_venue = 'আগারগাঁও আদর্শ উচ্চ বিদ্যালয়, আগারগাঁও(তালতলা), শেরে বাংলা নগর, ঢাকা-১২০৭।';
        }else if($job->id ==23){
            $exam_venue = 'প্রিমিয়ার আইডিয়াল হাইস্কুল,২০৩ কে.বি ইসমাইল রোড, ময়মনসিংহ।।';
        
        }else if($job->id ==25){
            $exam_venue = 'হালিশহর বেগমজান বহুমুখী উচ্চ বিদ্যালয়, হালিশহর, চট্টগ্রাম।';
        }else {
            $exam_venue = 'শেরেবাংলা নগর সরকারী বালক উচ্চ বিদ্যালয়, শেরে বাংলা নগর, ঢাকা-১২০৭।';
        }
        }
        $package_no = substr($job->package_no, strpos($job->package_no, "-") + 1);
        $number     = $this->convertToStandardNumber($package_no);

        $pdf        = PDF::loadView('front.career.admit_card', [
            'applicant'   => $applicant,
            'roll_number' => $number . $applicant->roll_number,
            'package_no'  => $number,
            'job_title'   => $job_title,
            'exam_venue'   => $exam_venue,
        ], [], [
            'default_font' => 'nikosh',
        ]);
        return $pdf->download($id .'.pdf');
    }

    public function convertToStandardNumber($input) {
        $english          = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $bangla           = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
        $converted_number = str_replace($bangla, $english, $input);
        $num              = sprintf("%02d", $converted_number);
        return $num;
    }

}
