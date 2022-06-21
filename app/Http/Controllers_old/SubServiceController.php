<?php

namespace App\Http\Controllers;

use App\SubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubServiceController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'service_id' => 'required',
            'sub_service_name' => 'required|max:80',
            'sub_service_description' => 'required',
            'image' => 'required|max:700|dimensions:width=1070,height=720',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
                $subservice = new SubService();
                $subservice->service_id = $request->service_id;
                $subservice->sub_service_name = $request->sub_service_name;
                $subservice->sub_service_description = $request->sub_service_description;

                if ($request->hasFile('image')) {
                    $path = 'images/subservices/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    $image = $request->image;
                    $imageName = rand(100, 1000) . $image->getClientOriginalName();
                    $image->move($path, $imageName);
                    $subservice->sub_service_image = $path . $imageName;
                }
                if($subservice->save()){
                    $description                 = $subservice->sub_service_description;
                    $strip_text                  = strip_tags($description);
                    $result                      = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
                    $formated_description        = substr($result, 0, 25);
                    $subservice->formated_description = $formated_description;
                    return response()->json(['status'=>true,'data' => $subservice]);
                }
        }
    }
    public function edit($id)
    {
        $data  = SubService::find($id);
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
            'service_id' => 'required',
            'sub_service_name' => 'required|max:80',
            'sub_service_description' => 'required',
            'image'=>'max:750|dimensions:width=1070,height=720'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $subservice = SubService::find($request->category_id);
            $subservice->service_id = $request->service_id;
            $subservice->sub_service_name = $request->sub_service_name;
            $subservice->sub_service_description = $request->sub_service_description;
        }
        if ($request->hasFile('image')) {
            File::delete($subservice->sub_service_image);
            $path = 'images/subservices/';
            @unlink($subservice->sub_service_image);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $subservice->sub_service_image = $path . $imageName;
        }
        if($subservice->save()){
            return response()->json(['status'=>true]);
        }
    }


    public function destroy(Request $request){
        $subservice = SubService::find($request->id);
        if($subservice->delete()){
            File::delete($subservice->sub_service_image);
            return response()->json(['status'=>true,'data' => $subservice]);
        }
    }


    public function viewSubService($id){
        $data=SubService::find($id);
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
