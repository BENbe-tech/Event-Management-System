<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Organizer;
use App\Models\Session;
use App\Models\SessionUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Charts\EventChart;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Models\EventDetail;
use App\Models\Payment;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    //
    public function index(){

        $user_id    = session('loginId');
        $user       = User::find($user_id);
        $organizers  = $user->organizers;


        $events = Event::all();



        return view('created-events-report',compact('organizers'));

    }

    public function eventReport($id){


        // $participants = EventUser::all()->where('event_id',$id);
        $event = Event::find($id);
        $event_name = Event::all()->where('id',$id)->pluck('event_title');
        $name = $event_name[0];

        $participants = EventUser::where('event_id',$id)->paginate(6);


       $x = 1;
        foreach ($participants as $participant ){
            $user_id = $participant->user_id;
            $user =User::find($user_id);

            $user_email = $user->email;

         $response = Report::where('email', '=', $user_email)->where('event_id','=',$id)->first();



       if (!$response) {

        //To edit
          $amountpaid = Payment::all()->where('event_id',$id)->where('user_id',$user_id)->sum('amount');


        $report = new Report();
        $report->participant =        $user->name;
        $report->email       =        $user->email;
        $report->phone       =        $user->phone;
        $report->number      =        $x;
        $report->event_id    =        $id;
        $report->event_title =        $name;

        if($participant->verify_attendance==NULL){

        $report->verified_attendance = "NO";
        $report->attendance_mode = "NONE";
        }

        if($participant->verify_attendance== 1){

        $report->verified_attendance = "YES";
        $report->attendance_mode = $participant->attendance_mode;
        }

        $report->payment_amount = $amountpaid;

        //creted day of ticket
        $report->payment_day    = "Monday";

        //created barcode number
        $report->ticket_number  = "20";

        $res = $report->save();
            }
        $x = $x + 1;

        }

        return view('event-report',compact('participants','event'));

    }


    public function eventSessionsReport($id){

      $event_id =  $id;

      $sessions = Session::where('event_id',$event_id)->paginate(6);
      return view ('event-sessionsreport',compact('event_id','sessions'));


    }

    public function SessionReport($id){

     $session_id = $id;
     $session = Session::find($session_id);
     $participants = SessionUser::where('session_id',$session_id)->paginate(6);
     return view('session-report',compact('session','participants'));

    }


    public function BarGraph(){

       $user_id    = session('loginId');
       $organizer_id =   Organizer::all()->where('user_id',$user_id)->pluck('id');
       $event_title = Event::all()->whereIn('organizer_id',$organizer_id)->pluck('event_title');
    //    echo $event_title;
       $event_id = Event::all()->whereIn('organizer_id',$organizer_id)->pluck('id');
    //    echo $event_id;
       $x = count($event_id);
    //    echo $x;
       $data_participants = array();

       for ($i=0;$i<$x;$i++) {

        $participants = EventUser::all()->where('event_id',$event_id[$i])->where('verify_attendance',1);
         $y = $participants->count();
         $data_participants[$i] = $y;
    }

    $data_registered = array();

    for ($j=0;$j<$x;$j++) {

        $registered_user = EventUser::all()->where('event_id',$event_id[$j]);
         $y = $registered_user->count();
         $data_registered[$j] = $y;
    }



    $event_payments = array();

      for($e=0; $e<$x ; $e++){

        $amount = Payment::all()->where('event_id',$event_id[$e])->pluck('amount');
        $y = $amount->sum();
        $event_payments[$e] = $y;

      }


    //title and category

    $user       = User::find($user_id);
    $organizers  = $user->organizers;


    $event_category = array();
    $count = $organizers->count();

    $number = 0;
    // for($j=0; $j<$count;$j++){
    // $events = $organizers[$j]->events;
    // if($events !=[]){
    // $count1 = $events->count();
    // for($i=0;$i<$count1;$i++){
    // $event_id = $events[$i]->id;

    // $event_details  = $events[$i]->eventDetails;
    // $event_category[$number] = $event_details->category;
    // $eventmonth[$number]     = $event_details->startmonth;
    // $createdmonth[$number]   = $event_details->createdmonth;
    // $totalcreatedmonth[$number]  = EventDetail::all()->where('event_id', $event_id )->where('createdmonth',) ;
    // $totalstartmonth[$number]    =  ;

    // $number++;
    // }
    // }
    // }

        $event_id = array();
    for($j=0; $j<$count;$j++){
        $events = $organizers[$j]->events;
        if($events !=[]){
        $count1 = $events->count();
        for($i=0;$i<$count1;$i++){
        $event_id[$number] = $events[$i]->id;
        $number++;
        }
        }
        }

//    $x= EventDetail::all()->whereIn('event_id', $event_id )->groupBy('startmonth')->pluck('startmonth');
    $totaleventstartmonth     = array();
    $startmonth= EventDetail::all()->whereIn('event_id', $event_id )->unique('startmonth')->pluck('startmonth');

    $totalstartmonth = count($startmonth);
    for($p=0;$p<$totalstartmonth;$p++){

    $totaleventstartmonth[$p]  = EventDetail::all()->whereIn('event_id', $event_id )->where('startmonth',$startmonth[$p])->count();

    }

    $createdmonth= EventDetail::all()->whereIn('event_id', $event_id )->unique('createdmonth')->pluck('createdmonth');
    echo $createdmonth;
    $totalcreatedmonth = count($createdmonth);
    for($p=0;$p<$totalcreatedmonth;$p++){

        $totaleventcretedmonth[$p]  = EventDetail::all()->whereIn('event_id', $event_id )->where('createdmonth',$createdmonth[$p])->count();

     }

     dd($totaleventcretedmonth);



        return view('event-bar-graph-report',compact('event_title','data_participants','data_registered','event_payments','event_category'));
    }




    public function LineGraph(){

        $user_id    = session('loginId');
        $organizer_id =   Organizer::all()->where('user_id',$user_id)->pluck('id');
        $event_title = Event::all()->whereIn('organizer_id',$organizer_id)->pluck('event_title');

        $event_id = Event::all()->whereIn('organizer_id',$organizer_id)->pluck('id');

        $x = count($event_id);

        $data_participants = array();

        for ($i=0;$i<$x;$i++) {

         $participants = EventUser::all()->where('event_id',$event_id[$i])->where('verify_attendance',1);
          $y = $participants->count();
          $data_participants[$i] = $y;
     }

     $data_registered = array();

     for ($j=0;$j<$x;$j++) {

         $registered_user = EventUser::all()->where('event_id',$event_id[$j]);
          $y = $registered_user->count();
          $data_registered[$j] = $y;
     }


     $event_payments = array();

     for($e=0; $e<$x ; $e++){

       $amount = Payment::all()->where('event_id',$event_id[$e])->pluck('amount');
       $y = $amount->sum();
       $event_payments[$e] = $y;
     }




         return view('event-line-graph-report',compact('event_title','data_participants','data_registered','event_payments'));
     }


    public function fileImportExport()
    {
       return view('file-import');
    }


    public function fileImport(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport($event_id)
    {
        $export = new UsersExport($event_id);

        $event_name = Event::all()->where('id',$event_id)->pluck('event_title');
        $name = $event_name[0];

        return Excel::download($export, $name.'.xlsx');
    }


  public function downloadEventPDF($id){

    $event = Event::find($id);

    // $participants = EventUser::all()->where('event_id',$id);
    $participants = EventUser::where('event_id',$id)->paginate(6);

    $eventpdf = PDF::loadView('event-report',compact('participants','event'));

    return $eventpdf->download('eventreport.pdf');

  }



  public function timeReport(){

    $user_id    = session('loginId');
    $user       = User::find($user_id);
    $organizers  = $user->organizers;


    $events = Event::all();


    return view('time-report',compact('organizers'));

  }



}
