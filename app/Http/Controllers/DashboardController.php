<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    //
    public function dashboard(){

        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('dashboard',compact('data'));
    }


}
