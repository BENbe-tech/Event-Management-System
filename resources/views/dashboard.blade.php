<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name ="csrf-token" content="{{csrf_token()}}">

    <title>{{config('app.name','Event Managemnet System')}}</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script type="text/javascript" src = "{{asset('js/app.js')}}" defer></script>



     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
</head>
<body >

{{-- header class used to display the navigation bar  --}}

<header class= "header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" >Event Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

          <span></span>
          <span></span>
          <span></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php
             $user_id = session('loginId');
            ?>
            <li class="nav-item">
              <a class="nav-link" href="{{route('profile',$user_id)}}">Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('create-event')}}">Create Event</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{route('register.ticket')}}">Tickets</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropbtn" href="#">Events</a>
                <div class="dropdown-content">
                    <a href="{{route('myevents')}}">Created Events</a>
                    <a href="{{route('registered-events')}}">Registered events</a>
                    {{-- <a href="#">Link 3</a> --}}
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{route('schedule')}}">Schedule</a>
              </li>

            {{-- <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li> --}}
          </ul>

        <ul class = "navbar-nav ml-auto">

            <form action="{{route('logout')}}" method="POST">
             @csrf

            <button href="" class="btn btn-outline-success my-2 my-sm-0" type="submit">Signout</button>
            </form>

        </ul>
        </div>
      </nav>

</header>
<br>

{{-- Class conatiner is the point where other blades files will yield their content --}}

<div class ="container">

    @yield('content')
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src = "https://cdn.jsdeliver.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> --}}

</html>
