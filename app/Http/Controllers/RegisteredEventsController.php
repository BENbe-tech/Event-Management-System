<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\SessionDetail;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\Share;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class RegisteredEventsController extends Controller
{
    //function index displays all event registered to the user

    public function index(){

        $user_id = session('loginId');
        $user = User::find($user_id);
        $events = $user->events;

        return view('registered-events',compact('events'));


    }


// funtion participants registers the partcipant of the event to the table event_user
    public function participants($event_id,$user_id){
        $event = Event::find($event_id);
        $user = $event->users->find($user_id);
           $res_event = $event->id;
           if($user!=""){
            $res_user = $user->id;
          }
          else{
              $res_user=0;
          }

        if($res_event==$event_id && $res_user==$user_id){


            return response()->json(['success'=>'You have already registered']);
        }
        else{
        $event = Event::find($event_id);

        $event->users()->attach($user_id);

        //Sending email to registerd user

        $user  = User::find($user_id);
        $email = $user->email;
        $name  = $user->name;
        $event_title = $event->event_title;
        $event_details = $event->eventDetails;
        $start_date = $event_details->starttime;


        $details = [
            'title' => 'Dear '. $name.',',
        //  'body' => 'You have registered for '. $event_title.' event which will commence on '.$start_date.' as planned',
            'body1' => 'You have registered for ',
            'body2' => ' event which will commence on ',
            'body3' => ' as planned',
            'event_title' => $event_title,
            'date' => $start_date,
       ];

          Mail::to($email)->send(new TestMail($details));

          //response

        return response()->json(['success'=>'You have registered successfuly to this event']);
        }
    }


    // function sessionParticipants registers the partcipant of the session to the table session_user
    public function sessionParticipants($event_id,$user_id,$session_id){
        $event = DB::table('event_user')->where('event_id',$event_id)
        ->where('user_id',$user_id)->get();

        if($event!=[]){

            $session = Session::find($session_id);
            $user = $session->users->find($user_id);
            $res_session = $session->id;
            if($user!=""){
            $res_user = $user->id;
                }
          else{
              $res_user=0;
             }
            if($res_session == $session_id && $res_user == $user_id){

            // return back()->with('fail','You have already registered in the session');

            return response()->json(['success'=>'You have already registered in the session']);

            }else{
            $session = Session::find($session_id);
            $session->users()->attach($user_id);
            // return back()->with('success','You have registered in this session successful');


            return response()->json(['success'=>'You have registered in this session successful']);
            }

        }else{
            // return back()->with('fail','You have not registered in the event');
            return response()->json(['success'=>'You have not registered in the event']);
        }

    }


    //function that deplays event details of registered events
    public function eventdetails($id){

        $event = Event::find($id);

        $organizer = $event->organizers;

        $event_detail = $event->eventDetails;

        $shareComponent = \Share::page(
            // 'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
           'http://127.0.0.1:8000/eventdetails/33',
            'Open this event',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();


        return view('registered-eventdetails',compact('event','organizer','event_detail','shareComponent'));
    }


    public function showsessions($id){

        $sessions = Session::all()->where('event_id',$id);
        $count = $sessions->count();

         return view('registered-sessions',compact('sessions','count'));

     }

     public function showsessiondetails($id){

         $session = Session::find($id);
         $sessiondetails = $session->sessionDetails;
         $event = $session->event;


          return view('registered-sessiondetails',compact('session','sessiondetails','event'));

      }


      public function download(Request $request,$file){

         return response()->download(public_path('storage/SessionDocuments/'.$file));
       }



}
