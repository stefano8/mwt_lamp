@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>News</span>
            </div>
        </div>

        <div style="height: 60%; width:100%; margin-top: -7px;" class="hero" data-bg-image="{!! asset('images/newsingle.jpg') !!}">
            <div class="boxtesto" style=" margin-left: 1100px; margin-right: 1px;">
                <h1 style="margin-top: -67px;">
                    <span class="testo" style="color: black; margin-left: 109px;">Chi più alto sale,</span>
                    <span style="color: black; margin-left: 103px;"><br> più lontano vede; <br></span>
                    <span style="color: black; margin-left: 65px;"> chi più lontano vede, <br></span>
                    <span style="color: black; margin-left: 95px;"> più a lungo sogna <br></span>
                    <span style="color: black; margin-left: 131px;"> <i>Walter Bonatti</i></span>

                </h1>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">
                            <div class="post">
                                <h1 class="entry-title">{{$news->title}} ({{$news->date}})</h1>
                                @foreach($image as $images)
                                    @if($images->title == 'news')
                                        <div class="featured-image"><img src="{{$images->path}}" alt=""></div>
                                    @endif
                                @endforeach
                                <div class="featured-image"><img src="" alt=""></div>
                                <h4><p>{{$news->body}}</p></h4>


                                <div class="col-md-9" id="social-links">
                                    <div class="social-links" style="font-size: 200%;">Condividi:
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://montaintrack.it" class="btn btn-facebook btn-lg" id=""><span class="fa fa-facebook"></span></a>
                                        <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-twitter"></span></a>
                                        <a href="https://plus.google.com/share?url=http://montaintrack.it" class="social-button " id=""><span class="fa fa-google-plus"></span></a>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://montaintrack.it&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><span class="fa fa-linkedin"></span></a>
                                    </div>
                                </div>


                            </div>
                    </div>
                    <div class="sidebar col-md-3 col-md-offset-1">
                    <div class="widget">
                        <h3 class="widget-title">{{trans('words.topitineraries')}}</h3>
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
    </main> <!-- .main-content -->

@endsection