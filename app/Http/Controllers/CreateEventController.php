<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventDetail;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CreateEventController extends Controller
{
    //
    public function index(){

        return view('create-event');
    }

    public function createEvent(Request $request){

        $request->validate([
            'eventtitle' => 'required',
            'organizer'=>'required',
            'category' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'document' => 'required|mimes:pdf|max:2048',
            'description' => 'required',
            'entry_mode' => 'required',
        ]);

        // $event = new Event();
        // $event->event_title = $request->eventtitle;
        // $event->organizer_id = $request->organizer;
        // $eventres = $event->save();

        $eventid = Event::insertGetId(
	        ['event_title' => $request->eventtitle,'organizer_id' => $request->organizer]
	    );
        echo $eventid;

        if($eventid != ""){
        // $eventfetch = DB::table('events')
        // ->where('event_title','=',$request->eventtitle)
        // ->where('organizer_id' ,'=',$request->organizer)
        // ->first('id');
        // echo $eventfetch;

        // $eventfetch = DB::select('select id from events where event_title = ? and organizer_id = ?',[$request->eventtitle,$request->organizer]);
        // $eventfetch = Event::firstWhere('event_title','organizer_id',[$request->eventtitle,$request->organizer]);

        // echo $eventfetch->id;

        $name = $request->file('image')->getClientOriginalName();
        $path =  $request->file('image')->store('public/ImageFolder');

        $namedoc = $request->file('document')->getClientOriginalName();
        $pathdoc =  $request->file('document')->store('public/DocumentFolder');

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
        $eventdetail->image_path = $path;
        $eventdetail->document_name = $namedoc;
        $eventdetail->document_path = $pathdoc;
        $eventdetail->entry_mode =$request->entry_mode;
        $eventdetail ->price = $request->price;
        $eventdetail->description =$request->description ;
        $eventdetail->speaker=$request->speaker;
        $res = $eventdetail->save();
    }

        if($res){
            // return back()->with('success','You have registerd successfully');
            return redirect('dashboard');

        }else{
             return back()->with('fail', 'something wrong');
        }

     }


    }

