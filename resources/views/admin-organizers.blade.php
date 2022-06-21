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

                <?php
                   $count = $users->count();
                ?>

                <h5><b> Organizers Report</b></h5>
                <p>{{$count}} total users of the system</p>
                <p>Click organizer name to view subscription details </p>


               <table class="table">
                            <thead>
                                <tr >
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subscription Status</th>


                                </tr>
                            </thead>

                            <tbody class="table-body">
                         <?php
                          $x = 1;

                            foreach ($users as $user ){
                            $time = Carbon\Carbon::now();
                            $org = $user->organizers;

                             if(isset($org[0])){

                            $id = $user->id;


                          ?>


                                <tr class="cell-1"  >

                                    <td>{{$x}}</td>
                                    <td ><a  href="{{route('admin-subscribers',$id)}}">{{$user->name}} </a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>


                                    <?php
                                     $status = "finished";
                                     $ys = $user->subscriptions;
                                   foreach($ys as $y){
                                     $t =  $y->subscription_end;
                                        if($time <= $t  ){
                                    $status = "ongoing";
                                     break;
                                   }

                                 }

                                    ?>
                                    @if($status=="ongoing")
                                    <td><span class="badge badge-success">{{$status}}</span></td>
                                    @endif

                                    @if($status=="finished")

                                    <td><span class="badge badge-danger">{{$status}}</span></td>
                                    @endif


                                </tr>
                             <?php
                             $x++;
                            }
                        }
                             ?>

                            </tbody>
                        </table>


                    <div class="d-flex justify-content-center">

                  {!! $users->links() !!}

                    </div>




                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
@endsection
