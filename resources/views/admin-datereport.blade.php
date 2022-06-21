@extends('admin-dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/myevents.css')}}">

    <style>


.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
  box-sizing: border-box;
  margin: 0;
  width: 100%;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container input {
  padding: 8px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width: 300px;
  color: black;
}

.topnav .search-container button:hover {
  background: #ccc;
}


@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }

  .topnav a, .topnav .search-container input, .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }

  .topnav .search-container input {
    border: 1px solid #ccc;
    width: 100%;
  }
}


    </style>
</head>
<body>

    <div>

<div class="topnav">

    <a  class="active"><h5>Filter event report</h5></a>

    <div class="search-container">


    <form action="{{route('admin-datesearch')}}" method="post" enctype="multipart/form-data">
       @csrf
       <input type="date" name="date" value="{{ old('date') }}" required>
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>

    </div>

  </div><br>
@if($events->count() != 0)

@if($events->count() > 1)
<p>Total events created on {{$date}} are {{$events->count()}} events</p>
@else
 <p>Total events created on {{$date}} is {{$events->count()}} event </p>
@endif

 <table class="styled-table">
        <thead>
            <tr>
                <th><b>Event title</b></th>
                <th><b>Organizer Name</b></th>
                <th><b>Organizer Email</b></th>

            </tr>
        </thead>
        <tbody>

<?php


foreach($events as $event){
    $organizer = $event->organizers;
?>
            <tr>
                <td>{{$event->event_title}}</td>
                <td>{{ $organizer->users->name}}</td>
                <td>{{ $organizer->users->email}}</td>

            </tr>

<?php
}
?>

   </tbody>
</table>
@else
<p style="text-align: center;">No event Available</p>
@endif
</div>


</body>
@endsection

