@extends('backend.layouts.default')
@section('content')
    <?php
    $data = getmemulist();
    $arrSidebar =getSideBar($data);
    ?>

    <style type="text/css">
        label {
            font-size: 18px;
        }
    </style>
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i>

                    {{getMenutitle($arrSidebar)}}
                </h1>
            </div>

        </div>


        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"

                -->
                <header>
                    <ul class="nav nav-tabs pull-left in">

                        <li class="active">

                            <a data-toggle="tab" href="#hr1"> Step 1- <span class="hidden-mobile hidden-tablet"> สร้างผู้ใช้ </span> </a>

                        </li>

                        <li>
                            <a data-toggle="tab" href="#hr2"> Step 2- <span class="hidden-mobile hidden-tablet"> ข้อมูลการเลือกแผนของสมาชิก </span> </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr3"> Step 3- <span class="hidden-mobile hidden-tablet"> ข้อมูลการเปลี่ยนอัตราสะสมของสมาชิก </span> </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr4"> Step 4- <span class="hidden-mobile hidden-tablet">ข้อมูลผู้รับผลประโยชน์ </span> </a>
                        </li>


                    </ul>


                </header>



                <div class="widget-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="hr1">
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                {{--action="{{action('UserController@postAddUser') }}"--}}
                              <p style="padding: 20px;font-size: 22px;"><strong> รหัสพนักงาน :</strong> {{get_userID()}}  <strong> ชื่อ-สกุล : </strong>{{get_username()}}</p>

                                <p style="padding: 20px; font-size: 22px;font-weight: bold;color: #00a1d9;padding-bottom: 0px">
                                    *ท่านสามารถ แก้ไขผู้ใช้ได้โดย วิธีการ Import File    <a href="javascript:void(0);" id="option_insert" class="btn btn-primary btn-xs">กดที่นี่!</a>
                                </p>

                                <div id="import_form" class="smart-form" style="display: none;padding: 20px; font-size: 18px;">
                                    <a class="btn btn-xs btn-success" href="{{ action('UserController@dowloadsample_edit')}}"> ดูตัวอย่างไฟล์</a>
                                    <p></p>
                                    <p class="help-block">
                                        เลือกไฟล์
                                        <br/>
                                        <span style="color: red">จำนวน record ที่สามารถ import ได้สูงสุดต่อครั้งคือ <strong>1 record เท่านั้น!!!</strong></span>
                                    </p>
                                    <input type="file" class="btn btn-default" id="import1" name="import1">
                                    <p style="height: 15px;"></p>
                                    <p id="progress_check" style="display: none;"><img src="/backend/img/shot.gif"> กำลังตรวจสอบ ไฟล์</p>
                                    <p id="progress_import" style="display: none;"><img src="/backend/img/shot.gif"> กำลังนำเข้าข้อมูล</p>
                                    <p id="check_ret" style="display: none"></p>
                                    <p>
                                        <a href="javascript:void(0);" data-input="import1" data-import="1" class="btn_check btn btn-xs btn-primary"><i class="fa fa-download"></i> ตรวจสอบไฟล์</a>
                                        <a href="javascript:void(0);" style="display: none" data-input="import1" data-import="1" class="btn_import btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>
                                    </p>
                                </div>

                                <div id="simple_form">
                                    <form id="smart-form-register" action=""   class="smart-form">
                                        {!! csrf_field() !!}


                                        <fieldset>
                                            <section style="display: none">

                                                <label class="input" style="font-size: 16px">  รหัสพนักงาน </i>
                                                    <input type="text" value="{{$user->EMP_ID}}" id="user_id" name="user_id" style="background-color:#f1f1f1;color:#333" placeholder="รหัสพนักงาน" disabled>
                                                    <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                            </section>

                                            <section>
                                                <label class="input"> ชื่อผู้ใช้</i>
                                                    <input style="background-color:#f1f1f1;color:#333" type="text" id="user_name" name="user_name" placeholder="ชื่อผู้ใช้" value="{{$user->USERNAME}}" disabled>
                                                    <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                            </section>



                                            <section>
                                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                    <button class="btn btn-primary" type="button" id="btn_resetpass" data-id="{{$user->EMP_ID}}" data-user="{{$user->EMP_ID}}" >เปลี่ยนรหัสผ่าน</button></label>
                                                {{--<input type="password" id="password" name="password" placeholder="Password" id="password">--}}
                                                {{--<b class="tooltip tooltip-bottom-right">Don't forget your password</b> --}}
                                            </section>



                                            <header>
                                                ล็อกอินเข้าระบบครั้งแรก
                                            </header>

                                            <?php

                                            $logno = "";
                                            $logyes = "";

                                            if($user->FIRST_LOGIN_FLAG == "0"){
                                                $logyes = "checked";


                                            }else{
                                                $logno = "checked";

                                            }
                                            //                                            $ret = ($user->PASSWORD_EXPIRE_DATE == "asda")


                                            ?>
                                            <section style="margin-top: 15px;margin-left: 20px;">
                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" {{$logyes}}  class="chk_firstlogin" name="chk_firstlogin"  value="0">
                                                        <i></i>ใช่</label>
                                                    <label class="radio">
                                                        <input type="radio" {{$logno}} class="chk_firstlogin" name="chk_firstlogin" value="1">
                                                        <i></i>ไม่ใช่</label>

                                                </div>


                                            </section>

                                            <header>
                                                รหัสผ่านหมดอายุ
                                            </header>

                                            <section style="margin-top: 15px;margin-left: 20px;">
                                                <div class="inline-group">
                                                    <label class="radio">

                                                        <?php
                                                        $bool = false;
                                                        $retno = "";
                                                        $retyes = "";
                                                        $style = "";
                                                        if($user->PASSWORD_EXPIRE_DATE == "9999-12-31 00:00:00.000"){
                                                            $retyes = "checked";


                                                        }else{
                                                            $retno = "checked";
                                                            $style = "style=display:none";
                                                            $bool = true;
                                                        }
                                                        //                                            $ret = ($user->PASSWORD_EXPIRE_DATE == "asda")


                                                        ?>

                                                        <input type="radio" {{$retyes}} class="chk_expire" name="chk_expire"    value="0">
                                                        <i></i>ใช่</label>
                                                    <label class="radio">
                                                        <input type="radio" {{$retno}} class="chk_expire" name="chk_expire" value="1">
                                                        <i></i>ไม่ใช่</label>

                                                </div>


                                            </section>
                                        </fieldset>


                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-6">
                                                    <label class="input"> อีเมล์
                                                        <input type="email"  id="email" name="email" value="{{$user->EMAIL}}"  placeholder="อีเมล์">
                                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                                </section>
                                                <section class="col col-6">
                                                    <label class="input">เบอร์โทรศัพท์
                                                        <input type="text" id="phone" name="phone" value="{{$user->PHONE}}"  placeholder="โทรศัพท์">
                                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                                </section>
                                            </div>

                                            <div class="row">

                                                <section class="col col-6">
                                                    <label class="input">ที่อยู่
                                                        <input type="text" id="address" value="{{$user->ADDRESS}}" name="address" placeholder="ที่อยู่">
                                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                                </section>

                                                <section class="col col-6" id="expire_check" {{$style}}>
                                                    <label class="input state-success"> <i class="icon-append fa fa-calendar"></i>

                                                        @if($bool)
                                                            <input type="text" id="expire" name="expire"  class="mea_date_picker" placeholder="ระบุวันที่หมดอายุของรหัสผ่าน"   >
                                                            <input type="hidden" id="hd_expire" value="{{get_date_sql($user->PASSWORD_EXPIRE_DATE)}}" />
                                                        @else
                                                            <input type="text" id="expire" name="expire" value="{{get_date_notime_en($user->PASSWORD_EXPIRE_DATE)}}" class="mea_date_picker" placeholder="ระบุวันที่หมดอายุของรหัสผ่าน"   >
                                                        @endif
                                                    </label>


                                                </section>
                                            </div>



                                        </fieldset>

                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-6">
                                                    <label class="select">กลุ่มผู้ใช้
                                                        <select id="group_id" name="group_id">
                                                            @if($user_group)
                                                                <option value="default">กลุ่มผู้ใช้</option>
                                                                @foreach($user_group as $group)
                                                                    @if($group->USER_PRIVILEGE_ID == $user->USER_PRIVILEGE_ID)
                                                                        <option selected="selected" value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>
                                                                    @else
                                                                        <option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select> </label>
                                                </section>
                                                <section class="col col-6">
                                                    <label class="select">สถานะ
                                                        <select id="status" name="status">
                                                            <option value="default">สถานะ</option>
                                                            @if($user_status)
                                                                @foreach($user_status as $status)
                                                                    @if($status->USER_STATUS_ID == $user->USER_STATUS_ID)
                                                                        <option selected="selected" value="{{ $status->USER_STATUS_ID }}">{{ $status->STATUS_DESC }}</option>
                                                                    @else
                                                                        <option value="{{ $status->USER_STATUS_ID }}">{{ $status->STATUS_DESC }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>  </label>
                                                </section>
                                            </div>

                                            <div class="row">

                                                <section class="col col-6">
                                                    <label class="input"> วันที่ลาออกจากกองทุน

                                                        @if($user->LEAVE_FUND_GROUP_DATE)
                                                            <input type="text" name="retire" value="{{get_date_notime_en($user->LEAVE_FUND_GROUP_DATE)}}"  class="mea_date_picker" id="retire" placeholder="วันที่ลาออกจากกองทุน"  >
                                                            <input type="hidden" id="hd_retire" value="{{get_date_sql($user->LEAVE_FUND_GROUP_DATE)}}">
                                                        @else
                                                            <input type="text" name="retire"  class="mea_date_picker" id="retire" placeholder="วันที่ลาออกจากกองทุน"  >
                                                        @endif
                                                    </label>
                                                </section>

                                                <section class="col col-6">
                                                    <label class="input">วันที่กลับเข้ากองทุน
                                                        @if($user->RETURN_FUND_GROUP_DATE)
                                                            <input type="text" value="{{get_date_notime_en($user->RETURN_FUND_GROUP_DATE)}}"  name="comeback"  class="mea_date_picker" id="comeback" placeholder="วันที่กลับเข้ากองทุน" >
                                                            <input type="hidden" id="hd_retire" value="{{get_date_sql($user->RETURN_FUND_GROUP_DATE)}}">
                                                        @else
                                                            <input type="text" name="comeback"  class="mea_date_picker" id="comeback" placeholder="วันที่กลับเข้ากองทุน" >
                                                        @endif

                                                        {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                                    </label>
                                                </section>
                                            </div>


                                        </fieldset>
                                        <footer>
                                            <button type="submit"  class="btn btn-primary">แก้ไขข้อมูล
                                            </button>
                                            <button type="button" class="btn btn-default" onclick="window.history.back();">
                                                ยกเลิก
                                            </button>
                                        </footer>
                                    </form>
                                </div>



                            </div>
                            <!-- end widget content -->
                        </div>
                        <div class="tab-pane" id="hr2">
                            @if($userinfo)
                            <p style="padding: 20px;font-size: 22px;"><strong> รหัสพนักงาน :</strong> {{$userinfo[0]->EMP_ID}}  <strong> ชื่อ-สกุล : </strong>{{$userinfo[0]->FULL_NAME}}</p>
                            @endif
                            <form id="smart-form-register_1" action=""   class="smart-form">
                                {!! csrf_field() !!}


                                <fieldset>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="select">เลือกแผนการลงทุน
                                                <select id="PLAN_ID" name="PLAN_ID">
                                                    @if($userplan)
                                                        <option value="default">เลือกแผนการลงทุน</option>
                                                        @foreach($userplan as $group)
                                                            @if($group->PLAN_NAME == "DIY")
                                                            <option selected="selected" value="{{$group->PLAN_ID ."," .$group->EQUITY_MIN_PERCENTAGE."," .$group->EQUITY_MAX_PERCENTAGE."," .$group->DEBT_MIN_PERCENTAGE."," .$group->DEBT_MAX_PERCENTAGE}}">{{ $group->PLAN_NAME }}</option>
                                                            @else
                                                                <option  value="{{$group->PLAN_ID ."," .$group->EQUITY_MIN_PERCENTAGE."," .$group->EQUITY_MAX_PERCENTAGE."," .$group->DEBT_MIN_PERCENTAGE."," .$group->DEBT_MAX_PERCENTAGE}}">{{ $group->PLAN_NAME }}</option>
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                </select> </label>
                                        </section>

                                    </div>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> สัดส่วนทุน (%)
                                                <input type="text" id="EQUITY_RATE" name="EQUITY_RATE"  placeholder="สัดส่วนทุน (%)" >
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input">สัดส่วนหนี้ (%)
                                                <input style="background-color: #f1f1f1" type="text" id="DEBT_RATE" name="DEBT_RATE" placeholder="สัดส่วนหนี้ (%)"  readonly  >
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> วันที่ทำรายการ
                                                <input  type="text" id="MODIFY_DATE" name="MODIFY_DATE" placeholder="วันที่ทำรายการ" />
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input">วันที่มีผล
                                                <input  type="text" id="EFFECTIVE_DATE" name="EFFECTIVE_DATE" placeholder="วันที่มีผล"  />
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                        </section>
                                    </div>



                                    <section>
                                        <label class="input"> ครั้งที่ทำรายการ</i>
                                            <input  type="text" id="MODIFY_COUNT" name="MODIFY_COUNT" placeholder="ครั้งที่ทำรายการ" />
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>



                                </fieldset>




                                <footer>
                                    <button type="submit"  class="btn btn-primary">เพิ่มข้อมูล
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                                        ยกเลิก
                                    </button>
                                </footer>
                            </form>
                        </div>
                        <div class="tab-pane" id="hr3">
                            <p style="padding: 20px;font-size: 22px;"><strong> รหัสพนักงาน :</strong> {{get_userID()}}  <strong> ชื่อ-สกุล : </strong>{{get_username()}}</p>
                            <form id="smart-form-register_2" action=""   class="smart-form">
                                {!! csrf_field() !!}


                                <fieldset>

                                    <section>
                                        <label class="input"> อัตราสะสม (%)</i>
                                            <input  type="text" id="USER_SAVING_RATE" name="USER_SAVING_RATE" placeholder="อัตราสะสม (%)" />
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>



                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> วันที่ทำรายการ
                                                <input type="text" id="CHANGE_SAVING_RATE_DATE" name="CHANGE_SAVING_RATE_DATE" placeholder="วันที่ทำรายการ"  />
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input">วันที่มีผล
                                                <input type="text" id="EFFECTIVE_DATE_1" name="EFFECTIVE_DATE_1" placeholder="วันที่มีผล" />
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                        </section>
                                    </div>


                                    <section>
                                        <label class="input"> ครั้งที่ทำรายการ</i>
                                            <input type="text" id="MODIFY_COUNT_1" name="MODIFY_COUNT_1" placeholder="ครั้งที่ทำรายการ"  />
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>




                                </fieldset>




                                <footer>
                                    <button type="submit"  class="btn btn-primary">เพิ่มข้อมูล
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                                        ยกเลิก
                                    </button>
                                </footer>
                            </form>
                        </div>
                        <div class="tab-pane" id="hr4">
                            <p style="padding: 20px;font-size: 22px;"><strong> รหัสพนักงาน :</strong> {{get_userID()}}  <strong> ชื่อ-สกุล : </strong>{{get_username()}}</p>
                            <form id="smart-form-register_3" action=""   class="smart-form">
                                {!! csrf_field() !!}


                                <fieldset>

                                    <section>
                                        <label class="input"> ชื่อ-สกุล</i>
                                            <input  type="text" id="FULL_NAME" name="FULL_NAME" placeholder="ชื่อ-สกุล" />
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>



                                    <div class="row">

                                        <div style="padding: 15px;font-size: 18px">
                                            <p class="import_title">
                                                <a href="javascript:void(0);"><strong>เป็นเมนูนําเข้าข้อมูลผู้รับผลประโยชน์ของสมาชิก (PDF Import)</strong></a>
                                            </p>
                                            <p>
                                                ชนิดไฟล์ที่อนุญาติให้นำเข้า:PDF <br/>




                                            </p>

                                            <p>
                                            <p class="help-block">
                                                เลือกไฟล์<br/>

                                            </p>
                                            <div class="input-upload">

                                                <input type="file"  class="btn btn-default import_pdf_multi" id="import_pdf" name="import_pdf">
                                            </div>
                                        </div>


                                    </div>







                                </fieldset>




                                <footer>
                                    <button type="submit"  class="btn btn-primary">เพิ่มข้อมูล
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                                        ยกเลิก
                                    </button>
                                </footer>
                            </form>
                        </div>
                    </div>

                </div>



            </div>
            <!-- end widget -->






        </article>
        <!-- END COL -->

    </div>






    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('backend/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function() {

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");



            //min max

            $('#EQUITY_RATE').on('keyup',function(){

                var val =  $(this).val();
                if(val <= 100){

                    $('#DEBT_RATE').val(100 -val);
                }else {

                    alert('กรุณาใส่ข้อมูล ไม่เกิน 100');
                }


            });

            $('#DEBT_RATE').on('keyup',function(){
                var val =  $(this).val();

                if(val <= 100){

                    $('#EQUITY_RATE').val(100 -val);
                }else {

                    alert('กรุณาใส่ข้อมูล ไม่เกิน 100');
                }


            });

          var planval =   $("#PLAN_ID").val();
            var arrval1 = planval.split(',');
            var maxeq1 = arrval1[2]
            var mineq1 = arrval1[1]
            var maxdeb1 =arrval1[4]
            var mindeb1 =arrval1[3]
            $("#EQUITY_RATE").attr('placeholder',mineq1 + "-" + maxeq1);

            $("#PLAN_ID").on('change',function(){

//                alert($(this).val());

                var arrval = $(this).val().split(',');

                var maxeq = arrval[2]
                var mineq = arrval[1]
                var maxdeb =arrval[4]
                var mindeb =arrval[3]


                $("#EQUITY_RATE").attr('placeholder',mineq + "-" + maxeq)

//                $("#DEBT_RATE").attr('placeholder',mindeb + "-" + maxdeb)



            });
            //end min max

            //optonalInsert form


            $("#option_insert").on('click',function(){

                $("#import_form").slideToggle('fast',function(){
                    $('#simple_form').slideToggle('fast',function(){

                        if($('#import_form').css('display') == 'block'){
                            $("#option_insert").html('ยกเลิกการ import');
                        }else {
                            $("#option_insert").html('กดที่นี่');
                        }
                    });
                });

            });





            ///End Optional Insert form


            //import
            $('.btn_check').on('click',function(){


                var dataimport = new FormData();
                var target = $(this).attr('data-input');

                var extall="xlsx,xls.xlx";
                var files = $("#" + target).get(0).files;

                if(files.length){

                    ext = files[0].name.split('.').pop().toLowerCase();
                    if(parseInt(extall.indexOf(ext)) < 0)
                    {
                        Alert("Import",'Extension support : ' + extall);

                        return false;

                    }else {
                        $('#progress_check').show();
                        if (files.length > 0) {
                            dataimport.append("exelimport", files[0]);


                        }

                        dataimport.append('type',importType);

                        $.ajax({

                            type: 'POST', // or post?
                            //                dataType: 'json',
                            contentType: false,
                            processData: false,
                            url: '/admin/users/check',
                            data: dataimport,

                            success: function(data){
                                if(data.success){
                                    $('#progress_check').hide();
                                    if(parseInt(data.html) > 1){

                                        Alert('Import', "จำนวน record สูงสุดที่อนุญาติให้ import คือ 1 record");

                                    }else {
                                        $('.btn_check').hide();
                                        $('.btn_import').show();
//                                    AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว");


                                        $('#check_ret').show();
                                        //
                                        $('#check_ret').html("ข้อมูลถูกต้อง มีจำนวนทั้งหมด " +data.html +" record  กรุณากดปุ่ม นำเข้าข้อมูล ด้านล่างเพื่อ ดำเนินการ import");
                                    }
                                }

                                //                Alert('OK', "ข้อมูลได้ถูก update เรียบร้อยแล้ว");

                            },
                            error: function(xhr, textStatus, thrownError) {

                            }
                        });
                    }

                }else {
                    Alert("Import","ท่านยังไม่ได้เลือกไฟล์");
                }

                var importType= $(this).attr('data-import');





            });

            $('.btn_import').on('click',function(){


                $('#check_ret').hide();
                $('#progress_import').show();

                var dataimport = new FormData();
                var target = $(this).attr('data-input');


                var files = $("#" + target).get(0).files;

                var importType= $(this).attr('data-import');


                if (files.length > 0) {
                    dataimport.append("exelimport", files[0]);


                }

//            dataimport.append('type',importType);
//            var files = $("#imageInput_" + id).get(0).files;



                $.ajax({

                    type: 'POST', // or post?
//                dataType: 'json',
                    contentType: false,
                    processData: false,
                    url: '/admin/users/import2',
                    data: dataimport,

                    success: function(data){
                        if(data.success){
                            $('#progress_import').hide();
                            AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว",function(){
                                window.location.href = "/admin/users/edit/" + data.html;
                            });
                        }else {
                            Alert('Import','การ import ข้อมูลผิดพลาด กรุณาตรวจสอบ รูปแบบข้อมูลของ ไฟล์ ')
                        }

//                Alert('OK', "ข้อมูลได้ถูก update เรียบร้อยแล้ว");

                    },
                    error: function(xhr, textStatus, thrownError) {

                    }
                });

            });



            //End import


            $(".chk_expire").on('click',function(){

                    var res = $(this).val();

                if(res == 1){
                    $("#expire_check").hide();
                }
                if(res == 0){
                    $("#expire_check").show();
                }

            });


            var $registerForm3 = $("#smart-form-register_3").validate({



                // Rules for form validation
                rules : {

                    FULL_NAME : {
                        required : true,

                    }

                },


                submitHandler: function(form)
                {
                    $(form).ajaxSubmit(
                            {

                                success: function()
                                {
                                    var user_id = $("#user_id").val();
                                    var FULL_NAME = $("#FULL_NAME").val();

                                    var dataimport = new FormData();
                                    var files = $("#import_pdf").get(0).files;
//                                    var files = $(this).get(0).files;

                                    dataimport.append("pdfimport", files[0]);
                                    dataimport.append("user_id", user_id);
                                    dataimport.append("FULL_NAME", FULL_NAME);


                                    $.ajax({

                                        type: 'POST', // or post?
//                dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        url: '/admin/users/edit3',
                                        data: dataimport,

                                        success: function(data){
                                            if(data.success){

                                                AlertSuccess("บันทึกเรียบร้อยแล้ว", function(){
                                                    window.location.href =  "/admin/users/edit/" + user_id;

                                                });
                                            }else {
                                                Alert('Import','การ import ข้อมูลผิดพลาด กรุณาตรวจสอบ รูปแบบข้อมูลของ ไฟล์ ')
                                            }



                                        },
                                        error: function(xhr, textStatus, thrownError) {

                                        }
                                    });

                                    return false;
                                }
                            });
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

//                    alert("error");
                }
            });


            meaDatepicker("CHANGE_SAVING_RATE_DATE");
            meaDatepicker("EFFECTIVE_DATE_1");


            var $registerForm2 = $("#smart-form-register_2").validate({



                // Rules for form validation
                rules : {

                    USER_SAVING_RATE : {
                        required : true,

                        maxlength : 100,
                        number:true
                    }

                },

                // Messages for form validation
//                messages : {

//
//                },
                // Ajax form submition
                submitHandler: function(form)
                {
                    $(form).ajaxSubmit(
                            {

                                success: function()
                                {
                                    var user_id = $("#user_id").val();
                                    var USER_SAVING_RATE = $("#USER_SAVING_RATE").val();


                                    var MODIFY_COUNT= $("#MODIFY_COUNT_1").val();
                                    var CHANGE_SAVING_RATE_DATE = $("#hd_CHANGE_SAVING_RATE_DATE").val();
                                    var EFFECTIVE_DATE = $("#hd_EFFECTIVE_DATE_1").val();


                                    var jsondata = {
                                        user_id:user_id,
                                        USER_SAVING_RATE :USER_SAVING_RATE,
                                        MODIFY_COUNT:MODIFY_COUNT,
                                        CHANGE_SAVING_RATE_DATE:CHANGE_SAVING_RATE_DATE,
                                        EFFECTIVE_DATE:EFFECTIVE_DATE


                                    };

                                    MeaAjax(jsondata,"/admin/users/edit2",function(data){
                                        if(data.success){

                                            AlertSuccess("บันทึกเรียบร้อยแล้ว",function(){

                                                window.location.href = "/admin/users/edit/" + user_id;
                                            });

                                        }else {
                                            Alert("",data.html,null,null);
                                        }
                                    });

                                    return false;
                                }
                            });
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

//                    alert("error");
                }
            });

            meaDatepicker("MODIFY_DATE");
            meaDatepicker("EFFECTIVE_DATE");

            var $registerForm1 = $("#smart-form-register_1").validate({



                // Rules for form validation
                rules : {

                    EQUITY_RATE : {
                        required : true,

                        maxlength : 100,
                        number:true
                    },
                    PLAN_ID : {valueNotEquals: "default"},

                    DEBT_RATE : {
                        required : true,

                        maxlength : 100,
                        number:true
                    },
                    MODIFY_COUNT : {
                        required : true,
                        number:true
                    }
                },

                // Messages for form validation
//                messages : {

//
//                },
                // Ajax form submition
                submitHandler: function(form)
                {
                    $(form).ajaxSubmit(
                            {

                                success: function()
                                {


                                    var arrval =  $("#PLAN_ID").val().split(',');




                                    var maxeq = arrval[2]


                                    var mineq = arrval[1]
//                                    var maxdeb =arrval[4]
//                                    var mindeb =arrval[3]

                                    var user_id = $("#user_id").val();
                                    var PLAN_ID = $("#PLAN_ID").val();
                                    var EQUITY_RATE= $("#EQUITY_RATE").val();

                                    var DEBT_RATE= $("#DEBT_RATE").val();

                                    var MODIFY_COUNT= $("#MODIFY_COUNT").val();
                                    var MODIFY_DATE = $("#hd_MODIFY_DATE").val();
                                    var EFFECTIVE_DATE = $("#hd_EFFECTIVE_DATE").val();




                                    if(((parseInt(EQUITY_RATE)>=parseInt(mineq) && parseInt(EQUITY_RATE)<=parseInt(maxeq))  ) ){


                                        var jsondata = {
                                            user_id:user_id,
                                            PLAN_ID :PLAN_ID,
                                            EQUITY_RATE:EQUITY_RATE,
                                            DEBT_RATE:DEBT_RATE,
                                            MODIFY_COUNT:MODIFY_COUNT,
                                            MODIFY_DATE:MODIFY_DATE,
                                            EFFECTIVE_DATE:EFFECTIVE_DATE

                                        };

                                        MeaAjax(jsondata,"/admin/users/edit1",function(data){
                                            if(data.success){

                                                AlertSuccess("บันทึกเรียบร้อยแล้ว",function(){

                                                    window.location.href = "/admin/users/edit/" + user_id;
                                                });

                                            }else {
                                                Alert("",data.html,null,null);
                                            }
                                        });
                                    }else {
                                        Alert('Error','ท่านเลือกจำนวนสัดส่วนตราสารทุน เกินจำนวนที่กำหนด' );
                                    }






                                    return false;
                                }
                            });
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

//                    alert("error");
                }
            });


            var $registerForm = $("#smart-form-register").validate({



                // Rules for form validation
                rules : {

                    email : {
                        required : true,
                        email : true
                    },
                    status : {valueNotEquals: "default"},
                    group_id:{
                        valueNotEquals: "default"
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 20
                    },
                    passwordConfirm : {
                        required : true,
                        minlength : 3,
                        maxlength : 20,
                        equalTo : '#password'
                    }
                },

                // Messages for form validation
//                messages : {

//
//                },
                // Ajax form submition
                submitHandler: function(form)
                {
                    $(form).ajaxSubmit(
                    {
//                        beforeSend: function()
//                        {
//                            alert('no');
//                        },
                        success: function()
                        {
//                             alert($("#hd_retire").val());

                            var user_id = $("#user_id").val();
                            var user_name = $("#user_name").val();
                            var password= $("#password").val();

                            var chk_firstlogin= $('input[name=chk_firstlogin]:checked').val();
                            var chk_expire= $('input[name=chk_expire]:checked').val();

                            var email= $("#email").val();
                            var phone= $("#phone").val();
                            var address= $("#address").val();

                            var retire= $("#hd_retire").val();
                            var comeback= $("#hd_comeback").val();
                            var expire= $("#hd_expire").val();

                            var group_id= $("#group_id").val();
                            var status= $("#status").val();

                            var jsondata = {
                                user_id:user_id,
                                user_name :user_name,
                                password:password,
                                chk_firstlogin:chk_firstlogin,
                                chk_expire:chk_expire,
                                email:email,
                                phone:phone,
                                address:address,
                                retire:retire,
                                comeback:comeback,
                                expire:expire,
                                group_id:group_id,
                                status:status
                            };


//                            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
                            MeaAjax(jsondata,"/admin/users/edit",function(data){
                                if(data.success){

                                    AlertSuccess("บันทึกผู้ใช้เรียบร้อยแล้ว",function(){

                                        window.location.href = "/admin/users/";
                                    });

                                }else {
                                    Alert("",data.html,null,null);
                                }
                            });

                            return false;
                        }
                    });
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

//                    alert("error");
                }
            });




            meaDatepicker("expire");

            meaDatepicker("retire");
            meaDatepicker("comeback");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");



            $("#btn_resetpass").on('click',function(){
                var id = $(this).attr("data-id");
                var user =  $(this).attr("data-user");


                AlertConfirm("Alert","ท่านแน่ใจที่ต้องการจะ reset  password ของผู้ใช้ใช่หรือไม",function(){


                    var jsondata = {username : user};

                    $.ajax({

                        type: 'post', // or post?
                        dataType: 'json',
                        url: '/admin/users/ReqPass',
                        data: jsondata,

                        success: function(data) {

                            if(data.success){
                                $.smallBox({
                                    title: "Congratulations! Your form was submitted",
                                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                                    color: "#5F895F",
                                    iconSmall: "fa fa-check bounce animated",
                                    timeout: 1000
                                });

//
                            }else {
                                Alert("",data.html,"","");
                            }



                        },
                        error: function(xhr, textStatus, thrownError) {
//                                alert(xhr.status);
//                                alert(thrownError);
//                                alert(textStatus);
                        }
                    });

                },null);


            });


        });

    </script>

@stop