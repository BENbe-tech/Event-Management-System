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

        $participants = EventUser::where('event_id',$id)->paginate(6);


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

        return view('event-bar-graph-report',compact('event_title','data_participants','data_registered'));
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

         return view('event-line-graph-report',compact('event_title','data_participants','data_registered'));
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

        return Excel::download($export, 'users-collection.xlsx');
    }


  public function downloadEventPDF($id){

    $event = Event::find($id);

    // $participants = EventUser::all()->where('event_id',$id);
    $participants = EventUser::where('event_id',$id)->paginate(6);

    $eventpdf = PDF::loadView('event-report',compact('participants','event'));

    return $eventpdf->download('eventreport.pdf');

  }



}
