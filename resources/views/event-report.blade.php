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
                        <h5><b> {{$event->event_title}} Report</b></h5>

                        <a href ="{{route('comment', $event->id)}} " class="btn btn-primary float-end">View Comments</a>
                        <a href ="{{ route('file-export') }} " class="btn btn-primary float-end">Export in excel</a>
                        <a href ="{{ route('file-export') }} " class="btn btn-primary float-end">Export in csv</a><br><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Participant</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Verified Attendance</th>
                                    <th>Payment Amount</th>
                                    <th>Payment Day</th>
                                    <th>Ticket Number</th>
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
                                    @if($participant->verify_attendance==NULL)
                                    <td>No</td>
                                    @endif
                                    @if($participant->verify_attendance==1)
                                    <td>Yes</td>
                                    @endif
                                    <td>4</td>
                                    <td>Tsh 3000</td>
                                    <td>20</td>

                                </tr>
                             <?php
                             $x++;
                            }
                             ?>

                            </tbody>
                        </table>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">

                  {!! $participants->links() !!}

                    </div>

            {{-- {!! $participants->render() !!} --}}


                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
@endsection
