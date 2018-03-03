@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="panel panel-primary" id="hidepanel1">
<div class="panel-heading">
    <h3 class="panel-title">
        <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
        Add Itinerary
    </h3>

</div>
<div class="panel-body">
    <form class="form-horizontal" action=" {{route('itinerary.save')}} " method="get">
        <fieldset>

            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Name</label>
                <div class="col-md-9">
                    <input id="name" name="name" type="text" placeholder="Itinary name" class="form-control"></div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="difficolty">Difficolty</label>
                <div class="col-md-9">
                    <input id="difficolty" name="difficolty" type="text" placeholder="Difficolty" class="form-control"></div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="difference">Difference</label>
                <div class="col-md-9">
                    <input id="difference" name="difference" type="text" placeholder="Difference" class="form-control"></div>
            </div>
            <!-- description body
            <div class="form-group">
                <label class="col-md-3 control-label" for="message">Description</label>
                <div class="col-md-9">
                    <textarea class="form-control resize_vertical" id="description" name="description" placeholder="Please enter your message here..." rows="5"></textarea>
                </div>
            </div>
            -->

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