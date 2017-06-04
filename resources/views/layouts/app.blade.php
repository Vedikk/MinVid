<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png"  href="{{ asset('favicon.ico') }}" >
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MinVid') }}</title>

    <!-- Styles -->
    {{--Owl carousel vv  --}}
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    {{--font awesome vv--}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.min.css') }}" media="all" rel="stylesheet" type="text/css">
    {{-- auto generated css , include bootstrap--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- rating stars vv --}}
    <link href="{{ asset('css/star-rating.min.css') }}" media="all" rel="stylesheet" type="text/css">
    {{-- main css file--}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


    <!-- Scripts -->
    {{-- auto generated js, include vue js vv --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    {{--Owl carousel vv  --}}
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    {{-- rating stars--}}
    <script src="{{ asset('js/star-rating.min.js') }}"></script>
    <script src="{{ asset('js/theme.min.js') }}"></script>
    {{--infinite scroll--}}
    <script src="{{ asset('js/jquery.jscroll.min.js') }}"></script>

    {{--js video player below--}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
    <script>
        window.Laravel ={!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,600" rel="stylesheet" type="text/css">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="navbar_logo" src="{{ asset('img/logo.png') }}" alt="logo" >
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" style="position: relative; padding-left: 50px;">
                                <img src="/avatars/{{ Auth::user()->avatar }}" alt="user_avatar"
                                     class="user_corner_avatar">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('home') }}">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('addVideo') }}"> Add video</a>
                                </li>
                                <li>
                                    <a href="{{route('allUsers')}}">All users</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
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
</div>

<!-- Scripts -->
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>