<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller {

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'job_title'             => 'required|max:80',
            'job_location'          => 'required|max:100',
            'job_short_description' => 'required',
            'job_long_description'  => 'required',
            'deadline'              => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $job                        = new Job();
            $job->job_title             = $request->job_title;
            $job->job_location          = $request->job_location;
            $job->job_short_description = $request->job_short_description;
            $job->job_long_description  = $request->job_long_description;
            $job->deadline              = $request->deadline;

            if ($job->save()) {
                return response()->json(['status' => true, 'data' => $job]);
            }
        }
    }
    public function edit($id) {
        $data = Job::find($id);
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

    public function updated(Request $request) {
        $validator = Validator::make($request->all(), [
            'job_title'             => 'required|max:80',
            'job_location'          => 'required|max:100',
            'job_short_description' => 'required',
            'job_long_description'  => 'required',
            'deadline'              => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $job               = Job::find($request->category_id);
            $job->job_title    = $request->job_title;
            $job->job_location = $request->job_location;
            if ($request->job_short_description) {
                $job->job_short_description = $request->job_short_description;
            }
            if ($request->job_long_description) {
                $job->job_long_description = $request->job_long_description;
            }
            $job->deadline = $request->deadline;

            if ($job->save()) {
                return response()->json(['status' => true]);
            }
        }
    }

    public function destroy(Request $request) {
        $job = Job::find($request->id);
        if ($job->delete()) {
            return response()->json(['success' => true, 'data' => $job]);
        }
    }

    public function viewJob($id) {
        $data = Job::find($id);
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
}
