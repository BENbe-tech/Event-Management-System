<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;

class MyEventsController extends Controller
{
    //
    public function index(){

        $organizer_id = Organizer::all()->where('user_id',session('loginId'))->pluck('id');
        // echo   $organizer_id[0];
        // echo $organizer_id->count();
        // $organizer_length =  $organizer_id->count();

        $event_titles =Event::all()-> whereIn('organizer_id',$organizer_id)->pluck('event_title');
        $event_id     =Event::all()-> whereIn('organizer_id',$organizer_id)->pluck('id');
        // echo $event_id;
        // echo $event_title;

        $event_details = EventDetail::all()->whereIn('event_id',$event_id);
        // echo $event_details;

//   return view('myevents',compact('event_titles','event_details'));

    // return view('myevents',compact('organizer_id'));

    return view('myevents');

}
}
