<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Job;
use App\JobApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller {
    public function career() {
        $jobs = Job::orderBy('precedence','ASC')->paginate(4);
        return view('front.career.career', compact('jobs'));
    }

    public function careerDetails($id) {
        $job_id = Job::with('responsibilities', 'requirements')->where('id', '=', $id)->first();
        return view('front.career.career_details', compact('job_id'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [

            'fullname'     => 'required|max:80',
            'email'        => 'required',
            'uploadcv'     => 'required',
            'fathername'   => 'required',
            'mothername'   => 'required',
            'dob'          => 'required',
            'nid'          => 'required',
            'religion'     => 'required',
            'image'        => 'required|dimensions:width=300,height=300',
            'contact'      => 'required',
            // 'degree'    => 'required|array',
            'degree'       => 'required|array',
            'degree.*'     => 'required|string',

            'gpsubject'    => 'required|array',
            'gpsubject.*'  => 'required|string',

            'institute'    => 'required|array',
            'institute.*'    => 'required|string',

            'result'       => 'required|array',
            'result.*'       => 'required|string',

            'passingyear'  => 'required|array',
            'passingyear.*'  => 'required|string',

            // 'designation'  => 'required|array',
            // 'designation.*'  => 'required|string',

            // 'company_name' => 'required|array',
            // 'company_name.*' => 'required|string',

            // 'joining_date' => 'required|array',
            // 'joining_date.*' => 'required|string',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $applicant        = new Applicant();
            $applicant->name  = $request->fullname;
            $applicant->email = $request->email;
            $cv               = $request->file('uploadcv');
            $new_name         = time() . '.' . $cv->getClientOriginalExtension();
            $cv->move('backend/', $new_name);
            $applicant->cv                 = $new_name;
            $applicant->contact            = $request->contact;
            $applicant->father_name        = $request->fathername;
            $applicant->mother_name        = $request->mothername;
            $applicant->dob                = $request->dob;
            $applicant->nid                = $request->nid;
            $applicant->religion           = $request->religion;
            $applicant->working_experience = $request->workingexp;
            if ($request->hasFile('image')) {
                $path = 'images/appliedApplicants/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $image     = $request->image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();
                $image->move($path, $imageName);
                $applicant->photo = $path . $imageName;
            }
            // return $applicant;
            $applicant->save();
            $applicant_Id = $applicant->id;
            // $education = new ApplicantsEducationalQualification();

            $degree      = $request->degree;
            $subject     = $request->gpsubject;
            $institute   = $request->institute;
            $result      = $request->result;
            $passingyear = $request->passingyear;

            if (!empty($degree)) {
                for ($i = 0; $i < count($degree); $i++) {
                    $dataSave = [
                        'applicant_id' => $applicant_Id,
                        'degree'       => $degree[$i],
                        'passing_year' => $passingyear[$i],
                        'result'       => $result[$i],
                        'institution'  => $institute[$i],
                        'subject'      => $subject[$i],
                    ];
                    DB::table('applicants_educational_qualifications')->insert($dataSave);
                }
            }
            //Working Start
            $designation  = $request->designation;
            $company_name = $request->company_name;
            $joining_date = $request->joining_date;
            $end_date     = $request->end_date;

            if (!empty($company_name)) {
                for ($i = 0; $i < count($company_name); $i++) {
                    $dataSave = [
                        'applicant_id' => $applicant_Id,
                        'designation'  => $designation[$i],
                        'company_name' => $company_name[$i],
                        'joining_date' => $joining_date[$i],
                        'end_date'     => $end_date[$i],
                    ];
                    DB::table('working_experiences')->insert($dataSave);
                }
            }
            $job_applicant               = new JobApplicant();
            $job_applicant->job_id       = $request->job_id;
            $job_applicant->applicant_id = $applicant_Id;
            $job_applicant->save();

            //Working End

            return response()->json(['status' => true, 'data' => $applicant]);
        }

    }

    public function viewApplicant($id) {
        // $data=Applicant::find($id);
        $data = Applicant::with("getEducation", "getWork")->where('id', $id)->first();
        return response()->json($data);
    }
}
