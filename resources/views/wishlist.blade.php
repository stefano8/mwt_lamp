@extends('frame')


@section('content')

    <main class="main-content">
    <div class="container">
        <div class="breadcrumb">
            <a href="">Home</a>
            <span>Wishlist</span>
        </div>
    </div>

    <div class="fullwidth-block">
        <div class="container">
            <div class="row">
                @foreach($itineraries as $itinerary)
                <div class="col-md-3 col-sm-6">
                    <div class="live-camera">
                        <figure class="live-camera-cover">
                            <img src="{{$image->path}}" alt="foto" style="width: 190px; height: 190px;">
                        </figure>
                        <h3 class="location">
                            <a href="{{route('itinerary.single', $itinerary->id)}}">{{$itinerary->name}}</a>
                        </h3>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

</main> <!-- .main-content -->

@endsection