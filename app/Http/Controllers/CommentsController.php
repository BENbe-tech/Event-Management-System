<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentsController extends Controller
{
    //
    public function participantComments($id){



    $comments = Comment::all()->where('event_id',$id);



        return view('participants-comments',compact('id','comments'));
    }

    public function PostComments(Request $request){

        $request->validate([

            'message' => 'required',
            'user_id' => 'required',
            'event_id'=> 'required',

        ]);

        $comment = new Comment();
        $comment->message = $request->message;
        $comment->user_id = $request->user_id;
        $comment->event_id= $request->event_id;
        $comment->created_ats= Carbon::now();
        $res = $comment->save();

        if($res){
            return response()->json(['success'=>'commented']);
        }

    }

}
