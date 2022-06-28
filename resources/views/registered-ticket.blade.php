@extends('dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="{{asset('css/registered-events.css')}}">
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
</head>
<body>
<?php
$count = $events->count();

?>

 @if($count!=0)


<div>
    <h4><b>Events</b></h4>
 {{-- Class styled-table displays event registered by the user --}}
    <table class="styled-table">
        <thead>
            <tr>
                <th><b>Event Title</b></th>
                <th><b>Start Date</b></th>
            </tr>
        </thead>
        <tbody>

            <?php

for($i =0; $i<$count;$i++ ){

       $event_details = $events[$i]->eventDetails;
       $event_id = $events[$i]->id;

       $amountpaid = App\Models\Payment::all()->where('event_id',$event_id)->where('user_id',$user_id)->sum('amount');
         $amounttotal = App\Models\EventDetail::all()->where('event_id',$event_id)->pluck('price');

         $price = $amounttotal[0];



         if($price != NULL ){
         $percent = ($amountpaid/ $price) * 100 ;
         }else{
            $percent = 0;
         }


      if($percent >= 100 || $price == NULL){


?>
            <tr>
                <td><a href="{{route('ticket', $event_id)}}" class="title"><b>{{$events[$i]->event_title}}</b></a></td>
                <td><b>{{$event_details->starttime}}</b></td>
            </tr>

     <?php
}
}
     ?>
        </tbody>
    </table>
    <p class="central" style="text-align: center;">Click Event title of particular event to view it's tikcet</p>
</div>

@else
<p style="text-align: center;">No event</p>
@endif

</body>

@endsection
