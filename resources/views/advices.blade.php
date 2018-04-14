@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>{{trans('words.advices')}}</span>
            </div>
        </div>


        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">
                        @foreach($advices as $advice)
                            <div class="post">
                                <div class="photo-preview photo-detail">

                                        <img style="width: 7%; height: auto;" src="{!! asset('images/check.png') !!}">

                                </div>
                                <h2 class="entry-title"><a href="/mwt_1718/public/advices/single/{{$advice->id}}">{{$advice->title}}</a></h2>


                                <p class="trunc">{{$advice->body}}</p>
                                <a href="/mwt_1718/public/advices/single/{{$advice->id}}" class="button">{{trans('words.readmore')}}</a>
                            </div>
                        @endforeach

                        <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$advices->links('vendor.pagination.semantic-ui')}}</div>

                    </div>

                    <div class="sidebar col-md-3 col-md-offset-1">
                        <div class="widget">
                            <h3 class="widget-title">Top News</h3>
                            <ul class="arrow-list">
                                @foreach($topnews as $tnewss)
                                    <li><a href="/mwt_1718/public/news/single/{{$tnewss->id}}">{{$tnewss->title}}</a></li>
                            @endforeach
                        </div>

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