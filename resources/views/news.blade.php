@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>News</span>
            </div>
        </div>


        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">
                        @foreach($news as $newss)
                        <div class="post">
                            <div class="photo-preview photo-detail">

                                <img style="width: 25%; height: auto;" src="{!! asset('images/news1.png') !!}">

                            </div>
                                <h2 class="entry-title"><a href="/news/single/{{$newss->id}}">{{$newss->title}} ({{$newss->date}})</a></h2>


                                <p class="trunc">{{$newss->body}}</p>
                            <a href="/news/single/{{$newss->id}}" class="button">{{trans('words.readmore')}}</a>
                        </div>
                        @endforeach

                            <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$news->links('vendor.pagination.semantic-ui')}}</div>

                    </div>
                    <div class="sidebar col-md-3 col-md-offset-1">
                        <div class="widget">
                            <h3 class="widget-title">Top News</h3>
                            <ul class="arrow-list">
                                @foreach($topnews as $tnewss)
                                <li style="overflow: hidden;
                                           text-overflow: ellipsis;
                                           white-space: nowrap;
                                           width: 150px;"><a href="/news/single/{{$tnewss->id}}">{{$tnewss->title}}</a></li>
                                @endforeach
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">{{trans('words.itineraies')}}</h3>
                            <ul class="arrow-list">
                                @foreach($itinerary as $itineraries)
                                    <li style="overflow: hidden;
                                           text-overflow: ellipsis;
                                           white-space: nowrap;
                                           width: 150px;"><a href="/single/{{$itineraries->id}}">{{$itineraries->name}}</a></li>
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