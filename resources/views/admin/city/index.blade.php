@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    <input type="hidden" name="_token" id="_token"  value="{{csrf_token()}}"> <!--token che si ha in sessione-->

    <aside class="right-side">
        <div>
            <a href="{{route('city.create')}}" type="submit" class="btn btn-primary"
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
                            Cities ({{ $city->total() }}  total cities)
                        </h3>

                    </div>
                    <div class="panel-body">
                        <div id="sample_editable_1_wrapper" class="">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="sample_editable_1" role="grid">
                                <thead class="table_head">
                                <tr role="row">
                                    <th>Id</th>
                                    <th>name</th>
                                    <th>Region ID</th>


                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($city as $cities )
                                    <tr role="row" class="odd" data-id="1">
                                        <td>{{ $cities->id }}</td>
                                        <td>{{ $cities->name }}</td>
                                        <td>{{ $cities->region_id}}</td>

                                        <td>
                                            <a href="{{$cities->id}}/edit" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{route('city.delete', $cities->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $city->links() }}
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
        </section>
    </aside>

@stop
