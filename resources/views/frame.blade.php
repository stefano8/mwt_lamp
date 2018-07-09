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
    <link href="{!! asset('fonts/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/YouTubePopUp.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/owl-carousel/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/owl-carousel/owl.theme.default.min.css') !!}">

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
                    <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="menu-item"><a href="{{ url('/itineraries') }}">{{trans('words.itineraies')}}</a></li>
                    <li class="menu-item"><a href="{{ url('/advices') }}">{{trans('words.advices')}}</a></li>
                    <li class="menu-item"><a href="{{ url('/news') }}">News</a></li>
                    <li class="menu-item"><a href="{{ url('/events') }}">{{trans('words.events')}}</a></li>

                    @if (Route::has('login'))

                        <div class="top-right links">
                            @auth

                                @if($permission == true)
                                    <a href="{{ url('/home') }}">Dashboard</a>
                                @endif
                                    <li class="menu-item"><a href="{{ route('profile') }}">{{trans('words.profile')}}</a></li>

                                    <li class="menu-item ">
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a style="background: #009ad8;color: white;" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                        @else
                                    <li class="menu-item "><a style="background: #009ad8;color: white;"
                                                              href="{{ route('login') }}">Login</a></li>
                                    <li class="menu-item "><a style="background: #009ad8;color: white;"
                                                              href="{{ route('register') }}">{{trans('words.register')}}</a></li>


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
                <div class="col-md-3 col-md-offset-1" id="social-links">

                        <div class="social-links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=http://montaintrack.it" class="btn btn-facebook btn-lg" id=""><span class="faee fa-facebook"></span></a>
                            <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://montaintrack.it" class="social-button " id=""><span class="faee fa-twitter"></span></a>
                            <a href="https://plus.google.com/share?url=http://montaintrack.it" class="social-button " id=""><span class="faee fa-google-plus"></span></a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://montaintrack.it&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="faee fa-linkedin"></span></a>
                        </div>

                </div>
            </div>

            <p class="colophon">Copyright 2018 MasterWebTechnology. Designed by Stefano and Moira. All rights
                reserved</p>
        </div>
    </footer> <!-- .site-footer -->
</div>

<script src="{!! asset('js/jquery-1.11.1.min.js') !!}"></script>
<script src="{!! asset('js/plugins.js') !!}"></script>
<script src="{!! asset('js/app2.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/YouTubePopUp.jquery.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.fancybox.min.js') !!}"></script>


</body>
</html>
