@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Assign Images to Itineraries
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{url('admin/image/assign/{itinerary_id}/saveAssign')}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="id">Id</label>
                     <div class="col-md-9">
                            <input name="itinerary_id" type="text" id="itinerary_id" value="{{$itinerary->id}}" class="form-control" readonly="readonly"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" value="{{$itinerary->name}}" class="form-control"
                                   readonly="readonly"></div>
                    </div>




                    <div class="form-group">

                        <label class="col-md-3 control-label" for="title">Assigned Image</label>
                        <div class="row">
                            <div class="col-md-4">
                                @foreach ($image as $item)

                                    <input id="title" name="title" type="text" value="{{$item->title}}"
                                           class="form-control" readonly="readonly">
                                    <a href="/admin/image/assign/{{$itinerary->id}}/{{$item->id}}/remove" class="btn btn-danger">Remove</a>


                                @endforeach
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="image_id">Change Image</label>
                        <div class="col-md-9">
                        <select name="image[]" id="image" multiple class="form-control">
                            @foreach($photo as $images)
                            <option name="image_id" id="image_id" value="{{$images->id}}">&nbsp;{{$images->title}}</option>
                            @endforeach
                        </select>
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


