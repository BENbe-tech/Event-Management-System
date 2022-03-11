<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;

class MyEventDetailsController extends Controller
{
    //
    public function index($id){

        $event_details =EventDetail::all()-> where('event_id',$id);
    //  echo $event_details[0]->id;
        return view('myeventdetails',compact('event_details'));

    }

    public function download(Request $request,$file){

      return response()->download(public_path('storage/DocumentFolder/'.$file));
    }

}
