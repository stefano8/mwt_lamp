@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Update Category
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{route('category.store', $category->id)}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" value="{{$category->name}}" class="form-control"
                                   required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Description</label>
                        <div class="col-md-9">
                            <input class="form-control resize_vertical" id="description" name="description"
                                   value="{{$category->description}}" rows="5">
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


