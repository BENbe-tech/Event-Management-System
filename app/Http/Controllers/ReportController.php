<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(){

        $user_id    = session('loginId');
        $user       = User::find($user_id);
        $organizers  = $user->organizers;

    
        $events = Event::all();



        return view('event-report',compact('organizers'));

    }


}
