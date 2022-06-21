<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'office_title' => 'required|max:80',
            'office_address' => 'required',
            'office_email' => 'required|email',
            'office_phone' => 'required|min:11|numeric',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $office = new Office();
            $office->office_title = $request->office_title;
            $office->office_address = $request->office_address;
            $office->office_email = $request->office_email;
            $office->office_phone = $request->office_phone;
            if($office->save()){
                return response()->json(['status'=>true,'data' => $office]);
            }
        }
    }
    public function edit($id)
    {
        $data  = Office::find($id);
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

    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'office_title' => 'required|max:80',
            'office_address' => 'required',
            'office_email' => 'required|email',
            'office_phone' => 'required|min:11|numeric',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $office = Office::find($request->category_id);
            $office->office_title = $request->office_title;
            $office->office_address = $request->office_address;
            $office->office_email = $request->office_email;
            $office->office_phone = $request->office_phone;

            if($office->save()){
                return response()->json(['status'=>true]);
            }
        }
    }


    public function destroy(Request $request){
        $office = Office::find($request->id);
        if($office->delete()){
            return response()->json(['success'=>true,'data'=>$office]);
        }
    }

    public function viewOffice($id){
        $data = Office::find($id);
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
