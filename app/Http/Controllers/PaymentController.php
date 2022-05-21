<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Shoket\Laravel\Facades\Shoket;


class PaymentController extends Controller
{
    //

    public function Participantindex($id){

        $event_id = $id;

         return view('participant_pay',compact('event_id'));
    }



    public function Organizerindex(){

        // return view('organizer');
    }



    public function ParticipantPay(Request $request){


        $request->validate([
            'name' => 'required',
            'email'=>'required',
            'provider' => 'required',
            'amount'=>'required',
            'phone'=>'required',

        ]);

        $name = $request->name;
        $email = $request->email;
        $provider = $request->provider;
        $amount = $request->amount;
        $phone = $request->phone;

        $user_id = session('loginId');
        $user = User::find($user_id);
        $user_name = $user->name;
        $chargeResponse = Shoket::makePaymentRequest([
            "amount" => $amount,
            "customer_name" => $name,
            "email" =>  $email,
            "number_used" => $phone,
            "channel" =>  $provider
        ]);

        //  dd($chargeResponse)  ;

        // $responses = json_decode($chargeResponse->getContent(),true);
       echo $chargeResponse['Status'];

       foreach($chargeResponse['data'] as $data){
           echo $data['channel'];
       }

       echo $chargeResponse['reference'];

     foreach($chargeResponse as $response){

        echo  $response['Status'];
     }


    }

    public function OrganizerPay(){

        // return view('organizer');
    }





}
