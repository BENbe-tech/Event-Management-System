@extends('admin-dashboard')

@section('content')
<head>


</head>
<body>

<h3> Bar Charts</h3>


<div style="height:400px; width:900px; margin:auto;">


<canvas id="organizers-barChart">

</canvas><br><br>


<canvas id="createdmonth-barChart">

</canvas>


</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


   <script>


 $(function(){


  var users = <?php echo json_encode($users);  ?>;
  var totalevents = <?php echo json_encode($totalevents); ?>;


  var createdmonth =  <?php  echo json_encode($createdmonth);  ?>;
  var countcreatedmonth = <?php  echo json_encode($totaleventcreatedmonth); ?>;


  var organizersbarCanvas = $("#organizers-barChart");


  var barChart  = new Chart(organizersbarCanvas,{
      type :'bar',
      data:{

          labels:users,
          datasets:[
          {
            label:'No of events',
            data:totalevents,
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
       text: 'Organizers Events Bar chart',
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
                text: 'No of events'
            }
            },

            x:{
            display: true,
            title: {
            display: true,
            text: 'Organizers'
            }
           }
        },


      }
  });





var createdmonthbarCanvas = $("#createdmonth-barChart");

var barChart  = new Chart(createdmonthbarCanvas,{
    type :'bar',
    data:{

      labels:createdmonth,
        datasets:[
        {
          label: 'Total event created in each month',
          data:countcreatedmonth,
          backgroundColor:'purple',
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
     text: 'Total event created in each month Bar Chart',
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
              text: 'No of Events'
          }
          },

          x:{
          display: true,
          title: {
          display: true,
          text: 'Months'
          }
         }
      },


    }
})




 })


 </script>


</body>
@endsection
