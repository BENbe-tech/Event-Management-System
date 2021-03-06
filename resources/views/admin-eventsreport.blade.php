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

.topnav .search-container select {
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

  .topnav a, .topnav .search-container select, .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }

  .topnav .search-container select {
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


    <form action="{{route('adminorganizer-search')}}" method="post" enctype="multipart/form-data">
       @csrf
        <select id="organizer"  name ="category" value="{{ old('category') }}" required>

            <?php

              $count = count($users);
              for($i=0;$i<$count;$i++){

            ?>
                <option value = "{{$user_id[$i]}}" >{{$users[$i]}}</option>

          <?php
              }

          ?>
        </select>
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>

    </div>

  </div><br>


  <p style="float: right"><a href="admin-datereport" style="color:blue; ">Filter by date</a></p>
 <p>Total events for organizer {{$userx[0]}} = {{$events->count()}} event</p>




 <table class="styled-table">
        <thead>
            <tr>
                <th><b>Event title</b></th>
                <th><b>Date</b></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)

            <tr>
                <td>{{$event->event_title}}</td>
                <td>{{$event->eventDetails->starttime}}</td>

            </tr>

            @endforeach

   </tbody>
</table>

</div>



</body>
@endsection

