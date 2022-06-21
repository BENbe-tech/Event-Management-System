@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/ticket.css')}}">

    <script type="text/javascript" src = "{{asset('js/ticket.js')}}" defer></script>

</head>
<body>

<!--
Inspired by: https://dribbble.com/shots/1166639-Movie-Ticket/attachments/152161
-->

<?php
 $image_path = $event_details->image_path;
 $name =  $event->event_title;

?>


<div class="ticket">
	<div class="holes-top"></div>
	<div class="title">
		<p class="event-title">{{$event->event_title}}</p>
	</div>
	<div class="poster">
		{{-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/25240/only-god-forgives.jpg" alt="Movie: Only God Forgives" /> --}}
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

    <table>
		<tr>
			<th>TICKET NUMBER</th>

		</tr>
		<tr>
			<td>{{$number}}</td>
		</tr>
	</table>
    <hr>
	</div>

	<div class="serial visible-print text-center">



    {!! QrCode::size(250)->generate($name.$qr.$link); !!}



	</div>

</div>


</body>
@endsection
