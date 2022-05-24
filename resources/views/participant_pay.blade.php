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

    <h4>Pay for Event</h4>
    <hr>
    <form action="{{route('participantpay')}}" method="post">
        @if(Session::has('success'))
        <div class = "alert alert-success">{{Session::get('success')}}</div>
           @endif
           @if(Session::has('fail'))
           <div class = "alert alert-danger">{{Session::get('fail')}}</div>
              @endif
       @csrf
       <?php

        $id = $event_id;
       ?>

       <input type="hidden" id="event_id" name="event_id" value="{{$id}}">

       <div class="form-group">
         <label for="name">Full Name</label><span class ="required"> *</span>
         <input type = "name" class = "form-control" placeholder="Enter name" name="name" id = "name" value="{{old('name')}}" required>
         <span class = "text-danger">@error('name'){{$message}} @enderror</span>
       </div>


        <div class="form-group">
       <label for="email">Email</label><span class ="required"> *</span>
       <input type = "email" class = "form-control" placeholder="Enter Email" name="email" id="email" value="{{old('email')}}" required>
       <span class = "text-danger">@error('email'){{$message}} @enderror</span>
       </div>


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
            <label for="amount">Amount (in Tsh)</label><span class ="required"> *</span>
            <input type = "name" class = "form-control" placeholder="200" name="amount" id="amount" value="{{old('amount')}}" required>
            <span class = "text-danger">@error('amount'){{$message}} @enderror</span>
             </div>

             <?php
              $amountpaid = App\Models\Payment::all()->where('event_id',$id)->where('user_id',$user_id)->sum('amount');
              $amounttotal   = App\Models\EventDetail::all()->where('event_id',$id)->pluck('price');
              $amountremaining = $amounttotal[0] - $amountpaid;
             ?>

          <p>Amount Paid: {{$amountpaid}}</p>
          <p>Amount Remaining: {{$amountremaining}}</p>

      <div class ="form-group">
      <button class =" btn btn-block btn-primary" type="submit">Pay</button>
      </div>

      </form>
  </div>
    </div>
     </div>
       </div>
        </div>
    </section>

</body>

@endsection
