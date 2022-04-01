<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function profile($id){

        $user = User::find($id);
       $organizers = $user->organizers;
        return view('profile',compact('id','user','organizers'));
    }


    public function showUpdateProfile($id){

        $user = User::find($id);
        return view('edit-profile',compact('id','user'));
    }

    public function UpdateProfile(Request $request){
        $user_id    = $request->input('user_id');

        $request->validate([

            'name'  => 'required',
            'email'  => 'required|email|unique:users,email,'.$user_id,
            'phone'  => 'required|min:10',

        ]);



    if($user_id != ""){


        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        $res_user =   $user->update();

        if($res_user){
            return back()->with('success','Profile Updated Successful');
        }
        else{
            return back()->with('fail','Failed to Update Profile');
        }
    }
    else{
        return back()->with('fail','Failed to Update Profile');
    }

    }

}
