@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

</head>
<body>

    <section class="vh-100" style="background-color: #f3f3f3;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">

        <h4>Update Profile
        <a href ="{{route('profile',$id)}} " class="btn btn-danger float-right">Back</a>
        </h4>
        <hr>
        <form action = "{{route('updates-profile')}}" method="post">
        @if(Session::has('success'))
     <div class = "alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class = "alert alert-danger">{{Session::get('fail')}}</div>
           @endif
        @csrf
          <div class="form-group">
       <label for="name"> Fullname</label>
      <input type = "text" class = "form-control" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
   <span class = "text-danger">@error('name'){{$message}} @enderror</span>

          </div>

          <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">

          <div class="form-group">
            <label for="email">Email</label>
           <input type = "email" class = "form-control" name="email" value="{{ $user->email }}" required autocomplete="email">
           <span class = "text-danger">@error('email'){{$message}} @enderror</span>
               </div>


                    <div class ="form-group">
                   <label for="phone">Enter a Phone number:</label>
                   <input type="tel" class="form-control"  id="phone" name="phone"  value="{{ $user->phone }}" required autocomplete="phone">
                   <span class = "text-danger">@error('phone'){{$message}} @enderror</span>


                    </div>

                   <div class ="form-group">
                    <button class =" btn btn-block btn-primary" type="submit">Update Profile</button>
                   </div>
                   <br>


          </form>

     </div>
    </div>
            </div>
          </div>
        </div>
    </section>


</body>

@endsection
