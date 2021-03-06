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
use App\Models\Ticket;



class PaymentShoketController extends Controller
{
    //



    public function shoketOrganizerIndex(){

        return view('organizer_shoketpay');
    }


    // public function shoketOrganizerIndex(){


    //     $user_id = session('loginId');
    //     $user = User::find($user_id);
    //     $user_name = $user->name;
    //     $user_email = $user->email;

    //     return view('organizer_shoketpay',compact('user_name','user_email'));
    // }


    public function shoketOrganizerPay(Request $request){


        $request->validate([

            'provider' => 'required',
            'amount'=>'required',
            'phone'=>'required',
            'type'=>'required',

        ]);

        $provider = $request->provider;
        $amount = $request->amount;

        if($amount >= 1000 ){
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


//    $referenceId = $chargeResponse['reference'];
//    $response = Shoket::verifyPaymentRequest($referenceId, [
//      "provider_name" => "Tigo",
//      "provider_code" => "Tigo pesa"
//      ]);
    //   dd($response);

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

          return back()->with('success','Wallet Push successful');
          // return response()->json(['success'=>'Wallet Push successful']);
     }
    }
     else{
        return back()->with('fail', 'Payment Failed');
        // return response()->json(['success'=>'Payment Failed']);
     }

    }else{

        return back()->with('fail', 'Payment should not be below Tsh 1,000');
    }
    }


    public function shoketParticipantIndex($id){

        $event_id = $id;
        $user_id = session('loginId');

         return view('participant_shoketpay',compact('event_id','user_id'));


    }


    public function shoketParticipantPay(Request $request){

      $request->validate([

            'provider' => 'required',
            'amount'=>'required',
            'phone'=>'required',

        ]);


        $provider = $request->provider;
        $amount = $request->amount;

        if($amount >= 1000 ){

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


      if($percent >= 100){

        $link = url('ticket/'.$event_id);

        $time = time();
        $qr = md5($time);

        $ticket = Ticket::all()->where('event_id', $event_id)->pluck('reference_no');
        $count = count($ticket);
        if($ticket == "[]")
        {
             $number = 1;
        }else{
        
            $number = $ticket[$count-1] + 1 ;
        }

        $ticket = new Ticket();
        $ticket->barcode_no = $qr;
        $ticket->event_id = $event_id;
        $ticket->user_id = $user_id;
        $ticket->amount   =  $amounttotal[0];
        $ticket->reference_no =  $chargeResponse['reference'];
        $ticket->save();

        $values = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $event_title.' event at '.$time.'.',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' phone number '.$number.' Payment reference number is '.$reference_no,
            'body' => 'This is the ticket of '. $event_title.' event.',
            'link' => $link,
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


        return back()->with('success','Wallet pushed successful');
        // return response()->json(['success'=>'Wallet pushed Successful']);

     }
    }
     else{
        return back()->with('fail', 'Payment Failed');
        // return response()->json(['success'=>'Payment Failed']);
     }

    }
    else{
        return back()->with('fail', 'Payment should not be below Tsh 1,000');
    }


    }





}
