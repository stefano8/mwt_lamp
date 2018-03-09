@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <aside class="right-side">
        <div>
            <a href="{{route('itinerary.create')}}" type="submit" class="btn btn-primary"
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
                            Itineraries
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
                                    <th>Difficolty</th>
                                    <th>Difference</th>
                                    <th>Description</th>

                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($itinerary as $itineraries )
                                    <tr role="row" class="odd" data-id="1">
                                        <td>{{ $itineraries->id }}</td>
                                        <td>{{ $itineraries->name }}</td>
                                        <td>{{ $itineraries->difficolty}}</td>
                                        <td>{{ $itineraries->difference }}</td>
                                        <td>{{ $itineraries->description }}</td>
                                        <td>
                                            <a href="{{$itineraries->id}}/edit" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{$itineraries->id}}/delete" class="btn btn-danger"
                                               onclick="javascript:confirm('Sei sicuro di voler eliminare questo elemento?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
        </section>
    </aside>

@stop
