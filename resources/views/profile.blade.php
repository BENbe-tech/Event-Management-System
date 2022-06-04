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
                <span><a class="change" href="{{route('update-profile',$user_id)}}">Edit profile</a></span>

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
            <a id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-primary float-end"> Allow notification</a>
            {{-- <a id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="change"> Allow notification</a> --}}
        </div>



        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                   crossorigin="anonymous">
    </script>

    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>

    <script>


    var firebaseConfig = {
                apiKey: "AIzaSyBa4IMUOp5iSAii_oNS2UMgxGfSEe4VN-U",
                authDomain: "ems-system-4a9ce.firebaseapp.com",
                databaseURL: "https://ems-system-4a9ce-default-rtdb.firebaseio.com/",
                projectId: "ems-system-4a9ce",
                storageBucket: "ems-system-4a9ce.appspot.com",
                messagingSenderId: "296613395959",
               appId: "1:296613395959:web:62d752dd125b212fcd02f2",
                measurementId: "G-T7QLH0JLL0"
            };

            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            function initFirebaseMessagingRegistration() {
                    messaging
                    .requestPermission()
                    .then(function () {
                        return messaging.getToken()
                    })
                    .then(function(token) {
                        console.log(token);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '{{url("save-token") }}',
                            type: 'POST',
                            data: {
                                token: token
                            },
                            dataType: 'JSON',
                            success: function (response) {
                                alert('Notification allowed successful.');
                            },
                            error: function (err) {
                                console.log('User Chat Token Error'+ err);
                            },
                        });

                    }).catch(function (err) {
                        console.log('User Chat Token Error'+ err);
                    });
             }

            messaging.onMessage(function(payload) {
                const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
            });

    </script>

</body>
@endsection
