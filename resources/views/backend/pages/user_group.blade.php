@extends('backend.layouts.default')
@section('content')

        <!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        {{--<div class="note note-info">--}}
            {{--<p> NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only. </p>--}}
        {{--</div>--}}
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-users font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">{{ getMenuName($data,50,1) }}</span>
                </div>
                <div class="actions">
                    {{--<div class="btn-group btn-group-devided" data-toggle="buttons">--}}
                            <a class="btn btn-circle green btn-outline" href="{{ action('UserGroupController@getAddUserGroup') }}" target="_blank">สร้างกลุ่มผู้ใช้</a>
                        {{--<label class="btn btn-transparent blue btn-outline btn-circle btn-sm">--}}
                            {{--<input type="radio" name="options" class="toggle" id="option2">Settings</label>--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">--}}
                            {{--<i class="fa fa-share"></i>--}}
                            {{--<span class="hidden-xs"> Tools </span>--}}
                            {{--<i class="fa fa-angle-down"></i>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu pull-right">--}}
                            {{--<li>--}}
                                {{--<a href="javascript:;"> Export to Excel </a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="javascript:;"> Export to CSV </a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="javascript:;"> Export to XML </a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"> </li>--}}
                            {{--<li>--}}
                                {{--<a href="javascript:;"> Print Invoices </a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="delete">ลบ</option>
                        </select>
                        <button class="btn btn-sm btn-default table-group-action-submit">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_user_groups">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="2%">
                                <input type="checkbox" class="group-checkable"> </th>
                            <th width="20%">รหัสกลุ่มผู้ใช้&nbsp;# </th>
                            <th width="60%">ชื่อกลุ่มผู้ใช้</th>
                            <th width="20%"> Actions </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td> </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="user_group_id" id="user_group_id"> </td>

                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="user_group_name" id="user_group_name"> </td>

                            <td>
                                <div class="margin-bottom-5">
                                    <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                        <i class="fa fa-search"></i> Search</button>
                                </div>
                                <button class="btn btn-sm btn-default filter-cancel">
                                    <i class="fa fa-times"></i> Reset</button>
                            </td>
                        </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->

<!-- /.modal -->
<div class="modal fade bs-modal-sm" id="deleteUserGroup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ยืนยันการลบกลุ่มผู้ใช้</h4>
            </div>
            <div class="modal-body">คุณต้องการลบข้อมูลกลุ่มผู้ใช้ ?.
                <input type="hidden" name="userGroupId" id="userGroupId">
                <input type="hidden" name="deleteStatus" id="deleteStatus">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="btnDeleteUserGroup" class="btn red">ลบ</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@stop