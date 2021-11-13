<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>



    <section class="vh-100" style="background-color: #ebe0e4;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">

        <h4>Registration</h4>
        <hr>
        <form action = "{{route('register-user')}}" method="post">
        @if(Session::has('success'))
     <div class = "alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class = "alert alert-danger">{{Session::get('fail')}}</div>
           @endif
        @csrf
          <div class="form-group">
       <label for="name"> Names</label>
      <input type = "text" class = "form-control" placeholder="Enter full Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
   <span class = "text-danger">@error('name'){{$message}} @enderror</span>

          </div><br>

          <div class="form-group">
            <label for="email">Email</label>
           <input type = "text" class = "form-control" placeholder="Enter Emial" name="email" value="{{ old('name') }}" required autocomplete="email">
           <span class = "text-danger">@error('email'){{$message}} @enderror</span>
               </div><br>

               <div class="form-group">
                <label for="password">Password</label>
               <input type = "password" class = "form-control" placeholder="Enter Password" name="password" value="" required autocomplete="new-password">
               <span class = "text-danger">@error('password'){{$message}} @enderror</span>
                   </div><br>

                   <div class="form-group">
                    <label for="password">Confirm Password</label>
                   <input type = "password" class = "form-control" placeholder="Confirm Password" name="password_confirmation" value="" required autocomplete="new-password">
                   <span class = "text-danger">@error('confirmpassword'){{$message}} @enderror</span>
                       </div>

                   <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="Administrator" name="roles[]">
                    <label class="form-check-label" for="Administrator">
                      Administrator
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2" id="Subscriber" name="roles[]">
                    <label class="form-check-label" for="Subscriber">
                      Subscriber
                    </label>
                  </div>

                   <div class ="form-group">
                    <button class =" btn btn-block btn-primary" type="submit">Register</button>
                   </div>
                   <br>
                   <a href="forgotpassword">Forgot Password</a>
          </form>


     </div>

    </div>
            </div>
          </div>
        </div>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
