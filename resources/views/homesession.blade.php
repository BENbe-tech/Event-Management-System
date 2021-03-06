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
        <tbody>
      @foreach ($sessions as $session )


            <tr>
                <td><a href="{{route('event-sessiondetails', $session->id)}}" class="title"><b>{{$session->name}}</b></a></td>
                <td><b>{{$session->sessionDetails->date}}</b></td>
            </tr>

    @endforeach
        </tbody>
    </table>
    <p class="central" style="text-align: center;">Click Session title to view details</p>

    @else
    <p style="text-align: center;">No any Session for this event</p>
    @endif
    </div>

</body>
@endsection
