@extends('dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="{{asset('css/registered-eventdetails.css')}}">
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
    {{-- <script type="text/javascript" src = "{{asset('js/registered-eventdetails.js')}}" defer></script> --}}

</head>
<body>



    <h4><b>Event Details</b></h4>

    {{-- The if statements are used to check whether the event details are empty or not
    and what should be displayed when the eventdetail is empty --}}

    <?php

    $image_path = $event_detail->image_path;
    $user         = $organizer->users;

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
    $event_id = $event->id;

    $event= App\Models\Event::find($event->id);
    $eventdetails = $event->eventDetails;
    $title = $event->event_title;
    $eventdetails_id = $eventdetails->id;

    ?>

    {{-- class card display the event details of the particular event created by the organizer
    who is created by the specific user of the system . Also the buttons to unregister, verify attendance
    comments and payment events--}}


    <div class="card">
    <div class ="inline1">
        <div class = "image">
      {{-- <img src="{{ asset('storage/ImageFolder/'.$image_path) }}" alt="{{$event_detail->image_name}}" > --}}
      <img src="{{ $event_detail->image_cloud}}" alt="{{$event_detail->image_name}}" >
        </div>

        <div class="details" >

        <p style="padding-left: 20px;"><b>Title: </b>{{$event->event_title}}</p>


        <div class ="inline" >
        <p style="padding-left: 20px;"><b>Venue:</b> {{$venue}}</p>
        <p style="padding-left: 20px;"><b>Location: </b>{{$address}}</p>
        </div>

        <p style="padding-left: 20px;"><b>City: </b>{{$city}}</p>



        @if ($event_detail->online_link != "")
        <p style="padding-left: 20px;"><b>Virtual event:</b><a href="{{url($link)}}" class="change"> {{$link_value }}</a></p>
        @else
        <p style="padding-left: 20px;"><b>Virtual event:</b> None</a></p>
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




        <div class="inline button" >

        <a style="padding-left: 20px;" href="{{route('comment', $event->id)}}" class="btn_more">
            Comment
             </a>

            {{-- <a style="padding-left: 20px;" id="verify" href="{{route('verify',$event->id)}}" class="btn_more">
              Verify Attendance
            </a> --}}

        <a style="margin-left: 10px; height:40%; " data-toggle="modal" data-target="#modeverifymodal"  href ="#" id="modeverify" class="btn btn-primary ">Verify Attendance</a>

        </div>





        <div class="modal fade" id="modeverifymodal" tabindex="-1" role="dialog" aria-labelledby="modeverify" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Verify {{$event->event_title}} Attendance </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">




                    {{-- @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">??</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    @if(Session::has('fail'))
                    <div class = "alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">??</a>
                       <p> {{Session::get('fail')}} </p>

                    </div>
                    @endif --}}



                    <form action="{{route('verifymode')}}" method="post">

                        <input type="hidden" id="event_id" name="event_id" value="{{$event->id}}">

                        @csrf

                        <div class="form-group">
                            <label for="mode">Attendance Mode</label><span> *</span>
                          <select id="mode" class = "form-control" name ="mode"  value="{{ old('mode') }}" required>
                        <option value = "Physical" selected>Physical</option>
                        <option value = "Virtual" >Virtaul</option>
                        <option value = "Hybrid" >Hybrid</option>
                          </select>
                          <span class = "text-danger">@error('mode'){{$message}} @enderror</span>
                          </div>

                          <button class =" btn btn-block btn-primary" id="verifymode" type="submit">Verify Attendance</button>

                      </form>


                </div>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
              </div>
            </div>
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
   <div class = "payment">
       @if ($price != "Free")
       <p style="padding-left: 20px;"><b>Price: </b>Tsh {{$price}}</p>
       <?php
       $user_id = session('loginId');
       $amountpaid = App\Models\Payment::all()->where('event_id',$event_id)->where('user_id',$user_id)->sum('amount');

    if($amountpaid == 0){
        $percent = 0;
    }else{

       $percent = ($amountpaid/ $price) * 100 ;

    }
       ?>

<div class="container">
    <p style="padding-left: 5px;"> {{$percent}}% Payment (Done)</p>
    @if ($percent != 0)
    <div class="progress">
        <div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$percent}}%">
          {{$percent}}%
        </div>
      </div>
    @endif
  </div><br>





       @else
       <p style="padding-left: 20px;"><b>Price: </b> {{$price}}</p>
      @endif
    <div class="inline" >
    @if(  $price  !=  "Free")
    <a style="padding-left: 20px;" href="{{route('participant-payview2', $event->id)}}" class="btn_more1" >
        Pay via Mobile
      </a>

      <a style="padding-left: 20px;" href="{{route('participant-payview', $event->id)}}" class="btn_more1" >
        Pay via Card
      </a>
     @endif

    {{-- <a style="padding-left: 20px;" id = "calendar" href="{{url('addtocalendar/'. $title.'/'.$eventdetails_id)}}" class="btn_more1" >
        Add to calendar
      </a> --}}

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



    <div class ="session inline">
        <p style="padding-left: 20px;"><b>Present Sessions</b></p>

        <a style="padding-left: 20px;" href="{{route('registeredevents-sessions', $event->id)}}" class="btn_more1" >
            Show Event Sessions
          </a>


        <a style="padding-left: 20px;" href="{{route('participant.sessions', $event->id)}}" class="btn_more1" >
            Sessions Registered
          </a>
    </div>

    </div>

{{-- MAP --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>



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


          jQuery('#verify').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{url('verify',$event->id)}}",
             method: 'GET',
             timeout:5000,
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



          jQuery('#verifymode').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });

             var event_id =  $('#event_id').val();
             var mode     =  $('#mode').val();

          jQuery.ajax({
            url: "{{url('verifymode')}}",
             method: 'POST',
             timeout:6000,
             data: {
                "_token": "{{ csrf_token() }}",
                "event_id": event_id,
                "mode"     : mode,
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
