<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name ="csrf-token" content="{{csrf_token()}}">

    <title>{{config('app.name','Event Managemnet System')}}</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src = "{{asset('js/app.js')}}" defer></script>


    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
</head>
<body >

{{--
    <div class="container">
     <div class="row">
      <div class = "col-md-4 col-md-offset-4" style="margin-top:20px;">
        <h4>Welcome to dashboard</h4>
        <hr>
        <table class="table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </thead>
    <tbody>
    <tr>
        <td>{{$data->name}}</td>
        <td>{{$data->email}}</td>
        <td><a href="logout">Logout</a></td>
    </tr>

    </tbody>
        </table>


      </div>

     </div>

    </div> --}}




{{--
<nav class = "navbar navbar-expand d-flex flex-column align-item-start" id="sidebar">

<a href = "#" class = "navbar-brand text-light mt-5">
<div class="display-5 font-weight-bold">THANOS</div>
</a>
<a href="logout">Logout</a>

<ul class="navbar-nav d-flex flex-column mt-5 w-100">

    <li class="nav-item w-100">
  <a href="#" class="nav-link text-light p1-4">Home</a>
    </li>

    <li class="nav-item w-100">
        <a href="#" class="nav-link text-light p1-4">About</a>
    </li>

    <li class="nav-item w-100">
        <a href="#" class="nav-link text-light p1-4">Blog</a>
    </li>

 <li class="nav-item dropdown w-100">
        <a href="#" class="nav-link dropdown-toggle text-light p1-4"
        id = "dropdownMenuLink" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">Service</a>

        <ul class ="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
            <li><a href ="#" class = "dropdown-item text-light pl-4 p-2">Service 01</a></li>
            <li><a href ="#" class = "dropdown-item text-light pl-4 p-2">Service 02</a></li>
            <li><a href ="#" class = "dropdown-item text-light pl-4 p-2">Service 03</a></li>

        </ul>
    </li>



    <li class="nav-item w-100">
        <a href="#" class="nav-link text-light p1-4">Contact</a>
    </li>


</ul>

</nav>

<section class = "p-4 my-container">
    <button class = "btn my-4" id ="menu-btn">Toggle Sidebar</button>
<h1>BootStrap 5 sidebar Navigation</h1>
<p class ="text-dark">paragraph</p>
</section> --}}





<div class="wrapper">


<nav id = "sidebar">

<div class = "sidebar-header">

<h3>Bootstrap Slider</h3>

</div>


<ul class = "lisst-unstyled components">
<p>The Providers</p>
<li class = "active">
<a href = "#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
<ul class= "collapse lisst-unstyled" id = "homeSubmenu">

<li>
    <a href = "#">Home 1</a>
</li>

<li>
    <a href = "#">Home 2</a>
</li>

</ul>
</li>

<li>
    <a href="#">About</a>
</li>
<li>
    <a href = "#pageSubmenu" data-toggle="collapse" aria-expanded="false" class = "dropdown-toggle">Pages</a>
    <ul class = "collapse lisst-unstyled" id = "pageSubmenu">
        <li>
            <a href="#">Page 1</a>
        </li>

        <li>
            <a href="#">Page 2</a>
        </li>
    </ul>
</li>

<li>
    <a href="#">Policy</a>
</li>

<li>
    <a href="#">COntact us</a>
</li>

</ul>
</nav>


<div id = "content">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<button type = "button" id ="sidebarCollpase" class="btn btn-nfo" >
<i class = "fas fa-align-left"></i>
<span>Toggle Sidebar</span>
</button>
</div>
</nav>

<br><br>

<h2>Collapseible Sidebar using Bootstrap 4</h2>
<p>

    long story
</p>

<div class ="line"></div>
<h3>Lorem Ipsum</h3>


<p> Another long story</p>


</div>



</div>



</body>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
</html>
