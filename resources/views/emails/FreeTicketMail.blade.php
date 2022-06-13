<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/ticket.css')}}">

    <script type="text/javascript" src = "{{asset('js/ticket.js')}}" defer></script>
    <title>Send Email</title>

<style>

body {
  background-color: white;
  font-family: "Yanone Kaffeesatz", sans-serif;
  /* font-weight: 600; */
}

img {
  max-width: 100%;
  height: auto;
}

.ticket {
  width: 400px;
  height: auto;
  background-color: #f3f3f3;
  margin: 25px auto;
  position: relative;
}

.holes-top {
  height: 50px;
  width: 50px;
  background-color: white;
  border-radius: 50%;
  position: absolute;
  left: 50%;
  margin-left: -25px;
  top: -25px;
}
.holes-top:before, .holes-top:after {
  content: "";
  height: 50px;
  width: 50px;
  background-color: white;
  position: absolute;
  border-radius: 50%;
}
.holes-top:before {
  left: -200px;
}
.holes-top:after {
  left: 200px;
}

.title {
  padding: 50px 25px 10px;
}

.cinema {
  color: #aaa;
  font-size: 22px;
}

.event-title {
  font-size: 50px;
}

.info {
  padding: 15px 25px;
  background-color: #f3f3f3;
}

table {
  width: 100%;
  font-size: 18px;
  margin-bottom: 15px;
}
table tr {
  margin-bottom: 10px;
}
table th {
  text-align: left;
}
table th:nth-of-type(1) {
  width: 38%;
}
table th:nth-of-type(2) {
  width: 40%;
}
table th:nth-of-type(3) {
  width: 15%;
}
table td {
  width: 33%;
  font-size: 15px;
}

.bigger {
  font-size: 48px;
}

.serial {
  background-color: #f3f3f3;
  padding: 25px;
}



</style>



</head>
<body>


    <p>{{$details['title']}}</p>
    {{-- <p>{{$details['body']}}</p> --}}
    <p>{{$details['body1']}}<b>{{$details['event_title']}}</b>{{$details['body2']}}<b>{{$details['date']}}</b>{{$details['body3']}}</p>



  <?php

    $qr   =  $details['qr'];
    $user = $details['user'];
    $event_details = $details['eventdetails'];
    $event    =  $details['event'];

    $image_path = $event_details->image_path;
    $name =  $event->event_title;

?>


    <div class="ticket">
        <div class="holes-top"></div>
        <div class="title">
            <p class="event-title">{{$event->event_title}}</p>
        </div>
        <div class="poster">

            <img src="{{ asset('storage/ImageFolder/'.$image_path) }}" alt="{{$event_details->image_name}}" >
        </div>
        <div class="info">
        <table>
            <tr>
                <th>NAME</th>
                <th>VENUE</th>
            </tr>
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$event_details->venue}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>PRICE</th>
                <th>DATE</th>
            </tr>
            <tr>
                @if ($event_details->entry_mode == 'free')
                <td>Free</td>
                @else
                <td>{{$event_details->price}}</td>
                @endif

                <td>{{$event_details->starttime}}</td>
            </tr>
        </table>
        <hr>
        </div>

        <div class="serial visible-print text-center">



        {!! QrCode::size(250)->generate($name.$qr); !!}



        </div>

    </div>



    <p>Regards,</p>
    <p><b>EMS Tanzania</b></p>
</body>
</html>
