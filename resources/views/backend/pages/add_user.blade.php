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
                    <ul class="nav nav-tabs pull-left in">

                        <li class="active">

                            <a data-toggle="tab" href="#hr1"> Step 1- <span class="hidden-mobile hidden-tablet"> สร้างผู้ใช้ </span> </a>

                        </li>

                        <li>
                            <a data-toggle="tab" class="disable_pan" href="javascript:void(0);"> Step 2- <span class="hidden-mobile hidden-tablet"> ข้อมูลการเลือกแผนของสมาชิก </span> </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="disable_pan" href="javascript:void(0);"> Step 3- <span class="hidden-mobile hidden-tablet"> ข้อมูลการเปลี่ยนอัตราสะสมของสมาชิก </span> </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="disable_pan" href="javascript:void(0);"> Step 4- <span class="hidden-mobile hidden-tablet">ข้อมูลผู้รับผลประโยชน์ </span> </a>
                        </li>


                    </ul>


                </header>

                <!-- widget div-->


                        <div class="widget-body">

                            <div class="tab-content">
                                <div class="tab-pane active" id="hr1">

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">

                                        <p style="padding: 20px; font-size: 22px;font-weight: bold;color: #00a1d9;padding-bottom: 0px">
                                            *ท่านสามารถ เลือกการสร้างผู้ใช้ ได้โดยวิธีการ import  file   <a href="javascript:void(0);" id="option_insert" class="btn btn-primary btn-xs">กดที่นี่!</a>
                                        </p>

                                        <div id="import_form" class="smart-form" style="display: none;padding: 20px; font-size: 18px;">

                                            <a class="btn btn-xs btn-success" href="{{ action('UserController@dowloadsample_add')}}"> ดูตัวอย่างไฟล์</a>
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
                                                    <section>

                                                        <label class="input" style="font-size: 16px"> รหัสพนักงาน
                                                            <input type="text" id="user_id" name="user_id" placeholder="รหัสพนักงาน">
                                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                                    </section>

                                                    <section>
                                                        <label class="input" style="font-size: 16px"> ชื่อผู้ใช้
                                                            <input type="text" id="user_name" name="user_name" placeholder="ชื่อผู้ใช้">
                                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                                    </section>



                                                    <section>
                                                        <label class="input" style="font-size: 16px"> Password
                                                            <input type="password" id="password" name="password" placeholder="Password" id="password">
                                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                                    </section>

                                                    <section>
                                                        <label class="input" style="font-size: 16px">Confirm password
                                                            <input type="password" name="passwordConfirm" placeholder="Confirm password">
                                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                                    </section>

                                                    <header>
                                                        ล็อกอินเข้าระบบครั้งแรก
                                                    </header>

                                                    <section style="margin-top: 15px;margin-left: 20px;">
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" class="chk_firstlogin" name="chk_firstlogin" checked="" value="0">
                                                                <i></i>ใช่</label>
                                                            <label class="radio">
                                                                <input type="radio" class="chk_firstlogin" name="chk_firstlogin" value="1">
                                                                <i></i>ไม่ใช่</label>

                                                        </div>


                                                    </section>

                                                    <header>
                                                        รหัสผ่านหมดอายุ
                                                    </header>

                                                    <section style="margin-top: 15px;margin-left: 20px;">
                                                        <div class="inline-group">
                                                            <label class="radio">
                                                                <input type="radio" class="chk_expire" name="chk_expire" checked="" value="0">
                                                                <i></i>ใช่</label>
                                                            <label class="radio">
                                                                <input type="radio" class="chk_expire" name="chk_expire" value="1">
                                                                <i></i>ไม่ใช่</label>

                                                        </div>


                                                    </section>
                                                </fieldset>


                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="input" style="font-size: 16px"> อีเมล์
                                                                <input type="email"  id="email" name="email" placeholder="อีเมล์">
                                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                                        </section>
                                                        <section class="col col-6">
                                                            <label class="input" style="font-size: 16px">โทรศัพท์
                                                                <input type="text" id="phone" name="phone" placeholder="โทรศัพท์">
                                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                                        </section>
                                                    </div>

                                                    <div class="row">

                                                        <section class="col col-6">
                                                            <label class="input" style="font-size: 16px">ที่อยู่
                                                                <input type="text" id="address" name="address" placeholder="ที่อยู่">
                                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                                        </section>

                                                        <section class="col col-6" id="expire_check" style="font-size: 16px">
                                                            <label class="input state-success" style="font-size: 16px"> ระบุวันที่หมดอายุของรหัสผ่าน
                                                                <input type="text" id="expire" name="expire"  class="mea_date_picker" placeholder="ระบุวันที่หมดอายุของรหัสผ่าน"   >
                                                            </label>
                                                        </section>
                                                    </div>



                                                </fieldset>

                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="select" style="font-size: 16px">กลุ่มผู้ใช้
                                                                <select id="group_id" name="group_id">
                                                                    @if($user_group)
                                                                        <option value="default">กลุ่มผู้ใช้</option>
                                                                        @foreach($user_group as $group)
                                                                            <option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select> <i></i> </label>
                                                        </section>
                                                        <section class="col col-6">
                                                            <label class="select" style="font-size: 16px">สถานะ
                                                                <select id="status" name="status">
                                                                    <option value="default">สถานะ</option>
                                                                    @if($user_status)
                                                                        @foreach($user_status as $status)
                                                                            <option value="{{ $status->USER_STATUS_ID }}">{{ $status->STATUS_DESC }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select> <i></i> </label>
                                                        </section>
                                                    </div>

                                                    <div class="row">

                                                        <section class="col col-6">
                                                            <label class="input" style="font-size: 16px"> วันที่ลาออกจากกองทุน
                                                                <input type="text" name="retire"  class="mea_date_picker" id="retire" placeholder="วันที่ลาออกจากกองทุน"  >
                                                            </label>
                                                        </section>

                                                        <section class="col col-6">
                                                            <label class="input" style="font-size: 16px">วันที่กลับเข้ากองทุน
                                                                <input type="text" name="comeback"  class="mea_date_picker" id="comeback" placeholder="วันที่กลับเข้ากองทุน" >

                                                                {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                                            </label>
                                                        </section>
                                                    </div>


                                                </fieldset>
                                                <footer>
                                                    <button type="submit"  class="btn btn-primary">ส่งข้อมูล
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
                                </div>
                                <div class="tab-pane" id="hr3">
                                </div>
                                <div class="tab-pane" id="hr4">
                                </div>
                            </div>

                        </div>
            </div>

                <!-- end widget div -->




        </article>
        <!-- END COL -->

    </div>






    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('backend/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function() {


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


            $(".disable_pan").on('click',function(){

                Alert('Alert','ท่านยังไมไ่ด้ สร้างผู้ใช้ ');

                return false;
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
                            url: 'check',
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
                    url: 'import2',
                    data: dataimport,

                    success: function(data){
                        if(data.success){
                            $('#progress_import').hide();
                            AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว",function(){
                                window.location.href = "edit/" + data.html;
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

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            var $registerForm = $("#smart-form-register").validate({



                // Rules for form validation
                rules : {
                    user_id : {
                        required : true,
                        maxlength: 7,
                        number : true
                    },
                    user_name : {
                        required : true

                    },
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

                            var chk_firstlogin=  $('input[name=chk_firstlogin]:checked').val();


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
                            MeaAjax(jsondata,"add",function(data){
                                if(data.success){

                                    AlertSuccess("บันทึกผู้ใช้เรียบร้อยแล้ว",function(){

                                        window.location.href = "/admin/users";
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




        });

    </script>

@stop