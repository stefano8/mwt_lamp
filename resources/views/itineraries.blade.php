@extends('frame')


@section('content')

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
                <div class="country filter-control">
                    <label for="">Categories</label>
                    <span class="select control">
                    <select href="" name="" id="" >
                        @foreach($category as $categories)
                            <option  value="{{$categories->id}}">
                                <a href="{{route('filtercategory', $categories->id)}}">{{$categories->name}}</a>
                            </option>
                        @endforeach
                    </select>
					</span>
                </div>

                <div class="country filter-control">
                    <form action="{{route('search')}}" class="">
                        <input style="background-color: transparent; " type="text" size="122%" name="itinerary_name" id="itinerary_name" placeholder="Find itinerary...">
                        <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->
                        <input type="submit" value="Find">
                    </form>
                </div>
            </div>


            <div class="row">
                @foreach($itineraries as $itinerary)

                    <div class="col-md-6">
                        <div class="photo">

                            <div class="photo-preview photo-detail">
                                <img src="{{$itinerary->itineraryImage()->first()->path}}" alt="foto" style="width: 190px; height: 190px;">{{$itinerary->itineraryImage()->first()->path}}
                            </div>

                            <div class="photo-details">
                                <h3 class="location">
                                    <a href="{{route('itinerary.single', $itinerary->id)}}">{{$itinerary->name}}</a>
                                </h3>
                                <p style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis; -o-text-overflow: ellipsis;  ">{{$itinerary->description}}</p>
                                <div class="star-rating" title="Rated 1 out of 5"><span style="width:60%"><strong class="rating">1</strong> out of 5</span></div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <a style="background-color: #008CBA;" class="btn btn-primary">{{ $itineraries->links() }}</a>
        </div>
    </div>

</main> <!-- .main-content -->


@endsection