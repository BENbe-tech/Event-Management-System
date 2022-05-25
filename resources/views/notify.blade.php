@extends('dashboard')

@section('content')

<head>
<style>

</style>
</head>
<body>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
                </center>
                <div class="card">
                    <div class="card-header">{{ __(' Notification') }}
                        <a href ="{{route('myeventdetails', $id)}} " class="btn btn-danger float-right">Back</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('push-notification') }}" method="POST">
                            @if(Session::has('success'))
                            <div class = "alert alert-success">{{Session::get('success')}}</div>
                               @endif
                               @if(Session::has('fail'))
                               <div class = "alert alert-danger">{{Session::get('fail')}}</div>
                                  @endif
                            @csrf

                            <input type="hidden" id="event_id" name="event_id" value="{{$id}}">

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                                <span class = "text-danger">@error('title'){{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea class="form-control" name="body"></textarea>
                                <span class = "text-danger">@error('body'){{$message}} @enderror</span>
                              </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </form>

                    </div>
                </div>
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
                            alert('notification allowed successful');
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
