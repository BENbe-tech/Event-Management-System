@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/home-event.css')}}">

</head>
<body>

<h4><b>Event Details</b></h4>

{{-- The if statements are used to check whether the event details are empty or not
    and what should be displayed when the eventdetail is empty --}}

<?php
$event_detail = App\Models\Event::find($id)->eventDetails;
$organizer    = $event->organizers;
$user         = $organizer->users;


$image_path = $event_detail->image_path;


if($organizer->description!=""){
       $description = $organizer->description;
    }else{
        $description = "None";
    }

if($event_detail->price !=""){
   $price = $event_detail->price;
}else{
    $price  =  "Free";
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


$event_id = $event->id;
$user_id = session('loginId');

$title = $event->event_title;
$eventdetails_id = $event_detail->id;

?>

{{-- the card class displays the details of event --}}


<div class="card">
    <div class ="inline1">
        <div class = "image">
      {{-- <img src="{{ asset('storage/ImageFolder/'.$image_path) }}" alt="{{$event_detail->image_name}}" > --}}
      <img src="{{ $event_detail->image_cloud }}" alt="{{$event_detail->image_name}}" >

        </div>

        <div class="details" >

        <p style="padding-left: 20px;"><b>Title: </b>{{$event->event_title}}</p>


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


       <div class ="inline">
       <p style="padding-left: 20px;"><b>Speaker:</b> {{$speaker}}</p>

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



        <div class ="inline">
       <p style="padding-left: 20px;"><b>Starttime:</b> {{$event_detail->starttime}}</p>
        <p style="padding-left: 20px;"><b>Endtime: </b>{{$event_detail->endtime}}</p>
        </div>


           <div class="inline button" >

            @if($user_id != "")

            <a href="{{url('participants/'.$event_id.'/'.$user_id)}}" id="register" style="padding-left: 20px;" class="btn_more">
              Register for event
            </a>

            @endif


            {{-- <a style="padding-left: 20px;" href="{{url('addtocalendar/'. $title.'/'.$eventdetails_id)}}" id = "calendar" class="btn_more">
                Add to Calendar
            </a> --}}

          </div>
          @if(Session::has('fail'))
               <div class = "alert alert-danger">{{Session::get('fail')}}</div>
                  @endif
         <p style="padding-left: 20px; padding-top:10px;"><b>Share Event</b>
         <div class="container mt-4">

         {!! $shareComponent !!}
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


    <div class = "organizer">
        <h5 style="padding-left: 20px;"><b>Organizer information</b></h5>
        <p style="padding-left: 20px;"><b>Name:</b> {{$organizer->name}}</p>
        <p style="padding-left: 20px;"><b>Description:</b> {{$description}}</p>
        <p style="padding-left: 20px;"><b>Email:</b> {{$organizer->email}}</p>
        <p style="padding-left: 20px;"><b>Phone No:</b> {{$user->phone}}</p>
    </div>

    <div class ="session ">
        <p style="padding-left: 20px;"><b>Present Sessions</b></p>

        <a style="padding-left: 20px;" href="{{route('event-sessions', $event->id)}}" class="btn_more1" >
            Show Sessions
          </a>

    </div>
        </div>



    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                   crossorigin="anonymous">
    </script>


    <script>
        jQuery(document).ready(function(){
           jQuery('#register').click(function(e){
              e.preventDefault();
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 }
             });
              jQuery.ajax({
                url: "{{url('participants/'.$event_id.'/'.$user_id)}}",
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

            alert("timeout: Problem with your internet connetion. too slow");
        } else {

            alert("error: " + request + status + err);
          }
         }
                });
              });



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

            alert("timeout: Problem with your internet connetion. too slow");
           } else {

            alert("error: " + request + status + err);
           }
        }

            });
          });



           });
    </script>



{{-- MAP --}}

</body>
@endsection
