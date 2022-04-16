@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/myevents.css')}}">
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
</head>
<body>
    <?php
      $organizer_id = App\Models\Organizer::all()->where('user_id',session('loginId'))->pluck('id');
      $event_title =App\Models\Event::all()-> whereIn('organizer_id',$organizer_id)->pluck('event_title');

    //   phpinfo();

    //   if (!extension_loaded('imagick')){
    //   echo 'imagick not installed';
    //  }

?>
@if($event_title!="[]")
    <div>

{{-- The table is used to display the event created by the specific organizer
who is created by the user of the system. It displays specific event title
and organizer of the event respectively .Will not be displayed if there is no event
created --}}
<h4><b>My Created Events</b></h4>
    <table class="styled-table">
        <thead>
            <tr>
                <th><b>Event title</b></th>
                <th><b>Organizer name</b></th>

            </tr>
        </thead>
        <tbody>
  <?php


         $organizer_id = App\Models\Organizer::all()->where('user_id',session('loginId'))->pluck('id');

        $length = $organizer_id->count();

        for($i =0; $i<$length;$i++ ){

       $organizer_name = App\Models\Organizer::all()->where('id',$organizer_id[$i])->pluck('name');


      $event_title =App\Models\Event::all()-> where('organizer_id',$organizer_id[$i])->pluck('event_title');
      $events_id =App\Models\Event::all()-> where('organizer_id',$organizer_id[$i])->pluck('id');

   $length_title = $event_title->count();
     for($j=0; $j<$length_title;$j++){
         $event_id = $events_id[$j];
    ?>

            <tr>
                <td><a href="{{route('myeventdetails', $event_id)}}" class="title"><b>{{$event_title[$j]}}</b></a></td>
                <td><b>{{$organizer_name[0]}}</b></td>

            </tr>

<?php
        }
}
?>
   </tbody>
</table>
<a  href="{{route('createdevents-report')}}" class="btn_more1" >
    View Events Report
</a>
<p class="central" style="text-align: center;">Click Event title of particular event to open it</p>
</div>
@else
<p style="text-align: center;">You have not created any event</p>
@endif
</body>
@endsection



