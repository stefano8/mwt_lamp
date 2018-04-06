@extends('frame')


@section('content')
            <div style="height: auto; width:100%;" class="hero" data-bg-image="{!! asset('images/banner.jpg') !!}">
                <div class="container">
                  <form action="{{route('search')}}" class="find-location" >
                        <input type="text" name="itinerary_name" id="itinerary_name" placeholder="Find Itinerary...">
                        <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->
                        <input type="submit" value="Find">
                    </form>

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

                                    @if(!isset($itinerary->itineraryImage()->first()->path))
                                        <figure class="live-camera-cover"><img style="height: 150px; width: 150px;" src="/images/montain.jpg"></figure>
                                    @else

                                    <figure class="live-camera-cover"><a href="{{route('itinerary.single', $itinerary->id)}}"><img src="{{$itinerary->itineraryImage()->first()->path}}" alt="foto"></a></figure>

                                    @endif
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
                                <div class="map" data-latitude="42.3505500" data-longitude="13.3995400"></div>
                                <div class="contact-info">
                                    <address>
                                        <img src="/images/icon-marker.png" alt="">
                                        <p>Company CorsDiS <br>
                                            via Federico Trecco 8, L'Aquila</p>
                                    </address>

                                    <a href="#"><img src="/images/icon-phone.png" alt="">+1 800 314 235</a>
                                    <a href="#"><img src="/images/icon-envelope.png" alt=""></a>
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

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCBTXFGY7-qUK_F1P6iJEmAijv8zJvt-x0&sensor=false&amp;language=it"></script>