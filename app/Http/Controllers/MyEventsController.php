<?php

namespace App\Http\Controllers;
use App\Models\EventDetail;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;

class MyEventsController extends Controller
{
    //
    public function index(){

    return view('myevents');

}

}
