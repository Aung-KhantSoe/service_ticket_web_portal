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
              <h3>Task Detail</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{asset('/')}}">Home</a></li>
                <li class="breadcrumb-item">dashboard</li>
                <li class="breadcrumb-item active">task detail</li>
              </ol>
            </div>

          </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        @php
            $status_color = $task->status->status_color??'primary';
        @endphp
        <div>
            <div class="row product-page-main p-0">
                <div class="col-xl-5 box-col-6 proorder-xl-3 xl-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="pro-group pt-0 border-0">
                                <div class="product-page-details mt-0">
                                    <h3>{{ $task->user->name }}</h3>
                                </div>
                                <p>({{ $task->faq->question }})</p>
                                <span class="badge badge-{{ $status_color }}">Status : {{ $task->status->name }}</span>
                            </div>
                            <div class="pro-group">
                                <p>{{ $task->description }}</p>
                            </div>
                            <div class="pro-group">
                            <div class="row">
                                <div class="col-md-6">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td> <b>Type</b></td>
                                        <td class="p-l-10 p-r-10 text-start"><b>:</b></td>
                                        @if ($task->type == 'service_ticket')
                                        <td class="txt-success">Service Ticket</td>
                                        @else
                                        <td class="txt-success">Change Request</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td > <b>Warranty Start</b></td>
                                        <td class="p-l-10 p-r-10 text-start"><b>:</b></td>
                                        <td>{{ $task->service_warranty_end_date }}</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Warranty End</b></td>
                                        <td class="p-l-10 p-r-10 text-start"><b>:</b></td>
                                        <td>{{ $task->service_warranty_end_date }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="col-md-6">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td> <b>Product</b></td>
                                            <td class="p-l-10 p-r-10 text-start"><b>:</b></td>
                                            <td class="txt-success">{{ $task->product->name??"-" }}</td>
                                        </tr>
                                        <tr>
                                            <td> <b>Developer</b></td>
                                            <td class="p-l-10 p-r-10 text-start"><b>:</b></td>
                                            <td class="txt-success">{{ $task->developer->name??"-" }}</td>
                                        </tr>
                                        <tr>
                                            <td> <b>Duration</b></td>
                                            <td class="p-l-10 p-r-10 text-start"><b>:</b></td>
                                            <td class="txt-success">{{ $task->duration??"-" }} hours</td>
                                        </tr>

                                    </tbody>
                                </table>
                                </div>
                                <div class="col-md-6 xl-50">
                                    <div class="project-status mt-4">
                                        <div class="media mb-0">
                                        <p>{{ $task->progress??'0' }}% </p>
                                        <div class="media-body text-end"><span>Done</span></div>
                                        </div>
                                        <div class="progress" style="height: 5px">
                                        <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: {{ $task->progress??'0' }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="pro-group">
                            <div class="row">
                                <div class="col-md-4 xl-50">
                                <h6 class="product-title">Total Cost</h6>
                                </div>
                                <div class="col-md-7 xl-50">
                                    <div class="product-icon">
                                        <div class="product-price">{{ $task->cost??'-' }} MMK
                                            {{-- @php
                                                $task_type = $task->type;
                                                if($task_type){
                                                    $fieldname
                                                }
                                            @endphp --}}
                                            {{-- <small class="txt-info">({{ $task->product->price }})</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="pro-group pb-0">
                                <div class="pro-shop">
                                    <div class="d-flex">
                                        <a class="btn btn-info m-r-10" href="{{route('tasks.index')}}">Back</a>
                                        @if (Auth::user()->role == 'user' && ($task->status_id == 1 || $task->status_id == 6))
                                        <a class="btn btn-primary m-r-10" href="{{ route('tasks.edit', $task->id) }}"><i class="icofont icofont-ui-edit"></i> Edit Task</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this task?')" type="submit" class="btn btn-danger"><i class="icofont icofont-ui-delete"></i> Delete Task</button>
                                        </form>
                                        @elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'developer')
                                        <a class="btn btn-primary m-r-10" href="{{ route('tasks.edit', $task->id) }}"><i class="icofont icofont-ui-edit"></i> Edit Task</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this task?')" type="submit" class="btn btn-danger"><i class="icofont icofont-ui-delete"></i> Delete Task</button>
                                        </form>
                                        @else
                                        <a onclick="alert('You can\'t edit this right now.')" class="btn btn-primary m-r-10"><i class="icofont icofont-ui-edit"></i> Edit Task</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="alert('You can\'t delete this right now.')" type="button" class="btn btn-danger"><i class="icofont icofont-ui-delete"></i> Delete Task</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            @if (isset($attachment))
            <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header pb-0">
                      <h5>Attachments</h5>
                    </div>
                    <div class="card-body">
                      <div class="row gallery my-gallery" id="aniimated-thumbnials14" itemscope="">
                        @for ($i = 1; $i < 6; $i++)
                            @php
                                $fieldname = "photo_".$i;
                            @endphp
                            @if (asset($attachment->$fieldname) && $attachment->$fieldname != '' && $attachment->$fieldname != null)
                            <figure class="col-md-3 img-hover hover-15" itemprop="associatedMedia" itemscope=""><a href="{{ asset($attachment->$fieldname) }}" itemprop="contentUrl" data-size="1600x950">
                                <div><img src="{{ asset($attachment->$fieldname) }}" itemprop="thumbnail" alt="Photo {{ $i }}"></div></a>
                            <figcaption itemprop="caption description">Photo {{ $i }}</figcaption>
                            </figure>
                            @endif
                        @endfor
                        @if (asset($attachment->receipt))
                        <figure class="col-md-3 img-hover hover-15" itemprop="associatedMedia" itemscope=""><a href="{{ asset($attachment->receipt) }}" itemprop="contentUrl" data-size="1600x950">
                            <div><img src="{{ asset($attachment->receipt) }}" itemprop="thumbnail" alt="Receipt"></div></a>
                          <figcaption itemprop="caption description">Receipt</figcaption>
                        </figure>
                        @endif


                      </div>
                    </div>
                  </div>
                </div>
            </div>
            @endif
        </div>

    </div>
    <!-- Container-fluid Ends-->
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Timeline</h5>
              </div>
              <div class="card-body">
                <div id="timeline-2">

                    @if (isset($timelog))
                        @if (isset($timelog->order_at))
                        <div data-year="Order" @if($task->status->status == 'order') class="active" @endif>{{ $timelog->order_at }}</div>
                        @endif
                        @if (isset($timelog->pending_at))
                        <div data-year="Pending" @if($task->status->status == 'pending') class="active" @endif>{{ $timelog->pending_at }}</div>
                        @endif
                        @if (isset($timelog->running_at))
                        <div data-year="Running" @if($task->status->status == 'running') class="active" @endif>{{ $timelog->running_at }}</div>
                        @endif
                        @if (isset($timelog->smooth_at))
                        <div data-year="Smooth" @if($task->status->status == 'smooth') class="active" @endif>{{ $timelog->smooth_at }}</div>
                        @endif
                        @if (isset($timelog->done_at))
                        <div data-year="Done" @if($task->status->status == 'done') class="active" @endif>{{ $timelog->done_at }}</div>
                        @endif
                        @if (isset($timelog->cancel_at))
                        <div data-year="Cancel" @if($task->status->status == 'cancel') class="active" @endif>{{ $timelog->cancel_at }}</div>
                        @endif
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

@section('footer')
@include('templates.footer')
@show
