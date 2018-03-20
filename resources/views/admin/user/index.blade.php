@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <aside class="right-side">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Users ({{ $user->total() }}  total users)
                        </h3>

                    </div>
                    <div class="panel-body">
                        <div id="sample_editable_1_wrapper" class="">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="sample_editable_1" role="grid">
                                <thead class="table_head">
                                <tr role="row">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>email</th>

                                    <th>Assign Group</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($user as $users )
                                    <tr role="row" class="odd" data-id="1">
                                        <td>{{ $users->id }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email}}</td>
                                        @if(Auth::check() && Auth::user()->id == $users->id)
                                            <td>

                                            </td>
                                        @else

                                            <td>
                                                <a href="{{$users->id}}/assign" class="btn btn-success">Assign</a>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{$users->id}}/edit"  class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>

                                            <a href="{{$users->id}}/delete" class="btn btn-danger ">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $user->links() }}
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
        </section>
    </aside>

@stop





