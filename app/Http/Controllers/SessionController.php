<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionDetail;
use App\Models\Session;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    return view('session',compact('sessions','count','id'));

}

public function showsessiondetails($id,$event_id){

    $session = Session::find($id);
    $sessiondetails = $session->sessionDetails;

     return view('sessiondetails',compact('session','sessiondetails','event_id'));

 }


 public function download(Request $request,$file){

    return response()->download(public_path('storage/SessionDocuments/'.$file));
  }


  public function delete($id){

    $event = Session::find($id);
    if($event !=""){

         DB::delete('delete from sessions where id = ?',[$id]);
         return response()->json(['success'=>'Session deleted successful']);
    }else{

        return response()->json(['success'=>'Session Already deleted']);
    }



}


public function edit($id,$event_id){

    $session = Session::find($id);

    $session_details = $session->sessionDetails;

       return view('edit-session',compact('session','session_details','id','event_id'));

   }


   public function update(Request $request){


    $request->validate([
        'sessiontitle' => 'required',
        'start_time'=>'required',
        'end_time' => 'required',
        'date'=>'required',
        'document' => 'mimes:pdf|max:4096',

    ]);


    $session_id    = $request->input('session_id');
    $sessiondetails_id  = $request->input('sessiondetails_id');


    $session = Session::find($session_id);
    $session->name = $request->input('sessiontitle');

    $res_session =   $session->update();


   if($res_session){

    $sessiondetails = SessionDetail::find( $sessiondetails_id);

    if($request->hasFile('document')){

    $destination = 'storage/SessionDocument/'.$sessiondetails->document_path;

    if(File::exists($destination)){
        File::delete($destination);
     }

        $namedoc = $request->file('document')->getClientOriginalName();

        $docfile = $request->file('document');
        $docname = time().'.'.$docfile->getClientOriginalExtension();
        $docfile->move('storage/SessionDocument/', $docname);

    }else{

        $namedoc = null;
        $docname = null;

    }



    $sessiondetails->online_link =     $request->input('link');
    $sessiondetails->venue =           $request->input('venue');

    $sessiondetails->start_time=        $request->input('start_time');
    $sessiondetails->end_time =         $request->input('end_time');
    $sessiondetails->date=            $request->input('date');
    $sessiondetails->description =     $request->input('description');

    $sessiondetails->document_name =   $namedoc;
    $sessiondetails->document_path =   $docname;
    $sessiondetails->speaker =         $request->input('speaker');
    $sessiondetails->session_id =        $request->input('session_id');

    $sessiondetails->update();



   return back()->with('success','Session Updated successfully');
}
else{
    return back()->with('fail','Failed to Update Session');
}
}



}
