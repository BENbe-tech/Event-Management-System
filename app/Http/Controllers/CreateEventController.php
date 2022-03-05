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
        ]);

        $event = new Event();
        $event->event_title = $request->eventtitle;
        $event->organizer_id = $request->organizer;
        $eventres = $event->save();

        if($eventres){
        $eventfetch = DB::table('events')
        ->where('event_title','=',$request->eventtitle)
        ->where('organizer_id' ,'=',$request->organizer)
        ->get('id');
        echo $eventfetch;
        $eventdetail = new EventDetail();
        $eventdetail->category = $request->category;
        $eventdetail->venue = $request->venue;
        $eventdetail->online_link = $request->link;
        $eventdetail->city = $request->city;
        $eventdetail->address = $request->address;
        $eventdetail->starttime = $request->start_date;
        $eventdetail->endtime= $request->end_date;
        $eventdetail->event_id= $eventfetch;
        $res = $eventdetail->save();
    }

        if($res){
            // return back()->with('success','You have registerd successfully');
            return redirect('create-eventcont');

        }else{
             return back()->with('fail', 'something wrong');
        }

     }


    }

