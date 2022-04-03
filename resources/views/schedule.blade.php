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
    <h4><b>Schedule of Registered Events</b></h4>
 {{-- Class styled-table displays event registered by the user --}}
    <table class="styled-table">
        <thead>
            <tr>
                <th><b>#</b></th>
                <th><b>Event Title</b></th>
                <th><b>Start Date</b></th>
                <th><b>End Date</b></th>
            </tr>
        </thead>
        <tbody>
            <?php

for($i =0; $i<$count;$i++ ){

       $event_details = $events[$i]->eventDetails;
       $event_id = $events[$i]->id;

?>
            <tr>
                <td><b>{{$i +1 }}</b></td>
                <td><b>{{$events[$i]->event_title}}</b></td>
                <td><b>{{$event_details->starttime}}</b></td>
                <td><b>{{$event_details->endtime}}</b></td>
            </tr>

     <?php
}
     ?>
        </tbody>
    </table>
</div>

@else
<p style="text-align: center;">You have not registered in any event</p>
@endif

</body>

@endsection
