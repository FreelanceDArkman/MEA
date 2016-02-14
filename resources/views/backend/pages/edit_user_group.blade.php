@extends('backend.layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{--<div class="m-heading-1 border-green m-bordered">--}}
            {{--<h3>Twitter Bootstrap Wizard Plugin</h3>--}}
            {{--<p> This twitter bootstrap plugin builds a wizard out of a formatter tabbable structure. It allows to build a wizard functionality using buttons to go through the different wizard steps and using events allows to hook into--}}
            {{--each step individually. </p>--}}
            {{--<p> For more info please check out--}}
            {{--<a class="btn red btn-outline" href="http://vadimg.com/twitter-bootstrap-wizard-example" target="_blank">the official documentation</a>--}}
            {{--</p>--}}
            {{--</div>--}}
            <div class="portlet light bordered" id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red bold uppercase">แก้ไขข้อมูลกลุ่มผู้ใช้</span>
                    </div>
                    {{--<div class="actions">--}}
                    {{--<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">--}}
                    {{--<i class="icon-cloud-upload"></i>--}}
                    {{--</a>--}}
                    {{--<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">--}}
                    {{--<i class="icon-wrench"></i>--}}
                    {{--</a>--}}
                    {{--<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">--}}
                    {{--<i class="icon-trash"></i>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" action="{{ action('UserGroupController@postEditUserGroup') }}" id="submit_form" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="UserGroupId" value="{{ $user_group->USER_PRIVILEGE_ID }}">
                        <div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li>
                                        <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> รายละเอียดกลุ่มผู้ใช้ </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> กําหนดสิทธิ์ในการเข้าถึงเมนู </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab" class="step">
                                            <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> ตรวจสอบความถูกต้อง </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="bar" class="progress progress-striped" role="progressbar">
                                    <div class="progress-bar progress-bar-success"> </div>
                                </div>
                                <div class="tab-content">

                                    @if($errors->has())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger display-block">
                                                <button class="close" data-dismiss="alert"></button>{{ $error }}
                                            </div>
                                        @endforeach
                                    @endif

                                    @if(session('submit_success'))
                                            <div class="alert alert-success display-block">
                                                <button class="close" data-dismiss="alert"></button> {{ session('submit_success') }} </div>
                                    @endif
                                    @if(session('submit_errors'))
                                        <div class="alert alert-danger display-block">
                                            <button class="close" data-dismiss="alert"></button>{{ session('submit_errors') }}</div>
                                    @endif

                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button> กรุณากรอกข้อมูลด้านล่างให้ครบถ้วน </div>
                                    <div class="alert alert-success display-none">
                                        <button class="close" data-dismiss="alert"></button> การเพิ่มกลุ่มผู้ใช้สำเร็จแล้ว </div>
                                    <div class="tab-pane active" id="tab1">
                                        <h3 class="block">กรุณากรอกรายละเอียดกลุ่มผู้ใช้</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">รหัสกลุ่มผู้ใช้
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" readonly class="form-control" value="{{ $user_group->USER_PRIVILEGE_ID }}" id="USER_PRIVILEGE_ID" name="USER_PRIVILEGE_ID" />
                                                {{--<span class="help-block">รหัสกลุ่มผู้ใช้ต้องเป็นรูปแบบตัวเลขเท่านั้น และห้ามซ้ำกับข้อมูลในระบบ</span>--}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อกลุ่มผู้ใช้
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="{{ $user_group->USER_PRIVILEGE_DESC }}" name="user_group_name" id="user_group_name" />
                                                <span class="help-block">ชื่อรหัสกลุ่มผู้ใช้เช่น Admin, User</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <h3 class="block">สิทธิ์การใช้งาน</h3>
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-social-dribbble font-blue-sharp"></i>
                                                    <span class="caption-subject font-blue-sharp bold uppercase">เมนูระดับผู้ใช้</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div id="tree_1" class="tree-demo">
                                                    @if(isset($menu_frontend_list))
                                                        <ul>
                                                            @foreach($menu_frontend_list as $menu)
                                                                    <li data-jstree='{ "opened" : true }'>
                                                                        {{$menu['MENU_GROUP_NAME']}}
                                                                        @if($menu['item'])
                                                                            <ul>
                                                                                @foreach($menu['item'] as $sub_menu)
                                                                                    @if($sub_menu['MENU_SELECTED'] == 1)
                                                                                        <li data-jstree='{ "selected" : true }' data-menu-item="{{$menu['MENU_GROUP_ID']}}:{{$sub_menu['MENU_ID']}}">
                                                                                    @else
                                                                                        <li data-menu-item="{{$menu['MENU_GROUP_ID']}}:{{$sub_menu['MENU_ID']}}">
                                                                                            @endif
                                                                                            <a href="javascript:;">{{$sub_menu['MENU_NAME']}}</a>
                                                                                        @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                    @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-social-dribbble font-blue-sharp"></i>
                                                    <span class="caption-subject font-blue-sharp bold uppercase">เมนูระดับผู้ดูแลระบบ</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div id="tree_2" class="tree-demo">
                                                    @if(isset($menu_backend_list))
                                                        <ul>
                                                            @foreach($menu_backend_list as $menu)
                                                                    <li data-jstree='{ "opened" : true }'>
                                                                        {{$menu['MENU_GROUP_NAME']}}
                                                                        @if($menu['item'])
                                                                            <ul>
                                                                                @foreach($menu['item'] as $sub_menu)
                                                                                    @if($sub_menu['MENU_SELECTED'] == 1)
                                                                                        <li data-jstree='{ "selected" : true }' data-menu-item="{{$menu['MENU_GROUP_ID']}}:{{$sub_menu['MENU_ID']}}">
                                                                                    @else
                                                                                        <li data-menu-item="{{$menu['MENU_GROUP_ID']}}:{{$sub_menu['MENU_ID']}}">
                                                                                            @endif
                                                                                            <a href="javascript:;">{{$sub_menu['MENU_NAME']}}</a>
                                                                                        @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                    @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <h3 class="block">ยืนยันข้อมูลกลุ่มผู้ใช้</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">รหัสกลุ่มผู้ใช้:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="USER_PRIVILEGE_ID"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อกลุ่มผู้ใช้:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="user_group_name"> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn default button-previous">
                                            <i class="fa fa-angle-left"></i> Back </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <a href="javascript:;" class="btn green button-submit" id="submitUserGroup"> Submit
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="menuSelected" id="menuSelected">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop