@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Assign Images - Itineraries
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{url('admin/image/assign/{itinerary_id}/saveAssignmentItinerary')}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="id">Id</label>
                        <div class="col-md-9">
                            <input name="id" type="text" id="id" value="{{$itinerary->id}}" class="form-control" readonly="readonly"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" value="{{$itinerary->name}}" class="form-control"
                                   readonly="readonly"></div>
                    </div>




                    <div class="form-group">

                        <label class="col-md-3 control-label" for="difficolty">Assigned Image</label>
                        <div class="row">
                            <div class="col-md-4">
                                @foreach ($itinerary as $item)

                                    <input id="title" name="title" type="text" value="{{$item->title}}"
                                           class="form-control" readonly="readonly">

                                    <a href="{{url('admin/image/assign/{itinerary_id}/removeAssignmentItinerary')}}" class="btn btn-danger">Remove</a>


                                @endforeach
                            </div>

                        </div>
                    </div>


                    <div class="form-group">



                        <label class="col-md-3 control-label" for="difficolty">Change Image</label>

                        <div class="col-md-9">

                            @foreach($image as $images)

                                <label class="checkbox-inline">
                                    <input type="checkbox" class="custom-checkbox" name="group_id" id="group_id" value="{{$images->id}}">&nbsp;{{$images->title}}
                                </label>

                            @endforeach



                        </div>

                    </div>




                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-responsive btn-primary btn-sm">Assign</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection


