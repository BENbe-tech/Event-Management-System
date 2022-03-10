@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/myevents.css')}}">
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
</head>
<body>


   
    {{-- @foreach ($event_details as $event_detail)
    @foreach ($event_titles as $event_title ) --}}

  <?php
//    $event = App\Models\Event::all()-> whereIn('organizer_id',$organizer_id);
//     echo $event;
//     foreach ($event->eventDetails as $details) {

//         echo $details->category;

//     }

         $organizer_id = App\Models\Organizer::all()->where('user_id',session('loginId'))->pluck('id');
         //echo   $organizer_id[0];
        //echo $organizer_id->count();
        $length = $organizer_id->count();

        for($i =0; $i<$length;$i++ ){
         //   echo $organizer_id[$i];
       $organizer_name = App\Models\Organizer::all()->where('id',$organizer_id[$i])->pluck('name');
        //    echo $organizer_name[0];

      $event_title =App\Models\Event::all()-> where('organizer_id',$organizer_id[$i])->pluck('event_title');
      $event_id =App\Models\Event::all()-> where('organizer_id',$organizer_id[$i])->pluck('id')
 ?>

     <h4><b>Organizer name:</b> {{$organizer_name[0]}}</h4>
    <?php
   $length_title = $event_title->count();
     for($j=0; $j<$length_title;$j++){
    ?>

        {{-- <h4><b>{{$event_title}}</b></h4> --}}
     <div class="container">
        {{-- <p>{{$event_detail->category}}</p>
        <p>{{$event_detail->starttime}}</p> --}}
        <span>Event title:
            <?php

                  echo $event_title[$j];
                  echo $event_id[$j];
              ?>
        </span>
        <a href="#">open</a>
      </div>

    <br>

<?php
        }
}
?>

{{-- @endforeach
    @endforeach --}}

</body>
@endsection


