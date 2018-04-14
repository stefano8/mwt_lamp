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

                <div class="fullwidth-block" data-bg-color="#262936">
                    <div class="container">

                            <div class="col-md-12">
                                @foreach($advices as $advice)
                                <div class="news">
                                    <div class="date" style="background-color: #00a7d0; color: white; border-radius: 15px;">MT</div>
                                    <h3><a href="/advices/single/{{$advice->id}}">{{$advice->title}}</a></h3>
                                    <p>{{$advice->body}}</p>
                                </div>
                                @endforeach
                            </div>


                    </div>

                <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$advices->links('vendor.pagination.semantic-ui')}}</div>
            </div>

            </div>

        </div>

    </main> <!-- .main-content -->


@endsection