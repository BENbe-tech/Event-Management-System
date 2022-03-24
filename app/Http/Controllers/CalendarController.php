<?php

namespace App\Http\Controllers;

use Spatie\GoogleCalendar\Event;
use Spatie\GoogleCalendar\GoogleCalendarServiceProvider;
use Carbon\Carbon;
use App\Models\EventDetail;
use App\Models\User;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //

    public function index(Request $request){


    }



    public function MyeventCalendar($id){




    }

  public function RegisteredeventCalendar($title,$id){

      $eventdetails_id = $id;
      $eventdetails =  EventDetail::find( $eventdetails_id );
      $user_id = session('loginId');
      $user = User::find($user_id);
      $email = $user->email;
      $starttime = $eventdetails->starttime;
      $endtime = $eventdetails->endtime;
//    $eventdetails = $event->eventDetails;



        $event = new Event;

        $event->name = $title;
        $event->startDateTime =Carbon::parse( $starttime,'Africa/Dar_es_Salaam');
        $event->endDateTime = Carbon::parse($endtime,'Africa/Dar_es_Salaam');
        // $event->addAttendee(['email' => $email]);

        $event->save();


        // $e = Event::get();
        // dd($e);
        echo $email;
        echo $title;
        echo $starttime;
        echo $endtime;


  }



  public function HomeeventCalendar($id){



  }
}
