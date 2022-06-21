<?php

namespace App\Http\Controllers;

use App\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller {
    public function heroSection() {
        $hero_sections = HeroSection::get();
        foreach ($hero_sections as $hero_section) {
            $strip_text = strip_tags($hero_section->description);
            $result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
            $description                            = substr($result, 0, 25);
            $hero_section->formated_description = $description;

            $strip_title = strip_tags($hero_section->title);
            $title_result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_title);
            $hero_section->formated_title = $title_result;
        }
        // dd($result);
        return view('backend.hero_section',compact('hero_sections'));
    }
    public function heroSectionStore(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:100',
            'description' => 'required|max:5000',
            'image'       => 'required|image|mimes:jpg,png|max:1000',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $image = $request->image;
            if ($image) {
                $image_name = hexdec(uniqid());
                $ext        = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $ext;
                $upload_path     = 'hero-section/';
                $upload_path1    = 'backend/hero-section/';
                $image_url       = $upload_path . $image_full_name;
                $success         = $image->move($upload_path1, $image_full_name);
                // $img = Image::make($image)->resize(517, 286);
                // $img->save($upload_path1 . $image_full_name, 60);
            }
            $our_stack_holder = HeroSection::create([
                'title'       => $request->title,
                'description' => $request->description,
                'image'       => $image_url,
            ]);
            $description = substr($our_stack_holder->description, 0, 25);

            $data                = array();
            $data['message']     = 'Data created successfully';
            $data['title']       = $our_stack_holder->title;
            $data['description'] = $description;
            $data['image']       = $our_stack_holder->image;
            $data['id']          = $our_stack_holder->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
        return view('backend.hero_section');
    }
    public function heroSectionShow(Request $request){
        $data = HeroSection::findOrFail($request->id);
        if ($data) {
            $data->formated_description = strip_tags($data->description);
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }
    public function heroSectionEdit(Request $request){
        $data = HeroSection::findOrFail($request->id);
        if ($data) {
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data'    => 'No information found',
            ]);
        }
    }
    public function heroSectionUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:250',
            'description' => 'required|max:5000',
            'image'       => 'mimes:jpg,png|max:1000',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $hero_section = HeroSection::findOrFail($request->hidden_id);
            $image            = $request->image;
            if ($image) {
                File::delete('backend/' . $hero_section->image);
                $image_name = hexdec(uniqid());
                $ext        = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $ext;
                $upload_path     = 'hero-section/';
                $upload_path1    = 'backend/hero-section/';
                $image_url       = $upload_path . $image_full_name;
                $success         = $image->move($upload_path1, $image_full_name);
                // $img = Image::make($image)->resize(517, 286);
                // $img->save($upload_path1 . $image_full_name, 60);

            } else {
                $image_url = $hero_section->image;
            }

            $update = $hero_section->update([
                'title'       => $request->title,
                'description' => $request->description,
                'image'       => $image_url,
            ]);
            $strip_text = strip_tags($hero_section->description);
            $result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
            $description                            = substr($result, 0, 25);
   

            $strip_title = strip_tags($hero_section->title);
            $title_result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_title);
            $title = $title_result;


            $data                = array();
            $data['message']     = 'data updated successfully';
            $data['title']       = $title;
            $data['description'] = $description;
            $data['image']       = $image_url;
            $data['id']          = $hero_section->id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }
    public function heroSectionDelete(Request $request){
        $data = HeroSection::findOrFail($request->id);
        $data->delete();
        File::delete('backend/' . $data->image);
        $data            = array();
        $data['message'] = 'Data deleted successfully';
        $data['id']      = $request->id;
        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);

    }
}
