<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Administrator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    //



    public function Login(){
        return view('adminauth.admin-login');

    }

    public function Registration(){

        return view('adminauth.admin-register');
    }

    public function RegisterAdmin(Request $request){


        $request->validate([
            'name' => 'required',
            'email'=>'required|email|unique:users',
           'password' =>'required|min:8|confirmed',
           'password_confirmation' => 'required',
           'phone' => 'required|min:10',

        ]);


        $user = new Administrator();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $res = $user->save();

     //    $user->roles()->sync($request->roles);

        $request->session()->put('adminId',$user->id);
        if($res){
         //    return back()->with('success','You have registerd successfully');
            return redirect('adminlogin-user1');

        }else{
             return back()->with('fail', 'something wrong');
        }

    }


    public function LoginAdmin(Request $request){


        $request->validate([

            'email'=>'required|email',
           'password' =>'required|min:8',

        ]);
          $user = Administrator::where('email', '=', $request->email)->first();
          if($user){
             if(Hash::check($request->password,$user->password)){
                //  Session::put('loginId',$user->id);
                 $request->session()->put('adminId',$user->id);
                 return redirect('admin-dashboard');
             } else {
              return back()->with('fail','Password not matches.');
             }
            }
            else{
                return back()->with('fail','This email is not registered');
          }


    }



    public function Logout(){
        if(Session::has('adminId')){
           Session::pull('adminId');
          return  redirect('adminlogin');

        }
    }





    public function adminshowForgetPasswordForm()
    {
       return view('adminauth.admin-forgetPassword');
    }






    public function adminsubmitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:administrators',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }


    public function adminshowResetPasswordForm($token) {
        return view('adminauth.admin-forgetPasswordLink', ['token' => $token]);
     }




     public function adminsubmitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:administrators',
             'password' => 'required|string|min:8|confirmed',
             'password_confirmation' => 'required'
         ]);

         $updatePassword = DB::table('password_resets')
                             ->where([
                               'email' => $request->email,
                               'token' => $request->token
                             ])
                             ->first();

         if(!$updatePassword){
             return back()->withInput()->with('fail', 'Invalid token!');
         }

         $user = Administrator::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         DB::table('password_resets')->where(['email'=> $request->email])->delete();

         return redirect('adminlogin-user1')->with('success', 'Your password has been changed!');
     }




}
