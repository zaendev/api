<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="keywords" content="{{ $meta['keyword'] }}">
    <meta name="author" content="{{ Auth::user()->name }}">
    <title>{{ $meta['title'] }}</title>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>

</head>
<body>
    <div>
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                  <li class="nav-item d-none d-sm-inline-block">
                      <a class="nav-link" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <small> <a class="nav-link" href="https://share.web.id"> Copyright &copy; 2018 - {{ date('Y') }} </a> </small>
                </li>
                <li class="nav-item">
                  <small> <a class="nav-link" href="https://share.web.id"> Zain v1</a> </small>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('admin') }}" class="brand-link text-center">
                {{--<img src="#" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
                     {{--style="opacity: .8">--}}
                <span class="brand-text font-weight-light">ZAIN</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{--<img src="#" class="img-circle elevation-2" alt="User Image">--}}
                    </div>
                    <div class="info">
                        <a href="{{ url('/') }}" class="d-block">{{ Auth::check() ? Auth::user()->name:'' }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="{{ url('/') }}" class="nav-link {{ empty(Request::segment(1)) ? 'active':'' }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ url('client') }}" class="nav-link {{ Request::segment(1) == 'client' ? 'active':'' }}">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Client
                                </p>
                            </a>
                        </li>
                         <li class="nav-item has-treeview">
                            <a href="{{ url('config') }}" class="nav-link {{ Request::segment(1) == 'config' ? 'active':'' }}">
                                <i class="nav-icon fa fa-gears"></i>
                                <p>
                                    Config
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            @yield('content')

        </div>

    </div>
    <script src="{{ asset('js/admin/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/admin/adminlte.min.js') }}"></script>

<script>
    $('.close-alert').click(function () {
        $('.alert-dismissible').hide();
    });
</script>
</body>
</html>
