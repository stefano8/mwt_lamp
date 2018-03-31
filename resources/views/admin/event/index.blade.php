@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <div class="container">
        @include('flash::message')
    </div>


    <aside class="right-side">
        <div>
            <a href="{{route('event.create')}}" type="submit" class="btn btn-primary"
               style="float: right; width: 100px; margin-bottom: 10px;">
                Add
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="panel panel-primary" id="hidepanel1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Events ({{ $event->total() }}  total events)
                        </h3>

                    </div>
                    <div class="panel-body">
                        <div id="sample_editable_1_wrapper" class="">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="sample_editable_1" role="grid">
                                <thead class="table_head">
                                <tr role="row">
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Address</th>
                                    <th>Description</th>
                                    <th>Itinerary ID</th>


                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($event as $events )
                                    <tr role="row" class="odd" data-id="1">
                                        <td>{{ $events->id }}</td>
                                        <td>{{ $events->date }}</td>
                                        <td>{{ $events->title }}</td>
                                        <td>{{ $events->body }}</td>
                                        <td>{{ $events->address }}</td>
                                        <td>{{ $events->description}}</td>
                                        <td>{{ $events->itinerary_id}}</td>

                                        <td>
                                            <a href="{{$events->id}}/edit" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{route('event.delete', $events->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $event->links() }}
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
        </section>
    </aside>

@stop
