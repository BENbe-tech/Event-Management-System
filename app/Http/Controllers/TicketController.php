<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;


class TicketController extends Controller
{
    //
    public function index(){

        $user_id = session('loginId');
        $user = User::find($user_id);
        $events = $user->events;

        return view('registered-ticket',compact('events','user_id'));

    }



    public function ticket($id){

        $event_id = $id;
        $event = Event::find($event_id);
        $event_details = $event->eventDetails;
        $user_id = session('loginId');
        $user = User::find($user_id);

        // \QrCode::size(200)
        // ->format('png')
        // ->generate('ItSolutionStuff.com', public_path('storage/ImageFolder/qrcode.png'));

        $ticket = Ticket::all()->where('event_id', $event_id)->where('user_id',$user_id)->pluck('reference_no');


        if($ticket == "[]")
        {
          $number = "None";
        }else{
        $number = $ticket[0];
         }

        $link = url('ticket/'.$event_id);

        $time = time();

        $qr = md5($time);


        return view('ticket',compact('event','event_details','user','qr','number','link'));

    }



    public function qrscanner(){

        return view('qrscanner');
    }

}
