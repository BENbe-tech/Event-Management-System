<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Shoket\Laravel\Facades\Shoket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;
use App\Mail\TicketMail;
use  App\Models\EventDetail;
use App\Models\Subscription;

class PaymentController extends Controller
{
    //


    public function Organizerindex(){

        return view('organizer_pay');
    }




    public function OrganizerPay(Request $request){

        $request->validate([

            'provider' => 'required',
            'amount'=>'required',
            'phone'=>'required',
            'type'=>'required',

        ]);

        $provider = $request->provider;
        $amount = $request->amount;
        $phone = $request->phone;
        $type = $request->type;

        if($type == "Monthly" && $amount < 5000 ){
            return back()->with('fail', 'Monthly subscription amount cannot be less than 5000');
            // return response()->json(['success'=>'Monthly subscription amount cannot be less than 5000']);

        }

        if($type == "Yearly" && $amount < 60000){

            return back()->with('fail', 'Yearly subscription amount cannot be less than 60000');
            // return response()->json(['success'=>'Yearly subscription amount cannot be less than 60000']);
        }


       if($type == "Monthly"){
           $newtime = Carbon::now()->addMonth();
       }

       if($type == "Yearly"){
         $newtime = Carbon::now()->addYear();
       }



        $user_id = session('loginId');
        $user = User::find($user_id);
        $user_name = $user->name;
        $user_email = $user->email;

        $chargeResponse = Shoket::makePaymentRequest([
            "amount" => $amount,
            "customer_name" => $user_name,
            "email" =>  $user_email,
            "number_used" => $phone,
            "channel" =>  $provider
        ]);

        //  dd($chargeResponse)  ;


       $data = $chargeResponse['data'];
       $customer = $chargeResponse['customer'];

//    $referenceId = "8pRdt4hcWaO9Kx8t930oY";
//    $referenceId = $chargeResponse['reference'];
//    $response = Shoket::verifyPaymentRequest($referenceId, [
//      "provider_name" => "Tigo",
//      "provider_code" => "Tigo pesa"
//      ]);
//       dd($response);

       $amount = $data['amount'];
       $channel = $data['channel'];
       $reference_no =   $chargeResponse['reference'];
       $number =  $data['number_used'];
       $time = Carbon::now();


     if ($data['payment_status'] == "Pending" ){

        $sub = new Subscription();
        $sub->payment_date = $time;
        $sub->subscription_fee = $amount;
        $sub->method = $channel;
        $sub->subscription_type = $type;
        $sub->phone_number = $number;
        $sub->reference_no = $reference_no;
        $sub->subscription_end = $newtime;
        $sub-> user_id =  $user_id;
        $res = $sub->save();


     if($res){

        $details = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $type.' subscription at '.$time.' to create and manage event,',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' phone number '.$number.' Payment reference number is '.$reference_no.'.',
       ];

          Mail::to($user_email)->send(new PaymentMail($details));

          return back()->with('success','Payment done successful');
          // return response()->json(['success'=>'Payment Done Successful']);
     }
    }
     else{
        return back()->with('fail', 'Payment Failed');
        // return response()->json(['success'=>'Payment Failed']);
     }

    }




    public function Participantindex($id){

        $event_id = $id;
        $user_id = session('loginId');

         return view('participant_pay',compact('event_id','user_id'));
    }



    public function ParticipantPay(Request $request){


        $request->validate([

            'provider' => 'required',
            'amount'=>'required',
            'phone'=>'required',

        ]);


        $provider = $request->provider;
        $amount = $request->amount;
        $phone = $request->phone;
        $event_id = $request->event_id;
        $event = Event::find($event_id);
        $event_title = $event->event_title;


        $user_id = session('loginId');
        $user = User::find($user_id);
        $user_name = $user->name;
        $user_email = $user->email;

        $chargeResponse = Shoket::makePaymentRequest([
            "amount" => $amount,
            "customer_name" => $user_name,
            "email" =>  $user_email,
            "number_used" => $phone,
            "channel" =>  $provider
        ]);

        //  dd($chargeResponse)  ;


       $data = $chargeResponse['data'];
       $customer = $chargeResponse['customer'];

//    $referenceId = "8pRdt4hcWaO9Kx8t930oY";
//    $referenceId = $chargeResponse['reference'];
//    $response = Shoket::verifyPaymentRequest($referenceId, [
//      "provider_name" => "Tigo",
//      "provider_code" => "Tigo pesa"
//      ]);
//       dd($response);

       $amount = $data['amount'];
       $channel = $data['channel'];
       $reference_no =   $chargeResponse['reference'];
       $number =  $data['number_used'];
       $time = Carbon::now();


     if ($data['payment_status'] == "Pending" ){

        $payment = new Payment();
        $payment->payment_time = Carbon::now();
        $payment->amount = $data['amount'];
        $payment->method = $data['channel'];
        $payment->phone_number = $data['number_used'];
        $payment->reference_no = $chargeResponse['reference'];
        $payment-> event_id = $event_id;
        $payment-> user_id =  $user_id;
        $res = $payment->save();


     if($res){

         $amountpaid = Payment::all()->where('event_id',$event_id)->where('user_id',$user_id)->sum('amount');
         $amounttotal = EventDetail::all()->where('event_id',$event_id)->pluck('price');

         $price = $amounttotal[0];
         $percent = ($amountpaid/ $price) * 100 ;


      if($percent == 100){

        $time = time();
        $qr = md5($time);
        $event_detailsticket = $event->eventDetails;

        $values = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $event_title.' event at '.$time.'.',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' phone number '.$number.' Payment reference number is '.$reference_no,
            'body' => 'This is the ticket of '. $event_title.' event.',
            'qr'    =>  $qr,
            'user'  =>   $user,
            'eventdetails' => $event_detailsticket ,
            'event' => $event ,
        ];

         Mail::to($user_email)->send(new TicketMail($values));
      }else{



        $details = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $event_title.' event at '.$time.'.',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' phone number '.$number.' Payment reference number is '.$reference_no,

        ];

          Mail::to($user_email)->send(new PaymentMail($details));

      }


        return back()->with('success','Payment done successful');
        // return response()->json(['success'=>'Payment Done Successful']);

     }
    }
     else{
        return back()->with('fail', 'Payment Failed');
        // return response()->json(['success'=>'Payment Failed']);
     }


    }




    public function TicketSend(){


    }


}
