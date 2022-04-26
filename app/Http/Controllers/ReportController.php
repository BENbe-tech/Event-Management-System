<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Organizer;
use App\Models\Session;
use App\Models\SessionUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Charts\EventChart;

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


    public function GraphChart(){

       $user_id    = session('loginId');
       $organizer_id =   Organizer::all()->where('user_id',$user_id)->pluck('id');
       $event_title = Event::all()->whereIn('organizer_id',$organizer_id)->pluck('event_title');
       echo $event_title;
       $event_id = Event::all()->whereIn('organizer_id',$organizer_id)->pluck('id');
       echo $event_id;
      $participants = EventUser::all()->whereIn('event_id',$event_id);
      echo $participants;


      $chart = new EventChart;
      $chart->labels([$event_title]);
      $chart->dataset('participants',[3,4,5]);

        return view('event-graph-report');
    }


}
