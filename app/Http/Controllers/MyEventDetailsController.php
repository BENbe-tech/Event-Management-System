<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;

class MyEventDetailsController extends Controller
{
    //The index function is called when event title is selected at my created event table
    //and display eventdetails of the slected event
    public function index($id){

        $event_details =EventDetail::all()-> where('event_id',$id);
        return view('myeventdetails',compact('event_details'));

    }
//The download function is called when downloading document of the event
    public function download(Request $request,$file){

      return response()->download(public_path('storage/DocumentFolder/'.$file));
    }

}
