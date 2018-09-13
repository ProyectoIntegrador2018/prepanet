<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/materialize.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css?v=1') }}" rel="stylesheet" type="text/css">
    @yield('styles')
    <!-- Favicon -->
    @include('partials.favicon')
</head>
<body>
    <div id="app">
        <div class="navbar-fixed">
            <nav class="primary-color">
                <div class="nav-wrapper">
                        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
                    <a href="/" class="brand-logo left hide-on-small-only">{{ config('app.name') }}</a>
                </div>
            </nav>
        </div>

        <ul id="slide-out" class="sidenav">
            <li><div class="user-view">
                <div class="background">
                    <img id="sidenav-img" src="">
                </div>
                <a class="black-text" href=""><span class="name">{{\Auth::user()->getName()}}</span></a>
            </div></li>
            <li><div class="divider"></div></li>
            @if(isSuperAdmin(\Auth::user()->userable))<li><a href=""><i class="material-icons">accessibility</i>Personal</a></li>@endif
            @if(isSuperAdmin(\Auth::user()->userable))<li><a href=""><i class="material-icons">business</i>Campus</a></li>@endif
            @if(isSuperAdmin(\Auth::user()->userable))<li><a href=""><i class="material-icons">today</i>Reportes</a></li>@endif
            <li><div class="divider"></div></li>
            <li><a href=""><i class="material-icons">accessibility</i>Tutores</a></li>
            <li><a href=""><i class="material-icons">accessibility</i>Alumnos</a></li>
            <li><div class="divider"></div></li>
            <li><a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">power_settings_new</i>Logout</a></li>
        </ul>
        <form id="logout-form" action="{{ url('logout') }}" method="POST">
            @csrf
        </form>


        <main class="main">
            @if(!isset($headerOff))
            <div class="section primary-color" id="index-banner">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            @yield('header')
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/materialize.min.js')}}"></script>
    <script src="{{asset('/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('/js/layout.js?v=1.1')}}"></script>
    @yield('scripts')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</body>
</html>
