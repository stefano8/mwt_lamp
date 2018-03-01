<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MWT 2018 - Laravel</title>

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
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="">Login</a>
                        <a href="{{ route('register') }}" class="">Register</a>
                    @endauth
                </div>
            @endif
        </div>



        <div class="site-content">
            <div class="site-header">
                <div class="container">
                    <a href="index.html" class="branding">
                        <img style="width: 80px; height: 80px" src="{!! asset('images/logom.png') !!}" alt="" class="logo">
                        <div class="logo-type">
                            <h1 class="site-title">Company name</h1>
                            <small class="site-description">tagline goes here</small>
                        </div>
                    </a>

                    <!-- Default snippet for navigation -->
                    <div class="main-navigation">
                        <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                        <ul class="menu">
                            <li class="menu-item current-menu-item"><a href="index.html">Home</a></li>
                            <li class="menu-item"><a href="news.html">News</a></li>
                            <li class="menu-item"><a href="live-cameras.html">Live cameras</a></li>
                            <li class="menu-item"><a href="photos.html">Photos</a></li>
                            <li class="menu-item"><a href="contact.html">Contact</a></li>
                        </ul> <!-- .menu -->
                    </div> <!-- .main-navigation -->

                    <div class="mobile-navigation"></div>

                </div>
            </div> <!-- .site-header -->

            <div class="hero" data-bg-image="{!! asset('images/banner.jpg') !!}">
                <div class="container">
                    <form action="#" class="find-location">
                        <input type="text" placeholder="Find your location...">
                        <input type="submit" value="Find">
                    </form>

                </div>
            </div>
            <div class="forecast-table">
                <div class="container">
                    <div class="forecast-container">
                        <div class="today forecast">
                            <div class="forecast-header">
                                <div class="day">Monday</div>
                                <div class="date">6 Oct</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="location">New York</div>
                                <div class="degree">
                                    <div class="num">23<sup>o</sup>C</div>
                                    <div class="forecast-icon">
                                        <img src="{!! asset('images/icons/icon-1.svg') !!}" alt="" width=90>
                                    </div>
                                </div>
                                <span><img src="{!! asset('images/icon-umberella.png') !!}" alt="">20%</span>
                                <span><img src="{!! asset('images/icon-wind.png') !!}" alt="">18km/h</span>
                                <span><img src="{!! asset('images/icon-compass.png') !!}" alt="">East</span>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day">Tuesday</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="{!! asset('images/icons/icon-3.svg') !!}" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day">Wednesday</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="{!! asset('images/icons/icon-5.svg') !!}" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day">Thursday</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="{!! asset('images/icons/icon-7.svg') !!}" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day">Friday</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="{!! asset('images/icons/icon-12.svg') !!}" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day">Saturday</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="{!! asset('images/icons/icon-13.svg') !!}" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                        <div class="forecast">
                            <div class="forecast-header">
                                <div class="day">Sunday</div>
                            </div> <!-- .forecast-header -->
                            <div class="forecast-content">
                                <div class="forecast-icon">
                                    <img src="{!! asset('images/icons/icon-14.svg') !!}" alt="" width=48>
                                </div>
                                <div class="degree">23<sup>o</sup>C</div>
                                <small>18<sup>o</sup></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main class="main-content">
                <div class="fullwidth-block">
                    <div class="container">
                        <h2 class="section-title">Live cameras</h2>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="live-camera">
                                    <figure class="live-camera-cover"><img src="{!! asset('images/live-camera-1.jpg') !!}" alt=""></figure>
                                    <h3 class="location">New York</h3>
                                    <small class="date">8 oct, 8:00AM</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="live-camera">
                                    <figure class="live-camera-cover"><img src="{!! asset('images/live-camera-2.jpg') !!}" alt=""></figure>
                                    <h3 class="location">Los Angeles</h3>
                                    <small class="date">8 oct, 8:00AM</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="live-camera">
                                    <figure class="live-camera-cover"><img src="{!! asset('images/live-camera-3.jpg') !!}" alt=""></figure>
                                    <h3 class="location">Chicago</h3>
                                    <small class="date">8 oct, 8:00AM</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="live-camera">
                                    <figure class="live-camera-cover"><img src="{!! asset('images/live-camera-4.jpg') !!}" alt=""></figure>
                                    <h3 class="location">London</h3>
                                    <small class="date">8 oct, 8:00AM</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fullwidth-block" data-bg-color="#262936">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="news">
                                    <div class="date">06.10</div>
                                    <h3><a href="#">Doloremque laudantium totam sequi </a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo saepe assumenda dolorem modi, expedita voluptatum ducimus necessitatibus. Asperiores quod reprehenderit necessitatibus harum, mollitia, odit et consequatur maxime nisi amet doloremque.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="news">
                                    <div class="date">06.10</div>
                                    <h3><a href="#">Doloremque laudantium totam sequi </a></h3>
                                    <p>Nobis architecto consequatur ab, ea, eum autem aperiam accusantium placeat vitae facere explicabo temporibus minus distinctio cum optio quis, dignissimos eius aspernatur fuga. Praesentium totam, corrupti beatae amet expedita veritatis.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="news">
                                    <div class="date">06.10</div>
                                    <h3><a href="#">Doloremque laudantium totam sequi </a></h3>
                                    <p>Enim impedit officiis placeat qui recusandae doloremque possimus, iusto blanditiis, quam optio delectus maiores. Possimus rerum, velit cum natus eos. Cumque pariatur beatae asperiores, esse libero quas ad dolorem. Voluptates.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fullwidth-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 class="section-title">Application features</h2>
                                <ul class="arrow-feature">
                                    <li>
                                        <h3>Natus error sit voluptatem accusantium</h3>
                                        <p>Doloremque laudantium totam rem aperiam Inventore veritatis et quasi architecto beatae vitae.</p>
                                    </li>
                                    <li>
                                        <h3>Natus error sit voluptatem accusantium</h3>
                                        <p>Doloremque laudantium totam rem aperiam Inventore veritatis et quasi architecto beatae vitae.</p>
                                    </li>
                                    <li>
                                        <h3>Natus error sit voluptatem accusantium</h3>
                                        <p>Doloremque laudantium totam rem aperiam Inventore veritatis et quasi architecto beatae vitae.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h2 class="section-title">Weather analyssis</h2>
                                <ul class="arrow-list">
                                    <li><a href="#">Accusantium doloremque laudantium rem aperiam</a></li>
                                    <li><a href="#">Eaque ipsa quae ab illo inventore veritatis quasi</a></li>
                                    <li><a href="#">Architecto beatae vitae dicta sunt explicabo</a></li>
                                    <li><a href="#">Nemo enim ipsam voluptatem quia voluptas</a></li>
                                    <li><a href="#">Aspernatur aut odit aut fugit, sed quia consequuntur</a></li>
                                    <li><a href="#">Magni dolores eos qui ratione voluptatem sequi</a></li>
                                    <li><a href="#">Neque porro quisquam est qui dolorem ipsum quia</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h2 class="section-title">Awesome Photos</h2>
                                <div class="photo-grid">
                                    <a href="#"><img src="{!! asset('images/thumb-1.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-2.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-3.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-4.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-5.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-6.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-7.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/thumb-8.jpg') !!}" alt="#"></a>
                                    <a href="#"><img src="{!! asset('images/lthumb-9.jpg') !!}" alt="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main> <!-- .main-content -->

            <footer class="site-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="#" class="subscribe-form">
                                <input type="text" placeholder="Enter your email to subscribe...">
                                <input type="submit" value="Subscribe">
                            </form>
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

                    <p class="colophon">Copyright 2014 Company name. Designed by Themezy. All rights reserved</p>
                </div>
            </footer> <!-- .site-footer -->
        </div>

        <script src="{!! asset('js/jquery-1.11.1.min.js') !!}"></script>
        <script src="{!! asset('js/plugins.js') !!}"></script>
        <script src="{!! asset('js/app2.js') !!}"></script>


    </body>
</html>
