@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Add City
            </h3>

        </div>
        <div class="panel-body">
            <form id="newsForm" class="form-horizontal" action=" {{route('city.save')}} " method="get">
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="City name" class="form-control" required></div>
                    </div>

                    <!-- selectbox per itinerari -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="region_id">Region</label>
                        <div class="col-md-9">
                            <select class="form-control resize_vertical" id="region_id" name="region_id" required>
                                @foreach($region as $regions)
                                    <option value="{{$regions->id}}">{{$regions->name}}</option>
                                @endforeach
                            </select>
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
