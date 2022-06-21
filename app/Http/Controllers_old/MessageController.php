<?php

namespace App\Http\Controllers;

use App\MessageView;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function edit($id)
    {
        $data  = MessageView::find($id);
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
    public function destroy(Request $request){
        $message = MessageView::find($request->id);
        if($message->delete()){
            return response()->json(['success'=>true,'data'=>$message]);
        }
    }

    public function viewMessage($id){
        $data=MessageView::find($id);
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
