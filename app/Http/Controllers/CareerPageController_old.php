<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Instruction;
use App\Job;
use App\JobApplicant;
use App\Requirement;
use App\Responsibility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CareerPageController extends Controller {
    public function getMaxJobPrecedence() {
        $setPosition = Job::select('precedence')->max('precedence');
        return response()->json($setPosition);
    }
    // start jobs section
    public function jobs() {
        $jobs = Job::orderBy('precedence', 'ASC')->get();
        foreach ($jobs as $job) {
            $job_des = strip_tags($job->description);

            $description               = \Illuminate\Support\Str::words($job_des, 5, '.');
            $job->formated_description = $description;

            foreach ($job->requirements as $requirement) {
                $job_req                           = strip_tags($requirement->requirement);
                $format_requirement                = \Illuminate\Support\Str::words($job_req, 5, '.');
                $requirement->formated_requirement = $format_requirement;
            }
            foreach ($job->responsibilities as $responsibility) {
                $job_res                                 = strip_tags($responsibility->responsibility);
                $format_responsibility                   = \Illuminate\Support\Str::words($job_res, 5, '.');
                $responsibility->formated_responsibility = $format_responsibility;
            }
            foreach ($job->instruction as $instruction) {
                $job_ins                           = strip_tags($instruction->instructions);
                $format_instruction                = \Illuminate\Support\Str::words($job_ins, 5, '.');
                $instruction->formated_instruction = $format_instruction;
            }
        }

        return view('backend.careers.jobs', compact('jobs'));
        // return view('backend.careers.job', compact('jobs'));
    }
    public function jobAdd(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'          => 'required|max:100',
            'precedence'     => 'required|max:100',
            'location'       => 'required|max:100',
            'description'    => 'required|max:4000',
            'requirement'    => 'required|max:4000',
            'responsibility' => 'required|max:4000',
            'instruction'    => 'required|max:4000',
            'last_date'      => 'required|date',
            'package_no'     => 'nullable|max:100',
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
                'title'             => $request->title,
                'location'          => $request->location,
                'short_description' => $request->short_description,
                'description'       => $request->description,
                'deadline'          => $request->last_date,
                'precedence'        => $request->precedence,
                'package_no'        => $request->package_no,
                'admit_card'        => $admit_url ?? null,
            ]);
            // create job requirement
            $requirement = Requirement::create([
                'requirement' => $request->requirement,
            ]);
            // create job responsibility
            $responsibility = Responsibility::create([
                'responsibility' => $request->responsibility,
            ]);
            // create job instruction
            $instruction = Instruction::create([
                'instructions' => $request->instruction,
            ]);
            $job->requirements()->attach($requirement); // store into pivot table
            $job->responsibilities()->attach($responsibility); // store into pivot table
            $job->instruction()->attach($instruction); // store into pivot table

            $job_des            = strip_tags($request->description);
            $job_req            = strip_tags($request->requirement);
            $job_responsibility = strip_tags($request->responsibility);
            $job_instruction    = strip_tags($request->instruction);

            $data            = array();
            $data['message'] = 'Job info added successfully';
            $data['title']   = $job->title;
            // $data['description']    = $request->description;
            $data['requirement'] = \Illuminate\Support\Str::words($job_req, 5, '.');
            // $data['requirement']    = preg_split('/[\s,]+/', $job_req, 1);
            $data['responsibility'] = \Illuminate\Support\Str::words($job_responsibility, 5, '.');
            $data['instruction']    = \Illuminate\Support\Str::words($job_instruction, 5, '.');
            $data['description']    = \Illuminate\Support\Str::words($job_des, 5, '.');
            // $data['short_description'] = strip_tags($short_description);
            // $data['requirement']    = strip_tags($job_requirement);
            // $data['requirement'] = strip_tags($job_responsibility);
            $data['precedence'] = $job->precedence;
            $data['location']   = $job->location;
            $data['applicants'] = $job->applicants->count();
            $data['id']         = $job->id;
            $data['package_no'] = $job->package_no;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }
    public function jobView(Request $request) {
        $data = Job::findOrFail($request->id);
        // dd();
        $requirement             = $data->requirements->first();
        $responsibility          = $data->responsibilities->first();
        $instruction             = $data->instruction->first();
        $data['job_instruction'] = $instruction->instructions;
        $data['requirement']     = $requirement->requirement;
        $data['responsibility']  = $responsibility->responsibility;
        $data['posted_date']     = $data->created_at->toFormattedDateString();
        $data['dedline']         = $data->deadline->toFormattedDateString();
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
        $data                     = Job::findOrFail($request->id);
        $requirement              = $data->requirements->first();
        $responsibility           = $data->responsibilities->first();
        $instruction              = $data->instruction->first();
        $data['job_instructions'] = $instruction->instructions;
        $data['requirement']      = $requirement->requirement;
        $data['date']             = $data->deadline->toDateString();
        $data['responsibility']   = $responsibility->responsibility;

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
            'precedence'     => 'required|max:100',
            'location'       => 'required|max:100',
            'description'    => 'required|max:4000',
            'requirement'    => 'required|max:4000',
            'responsibility' => 'required|max:4000',
            'instruction'    => 'required|max:4000',
            'last_date'      => 'required|date',
            'package_no'     => 'nullable|max:100',
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
                'title'             => $request->title,
                'location'          => $request->location,
                'short_description' => $request->short_description,
                'description'       => $request->description,
                'deadline'          => $request->last_date,
                'precedence'        => $request->precedence,
                'package_no'        => $request->package_no,
            ]);
            $job->requirements()->update([
                'requirement' => $request->requirement,
            ]);
            $job->responsibilities()->update([
                'responsibility' => $request->responsibility,
            ]);
            $job->instruction()->update([
                'instructions' => $request->instruction,
            ]);
            // $description        = strip_tags($job->description);
            $description        = strip_tags($job->description);
            $job_requirement    = strip_tags($request->requirement);
            $job_responsibility = strip_tags($request->responsibility);
            $job_instruction    = strip_tags($request->instruction);

            $data                   = array();
            $data['message']        = 'data updated successfully';
            $data['title']          = $job->title;
            $data['precedence']     = $job->precedence;
            $data['description']    = \Illuminate\Support\Str::words($description, 5, '.');
            $data['requirement']    = \Illuminate\Support\Str::words($job_requirement, 5, '.');
            $data['responsibility'] = \Illuminate\Support\Str::words($job_responsibility, 5, '.');
            $data['instruction']    = \Illuminate\Support\Str::words($job_instruction, 5, '.');
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
        dd($request->all());
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
    public function jobApplication(Request $request) {
        $all_packages = Job::pluck('package_no', 'id');
        $all_applications = Applicant::with("getEducation", "getWork", "jobApplications")->where('is_visible',0)->latest();
        if ($request->ajax()) {
            // dd($request->all());
            return $this->dataTable($all_applications);
        }
        // $all_applications=[];
        // ini_set('memory_limit', '-1');
        // $seconds=1200;
        return view('backend.careers.all_application', compact('all_applications', 'all_packages'));
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
        // dd($request->all());
        $applicant = Applicant::findOrFail($request->id);
        $job       = JobApplicant::where('applicant_id', $request->id)->first();
        $applicant->delete();
        File::delete('backend/' . $applicant->cv);
        if ($job) {
            $job->delete();
        }
        $data            = array();
        $data['message'] = 'Data deleted successfully';
        $data['id']      = $request->id;
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }

    public function updateSelectedStatus(Request $request) {
        $applicant = Applicant::findOrFail($request->id);
        if ($applicant->is_selected == 0) {
            $applicant->update([
                'is_selected' => 1,
            ]);
        } else {
            $applicant->update([
                'is_selected' => 0,
            ]);
        }
        $data            = array();
        $data['message'] = 'Status updated successfully';
        $data['id']      = $request->id;
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);

    }

    public function uploadAdmitCard(Request $request) {
        $applicant = Applicant::find($request->applicant_id);
        if ($applicant) {
            $admit_card = $request->admit_card;
            if ($admit_card) {
                File::delete('files/' . $applicant->admit_card);
                $admit_card_name = hexdec(uniqid());
                $ext             = strtolower($admit_card->getClientOriginalExtension());

                $admit_card_name_full_name = $admit_card_name . '.' . $ext;
                $upload_path               = 'admit-card/';
                $upload_path1              = 'files/admit-card';
                $admit_url                 = $upload_path . $admit_card_name_full_name;
                $success                   = $admit_card->move($upload_path1, $admit_card_name_full_name);
            }
            $applicant->update([
                'admit_card' => $admit_url,
            ]);
            $data            = array();
            $data['message'] = 'Admit card uploaded successfully';
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            $data          = array();
            $data['error'] = 'Applicant data not found';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }

    }

    public function saveSelectedCandidate(Request $request) {
        try {
            $applicants = Applicant::whereIn('id', $request->unselected_id)->get();
            foreach ($applicants as $applicant) {
                $applicant->update([
                    'is_visible'=> 1,
                ]);
                // File::delete('backend/' . $applicant->cv);
            }
            // JobApplicant::whereIn('applicant_id', $request->unselected_id)->delete();
            Applicant::whereIn('id', $request->selected_id)->update([
                'is_selected' => 1,
            ]);
            $data            = array();
            $data['message'] = 'Unselected candidate has been deleted';
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);

        } catch (\Exception $e) {
            $data          = array();
            $data['error'] = $e->getMessage();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }
    public function selectCandidate(Request $request) {
        try {
            $job_applicant = JobApplicant::where('applicant_id', $request->id)->first();
            $job           = Job::where('id', $job_applicant->job_id)->first();
            $package_no    = substr($job->package_no, strpos($job->package_no, "-") + 1);
            $number        = $this->convertToStandardNumber($package_no);
            $max           = Applicant::max('roll_number');
            if ($max == null) {
                $roll_number = (int) 1001;
            } else {
                $new_num     = $max + 1;
                $roll_number = $new_num;

            }
            $data = [];
            if ($request->val == 1) {
                Applicant::where('id', $request->id)->update([
                    'roll_number' => $roll_number,
                    'is_selected' => 1,
                ]);
                $data['message']     = 'Applican has been selected';
                $data['roll_number'] = $roll_number;
                $data['id']          = $request->id;
                $data['is_selected'] = 1;
                return response()->json([
                    'success' => true,
                    'data'    => $data,
                ]);
            } else {
                Applicant::where('id', $request->id)->update([
                    'roll_number' => null,
                    'is_selected' => 0,
                ]);
                $data['message']     = 'Applican has been unselected';
                $data['id']          = $request->id;
                $data['is_selected'] = 0;
                return response()->json([
                    'success' => true,
                    'data'    => $data,
                ]);
            }

        } catch (\Exception $e) {
            $data          = array();
            $data['error'] = $e->getMessage();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }

    }

    public function viewAdmitCard(Request $request) {
        $applicant = Applicant::with('jobApplications')->findOrFail($request->id);
        foreach ($applicant->jobApplications as $job) {
            $package_no = $job->package_no;
            $job_title  = $job->title;
        }
        $package_no          = substr($job->package_no, strpos($job->package_no, "-") + 1);
        $number              = $this->convertToStandardNumber($package_no);
        $data                = [];
        $data['roll_number'] = $number . $applicant->roll_number;
        $data['package_no']  = (int) $number;
        $data['job_title']   = $job_title;
        $data['applicant']   = $applicant;
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }

    public function getApplicantsBypackageNo(Request $request) {
        $job        = Job::with('applicants', 'applicants.jobApplications', 'applicants.getEducation', 'applicants.getWork')->findOrFail($request->id);
        $applicants = $job->applicants;
        if (Session::has('applicants')) {
            Session::forget('applicants');
        }
        Session::put('applicants', $applicants);
        return response()->json([
            'success' => true,
        ]);
    }

    public function applicantsDataTableByPackageNo() {
        $applicants = Session::get('applicants');
        return $this->dataTable($applicants);
    }
    public function convertToStandardNumber($input) {
        $english          = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $bangla           = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
        $converted_number = str_replace($bangla, $english, $input);
        $num              = sprintf("%02d", $converted_number);
        return $num;
    }

    public function dataTable($applicants) {
        return DataTables::of($applicants)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                if ($data->is_selected == 0) {
                    $actionBtn = "<button type='button' class='ms-btn-icon btn-info viewData'
                data-id='$data->id'><i class='fa fa-eye'></i></button>
                <button type='button' class='ms-btn-icon btn-danger' onclick='deleteItem($data->id)'
               ><i class='flaticon-trash'></i></button>
                <button type='button' class='ms-btn-icon btn-info view_admit_card_btn$data->id' disabled  onclick='viewAdmitCard($data->id)'><i class='fa fa-id-card'></i></button>";
                    return $actionBtn;
                } else {
                    $actionBtn = "<button type='button' class='ms-btn-icon btn-info viewData'
                data-id='$data->id'><i class='fa fa-eye'></i></button>
                <button type='button' class='ms-btn-icon btn-danger' onclick='deleteItem($data->id)'
               ><i class='flaticon-trash'></i></button>
                <button type='button' class='ms-btn-icon btn-info view_admit_card_btn$data->id'  onclick='viewAdmitCard($data->id)'><i class='fa fa-id-card'></i></button>";
                    return $actionBtn;
                }

            })

            ->addColumn('title', function (Applicant $applicant) {
                return $applicant->jobApplications->map(function ($job) {
                    return $job->title;
                })->implode('<br>');
            })
            ->addColumn('package_no', function (Applicant $applicant) {
                return $applicant->jobApplications->map(function ($job) {
                    return $job->package_no;
                })->implode('<br>');
            })
            ->addColumn('location', function (Applicant $applicant) {
                return $applicant->jobApplications->map(function ($job) {
                    return $job->location;
                })->implode('<br>');
            })

            ->addColumn('education', function (Applicant $applicant) {
                return $applicant->getEducation->map(function ($education) {
                    return "Degree:" . $education->degree . ', '
                    . "Passing Year:" . $education->passing_year . ', '
                    . "Result:" . $education->result . ', '
                    . "Institution:" . $education->institution . ', '
                    . "Subject:" . $education->subject;
                });
            })
            ->addColumn('work', function (Applicant $applicant) {
                return $applicant->getWork->map(function ($work) {
                    return "Company Name:" . $work->company_name . ', '
                    . "Designation:" . $work->designation . ', '
                    . "Joining Date:" . Carbon::parse($work->joining_date)->format('d-F-Y') . ', '
                    . "End Date:" . Carbon::parse($work->end_date)->format('d-F-Y');
                });
            })
            ->addColumn('selected_cadidate', function ($data) {
                if ($data->is_selected == 0) {
                    $checkbox = "<label class='ms-checkbox-wrap ms-checkbox-dark'>
                <input type='checkbox' class='candidateCheckbox'  value='$data->id' data-id='$data->id'> <i class='ms-checkbox-check'></i>
              </label>";
                } else {
                    $checkbox = "<label class='ms-checkbox-wrap ms-checkbox-dark'>
                <input type='checkbox' class='candidateCheckbox' name='checkbox' value='$data->id' checked value='$data->id' data-id='$data->id'> <i class='ms-checkbox-check'></i>
              </label>";
                }

                return $checkbox;
            })
            ->rawColumns(['action', 'education', 'selected_cadidate', 'work', 'package_no', 'location', 'title'])
            ->make(true);
    }
}
