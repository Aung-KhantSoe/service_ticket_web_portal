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
            <h3>Add User</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">Add User</li>
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
            <form class="card" action="{{ route('users.store')}}" method="post">
                @csrf
              <div class="card-header pb-0">
                <h4 class="card-title mb-0">Add User</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
              </div>
              <div class="card-body">
               
                <div class="row">
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Username</label>
                      <input class="form-control" type="text" placeholder="Username" name='username' required>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Email address</label>
                      <input class="form-control" type="email" placeholder="Email" name="email" required>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input class="form-control" type="text" placeholder="Name" name="name" required>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role">
                            <option value="user" selected>User</option>
                            <option value="developer" >Developer</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Phone 1</label>
                      <input class="form-control" type="text" placeholder="Phone 1" name="phone_1" required>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Phone 2</label>
                      <input class="form-control" type="text" placeholder="Phone 2" name="phone_2" >
                    </div>
                  </div>
                  
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Address</label>
                      <textarea class="form-control" type="text" placeholder="Home Address" name="address" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input class="form-control" type="text" placeholder="Password" name="password" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <a class="btn btn-info" href="{{route('users.index')}}">Back</a>
                <button class="btn btn-primary" type="submit">Add User</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
@section('footer')
@include('templates.footer')
@show