<?php

namespace App\Http\Controllers;

use App\NEWS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'news_title' => 'required|max:80',
            'news_description' => 'required',
            'image' => 'required',
            'news_published_at' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
                $news = new NEWS();
                $news->news_title = $request->news_title;
                $news->news_description = $request->news_description;
                $news->news_published_at = $request->news_published_at;
                if ($request->hasFile('image')) {
                   
                    $path = 'images/news/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }
                    $image = $request->image;
                    $imageName = rand(100, 1000) . $image->getClientOriginalName();
                    $image->move($path, $imageName);
                    $news->news_image = $path . $imageName;
                }
                if($news->save()){
                    $description = $news->news_description;
                    $strip_text = strip_tags($description);
                    $result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
                    $formated_description                            = substr($result, 0, 25);
                    $news->formated_description = $formated_description;
                    return response()->json(['status'=>true,'data'=>$news]);
                }
        }
    }
    public function edit($id)
    {
        $data  = NEWS::find($id);
        if($data){
        $data['tags'] = $data->getTag;
        $data['published_date'] = $data->news_published_at->toDateString();
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
            'news_title' => 'required|max:80',
            'news_description' => 'required',
            'news_published_at' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $news = NEWS::find($request->category_id);
            $news->news_title = $request->news_title;
            $news->news_description = $request->news_description;
            $news->news_published_at = $request->news_published_at;
        }
        if ($request->hasFile('image')) {
            File::delete($news->news_image);
            $path = 'images/news/';
            @unlink($news->news_image);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $news->news_image = $path . $imageName;
        }
        if($news->save()){
            return response()->json(['status'=>true]);
        }
    }


    public function destroy(Request $request){
        $news = NEWS::find($request->id);
        if($news->delete()){
            File::delete($news->news_image);
            return response()->json(['success'=>true,'data'=>$news]);
        }
    }


    public function viewNews($id){
        $data=NEWS::find($id);
        if($data){
            $data['formated_date'] = Carbon::parse($data->news_published_at)->format('jS F, Y');
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
