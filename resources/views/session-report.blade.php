@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/report.css')}}">

</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <div class="rounded">
                    <div class="table-responsive table-borderless">
                        <h5><b> {{$session->event_title}} Report</b></h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Participant</th>
                                    <th>Email</th>
                                    <th>Phone</th>

                                   {{-- Attending virtual or physical --}}
                                </tr>
                            </thead>

                            <tbody class="table-body">
                         <?php
                          $x = 1;

                            foreach ($participants as $participant ){
                                $user_id = $participant->user_id;
                                $user =App\Models\User::find($user_id);

                   ?>


                                <tr class="cell-1">
                                    <td>{{$x}}</td>
                                    <td>{{$user->name}} </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>

                                </tr>
                             <?php
                             $x++;
                            }
                             ?>

                            </tbody>
                        </table>


                        <div class="d-flex justify-content-center">

                            {!! $participants->links() !!}

                              </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@endsection
