<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/ico" />

    <title>{{ config('app.name') }} | </title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><span><img src="{{asset('images/favicon.png')}}" alt="..." width="30" height="30" class="img-circle"></span> <span>{{ config('app.name', 'Laravel') }}</span> <span class="badge badge-secondary">{{ Auth::user()->branch->branch_name }}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><strong>{{ strtoupper(Auth::user()->name) }}</strong></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>{{ strtoupper(Auth::user()->roles->pluck('name')->first()) }}</h3>
                <ul class="nav side-menu">
                  <!-- Home Links-->
                  <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>

                  <!-- Banks Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))
                    <li><a href="{{url('banks')}}"><i class="fa fa-building-o"></i>Banks</a></li>
                  @endif

                   <!-- Branches Links-->
                  @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer']))
                    <li><a><i class="fa fa-building-o"></i>Branches<span class=""></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('branches')}}">View Branches</a></li>
                        <li><a href="{{url('branches/create')}}">Add Branch</a></li>
                      </ul>
                    </li>
                  @endif

                  <!-- Categories Links-->
                  @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer','Team Leader','Claims Officer','Administrator','']))
                    <li><a><i class="fa fa-list-alt"></i> Disciplines <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('categories')}}">View Disciplines</a></li>
                        <li><a href="{{url('categories/create')}}">Add Discipline</a></li>
                      </ul>
                    </li>
                  @endif

                  {{-- <!-- Claims Links-->
                  @if(Auth::user()->hasRole(['System Admin','Chairman','Principal Officer','Team Leader','Claims Officer','Administrator','']))
                    <li><a><i class="fa fa-folder-open"></i> Claims <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('claims')}}">View Claims</a></li>
                        <li><a href="{{url('claims/viewclients')}}">Add Claim</a></li>
                        <li><a href="{{url('requests')}}">Service Provider Requests</a></li>
                      </ul>
                    </li>
                  @endif
 --}}
                  <!-- Clients Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider']))
                  <li><a><i class="fa fa-user"></i> Clients <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('clients')}}">View Clients</a></li>
                        @if(!Auth::user()->hasRole(['Client','Service Provider','Team Leader','Chairman','Principal Officer']))
                          <li><a href="{{url('clients/create')}}">Add Client</a></li>
                        @endif
                    </ul>
                  </li>
                  @endif

                  <!-- Corporate Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider','Brand Ambassador']))
                    <li><a href="{{url('groups')}}"><i class="fa fa-group"></i>Corporates</a></li>
                  @endif

                  <!-- MOP Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider']))
                    <li><a href="{{url('mops')}}"><i class="fa fa-money"></i>Mode Of Payments</a></li>
                  @endif

                  <!-- Payments Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider']))
                    <li><a><i class="fa fa-money"></i>Payments<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @if(Auth::user()->hasRole(['Administrator','System Admin']))
                          <li><a href="{{url('payments/create')}}">Add Payment</a></li>
                        @endif
                        <li><a href="{{url('payments')}}">View Payments</a></li>
                        @if(Auth::user()->hasRole(['Team Leader','System Admin','Principal Officer','Chairman']))
                          <li><a href="{{url('payments/reversed')}}">Reversed Payments</a></li>
                        @endif
                      </ul>
                    </li>
                  @endif

                  <!-- Plans Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider']))
                    <li><a><i class="fa fa-list-alt"></i>Plans<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('plans')}}">View Plans</a></li>
                          @if(Auth::user()->hasRole(['Chairman','System Admin','Principal Officer']))
                            <li><a href="{{url('plans/create')}}">Add Plan</a></li>
                          @endif
                      </ul>
                    </li>
                  @endif

                  <!-- Service Provider Links-->
                    <li><a><i class="fa fa-list-alt"></i>Service Providers<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('service_providers')}}">View Service Provider</a></li>
                          @if(Auth::user()->hasRole(['Administrator','System Admin','Claims Officer','Team Leader']))
                            <li><a href="{{url('service_providers/create')}}">Add Service Provider</a></li>
                          @endif
                      </ul>
                    </li>

                  <!-- Tariffs Links-->
                  @if(!Auth::user()->hasRole(['Client','Service Provider']))
                    <li><a><i class="fa fa-legal"></i>Tariffs<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('tariffs')}}">View Tariffs</a></li>
                        <li><a href="{{url('tariffs/create')}}">Add Tariff</a></li>
                      </ul>
                    </li>
                  @endif

                  <!-- Users Links-->
                  @if(Auth::user()->hasRole(['Chairman','System Admin','Principal Officer']))
                    <li><a><i class="fa fa-list-alt"></i>Users<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('users')}}">View Users</a></li>
                      </ul>
                    </li>
                  @endif

              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              @if(Auth::user()->hasRole(['System Admin']))
              <a href="{{ route('settings') }}" data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              @endif
              @if(Auth::user()->hasRole(['System Admin']))
              <a data-toggle="tooltip" data-placement="top" title="Lock" href="{{ route('lock') }}">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              @endif
              <!--Logout Button-->
              <a data-toggle="tooltip" data-placement="top" title="{{ __('Logout') }}" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                 <span class="glyphicon glyphicon-off red" aria-hidden="true"></span>
              </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
               </form>
              <!--/Logout Button-->
            </div>
            <!-- /menu footer buttons -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
               <span><a id="menu_toggle"><i class="fa fa-bars"></i></a></span>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/img.jpg')}}" alt="">{{ strtoupper(Auth::user()->name) }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    @if(Auth::user()->hasRole(['System Admin']))
                    <li>
                      <a href="{{ route('settings') }}">
                        <span class="badge bg-red pull-right"><i class="glyphicon glyphicon-cog"></i></span>
                        <span>Settings</span>
                      </a>
                    </li>
                    @endif
                    <li><a href="{{ route('home') }}">Help</a></li>
                    <!--Logout Button-->
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          <i class="fa fa-sign-out pull-right"></i>
                          {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </li>
                    <!--/Logout Button-->
                  </ul>
                </li>

                {{-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                </li> --}}

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div id="app">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By <a href="https://leereal.me">Leereal</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
  </body>
</html>
