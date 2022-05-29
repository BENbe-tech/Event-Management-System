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
                        <h5><b>Event time and type Report</b></h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Event Title</th>
                                    <th>CreatedMonth</th>
                                    <th>CreatedYear</th>
                                    <th>StartMonth</th>
                                    <th>StartYear</th>
                                    <th>Category</th>
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

                                    $event_details  = $events[$i]->eventDetails;
                                    $event_category = $event_details->category;
                                    $eventmonth     = substr( $event_details->starttime , 6, 1);
                                    $eventyear      = substr( $event_details->starttime, 0, 4);
                                    $createdmonth   = substr( $event_details->created_at , 6, 1);
                                    $createdyear    = substr( $event_details->created_at , 0, 4);


                                    switch ($eventmonth) {
                                        case 1:
                                            $month = "January";
                                            break;
                                        case 2:
                                            $month = "February";
                                            break;
                                        case 3:
                                        $month = "March";
                                            break;
                                            case 4:
                                        $month = "April";
                                            break;

                                            case 5:
                                        $month = "May";
                                            break;

                                            case 6:
                                        $month = "June";
                                            break;

                                            case 7:
                                        $month = "July";
                                            break;

                                            case 8:
                                        $month = "August";
                                            break;

                                            case 9:
                                        $month = "September";
                                            break;

                                            case 10:
                                        $month = "October";
                                            break;


                                            case 11:
                                        $month = "November";
                                            break;


                                            case 12:
                                        $month = "December";
                                            break;
                                        default:
                                            $month = "None";
                                        }



                                    switch ($createdmonth) {
                                        case 1:
                                            $cmonth = "January";
                                            break;
                                        case 2:
                                            $cmonth = "February";
                                            break;
                                        case 3:
                                        $cmonth = "March";
                                            break;
                                            case 4:
                                        $cmonth = "April";
                                            break;

                                            case 5:
                                        $cmonth = "May";
                                            break;

                                            case 6:
                                        $cmonth = "June";
                                            break;

                                            case 7:
                                        $cmonth = "July";
                                            break;

                                            case 8:
                                        $cmonth = "August";
                                            break;

                                            case 9:
                                        $cmonth = "September";
                                            break;

                                            case 10:
                                        $cmonth = "October";
                                            break;


                                            case 11:
                                        $cmonth = "November";
                                            break;


                                            case 12:
                                        $cmonth = "December";
                                            break;
                                        default:
                                            $cmonth = "None";
                                        }


                                    ?>


                                <tr class="cell-1">
                                    <td class="text-center">{{$number}}</td>

                                    <?php
                                      $number++;
                                    ?>

                                    <td>{{$events[$i]->event_title}}</td>
                                    <td>{{$cmonth}}</td>
                                    <td>{{$createdyear }}</td>
                                    <td>{{$month}}</td>
                                    <td>{{$eventyear}}</td>
                                    <td>{{$event_category}}</td>

                                </tr>


                                <?php
                                    }
                                }
                            }

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
