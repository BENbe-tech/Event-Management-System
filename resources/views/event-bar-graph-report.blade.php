@extends('dashboard')

@section('content')
<head>
    {{-- <link rel="stylesheet" href="{{asset('css/comments.css')}}"> --}}

</head>
<body>

<h3>Events Bar Chart</h3>


{{-- <div id="chart" style="height: 300px;"></div> --}}
  {{-- <a href ="{{ route('download.eventbarreport.pdf')}} " class="btn btn-primary float-end">Export in PDF</a><br> --}}

<div style="height:400px; width:900px; margin:auto;">



<canvas id="registered-barChart">

</canvas><br><br>

<canvas id="participants-barChart">

</canvas><br><br>

<canvas id="payment-barChart">

</canvas><br><br>


<canvas id="category-barChart">

</canvas><br><br>


<canvas id="startmonth-barChart">

</canvas><br><br>

<canvas id="createdmonth-barChart">

</canvas>


</div>




    {{-- <!-- Charting library -->
<script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script> --}}




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


   <script>
        // const chart = new Chartisan({
        //   el: '#chart',
        //   url: "@chart('event_chart')",
        //   hooks: new ChartisanHooks().beginAtZero().colors(),
        // });

 $(function(){

  var event_titles = <?php echo  json_encode($event_title); ?>;
  var participants = <?php echo  json_encode($data_participants); ?>;
  var registered_event_user = <?php echo  json_encode($data_registered); ?>;
  var payments = <?php echo json_encode($event_payments); ?>;
  var category = <?php echo json_encode($event_category);  ?>;
  var countcategory = <?php echo json_encode($totaleventcategory); ?>;
  var startmonth  =   <?php  echo json_encode($startmonth); ?>;
  var countstartmonth =  <?php echo json_encode($totaleventstartmonth);  ?>;
  var createdmonth =  <?php  echo json_encode($createdmonth);  ?>;
  var countcreatedmonth = <?php  echo json_encode($totaleventcreatedmonth); ?>;



  var participantsbarCanvas = $("#participants-barChart");

//   Chart.defaults.global.defaultFontFamily = "Lato";
//   Chart.defaults.global.defaultFontSize = 18;
//   Chart.defaults.global.defaultFontColor = "#777";


  var barChart  = new Chart(participantsbarCanvas,{
      type :'bar',
      data:{
        //   labels:['Jan','Feb','March','April','May'],
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


  var registeredbarCanvas = $("#registered-barChart");



  var barChart  = new Chart(registeredbarCanvas,{
      type :'bar',
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




  var paymentbarCanvas = $("#payment-barChart");

  var barChart  = new Chart(paymentbarCanvas,{
      type :'bar',
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
       text: 'Events Total Payment Bar Chart',
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




  var categorybarCanvas = $("#category-barChart");

var barChart  = new Chart(categorybarCanvas,{
    type :'bar',
    data:{

      labels:category,
        datasets:[
        {
          label: 'Total event for each category',
          data:countcategory,
          backgroundColor:'brown',
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
     text: 'Categories of event',
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
          text: 'Event Category'
          }
         }
      },


    }
})




var startmonthbarCanvas = $("#startmonth-barChart");

var barChart  = new Chart(startmonthbarCanvas,{
    type :'bar',
    data:{

      labels:startmonth,
        datasets:[
        {
          label: 'Total event for each month',
          data: countstartmonth,
          backgroundColor:'orange',
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
     text: 'Total event occuring in each month Bar Chart',
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
