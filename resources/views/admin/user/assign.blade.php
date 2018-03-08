@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="panel panel-primary" id="hidepanel1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Assign User - Group
            </h3>
        </div>
        <div class="panel-body">
            <form id="itineraryForm" class="form-horizontal" action=" {{route('user.saveAssignment', $user->id)}} "
                  method="get">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" value="{{$user->name}}" class="form-control"
                                   disabled></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="difficolty">Email</label>
                        <div class="col-md-9">
                            <input id="email" name="email" type="text" value="{{$user->email}}"
                                   class="form-control" disabled></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Assign group</label>
                        <div class="col-md-9">
                            @foreach($group as $groups)
                        <label class="checkbox-inline">
                            &nbsp;<input type="checkbox" class="custom-checkbox" value="{{$groups->name}}" >&nbsp;{{$groups->name}}
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


