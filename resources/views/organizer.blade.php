@extends('dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="{{asset('css/organizer.css')}}">
    {{-- <script src="https://kit.fontawesome.com/fe05d227ea.js" crossorigin="anonymous"></script> --}}
</head>
<body>
<form action="{{route('create-organizer')}}"  method="post">
    {{-- @method('GET') --}}
    @if(Session::has('success'))
    <div class = "alert alert-success">{{Session::get('success')}}</div>
       @endif
       @if(Session::has('fail'))
       <div class = "alert alert-danger">{{Session::get('fail')}}</div>
          @endif
    @csrf
    <div class="container">
     <h3>Create Organizer Profile</h3>
      <p><span class ="required"> *</span> Must be filled</p>
      <hr>

    <div>
    <label for="name">Organizer profile name </label><span class ="required"> *</span>
    <input type="text" placeholder="Enter Organizer Profile name" name="name" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    <span class = "text-danger">@error('name'){{$message}} @enderror</span>
   </div>

   <div>
    <label for="description">Description</label>
    <textarea name="description" id="description" value="{{ old('description') }}" placeholder="Enter Description..."></textarea>
    <span class = "text-danger">@error('description'){{$message}} @enderror</span>
   </div>

   <div>
    <label for="email">Email</label><span class ="required"> *</span>
    <input type="email" placeholder="Enter Email" name="email" id="email" value="{{ old('email') }}" required >
    <span class = "text-danger">@error('email'){{$message}} @enderror</span>
   </div>

      <div class ="formline">
      <div>
        <label for="website">Website</label><br>
        <input type="text" placeholder="Enter website link" name="website" id="website" value="{{ old('website') }}">
        <span class = "text-danger">@error('webiste'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="facebook">Facebook</label><br>
        <input type="text" placeholder="Enter facebook link" name="facebook" id="facebook" value="{{ old('facebook') }}"  >
        <span class = "text-danger">@error('facebook'){{$message}} @enderror</span>
       </div>
    </div>

       <div class ="formline">
       <div >
        <label for="twitter">Twitter</label><br>
        <input type="text" placeholder="Enter twitter link" name="twitter" id="twitter" value="{{ old('twitter') }}" >
        <span class = "text-danger">@error('twitter'){{$message}} @enderror</span>
       </div>

       <div>
        <label for="instagram">Instagram</label><br>
        <input type="text" placeholder="Enter instagram link" name="instagram" id="instagram" value="{{ old('instagram') }}"  >
        <span class = "text-danger">@error('instagram'){{$message}} @enderror</span>
       </div>
    </div>

    <div class ="formline">
       <div>
        <label for="title">LinkedIn</label><br>
        <input type="text" placeholder="Enter linkedIn link" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" >
        <span class = "text-danger">@error('linkedin'){{$message}} @enderror</span>
       </div>
    </div>

    <div>
        <button type="submit" class="registerbtn">Create</button>
    </div>

    </div>

  </form>

</body>

@endsection
