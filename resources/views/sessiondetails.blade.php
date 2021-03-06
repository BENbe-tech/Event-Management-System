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
$document_cloud =  $sessiondetails->document_cloud;
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

@if ($sessiondetails->online_link != "")
<p style="padding-left: 20px;"><b>Virtual event:</b><a href="{{url($link)}}" class="change"> {{$link_value }}</a></p>
@else
<p style="padding-left: 20px;"><b>Virtual event:</b> None</a></p>
@endif

@if ($sessiondetails->document_path!="")
{{-- <p style="padding-left: 20px;"><b>Document: </b><a href="{{url('/downloaddoc',$document_path)}}" class="change">{{ $document_value }}</a></p> --}}
<p style="padding-left: 20px;"><b>Document: </b><a href="{{$document_cloud}}" download class="change">{{ $document_value }}</a></p>
@else
<p style="padding-left: 20px;"><b>Document: </b> None</p>
@endif

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

<?php
$session_id = $session->id;
$id = $event_id;
?>

<div class=" inline1" >
    {{-- "{{url('session-participants/'.$event_id.'/'.$user_id.'/'.$session_id)}}" --}}
    <a style="padding-left: 20px;" href="{{url('edit.session/'.$session_id.'/'.$id)}}" class="btn_more">
      Edit session
    </a>



    <a style="padding-left: 20px;" id = "delete" href="{{route('delete.session',$session_id)}}" class="btn_more">
      Cancel session
    </a>

    <a style="padding-left: 20px;" href="{{url('session-notify/'.$session_id.'/'.$id)}}" id="notification" class="btn_more">
        Push Notification
      </a>


  </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>


<script>

jQuery(document).ready(function(){


    jQuery('#delete').click(function(e){
          e.preventDefault();

          if (confirm("Are you sure you want to cancel this session!    The session will be deleted automatically") == true) {


          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{route('delete.session',$session_id)}}",
             method: 'GET',
             timeout:5000,
             data: {
                "_token": "{{ csrf_token() }}",
             },
             success: function(result){
                alert(result.success);
                window.location.href="{{route('sessions', $id)}}";
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

      alert("Session not canceled");
        }

          });



});

</script>
</body>
@endsection
