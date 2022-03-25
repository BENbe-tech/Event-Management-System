
$('#calendar').on('click',function(e){
    e.preventDefault();

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
      url: "{{url('addtocalendar-regevent/'. $title.'/'.$eventdetails_id)}}",
      type:"GET",
      data:{
        "_token": "{{ csrf_token() }}",
      },
      success:function(response){
        // $('#successMsg').show();
        console.log(response.success);

        alert(response.success);
      },

      error: function(response) {
        $('#nameErrorMsg').text(response.responseJSON.errors.name);
        $('#emailErrorMsg').text(response.responseJSON.errors.email);
        $('#mobileErrorMsg').text(response.responseJSON.errors.mobile);
        $('#messageErrorMsg').text(response.responseJSON.errors.message);
      },
      });
    });
