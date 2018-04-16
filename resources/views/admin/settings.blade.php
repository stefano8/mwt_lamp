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
                            My Profile
                        </h3>

                    </div>
                    <div class="tab-content mar-top">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                User Profile
                                            </h3>
                                        </div>
                                        <div class="panel-body">

                                            <div class="col-md-8">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" id="users">
                                                            <tr>
                                                                <td>User Name</td>
                                                                <td>
                                                                    <a href="#" data-pk="1" class="editable" data-title="Edit User Name">{{$user->name}}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>E-mail</td>
                                                                <td>
                                                                    <a href="#" data-pk="1" class="editable" data-title="Edit E-mail">{{$user->email}}</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </section>
    </aside>

@stop
