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
                <span>Itineraries</span>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">
                <div class="filter">
                <!-- <div class="country filter-control">
                    <label for="">Categories</label>
                    <span class="select control">
                    <select href="" name="" id="" >
                        <option value="all" selected>All</option>
                       {{-- @foreach($category as $categories)
                            <option value="{{$categories->id}}">
                                <a href="/itine/{{$categories->id}}">{{$categories->name}}</a>
                            </option>
                        @endforeach--}}
                        </select>
                        </span>
                    </div>-->

                    <div class="country filter-control">
                        <form action="{{route('search')}}">
                            <input style="background-color: transparent; color: white;" type="text" size="160%"
                                   name="itinerary_name" id="itinerary_name" placeholder="Find itinerary...">
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <!--token che si ha in sessione-->
                            <input type="submit" value="Find">
                        </form>
                    </div>
                </div>


                <div class="row">


                    <div class="sidebar col-md-3">
                        <div class="widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="arrow-list">
                                @foreach($category as $categories)
                                    <li><a href="/mwt_1718/public/itine/{{$categories->id}}">{{$categories->name}}</a>
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

                                        <img src="{{$itinerary->itineraryImage()->first()->path}}" alt="foto"
                                             style="width: 175px; height: 190px;">
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
                <div>{{$itineraries->links()}}</div>
            </div>
        </div>

    </main> <!-- .main-content -->


@endsection