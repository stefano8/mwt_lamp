@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>{{trans('words.events')}}</span>
            </div>
        </div>

        <div style="height: 60%; width:100%; margin-top: 20px;" class="hero" data-bg-image="{!! asset('images/eventi3.jpg') !!}">
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

                <h1 style="text-align: center; font-size: 50px;">Eventi</h1>

                @foreach($event as $events)
                    <div class="row">
                    <div class="col-md-12 post">

                            <div class="col-md-3 photo-preview photo-detail">
                                <h1 style="margin:1px 22px 20px; color: #c8b7a5; padding-top: 50px;">{{$events->date}}</h1>

                                @if(!isset($events->eventImage()->first()->path))
                                    <img style="width: 195px; height: 190px;" src="{!! asset('images/calendar.png') !!}">
                                @else


                                    <a href="{{route('event.single', $events->id)}}"><img src="{{$events->eventImage()->first()->path}}" alt="foto"
                                                                                                 style="width: 175px; height: 190px;"></a>

                                @endif
                            </div>
                            <div clas="col-md-4">
                       <!-- <a  style="" href="{{route('event.single', $events->id)}}">-->
                            <h1 style="margin:1px 22px 20px; color: #c8b7a5; padding-top: 50px; overflow: hidden; white-space: nowrap; width: 500px;">{{$events->title}}</h1>
                            <p style="margin:1px 22px 20px;overflow: hidden; padding-top: 2px; font-size: 18px; width: 600px;">{{$events->description}}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
                    </div>


            </div>

    </main> <!-- .main-content -->


@endsection