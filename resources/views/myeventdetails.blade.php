@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/myeventdetails.css')}}">

</head>
<body>
    @foreach ($event_details as $event_detail)


<p>Category: {{$event_detail->category}}</p>
<p>online_link: </p>
<p>Venue: </p>
<p>City: </p>
<p>Adress: </p>
<p>Starttime: </p>
<p>Endtime: </p>
<p>Price: </p>
<p>Description: </p>
<p>Image name:{{$event_detail->image_name}} </p>
<?php
$image_path = $event_detail->image_path;
?>
<p>Image Path: {{$event_detail->image_path}}</p>
<img src="{{ asset('storage/ImageFolder/'.$image_path) }}" alt="{{$event_detail->image_name}}" width="500" height="333">
<?php
$document_path = $event_detail->document_path;
?>
<p>Document name:{{$event_detail->document_name}}</p>
<p>Document path: {{$event_detail->document_path}}</p>
<a href="{{url('/download',$document_path)}}">Download</a>
<p>Entrymode: </p>
<p>Speaker: </p>

@endforeach
</body>
@endsection
