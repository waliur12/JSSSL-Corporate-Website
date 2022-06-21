<?php

namespace App\Http\Controllers;

use App\EthicalCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EthicalCodesController extends Controller {
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'ethical_code_heading'     => 'required',
            'ethical_code_description' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $ethical                           = new EthicalCode();
            $ethical->ethical_code_heading     = $request->ethical_code_heading;
            $ethical->ethical_code_description = $request->ethical_code_description;

            if ($ethical->save()) {
                $description                 = $ethical->ethical_code_description;
                $strip_text                  = strip_tags($description);
                $result                      = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
                $formated_description        = substr($result, 0, 25);
                $ethical->formated_description = $formated_description;
                return response()->json(['status' => true, 'data' => $ethical]);
            }
        }
    }
    public function edit($id) {
        $data = EthicalCode::find($id);
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
        $validator = Validator::make($request->all(), [
            'ethical_code_heading'     => 'required',
            'ethical_code_description' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $ethical                           = EthicalCode::find($request->category_id);
            $ethical->ethical_code_heading     = $request->ethical_code_heading;
            $ethical->ethical_code_description = $request->ethical_code_description;
            if ($ethical->save()) {
                return response()->json(['status' => true]);
            }
        }
    }

    public function destroy(Request $request) {
        $founder = EthicalCode::find($request->id);
        if ($founder->delete()) {
            return response()->json(['success' => true, 'data' => $founder]);
        }
    }

    public function viewEthical($id) {
        $data = EthicalCode::find($id);
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
