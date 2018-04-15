@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>{{trans('words.advices')}}</span>
            </div>
        </div>

        <div style="height: 90%; width:100%; margin-top: 20px;" class="hero" data-bg-image="{!! asset('/images/marmolada2.jpg') !!}">
            <div class="boxtesto" style="margin-left: 550px; margin-right: 1px;">
                <h1><span class="testo" style="color: black;">La montagna se praticata in un certo modo è una scuola indubbiamente dura,</span>
                    <span style="color: black; margin-left: 595px;"><br> a volte anche crudele,</span>
                    <span style="color: black; margin-left: 249px;"> <br> però sincera come non accade sempre nel quotidiano.<br></span>
                     <span style="color: black; margin-left: 670px;">   <i>Walter Bonatti</i></span>
                </h1>
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
                                <h2 class="entry-title"><a href="/advices/single/{{$advice->id}}">{{$advice->title}}</a></h2>


                                <p class="trunc">{{$advice->body}}</p>
                                <a href="/advices/single/{{$advice->id}}" class="button">{{trans('words.readmore')}}</a>
                            </div>
                        @endforeach

                        <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$advices->links('vendor.pagination.semantic-ui')}}</div>

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