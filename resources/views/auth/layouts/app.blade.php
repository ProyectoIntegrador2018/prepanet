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
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/materialize.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- Favicon -->
    @include('partials.favicon')

    <style media="screen">
        body{
            background: url(/images/background_tec.jpg) no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
        }
    </style>
</head>
<body>
    <main>
      @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/materialize.min.js')}}"></script>
    <script src="{{asset('/js/layout.js')}}"></script>
    <script src="{{asset('/js/login.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @php
                $time = 5000;
            @endphp
            @foreach ($errors->all() as $error)
                M.toast({html: '{{$error}}', displayLength: {{$time}}});
                @php
                    $time += 1000;
                @endphp
            @endforeach
            @if(Session::has('flash_message'))
                M.toast({html: '{{Session::get('flash_message')}}', displayLength: {{$time}}});
            @endif
        });

    </script>

    @yield('scripts')
</body>
</html>
