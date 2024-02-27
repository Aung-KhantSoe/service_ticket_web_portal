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
                    <h3>Task list</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                        <li class="breadcrumb-item">dashboard</li>
                        <li class="breadcrumb-item active">task list</li>
                    </ol>
                </div>
                @if (Auth::user()->role != 'developer')
                    <div class="col-sm-6">
                        <div class="bookmark">
                            <a class="btn btn-primary" href="{{ asset('/tasks/create') }}">Create New Task</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row project-cards">
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                        href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i
                                            data-feather="target"></i>All</a></li>
                                @foreach ($status_configs as $status_config)
                                    <li class="nav-item"><a class="nav-link txt-{{ $status_config->status_color }}"
                                            id="{{ $status_config->status }}-top-tab" data-bs-toggle="tab"
                                            href="#top-{{ $status_config->status }}" role="tab"
                                            aria-controls="top-{{ $status_config->status }}" aria-selected="false"><i
                                                data-feather="check-circle"></i>{{ $status_config->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                                aria-labelledby="top-home-tab">
                                <div class="row">
                                    @foreach ($tasks as $task)
                                        @php
                                            $status_color = $task->status->status_color ?? 'primary';
                                        @endphp
                                        @if (isset($tasks))
                                            <div class="col-xxl-4 col-lg-6">
                                                <div class="project-box shadow shadow-showcase"><span
                                                        class="badge badge-{{ $status_color }}">{{ $task->status->name }}</span>
                                                    <h6>{{ $task->user->name }}</h6>
                                                    <div class="media"><img class="img-20 me-2 rounded-circle"
                                                            src="{{ asset('/assets/images/dashboard/1.png') }}"
                                                            alt="" data-original-title="" title="">
                                                        <div class="media-body">
                                                            <p>{{ $task->faq->question }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- <p>{{ $task->description }}</p> --}}
                                                    <div class="row details">
                                                        <div class="col-6"><span>Type </span></div>
                                                        @if ($task->type == 'service_ticket')
                                                            <div class="col-6 font-primary">Service</div>
                                                        @else
                                                            <div class="col-6 font-secondary">Change</div>
                                                        @endif
                                                        <div class="col-6"> <span>Warranty Start</span></div>
                                                        <div class="col-6 font-{{ $status_color }}">
                                                            {{ $task->service_warranty_start_date }}</div>
                                                        <div class="col-6"> <span>Warranty End</span></div>
                                                        <div class="col-6 font-{{ $status_color }}">
                                                            {{ $task->service_warranty_start_date }}</div>

                                                        <div class="col-6"> <span>Developer</span></div>
                                                        <div class="col-6 font-{{ $status_color }} ">
                                                            {{ $task->developer->name ?? '-' }}</div>
                                                        {{-- @if (isset($task->duration))
                                <div class="col-6"> <span>Duration</span></div>
                                <div class="col-6 font-{{ $status_color }}">{{ $task->duration }} hours</div>
                                @endif --}}
                                                        <div class="col-6"> <a
                                                                href="{{ route('tasks.show', $task) }}">View Detail</a>
                                                        </div>
                                                        <div class="col-6"></div>

                                                        @if (Auth::user()->role == 'user' && ($task->status_id == 1 || $task->status_id == 6))
                                                            <div class="col-6 mt-3"><span>Action</span></div>
                                                            <div class="col-6 mt-3">
                                                                <div class="d-flex">
                                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                                        class="btn text-success"><i
                                                                            class="icofont icofont-ui-edit"></i></a>
                                                                    <form
                                                                        action="{{ route('tasks.destroy', $task->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                                                            type="submit" class="btn btn-danger"><i
                                                                                class="icofont icofont-ui-delete"></i></button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        @elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'developer')
                                                            <div class="col-6 mt-3"><span>Action</span></div>
                                                            <div class="col-6 mt-3">
                                                                <div class="d-flex">
                                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                                        class="btn text-success"><i
                                                                            class="icofont icofont-ui-edit"></i></a>
                                                                    <form
                                                                        action="{{ route('tasks.destroy', $task->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                                                            type="submit" class="btn btn-danger"><i
                                                                                class="icofont icofont-ui-delete"></i></button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-6 mt-3"><span>Action</span></div>
                                                            <div class="col-6 mt-3">
                                                                <div class="d-flex">
                                                                    <a onclick="alert('You can\'t edit this right now.')"
                                                                        class="btn text-success"><i
                                                                            class="icofont icofont-ui-edit"></i></a>
                                                                    <form
                                                                        action="{{ route('tasks.destroy', $task->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            type="button"
                                                                            onclick="alert('You can\'t delete this right now.')"
                                                                            class="btn btn-danger"><i
                                                                                class="icofont icofont-ui-delete"></i></button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="project-status mt-4">
                                                        <div class="media mb-0">
                                                            <p>{{ $task->progress ?? '0' }}% </p>
                                                            <div class="media-body text-end"><span>Done</span></div>
                                                        </div>
                                                        <div class="progress" style="height: 5px">
                                                            <div class="progress-bar-animated bg-primary progress-bar-striped"
                                                                role="progressbar"
                                                                style="width: {{ $task->progress ?? '0' }}%"
                                                                aria-valuenow="10" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-auto mb-3">
                                                <p class="txt-{{ $status_config->status_color }} text-center">Nothing
                                                    to see here ...</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @foreach ($status_configs as $status_config)
                                <div class="tab-pane fade" id="top-{{ $status_config->status }}" role="tabpanel"
                                    aria-labelledby="{{ $status_config->status }}-top-tab">
                                    <div class="row justify-content-center">
                                        @php
                                            $var_tasks = $status_config->status . '_tasks';
                                        @endphp
                                        @if (count($$var_tasks))
                                            @foreach ($$var_tasks as $task)
                                                @php
                                                    $status_color = $task->status->status_color ?? 'primary';
                                                @endphp
                                                <div class="col-xxl-4 col-lg-6">
                                                    <div class="project-box shadow shadow-showcase"><span
                                                            class="badge badge-{{ $status_color }}">{{ $task->status->name }}</span>
                                                        <h6>{{ $task->user->name }}</h6>
                                                        <div class="media"><img class="img-20 me-2 rounded-circle"
                                                                src="{{ asset('/assets/images/dashboard/1.png') }}"
                                                                alt="" data-original-title="" title="">
                                                            <div class="media-body">
                                                                <p>{{ $task->faq->question }}</p>
                                                            </div>
                                                        </div>
                                                        {{-- <p>{{ $task->description }}</p> --}}
                                                        <div class="row details">
                                                            <div class="col-6"><span>Type </span></div>
                                                            @if ($task->type == 'service_ticket')
                                                                <div class="col-6 font-primary">Service</div>
                                                            @else
                                                                <div class="col-6 font-secondary">Change</div>
                                                            @endif
                                                            <div class="col-6"> <span>Warranty Start</span></div>
                                                            <div class="col-6 font-{{ $status_color }}">
                                                                {{ $task->service_warranty_start_date }}</div>
                                                            <div class="col-6"> <span>Warranty End</span></div>
                                                            <div class="col-6 font-{{ $status_color }}">
                                                                {{ $task->service_warranty_start_date }}</div>

                                                            <div class="col-6"> <span>Developer</span></div>
                                                            <div class="col-6 font-{{ $status_color }}">
                                                                {{ $task->developer->name ?? '-' }}</div>
                                                            <div class="col-6"> <a
                                                                    href="{{ route('tasks.show', $task) }}">View
                                                                    Detail</a></div>
                                                            <div class="col-6"></div>


                                                            @if (Auth::user()->role == 'user' && ($task->status_id == 1 || $task->status_id == 6))
                                                                <div class="col-6 mt-3"><span>Action</span></div>
                                                                <div class="col-6 mt-3">
                                                                    <div class="d-flex">
                                                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                                                            class="btn text-success"><i
                                                                                class="icofont icofont-ui-edit"></i></a>
                                                                        <form
                                                                            action="{{ route('tasks.destroy', $task->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button
                                                                                onclick="return confirm('Are you sure you want to delete this task?')"
                                                                                type="submit"
                                                                                class="btn btn-danger"><i
                                                                                    class="icofont icofont-ui-delete"></i></button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            @elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'developer')
                                                                <div class="col-6 mt-3"><span>Action</span></div>
                                                                <div class="col-6 mt-3">
                                                                    <div class="d-flex">
                                                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                                                            class="btn text-success"><i
                                                                                class="icofont icofont-ui-edit"></i></a>
                                                                        <form
                                                                            action="{{ route('tasks.destroy', $task->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button
                                                                                onclick="return confirm('Are you sure you want to delete this task?')"
                                                                                type="submit"
                                                                                class="btn btn-danger"><i
                                                                                    class="icofont icofont-ui-delete"></i></button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-6 mt-3"><span>Action</span></div>
                                                                <div class="col-6 mt-3">
                                                                    <div class="d-flex">
                                                                        <a onclick="alert('You can\'t edit this right now.')"
                                                                            class="btn text-success"><i
                                                                                class="icofont icofont-ui-edit"></i></a>
                                                                        <form
                                                                            action="{{ route('tasks.destroy', $task->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button
                                                                            type="button"
                                                                                onclick="alert('You can\'t delete this right now.')"
                                                                                class="btn btn-danger"><i
                                                                                    class="icofont icofont-ui-delete"></i></button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="project-status mt-4">
                                                            <div class="media mb-0">
                                                                <p>{{ $task->progress ?? '0' }}% </p>
                                                                <div class="media-body text-end"><span>Done</span>
                                                                </div>
                                                            </div>
                                                            <div class="progress" style="height: 5px">
                                                                <div class="progress-bar-animated bg-primary progress-bar-striped"
                                                                    role="progressbar"
                                                                    style="width: {{ $task->progress ?? '0' }}%"
                                                                    aria-valuenow="10" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-auto mb-3">
                                                <p class="txt-{{ $status_config->status_color }} text-center">Nothing
                                                    to see here ...</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    {{-- <div class="container-fluid support-ticket">
      <div class="row">
        <div class="col-sm-12">
          @if (session()->has('success'))
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><strong>Success ! </strong> {{session('success')}}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h5>Task List</h5>
              @if (Auth::user()->role != 'developer')
              <a class="btn btn-primary" href="{{asset('/tasks/create')}}">Create New Task</a>
              @endif
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
                        <td>
                            <span class="badge badge-{{$task->status->status_color}}">{{$task->status->name??'-'}}</span>
                        </td>

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
    </div> --}}
    <!-- Container-fluid Ends-->
</div>
@section('footer')
    @include('templates.footer')
@show
