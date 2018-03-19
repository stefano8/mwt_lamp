@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Assign Itinerary - Category
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{url('admin/itinerary/{itinerary_id}/{category_id}/saveAssign')}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Id</label>
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

                        <label class="col-md-3 control-label" for="difficolty">Assigned category</label>
                        <div class="row">
                            <div class="col-md-4">
                                @foreach ($itinerary->categoryRel as $itineCate)

                                    <input id="category" name="category" type="text" value="{{$itineCate->name}}"
                                           class="form-control" readonly="readonly">

                                    <a href="/admin/itinerary/{{$itinerary->id}}/{{$itineCate->id}}/remove" class="btn btn-danger">Remove</a>

{{--/mwt_1718/public--}}


                                @endforeach
                            </div>

                        </div>
                    </div>


                    <div class="form-group">



                        <label class="col-md-3 control-label" for="difficolty">Change category</label>

                        <div class="col-md-9">


                            @foreach($category as $categories)

                                <label class="checkbox-inline">
                                    <input type="checkbox" class="custom-checkbox" name="category_id" id="category_id" value="{{$categories->id}}">&nbsp;{{$categories->name}}
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