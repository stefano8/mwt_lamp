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
                            Reviews ({{ $review->total() }}  total reviews)
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
                                    <th>Flag Approved</th>
                                    <th>User ID</th>

                                    <th>Approve</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($review as $reviews )
                                    <tr role="row" class="odd" data-id="1">
                                        <td>{{ $reviews->id }}</td>
                                        <td>{{ $reviews->date }}</td>
                                        <td>{{ $reviews->title }}</td>
                                        <td>{{ $reviews->body }}</td>
                                        <td>{{ $reviews->approved }}</td>
                                        <td>{{ $reviews->user_id}}</td>

                                        @if($reviews->approved == 0)
                                        <td>
                                            <a href="{{$reviews->id}}/approve" class="btn btn-success">Approve</a>
                                        </td>
                                        @else
                                            <td>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{$reviews->id}}/delete" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $review->links() }}
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
        </section>
    </aside>

@stop
