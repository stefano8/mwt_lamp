@extends('frame')


@section('content')
            <div class="hero" data-bg-image="{!! asset('images/banner.jpg') !!}">
                <div class="container">
                    <form action="{{route('search')}}" class="find-location">
                        <input type="text" name="itinerary_name" id="itinerary_name" placeholder="Find Itinerary...">
                        <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->
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
                        <h2 class="section-title">Top Itineraries</h2>
                        <div class="row">
                            @foreach($itineraries as $itinerary)
                            <div class="col-md-3 col-sm-6">
                                <div class="live-camera">
                                    <figure class="live-camera-cover"><a href="{{route('itinerary.single', $itinerary->id)}}"><img src="{{$itinerary->itineraryImage()->first()->path}}" alt="foto"></a></figure>
                                    <h3 class="location"><a href="{{route('itinerary.single', $itinerary->id)}}"> {{$itinerary->name}}</a></h3>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="fullwidth-block" data-bg-color="#262936">
                    <div class="container">
                        <h2 class="section-title">Events</h2>

                        <div class="row">
                            @foreach($events as $event)
                            <div class="col-md-4">
                                <div class="news">
                                    <div class="date" style="line-height: 0.5;"><a href="{{route('event.single', $event->id)}}">{{$event->date}}</a></div>
                                    <h3 style="margin:1px 14px 20px;"><a href="{{route('event.single', $event->id)}}" style="margin-right: 5px; ">{{$event->title}}</a></h3>
                                    <p style="margin:1px 14px 20px; display: inline-block; width: 200px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis; -o-text-overflow: ellipsis;" >{{$event->body}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="fullwidth-block">
                    <div class="container">
                        <div class="col-md-5">
                            <div class="contact-details">
                                <div class="map" data-latitude="-6.897789" data-longitude="107.621735"></div>
                                <div class="contact-info">
                                    <address>
                                        <img src="images/icon-marker.png" alt="">
                                        <p>Company CorsDiS <br>
                                            via Federico Trecco 8, L'Aquila</p>
                                    </address>

                                    <a href="#"><img src="images/icon-phone.png" alt="">+1 800 314 235</a>
                                    <a href="#"><img src="images/icon-envelope.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-1">
                            <h2 class="section-title">About us</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi consectetur inventore ducimus, facilis, numquam id soluta omnis eius recusandae nesciunt vero repellat harum cum. Nisi facilis odit hic, ipsum sed!</p>

                        </div>
                    </div>
                </div>

            </main> <!-- .main-content -->

@endsection