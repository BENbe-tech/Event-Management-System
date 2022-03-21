<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\SessionDetail;
use App\Models\Session;

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

            return back()->with('fail','You have already registered');
        }
        else{
        $event = Event::find($event_id);

        $event->users()->attach($user_id);

        return redirect('registered-events');
        }
    }

    //function that deplays event details of registered events
    public function eventdetails($id){

        $event = Event::find($id);

        $organizer = $event->organizers;

        $event_detail = $event->eventDetails;

        // echo $event;
        // echo $organizer;
        // echo $event_detail->image_path;


        return view('registered-eventdetails',compact('event','organizer','event_detail'));
    }


    public function showsessions($id){

        $sessions = Session::all()->where('event_id',$id);
        $count = $sessions->count();

         return view('registered-sessions',compact('sessions','count'));

     }

     public function showsessiondetails($id){

         $session = Session::find($id);
         $sessiondetails = $session->sessionDetails;


          return view('registered-sessiondetails',compact('session','sessiondetails'));

      }


      public function download(Request $request,$file){

         return response()->download(public_path('storage/SessionDocuments/'.$file));
       }



}
