@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>Events</span>
            </div>
        </div>


        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">
                        <div class="post">
                            <h2 class="entry-title">{{$event->title}} ({{$event->date}})</h2>
                            <div class="featured-image"><img src="" alt=""></div>
                            <p>{{$event->body}}</p>
                            <a href="#" class="button">Read more</a>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </main> <!-- .main-content -->

@endsection