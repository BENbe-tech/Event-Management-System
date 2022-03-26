<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use Jorenvh\Share\Share;

class MyEventsController extends Controller
{
//function index returns the events created when myevent option is selected
    public function myevent(){

    return view('myevents');

}

 //The index function is called when event title is selected at my created event table
    //and display eventdetails of the slected event
    public function index($id){

        $event_details =EventDetail::all()-> where('event_id',$id);
        $event = Event::find($id);
        $event_detail = $event->eventDetails;
        $organizer = $event->organizers;

        $shareComponent = \Share::page(
            // 'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
           'http://127.0.0.1:8000/myeventdetails/33',
            'Open this event',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();


        return view('myeventdetails',compact('event_detail','organizer','event','shareComponent'));

    }
//The download function is called when downloading document of the event
    public function download(Request $request,$file){

      return response()->download(public_path('storage/DocumentFolder/'.$file));
    }


}
