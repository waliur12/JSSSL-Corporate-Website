<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientCategories;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientCategoriesController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'client_category_name' => 'required | string | max: 100  | unique:client_categories',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $clientcat = new ClientCategories();
            $clientcat->client_category_name = $request->client_category_name;

            if($clientcat->save()){
                return response()->json(['status'=>true,'data' => $clientcat]);
            }
        }
    }
    public function edit($id)
    {
        $data  = ClientCategories::find($id);
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
    'client_category_name' => 'required|unique:client_categories,client_category_name,'.$request->category_id.',client_category_id',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $clientcat = ClientCategories::find($request->category_id);
            $clientcat->client_category_name = $request->client_category_name;

            if($clientcat->save()){
                return response()->json(['status'=>true]);
            }
        }
    }


    public function destroy(Request $request){
        $category_exist = Client::where('client_category_id', $request->id)->first();
        if($category_exist){
            return response()->json(['status'=> 0]);
        }else{
            $clientCat = ClientCategories::find($request->id);
            if($clientCat->delete()){
                return response()->json(['success'=>true,'data'=>$clientCat]);
            }
        }

    }


    public function viewClientCat($id){
        $data=ClientCategories::find($id);
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
