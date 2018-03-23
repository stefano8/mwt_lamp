<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mwt18</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->


    <!-- Loading third party fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
    <link href= "{!! asset('fonts/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">

    <!-- Loading main css file -->
    <link rel="stylesheet" href=" {!! asset('css/style.css') !!} ">
    <style>


        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: inherit;
            float: right;
            right: 10px;
            top: 18px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-family: "Roboto", "Open Sans", sans-serif;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

    </style>
</head>
<body>


<div class="site-content">
    <div class="site-header">
        <div class="container">
            <a href="{{ url('/') }}" style="margin-right:50%; margin-left: 45%;">
                <img style="width: 100px; height: 100px" src="{!! asset('images/logom.png') !!}" alt="" class="logo">
                <div class="logo-type">
                </div>
            </a>

            <!-- Default snippet for navigation -->
            <div class="main-navigation" style="float: left; margin-left: 80px">
                <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                <ul class="menu">
                    <li class="menu-item current-menu-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="menu-item"><a href="{{ url('/itineraries/{itinerary_id}') }}">Itineraries</a></li>
                    <li class="menu-item"><a href="{{ url('/advices') }}">Advices</a></li>
                    <li class="menu-item"><a href="{{ url('/news') }}">News</a></li>
                    <li class="menu-item"><a href="{{ url('/photos') }}">Events</a></li>
                    <!--<li class="menu-item"><a href="{{ url('/contact') }}">Contact</a></li>-->

                    @if (Route::has('login'))




                        <div class="top-right links">
                            @auth


                            {{--@if($user = Auth::user() && $role == 'admin')}}--}}
                            <a href="{{ url('/home') }}">Dashboard</a>
                            {{--@endif--}}

                            <li class="menu-item"><a href="{{ route('profile') }}">Profile</a></li>

                            <li class="menu-item ">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a style="background: #009ad8;color: white;" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            </li>
                        @else
                        <li class="menu-item " ><a style="background: #009ad8;color: white;" href="{{ route('login') }}">Login</a></li>
                        <li class="menu-item "><a style="background: #009ad8;color: white;" href="{{ route('register') }}">Register</a></li>
                                @endauth
                        </div>
                    @endif
                </ul> <!-- .menu -->
            </div> <!-- .main-navigation -->

            <div class="mobile-navigation"></div>

        </div>
    </div> <!-- .site-header -->


@yield('content')


    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-3 col-md-offset-1">
                    <div class="social-links">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <p class="colophon">Copyright 2018 MasterWebTechnology. Designed by Stefano and Moira. All rights reserved</p>
        </div>
    </footer> <!-- .site-footer -->
</div>

<script src="{!! asset('js/jquery-1.11.1.min.js') !!}"></script>
<script src="{!! asset('js/plugins.js') !!}"></script>
<script src="{!! asset('js/app2.js') !!}"></script>


</body>
</html>
