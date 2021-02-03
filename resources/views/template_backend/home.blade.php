<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/dataTables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dataTables/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
  @yield('css')

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/Stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/Stisla/css/components.css') }}">

  {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}"> --}}
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
            
              <a href="{{route('users.setting')}}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <a class="dropdown-item has-icon" href="{{route('beranda.index')}}"><i class="fas fa-home"></i> Beranda</a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </li>
        </ul>
      </nav>
     
      <!-- SIDEBAR -->

        @include('template_backend.sidebar');

      <!-- END SIDEBAR -->

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>

      <!-- FOOTER -->

        @include('template_backend.footer');

      <!-- END FOOTER -->
    </div>
  </div>

  <script src="{{asset('assets/bootstrap/js/jquery-3.3.1.min.js')}}" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  {{-- <script src="{{ route('js.dynamic') }}"></script> --}}
  <script src="{{ asset('assets/js/app.js') }}?{{ uniqid() }}"></script>
  <script src="{{asset('assets/bootstrap/js/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/moment.min.js')}}"></script>
  <script src="{{ asset('assets/Stisla/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/Stisla/js/scripts.js') }}"></script>

  <!-- JS Libraries -->
  <script src="{{asset('assets/dataTables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/dataTables/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
  
  @stack('scripts')
</body>
</html>
