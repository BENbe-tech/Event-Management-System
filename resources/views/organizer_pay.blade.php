

@extends('dashboard')

@section('content')

<head>
    {{-- <link rel="stylesheet" href="{{asset('css/registered-eventdetails.css')}}"> --}}
<style>
.required{
    color:red;
}

</style>
</head>
<body>

    <section class="vh-100" style="background-color: #f3f3f3;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">


    <h4>Pay for Subscription
    <a href ="{{route('home')}} " class="btn btn-danger float-right">Back</a>
    </h4>
    <hr>
    <form action="{{route('organizerpay')}}" method="post">
        @if(Session::has('success'))
        <div class = "alert alert-success">{{Session::get('success')}}</div>
           @endif
           @if(Session::has('fail'))
           <div class = "alert alert-danger">{{Session::get('fail')}}</div>
              @endif
       @csrf



       <div class="form-group">
       <label for="phone">Phone number</label><span class ="required"> *</span>
       <input type = "name" class = "form-control" placeholder="255656500912" id = "phone" name="phone" value="{{old('phone')}}" required>
       <span class = "text-danger">@error('phone'){{$message}} @enderror</span>
      </div>

      <div class="form-group">
        <label for="provider">Service provider</label><span class ="required"> *</span>
        <select id="provider" class = "form-control" name ="provider" value="{{ old('provider') }}" required>
      <option value = "Tigo" selected>Tigo</option>
      <option value = "Vodacom" >Vodacom</option>
      <option value = "Airtel" >Airtel</option>
      <option value = "TTCL" >TTCL</option>
        </select>
        <span class = "text-danger">@error('provider'){{$message}} @enderror</span>
        </div>


        <div class="form-group">
            <label for="subtype">Subscription Type</label><span class ="required"> *</span>
            <select id="type" class = "form-control" name ="type" value="{{ old('type') }}" required>
          <option value = "Monthly" selected>Monthly</option>
          <option value = "Yearly" >Yearly</option>
            </select>
            <span class = "text-danger">@error('type'){{$message}} @enderror</span>
         </div>



        <div class="form-group">
            <label for="amount">Amount (in Tsh)</label><span class ="required"> *</span>
            <input type = "name" class = "form-control" placeholder="5000" name="amount" id="amount" value="{{old('amount')}}" required>
            <span class = "text-danger">@error('amount'){{$message}} @enderror</span>
          </div>



          <p>Yearly Subscription:<b>60,000</b></p>
          <p>Monthly Subscription:  <b>5,000</b></p>
          <p>Payment should be Tsh 1,000 and above</p>

      <div class ="form-group">
     {{-- <button class =" btn btn-block btn-primary" id="pay" type="submit">Pay</button> --}}
     <button class =" btn btn-block btn-primary" type="submit">Pay</button>
      </div>

      </form>
  </div>
    </div>
     </div>
       </div>
        </div>
    </section>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                   crossorigin="anonymous">
    </script>


<script>


jQuery(document).ready(function(){
           jQuery('#pay').click(function(e){
              e.preventDefault();
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 }
             });

             var type =  $('#type').val();
             var amount =  $('#amount').val();
             var provider =  $('#provider').val();
             var phone =   $('#phone').val();

              jQuery.ajax({
                url: "{{url('organizerpay')}}",
                 method: 'POST',
                 timeout:30000,
                 data: {
                    "_token": "{{ csrf_token() }}",
                    "type": type,
                    "amount": amount,
                    "provider": provider,
                    "phone": phone,
                 },
                 success: function(result){

                    alert(result.success);

                 },

                 error: function(request, status, err) {
        if (status == "timeout") {

            alert("timeout: Problem with your internet connetion. too slow");
        } else {

            alert("error: " + request + status + err);
          }
         }
                });
              });

            });
</script>


</body>

@endsection
