<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EventDetail;

use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use PDO;

class AdminController extends Controller
{
    //


    public function adminIndex(){


        $users = User::paginate(10);

        return view('admin-organizers',compact('users'));



    }


    public function adminOrganizers(){


        $users = User::paginate(10);

        return view('admin-organizers',compact('users'));
    }


    public function adminSubscribers($id){


        $user_id  = $id;

        $subscriptions = Subscription::all()->where('user_id',$user_id);

        return view('admin-subscribers',compact('subscriptions'));
    }




    public function adminPayments(){



        $subscriptions = Subscription::paginate(6);

         $subscriptions1 = Subscription::all()->pluck('subscription_fee')->sum();



        return view('admin-payments',compact('subscriptions','subscriptions1'));
    }






    public function adminBarSearch(Request $request){

    $response = $request->category;

    if($response == "year"){
        $search = "year";

        // $this->FilterBarChart($search);
        return redirect()->route('filterbar',$search);

    }


    if($response == "month"){

       $search = "month";

    //    $this->FilterBarChart($search);
       return redirect()->route('filterbar',$search);

         }




    if($response == "user"){

        $search = "user";
        return redirect()->route('filterbar',$search);

      }



    }




    public function FilterBarChart($xsearch){


          $userxs = User::all();

          $users = array();
          $totalevents = array();
          $y = 0 ;
          foreach($userxs as $user){

            $organizers = $user->organizers;

            $x = 0;


            foreach($organizers as $organizer){

               $events = $organizer->events;
               $x = $x + $events->count();

            }

            if($x != 0){
                $users[$y] = $user->name;
               $totalevents[$y] = $x;
               $y = $y+1;
            }


        }


        $totaleventcreatedyear     = array();
        $createdyear= EventDetail::all()->unique('createdyear')->pluck('createdyear');

        $totalcreatedyear = count($createdyear);

        for($p=0;$p<$totalcreatedyear;$p++){

            $totaleventcreatedyear[$p]  = EventDetail::all()->where('createdyear',$createdyear[$p])->count();

        }





          $createdmonth = array();
          $totaleventcreatedmonth     = array();
          $createdmonth1= EventDetail::all()->unique('createdmonth')->pluck('createdmonth');

          $totalcreatedmonth = count($createdmonth1);
          for($p=0;$p<$totalcreatedmonth;$p++){

              $totaleventcreatedmonth[$p]  = EventDetail::all()->where('createdmonth',$createdmonth1[$p])->count();

              switch ($createdmonth1[$p]) {
                  case 1:
                      $month = "January";
                      $createdmonth[$p] = "January";
                      break;
                  case 2:
                      $month = "February";
                      $createdmonth[$p] = "February";
                      break;

                  case 3:
                  $month = "March";
                  $createdmonth[$p] = "March";
                      break;

                  case 4:
                  $month = "April";
                  $createdmonth[$p] = "April";
                      break;

                  case 5:
                  $month = "May";
                  $createdmonth[$p] = "May";
                      break;

                  case 6:
                  $month = "June";
                  $createdmonth[$p] = "June";
                      break;

                  case 7:
                  $month = "July";
                  $createdmonth[$p] = "July";
                      break;

                  case 8:
                  $month = "August";
                  $createdmonth[$p] =  "August";
                      break;

                  case 9:
                  $month = "September";
                  $createdmonth[$p] =  "September";
                      break;

                  case 10:
                  $month = "October";
                  $createdmonth[$p] = "October";
                      break;


                  case 11:
                  $month = "November";
                  $createdmonth[$p] = "November";
                  break;


                  case 12:
                  $month = "December";
                  $createdmonth[$p] = "December";
                      break;
                  default:
                      $month = "None";
                      $createdmonth[$p] = "None";
                  }



           }


        $search = $xsearch;

        return view('admin-bargraphs',compact('users','totalevents','createdmonth','totaleventcreatedmonth','search','totaleventcreatedyear','createdyear'));

        }





    public function adminBarGraphs(){


    //   $users = User::all()->pluck('name');
      $userxs = User::all();

      $users = array();
      $totalevents = array();
      $y = 0 ;
      foreach($userxs as $user){

        $organizers = $user->organizers;

        $x = 0;


        foreach($organizers as $organizer){

           $events = $organizer->events;
           $x = $x + $events->count();

        }

        if($x != 0){
            $users[$y] = $user->name;
           $totalevents[$y] = $x;
           $y = $y+1;
        }


    }



    $totaleventcreatedyear     = array();
    $createdyear= EventDetail::all()->unique('createdyear')->pluck('createdyear');

    $totalcreatedyear = count($createdyear);

    for($p=0;$p<$totalcreatedyear;$p++){

        $totaleventcreatedyear[$p]  = EventDetail::all()->where('createdyear',$createdyear[$p])->count();

    }





      $createdmonth = array();
      $totaleventcreatedmonth     = array();
      $createdmonth1= EventDetail::all()->unique('createdmonth')->pluck('createdmonth');

      $totalcreatedmonth = count($createdmonth1);
      for($p=0;$p<$totalcreatedmonth;$p++){

          $totaleventcreatedmonth[$p]  = EventDetail::all()->where('createdmonth',$createdmonth1[$p])->count();

          switch ($createdmonth1[$p]) {
              case 1:
                  $month = "January";
                  $createdmonth[$p] = "January";
                  break;
              case 2:
                  $month = "February";
                  $createdmonth[$p] = "February";
                  break;

              case 3:
              $month = "March";
              $createdmonth[$p] = "March";
                  break;

              case 4:
              $month = "April";
              $createdmonth[$p] = "April";
                  break;

              case 5:
              $month = "May";
              $createdmonth[$p] = "May";
                  break;

              case 6:
              $month = "June";
              $createdmonth[$p] = "June";
                  break;

              case 7:
              $month = "July";
              $createdmonth[$p] = "July";
                  break;

              case 8:
              $month = "August";
              $createdmonth[$p] =  "August";
                  break;

              case 9:
              $month = "September";
              $createdmonth[$p] =  "September";
                  break;

              case 10:
              $month = "October";
              $createdmonth[$p] = "October";
                  break;


              case 11:
              $month = "November";
              $createdmonth[$p] = "November";
              break;


              case 12:
              $month = "December";
              $createdmonth[$p] = "December";
                  break;
              default:
                  $month = "None";
                  $createdmonth[$p] = "None";
              }



       }


    $search = "user";


      return view('admin-bargraphs',compact('users','totalevents','createdmonth','totaleventcreatedmonth','search','totaleventcreatedyear','createdyear'));
    }







    public function adminLineGraphs(){

      $userxs = User::all();

      $users = array();
      $totalevents = array();
      $y = 0 ;
      foreach($userxs as $user){

        $organizers = $user->organizers;

        $x = 0;


        foreach($organizers as $organizer){

           $events = $organizer->events;
           $x = $x + $events->count();

        }

        if($x != 0){
            $users[$y] = $user->name;
         $totalevents[$y] = $x;
         $y = $y+1;
        }


    }





      $createdmonth = array();
      $totaleventcreatedmonth     = array();
      $createdmonth1= EventDetail::all()->unique('createdmonth')->pluck('createdmonth');

      $totalcreatedmonth = count($createdmonth1);
      for($p=0;$p<$totalcreatedmonth;$p++){

          $totaleventcreatedmonth[$p]  = EventDetail::all()->where('createdmonth',$createdmonth1[$p])->count();

          switch ($createdmonth1[$p]) {
              case 1:
                  $month = "January";
                  $createdmonth[$p] = "January";
                  break;
              case 2:
                  $month = "February";
                  $createdmonth[$p] = "February";
                  break;

              case 3:
              $month = "March";
              $createdmonth[$p] = "March";
                  break;

              case 4:
              $month = "April";
              $createdmonth[$p] = "April";
                  break;

              case 5:
              $month = "May";
              $createdmonth[$p] = "May";
                  break;

              case 6:
              $month = "June";
              $createdmonth[$p] = "June";
                  break;

              case 7:
              $month = "July";
              $createdmonth[$p] = "July";
                  break;

              case 8:
              $month = "August";
              $createdmonth[$p] =  "August";
                  break;

              case 9:
              $month = "September";
              $createdmonth[$p] =  "September";
                  break;

              case 10:
              $month = "October";
              $createdmonth[$p] = "October";
                  break;


              case 11:
              $month = "November";
              $createdmonth[$p] = "November";
              break;


              case 12:
              $month = "December";
              $createdmonth[$p] = "December";
                  break;
              default:
                  $month = "None";
                  $createdmonth[$p] = "None";
              }



       }

        return view('admin-linegraphs',compact('users','totalevents','createdmonth','totaleventcreatedmonth'));
    }




    public function EventReport(){

        $userxs = User::all();

        $users = array();
        $user_id = array();
        $totalevents = array();
        $y = 0 ;
        foreach($userxs as $user){

          $organizers = $user->organizers;

          $x = 0;


          foreach($organizers as $organizer){

             $events = $organizer->events;
             $x = $x + $events->count();

          }

          if($x != 0){
              $users[$y] = $user->name;
              $user_id[$y]  = $user->id;
             $totalevents[$y] = $x;
             $y = $y+1;
          }

    }


    $organizers = Organizer::all()->whereIn('user_id',$user_id[0])->pluck('id');

    $userx = User::all()->where('id',$user_id[0])->pluck('name');

    $events = Event::all()->whereIn('organizer_id',$organizers);


    return view('admin-eventsreport',compact('users','userx','user_id','events'));
}



public function adminSearchOrganizer(Request $request){


    $userxs = User::all();

    $users = array();
    $user_id = array();
    $totalevents = array();
    $y = 0 ;
    foreach($userxs as $user){

      $organizers = $user->organizers;

      $x = 0;


      foreach($organizers as $organizer){

         $events = $organizer->events;
         $x = $x + $events->count();

      }

      if($x != 0){
          $users[$y] = $user->name;
          $user_id[$y]  = $user->id;
         $totalevents[$y] = $x;
         $y = $y+1;
      }

}

    $user_ids = $request->category;

    $organizers = Organizer::all()->where('user_id',$user_ids)->pluck('id');

    $events = Event::all()->whereIn('organizer_id',$organizers);


    $userx = User::all()->where('id',$user_ids)->pluck('name');


return view('admin-eventsreport',compact('users','userx','user_id','events'));
}


public function DateSearch(Request $request){

    $request->validate([
        'date' => 'required',

    ]);

    $event_id = array();
    $date = $request->date;
    $events = Event::all();
    $y = 0;

    foreach($events as $event){
    $eventdetails = $event->eventDetails;
    $x =  $eventdetails->created_at;
    $output = substr($x,0,10);

    if($date == $output){
    $event_id[$y] = $event->id;
    $y++;
    }

    }


    $events = Event::all()->whereIn('id',$event_id);


    return view('admin-datereport',compact('events','date'));

}

public function DateReport(){

    $time = Carbon::now();

    $date = substr($time,0,10);

    $event_id = array();
    $events = Event::all();
    $y = 0;

    foreach($events as $event){
    $eventdetails = $event->eventDetails;
    $x =  $eventdetails->created_at;
    $output = substr($x,0,10);

    if($date == $output){
    $event_id[$y] = $event->id;
    $y++;
    }

    }

    $events = Event::all()->whereIn('id',$event_id);


    return view('admin-datereport',compact('events','date'));
}



}
