@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>Advices</span>
            </div>
        </div>


        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">
                        <div class="post">
                            <div class="photo-preview photo-detail">

                                <img style="width: 7%; height: auto;" src="{!! asset('images/check.png') !!}">

                            </div>
                            <h2 class="entry-title">{{$advices->title}}</h2>
                            <div class="featured-image"><img src="" alt=""></div>
                            <h3>{{$advices->body}}</h3>


                            <blockquote>
                                <h4>{{$advices->description}}</h4>
                            </blockquote>
                        </div>

                        <div class="col-md-9" id="social-links">
                            <div class="social-links" style="font-size: 200%;">Condividi:
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http://montaintrack.it" class="btn btn-facebook btn-lg" id=""><span class="fa fa-facebook"></span></a>
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-twitter"></span></a>
                                <a href="https://plus.google.com/share?url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-google-plus"></span></a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://montaintrack.it&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="fa fa-linkedin"></span></a>
                            </div>
                        </div>

                    </div>


                    <div class="sidebar col-md-3 col-md-offset-1">
                        <div class="widget">
                            <h3 class="widget-title">{{trans('words.itineraies')}}</h3>
                            <ul class="arrow-list">
                                @foreach($itinerary as $itineraries)
                                    <li><a href="/mwt_1718/public/single/{{$itineraries->id}}">{{$itineraries->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">{{trans('words.cateit')}}</h3>
                            <ul class="arrow-list">
                                @foreach($category as $categories)
                                    <li><a href="/itine/{{$categories->id}}">{{$categories->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </main> <!-- .main-content -->

@endsection