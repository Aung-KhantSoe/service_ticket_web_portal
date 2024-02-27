@section('header')
@include('templates.header')
@show
@section('sidebar')
@include('templates.sidebar')
@show
<div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Create Task</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
              <li class="breadcrumb-item">Tasks</li>
              <li class="breadcrumb-item active">Create Task</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="edit-profile">
        <div class="row">
          <div class="col-xl-12">
            @if(session()->has('success'))
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><strong>Success ! </strong> {{session('success')}}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger dark alert-dismissible fade show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="contact-form card-body">
              <form class="card theme-form" action="{{ route('tasks.store')}}" method="post" enctype="multipart/form-data">
                <div class="form-icon"><i class="icofont icofont-envelope-open"></i></div>
                  @csrf
                  <input type="hidden" name="status" value="order">
                <div class="card-header pb-0">
                  <h4 class="card-title mb-0">How can we help you?</h4>
                  <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                  @if(Auth::user()->role=='admin')
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">For User</label>
                              <select class="form-select" name="user_id">
                                  @foreach ($users as $user)
                                  <option value="{{$user->id}}" >{{$user->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <hr/>
                  @endif
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">Product</label>
                              <select class="form-select" name="product_id" onchange="productonchange(event)" required>
                                <option value="">Choose one</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">FAQ</label>
                              <select class="form-select" name="faq_id" required>
                                @foreach ($products as $product)
                                    @php
                                        $faqs = $product->faqs;
                                    @endphp
                                        <option value="">Choose one</option>
                                    @foreach ($faqs as $faq)
                                        <option class="{{ $faq->product_id }} faqs" value="{{ $faq->id }}">{{ $faq->question }}</option>
                                    @endforeach
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">Type</label>
                              <select class="form-select" name="type">
                                  <option value="service_ticket" selected>Service Ticket</option>
                                  <option value="change_request" >Change Request</option>
                              </select>
                          </div>
                      </div>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Warranty Start Date</label>
                          <input class="datepicker-here form-control digits" type="text" data-language="en" name="service_warranty_start_date" required>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Warranty End Date</label>
                          <input class="datepicker-here form-control digits" type="text" data-language="en" name="service_warranty_end_date" required>
                        </div>
                      </div>
                  </div>


                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" type="text" placeholder="Description" name="description" rows="5"></textarea>
                      </div>
                    </div>
                  </div>
                  @if(Auth::user()->role=='admin')
                  <hr/>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">Assign Developer</label>
                              <select class="form-select" name="dev_id">
                                  <option value="" >Choose one</option>
                                  @foreach ($developers as $developer)
                                  <option value="{{$developer->id}}" >{{$developer->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  @endif
                  <hr/>
                  <div class="mb-3">
                    <label class="form-label">Attachments</label>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Photo 1</label>
                          <input class="form-control" type="file" name="photo_1" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Photo 2</label>
                          <input class="form-control" type="file" name="photo_2" >
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Photo 3</label>
                          <input class="form-control" type="file" name="photo_3">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Photo 4</label>
                          <input class="form-control" type="file" name="photo_4">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Photo 5</label>
                          <input class="form-control" type="file" name="photo_5">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Receipt</label>
                          <input class="form-control" type="file" name="receipt" required>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-end">
                  <a class="btn btn-info" href="{{route('tasks.index')}}">Back</a>
                  <button class="btn btn-primary" type="submit">Create Task</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
@section('footer')
@include('templates.footer')
@show
