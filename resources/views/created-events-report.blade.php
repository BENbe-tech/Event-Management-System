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

            <a href ="{{route('line-graph.report')}} " class="btn btn-primary float-end">Line Graph Report</a>

            <a href ="{{route('bar-graph.report')}} " class="btn btn-primary float-end">Bar Graph Report</a><br><br>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Event Title</th>
                                    <th>Status</th>
                                    <th>Participants</th>
                                    <th>Verified Participants</th>
                                    <th>Not Verified Participants</th>
                                    <th>Total Payments</th>
                                    <th>Total Tickets</th>
                                </tr>
                            </thead>

                            <tbody class="table-body">
                               <?php
                                  $count = $organizers->count();
                                  $number = 1;
                                  for($j=0; $j<$count;$j++){
                                    $events = $organizers[$j]->events;
                                    if($events !=[]){
                                    $count1 = $events->count();
                                    for($i=0;$i<$count1;$i++){
                                    $event_id = $events[$i]->id;

                                    $participants = App\Models\EventUser::all()->where('event_id',$event_id);

                                        $participants_verified = App\Models\EventUser::all()->where('verify_attendance',1)
                                        ->where('event_id',$event_id);

                                        if($participants_verified->count()==""){
                                        $participants_verified_total = 0;
                                        }else{
                                            $participants_verified_total = $participants_verified->count();
                                        }
                                        $participants_not_verified = App\Models\EventUser::all()->where('verify_attendance',NULL)
                                        ->where('event_id',$event_id);

                                        if($participants_not_verified->count()==""){

                                            $participants_not_verified_total = 0;
                                        }else{
                                            $participants_not_verified_total = $participants_not_verified->count();
                                        }




                               ?>

                                <tr class="cell-1">
                                    <td class="text-center">{{$number}}</td>
                                    <td><a href="{{route('event-report', $event_id)}}" class="title"><b>{{$events[$i]->event_title}}</b></a></td>
                                    <?php
                                      $time = $events[$i]->eventDetails;
                                     $starttime = $time->starttime;
                                      $endtime =  $time->endtime;

                                      $number++;

                                    if($starttime > Carbon\Carbon::now()){
                                    ?>
                                    <td><span class="badge badge-info">To happen</span></td>

                                     <?php
                                    }
                                    if($starttime < Carbon\Carbon::now() && Carbon\Carbon::now() < $endtime){
                                     ?>

                                     <td><span class="badge badge-success"> Ongoing </span></td>

                                     <?php
                                    }
                                    if (Carbon\Carbon::now() > $endtime){
                                     ?>

                                     <td><span class="badge badge-danger"> Finished </span></td>

                                    <?php
                                    }
                                    ?>

                                    <td>{{$participants->count()}}</td>

                                    <td>{{$participants_verified_total}}</td>
                                    <td>{{$participants_not_verified_total}}</td>

                                    <td>Tsh 3000</td>
                                    <td>20</td>
                                </tr>

                                <?php

                                 }  } }
                                ?>


                            </tbody>
                        </table>
                        <p class="central" style="text-align: center;">Click Event title of particular event to open it's report</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
@endsection
