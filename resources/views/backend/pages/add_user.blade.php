@extends('backend.layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-user-follow font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">เพิ่มผู้ใช้</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="#" id="add_user_form" class="form-horizontal">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">รหัสพนักงาน
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="user_id" id="user_id" data-required="1" class="form-control" /> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">ชื่อผู้ใช้
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="user_name" id="user_name" data-required="1" class="form-control" /> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">รหัสผ่าน
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="password" name="password" id="password" data-required="1" class="form-control" /> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">ยืนยันรหัสผ่าน
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="password" name="password_confirm" id="password_confirm" data-required="1" class="form-control" /> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">ล็อกอินเข้าระบบครั้งแรก
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="radio-list" data-error-container="#form_2_membership_error">
                                        <label>
                                            <input type="radio" checked name="first_login" value="1" /> ใช่ </label>
                                        <label>
                                            <input type="radio" name="first_login" value="2" /> ไม่ใช่ </label>
                                    </div>
                                    <div id="form_2_membership_error"> </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">โทรศัพท์
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="phone" id="phone" type="text" class="form-control" /> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">อีเมล์
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="email" id="email" type="text" class="form-control" /> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">ที่อยู่
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="address" name="address"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">รหัสผ่านหมดอายุ
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="radio-list" data-error-container="#form_2_membership_error">
                                        <label>
                                            <input type="radio" checked name="password_expire" value="1" /> ใช่ </label>
                                        <label>
                                            <input type="radio" name="password_expire" value="2" /> ไม่ใช่ </label>
                                    </div>
                                    <div id="form_2_membership_error"> </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">ระบุวันที่หมดอายุของรหัสผ่าน</label>
                                <div class="col-md-4">
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                        <input type="text" class="form-control" name="password_expire_date" id="password_expire_date" readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">กลุ่มผู้ใช้
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="select">
                                        <option value="">Select...</option>
                                        @if($user_group)
                                            @foreach($user_group as $group)
                                                <option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">สถานะ
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="select">
                                        <option value="">Select...</option>
                                        @if($user_status)
                                            @foreach($user_status as $status)
                                                <option value="{{ $status->USER_STATUS_ID }}">{{ $status->STATUS_DESC }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">วันที่ลาออกจากกองทุน</label>
                                <div class="col-md-4">
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="LEAVE_FUND_GROUP_DATE" id="LEAVE_FUND_GROUP_DATE" readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">วันที่กลับเข้ากองทุน</label>
                                <div class="col-md-4">
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="RETURN_FUND_GROUP_DATE" id="RETURN_FUND_GROUP_DATE" readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn grey-salsa btn-outline">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@stop