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
        @if (Auth::user()->role == 'admin')
            <div class="col-sm-6">
                <div class="card">
                <div class="card-header pb-0">
                    <h5>Pie Chart </h5>
                </div>
                <div class="card-body apex-chart" >
                    <div id="piechart"></div>
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <div class="card-header pb-0">
                    <h5>Bar chart</h5>
                </div>
                <div class="card-body">
                    <div id="basic-bar"></div>
                </div>
                <!-- <div class="card-footer">
                    <div class="row">
                    @if(isset($draft))
                    <form action="{{asset("/reportdetail")}}" method="POST">
                    @csrf
                    <input type="hidden" name="results" value="{{$results}}">
                    <input type="hidden" name="status" value="draft">
                    <button class="btn btn-primary mb-3">Draft</button>
                    </form>
                    @endif
                    @if(isset($pending))
                    <a class="btn btn-primary mb-3" >Pending</a>
                    @endif
                    @if(isset($inprogress))
                    <a class="btn btn-primary mb-3" >Inprogress</a>
                    @endif
                    @if(isset($accept))
                    <a class="btn btn-primary mb-3" >Accept</a>
                    @endif
                    @if(isset($surverying))
                    <a class="btn btn-primary mb-3" >Surveying</a>
                    @endif
                    @if(isset($surveryed))
                    <a class="btn btn-primary mb-3" >Surveyed</a>
                    @endif
                    @if(isset($hold))
                    <a class="btn btn-primary mb-3" >Hold</a>
                    @endif
                    @if(isset($credit))
                    <a class="btn btn-primary mb-3" >Credit</a>
                    @endif
                    @if(isset($contract_requested))
                    <a class="btn btn-primary mb-3" >Contract Requested</a>
                    @endif
                    @if(isset($loaned))
                    <a class="btn btn-primary mb-3" >Loaned</a>
                    @endif
                    @if(isset($claim_requested))
                    <a class="btn btn-primary mb-3" >Claim Requested</a>
                    @endif
                    @if(isset($claimed))
                    <a class="btn btn-primary mb-3" >Claimed</a>
                    @endif
                    @if(isset($voucherlist))
                    <a class="btn btn-primary mb-3" >Voucher Lists</a>
                    @endif
                    @if(isset($finished))
                    <a class="btn btn-primary mb-3" >finished</a>
                    @endif
                    </div>
                </div> -->
                </div>
            </div>
        @endif
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
                          <h4 class="total-num">{{$count}}</h4>
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
