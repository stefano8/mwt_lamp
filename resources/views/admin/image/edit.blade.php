@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Update Image
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" enctype="multipart/form-data" class="form-horizontal" method="POST" action=" {{route('image.store', $image->id)}}">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title</label>
                        <div class="col-md-9">
                            <input id="title" name="title" type="text" value="{{$image->title}}" class="form-control"
                                   required></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="path">Path</label>
                        <div class="col-md-9">
                            <input id="path" name="path" type="text" value="{{$image->path}}"
                                   class="form-control" readonly></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="photo">Photo</label>
                        <div class="col-md-9">
                            <input type="file" name="image"/>
                        </div>
                    </div>

                    @if(isset($image->path))
                        <div class="form-group">
                            <div class="col-md-3"> </div>
                        <div class="col-md-9">
                            <img style="height: 150px; width: 150px;" src="{{$image->path}}">
                        </div>

                        </div>

                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>

                    @endif


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


