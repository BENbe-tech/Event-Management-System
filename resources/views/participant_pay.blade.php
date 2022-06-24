<!DOCTYPE html>
<html>
<head>
	<title>Pay for event</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style type="text/css">
        .container {
            margin-top: 40px;
        }
        .panel-heading {
        display: inline;
        font-weight: bold;
        }
        .flex-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 55%;
        }


    </style>
</head>
<body>

    <?php

    $id = $event_id;
   ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row text-center">
                        <h3 class="panel-heading">Payment Details
                            <a href ="{{route('eventdetails', $id)}} " class="btn btn-danger float-right">Back</a>
                        </h3>
                    </div>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    @if(Session::has('fail'))
                    <div class = "alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                       <p> {{Session::get('fail')}} </p>

                    </div>
                    @endif

                    <form role="form" action="{{ route('participantpay') }}" method="post" class="validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                        @csrf





                        <input type="hidden"  id="event_id" name="event_id" value="{{$id}}">


                        {{-- <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label' >Email</label><span class ="required"> *</span> <input
                                    class='form-control email'  name="email"  value="{{old('email')}}" type='email' required>
                                    <span class = "text-danger">@error('email'){{$message}} @enderror</span>
                                </div>
                        </div> --}}




                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label' >Amount (in Tsh)</label><span class ="required"> *</span> <input
                                    class='form-control amount'  name="amount" placeholder='5000' value="{{old('amount')}}" type='text' required>
                                    <span class = "text-danger">@error('amount'){{$message}} @enderror</span>
                                </div>
                        </div>


                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text' name = "card">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-num' size='20'
                                    type='text' name= "number">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 hide error form-group'>
                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                            </div>
                        </div>

                        <?php
                        $amountpaid = App\Models\Payment::all()->where('event_id',$id)->where('user_id',$user_id)->sum('amount');
                        $amounttotal   = App\Models\EventDetail::all()->where('event_id',$id)->pluck('price');
                        $amountremaining = $amounttotal[0] - $amountpaid;
                       ?>

                    <p>Amount Paid: Tsh {{$amountpaid}}</p>
                    <p>Amount Remaining: Tsh {{$amountremaining}}</p>
                    <p>Payment should be Tsh 5,000 and above</p>


                        <div class= "row">
                            <div class="col-xs-12">
                                <button class="btn btn-danger btn-lg btn-block" type="submit">Pay Now</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }

  });

  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
</html>
