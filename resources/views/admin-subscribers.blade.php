@extends('admin-dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

</head>
<body>


    <h4><b>Organizer Subscription details</b></h4>



    <div class="card">

        <div class ="inline">
<?php
        foreach ($subscriptions as $subscription ){
            $time = Carbon\Carbon::now();
         if($time <= $subscription->subscription_end){

            $user = $subscription->users;
            $endtime = $subscription->subscription_end;
            $results = $time->diffInDays($endtime, false);
?>
            <div class = "user">

                <p><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<b>Name:</b>  {{$user->name}}</p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<b>Email:</b> {{$user->email}}</p>
                <p><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;<b>Payment:</b>Tsh {{$subscription->subscription_fee}}</p>

            </div>

        <div class= "details">
            <p><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;<b>Subscription </b></p>

                <p><b>Start subscription: </b> {{$subscription->payment_date}}</p>
                <p><b>End subscription: </b> {{$subscription->subscription_end}}</p>
                <p><b>Time remaining: </b> {{$results}}</p>
                <p><b>Subscription Type: </b> {{$subscription->subscription_type}}</p>
            </div>
<?php
     }
    }
?>
        </div>
    </div>

</body>
@endsection
