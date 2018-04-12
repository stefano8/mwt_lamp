@extends('frame')


@section('content')
            <div style="height: 60%; width:100%;" class="hero" data-bg-image="{!! asset('images/terza.jpg') !!}">
                <div class="container">
                  <form action="{{route('search')}}" class="find-location" >
                        <input type="text" name="itinerary_name" id="itinerary_name" placeholder="Find Itinerary...">
                        <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->
                        <input type="submit" value="Find">
                    </form>
                </div>
                <div class="boxtesto" style="margin-left: 1100px; margin-right: 1px;">
                    <h1><span class="testo" style="color: black; margin-left: 80px;">La montagna più alta </span>
                        <span style="color: black;"><br> rimane sempre dentro di noi. <br></span>
                        <span style="color: black; margin-left: 150px;"> <i>Walter Bonatti</i></span>
                    </h1>
                </div>
            </div>

            <main class="main-content">
                <div class="fullwidth-block">
                    <div class="container">
                        <h2 class="section-title">Top Itineraries</h2>
                        <div class="row">
                            @foreach($itineraries as $itinerary)
                            <div class="col-md-3 col-sm-6">
                                <div class="live-camera" style="">

                                    @if(!isset($itinerary->itineraryImage()->first()->path))
                                        <figure class="live-camera-cover">
                                            <img  src="/images/montain.jpg">
                                        </figure>
                                    @else

                                    <figure>
                                        <a href="{{route('itinerary.single', $itinerary->id)}}">
                                            <img style="height: 250px; width: 250px;" src="{{$itinerary->itineraryImage()->first()->path}}" alt="foto">
                                        </a>
                                    </figure>

                                    @endif
                                    <h3 style="margin-top: 5%; marg" class="location"><a href="{{route('itinerary.single', $itinerary->id)}}"> {{$itinerary->name}}</a></h3>
                                </div>

                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <section class="video">
                <div style="height: 60%; width:100%;" class="hero" src="{!! asset('images/seconda.jpg') !!}">
                    <div class="container">
                        <div class="play-video" >
                        <a id="video" href="https://www.youtube.com/watch?v=Q6dsRpVyyWs">
                            <img  src="{!! asset('images/play.png') !!}" alt="" /></a>
                        <p>
                            Watch the Trail Video
                        </p>
                        </div>
                    </div>
                </div>
                </section>





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
                            <p>{{$contact->in}}</p>

                        </div>
                    </div>
                </div>

            </main> <!-- .main-content -->

@endsection

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCBTXFGY7-qUK_F1P6iJEmAijv8zJvt-x0&sensor=false&amp;language=it"></script>

<script type="text/javascript" src="{!! asset('js/YouTubePopUp.jquery.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.fancybox.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/owl-carousel/owl.carousel.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/owl-carousel/highlight.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/owl-carousel/app.js') !!}"></script>

<script>
    jQuery(function(){
        jQuery("a#video").YouTubePopUp();
    })

</script>