<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'unique:users,email,'.$request->id,
            'image' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt(12345678);
                $user->role_id = 2;
                if ($request->hasFile('image')) {
                    $path = 'images/users/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    $image = $request->image;
                    $imageName = rand(100, 1000) . $image->getClientOriginalName();
                    $image->move($path, $imageName);
                    $user->image = $path . $imageName;
                }
                if($user->save()){
                    return response()->json(['status'=>true,'data'=>$user]);
                }
        }
    }
    public function edit($id)
    {
        $data  = User::find($id);
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
            'name' => 'required|max:50',
            'email' => 'required|email',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = User::find($request->category_id);
            $user->name = $request->name;
            $user->email = $request->email;
        }
        if ($request->hasFile('image')) {
            File::delete($user->image);
            $path = 'images/users/';
            @unlink($user->image);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $user->image = $path . $imageName;
        }
        if($user->save()){
            return response()->json(['status'=>true]);
        }
    }


    public function destroy(Request $request){
        $user = User::find($request->id);
        if($user->delete()){
            File::delete($user->image);
            return response()->json(['success'=>true,'data'=>$user]);
        }
    }


    public function veiwUser($id){
        $user=User::find($id);
        if($user){
          return response()->json([
              'success' => true,
              'data' => $user
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
