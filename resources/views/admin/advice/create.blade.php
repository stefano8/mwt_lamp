@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Add Advice
            </h3>

        </div>
        <div class="panel-body">
            <form id="eventForm" class="form-horizontal" action=" {{route('advice.save')}} " method="get">
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title</label>
                        <div class="col-md-9">
                            <input id="title" name="title" type="text" placeholder="Advice title" class="form-control" required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="body">Body</label>
                        <div class="col-md-9">
                            <textarea class="form-control resize_vertical" id="body" name="body" placeholder="Please enter your message here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="description">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control resize_vertical" id="description" name="description" placeholder="Please enter your message here..." rows="5"></textarea>
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
