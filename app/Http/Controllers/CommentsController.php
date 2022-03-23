<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function participantComments($id){

        return view('participant-comments',compact('id'));
    }

}
