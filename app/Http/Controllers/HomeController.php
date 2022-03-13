<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){


        $event_categorys =Category::all();

      

        return view('home',compact('event_categorys'));
    }
}
