@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/createsession.css')}}">

    <script type="text/javascript" src = "{{asset('js/createsession.js')}}" defer></script>


</head>
<body>



<form action="{{route('update.session')}}"  method="post" enctype="multipart/form-data">

 @if(Session::has('success'))
 <div class = "alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class = "alert alert-danger">{{Session::get('fail')}}</div>
       @endif
 @csrf

 {{-- class container displays form for creating Session --}}

 <div class="container">
     <i class="fa-solid fa-memo-circle-info"></i> <h3>Update Session

        <a href ="{{route('sessions', $event_id)}}" class="btn btn-danger float-right">Back</a>

     </h3>

   <p><span class ="required"> *</span> Must be filled</p>
   <hr>

   <input type="hidden" id="session_id" name="session_id" value="{{$id}}">

   <input type="hidden" id="sessiondetails_id" name="sessiondetails_id" value="{{$session_details->id}}">

 <div>
 <label for="title"><b>Session Title</b></label><span class ="required"> *</span>
 <input type="text" placeholder="Enter Title of the session" name="sessiontitle" id="sessiontitle" value="{{ $session->name }}" required autocomplete="sessiontitle" autofocus>
 <span class = "text-danger">@error('sessiontitle'){{$message}} @enderror</span>
</div>

<div>
    <label for="description"><b>Description</b></label>
    <textarea placeholder="Enter description" name="description" id="description" value="{{ old('description') }}" ></textarea>
    <span class = "text-danger">@error('description'){{$message}} @enderror</span>
   </div>


   <div class ="formline">
   <div>
     <label for="venue"><b>Venue</b></label><br>
     <input type="text" placeholder="Enter Venue of your event" name="venue" id="venue" value="{{ $session_details->venue }}" autocomplete="venue" >
     <span class = "text-danger">@error('venue'){{$message}} @enderror</span>
    </div>

    <div>
     <label for="Link"><b>Virtual Link</b></label><br>
     <input type="text" placeholder="Enter online link of event" name="link" id="link" value="{{ $session_details->online_link}}"  autocomplete="link" >
     <span class = "text-danger">@error('link'){{$message}} @enderror</span>
    </div>

    <div>
        <label for="speaker"><b>Speaker</b></label><br>
        <input type="text" placeholder="Speaker of the Session" name="speaker" id="speaker" value="{{  $session_details->speaker }}"  >
        <span class = "text-danger">@error('speaker'){{$message}} @enderror</span>
    </div>
 </div>

 <div class ="formline">
    <div>
     <label for="start_time"><b>Session start time</b></label><span class ="required"> *</span><br>
     <input type="time" placeholder="" name="start_time" id="start_time" value="{{ old('start_time') }}" required >
     <span class = "text-danger">@error('start_time'){{$message}} @enderror</span>
    </div>

    <div>
     <label for="end_time"><b>Session end time</b></label><span class ="required"> *</span><br>
     <input type="time" placeholder="" name="end_time" id="end_time" value="{{ old('end_time') }}"  required >
     <span class = "text-danger">@error('end_time'){{$message}} @enderror</span>
    </div>

    <div>
        <label for="date"><b>Date</b></label><span class ="required"> *</span><br>
        <input type="date" placeholder="" name="date" id="date" value="{{ old('date') }}"  required >
        <span class = "text-danger">@error('date'){{$message}} @enderror</span>
       </div>



 </div>

<div class ="formline">

 <div style="margin-right: 0;">
    <label for="document"><b>Document</b></label><br>
    <input type="file" placeholder="Document of session" name="document" id="document" value="{{ old('document') }} "  >
    <p class="required">file(pdf) maximum size 4MB</p>
    <span class = "text-danger">@error('document'){{$message}} @enderror</span>
   </div>

   <div style="margin-left: 10px; ">
    <p>{{$session_details->document_name}}</p>
      </div>


</div>

<hr>


<div>
    <button type="submit" class="registerbtn">Update Session</button>
</div>

 </div>

</form>

</body>
@endsection
