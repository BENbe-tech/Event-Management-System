<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;

class TicketController extends Controller
{
    //
    public function index(){

        $user_id = session('loginId');
        $user = User::find($user_id);
        $events = $user->events;

        return view('registered-ticket',compact('events'));

    }



    public function ticket($id){

        $event_id = $id;
        $event = Event::find($event_id);
        $event_details = $event->eventDetails;
        $user_id = session('loginId');
        $user = User::find($user_id);
        \QrCode::size(200)
        ->format('png')
        ->generate('ItSolutionStuff.com', public_path('storage/ImageFolder/qrcode.png'));

        return view('ticket',compact('event','event_details','user'));

    }

    

    public function qrscanner(){

        return view('qrscanner');
    }

}
