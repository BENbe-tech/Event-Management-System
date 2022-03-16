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

?>
            <tr>
                <td><a href="{{route('eventdetails', $event_id)}}" class="title"><b>{{$events[$i]->event_title}}</b></a></td>
                <td><b>{{$event_details->starttime}}</b></td>
            </tr>

     <?php
}
     ?>
        </tbody>
    </table>
    <p class="central" style="text-align: center;">Click Event title of particular event to open it</p>
</div>

@else
<p style="text-align: center;">You have not registered in any event</p>
@endif

</body>

@endsection
