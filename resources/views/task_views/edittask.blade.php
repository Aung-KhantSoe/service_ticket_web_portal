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
            <h3>Edit Task</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
              <li class="breadcrumb-item">Tasks</li>
              <li class="breadcrumb-item active">Edit Task</li>
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
              <form class="card theme-form" action="{{ route('tasks.update',['task' => $task->id])}}" method="post">
                <div class="form-icon"><i class="icofont icofont-envelope-open"></i></div>
                  @csrf
                  @method('PUT')
                
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
                                  <option value="{{$user->id}}" @if($task->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <hr/>
                  @endif
                  @if(Auth::user()->role=='admin' || Auth::user()->role=='developer')
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">Status</label>
                              <select class="form-select" name="status">
                                  @foreach ($status_configs as $status_config)
                                  <option value="{{$status_config->status}}" @if($task->status == $status_config->status) selected @endif>{{$status_config->name}}</option>
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
                              <select class="form-select" name="product_id">
                                  <option value="1" @if($task->product_id == '1') selected @endif>Website</option>
                                  <option value="2" @if($task->product_id == '2') selected @endif>Moodle</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">FAQ</label>
                              <select class="form-select" name="faq_id">
                                  <option value="1" @if($task->faq_id == '1') selected @endif>Can't login.</option>
                                  <option value="2" @if($task->faq_id == '2') selected @endif>My Site is slow.</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                              <label class="form-label">Type</label>
                              <select class="form-select" name="type">
                                  <option value="service_ticket" @if($task->type == 'service_ticket') selected @endif>Service Ticket</option>
                                  <option value="change_request" @if($task->type == 'change_request') selected @endif>Change Request</option>
                              </select>
                          </div>
                      </div>
                  <div class="row">
                      <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Warranty Start Date</label>
                          <input class="datepicker-here form-control digits" type="text" data-language="en" name="service_warranty_start_date" value="{{$task->service_warranty_start_date??''}}">
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Warranty End Date</label>
                          <input class="datepicker-here form-control digits" type="text" data-language="en" name="service_warranty_end_date" value="{{$task->service_warranty_end_date??''}}">
                        </div>
                      </div>
                  </div>
                    
                    
                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" type="text" placeholder="Description" name="description" rows="5">{{$task->description??''}}</textarea>
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
                                  @foreach ($developers as $developer)
                                  <option value="{{$developer->id}}" @if($task->dev_id == $developer->id) selected @endif>{{$developer->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  @endif
                </div>
                <div class="card-footer text-end">
                  <a class="btn btn-info" href="{{route('tasks.index')}}">Back</a>
                  <button class="btn btn-primary" type="submit">Update Task</button>
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