<?php

namespace App\Http\Controllers;

use App\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BoardMemberController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'board_member_name' => 'required|max:80',
            'board_member_designation' => 'required|max:80',
            'board_member_image' => 'required|max:600|mimes:jpg,png,jpeg',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $image = $request->board_member_image;
            if ($image) {
                $image_name = hexdec(uniqid());
                $ext        = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $ext;
                $upload_path1    = 'images/board-member/';
                $image_url       = $upload_path1 . $image_full_name;
                $success         = $image->move($upload_path1, $image_full_name);

            }
            $member = new BoardMember();
            $member->board_member_name = $request->board_member_name;
            $member->board_member_designation = $request->board_member_designation;
            $member->board_member_image = $image_url;

            if($member->save()){
                return response()->json(['status'=>true,'data' => $member]);
            }
        }
    }
    public function edit($id)
    {
        $data  = BoardMember::find($id);
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
            'board_member_name' => 'required|max:80',
            'board_member_designation' => 'required|max:80',
            'board_member_image' => 'nullable|max:600|mimes:jpg,png,jpeg',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=> 0,'error'=>$validator->errors()->toArray()]);
        }else{
            $member = BoardMember::find($request->category_id);
            $image = $request->board_member_image;
            if ($image) {
                File::delete($member->board_member_image);
                $image_name = hexdec(uniqid());
                $ext        = strtolower($image->getClientOriginalExtension());

                $image_full_name = $image_name . '.' . $ext;
                $upload_path1    = 'images/board-member/';
                $image_url       = $upload_path1 . $image_full_name;
                $success         = $image->move($upload_path1, $image_full_name);

            }else{
                $image_url = $member->board_member_image;
            }
            $member->board_member_name = $request->board_member_name;
            $member->board_member_designation = $request->board_member_designation;
            $member->board_member_image = $image_url;

            if($member->save()){
                return response()->json(['status'=>true]);
            }
        }
    }


    public function destroy(Request $request){
        $member = BoardMember::find($request->id);
        if($member->delete()){
            File::delete($member->board_member_image);
            return response()->json(['success'=>true,'data'=>$member]);
        }
    }


    public function viewBoardMember($id){
        $data=BoardMember::find($id);
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
