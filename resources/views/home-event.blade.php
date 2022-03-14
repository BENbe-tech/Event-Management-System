@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/home-event.css')}}">

</head>
<body>

<h3><b>Event Details</b></h3>

<?php
$event_detail = App\Models\Event::find($id)->eventDetails;

$image_path = $event_detail->image_path;


if($event_detail->price !=""){
   $price = $event_detail->price;
}else{
    $price  =  "Free";
}


if ($event_detail->document_path!="") {

    $document_path = $event_detail->document_path;
    $document_value = "Download to view document";
}

if($event_detail->online_link!=""){
    $link = $event_detail->online_link;
    $link_value = "Online link";

}

if($event_detail->speaker!=""){
    $speaker = $event_detail->speaker;
}
else{
    $speaker = "None";
}


if($event_detail->venue!="")
{
    $venue = $event_detail->venue;

}else{
      $venue = "None";
}

if($event_detail->city!=""){
   $city = $event_detail->city;
}else{
   $city = "None";
}

if($event_detail->address!=""){
   $address = $event_detail->address;
}else{
    $address = "None";
}



?>

<div class="card">
    <div class ="inline1">
        <div class = "image">
      <img src="{{ asset('storage/ImageFolder/'.$image_path) }}" alt="{{$event_detail->image_name}}" >
        </div>

        <div class="details" >

        <p style="padding-left: 20px;"><b>Title: </b>{{$event->event_title}}</p>

        <p style="padding-left: 20px;"><b>Category: </b>{{$event_detail->category}}</p>



        <div class ="inline" >
        <p style="padding-left: 20px;"><b>Venue:</b> {{$venue}}</p>
        <p style="padding-left: 20px;"><b>Location: </b>{{$address}}</p>
        </div>

        <p style="padding-left: 20px;"><b>City: </b>{{$city}}</p>


        <p style="padding-left: 20px;"><b>Price:</b> {{$price}}</p>
        @if ($event_detail->online_link != "")
        <p style="padding-left: 20px;"><b>Virtual event:</b><a href="{{url($link)}}" class="change"> {{$link_value }}</a></p>
        @else
        <p style="padding-left: 20px;"><b>Virtual event:</b> None</a></p>
        @endif



       <p style="padding-left: 20px;"><b>Speaker:</b> {{$speaker}}</p>
       @if ($event_detail->document_path!="")
       <p style="padding-left: 20px;"><b>Document: </b><a href="{{url('/download',$document_path)}}" class="change">{{ $document_value }}</a></p>
       @else
       <p style="padding-left: 20px;"><b>Document: </b> None</p>
       @endif



        <div class ="inline">
       <p style="padding-left: 20px;"><b>Starttime:</b> {{$event_detail->starttime}}</p>
        <p style="padding-left: 20px;"><b>Endtime: </b>{{$event_detail->endtime}}</p>
        </div>


        <div class="event_more inline" >
            <a style="padding-left: 20px;" href="#" class="btn_more">
              Register for Event
            </a>

            <a style="padding-left: 20px;" href="#" class="btn_more">
              Pay for Event
            </a>
          </div>


      </div>
    </div>
    <div class ="footer">
       <h5><b>Description:</b></h5>
      <p>{{$event_detail->description}}</p>
    </div>
    </div>


</body>
@endsection