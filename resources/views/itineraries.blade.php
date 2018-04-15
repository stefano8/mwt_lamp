@extends('frame')


@section('content')

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="#">Home</a>
                <span>{{trans('words.itineraies')}}</span>
            </div>
        </div>

        <div style="height: 60%; width:100%; margin-top: 20px;" class="hero" data-bg-image="{!! asset('images/banner.jpg') !!}">
            <div class="boxtesto" style="margin-left: 1100px; margin-right: 1px;">
                <h1><span class="testo" style="color: black; margin-left: 80px;">La meta è partire </span>

                    <span style="color: black; margin-left: 55px;"> <i>Giuseppe Ungaretti</i></span>
                </h1>
            </div>

        </div>

        <div class="fullwidth-block">
            <div class="container">
                <div class="filter">


                    <div class="country filter-control">
                        <form action="{{route('search')}}">
                            <input style="background-color: transparent; color: white;" type="text" size="170%"
                                   name="itinerary_name" id="itinerary_name" placeholder="{{trans('words.finditineraries')}}">
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <!--token che si ha in sessione-->
                            <input type="submit" value="{{trans('words.find')}}">
                        </form>
                    </div>
                </div>


                <div class="row">


                    <div class="sidebar col-md-3">
                        <div class="widget">
                            <h3 class="widget-title">{{trans('words.categories')}}</h3>
                            <ul class="arrow-list">
                                @foreach($category as $categories)
                                    <li><a href="/itine/{{$categories->id}}">{{$categories->name}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                    </div>

                    <div class="content col-md-8">

                        @foreach($itineraries as $itinerary)

                            <div class="col-md-6">

                                <div class="photo">

                                    <div class="photo-preview photo-detail">
                                        @if(!isset($itinerary->itineraryImage()->first()->path))
                                            <img style="width: 175px; height: 190px;" src="/images/montain.jpg">
                                        @else


                                      <a href="{{route('itinerary.single', $itinerary->id)}}"><img src="{{$itinerary->itineraryImage()->first()->path}}" alt="foto"
                                                        style="width: 175px; height: 190px;"></a>


                                        @endif
                                    </div>


                                    <div class="photo-details">
                                        <h3 class="location">
                                            <a href="{{route('itinerary.single', $itinerary->id)}}">{{$itinerary->name}}</a>
                                        </h3>
                                        <p style="display: inline-block; width: 100px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis; -o-text-overflow: ellipsis;  ">{{$itinerary->description}}</p>
                                        <div class="star-rating" title="Rated 1 out of 5">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                </div>
                <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$itineraries->links('vendor.pagination.semantic-ui')}}</div>
            </div>
        </div>

    </main> <!-- .main-content -->


@endsection