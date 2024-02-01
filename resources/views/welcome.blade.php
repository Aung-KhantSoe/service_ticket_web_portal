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
            <h3>Dashboard</h3>
            
          </div>
          
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid support-ticket">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Task List</h5><span>List of task opened by customers</span>
            </div>
            <div class="card-body">
              <div class="row">
                @foreach ($status_configs as $status_config)
                <div class="col-xl-4 col-sm-6">
                  <div class="card ecommerce-widget pro-gress">
                    <div class="card-body support-ticket-font">
                      <div class="row">
                        <div class="col-5">
                          <h6>{{$status_config->name}}</h6>
                          @php
                              $count = '0';
                              $stats_tasks = $status_config->status.'_tasks';
                              $count = count($$stats_tasks);
                              $total_count = count($tasks);
                          @endphp
                          <h4 class="total-num counter">{{$count}}</h4>
                        </div>
                        <div class="col-7">
                          <div class="text-md-end">
                            <ul>
                              <li>Total<span class="product-stts txt-primary ms-2">{{$total_count}}</span></li>
                              <li>{{$status_config->name}}<span class="product-stts txt-danger ms-2">{{$count}}</span></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="progress-showcase">
                        <div class="progress">
                          <div class="progress-bar bg-{{$status_config->status_color}}" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                
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