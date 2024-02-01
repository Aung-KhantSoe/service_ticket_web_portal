@section('header')
@include('templates.header')
@show
@section('sidebar')
@include('templates.sidebar')
@show

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid support-ticket">
      <div class="row">
        <div class="col-sm-12">
          @if(session()->has('success'))
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><strong>Success ! </strong> {{session('success')}}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h5>User List</h5>
              <a class="btn btn-primary" href="{{asset('/users/create')}}">Create User</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="basic-6">
                  <thead>
                    <tr>
                      <th rowspan="2">Name</th>
                      <th colspan="1">HR Information</th>
                      <th colspan="5">Contact</th>
                    </tr>
                    <tr>
                      <th>Position</th>
                      <th>Address</th>
                      <th>Phone 1</th>
                      <th>Phone 2</th>
                      <th>E-mail</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                          <div class="media"><img class="img-30 rounded-circle me-3" src="{{asset('/assets/images/dashboard/1.png')}}" alt="">
                            <div class="media-body align-self-center">
                              <div>{{$user->name}}</div>
                            </div>
                          </div>
                        </td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->address??'-'}}</td>
                        <td>{{$user->phone_1??'-'}}</td>
                        <td>{{$user->phone_2??'-'}}</td>
                        <td>{{$user->email??'-'}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn text-success"><i class="icofont icofont-ui-edit"></i></a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this user?')" type="submit" class="btn btn-danger btn-block"><i class="icofont icofont-ui-delete"></i></button>
                                </form>
                                
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    
                    
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Address</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>E-mail</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
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