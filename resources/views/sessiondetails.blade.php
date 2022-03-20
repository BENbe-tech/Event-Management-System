@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/sessiondetails.css')}}">

</head>
<body>

<h4><b>Session Details</b></h4>

    {{-- class card display the session details of the particular session of
        the event .Also the buttons to delete and edit a session
and session report--}}

<?php
if ($sessiondetails->document_path!="") {

$document_path = $sessiondetails->document_path;
$document_value = "Download to view document";
}


if($sessiondetails->online_link!=""){
    $link = $sessiondetails->online_link;
    $link_value = "Online link";

}

if($sessiondetails->speaker!=""){
    $speaker = $sessiondetails->speaker;
}
else{
    $speaker = "None";
}

if($sessiondetails->venue!="")
{
    $venue = $sessiondetails->venue;

}else{
      $venue = "None";
}


if($sessiondetails->description!=""){
       $description = $sessiondetails->description;
    }else{
        $description = "None";
    }


?>
<div class="card">

<p style="padding-left: 20px;"><i class="fa fa-calendar" aria-hidden="true" ></i>{{$session->name}}</p>
<p style="padding-left: 20px;">{{$description}}</p>
<p style="padding-left: 20px;">{{$sessiondetails->date}}</p>
<p style="padding-left: 20px;">{{$sessiondetails->start_time}}</p>
<p style="padding-left: 20px;">{{$sessiondetails->end_time}}</p>

@if ($sessiondetails->online_link != "")
<p style="padding-left: 20px;"><b>Virtual event:</b><a href="{{url($link)}}" class="change"> {{$link_value }}</a></p>
@else
<p style="padding-left: 20px;"><b>Virtual event:</b> None</a></p>
@endif

@if ($sessiondetails->document_path!="")
<p style="padding-left: 20px;"><b>Document: </b><a href="{{url('/downloaddoc',$document_path)}}" class="change">{{ $document_value }}</a></p>
@else
<p style="padding-left: 20px;"><b>Document: </b> None</p>
@endif

<p style="padding-left: 20px;">{{$venue}}</p>
<p style="padding-left: 20px;">{{$speaker}}</p>

</div>
</body>
@endsection
