<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\SessionUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\File;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

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

        }else{

            $filename = null;
            $name =null;
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

        }else{

            $namedoc = null;
            $docname = null;

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
        $eventdetails->speaker_profile=  $request->input('profile');
        $eventdetails->update();



       return back()->with('success','Event Updated successfully');
    }
    else{
        return back()->with('fail','Failed to Update event');
    }
    }

    public function sendnotification($id){



        $user_id = EventUser::all()->where('event_id',$id)->pluck('user_id');

        $users = User::all()->whereIn('id',$user_id);

        $event_title = Event::all()->where('id',$id)->pluck('event_title');

        $event_starttime = EventDetail::all()->where('event_id',$id)->pluck('starttime');
        $event_venue = EventDetail::all()->where('event_id',$id)->pluck('venue');

        $currentDateTime = Carbon::now();
        $newDateTime = $currentDateTime ->addHours(2);


        if($event_starttime[0] >= $newDateTime){

  foreach($users as $user){


     $details = [

            'greeting' =>'Dear '. $user->name . ',',
            'body' => $event_title[0]. ' will begin soon, on '. $event_starttime[0] .' at ' . $event_venue[0],
            'actiontext' => 'View the event',
            'actionurl' => route('eventdetails', $id),

        ];

        Notification::send($user, new SendEmailNotification($details));

    }
        return response()->json(['success'=>'Reminder notifications sent']);
        }

        else{
            return response()->json(['success'=>'You can only set reminder before the event starts']);
        }
    }


   public function notifyIndex($id){

    return view('notify',compact('id'));
   }


   public function notifySessionIndex($session_id,$event_id){

    return view('session-notify',compact('session_id','event_id'));
   }


    public function saveToken(Request $request)

    {
        $user_id = session('loginId');

        $userdetails = User::find( $user_id);



        $userdetails->device_token =  $request->token;

        $userdetails->update();


        return response()->json(['Notification allowed successful.']);
    }


    public function pushNotification(Request $request)
    {

        $request->validate([

            'title' => 'required',
            'body'=>'required',
            'event_id'=>'required',

        ]);

        $id = $request->event_id;
        $user_id = EventUser::all()->where('event_id',$id)->pluck('user_id');

        $firebaseToken = User::whereIn('id',$user_id)->whereNotNull('device_token')->pluck('device_token')->all();

        // foreach($users as $user ){
        //     echo $user . "<br>";
        // }

    //     $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

    //     foreach($firebaseToken as $token){
    //     echo $token . "<br>";
    // }

        $SERVER_API_KEY = 'AAAARQ-JPfc:APA91bHYb6hONyGduxFNHSp8JVLCVihnX2LL_e-J7b1bw8Cfp-fX376K-U_mx0Lmxz5UfylpOgoARg794sktn-Hbcf-MIxsL2hsYjPRT0Bp2fkerk53pMrC_imeuI-Yt16tA2vuWyMiF';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        // dd($response);
        return back()->with('success','Event Notification Sent');
    }


    public function pushSessionNotification(Request $request)
    {

        $request->validate([

            'title' => 'required',
            'body'=>'required',
            'session_id'=>'required',

        ]);

        $id = $request->session_id;
        $user_id = SessionUser::all()->where('session_id',$id)->pluck('user_id');

        $firebaseToken = User::whereIn('id',$user_id)->whereNotNull('device_token')->pluck('device_token')->all();



        $SERVER_API_KEY = 'AAAARQ-JPfc:APA91bHYb6hONyGduxFNHSp8JVLCVihnX2LL_e-J7b1bw8Cfp-fX376K-U_mx0Lmxz5UfylpOgoARg794sktn-Hbcf-MIxsL2hsYjPRT0Bp2fkerk53pMrC_imeuI-Yt16tA2vuWyMiF';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        // dd($response);
        return back()->with('success','Session Notification Sent');
    }




}
