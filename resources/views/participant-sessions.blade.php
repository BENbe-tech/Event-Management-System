@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/session.css')}}">

</head>
<body>

    @if($count!=0)

    <div>
        <h4 style="padding-left: 170px;"><b> Registered Sessions</b></h4>
    <table class="styled-table">
        <thead>
            <tr>
                <th><b>Session name</b></th>
                <th><b>Start Date</b></th>
                <th><b>Start Time</b></th>

            </tr>
        </thead>
        <tbody>
            <?php
            $x = 0;
      foreach ($sessions as $session ){
           $session_id= $session->session_id;


       $participant_sessions = App\Models\Session::all()->where('id',$session_id)->where('event_id',$id);


       foreach ($participant_sessions as $participant_session ){

       $x++;
      
      ?>
            <tr>
                <td><a href="{{route('registeredevents-sessiondetails', $participant_session->id)}}" class="title"><b>{{$participant_session->name}}</b></a></td>
                <td><b>{{$participant_session->sessionDetails->date}}</b></td>
                <td><b>{{$participant_session->sessionDetails->start_time}}</b></td>
            </tr>
<?php
}
      }

?>

        </tbody>
    </table>
    <?php

      if($x == 0){

      ?>
       <p style="padding-left: 170px;">You have not registered in any session</p>
      <?php

      }else{
?>

    <p class="central" style="text-align: center;">Click Session title to view details</p>
<?php
      }
?>

    @else
    <p style="text-align: center;">No any session for this event</p>
    @endif
    </div>

</body>
@endsection
