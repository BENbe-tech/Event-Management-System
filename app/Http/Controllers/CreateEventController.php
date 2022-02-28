<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateEventController extends Controller
{
    //
    public function createEvent(){

        return view('create-event');
    }
}
