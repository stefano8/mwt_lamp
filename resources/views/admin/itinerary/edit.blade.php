@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Update Itinerary
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{route('itinerary.store', $itinerary->id)}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" value="{{$itinerary->name}}" class="form-control"
                                   required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="difficolty">Difficolty</label>
                        <div class="col-md-9">
                            <input id="difficolty" name="difficolty" type="text" value="{{$itinerary->difficolty}}"
                                   class="form-control" required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="difference">Difference</label>
                        <div class="col-md-9">
                            <input id="difference" name="difference" type="text" value="{{$itinerary->difference}}"
                                   class="form-control" required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="duration">Duration</label>
                        <div class="col-md-9">
                            <input id="duration" name="duration" type="text" value="{{$itinerary->duration}}"
                                   class="form-control" required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Latitude</label>
                        <div class="col-md-9">
                            <input class="form-control resize_vertical" id="latitude" name="latitude"
                                   value="{{$itinerary->latitude}}" rows="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Longitude</label>
                        <div class="col-md-9">
                            <input class="form-control resize_vertical" id="longitude" name="longitude"
                                   value="{{$itinerary->longitude}}" rows="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Description</label>
                        <div class="col-md-9">
                            <input class="form-control resize_vertical" id="description" name="description"
                                   value="{{$itinerary->description}}" rows="5">
                        </div>
                    </div>


                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-responsive btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection


