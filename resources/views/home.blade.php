@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

</head>
<body>


    <div class="topnav">

        <a  class="active"><h5>Explore Events</h5></a>
        <div class="search-container">
          <form action="/action_page.php">

            <select id="organizer"  name ="organizer" value="" required>
                <option value = "1" selected>All</option>
                @foreach ($event_categorys as $event_category )
                
                <option value = "{{$event_category->id}}" >{{$event_category->category_name}}</option>
                @endforeach
            </select>
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>




<div class = "container">

<div class="card">
    <div class = "image">
  <img src="{{ asset('storage/ImageFolder/pop.png') }}" alt="Avatar" style="width:100%">
    </div>
  <div class="details">
    <h5>Event title</h5>
  </div>
</div>




</div>
</body>
@endsection
