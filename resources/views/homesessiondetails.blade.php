@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/sessiondetails.css')}}">

</head>
<body>

<h4 style="margin-left: 50px;"><b>Session Details</b></h4>


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


<div class ="inline">

<p style="padding-left: 20px;">{{$sessiondetails->date}}&nbsp;&nbsp;<b>|</b></p>
<p style="padding-left: 20px;">{{$sessiondetails->start_time}}&nbsp;&nbsp;<b>to</b></p>
<p style="padding-left: 20px;">{{$sessiondetails->end_time}}</p>

</div>



<p style="padding-left: 20px;"><b>Venue: </b>{{$venue}}</p>

<div class ="inline">
<p style="padding-left: 20px;"><b>Speaker: </b>{{$speaker}}</p>

@if($speaker != "None")

<p><a style="padding-left: 20px;" href="#" data-toggle="modal" data-target="#exampleModal" class="btn_more"> view profile</a></p>
@endif

</div>


@if($speaker != "None")
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$speaker}} profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          {{$sessiondetails->speaker_profile}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>

@endif









<p style="padding-left: 20px;"><b>Description: </b>{{$description}}</p>



</div>


</body>
@endsection
