@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">

</head>
<body>

<div class = "start">
    <h2>Comment Messages</h2>

@foreach ($comments as $comment)

<?php
//organizer user
if($comment->user_id == $user_id){
    $user_organizer = App\Models\User::find($user_id);
?>

    <div class="container1">

     <span class="icon-right"> <i class="fa fa-user fa-2x"  aria-hidden="true"></i></span>
     <span style="float:right;">{{$user_organizer->name}}</span><br>
     <span style="float:right;">{{$comment->message}}</span><br>
     <span class="time-right">{{$comment->created_at}}</span>
    </div>

<?php
     }else{
         //participant user
         $user_participant = App\Models\User::find($comment->user_id);
?>

    <div class="container1 darker">

      <span class="icon-left"><i class="fa fa-user-circle fa-2x"  aria-hidden="true"></i></span>
      <span>{{$user_participant->name}}</span>
      <p>{{$comment->message}}</p>
      <span class="time-left">{{$comment->created_at}}</span>
    </div>

    <?php
    }
    ?>

@endforeach

    {{-- <div class="container1">
      <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
      <p>Sweet! So, what do you wanna do today?</p>
      <span class="time-right">11:02</span>
    </div>

    <div class="container1 darker">
      <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
      <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
      <span class="time-left">11:05</span>
    </div> --}}


        <?php
        $current_user_id = session('loginId');
        $event_id = $id;
        ?>


    <form action = "{{route('post-comment')}}" method="post" id="SubmitForm">
        @csrf
    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
      <div class="d-flex flex-start w-100">

        <div class="form-outline w-100">
          <textarea
            class="form-control"
            id="message"
            rows="4"
            name="message"
            style="background: #fff;"
            value="{{ old('message') }}"
            required
            autofocus
            autocomplete
          ></textarea>

          <label class="form-label" for="textAreaExample">Message</label>
          <span class = "text-danger">@error('message'){{$message}} @enderror</span>
        </div>
        <input type="hidden" id="user_id" name="user_id" value="{{$current_user_id}}">
        <input type="hidden" id="event_id" name="event_id" value="{{$event_id}}">
      </div>

      <div class="float-end mt-2 pt-1">
        <button class="btn btn-primary btn-sm" type="submit">Post comment</button>
        <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
      </div>
    </div>

  </form>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>

<script>


jQuery(document).ready(function(){
       jQuery('#SubmitForm').on('submit',function(e){
          e.preventDefault();

        let message = $('#message').val();
        let user_id = $('#user_id').val();
        let event_id = $('#event_id').val();

          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{url('post-comment')}}",
             method: 'POST',
             data: {
                "_token": "{{ csrf_token() }}",
                message:message,
                user_id:user_id,
                event_id:event_id,
             },
             success: function(result){

                window.location.href =  "{{route('comment', $event_id)}}"

             }
            });
          });
       });


    //    function fetchComments(){

    //     $.ajax({
    //     type: "GET",
    //     url: "{{url('fetchComment', $event_id)}}",
    //     dataType: "json",

    //     success:function(data){

    //       console.log(data.event_id);
    //       console.log(data.comments);
    //       console.log(data.user_id);


    //   "<?php    $user_id;   ?>"  = data.user_id;
    //   "<?php    $id;        ?>"  =  data.event_id;
    //   "<?php    $comments;  ?>"  = data.comments;

    //     }
    //     })
    //    }


</script>


</body>
@endsection
