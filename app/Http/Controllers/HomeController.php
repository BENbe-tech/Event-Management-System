<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    //

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
}
