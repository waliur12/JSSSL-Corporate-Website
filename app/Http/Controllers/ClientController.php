<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'client_category_id' => 'required',
            'client_name' => 'required',
            'client_description' => 'required',
            'client_precedence' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
                $client = new Client();
                $client->client_category_id = $request->client_category_id;
                $client->client_name = $request->client_name;
                $client->client_precedence = $request->client_precedence;
                $client->client_description = $request->client_description;
                if ($request->hasFile('image')) {
                    $path = 'images/clients/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    $image = $request->image;
                    $imageName = rand(100, 1000) . $image->getClientOriginalName();
                    $image->move($path, $imageName);
                    $client->client_logo = $path . $imageName;
                }
                if($client->save()){
                    $description = $client->client_description;
                    $strip_text = strip_tags($description);
                    $result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
                    $formated_description                            = substr($result, 0, 15);
                    $client->formated_description = $formated_description;
                    return response()->json(['status'=>true,'data' => $client]);
                }
        }
    }
    public function edit($id)
    {
        $data  = Client::find($id);
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
            'client_category_id' => 'required',
            'client_name' => 'required',
            'client_description' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $client = Client::find($request->category_id);
            $client->client_category_id = $request->client_category_id;
            $client->client_name = $request->client_name;
            if($request->client_precedence){
               $client->client_precedence = $request->client_precedence;
            }

            $client->client_description = $request->client_description;
        }
        if ($request->hasFile('image')) {
            File::delete($client->client_logo);
            $path = 'images/clients/';
            @unlink($client->client_logo);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $client->client_logo = $path . $imageName;
        }
        if($client->save()){
            return response()->json(['status'=>true]);
        }
    }


    public function destroy(Request $request){
        $client = Client::find($request->id);
        if($client->delete()){
            File::delete($client->client_logo);
            return response()->json(['success'=>true,'data'=>$client]);
        }
    }


    public function viewClient($id){
        $data=Client::find($id);
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
