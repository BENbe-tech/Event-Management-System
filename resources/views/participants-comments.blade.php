@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">

</head>
<body>

<?php
 $user_id = session('loginId');

?>

   <section class="gradient-custom">
        {{-- <section style="background-color: #eee;"> --}}
        <div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
              <div class="card">
                <div class="card-body p-4">
                  <h4 class="text-center mb-4 pb-2">Nested comments section
                    </h4>


                  <div class="row">
                    <div class="col">


                      <div class="d-flex flex-start mt-4">

                        <i class="fa fa-user fa-3x" aria-hidden="true">&nbsp;</i>
                        <div class="flex-grow-1 flex-shrink-1">
                          <div>
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="mb-1">
                                <span id="username">Natalie Smith</span> <span class="small">- 2 hours ago</span>
                              </p>
                              <a href="#"  id="reply"
                                ><i class="fas fa-reply fa-xs"></i
                                ><span class="small" > reply</span></a
                              >
                            </div>
                            <p class="small mb-0">
                              The standard chunk of Lorem Ipsum used since the 1500s is
                              reproduced below for those interested. Sections 1.10.32 and
                              1.10.33.
                            </p>
                          </div>




                          <div class="d-flex flex-start mt-4">

                            <i class="fa fa-user-circle fa-3x" aria-hidden="true">&nbsp;</i>
                            <div class="flex-grow-1 flex-shrink-1">
                              <div>
                                <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-1">
                                    Lisa Cudrow <span class="small">- 4 hours ago</span>
                                  </p>
                                </div>
                                <p class="small mb-0">
                                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
                                  scelerisque ante sollicitudin commodo. Cras purus odio,
                                  vestibulum in vulputate at, tempus viverra turpis.
                                </p>
                              </div>
                            </div>
                          </div>



                          <div class="d-flex flex-start mt-4">

                            <i class="fa fa-user-circle fa-3x" aria-hidden="true">&nbsp;</i>
                            <div class="flex-grow-1 flex-shrink-1">
                              <div>
                                <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-1">
                                    Maggie McLoan <span class="small">- 5 hours ago</span>
                                  </p>
                                </div>
                                <p class="small mb-0">
                                  a Latin professor at Hampden-Sydney College in Virginia,
                                  looked up one of the more obscure Latin words, consectetur
                                </p>
                              </div>
                            </div>
                          </div>



                          <div class="d-flex flex-start mt-4">

                            <i class="fa fa-user-circle fa-3x" aria-hidden="true">&nbsp;</i>
                            <div class="flex-grow-1 flex-shrink-1">
                              <div>
                                <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-1">
                                    John Smith <span class="small">- 6 hours ago</span>
                                  </p>
                                </div>
                                <p class="small mb-0">
                                  Autem, totam debitis suscipit saepe sapiente magnam officiis
                                  quaerat necessitatibus odio assumenda, perferendis quae iusto
                                  labore laboriosam minima numquam impedit quam dolorem!
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                  @foreach ($comments as $comment)

                      <div class="d-flex flex-start mt-4">

                        <i class="fa fa-user fa-3x" aria-hidden="true">&nbsp;</i>
                        <div class="flex-grow-1 flex-shrink-1">
                          <div>
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="mb-1">
                                <span id="username">{{$comment->users->name}}</span> <span class="small">- {{$comment->created_ats}} hours ago</span>
                              </p>
                              <a href="#"  id="reply" onclick="response(event)"><i class="fas fa-reply fa-xs"></i>
                                <span class="small" > reply{{$comment->user_id}}</span></a>
                            </div>
                            <p class="small mb-0">
                             {{$comment->message}}
                            </p>
                          </div>
                        </div>
                      </div>

                      @endforeach


                    </div>
                  </div><br>

                  <form action = "{{route('post-comment')}}" method="post" id="SubmitForm">
                      @csrf
                  <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                    <div class="d-flex flex-start w-100">

                      <div class="form-outline w-100">
                        <textarea
                          class="form-control"
                          id="message"
                          rows="4"
                          name="message"
                          style="background: #fff;"
                          value="{{ old('message') }}"
                          required
                          autofocus
                          autocomplete
                        ></textarea>

                        <label class="form-label" for="textAreaExample">Message</label>
                        <span class = "text-danger">@error('message'){{$message}} @enderror</span>
                      </div>
                      <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
                      <input type="hidden" id="event_id" name="event_id" value="{{$id}}">
                    </div>

                    <div class="float-end mt-2 pt-1">
                      <button class="btn btn-primary btn-sm" type="submit">Post comment</button>
                      <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                    </div>
                  </div>

                </form>

                </div>
              </div>
            </div>
          </div>
        </div>


      </section>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>

<script>

document.getElementById("reply").addEventListener("click", function(event){
event.preventDefault()


var username = document.getElementById("username").innerHTML;
console.log(username);
var x = "@"
// document.getElementById("textAreaExample").value =x;
document.getElementById("message").focus();
document.getElementById("message").innerHTML = x.concat(username);


});

function response(event){

event.preventDefault()

var username = document.getElementById("username").innerHTML;
console.log(username);
var x = "@"
// document.getElementById("textAreaExample").value =x;
document.getElementById("message").focus();
document.getElementById("message").innerHTML = x.concat(username);


}



jQuery(document).ready(function(){
       jQuery('#SubmitForm').on('submit',function(e){
          e.preventDefault();

        let message = $('#message').val();
        let user_id = $('#user_id').val();
        let event_id = $('#event_id').val();

          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
            url: "{{url('post-comment')}}",
             method: 'POST',
             data: {
                "_token": "{{ csrf_token() }}",
                message:message,
                user_id:user_id,
                event_id:event_id,
             },
             success: function(result){
                alert(result.success);
             }
            });
          });
       });


</script>

</body>
@endsection
