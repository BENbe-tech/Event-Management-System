<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\SessionDetail;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{

//Index function is called when user presses home on dashboard and flag = 0 is set
//When there is no event present in the database else flag =1 is set when events are
//present in the database

    public function index(){


        $event_categorys =Category::all();
        $events = Event::all();
        $IDevents = Event::all()->pluck('id');
        $eventsdetails = $event_details =EventDetail::all()-> whereIn('event_id',$IDevents);
        $count = $events->count();
        if($count== 0){
            $flag = 0;
        }
        else{
            $flag = 1;
        }

        return view('home',compact('event_categorys','events','IDevents','flag'));

    }


// Search function is called when the user search for event at the search engine and flag = 0 is set
//When there is no event present in the database else flag =1 is set when events are
//present in the database when the category is all  the if statement is executed

    public function search(Request $request){

      if($request->category == 0){
        $event_categorys =Category::all();
        $events = Event::all();
        $IDevents = Event::all()->pluck('id');
        $eventsdetails = $event_details =EventDetail::all()-> whereIn('event_id',$IDevents);
         $count = $events->count();
         if($count== 0){
            $flag = 0;
        }
        else{
            $flag = 1;
        }

         return view('home',compact('event_categorys','events','IDevents','flag'));

        }

  //The else statement is called when the category is not all and flag=2 when events are present
  // flag=0 when events are not present

        else{

      $res = $request->category;

      $event_categorys =Category::all();
      $IDevents = EventDetail::all()->where('category',$res)->pluck('event_id');
      $IDdetails = EventDetail::all()->where('category',$res)->pluck('id');
      $count =  $IDevents->count();
      if($count == 0){
          $flag =0;
      }
      else{
        $flag = 2;
      }



      return view('home',compact('event_categorys','IDdetails','IDevents','flag'));

    }
    }


    public function homeevent($id){
        $event =Event::find($id);

        return view('home-event',compact('id','event'));

    }

    public function showsessiondetails($id){

        $session = Session::find($id);
        $sessiondetails = $session->sessionDetails;


         return view('homesessiondetails',compact('session','sessiondetails'));

     }

     public function showsessions($id){

        $sessions = Session::all()->where('event_id',$id);
        $count = $sessions->count();

         return view('homesession',compact('sessions','count'));

     }

}
