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

<header class= "header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Event Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

          <span></span>
          <span></span>
          <span></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('create-event')}}">Create Event</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Tickets</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropbtn" href="#">Events</a>
                <div class="dropdown-content">
                    <a href="myevents">My Events</a>
                    <a href="#">Registered events</a>
                    <a href="#">Link 3</a>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Schedule</a>
              </li>

            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
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
<div class ="container">

    @yield('content')
</div>


</body>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src = "https://cdn.jsdeliver.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> --}}

</html>
