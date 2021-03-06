@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/session.css')}}">

</head>
<body>
    @if($count!=0)

<div>
<table class="styled-table">
    <thead>

        <tr>
            <th><b>Session name</b></th>
            <th><b>Start Date</b></th>

        </tr>
    </thead>
    <?php
       $event_id = $id;
    ?>
    <tbody>
  @foreach ($sessions as $session )


        <tr>
            <td><a href="{{url('sessiondetails/'.$session->id.'/'.$event_id)}}" class="title"><b>{{$session->name}}</b></a></td>
            <td><b>{{$session->sessionDetails->date}}</b></td>
        </tr>

@endforeach
    </tbody>
</table>

<a  href="{{route('eventsessions-report',$id)}}" style="padding-left:170px;"class="btn_more1" >
    View Sessions Report
</a>

<p class="central" style="text-align: center;">Click Session title to view details</p>

@else
<p style="text-align: center;">You have not created any Session</p>
@endif
</div>
</body>
@endsection
