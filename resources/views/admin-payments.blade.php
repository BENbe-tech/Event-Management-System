@extends('admin-dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/report.css')}}">
<style>

</style>
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <div class="rounded">
                    <div class="table-responsive table-borderless">
                        <h5><b> All Payments done by organizers of events</b></h5>

                        <p>Total amount paid in Tsh {{$subscriptions1}} </p>


               <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    {{-- <th>Phone Number</th> --}}
                                    <th>Start Subscription</th>
                                    <th>End Subscription</th>
                                    <th>Subscription Type</th>
                                    <th>Payment Amount (Tsh)</th>



                                </tr>
                            </thead>

                            <tbody class="table-body">
                         <?php
                          $x = 1;

                            foreach ($subscriptions as $subscription ){

                                $user = $subscription->users;
                   ?>


                                <tr class="cell-1">
                                    <td>{{$x}}</td>
                                    <td>{{$user->name}} </td>
                                    <td>{{$user->email}}</td>

                                    {{-- <td>{{$user->phone}}</td> --}}
                                    <td>{{$subscription->payment_date}}</td>
                                    <td>{{$subscription->subscription_end}}</td>




                                    <td>{{$subscription->subscription_type}}</td>


                                    <td>{{$subscription->subscription_fee}}</td>

                                </tr>
                             <?php
                             $x++;

                        }
                             ?>

                            </tbody>
                        </table>


                    <div class="d-flex justify-content-center">

                  {!! $subscriptions->links() !!}

                    </div>




                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
@endsection
