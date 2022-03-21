<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionDetail;
use App\Models\Session;
use App\Models\Event;

class SessionController extends Controller
{
    //

    public function index($id){


        return view('createsession',compact('id'));

    }



    public function createSession(Request $request){

        $request->validate([
            'sessiontitle' => 'required',
            'date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'document' => 'mimes:pdf|max:4096',

        ]);

        //insertGetId used to get ID of inserted session

        $session_id = Session::insertGetId(
	        ['name' => $request->sessiontitle,'event_id' => $request->event_id]
	    );


        if($session_id != ""){

        if($request->hasFile('document')){
            $namedoc = $request->file('document')->getClientOriginalName();

            $docfile = $request->file('document');
            $docname = time().'.'.$docfile->getClientOriginalExtension();
            $docfile->move('storage/SessionDocuments/',$docname);
            // $pathdoc =  $request->file('document')->store('public/SessionDocuments');

             }else{
                 $namedoc = null;
                 $docname = null;
             }


       $sessiondetail = new SessionDetail();
       $sessiondetail->description = $request->description;
       $sessiondetail->date = $request->date;
       $sessiondetail->start_time = $request->start_time;
       $sessiondetail->end_time = $request->end_time;
       $sessiondetail->online_link = $request->link;
       $sessiondetail->document_name = $namedoc;
       $sessiondetail->document_path = $docname ;
       $sessiondetail->venue = $request->venue;
       $sessiondetail->speaker = $request->speaker;
       $sessiondetail->session_id = $session_id;

       $res = $sessiondetail->save();
   }


   if($res){
    return back()->with('success','Session created successfully');
    return redirect('myevents');

}else{
     return back()->with('fail', 'something wrong');
}

}

public function showsessions($id){

   $sessions = Session::all()->where('event_id',$id);
   $count = $sessions->count();

    return view('session',compact('sessions','count'));

}

public function showsessiondetails($id){

    $session = Session::find($id);
    $sessiondetails = $session->sessionDetails;

     return view('sessiondetails',compact('session','sessiondetails'));

 }


 public function download(Request $request,$file){

    return response()->download(public_path('storage/SessionDocuments/'.$file));
  }



}
