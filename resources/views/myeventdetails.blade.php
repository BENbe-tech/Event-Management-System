@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/myeventdetails.css')}}">

</head>
<body>



<h4><b>Event Details</b></h4>

{{-- The if statements are used to check whether the event details are empty or not
and what should be displayed when the eventdetail is empty --}}

<?php

$image_path = $event_detail->image_path;
$user       = $organizer->users;
$event_id   = $event->id;


if($event_detail->price !=""){
   $price = $event_detail->price;
}else{
    $price  =  "Free";
}


if ($event_detail->document_path!="") {

    $document_path = $event_detail->document_path;
    $document_cloud = $event_detail->document_cloud;
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


if($organizer->description!=""){
       $description = $organizer->description;
    }else{
        $description = "None";
    }

    $title = $event->event_title;
    $eventdetails_id = $event_detail->id ;

?>

{{-- class card display the event details of the particular eventin which
the user has registered. Also the buttons to delete and edit events
,comments and event report--}}


<div class="card">
<div class ="inline1">
    <div class = "image">
  {{-- <img src="{{ asset('storage/ImageFolder/'.$image_path) }}" alt="{{$event_detail->image_name}}" > --}}

  <img src="{{$event_detail->image_cloud}}" alt="{{$event_detail->image_name}}" >
    </div>

    <div class="details" >

    <p style="padding-left: 20px;"><b>Title: </b>{{$event->event_title}}</p>

    <p style="padding-left: 20px;"><b>Category: </b>{{$event_detail->category}}</p>


    <div class ="inline" >
    <p style="padding-left: 20px;"><b>Venue:</b> {{$venue}}</p>
    <p style="padding-left: 20px;"><b>Location: </b>{{$address}}</p>
    </div>

    <p style="padding-left: 20px;"><b>City: </b>{{$city}}</p>

    @if ($price != "Free")
    <p style="padding-left: 20px;"><b>Price: </b>Tsh {{$price}}</p>
    @else
    <p style="padding-left: 20px;"><b>Price: </b> {{$price}}</p>
   @endif

    @if ($event_detail->online_link != "")
    <p style="padding-left: 20px;"><b>Virtual event:</b><a href="{{url($link)}}" class="change"> {{$link_value }}</a></p>
    @else
    <p style="padding-left: 20px;"><b>Virtual event:</b> None</a></p>
    @endif


    <div class ="inline">
   <p style="padding-left: 20px;"><b>Speaker:</b> {{$speaker}} </p>

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
            {{$event_detail->speaker_profile}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>

@endif

   @if ($event_detail->document_path!="")
   {{-- <p style="padding-left: 20px;"><b>Document: </b><a href="{{url('/download',$document_path)}}" class="change">{{ $document_value }}</a></p> --}}
   <p style="padding-left: 20px;"><b>Document: </b><a href="{{$document_cloud}}" download class="change">{{ $document_value }}</a></p>

   @else
   <p style="padding-left: 20px;"><b>Document: </b> None</p>
   @endif



    <div class ="inline">
   <p style="padding-left: 20px;"><b>Starttime:</b> {{$event_detail->starttime}}</p>
    <p style="padding-left: 20px;"><b>Endtime: </b>{{$event_detail->endtime}}</p>
    </div>


    <div class=" inline" >
        <a style="padding-left: 20px;" href="{{route('edit', $event_id)}}" class="btn_more">
          Update Event
        </a>

        <a style="padding-left: 20px;" href="{{route('delete', $event_id)}}" id="delete" class="btn_more">
          Cancel Event
        </a>

        <a style="padding-left: 20px;" href="{{route('send.notification', $event_id)}}" id="notification" class="btn_more">
            Email Notification
          </a>
      </div>



  </div>
</div>
<div class ="footer">
   <h5><b>Description:</b></h5>
  <p>{{$event_detail->description}}</p>
</div>
</div>


<div class="card2">

    <div class ="inline2">
<div class = "report">

    <div class=" inline" >
<a style="padding-left: 20px;" href="{{url('addtocalendar/'. $title.'/'.$eventdetails_id)}}" class="btn_more1" id = "calendar" >
    Add to calendar
  </a>


  <a style="padding-left: 20px;" href="{{route('notify',$event_id)}}" id="notification" class="btn_more">
    Push Notification
  </a>

    </div>


<p style="padding-left: 20px; padding-top:10px;"><b>Share Event</b>
<div class="container mt-4">

    {!! $shareComponent !!}
</div>

</div>

<div class = "organizer">
    <h5 style="padding-left: 20px;"><b>Organizer information</b></h5>
    <p style="padding-left: 20px;"><b>Name:</b> {{$organizer->name}}</p>
    <p style="padding-left: 20px;"><b>Description:</b> {{$description}}</p>
    <p style="padding-left: 20px;"><b>Email:</b> {{$organizer->email}}</p>
    <p style="padding-left: 20px;"><b>Phone No:</b> {{$user->phone}}</p>
</div>
    </div>



<div class ="sessions">
    <p style="padding-left: 20px;"><b>Present Sessions</b>

    </p>
    <div class="inline" >
    <a style="padding-left: 20px;" href="{{route('create-session', $event_id)}}" class="btn_more1" >
        Create Session
      </a>

      <a style="padding-left: 20px;" href="{{route('sessions', $event_id)}}" class="btn_more1" >
        Show Sessions
      </a>
    </div>


</div>

</div>

{{-- MAP --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>
    jQuery(document).ready(function(){
       jQuery('#calendar').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{url('addtocalendar/'. $title.'/'.$eventdetails_id)}}",
             method: 'GET',
             timeout:8000,
             data: {
                "_token": "{{ csrf_token() }}",
             },
             success: function(result){
                alert(result.success);
             },

         error: function(request, status, err) {
        if (status == "timeout") {
            // timeout -> reload the page and try again
            // console.log("timeout");
            // window.location.reload();
            alert("timeout: Problem with your internet connetion. too slow");

        } else {
            // another error occured
            alert("error: " + request + status + err);
        }
    }


            });
          });



          jQuery('#delete').click(function(e){
          e.preventDefault();

          if (confirm("Are you sure you want to cancel this event!    The event will be deleted automatically") == true) {


          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{route('delete', $event_id)}}",
             method: 'GET',
             timeout:5000,
             data: {
                "_token": "{{ csrf_token() }}",
             },
             success: function(result){
                alert(result.success);
                window.location.href="{{route('myevents')}}";
             },

             error: function(request, status, err) {
        if (status == "timeout") {
            alert("timeout: Problem with your internet connetion. too slow");
         } else {

            alert("error: " + request + status + err);
         }
       }

            });

        }else{

      alert("Event not canceled");
        }

          });



          jQuery('#notification').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{route('send.notification', $event_id)}}",
             method: 'GET',
             timeout:30000,
             data: {
                "_token": "{{ csrf_token() }}",
             },
             success: function(result){
                alert(result.success);
             },

         error: function(request, status, err) {
        if (status == "timeout") {

            alert("timeout: Problem with your internet connetion. too slow");

        } else {

            alert("error: " + request + status + err);
        }
    }


            });
          });



       });




</script>

</body>
@endsection
