@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    <aside class="right-side">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <!-- Second Data Table -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="panel panel-danger table-edit">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                    <span>
                                    <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff"
                                       data-hc="white"></i>
                                    Itinerari</span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div id="sample_editable_1_wrapper" class="">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                       id="sample_editable_1" role="grid">
                                    <thead class="table_head">
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_editable_1"
                                            rowspan="1" colspan="1">Username
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                            colspan="1" aria-label="
                                                 Full Name
                                            : activate to sort column ascending">Full Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                            colspan="1" aria-label="
                                                 Points
                                            : activate to sort column ascending">Points
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                            colspan="1" aria-label="
                                                 Notes
                                            : activate to sort column ascending">Notes
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                            colspan="1" aria-label="
                                                 Edit
                                            : activate to sort column ascending">Edit
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1"
                                            colspan="1" aria-label="
                                                 Delete
                                            : activate to sort column ascending">Delete
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row" class="odd" data-id="1">
                                        <td class="sorting_1">Tatyana</td>
                                        <td>Tatyana Nilson</td>
                                        <td>1234</td>
                                        <td class="center">power user</td>

                                        <td>
                                        <a class="edit" href="javascript:;">Edit</a>
                                        </td>
                                        <td>
                                            <a class="delete" href="javascript:;">Delete</a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- content -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Item</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="delete_item" data-dismiss="modal">Delete
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Confirm</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are already editing a row, you must save or cancel that row before editing/deleting a new
                            row</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="saveConfirmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Save Row</h4>
                    </div>
                    <div class="modal-body">
                        <p>Updated successfully, Do not forget to do some ajax to sync with backend.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </aside>
@stop