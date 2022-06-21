<?php

namespace App\Http\Controllers;

use App\Service;
use App\SubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function serviceMax($id)
    {
        $setPosition = Service::select('service_precedence')->max('service_precedence');
        return response()->json($setPosition);
    }

    public function serviceMaxUpdate()
    {
        $setPosition = Service::select('service_precedence')->max('service_precedence');
        return response()->json($setPosition);
    }

    public function quickPass($id)
    {
        $result = Service::where('service_precedence', $id)->first();
        if ($result) {
            return response()->json([
                'result' => $result,
                'message' => "Already positioned,use another!"
            ]);
        }
    }

    public function quickPassUpdate($id)
    {
        $result = Service::where('service_precedence', $id)->first();
        if ($result) {
            return response()->json([
                'result' => $result,
                'message' => "Already positioned,use another!"
            ]);
        }
    }



    // ///////////////////////////////////////////////////////////////////////////////////////////////
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'service_name' => 'required|max:80',
            'service_precedence' => 'required',
            'image' => 'required|dimensions:width=400,height=440|mimes:jpg,png,jpeg',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $service = new Service();
            $service->service_name = $request->service_name;
            $service->service_precedence = $request->service_precedence;
            if ($request->hasFile('image')) {
                $path = 'images/services/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $image = $request->image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();
                $image->move($path, $imageName);
                $service->service_image = $path . $imageName;
            }
            if($service->save()){
                return response()->json(['status'=>true,'data' => $service]);
            }
        }
    }
    public function edit($id)
    {
        $data  = Service::find($id);
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
            'service_name' => 'required|max:80',
            'image' => 'dimensions:width=400,height=440|mimes:jpg,png,jpeg',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $service = Service::find($request->category_id);
            $service->service_name = $request->service_name;
            if($request->service_precedence){
                $service->service_precedence = $request->service_precedence;
            }
            if ($request->hasFile('image')) {
                File::delete($service->service_image);
                $path = 'images/services/';
                @unlink($service->social_media_icon);
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $image = $request->image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();

                $image->move($path, $imageName);
                $service->service_image = $path . $imageName;
            }
            if($service->save()){
                return response()->json(['status'=>true]);
            }
        }
    }

    public function destroy(Request $request){
        $service_exist = SubService::where('service_id', $request->id)->first();
        if($service_exist){
            return response()->json(['status'=> 0]);
        }else{
            $service = Service::find($request->id);
            if($service->delete()){
                File::delete($service->service_image);
                return response()->json(['success'=>true,'data'=>$service]);
            }
        }
    }

    public function viewService($id){
        $data = Service::find($id);
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
