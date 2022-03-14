@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

</head>
<body>

   {{-- The topnav class consist of the search engine of events --}}

    <div class="topnav">

        <a  class="active"><h5>Explore Events</h5></a>
        <div class="search-container">
          <form action="{{route('home-search')}}" method="post" enctype="multipart/form-data">
           @csrf
            <select id="organizer"  name ="category" value="" required>
                <option value = "0" selected>All</option>
                @foreach ($event_categorys as $event_category )

                <option value = "{{$event_category->category_name}}" >{{$event_category->category_name}}</option>
                @endforeach
            </select>
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>


{{-- The container class consit of cards for displaying each event image, event title and book now link--}}

<div class = "container">

<?php
if($flag==1){
$length = $events->count();

for($i=0 ; $i<$length; $i++ ){


 $dataDetail =  App\Models\Event::find($IDevents[$i])->eventDetails;
 $dataEvent  = $events[$i];
 $event_id = $dataEvent->id;
?>

<div class="card">
    <div class = "image">
  <img src="{{ asset('storage/ImageFolder/'. $dataDetail->image_path) }}" alt="{{$dataDetail->image_name}}" >
    </div>
  <div class="details">
    <h5>{{$dataEvent->event_title}}</h5>
    <a href="{{route('home-event', $event_id)}}" class="title">Book Now</a>
  </div>
</div>

<?php
}}
elseif ($flag == 0) {

  ?>
 <p class = "response"><b>No event present</b></p>
  <?php
}

elseif($flag == 2){
    $length = $IDevents->count();

for($i=0 ; $i<$length; $i++ ){

$dataDetail =  App\Models\Event::find($IDevents[$i])->eventDetails;
$dataEvent =  App\Models\EventDetail::find($IDdetails[$i])->events;
$event_id = $dataEvent->id;

?>

<div class="card">
    <div class = "image">
  <img src="{{ asset('storage/ImageFolder/'. $dataDetail->image_path) }}" alt="{{$dataDetail->image_name}}" >
    </div>
  <div class="details">
    <h5>{{$dataEvent->event_title}}</h5>
    <a href="{{route('home-event', $event_id)}}" class="title">Book Now</a>
  </div>
</div>


<?php

}
}
else{
?>
<p class = "response"><b>Error in fetching events</b></p>

<?php
}
?>

</div>
</body>
@endsection
