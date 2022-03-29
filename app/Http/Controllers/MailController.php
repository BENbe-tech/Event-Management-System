<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendEmail(){

        $details = [
             'title' => 'Mail from Event management system',
              'body' => 'This is for testing mail using gmail'

        ];

        // Mail::to("kayombobernard@gmail.com")->send(new TestMail($details));
         Mail::to("robertotonde316@gmail.com")->send(new TestMail($details));
        return  "Email Sent";
    }
}
