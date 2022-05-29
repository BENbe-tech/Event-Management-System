@extends('dashboard')

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
                        <h5><b> {{$event->event_title}} Report</b></h5>

                        <a href ="{{route('comment', $event->id)}} " class="btn btn-primary float-end">View Comments</a>
                      <a href ="{{ route('file-export',$event->id)}} " class="btn btn-primary float-end">Export in excel</a>
                        {{-- <a href ="{{ route('file-export',$event->id)}} " class="btn btn-primary float-end">Export in csv</a> --}}

    {{-- <a href ="{{ route('download.eventreport.pdf',$event->id)}} " class="btn btn-primary float-right">Export in PDF</a><br> --}}

               <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">number</th>
                                    <th>Participant</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Verified Attendance</th>
                                    <th>Attendance Mode</th>
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
                                $amountpaid = App\Models\Payment::all()->where('event_id',$event->id)->where('user_id',$user_id)->sum('amount');

                   ?>


                                <tr class="cell-1">
                                    <td>{{$x}}</td>
                                    <td>{{$user->name}} </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($participant->verify_attendance==NULL)
                                    <td>No</td>
                                    <td>None</td>
                                    @endif
                                    @if($participant->verify_attendance==1)
                                    <td>Yes</td>
                                    <td>{{$participant->attendance_mode}}</td>
                                    @endif
                                    <td>{{$amountpaid}}</td>

                                    {{-- ticket creation day --}}
                                    <td>Monday</td>

                                    {{-- ticket barcode --}}
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
