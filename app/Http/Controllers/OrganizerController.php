<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    //
    public function index(){

        return view('organizer');
    }


    public function createorganizer(Request $request){

        $request->validate([
            'name' => 'required',
            'email'=>'required|email',

        ]);


        $organizer = new Organizer();
        $organizer->name = $request->name;
        $organizer->description = $request->description;
        $organizer->email = $request->email;
        $organizer->website_link = $request->website;
        $organizer->facebook = $request->facebook;
        $organizer->twitter = $request->twitter;
        $organizer->instagram = $request->instagram;
        $organizer->linkedIn = $request->linkedin;
        // $user->user_id = session('loginId');
        $organizer->user_id = $request->session()->get('loginId');

        $res = $organizer->save();



        if($res){
            // return back()->with('success','You have registerd successfully');
            return redirect('create-event');

        }else{
             return back()->with('fail', 'something wrong');
        }

     }
}
