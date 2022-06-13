<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventDetail;
use App\Models\Event;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateEventController extends Controller
{

    public function index(){


        $user_id    = session('loginId');

        $subscriptions = Subscription::all()->where('user_id',$user_id)->pluck('subscription_end');
        $time = Carbon::now();
        $flag = 0;

       foreach($subscriptions as $subscription){

         if($time < $subscription ){
           $flag = 0;
        //    $flag = 1;
         }

       }

       if($flag == 0){
        return view('create-event');
       }else{

        return redirect('organizer-payindex');
       }



    }



    //function createEvent is used to create new event

    public function createEvent(Request $request){

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

//insertGetId used to get ID of inserted event
          $startdate = $request->start_date;
          $enddate= $request->end_date;

       if($startdate >= $enddate){
        return back()->with('fail', 'starttime cannot be greater than endtime');
       }

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
         $createddate = Carbon::now();
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
        $eventdetail->speaker_profile= $request->profile;
        $eventdetail->startmonth = substr( $request->start_date , 6, 1);
        $eventdetail->startyear = substr( $request->start_date , 0, 4);
        $eventdetail->createdmonth = substr( $createddate , 6, 1);
        $eventdetail->createdyear =substr( $createddate, 0, 4) ;

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

