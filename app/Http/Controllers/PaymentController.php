<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Shoket\Laravel\Facades\Shoket;
use Carbon\Carbon;


class PaymentController extends Controller
{
    //

    public function Participantindex($id){

        $event_id = $id;
        $user_id = session('loginId');

         return view('participant_pay',compact('event_id','user_id'));
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
        $event_id = $request->event_id;

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

       $data = $chargeResponse['data'];
       $customer = $chargeResponse['customer'];


//    $referenceId = "8pRdt4hcWaO9Kx8t930oY";
//    $referenceId = $chargeResponse['reference'];
//    $response = Shoket::verifyPaymentRequest($referenceId, [
//      "provider_name" => "Tigo",
//      "provider_code" => "Tigo pesa"
//      ]);
//       dd($response);

     if ($data['payment_status'] == "Pending" ){

        $payment = new Payment();
        $payment->payment_time = Carbon::now();
        $payment->amount = $data['amount'];
        $payment->method = $data['channel'];
        $payment->reference_no = $chargeResponse['reference'];
        $payment-> event_id = $event_id;
        $payment-> user_id =  $user_id;
        $res = $payment->save();


     if($res){
        return back()->with('success','Payment done successful');
     }
     else{
        return back()->with('fail', 'something wrong');
     }
    }

    }

    public function OrganizerPay(){

        // return view('organizer');
    }

}
