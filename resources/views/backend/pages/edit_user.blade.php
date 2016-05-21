@extends('backend.layouts.default')
@section('content')
    <?php
    $data = getmemulist();
    $arrSidebar =getSideBar($data);
    ?>

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
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>


                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        {{--action="{{action('UserController@postAddUser') }}"--}}
                        <form id="smart-form-register" action=""   class="smart-form">
                            {!! csrf_field() !!}


                            <fieldset>
                                <section>

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
                                            <input type="radio" {{$logyes}}  class="chk_firstlogin" name="first_login"  value="0">
                                            <i></i>ใช่</label>
                                        <label class="radio">
                                            <input type="radio" {{$logno}} class="chk_firstlogin" name="first_login" value="1">
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

                                            <input type="radio" {{$retyes}} class="chk_expire" name="pass_expire"    value="0">
                                            <i></i>ใช่</label>
                                        <label class="radio">
                                            <input type="radio" {{$retno}} class="chk_expire" name="pass_expire" value="1">
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
                                            </select> <i></i> </label>
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
                                            </select> <i></i> </label>
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
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->






        </article>
        <!-- END COL -->

    </div>






    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('backend/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function() {

            $(".chk_expire").on('click',function(){

                    var res = $(this).val();

                if(res == 1){
                    $("#expire_check").hide();
                }
                if(res == 0){
                    $("#expire_check").show();
                }

            });

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

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

                            var chk_firstlogin= $(".chk_firstlogin").val();
                            var chk_expire= $(".chk_expire").val();

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