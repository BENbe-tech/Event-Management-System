@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

</head>
<body>
    <?php

    $user_id = $user->id;
    ?>

    <h4><b>User Profile</b></h4>



    <div class="card">

        <div class ="inline">

            <div class = "user">

                <p><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<b>Name:</b>  {{$user->name}}</p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<b>Email:</b>  {{$user->email}}</p>
                <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<b>Phone: </b> {{$user->phone}}</p>
                <span><a class="change" href="{{route('update-profile',$user_id)}}">edit profile</a></span>
            </div>

        <div class= "details">
            <p><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;<b>Organizers </b></p>

          @if ($organizers != "[]")


                @foreach ( $organizers as $organizer )

                {{$organizer->name}} <br>

                @endforeach
             @else
                <p>No Organizer Creted</p>
            @endif
        </div>

        </div>
    </div>


</body>
@endsection
