<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDetail;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;
use  App\Models\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\SessionDetail;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function Users(){

        $users =User::all();

        return response()->json($users);


    }

    public function User($id){

        $users =User::all()->where('id',$id);

        return response()->json($users);


    }

    public function Events(){

        $events =Event::all();

        return response()->json($events);


    }


    public function Event($id){

        $event =Event::all()->where('id',$id);

        return response()->json($event);


    }



    public function Eventdetails(){

        $eventdetails =EventDetail::all();

        return response()->json($eventdetails);


    }



    public function Eventdetail($id){

        $eventdetail =EventDetail::all()->where('event_id',$id);

        return response()->json($eventdetail);


    }




    public function registerUser(Request $request){

        $request->validate([
            'name' => 'required',
            'email'=>'required|email|unique:users',
           'password' =>'required|min:8|confirmed',
           'password_confirmation' => 'required',
           'phone' => 'required|min:10',

        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if($res){

            return response()->json(['success'=>"Successfully Registered"]);

        }else{

             return response()->json(['fail'=>"Failed to Register"]);
        }

     }



     public function loginUser(Request $request){

        $request->validate([

            'email'=>'required|email',
           'password' =>'required|min:8',

        ]);
          $user = User::where('email', '=', $request->email)->first();
          if($user){
             if(Hash::check($request->password,$user->password)){

                 $session_key =  md5(time());

                 $log = new Log();
                 $log->name  = $user->name;
                 $log->user_id = $user->id;
                 $log->session_key = $session_key;

                 $log->save();
                //  $user_session = $user->id;

                 return response()->json(['session_key' => $session_key]);

             } else {

                 return response()->json(['info'=>'Password not matches.']);
             }
            }
            else{

                return response()->json(['fail'=>'This email is not registered']);
          }
    }



    public function logout($session_key){

        $log = Log::all()->where('session_key',$session_key);

        if($log != "[]"){

            DB::delete('delete from logs where session_key = ?',[$session_key]);
            return response()->json(['success'=>'Logged out successfully']);

        }
        else{
            return response()->json(['fail'=>'Failed to log out or wrong session key']);
        }

    }







    public function createEvent(Request $request){



        $request->validate([
            'eventtitle' => 'required',
            'organizer'=>'required',
            'category' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'document' => 'mimes:pdf|max:4096',
            'description' => 'required',
            'entry_mode' => 'required',
        ]);


          $startdate = $request->start_date;
          $enddate= $request->end_date;

       if($startdate >= $enddate){



        return response()->json(['info'=>'starttime cannot be greater than endtime']);
       }

        $eventid = Event::insertGetId(
	        ['event_title' => $request->eventtitle,'organizer_id' => $request->organizer]
	    );


        if($eventid != ""){

      if($request->hasFile('image')){

        $name = $request->file('image')->getClientOriginalName();
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('storage/ImageFolder/',$filename);

    }else{
        $filename = null;
        $name =null;
    }
        if($request->hasFile('document')){
        $namedoc = $request->file('document')->getClientOriginalName();

        $docfile = $request->file('document');
        $docname = time().'.'.$docfile->getClientOriginalExtension();
        $docfile->move('storage/DocumentFolder/',$docname);


         }else{
             $namedoc = null;
             $docname = null;
         }
         $createddate = Carbon::now();
        $eventdetail = new EventDetail();
        $eventdetail->category = $request->category;
        $eventdetail->venue = $request->venue;
        $eventdetail->online_link = $request->link;
        $eventdetail->city = $request->city;
        $eventdetail->address = $request->address;
        $eventdetail->starttime = $request->start_date;
        $eventdetail->endtime= $request->end_date;
        $eventdetail->event_id= $eventid;
        $eventdetail->image_name = $name;
        $eventdetail->image_path = $filename ;
        $eventdetail->document_name = $namedoc;
        $eventdetail->document_path = $docname ;
        $eventdetail->entry_mode =$request->entry_mode;
        $eventdetail ->price = $request->price;
        $eventdetail->description =$request->description ;
        $eventdetail->speaker=$request->speaker;
        $eventdetail->speaker_profile= $request->profile;
        $eventdetail->startmonth = substr( $request->start_date , 6, 1);
        $eventdetail->startyear = substr( $request->start_date , 0, 4);
        $eventdetail->createdmonth = substr( $createddate , 6, 1);
        $eventdetail->createdyear =substr( $createddate, 0, 4) ;

        $res = $eventdetail->save();
    }

        if($res){


            return response()->json(['success'=>'You have registerd successfully']);

        }else{

             return response()->json(['fail'=>'something wrong']);

        }

     }




     public function participants($event_id,$user_id){


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


            return response()->json(['info'=>'You have already registered']);
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

            'body1' => 'You have registered for ',
            'body2' => ' event which will commence on ',
            'body3' => ' as planned. Verify on our page for attendance,one day before the event commence',
            'event_title' => $event_title,
            'date' => $start_date,
       ];

          Mail::to($email)->send(new TestMail($details));


        return response()->json(['success'=>'You have registered successfuly to this event']);
        }
    }
    else{
        return response()->json(['fail'=>'The event has arleady ended']);
    }
    }
    else{

        return response()->json(['fail'=>'Failed to register, login first']);
    }
    }





    public function createSession(Request $request){

        $request->validate([
            'sessiontitle' => 'required',
            'date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'document' => 'mimes:pdf|max:4096',

        ]);

        //insertGetId used to get ID of inserted session

        $session_id = Session::insertGetId(
	        ['name' => $request->sessiontitle,'event_id' => $request->event_id]
	    );


        if($session_id != ""){

        if($request->hasFile('document')){
            $namedoc = $request->file('document')->getClientOriginalName();

            $docfile = $request->file('document');
            $docname = time().'.'.$docfile->getClientOriginalExtension();
            $docfile->move('storage/SessionDocuments/',$docname);


             }else{
                 $namedoc = null;
                 $docname = null;
             }


       $sessiondetail = new SessionDetail();
       $sessiondetail->description = $request->description;
       $sessiondetail->date = $request->date;
       $sessiondetail->start_time = $request->start_time;
       $sessiondetail->end_time = $request->end_time;
       $sessiondetail->online_link = $request->link;
       $sessiondetail->document_name = $namedoc;
       $sessiondetail->document_path = $docname ;
       $sessiondetail->venue = $request->venue;
       $sessiondetail->speaker = $request->speaker;
       $sessiondetail->speaker_profile = $request->profile;
       $sessiondetail->session_id = $session_id;

       $res = $sessiondetail->save();
   }


   if($res){

    return response()->json(['success'=>'Session created successfully']);


}else{

     return response()->json(['fail'=>'Something went wrong']);
}

}



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



        return response()->json(['success'=>'You have already registered in the session']);

        }else{
        $session = Session::find($session_id);
        $session->users()->attach($user_id);



        return response()->json(['success'=>'You have registered in this session successful']);
        }

    }else{

        return response()->json(['success'=>'You have not registered in the event']);
    }

}




}
