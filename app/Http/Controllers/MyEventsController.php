<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\File;

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


    public function delete($id){

        $event = Event::find($id);
        if($event !=""){

             DB::delete('delete from events where id = ?',[$id]);
             return response()->json(['success'=>'Event deleted successful']);
        }else{

            return response()->json(['success'=>'Event Already deleted']);
        }



    }

    public function edit($id){

     $event = Event::find($id);


     $organizer_id = $event->organizer_id;

     $organizers = Organizer::find($organizer_id);


     $event_details = $event->eventDetails;

        return view('edit-event',compact('event','organizers','event_details'));

    }


    public function update(Request $request){


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


        $event_id    = $request->input('event_id');
        $eventdetails_id  = $request->input('eventdetails_id');


        $event = Event::find($event_id);
        $event->event_title = $request->input('eventtitle');
        $event->organizer_id =  $request->input('organizer');
        $res_event =   $event->update();


       if($res_event){

        $eventdetails = EventDetail::find( $eventdetails_id);

        if($request->hasFile('image')){

          $destination = 'storage/ImageFolder/'.$eventdetails->image_path;

            if(File::exists($destination)){
               File::delete($destination);
            }

            $name = $request->file('image')->getClientOriginalName();
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('storage/ImageFolder/', $filename);

        }

        if($request->hasFile('document')){

        $destination = 'storage/DocumentFolder/'.$eventdetails->document_path;

        if(File::exists($destination)){
            File::delete($destination);
         }

            $namedoc = $request->file('document')->getClientOriginalName();

            $docfile = $request->file('document');
            $docname = time().'.'.$docfile->getClientOriginalExtension();
            $docfile->move('storage/DocumentFolder/', $docname);

        }


        $eventdetails->category =        $request->input('category');
        $eventdetails->online_link =     $request->input('link');
        $eventdetails->venue =           $request->input('venue');
        $eventdetails->city =            $request->input('city');
        $eventdetails->address =         $request->input('address');
        $eventdetails->starttime=        $request->input('start_date');
        $eventdetails->endtime =         $request->input('end_date');
        $eventdetails->price=            $request->input('price');
        $eventdetails->description =     $request->input('description');
        $eventdetails->image_name =      $name;
        $eventdetails->image_path =      $filename;
        $eventdetails->document_name =   $namedoc;
        $eventdetails->document_path =   $docname;
        $eventdetails->entry_mode =      $request->input('entry_mode');
        $eventdetails->speaker =         $request->input('speaker');
        $eventdetails->event_id =        $request->input('event_id');

        $eventdetails->update();



       return back()->with('success','Event Updated successfully');
    }
    else{
        return back()->with('fail','Failed to Update event');
    }
    }

}
