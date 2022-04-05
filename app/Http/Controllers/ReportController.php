<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Organizer;
use App\Models\Session;
use App\Models\SessionUser;
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



        return view('created-events-report',compact('organizers'));

    }

    public function eventReport($id){


        // $participants = EventUser::all()->where('event_id',$id);
        $event = Event::find($id);

        $participants = EventUser::where('event_id',$id)->paginate(6);


        return view('event-report',compact('participants','event'));

    }


    public function eventSessionsReport($id){

      $event_id =  $id;

      $sessions = Session::where('event_id',$event_id)->paginate(6);
      return view ('event-sessionsreport',compact('event_id','sessions'));


    }

    public function SessionReport($id){

     $session_id = $id;
     $session = Session::find($session_id);
     $participants = SessionUser::where('session_id',$session_id)->paginate(6);
     return view('session-report',compact('session','participants'));

    }


}
