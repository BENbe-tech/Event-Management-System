<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use function PHPSTORM_META\map;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    //login
    public function login(){

        return view("auth.login");
    }

    //register
    public function registration(){
        return view("auth.registration");
    }


    //Register a user
    public function registerUser(Request $request){

   $request->validate([
       'name' => 'required',
       'email'=>'required|email|unique:users',
      'password' =>'required|min:8|confirmed',
      'phone' => 'required|min:10',

   ]);


   $user = new User();
   $user->name = $request->name;
   $user->email = $request->email;
   $user->phone = $request->phone;
   $user->password = Hash::make($request->password);
   $res = $user->save();

//    $user->roles()->sync($request->roles);

   $request->session()->put('loginId',$user->id);
   if($res){
    //    return back()->with('success','You have registerd successfully');
       return redirect('login-user1');

   }else{
        return back()->with('fail', 'something wrong');
   }

}



// Login User
public function loginUser(Request $request){

    $request->validate([

        'email'=>'required|email',
       'password' =>'required|min:8',

    ]);
      $user = User::where('email', '=', $request->email)->first();
      if($user){
         if(Hash::check($request->password,$user->password)){
            //  Session::put('loginId',$user->id);
             $request->session()->put('loginId',$user->id);
             return redirect('home');
         } else {
          return back()->with('fail','Password not matches.');
         }
        }
        else{
            return back()->with('fail','This email is not registered');
      }
}


//Logout User

public function logout(){
    if(Session::has('loginId')){
       Session::pull('loginId');
      return  redirect('login');

    }
}



//Forgot Password
public function forgotpassword(){

    return view('auth.forgotpassword');
}


}
