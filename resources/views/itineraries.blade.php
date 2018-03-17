@extends('frame')


@section('content')

    <main class="main-content">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span>Live cameras</span>
        </div>
    </div>

    <div class="fullwidth-block">
        <div class="container">
            <div class="filter">
                <div class="country filter-control">
                    <label for="">Country</label>
                    <span class="select control">
									<select name="" id="">
										<option value="">All Countries</option>
									</select>
								</span>
                </div>
                <div class="count filter-control">
                    <label for="">Show per page</label>
                    <span class="select control">
									<select name="" id="">
										<option value="">1</option>
										<option value="">2</option>
										<option value="">3</option>
										<option value="">4</option>
										<option value="">5</option>
										<option value="">6</option>
										<option value="">7</option>
										<option value="">8</option>
										<option value="">9</option>
										<option value="">10</option>
									</select>
								</span>
                </div>
                <div class="quality filter-control">
                    <label for="">Only high quality</label>
                    <span class="select control">
									<select name="" id="">
										<option value="">Yes</option>
										<option value="">No</option>
									</select>
                    </span>
                </div>
            </div>


            <div class="row">
                @foreach($itineraries as $itinerary)

                    <div class="col-md-6">
                        <div class="photo">
                            <div class="photo-preview photo-detail">
                                <img src="{{$image->path}}" alt="foto" style="width: 190px; height: 190px;">
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
        </div>
    </div>

</main> <!-- .main-content -->


@endsection