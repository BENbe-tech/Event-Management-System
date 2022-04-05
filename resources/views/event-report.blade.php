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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Event Title</th>
                                    <th>Status</th>
                                    <th>Participants</th>
                                    <th>Verified Participants</th>
                                    <th>Total Payments</th>
                                    <th>Total Tickets</th>
                                </tr>
                            </thead>

                            <tbody class="table-body">
                               <?php
                                  $count = $organizers->count();
                                  for($j=0; $j<$count;$j++){
                                    $events = $organizers[$j]->events;
                                    if($events !=[]){
                                    $count1 = $events->count();
                                    for($i=0;$i<$count1;$i++){
                                    $event_id = $events[$i]->id;

                                    $participants = App\Models\EventUser::all()->where('event_id',$event_id);
                                   
                               ?>

                                <tr class="cell-1">
                                    <td class="text-center">{{$i+1}}</td>
                                    <td>{{$events[$i]->event_title}}</td>
                                    <?php
                                      $time = $events[$i]->eventDetails;
                                     $starttime = $time->starttime;
                                      $endtime =  $time->endtime;
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
                                    <td>0</td>
                                    <td>Tsh 3000</td>
                                    <td>20</td>
                                </tr>

                                <?php
                                    }  } }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
@endsection
