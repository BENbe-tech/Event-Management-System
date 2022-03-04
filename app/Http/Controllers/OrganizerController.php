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


        $user = new Organizer();
        $user->name = $request->name;
        $user->description = $request->description;
        $user->email = $request->email;
        $user->website_link = $request->website;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->linkedIn = $request->linkedin;
        $user->user_id = session('loginId');
        // $user->user_id = $request->session()->get('loginId');

        $res = $user->save();



        if($res){
            // return back()->with('success','You have registerd successfully');
            return redirect('create-event');

        }else{
             return back()->with('fail', 'something wrong');
        }

     }
}
