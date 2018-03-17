@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Update Advice
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{route('advice.store', $advice->id)}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title</label>
                        <div class="col-md-9">
                            <input id="title" name="title" type="text" value="{{$advice->title}}" class="form-control"
                                   required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="body">Body</label>
                        <div class="col-md-9">
                            <input id="body" name="body" type="text" value="{{$advice->body}}"
                                   class="form-control" required></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Description</label>
                        <div class="col-md-9">
                            <input class="form-control resize_vertical" id="description" name="description"
                                   value="{{$advice->description}}" rows="5">
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


