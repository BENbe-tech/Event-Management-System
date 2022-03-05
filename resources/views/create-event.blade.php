@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/create.css')}}">
    <script type="text/javascript" src = "{{asset('js/create.js')}}" defer></script>
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
</head>
<body>
<form action="{{route('create-event1')}}"  method="post">
    @if(Session::has('success'))
    <div class = "alert alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class = "alert alert-danger">{{Session::get('fail')}}</div>
          @endif
    @csrf
    <div class="container">
        <i class="fa-solid fa-memo-circle-info"></i> <h3>Basic Details</h3>
      <p>Please fill in the form to enter the event details</p>
      <p><span class ="required"> *</span> Must be filled</p>
      <hr>

    <div>
    <label for="title"><b>Event Title</b></label><span class ="required"> *</span>
    <input type="text" placeholder="Enter Title of your event" name="eventtitle" id="eventtitle" value="{{ old('eventtitle') }}" required autocomplete="eventtitle" autofocus>
    <span class = "text-danger">@error('eventtitle'){{$message}} @enderror</span>
   </div>

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
        <input type="text" placeholder="Enter Venue of your event" name="venue" id="venue" value="{{ old('venue') }}" autocomplete="venue" >
        <span class = "text-danger">@error('venue'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="Link"><b>Virtual Link</b></label><br>
        <input type="text" placeholder="Enter online link of event" name="link" id="link" value="{{ old('link') }}"  autocomplete="link" >
        <span class = "text-danger">@error('link'){{$message}} @enderror</span>
       </div>
    </div>

       <div class ="formline">
       <div>
        <label for="City"><b>City</b></label><br>
        <input type="text" placeholder="Enter City " name="city" id="city" value="{{ old('city') }}" autocomplete="city" >
        <span class = "text-danger">@error('city'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="address"><b>Address</b></label><br>
        <input type="text" placeholder="Enter an Address,Zipcode" name="address" id="address" value="{{ old('address') }}"  autocomplete="address" >
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
    <hr>

    <div>
        <button type="submit" class="registerbtn">Continue</button>
    </div>

    </div>


  </form>

</body>
@endsection
