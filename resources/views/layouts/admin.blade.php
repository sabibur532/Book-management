<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SR Admin Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/main.css')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">

          <a class="app-header__logo" href="{{ url('/') }}">
              Book
          </a>
          <!-- Sidebar toggle button-->
          <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
          <!-- Navbar Right Menu-->


          <ul class="app-nav">
          <!-- User Menu-->
          <li class="dropdown">
          @guest

                  <a class="app-nav__item " href="{{ route('login') }}">{{ __('Login') }}</a>
              {{-- @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif --}}
          @else

                      <a class="app-nav__item btn btn-danger btn-lg my-1" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="icon fa fa-sign-out"></i>
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
          @endguest
        </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('photo/user/') }}\{{ Auth::user()->photo }}" alt="User Image" width="60">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
          <p class="app-sidebar__user-designation">
            @if (Auth::user()->role==1)
             {{ 'Admin' }}
           @elseif (Auth::user()->role==2)
             {{ 'Modarator' }}
           @else
             {{ 'Authore' }}
           @endif
         </p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{ url('/') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        @if (Auth::user()->role==1||Auth::user()->role==2)
        <li><a class="app-menu__item active" href="{{ url('/customer/add') }}"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Add New CUstomer</span></a></li>
        @endif

        <li><a class="app-menu__item active" href="{{ url('/customer/view') }}"><i class="app-menu__icon fa fa-id-card"></i><span class="app-menu__label">  Customer Delails</span></a></li>
        <li><a class="app-menu__item active" href="{{ url('/books') }}"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Book Details</span></a></li>

        <li><a class="app-menu__item active" href="{{ url('/cash') }}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Cash Amount</span></a></li>

        <li><a class="app-menu__item active" href="{{ url('/cost') }}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Cost Amount</span></a></li>
         @if (Auth::user()->role==1||Auth::user()->role==2)
        <li><a class="app-menu__item active" href="{{ url('/users') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">All Users</span></a></li>
        @endif





      </ul>
    </aside>
    <main class="app-content">
      {{-- <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Developed by Sabibur Rahman</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div> --}}

      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/js/main.js')}}"></script>
  </body>
</html>
