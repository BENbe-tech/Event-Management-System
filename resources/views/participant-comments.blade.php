@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">

</head>
<body>


    <section class="gradient-custom">
        {{-- <section style="background-color: #eee;"> --}}
        <div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
              <div class="card">
                <div class="card-body p-4">
                  <h4 class="text-center mb-4 pb-2">Nested comments section</h4>

                  <div class="row">
                    <div class="col">


                      <div class="d-flex flex-start mt-4">

                        <i class="fa fa-user fa-3x" aria-hidden="true">&nbsp;</i>
                        <div class="flex-grow-1 flex-shrink-1">
                          <div>
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="mb-1">
                                Natalie Smith <span class="small">- 2 hours ago</span>
                              </p>
                              <a href="#!"
                                ><i class="fas fa-reply fa-xs"></i
                                ><span class="small"> reply</span></a
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
                    </div>
                  </div><br>

                  <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                    <div class="d-flex flex-start w-100">

                      <div class="form-outline w-100">
                        <textarea
                          class="form-control"
                          id="textAreaExample"
                          rows="4"
                          style="background: #fff;"
                        ></textarea>
                        <label class="form-label" for="textAreaExample">Message</label>
                      </div>
                    </div>
                    <div class="float-end mt-2 pt-1">
                      <button type="button" class="btn btn-primary btn-sm">Post comment</button>
                      <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                    </div>
                  </div>



                </div>
              </div>
            </div>
          </div>
        </div>


      </section>





</body>
@endsection
