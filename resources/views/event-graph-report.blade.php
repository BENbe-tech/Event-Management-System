@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">

</head>
<body>

<h3>Events Attendance chart</h3>


<div id="chart" style="height: 300px;"></div>



{{--
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script --> --}}

    <!-- Charting library -->
<script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    <script>
        const chart = new Chartisan({
          el: '#chart',
          url: "@chart('event_chart')",
          hooks: new ChartisanHooks().colors()
        });
      </script>

</body>
@endsection
