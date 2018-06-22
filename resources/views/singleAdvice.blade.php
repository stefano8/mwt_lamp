@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>Advices</span>
            </div>
        </div>
        <div style="height: 60%; width:100%; margin-top: -7px;" class="hero" data-bg-image="{!! asset('images/bunnerdolomiti.jpg') !!}">
            <div class="boxtesto" style=" margin-left: 1100px; margin-right: 1px;">
                <h1 style="margin-top: -67px;">
                    <span class="testo" style="color: black; margin-left: -309px;">Il fascino delle montagne è dato dal fatto che sono belle..
                    </span>
                    <span style="color: black; margin-left: 225px;"> grandi.. <br></span>
                    <span style="color: black; margin-left: 162px;"> e pericolose..</span>
                    <span style="color: black; margin-left: 119px;"> <i>Reinold Messner</i></span>

                </h1>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">

                        <div class="col-md-9" id="social-links">
                            <div class="social-links" style="font-size: 200%;">Condividi:
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http://montaintrack.it" class="btn btn-facebook btn-lg" id=""><span class="fa fa-facebook"></span></a>
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-twitter"></span></a>
                                <a href="https://plus.google.com/share?url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-google-plus"></span></a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://montaintrack.it&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="fa fa-linkedin"></span></a>
                            </div>
                        </div>

                    </div>


                <div class="fullwidth-block">
                    <div class="container">



                        <div class="row">


                            <div class="sidebar col-md-7">
                                <div class="widget">

                                    <div class="today-forecast">
                                    <div class="forecast-header">
                                        <div class="day"><h1 style="color:white;">{{$advices->title}}</h1></div>

                                    </div> <!-- .forecast-header -->

                                            <ul class="arrow-list">
                                                ciaoooone
                                            </ul>

                                    </div>

                                </div>

                            </div>

                            <div class="content col-md-5">

                                        <div class="sidebar col-md-9">
                                            <div class="widget">
                                                        <h3 class="widget-title">{{trans('words.itineraies')}}</h3>
                                                        <ul class="arrow-list">
                                                            @foreach($itinerary as $itineraries)
                                                                <li style="overflow: hidden;
                                           text-overflow: ellipsis;
                                           white-space: nowrap;
                                           width: 150px;"><a href="/mwt_1718/public/single/{{$itineraries->id}}">{{$itineraries->name}}</a></li>
                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                    <div class="widget">
                                                        <h3 class="widget-title">{{trans('words.cateit')}}</h3>
                                                        <ul class="arrow-list">
                                                            @foreach($category as $categories)
                                                                <li style="overflow: hidden;
                                           text-overflow: ellipsis;
                                           white-space: nowrap;
                                           width: 150px;"><a href="/itine/{{$categories->id}}">{{$categories->name}}</a></li>
                                                            @endforeach

                                                        </ul>
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