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
use Stripe;
use Session;

class PaymentController extends Controller
{
    //


    public function Organizerindex(){

        return view('organizer_pay');
    }




    public function OrganizerPay(Request $request){

        $request->validate([
            'amount'=>'required',
            'type'=>'required',

        ]);


        $amount = $request->amount;
        $type = $request->type;

        if($amount >= 5000){

        if($type == "Monthly" && $amount < 5000 ){
            return back()->with('fail', 'Monthly subscription amount cannot be less than 5000');

        }

        if($type == "Yearly" && $amount < 60000){

            return back()->with('fail', 'Yearly subscription amount cannot be less than 60000');

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


        $channel = $request->card;
        $ac_no =  $request->number;

        $amountdollar1 = $amount / 2331;
        $amountdollar = round($amountdollar1);


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $chargeResponse =   Stripe\Charge::create ([
          "amount" => $amountdollar * 100,
          "currency" => "usd",
        //   "source" => $request->stripeToken,
          "description" => "Ems payment",
          "customer" => "cus_Lw8uZC5lp72TzV",
     ]);


       $reference_no = $chargeResponse['payment_method'];

       $time = Carbon::now();


     if ( $chargeResponse['status'] == "succeeded" ){

        $sub = new Subscription();
        $sub->payment_date = $time;
        $sub->subscription_fee = $amount;
        $sub->method = $channel;
        $sub->subscription_type = $type;
        $sub->phone_number = $ac_no;
        $sub->reference_no = $reference_no;
        $sub->subscription_end = $newtime;
        $sub-> user_id =  $user_id;
        $res = $sub->save();


     if($res){

        $details = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $type.' subscription at '.$time.' to create and manage event,',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' account number '.$ac_no.' Payment reference number is '.$reference_no.'.',
       ];

          Mail::to($user_email)->send(new PaymentMail($details));



          Session::flash('success', 'Payment has been successfully processed.');
          return back();

     }
    }
     else{
        return back()->with('fail', 'Payment Failed');

     }
    }
    else{

          Session::flash('fail', 'amount should be grater or equal t0 5000');
        return back();

    }

    }








    public function Participantindex($id){

        $event_id = $id;
        $user_id = session('loginId');

         return view('participant_pay',compact('event_id','user_id'));
    }



    public function ParticipantPay(Request $request){


                $request->validate([

            'amount'=>'required',


        ]);



        $amount = $request->amount;

        if($amount >= 5000){


        $event_id = $request->event_id;
        $channel = $request->card;
        $ac_no =  $request->number;

        $amountdollar1 = $amount / 2331;
        $amountdollar = round($amountdollar1);



        $event = Event::find($event_id);
        $event_title = $event->event_title;

        $user_id = session('loginId');
        $user = User::find($user_id);
        $user_name = $user->name;
        $user_email = $user->email;




        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51KbHjnLuT9YuvaHTOuBxZ5oKPgXw3uabe5Av5krD4R3Yy68RVyWfuFloyTYVVlh89DKkWhSS0Mf2n6FgUJvKltjE00HMAJkXki'
        //   );

        //   $stripe->customers->create([
        //     'description' => 'New EMS customer',
        //     'email'       => $user_email,

        //   ]);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $chargeResponse =   Stripe\Charge::create ([
          "amount" => $amountdollar * 100,
          "currency" => "usd",
    //   "source" => $request->stripeToken,
          "description" => "Ems payment",
          "customer" => "cus_Lw8uZC5lp72TzV",
     ]);


    //  dd( $chargeResponse );


     $reference_no = $chargeResponse['payment_method'];

       $time = Carbon::now();


     if ($chargeResponse['status'] == "succeeded" ){

        $payment = new Payment();
        $payment->payment_time = Carbon::now();
        $payment->amount = $amount;
        $payment->method = $channel;
        $payment->phone_number =  $ac_no;
        $payment->reference_no =   $reference_no ;
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

        if($ticket == "[]")
        {
             $number = 0;
        }else{
            $number = $ticket[0] + 1 ;
        }

        $ticket = new Ticket();
        $ticket->barcode_no = $qr;
        $ticket->event_id = $event_id;
        $ticket->user_id = $user_id;
        $ticket->amount   =  $amounttotal[0];
        $ticket->reference_no = $number;
        $ticket->save();

        $values = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $event_title.' event at '.$time.'.',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' account number '.$ac_no.' Payment reference number is '.$reference_no,
            'body' => 'This is the ticket of '. $event_title.' event.',
            'link' => $link,
        ];

         Mail::to($user_email)->send(new TicketMail($values));
      }else{



        $details = [
            'title' => 'Dear '. $user_name.',',
            'body1' => 'You have paid for '. $event_title.' event at '.$time.'.',
            'body2' => 'Amount paid is Tsh '. $amount.' via '. $channel. ' account number '.$ac_no.' Payment reference number is '.$reference_no,

        ];

          Mail::to($user_email)->send(new PaymentMail($details));

      }



        Session::flash('success', 'Payment has been successfully processed.');

        return back();

     }
    }
     else{
        return back()->with('fail', 'Payment Failed');

     }

     }

     else{
        Session::flash('fail', 'amount should be grater or equal t0 5000');

        return back();

     }

    }


}
