<?php

namespace App\Http\Controllers;

use Spatie\GoogleCalendar\Event;
use Spatie\GoogleCalendar\GoogleCalendarServiceProvider;
use Carbon\Carbon;
use App\Models\EventDetail;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //

    public function index(Request $request){


    }


  public function Calendar($title,$id){

      $eventdetails_id = $id;
      $eventdetails =  EventDetail::find( $eventdetails_id );
    //   $user_id = session('loginId');
    //   $user = User::find($user_id);
    //   $email = $user->email;
      $starttime = $eventdetails->starttime;
      $endtime = $eventdetails->endtime;

 if($endtime > $starttime){

        $event = new Event;

        $event->name = $title;
        $event->startDateTime =Carbon::parse( $starttime,'Africa/Dar_es_Salaam');
        $event->endDateTime = Carbon::parse($endtime,'Africa/Dar_es_Salaam');
       // $event->addAttendee(['email' => $email]);

       $res =  $event->save();

       if($res){


        return response()->json(['success'=>'Event added to calendar successfully']);

    }
       else{


        return response()->json(['success'=>'Event not added to calendar']);
       }
    }else{

        return response()->json(['success'=>'Failed to add event to calendar']);
    }


  }




}
