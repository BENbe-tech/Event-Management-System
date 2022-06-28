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
use App\Mail\FreeTicketMail;
use App\Models\EventDetail;
use App\Models\EventUser;
use App\Models\SessionUser;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisteredEventsController extends Controller
{
    //function index displays all event registered to the user

    public function index(){

        $user_id = session('loginId');
        $user = User::find($user_id);
        $events = $user->events;

        return view('registered-events',compact('events'));


    }

    public function schedule(){

        $user_id = session('loginId');
        $user = User::find($user_id);
        $events = $user->events;

        return view('schedule', compact('events'));

    }


// funtion participants registers the partcipant of the event to the table event_user
    public function participants($event_id,$user_id){

        $user_id = session('loginId');
        if($user_id != ""){


        $event = Event::find($event_id);
        $event_details = $event->eventDetails;
        $end_date = $event_details->endtime;
        $time = Carbon::now();

        if($end_date > $time){

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
        $entry_mode = $event_details->entry_mode;

       $link = url('ticket/'.$event_id);

      if($entry_mode == "paid"){

        $details = [
            'title' => 'Dear '. $name.',',
        //  'body' => 'You have registered for '. $event_title.' event which will commence on '.$start_date.' as planned',
            'body1' => 'You have registered for ',
            'body2' => ' event which will commence on ',
            'body3' => ' as planned. Verify on our page for attendance,one day before the event commence',
            'event_title' => $event_title,
            'date' => $start_date,
       ];

       Mail::to($email)->send(new TestMail($details));

    }

    if($entry_mode == "free"){




        $time = time();
        $qr = md5($time);

        $ticket = Ticket::all()->where('event_id', $event_id)->pluck('reference_no');
        $count = count($ticket);

        if($ticket == "[]")

        {
             $number = 1;
        }else{
            $number = $ticket[$count-1] + 1 ;
        }

        $ticket = new Ticket();
        $ticket->barcode_no = $qr;
        $ticket->event_id = $event_id;
        $ticket->user_id = $user_id;
        $ticket->amount   =  "free";
        $ticket->reference_no = $number;

        $ticket->save();


        $details = [
            'title' => 'Dear '. $name.',',

            'body1' => 'You have registered for ',
            'body2' => ' event which will commence on ',
            'body3' => ' as planned. Verify on our page for attendance,one day before the event commence',
            'event_title' => $event_title,
            'date' => $start_date,
            'link' => $link,
       ];

       Mail::to($email)->send(new FreeTicketMail($details));

    }



    //    echo "success";
        return response()->json(['success'=>'You have registered successfuly to this event']);
        }
    }
    else{
        return response()->json(['success'=>'The event has arleady ended']);
//    echo "already";
    }
    }
    else{
// echo "failed";

        return response()->json(['success'=>'Failed to register, login first']);
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
            // 'https://polar-retreat-83406.herokuapp.com/registered-events',
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


     public function registeredSessions($id){

        // $event = Event::find($id);
        // $sessions = $event->sessions;
        $user_id = session('loginId');
        $sessions = SessionUser::all()->where('user_id',$user_id);

        // $sessions = Session::all()->where('event_id',$id);
        $count = $sessions->count();


         return view('participant-sessions',compact('sessions','count','user_id','id'));

     }





     public function showsessiondetails($id){

         $session = Session::find($id);
         $sessiondetails = $session->sessionDetails;
         $event = $session->event;


          return view('registered-sessiondetails',compact('session','sessiondetails','event'));

      }



      public function showsessiondetails2($id){

        $session = Session::find($id);
        $sessiondetails = $session->sessionDetails;
        $event = $session->event;


         return view('registered-sessiondetails2',compact('session','sessiondetails','event'));

     }


      public function download(Request $request,$file){

         return response()->download(public_path('storage/SessionDocuments/'.$file));
       }


       public function verify($id){

        $user_id = session('loginId');
        $event = Event::find($id);
        $event_detail = EventDetail::find($event->id);
        $start = $event_detail->starttime;
        $currentDateTime = Carbon::now();
        $newDateTime = $currentDateTime ->addHour(24);

        if($start > $newDateTime){


        $participant = DB::table('event_user')->where('event_id',$id)
        ->where('user_id',$user_id)->get();


            if($participant!=[]){
                $participant_id = $participant[0]->id;
                $participant = EventUser::find($participant_id);
              }
              else{

                  return response()->json(['success'=>'failed to verify register for event first']);
              }

            $verify_id =  $participant->verify_attendance;
            if($verify_id == NULL){

            $participant->verify_attendance = 1;
            $res_event =   $participant->update();
            if($res_event){

             return response()->json(['success'=>'verified attendance successfully']);
            }
            else{

                return response()->json(['success'=>'failed to verify']);
            }
           }
            else{

                return response()->json(['success'=>'you have already verified']);
            }

        }

        else{

            return response()->json(['success'=>'you can only verify for event attendance one day before the event']);
        }



       }








       public function verifyMode(Request $request){

        $request->validate([
             'mode' => 'required',
        ]);

        $id = $request->event_id;
        $user_id = session('loginId');

        // $mode = EventUser::all()->where('user_id',$user_id)->where('event_id',$id);
        // $mode->attendance_mode = $request->input('mode');
        // $mode->update();

        $event = Event::find($id);
        $event_detail = EventDetail::all()->where('event_id',$event->id)->pluck('starttime');

        $start = $event_detail[0];
        $currentDateTime = Carbon::now();
        $newDateTime = $currentDateTime ->addHour(24);

        if($start > $newDateTime){


        $participant = DB::table('event_user')->where('event_id',$id)
        ->where('user_id',$user_id)->get();


            if($participant!="[]"){

                $participant_id = $participant[0]->id;
                $participant = EventUser::find($participant_id);
              }
              else{

                  return response()->json(['success'=>'failed to verify register for event first']);
                //   return back()->with('fail','failed to verify register for event first');
              }

            $verify_id =  $participant->verify_attendance;
            if($verify_id == NULL){

            $participant->verify_attendance = 1;
            $participant->attendance_mode = $request->input('mode');
            $res_event =   $participant->update();
            if($res_event){

             return response()->json(['success'=>'verified attendance successfully']);
            //  return back()->with('success','verified attendance successfully');
            }
            else{

                return response()->json(['success'=>'failed to verify']);
                // return back()->with('fail','failed to verify');
            }
           }
            else{

                return response()->json(['success'=>'you have already verified']);
                // return back()->with('success','you have already verified');
            }

        }

        else{

            return response()->json(['success'=>'you can only verify for event attendance atmost one day before the event']);
            // return back()->with('fail','you can only verify for event attendance atmost one day before the event');
        }



       }


}
