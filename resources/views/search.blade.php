@extends('frame')


@section('content')
    <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="#">Home</a>
                <span>Itineraries Search</span>
            </div>
        </div>

            <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    @foreach($itinerary as $itineraries)
                        <div class="col-md-6">
                            <div class="photo">
                                <div class="photo-preview photo-detail">
                                    <img src="" alt="foto itinerario" style="width: 190px; height: 190px;">
                                </div>
                                <div class="photo-details">
                                    <h3 class="location">
                                        <a href="{{route('itinerary.single', $itineraries->id)}}">{{$itineraries->name}}</a>
                                    </h3>
                                    <p style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis; -o-text-overflow: ellipsis;  ">{{$itineraries->description}}</p>
                                    <div class="star-rating" title="Rated 1 out of 5"><span style="width:60%"><strong class="rating">1</strong> out of 5</span></div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <a style="background-color: #008CBA;" class="btn btn-primary">{{ $itinerary->links() }}</a>
            </div>
        </div>

    </main> <!-- .main-content -->


@endsection