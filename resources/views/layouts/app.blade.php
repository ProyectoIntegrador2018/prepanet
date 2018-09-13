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
                        <img id="sidenav-img" src="{{asset('/images/sidenav-background.png')}}">
                    </div>
                    <a class="black-text" href="/account-settings"><img class="circle border-profile-pic" src="{{ \Auth::user()->displayphoto()}}"></a>
                    <a class="black-text" href="/account-settings"><span class="name">{{\Auth::user()->name()}}</span></a>
                    <a class="black-text" href="/account-settings"><span class="email">{{\Auth::user()->email}}</span></a>
                    @if(isCustomer(\Auth::user()->userable))
                    <div style="display:block; margin-top: -16px;">
                        <p class="secondary-color-text inline no-margin" > {{ \Auth::user()->userable->creditCount() }} {{__('common.credits')}}</p>
                        <p class="secondary-color-text inline no-margin" > {{ \Auth::user()->userable->passesCount() }} {{__('common.passes')}}</p>
                        <p class="primary-color-text inline no-margin" > {{ \Auth::user()->userable->tryOutCount() }} {{__('common.try_outs')}}</p>
                    </div>
                    @endif
                    @if(isCustomer(\Auth::user()->userable))
                        <p class="grey-text no-margin">Your referral code is: {{\Auth::user()->userable->referral_code}}</p>
                    @endif
            </div></li>
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
