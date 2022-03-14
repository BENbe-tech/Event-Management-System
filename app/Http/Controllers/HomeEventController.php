<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeEventController extends Controller
{
    //

    public function index($id){

        return view('home-event',compact('id'));

    }
}
