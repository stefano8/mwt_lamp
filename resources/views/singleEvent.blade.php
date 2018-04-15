@extends('frame')


@section('content')

<main class="main-content">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span>Events</span>
        </div>
    </div>

    <div style="height: 60%; width:100%; margin-top: 20px;" class="hero" data-bg-image="{!! asset('images/eventi.jpg') !!}">
        <div class="container">

        </div>

    </div>

    <div class="fullwidth-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"></div>
                <div class="col-sm-3">

                <div id="social-links">

                    <div class="social-links" style="font-size: 200%;">Condividi:
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://montaintrack.it" class="btn btn-facebook btn-lg" id=""><span class="fa fa-facebook"></span></a>
                        <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-twitter"></span></a>
                        <a href="https://plus.google.com/share?url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-google-plus"></span></a>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://montaintrack.it&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="fa fa-linkedin"></span></a>
                    </div>
                </div>
                    </div>


            </div>
            <div class="row">

                <div class="forecast-table">
                    <div class="container">
                        <div class="forecast-container">
                            <div class="today forecast">
                                <div class="forecast-header">
                                    <div class="day"><h1 style="color:white;">{{$event->title}}</h1></div>

                                </div> <!-- .forecast-header -->
                                <div class="forecast-content">
                                    <div class="widget">
                                        <ul class="arrow-list">

                                        </ul>
                                    </div>
                                </div>
                                @if(!isset($event->eventImage()->first()->path))
                                    <figure class="live-camera-cover">
                                        <img src="/images/calendar.jpg" style="width: 175px; height: 190px; margin-left: 119px;">
                                    </figure>
                                @else
                                    @foreach($image as $images)

                                        <figure class="live-camera-cover">

                                            <img src="{{$images->path}}" alt="foto"
                                                 style="width: 300px; height: 223px; margin-left: 60px;">

                                        </figure>
                                            @endforeach

                                    @endif


                            </div>

                            <div class="forecast">
                                <div class="forecast-header">
                                    <a href="{{route('itinerary.single', $itinerario->id)}}"><h3>{{$itinerario->name}}</h3></a>

                                    <div class="day">

                                        <h2 class="entry-title" style="font-size: 200%; color:white;">{{$event->date}}</h2></div>
                                </div> <!-- .forecast-header -->
                                <div class="degree">
                                    <div >
                                        <div style="background-color: transparent;">
                                            <div style="width: 900px; height: 350px;">
                                                <h2 style="margin-left: 10px; margin-top: 20px;">Informazioni:</h2>
                                                <h3  style="margin-left: 10px; width:56em; word-wrap:break-word; color:white;">{{$event->body}}</h3>

                                                <h3  style="margin-left: 10px; width:56em; word-wrap:break-word; color:white;">{{$event->description}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






            </div>







        </div>
    </div>
</main> <!-- .main-content -->

@endsection