<?php

namespace App\Http\Controllers;

use App\MainOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainOfficeController extends Controller
{

    public function edit($id)
    {
        $data  = MainOffice::find($id);
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
            'contact' => 'required|min:11',
            'email' => 'required|email',
            'location' => 'required|max:100',

        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $office = MainOffice::find($request->category_id);
            $office->contact = $request->contact;
            $office->email = $request->email;
            $office->location = $request->location;

            if($office->save()){
                return response()->json(['status'=>true]);
            }
        }
    }




    public function viewOffice($id){
        $data = MainOffice::find($id);
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
