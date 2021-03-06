@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/create.css')}}">
    <script type="text/javascript" src = "{{asset('js/create.js')}}" defer></script>
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
</head>
<body>
<form action="{{route('update')}}"  method="post" enctype="multipart/form-data">
    @if(Session::has('success'))
    <div class = "alert alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class = "alert alert-danger">{{Session::get('fail')}}</div>
          @endif
    @csrf
    {{-- @method('POST') --}}

    {{-- class container displays form for editing event --}}

    <?php
      $event_id = $event->id;
    ?>
    <div class="container">
        <i class="fa-solid fa-memo-circle-info"></i> <h3>Update event

            <a href ="{{route('myeventdetails', $event_id)}} " class="btn btn-danger float-right">Back</a>
        </h3>
      <p><span class ="required"> *</span> Must be filled</p>
      <hr>

    <div>
    <label for="title"><b>Event Title</b></label><span class ="required"> *</span>
    <input type="text" placeholder="Enter Title of your event" name="eventtitle" id="eventtitle" value="{{ $event->event_title}}" required autocomplete="eventtitle" autofocus>
    <span class = "text-danger">@error('eventtitle'){{$message}} @enderror</span>
   </div>


   <input type="hidden" id="event_id" name="event_id" value="{{$event->id}}">

   <input type="hidden" id="eventdetails_id" name="eventdetails_id" value="{{$event_details->id}}">


    <div>
      <label for="category"><b>Event Category</b></label><span class ="required"> *</span><br>
      <select id="category"  name ="category" value="{{ old('category') }}"  required>
     <?php $categories = App\Models\Category::all(); ?>
      @foreach ($categories as $category )
      <option value = "{{$category->category_name}} " selected>{{$category->category_name}}</option>
        @endforeach
      </select>
      <span class = "text-danger">@error('category'){{$message}} @enderror</span>
    </div><br>

    <div>
        <label for="Organizer"><b>Event Organizer</b></label><span class ="required"> * </span><a href ="{{route('organizer')}}">Add new profile for event organizer</a><br>
        <select id="organizer"  name ="organizer" value="{{ old('organizer') }}" required>
     <?php $organizers = App\Models\Organizer::all()->where('user_id',session('loginId')); ?>
     @foreach ($organizers as $organizer )
        <option value = "{{$organizer->id}}" selected>{{$organizer->name}}</option>
        @endforeach
        </select>
        <span class = "text-danger">@error('organizer'){{$message}} @enderror</span>
      </div><br>

      <h3>Venue and Location</h3>
      <hr>
      <div class ="formline">
      <div>
        <label for="venue"><b>Venue</b></label><br>
        <input type="text" placeholder="Enter Venue of your event" name="venue" id="venue" value="{{ $event_details->venue}}" autocomplete="venue" >
        <span class = "text-danger">@error('venue'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="Link"><b>Virtual Link</b></label><br>
        <input type="text" placeholder="Enter online link of event" name="link" id="link" value="{{ $event_details->online_link }}"  autocomplete="link" >
        <span class = "text-danger">@error('link'){{$message}} @enderror</span>
       </div>

    </div>

       <div class ="formline">
       <div>
        <label for="City"><b>City</b></label><br>
        <input type="text" placeholder="Enter City " name="city" id="city" value="{{ $event_details->city }}" autocomplete="city" >
        <span class = "text-danger">@error('city'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="address"><b>Address</b></label><br>
        <input type="text" placeholder="Enter an Address,Zipcode" name="address" id="address" value="{{$event_details->address}}"  autocomplete="address" >
        <span class = "text-danger">@error('address'){{$message}} @enderror</span>
       </div>
    </div>

       <h3>Time and Date</h3>
      <hr>
    <div class ="formline">
       <div>
        <label for="start"><b>Event start date and time</b></label><span class ="required"> *</span><br>
        <input type="datetime-local" placeholder="" name="start_date" id="start_date" value="{{ old('start_date') }}" required >
        <span class = "text-danger">@error('start_date'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="end"><b>Event end date and time</b></label><span class ="required"> *</span><br>
        <input type="datetime-local" placeholder="" name="end_date" id="end_date" value="{{ old('end_date') }}"  required >
        <span class = "text-danger">@error('end_date'){{$message}} @enderror</span>
       </div>
    </div>


    <h3>Payment and Description</h3>
    <hr>
  <div class ="formline">
     <div>
      <label for="entry_mode"><b>Entry Mode</b></label><span class ="required"> *</span><br>
    <select id="entry_mode"  name ="entry_mode" value="{{ old('entry_mode') }}" required>
        <option value = "paid" selected>Paid Event</option>
        <option value = "free" selected>Free Event</option>
    </select>
      <span class = "text-danger">@error('entry_mode'){{$message}} @enderror</span>
     </div>

     <div>
      <label for="price"><b>Price</b></label><br>
      <input type="text" placeholder="price for paid event" name="price" id="price" value="{{ $event_details->price }}"  >
      <span class = "text-danger">@error('price'){{$message}} @enderror</span>
     </div>

     <div>
        <label for="speaker"><b>Speaker</b></label><br>
        <input type="text" placeholder="Speaker of event" name="speaker" id="speaker" value="{{ $event_details->speaker }}"  >
        <span class = "text-danger">@error('speaker'){{$message}} @enderror</span>
    </div>
  </div>


  <div>
    <label for="sprofile"><b>Speaker's Profile</b></label><br>
    <textarea placeholder="Enter description" name="profile" id="profile" value="{{$event_details->speaker_profile }}" ></textarea>
    <span class = "text-danger">@error('profile'){{$message}} @enderror</span>
   </div>

  <div class ="formline">

    <div style="margin-right: 0;">
     <label for="document"><b>Document</b></label><br>
     <input type="file" placeholder="price for paid event" name="document" id="document" value="{{ old('document') }} "  >
     <p class="required">file(pdf) maximum size 4MB</p>
     <span class = "text-danger">@error('document'){{$message}} @enderror</span>
    </div>
    <div style="margin-left: 10px; ">
   <p>{{$event_details->document_name}}</p>
     </div>

    <?php
        $image_path = $event_details->image_path;

    ?>

    <div style="margin-right: 0;">
       <label for="image"><b>Image</b></label><span class ="required"> *</span><br>
       <input type="file" placeholder="Enter image for event" name="image" id="image" value="{{ old('image') }}" required>
       <p class="required">image(jpg,jpeg,png) maximum size 4MB</p>
       <span class = "text-danger">@error('image'){{$message}} @enderror</span>
   </div>

   <div style=" margin-left:10px;">
    <img src="{{ asset('storage/ImageFolder/'.$image_path) }} "  width="70px" height = "70px" alt="{{$event_details->image_name}}">

   </div>



 </div>

 <div>
    <label for="description"><b>Event Description</b></label><span class ="required"> *</span><br>
    <textarea placeholder="Enter description" name="description" id="description" value="{{ old('description') }}" required ></textarea>
    <span class = "text-danger">@error('description'){{$message}} @enderror</span>
   </div>


  <hr>
    <div>
        <button type="submit" class="registerbtn">Update Event</button>
    </div>

    </div>


  </form>

</body>
@endsection
