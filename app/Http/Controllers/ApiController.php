<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDetail;
use App\Models\User;


use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function Users(){

        $users =User::all();

        return response()->json($users);


    }

    public function User($id){

        $users =User::all()->where('id',$id);

        return response()->json($users);


    }

    public function Events(){

        $events =Event::all();

        return response()->json($events);


    }


    public function Event($id){

        $event =Event::all()->where('id',$id);

        return response()->json($event);


    }



    public function Eventdetails(){

        $eventdetails =EventDetail::all();

        return response()->json($eventdetails);


    }



    public function Eventdetail($id){

        $eventdetail =EventDetail::all()->where('event_id',$id);

        return response()->json($eventdetail);


    }



}
