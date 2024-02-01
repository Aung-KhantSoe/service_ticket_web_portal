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
              <h5>Task List</h5>
              <a class="btn btn-primary" href="{{asset('/tasks/create')}}">Create Task</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display text-center" id="basic-6">
                  <thead>
                    
                    <tr>
                      <th></th>
                      <th>Opened User</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Product</th>
                      <th>Warranty Start Date</th>
                      <th>Warranty End Date</th>
                      <th>Assigned Developer</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->user->name}}</td>
                        <td>{{$task->type??'-'}}</td>
                        @switch($task->status)
                            @case('order')
                            <td class="bg-primary">{{$task->status??'-'}}</td>
                                @break
                            @case('pending')
                            <td class="bg-secondary">{{$task->status??'-'}}</td>
                                @break
                            @case('running')
                            <td class="bg-warning">{{$task->status??'-'}}</td>
                                @break
                            @case('smooth')
                            <td class="bg-info">{{$task->status??'-'}}</td>
                                @break
                            @case('done')
                            <td class="bg-success">{{$task->status??'-'}}</td> 
                                @break
                            @case('cancel')
                            <td class="bg-danger">{{$task->status??'-'}}</td>  
                                @break
                            @default
                            <td class="bg-primary">{{$task->status??'-'}}</td>
                        @endswitch
                        
                        <td>{{$task->product->name??'-'}}</td>
                        <td>{{$task->service_warranty_start_date??'-'}}</td>
                        <td>{{$task->service_warranty_end_date??'-'}}</td>
                        <td>{{$task->developer->name??'-'}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn text-success"><i class="icofont icofont-ui-edit"></i></a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this task?')" type="submit" class="btn btn-danger btn-block"><i class="icofont icofont-ui-delete"></i></button>
                                </form>
                                
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Opened User</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Product</th>
                      <th>Warranty Start Date</th>
                      <th>Warranty End Date</th>
                      <th>Assigned Developer</th>
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