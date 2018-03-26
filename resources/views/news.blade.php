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
                                <h2 class="entry-title"><a href="/news/single/{{$newss->id}}">{{$newss->title}} ({{$newss->date}})</a></h2>
                                <div class="featured-image"><img src="" alt=""></div>
                                <p>{{$newss->body}}</p>
                                <a href="#" class="button">Read more</a>
                        </div>
                        @endforeach

                            <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$news->links('vendor.pagination.semantic-ui')}}</div>

                    </div>
                    <div class="sidebar col-md-3 col-md-offset-1">
                        <div class="widget">
                            <h3 class="widget-title">Top News</h3>
                            <ul class="arrow-list">
                                @foreach($news as $newss)
                                <li><a href="#">{{$newss->title}}</a></li>
                                @endforeach
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Itineraries Categories</h3>
                            <ul class="arrow-list">
                                @foreach($category as $categories)
                                    <li><a href="/mwt_1718/public/itine/{{$categories->id}}">{{$categories->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>

                        <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$news->links('vendor.pagination.semantic-ui')}}</div>

                    </div>
                </div>

            </div>
        </div>
    </main> <!-- .main-content -->

@endsection