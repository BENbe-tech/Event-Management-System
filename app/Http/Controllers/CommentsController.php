<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\User;

class CommentsController extends Controller
{
    //
    public function participantComments($id){

    $organizer_ids = Event::all()->where('id',$id)->pluck('organizer_id');

    $organizer_id = $organizer_ids[0];
    $user_ids = Organizer::all()->where('id',$organizer_id)->pluck('user_id');
    $user_id= $user_ids[0];
    
    $comments = Comment::all()->where('event_id',$id);

    return view('participants-comments',compact('id','comments','user_id'));
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
