<?php

namespace App\Http\Controllers;

use App\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'social_media_platform' => 'required|max:50',
            'image' => 'required',
            'social_media_link' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $media = new SocialMedia();
            $media->social_media_platform = $request->social_media_platform;
            $media->social_media_link = $request->social_media_link;
            if ($request->hasFile('image')) {
                $path = 'images/social-medias/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $image = $request->image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();
                $image->move($path, $imageName);
                $media->social_media_icon = $path . $imageName;
            }
            if($media->save()){
                return response()->json(['status'=>true,'data' => $media]);
            }
        }
    }
    public function edit($id)
    {
        $data  = SocialMedia::find($id);
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
            'social_media_platform' => 'required|max:50',
            'social_media_link' => 'required',
            'image'=>'max:250'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $media = SocialMedia::find($request->category_id);
            $media->social_media_platform = $request->social_media_platform;
            $media->social_media_link = $request->social_media_link;
            if ($request->hasFile('image')) {
                File::delete($media->social_media_icon);
                $path = 'images/social-medias/';
                @unlink($media->social_media_icon);
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $image = $request->image;
                $imageName = rand(100, 1000) . $image->getClientOriginalName();

                $image->move($path, $imageName);
                $media->social_media_icon = $path . $imageName;
            }
            if($media->save()){
                return response()->json(['status'=>true]);
            }
        }
    }


    public function destroy(Request $request){
        $media = SocialMedia::find($request->id);
        if($media->delete()){
            File::delete($media->social_media_icon);
            return response()->json(['success'=>true,'data'=>$media]);
        }
    }


    public function viewMedia($id){
        $data=SocialMedia::find($id);
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
