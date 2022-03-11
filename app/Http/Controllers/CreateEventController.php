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
            'document' => 'mimes:pdf|max:2048',
            'description' => 'required',
            'entry_mode' => 'required',
        ]);



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
        // $path =  $request->file('image')->store('public/ImageFolder');
    }else{
        $filename = null;
        $name =null;
    }
        if($request->hasFile('document')){
        $namedoc = $request->file('document')->getClientOriginalName();

        $docfile = $request->file('document');
        $docname = time().'.'.$docfile->getClientOriginalExtension();
        $docfile->move('storage/DocumentFolder/',$docname);
        // $pathdoc =  $request->file('document')->store('public/DocumentFolder');

         }else{
             $namedoc = null;
             $docname = null;
         }
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
        $res = $eventdetail->save();
    }

        if($res){
            // return back()->with('success','You have registerd successfully');
            return redirect('myevents');

        }else{
             return back()->with('fail', 'something wrong');
        }

     }


    }

