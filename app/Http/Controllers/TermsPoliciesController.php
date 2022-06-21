<?php

namespace App\Http\Controllers;

use App\TermsPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsPoliciesController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'terms_policy_heading' => 'required',
            'terms_policy_description' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $terms = new TermsPolicy();
            $terms->terms_policy_heading = $request->terms_policy_heading;
            $terms->terms_policy_description = $request->terms_policy_description;

            if($terms->save()){
                $description = $terms->terms_policy_heading;
                $strip_text = strip_tags($description);
                $result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
                $formated_description                            = substr($result, 0, 25);
                $terms->formated_description = $formated_description;
                return response()->json(['status'=>true,'data' => $terms]);
            }
        }
    }
    public function edit($id)
    {
        $data  = TermsPolicy::find($id);
        if($data){
        $data['tags'] = $data->getTag;
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'terms_policy_heading' => 'required',
            'terms_policy_description' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $terms = TermsPolicy::find($request->category_id);
            $terms->terms_policy_heading = $request->terms_policy_heading;
            $terms->terms_policy_description = $request->terms_policy_description;
            if($terms->save()){
                return response()->json(['status'=>true]);
            }
        }
    }


    public function destroy(Request $request){
        $founder = TermsPolicy::find($request->id);
        if($founder->delete()){
            return response()->json(['success'=>true,'data'=>$founder]);
        }
    }

    public function viewTerms($id){
        $data=TermsPolicy::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }
}
