<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Send Email</title>

<style>





</style>



</head>
<body>


    <p>{{$details['title']}}</p>
    {{-- <p>{{$details['body']}}</p> --}}
    <p>{{$details['body1']}}<b>{{$details['event_title']}}</b>{{$details['body2']}}<b>{{$details['date']}}</b>{{$details['body3']}}</p>
    <p>The link to event ticket {{$details['link']}} </p>

    <p>Regards,</p>
    <p><b>EMS Tanzania</b></p>
</body>
</html>
