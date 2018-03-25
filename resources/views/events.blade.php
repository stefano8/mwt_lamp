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

        <div class="fullwidth-block" data-bg-color="#262936">
            <div class="container">
                @foreach($event as $events)
                    <div class="col-md-4">
                        <div class="news">
                            <div class="date" style="line-height: 0.5;">{{$events->date}}</div>
                            <h3 style="margin:1px 14px 20px;"><a href="#">{{$events->title}}</a></h3>
                            <p style="margin:1px 14px 20px; display: inline-block; width: 200px; height: 100px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis; -o-text-overflow: ellipsis;">{{$events->body}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

            </div>
            </div>

    </main> <!-- .main-content -->


@endsection