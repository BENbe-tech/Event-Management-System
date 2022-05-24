@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">

</head>
<body>

<h3>Events Line Chart</h3>


<div style="height:400px; width:900px; margin:auto;">


<canvas id="registered-lineChart">

</canvas><br><br>

<canvas id="participants-lineChart">

</canvas><br><br>


<canvas id="payment-lineChart">

</canvas>

</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


   <script>


 $(function(){

  var event_titles = <?php echo  json_encode($event_title); ?>;
  var participants = <?php echo  json_encode($data_participants); ?>;
  var registered_event_user = <?php echo  json_encode($data_registered); ?>;
  var payments = <?php echo json_encode($event_payments); ?>;
  var participantslineCanvas = $("#participants-lineChart");



  var lineChart  = new Chart(participantslineCanvas,{
      type :'line',
      data:{

        labels:event_titles,
          datasets:[
          {
            label: 'participant',
            data:participants,
            backgroundColor:'green',
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3 ,
            hoverBorderColor: '#000',
          }
          ]
      },


      options:{

    plugins:{
        title: {
       display: true,
       text: 'Events Participants Bar Chart',
       fontSize : 100,
       },

       legend:{
        position : 'top',
        display: true,
       },

       tooltips:{
            enabled:true,
        },
    },


        scales:{

            y:{
                display: true,
                ticks:{
                  beginAtZero:true
                },
                title: {
                display: true,
                text: 'Participants'
            }
            },

            x:{
            display: true,
            title: {
            display: true,
            text: 'Event Title'
            }
           }
        },


      }
  });


  var registeredlineCanvas = $("#registered-lineChart");



  var lineChart  = new Chart(registeredlineCanvas,{
      type :'line',
      data:{
        labels:event_titles,
          datasets:[
          {
            label: 'user registered for events',
            data:registered_event_user,
            backgroundColor:'blue',
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3 ,
            hoverBorderColor: '#000',
          }
          ]
      },


      options:{

    plugins:{
        title: {
       display: true,
       text: 'Events Registered Users Bar Chart',
       fontSize : 100,
       },

       legend:{
        position : 'top',
        display: true,
       },

       tooltips:{
            enabled:true,
        },
    },


        scales:{

            y:{
                display: true,
                ticks:{
                  beginAtZero:true
                },
                title: {
                display: true,
                text: 'Registered Users'
            }
            },

            x:{
            display: true,
            title: {
            display: true,
            text: 'Event Title'
            }
           }
        },


      }
  })




  var paymentlineCanvas = $("#payment-lineChart");



  var lineChart  = new Chart(paymentlineCanvas,{
      type :'line',
      data:{
        labels:event_titles,
          datasets:[
          {
            label: 'Total Payment for each event',
            data:payments,
            backgroundColor:'yellow',
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3 ,
            hoverBorderColor: '#000',
          }
          ]
      },


      options:{

    plugins:{
        title: {
       display: true,
       text: 'Events Total Payment Line Chart',
       fontSize : 100,
       },

       legend:{
        position : 'top',
        display: true,
       },

       tooltips:{
            enabled:true,
        },
    },


        scales:{

            y:{
                display: true,
                ticks:{
                  beginAtZero:true
                },
                title: {
                display: true,
                text: 'Payments'
            }
            },

            x:{
            display: true,
            title: {
            display: true,
            text: 'Event Title'
            }
           }
        },


      }
  })




 })


 </script>




</body>
@endsection
