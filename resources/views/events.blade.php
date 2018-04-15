@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>{{trans('words.events')}}</span>
            </div>
        </div>

        <div style="height: 60%; width:100%; margin-top: -7px;" class="hero" data-bg-image="{!! asset('images/eventi3.jpg') !!}">
            <div class="boxtesto" style=" margin-left: 1100px; margin-right: 1px;">
                <h1 style="margin-top: -67px;">
                    <span class="testo" style="color: black; margin-left: -149px;">Quando uomini e montagne si incontrano,</span>
                    <span style="color: black; margin-left: 63px;"><br> grandi cose accadono <br></span>
                    <span style="color: black; margin-left: 150px;"> <i>William Blake</i></span>

                </h1>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">

        <div class="fullwidth-block" data-bg-color="#262936">
            <div class="container">


                @foreach($event as $events)

                    <div class="col-md-4">



                            <div class="photo-preview photo-detail">
                                <h1 style="margin:1px 14px 20px; color: #c8b7a5">{{$events->date}}</h1>

                                @if(!isset($events->eventImage()->first()->path))
                                    <img style="width: 175px; height: 190px;" src="/images/calendar.jpg">
                                @else


                                    <a href="{{route('event.single', $events->id)}}"><img src="{{$events->eventImage()->first()->path}}" alt="foto"
                                                                                                 style="width: 175px; height: 190px;"></a>

                                @endif
                            </div>
                        <a style="" href="{{route('event.single', $events->id)}}">
                            <h3 style="margin:1px 14px 20px; overflow: hidden;
                                        text-overflow: ellipsis;
                                        white-space: nowrap;
                                        width: 150px;">{{$events->title}}</h3></a>

                    </div>
                @endforeach
            </div>
        </div>
                    </div>


            </div>

    </main> <!-- .main-content -->


@endsection