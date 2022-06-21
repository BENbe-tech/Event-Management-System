@extends('admin-dashboard')

@section('content')
<head>
<style>


.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
  box-sizing: border-box;
  margin: 0;
  width: 100%;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container select {
  padding: 8px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width: 300px;
  color: black;
}

.topnav .search-container button:hover {
  background: #ccc;
}


@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }

  .topnav a, .topnav .search-container select, .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }

  .topnav .search-container select {
    border: 1px solid #ccc;
    width: 100%;
  }
}



</style>

</head>
<body>

<h3>Report Bar Charts</h3>


<div class="topnav">

    <a  class="active"><h5>Filter report</h5></a>
    <div class="search-container">
      <form action="{{route('adminbar-search')}}" method="post" enctype="multipart/form-data">
       @csrf
        <select id="organizer"  name ="category" value="{{ old('category') }}" required>

            <option value = "year" >Year</option>
            <option value = "month" >Month</option>
            <option value = "user" >Organizers</option>

        </select>
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>

  </div>


<div style="height:400px; width:900px; margin:auto;">

@if ($search == "user")


<canvas id="organizers-barChart">

</canvas><br><br>

@endif


@if ($search == "month")
<canvas id="createdmonth-barChart">

</canvas>

@endif


@if ($search == "year")
<canvas id="createdyear-barChart">

</canvas>

@endif


</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


   <script>


 $(function(){





  var createdmonth =  <?php  echo json_encode($createdmonth);  ?>;
  var countcreatedmonth = <?php  echo json_encode($totaleventcreatedmonth); ?>;


  var createdyear =  <?php  echo json_encode($createdyear);  ?>;
  var countcreatedyear = <?php  echo json_encode($totaleventcreatedyear); ?>;



  var users = <?php echo json_encode($users);  ?>;
  var totalevents = <?php echo json_encode($totalevents); ?>;


  var organizersbarCanvas = $("#organizers-barChart");


  var barChart = new Chart(organizersbarCanvas,{
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
});







var createdyearbarCanvas = $("#createdyear-barChart");

var barChart  = new Chart(createdyearbarCanvas,{
    type :'bar',
    data:{

      labels:createdyear,
        datasets:[
        {
          label: 'Total event created in each year',
          data:countcreatedyear,
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
