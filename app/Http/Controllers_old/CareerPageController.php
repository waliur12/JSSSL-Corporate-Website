<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Job;
use App\JobApplicant;
use App\Requirement;
use App\Responsibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CareerPageController extends Controller
{
    public function getMaxJobPrecedence() {
        $setPosition = Job::select('precedence')->max('precedence');
        return response()->json($setPosition);
    }
    // start jobs section
    public function jobs() {
        $jobs = Job::orderBy('precedence','ASC')->get();
        foreach ($jobs as $job) {
            $job_des=strip_tags($job->description);
            
           
            $description               = substr($job_des, 0, 25);
            $job->formated_description = $description;

            foreach ($job->requirements as $requirement) {
                $job_req=strip_tags($requirement->requirement);
                $format_requirement                = substr($job_req, 0, 25);
                $requirement->formated_requirement = $format_requirement;
            }
            foreach ($job->responsibilities as $responsibility) {
                $job_res=strip_tags($responsibility->responsibility);
                $format_responsibility                   = substr($job_res, 0, 25);
                $responsibility->formated_responsibility = $format_responsibility;
            }
        }

        return view('backend.careers.jobs', compact('jobs'));
        // return view('backend.careers.job', compact('jobs'));
    }
    public function jobAdd(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'          => 'required|max:100',
            'precedence'          => 'required|max:100',
            'location'       => 'required|max:100',
            'description'    => 'required|max:2000',
            'requirement'    => 'required|max:2000',
            'responsibility' => 'required|max:2000',
            'last_date'      => 'required|date',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            // create job
            $job = Job::create([
                'title'       => $request->title,
                'location'    => $request->location,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'deadline'    => $request->last_date,
                'precedence'    => $request->precedence,
            ]);
            // create job requirement
            $requirement = Requirement::create([
                'requirement' => $request->requirement,
            ]);
            // create job responsibility
            $responsibility = Responsibility::create([
                'responsibility' => $request->responsibility,
            ]);
            $job->requirements()->attach($requirement); // store into pivot table
            $job->responsibilities()->attach($responsibility); // store into pivot table


            $job_des = strip_tags($request->description);
            $job_req = strip_tags($request->requirement);
            $job_responsibility = strip_tags($request->responsibility);

            $data                   = array();
            $data['message']        = 'Job info added successfully';
            $data['title']          = $job->title;
            $data['description']    = substr($job_des, 0, 25);
            $data['requirement']    = substr($job_req, 0, 25);
            $data['responsibility']    = substr($job_responsibility, 0, 25);
            // $data['short_description'] = strip_tags($short_description);
            // $data['requirement']    = strip_tags($job_requirement);
            // $data['requirement'] = strip_tags($job_responsibility);
            $data['precedence']          = $job->precedence;
            $data['location']       = $job->location;
            $data['applicants']     = $job->applicants->count();
            $data['id']             = $job->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }
    public function jobView(Request $request) {
        $data = Job::findOrFail($request->id);
        // dd();
        $requirement            = $data->requirements->first();
        $responsibility         = $data->responsibilities->first();
        $data['requirement']    = $requirement->requirement;
        $data['responsibility'] = $responsibility->responsibility;
        $data['posted_date']    = $data->created_at->toFormattedDateString();
        $data['dedline']        = $data->deadline->toFormattedDateString();
        if ($data) {
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }
    public function jobEdit(Request $request) {
        $data                   = Job::findOrFail($request->id);
        $requirement            = $data->requirements->first();
        $responsibility         = $data->responsibilities->first();
        $data['requirement']    = $requirement->requirement;
        $data['date']           = $data->deadline->toDateString();
        $data['responsibility'] = $responsibility->responsibility;

        if ($data) {
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }
    public function jobUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'          => 'required|max:100',
            'precedence'          => 'required|max:100',
            'location'       => 'required|max:100',
            'description'    => 'required|max:2000',
            'requirement'    => 'required|max:2000',
            'responsibility' => 'required|max:2000',
            'last_date'      => 'required|date',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $job = Job::findOrFail($request->hidden_id);
            $job->update([
                'title'       => $request->title,
                'location'    => $request->location,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'deadline'    => $request->last_date,
                'precedence'    => $request->precedence,
            ]);
            $job->requirements()->update([
                'requirement' => $request->requirement,
            ]);
            $job->responsibilities()->update([
                'responsibility' => $request->responsibility,
            ]);
            // $description        = strip_tags($job->description);
            $description        = strip_tags($job->description);
            $job_requirement    = strip_tags($request->requirement);
            $job_responsibility = strip_tags($request->responsibility);

            $data                   = array();
            $data['message']        = 'data updated successfully';
            $data['title']          = $job->title;
            $data['precedence']          = $job->precedence;
            $data['description']    = substr($description, 0, 25);
            $data['requirement']    = substr($job_requirement, 0, 25);
            $data['responsibility'] = substr($job_responsibility, 0, 25);
            $data['location']       = $job->location;
            $data['applicant']      = $job->applicants->count();
            $data['dedline']        = $job->deadline->toFormattedDateString();
            $data['id']             = $job->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }
    public function jobDelete(Request $request) {
        $job           = Job::findOrFail($request->id);
        $job_applicant = JobApplicant::where('job_id', $request->id)->first();
        if ($job_applicant) {
            $applicant = Applicant::where('id', $job_applicant->applicant_id)->delete();
        }
        $job->delete();
        $data            = array();
        $data['message'] = 'Data deleted successfully';
        $data['id']      = $request->id;
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);

    }
    // end job section

    // jon applicant section start
    public function jobApplication() {
        $all_applications = Applicant::orderBy('id','DESC')->get();
        foreach ($all_applications as $all_applicants) {
            foreach ($all_applicants->jobApplications as $data) {
                $all_applicants->title  = $data->title;
                $all_applicants->job_id = $data->id;
            }
        }
        return view('backend.careers.all_application', compact('all_applications'));
    }

    public function jobApplicants($id) {
        $job                       = Job::find($id);
        $formated_description      = substr($job->description, 0, 50);
        $job->formated_description = $formated_description;

        $applicants = $job->applicants;
        // dd($job);
        return view('backend.careers.job_applicant', compact('applicants', 'job'));
    }
    public function jobApplicantDelete(Request $request) {

        $applicant = Applicant::findOrFail($request->id);

        $job = JobApplicant::where('applicant_id', $request->id)
            ->Where('job_id', $request->job_id)->first();
        $job->delete();
        $applicant->delete();
        File::delete('backend/' . $applicant->cv);
        $data            = array();
        $data['message'] = 'Data deleted successfully';
        $data['id']      = $request->id;
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }
}
