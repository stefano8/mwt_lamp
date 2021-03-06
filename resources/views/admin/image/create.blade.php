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
            <form id="imageForm" enctype="multipart/form-data" method="POST" class="form-horizontal" action=" {{route('image.save')}} ">
                {{ csrf_field() }}
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title</label>
                        <div class="col-md-9">
                            <input id="title" name="title" type="text" placeholder="Title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="path">Path</label>
                        <div class="col-md-9">
                            <input id="path" name="path" type="text" placeholder="/mwt_1718/public/images/" class="form-control" readonly>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="photo">Photo</label>
                        <div class="col-md-9">
                            <input type="file" name="image"/>
                        </div>
                    </div>

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
