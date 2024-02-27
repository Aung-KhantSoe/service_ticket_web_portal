@php
    $is_darked = session('is_dark');
@endphp
<body @if($is_darked == true) class="dark-only" @endif>
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader">
      <div class="loader-p"></div>
    </div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start       -->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-main-header">
      <div class="main-header-right row m-0">
        <div class="main-header-left">
          <div class="logo-wrapper"><a href="{{asset('/')}}"><img class="img-fluid" src="{{asset('/assets/images/logo/logo.png')}}"  ></a></div>
          <div class="dark-logo-wrapper"><a href="{{asset('/')}}"><img class="img-fluid" src="{{asset('/assets/images/logo/dark-logo.png')}}" alt=""></a></div>
          <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
        </div>
        <div class="left-menu-header col">
          <ul>
            <li>
              <form class="form-inline search-form">
                <div class="search-bg"><i class="fa fa-search"></i>
                  <input class="form-control-plaintext" placeholder="Search here.....">
                </div>
              </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
            </li>
          </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
          <ul class="nav-menus">
            <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
            <li>
              <div class="mode"><i onclick="toggleDarkMode(event,{{ $is_darked ? 'true' : 'false' }})" class="fa fa-moon-o"></i></div>
            </li>
            <li class="onhover-dropdown p-0">
              <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-primary-light" type="submit"><i data-feather="log-out"></i>Log out</button>
              </form>
            </li>
          </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
      </div>
    </div>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
      <!-- Page Sidebar Start-->
      <header class="main-nav">
        <div class="sidebar-user text-center">
          <a class="setting-primary" href="{{asset('/users/edit/')}}/{{Crypt::encryptString(Auth::user()->id)}}"><i data-feather="settings"></i></a>
          <img class="img-90 rounded-circle" src="{{asset('/assets/images/dashboard/1.png')}}" alt="">
          <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html">
            <h6 class="mt-3 f-14 f-w-600">{{Auth::user()->name}}</h6>
            <p class=" f-14 f-w-600">( {{Auth::user()->role}} )</p>
          </a>
          {{-- <p class="mb-0 font-roboto">{{Auth::user()->shopBranch->organization_name}} > </p>
          <p class="mb-0 font-roboto">{{Auth::user()->shopBranch->branch_name}}</p> --}}
        </div>
        <nav>
          <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
              <ul class="nav-menu custom-scrollbar">
                <li class="back-btn">
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6>General </h6>
                  </div>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="{{asset('/')}}"><i data-feather="home"></i><span>Dashboard</span></a>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="{{asset('/tasks')}}"><i data-feather="headphones"></i><span>Tasks</span></a>
                </li>
                @if(Auth::user()->role == 'admin')
                <li class="sidebar-main-title">
                  <div>
                    <h6>Configuration</h6>
                  </div>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="{{asset('/users')}}"><i data-feather="users"></i><span>Users</span></a>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="{{asset('/products')}}"><i data-feather="package"></i><span>Products</span></a>
                </li>
                {{-- <li class="dropdown"><a class="nav-link menu-title" href="{{asset('/prices')}}"><i data-feather="dollar-sign"></i><span>Prices</span></a>
                </li> --}}
                <li class="dropdown"><a class="nav-link menu-title" href="{{asset('/faqs')}}"><i data-feather="help-circle"></i><span>FAQ</span></a>
                </li>
                @endif
              </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
          </div>
        </nav>
      </header>
      <!-- Page Sidebar Ends-->
