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

        <section class="vh-100" style="background-color: #f3f3f3;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5">

        <h4>Login</h4>
        <hr>
        <form action="{{route('login-user')}}" method="post">
            @if(Session::has('success'))
            <div class = "alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class = "alert alert-danger">{{Session::get('fail')}}</div>
                  @endif
           @csrf
          <div class="form-group">
            <label for="email">Email</label>
           <input type = "email" class = "form-control" placeholder="Enter Emial" name="email" value="{{old('email')}}">
           <span class = "text-danger">@error('email'){{$message}} @enderror</span>
               </div><br>

               <div class="form-group">
                <label for="password">Password</label>
               <input type = "password" class = "form-control" placeholder="Enter Password" name="password" value="">
               <span class = "text-danger">@error('password'){{$message}} @enderror</span>
                   </div>
                   <br>

              <div class="login-actions">

             <span class = "login-checkbox">

     <input id = "remember" name ="remember" type ="checkbox" class="field login-checkbox"
             tabindex="4"/>
            <label class="choice" for="remember">Keep me signed in</label>
             </span>

              </div>


                   <div class ="form-group">
                    <button class =" btn btn-block btn-primary" type="submit">login</button>
                   </div>
                   <br>
                   <a href="registration">New User!! Register Here.</a><br>
                   <a href="forget-password">Forgot Password</a>
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
