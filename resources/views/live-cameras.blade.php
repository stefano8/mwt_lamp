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
                @foreach($itineraries as $itinerario)
                <div class="col-md-3 col-sm-6">
                    <div class="live-camera">
                        <figure class="live-camera-cover"><img src="images/live-camera-1.jpg" alt=""></figure>
                        <h3 class="location"><a href="{{route('itinerary.single', $itinerario->id)}}">{{$itinerario->name}}</a></h3>
                        <small class="date">8 oct, 8:00AM</small>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

</main> <!-- .main-content -->


@endsection