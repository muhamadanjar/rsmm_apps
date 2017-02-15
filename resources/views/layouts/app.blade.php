<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ url('/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/jquery.datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="icon" type="icon" href="{{ asset('images/LogoBSN.jpg') }}">
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript" charset="utf8" src="{{ asset('vendor/datatables/js/jquery.js')}}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img width="70" height="30" src="{{ url('images/LogoBSN.jpg') }}"/>
                        

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Data <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/kuesioner') }}">Kuesioner</a></li>
                                    <li><a href="{{ url('/kuesioner/gambaranumum') }}">Gambaran Umum</a></li>
                                    <li><a href="{{ url('/kuesioner') }}">Profil UMKM</a></li>
                                </ul>
                        </li>
                        <li><a href="{{ url('/excel') }}">Excel</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        @include('vendor.modal')
    </div>

    <!-- Scripts -->
    @yield('js_tambahan')
    <!--<script src="{{ url('/js/app.js') }}"></script>-->
    
    <script type="text/javascript" charset="utf8" src="{{ asset('vendor/datatables/js/jquery.datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript" src="{{ url('bpn.js') }}"></script>

</body>
</html>
