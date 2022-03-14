<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeEventController extends Controller
{
    //

    public function index($id){
        $event =Event::find($id);

        return view('home-event',compact('id','event'));

    }
}
