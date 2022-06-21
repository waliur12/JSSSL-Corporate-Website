<?php

namespace App\Http\Controllers;

use App\FounderSpeech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FounderSpeechController extends Controller {
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'designation' => 'required|max:80',
            'description' => 'required',
            'image'       => 'required|max:600|mimes:jpg,png,jpeg',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $image = $request->image;
            if ($image) {
                $image_name = hexdec(uniqid());
                $ext        = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $ext;
                $upload_path1    = 'images/founder-speach/';
                $image_url       = $upload_path1 . $image_full_name;
                $success         = $image->move($upload_path1, $image_full_name);

            }
            $founder              = new FounderSpeech();
            $founder->designation = $request->designation;
            $founder->description = $request->description;
            $founder->image       = $image_url;

            if ($founder->save()) {
                return response()->json(['status' => true, 'data' => $founder]);
            }
        }
    }
    public function edit($id) {
        $data = FounderSpeech::find($id);
        if ($data) {
            $data['tags'] = $data->getTag;
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'designation' => 'required|max:80',
            'description' => 'required',
            'image'       => 'nullable|max:600|mimes:jpg,png,jpeg',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $founder = FounderSpeech::find($request->category_id);
            $image   = $request->image;
            if ($image) {
                File::delete($founder->image);
                $image_name = hexdec(uniqid());
                $ext        = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $ext;
                $upload_path1    = 'images/founder-speach/';
                $image_url       = $upload_path1 . $image_full_name;
                $success         = $image->move($upload_path1, $image_full_name);

            } else {
                $image_url = $founder->image;
            }
            $founder->designation = $request->designation;
            $founder->description = $request->description;
            $founder->image = $image_url;
            if ($founder->save()) {
                return response()->json(['status' => true]);
            }
        }
    }

    public function destroy(Request $request) {
        $founder = FounderSpeech::find($request->id);
        if ($founder->delete()) {
            File::delete($founder->image);
            return response()->json(['success' => true, 'data' => $founder]);
        }
    }

    public function viewFounderSpeech($id) {
        $data = FounderSpeech::find($id);
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
