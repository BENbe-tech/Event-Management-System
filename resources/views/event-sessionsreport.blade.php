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
                        <h5><b>My Created Events Report</b></h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Session Title</th>
                                    <th>Status</th>
                                    <th>Total Participants</th>

                                </tr>
                            </thead>
                    <?php
                     $number = 1;
                     foreach ($sessions as $session) {

                     $session_detail = $session->sessionDetails;

                     $date = $session_detail->date;
                     $start_time = $session_detail->start_time;
                     $end_time = $session_detail->end_time;
                     $session_id = $session->id;
                     $session_participant =App\Models\SessionUser::all()->where('session_id',$session_id);

                    ?>
                            <tbody class="table-body">

                                <tr class="cell-1">
                                <td>{{$number}}</td>
                                <td><a a href="{{route('session.report', $session_id)}}" class="title"><b>{{$session->name}}</b></a></td>

                          <?php
                                if($date > Carbon\Carbon::now()){

                        ?>

                                <td><span class="badge badge-info">To happen</span></td>
                         <?php
                                }
                                if($date == Carbon\Carbon::now()){
                               if($start_time > Carbon\Carbon::now()){
                        ?>

                               <td><span class="badge badge-info">To happen</span></td>
                       <?php
                               }
                                elseif($start_time <= Carbon\Carbon::now() && $end_time > Carbon\Carbon::now()){
                          ?>

                                  <td><span class="badge badge-success"> Ongoing </span></td>
                        <?php
                                }elseif($endtime >= Carbon\Carbon::now()){

                           ?>
                                      <td><span class="badge badge-danger">Finished</span></td>

                         <?php
                           }
                                 else{

                           ?>
                              <td><span class="badge badge-info">Loading</span></td>
                           <?php

                                 }

                            }
                                if(Carbon\Carbon::now() > $date){

                           ?>

                                <td><span class="badge badge-danger">Finished</span></td>
                        <?php
                                    }
                         ?>
                                <td>{{ $session_participant->count()}}</td>
                                </tr>
                            </tbody>
                   <?php
                     $number++;
                        }
                   ?>

                        </table>
                        <div class="d-flex justify-content-center">

                            {!! $sessions->links() !!}

                              </div>
                        <p class="central" style="text-align: center;">Click Session title of particular event to open it's report</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





</body>
@endsection
