@extends('backend.layouts.default')
@section('content')

    <?php
    $data = getmemulist();
    $arrSidebar =getSideBar($data);
    ?>
    <style type="text/css">
        .tree span{
            font-size: 20px !important;
            padding: 3px 7px 3px 7px !important;
        }
        .tree label{
            font-size: 18px !important;
        }

        .form-horizontal .checkbox, .form-horizontal .checkbox-inline, .form-horizontal .radio, .form-horizontal .radio-inline{
            padding-top: 0px !important;
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

<div class="row">

    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header >

            </header>

            <!-- widget div-->
            <div>

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body fuelux">

                    <form class="form-horizontal" id="risk_form" action="">
                        {{--{!! csrf_field() !!}--}}

                        <div class="step-pane active" id="step1" >
                            <h3><strong>Step 1 </strong> - กำหนดข้อมูลทั่วไปของแบบประเมิน</h3>


                            <div class="smart-form">



                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">รหัสแบบประเมินความเสี่ยง</span>
                                            @if($quiz)
                                                <input class="form-control" id="QUIZ_ID" name="QUIZ_ID" value="{{$quiz->QUIZ_ID}}" type="text">
                                            @else
                                                <input class="form-control" id="QUIZ_ID" name="QUIZ_ID"   type="text">
                                            @endif
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">ชื่อแบบประเมินความเสี่ยง</span>
                                            @if($quiz)
                                                <input class="form-control" id="QUIZ_DESC" name="QUIZ_DESC" value="{{$quiz->QUIZ_DESC}}" type="text">
                                            @else
                                                <input class="form-control" id="QUIZ_DESC" name="QUIZ_DESC"   type="text">
                                            @endif
                                        </label>
                                    </section>
                                    {{--<header>--}}
                                    {{--สถานะ--}}
                                    {{--</header>--}}
                                    {{--<section style="margin-top: 15px;margin-left: 20px;">--}}
                                    {{--<div class="inline-group">--}}
                                    {{--<label class="radio">--}}
                                    {{--<input type="radio" class="QUIZ_ACTIVE_FLAG" name="QUIZ_ACTIVE_FLAG" checked="" value="0">--}}
                                    {{--<i></i>เปิด</label>--}}
                                    {{--<label class="radio">--}}
                                    {{--<input type="radio" class="QUIZ_ACTIVE_FLAG" name="QUIZ_ACTIVE_FLAG" value="1">--}}
                                    {{--<i></i>ปิด</label>--}}

                                    {{--</div>--}}


                                    {{--</section>--}}
                                    {{--<section class="col col-6">--}}
                                    {{--<span style="font-size: 18px">วันที่เริ่มต้น</span>--}}
                                    {{--<label class="input"> <i class="icon-append fa fa-calendar"></i>--}}

                                    {{--<input type="text" name="QUIZ_ACTIVE_DATE"  class="mea_date_picker" id="QUIZ_ACTIVE_DATE" placeholder="วันที่เริ่มต้น"  >--}}
                                    {{--</label>--}}
                                    {{--</section>--}}

                                    {{--<section class="col col-6">--}}
                                    {{--<span style="font-size: 18px">วันที่สิ้นสุด</span>--}}
                                    {{--<label class="input"> <i class="icon-append fa fa-calendar"></i>--}}
                                    {{--<input type="text" name="QUIZ_EXPIRE_DATE"  class="mea_date_picker" id="QUIZ_EXPIRE_DATE" placeholder="วันที่สิ้นสุด" >--}}

                                    {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                    {{--</label>--}}
                                    {{--</section>--}}

                                </fieldset>

                            </div>
                            <!-- wizard form starts here -->

                            <div class="smart-form"><footer> <button type="submit" href="#" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> บันทึก</button></footer></div>
                        </div>

                    </form>



                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </article>

    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false">
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


            </header>

            <!-- widget div-->
            <div>

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body fuelux">




                    <div class="step-pane " id="step2" >
                        <h3><strong>Step 2 </strong> - กำหนดช่วงคะแนน </h3>

                        <div class="row">

                            <div class="col-xs-12" style="text-align: center" >

                                <table class="table table-bordered table-striped" style="margin: 0 auto; font-size: 18px">
                                    <tr>

                                        <th style="width: 20%">ช่วงคะแนน</th>
                                        <th style="width: 30%">ระดับความเส่ียง</th>
                                        <th style="width: 40%">สัดส่วนการลงทุนที่แนะนํา</th>
                                        <th style="width: 10%"></th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" style="display: none" name="checkscore[]" value="1">
                                            <input id="SCORE_RANGE_0" placeholder="10-16" name="SCORE_RANGE_0" class="form-control" type="text">
                                        </td>
                                        <td>
                                            <input id="RISK_RATE_0" placeholder="ต่ำ" name="RISK_RATE_0" class="form-control" type="text">
                                        </td>
                                        <td>
                                            <input id="RATIO_RECOMMENDED_0" placeholder="มีสัดส่วนการลงทุนตราสารทนุ 0%" name="RATIO_RECOMMENDED_0" class="form-control" type="text">
                                        </td>
                                        <td> <a id="gen_risk"  class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> เพิ่ม</a></td>

                                    </tr>


                                </table>
                            </div>
                        </div>


                        <h3> ช่วงคะแนนที่ท่านเลือก </h3>
                        <div class="row">

                            <div class="col-xs-12" style="text-align: center" id="ret_period">
                                <table class="table table-bordered table-striped" style="margin: 0 auto; font-size: 18px">
                                    <tr>

                                        <th style="width: 20%">ช่วงคะแนน</th>
                                        <th style="width: 20%">ระดับความเส่ียง</th>
                                        <th style="width: 40%">สัดส่วนการลงทุนที่แนะนํา</th>
                                        <th style="width: 10%"></th>
                                        <th style="width: 10%"></th>

                                    </tr>
                                    <tr>
                                        <td colspan="5"> กรุณาเลือก ช่วงคะแนน </td>
                                    </tr>


                                </table>

                            </div>
                        </div>




                    </div>





                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </article>

    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false">
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


            </header>

            <!-- widget div-->
            <div>

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body fuelux">




                    <div class="step-pane" id="step3" >
                        <h3><strong>Step 3 </strong> - สร้างคำถามและตัวเลือกคำตอบ </h3>


                        <div class="row">
                            <form action="#" id="form_step_3" class="smart-form">

                                <div class="col-xs-12" style="text-align: center" >
                                    <table class="table table-bordered " style="margin-bottom: 0px; border-bottom: 0;">
                                        <tr>
                                            <td style="width: 10%">

                                                    <section>

                                                        <label class="input">
                                                <label><strong>คำถามที่ </strong></label>
                                                <input id="QUESTION_NO"  name="QUESTION_NO" class="form-control" type="text">
                                            </label></section>
                                            </td>

                                            <td style="width: 90%">

                                                    <section>

                                                        <label class="input">
                                                <label><strong>รายละเอียดคําถาม </strong></label>
                                                <input id="QUESTION_DESC"  name="QUESTION_DESC" class="form-control" type="text">

                                                        </label></section>
                                            </td></tr>

                                    </table>
                                    {{--<td> <a id="gen_risk"  class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> เพิ่ม</a></td>--}}
                                    <table class="table table-bordered table-striped" style="margin: 0 auto; font-size: 18px">


                                        <td>
                                            <section style="float: left">
                                             <label class="input">
                                            <label><strong>ตัวเลือกที่ 1 </strong></label>
                                            <input id="QUESTION_CHOICE_SCORE_1"  name="QUESTION_CHOICE_SCORE_1" placeholder="คะแนน" style="width: 100px;display: inline" class="form-control" type="text">
                                             </label></section>
                                            <section style="float: left;margin-left: 5px;">
                                                <label class="input">
                                            <input id="QUESTION_CHOICE_DESC_1"  name="QUESTION_CHOICE_DESC_1" placeholder="รายละเอียดตัวเลือก"  style="width: 300px;display: inline"  class="form-control" type="text">
                                                </label></section>

                                        </td>
                                        <td>
                                            <section style="float: left"><label class="input">
                                            <label><strong>ตัวเลือกที่ 2 </strong></label>
                                            <input id="QUESTION_CHOICE_SCORE_2"  name="QUESTION_CHOICE_SCORE_2" placeholder="คะแนน" style="width: 100px;display: inline" class="form-control" type="text">
                                                </label></section>
                                            <section style="float: left;margin-left: 5px;"><label class="input">
                                            <input id="QUESTION_CHOICE_DESC_2"  name="QUESTION_CHOICE_DESC_2" placeholder="รายละเอียดตัวเลือก" style="width: 300px;display: inline"  class="form-control" type="text">
                                                </label></section>
                                        </td>



                                        </tr>
                                        <tr>
                                            <td>
                                                <section style="float: left"><label class="input">
                                                <label><strong>ตัวเลือกที่ 3 </strong></label>
                                                <input id="QUESTION_CHOICE_SCORE_3"  name="QUESTION_CHOICE_SCORE_3" placeholder="คะแนน" style="width: 100px;display: inline" class="form-control" type="text">
                                                    </label></section>
                                                        <section style="float: left;margin-left: 5px;"><label class="input">
                                                <input id="QUESTION_CHOICE_DESC_3"  name="QUESTION_CHOICE_DESC_3" placeholder="รายละเอียดตัวเลือก" style="width: 300px;display: inline"  class="form-control" type="text">
                                                    </label></section>
                                            </td>
                                            <td>
                                                <section style="float: left"><label class="input">
                                                <label><strong>ตัวเลือกที่ 4 </strong></label>
                                                <input id="QUESTION_CHOICE_SCORE_4"  name="QUESTION_CHOICE_SCORE_4" placeholder="คะแนน" style="width: 100px;display: inline" class="form-control" type="text">
                                                    </label></section>
                                                        <section style="float: left;margin-left: 5px;"><label class="input">
                                                <input id="QUESTION_CHOICE_DESC_4"  name="QUESTION_CHOICE_DESC_4" placeholder="รายละเอียดตัวเลือก" style="width: 300px;display: inline"  class="form-control" type="text">
                                                    </label></section>
                                            </td>



                                        </tr>

                                    </table>
                                </div>
                            </form>


                        </div>
                        <div class="smart-form"><footer> <button type="button" id="btn_save_question" href="" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> บันทึก</button></footer></div>

                        <h3> รายละเอียดคําถาม ของท่าน </h3>
                        {{--max-height: 500px; overflow: scroll;--}}
                        <div id="ret_question" style="padding: 15px; background-color: #f1f1f1; border: 1px solid #C2C2C2">
                            <div class="row" >
                                <form action="#" id="form_step_3" class="smart-form">

                                    <div class="col-xs-12" style="text-align: center" >
                                        <table class="table table-bordered " style="margin-bottom: 0px; border-bottom: 0;">
                                            <tr>
                                                <td> กรุณาสร้าง รายการคำถาม</td>
                                            </tr>

                                        </table>

                                    </div>
                                </form>


                            </div>
                        </div>





                    </div>






                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </article>
    <!-- WIDGET END -->

</div>




    </div>



    @if($quiz)
    <input type="hidden" id="quisid" data-update="update" value="{{$quiz->QUIZ_ID}}" />
    @else
        <input type="hidden" id="quisid" value="" />
        @endif

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('backend/js/plugin/jquery-form/jquery-form.min.js')}}"></script>

    <script type="text/javascript">




        function gen_risk_update(){


            $(".gen_risk_update").on('click',function(){
                var data = $(this).data('val');

                var SCORE_RANGE = $("#data-rage_" + data).val();
                var RISK_RATE = $("#data-riskrate_" + data).val()
                var RATIO_RECOMMENDED =  $("#data-ratiorecom_" + data).val();


                var json = {
                    SCORE_ID:data,
                    SCORE_RANGE:SCORE_RANGE,
                    RISK_RATE:RISK_RATE,
                    RATIO_RECOMMENDED:RATIO_RECOMMENDED
                };


                MeaAjax(json,'/admin/risk/editperiod',function(data){
                    if(data.success){
                        AlertSuccess("แก้ไขเรียบร้อยแล้ว");
                    }
                });


            });

        }
        function gen_risk_delete(){


            $(".gen_risk_delete").on('click',function(){

                var data = $(this).data('val');
                var json = {
                    SCORE_ID:data

                };


                AlertConfirm("Alert",'ท่านแน่ใจที่ต้องการลบ',function(){







                    MeaAjax(json,'/admin/risk/deleteperiod',function(data){
                        if(data.success){
                            AlertSuccess("ดำเนินการลบออกเรียบร้อยแล้ว");
                            var json = {PLAN_ID:$("#quisid").val() };
                            GetPeriodLsit(json);
                        }
                    });

                },
                function(){

                    return false;
                });



            });

        }


        function GetPeriodLsit(json){



            MeaAjax(json,'/admin/risk/getperiod',function(data){
                $("#ret_period").html(data.html);

                gen_risk_update();
                gen_risk_delete();
            });
        }

        $(document).ready(function() {

           if($("#quisid").data('update') ) {
               $("#QUIZ_ID").prop('disabled','disabled');
               var json = {PLAN_ID:$("#quisid").val() };
               GetPeriodLsit(json);

               var jsons = {QUIZ_ID:$("#quisid").val() };
               GetQuestionLsit(jsons);
           }

//            meaDatepicker("QUIZ_ACTIVE_DATE");

//            meaDatepicker("QUIZ_EXPIRE_DATE");




            $("#gen_risk").on('click',function(){
              var p1 =  $("#SCORE_RANGE_0").val();
                var p2 = $("#RISK_RATE_0").val();
                var p3  =$("#RATIO_RECOMMENDED_0").val();
                var PLAN_ID =$("#quisid").val()
                if( p1 =="" && p1 == "" && p3 =="" ){
                    Alert("Error!","กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
                }else {
                    if( p1 =="" || p1 == "" || p3 =="" ){
                        Alert("Error!","กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
                    }else {

                            if($("#quisid").val() != ""){
                                var dataimport = new FormData();


                                dataimport.append('PLAN_ID',PLAN_ID);
                                dataimport.append('SCORE_RANGE',p1);
                                dataimport.append('RISK_RATE',p2);
                                dataimport.append('RATIO_RECOMMENDED',p3);


                                $.ajax({

                                    type: 'POST', // or post?
//                dataType: 'json',
                                    contentType: false,
                                    processData: false,
                                    url: '/admin/risk/period',
                                    data: dataimport,

                                    success: function(data){

                                        if(data.success){


                                            //$('html').append('<input type="hidden" value=""+QUIZ_ID+"" />')

                                            AlertSuccess("บันทึกช่วงคะแนนแบบประเมินเรียบร้อยแล้ว");
                                            var json = {PLAN_ID:PLAN_ID };
                                            $("#ret_period").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
                                            GetPeriodLsit(json);

                                        }else {
                                            Alert("",data.html,null,null);
                                        }



                                    },
                                    error: function(xhr, textStatus, thrownError) {

                                    }
                                });

                                return false;

                            }else {
                                Alert("Error!","กรุณาใส่ข้อมูลใน Step 1 ก่อน ");
                            }





                    }
                }

            });

            var $registerForm = $("#risk_form").validate({



                // Rules for form validation
                rules: {

                    QUIZ_ID: {
                        required: true,
                        number: true
                    },
                    QUIZ_DESC: {
                        required: true
                    }

                },
                submitHandler: function(form)
                {
                    $(form).ajaxSubmit(
                            {
//                        beforeSend: function()
//                        {
//                            Alert("",data.html,null,null);
//                        },
                                success: function()
                                {
//                             alert($("#hd_retire").val());


                                    var dataimport = new FormData();

                                    var QUIZ_ID = $("#QUIZ_ID").val();
                                    var QUIZ_DESC = $("#QUIZ_DESC").val();


//                                    var QUIZ_ACTIVE_FLAG = $('input[name=QUIZ_ACTIVE_FLAG]:checked').val();
//                                    var QUIZ_ACTIVE_DATE= $("#hd_QUIZ_ACTIVE_DATE").val();
//                                    var QUIZ_EXPIRE_DATE= $("#hd_QUIZ_EXPIRE_DATE").val();


                                    var QUIZ_ACTIVE_FLAG ='1';
                                    var QUIZ_ACTIVE_DATE= '2000-01-01';
                                    var QUIZ_EXPIRE_DATE= '9999-12-31';
                                    var isupdate = false;

                                    if($("#quisid").data('update')){
                                        isupdate = true;
                                    }



                                    dataimport.append('QUIZ_ID',QUIZ_ID);
                                    dataimport.append('QUIZ_DESC',QUIZ_DESC);
                                    dataimport.append('QUIZ_ACTIVE_FLAG',QUIZ_ACTIVE_FLAG);
                                    dataimport.append('QUIZ_ACTIVE_DATE',QUIZ_ACTIVE_DATE);
                                    dataimport.append('QUIZ_EXPIRE_DATE',QUIZ_EXPIRE_DATE);
                                    dataimport.append('isupdate',isupdate);




                                    $.ajax({

                                        type: 'POST', // or post?
//                dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        url: '/admin/risk/ishave',
                                        data: dataimport,

                                        success: function(data){

                                            if(data.success){

                                                $("#quisid").val(QUIZ_ID);
                                                //$('html').append('<input type="hidden" value=""+QUIZ_ID+"" />')

                                                AlertSuccess("บันทึกหมวดหมู่ถามตอบเรียบร้อยแล้ว",function(){
                                                    window.location.href = "/admin/risk/edit/" +QUIZ_ID ;
                                                });

                                            }else {
                                                Alert("",data.html,null,null);
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



            $("#form_step_3").validate({
                rules: {

                    QUESTION_NO: {
                        required: true,
                        number: true
                    },
                    QUESTION_CHOICE_SCORE_1: {
                        required: true,
                        number: true
                    },
                    QUESTION_CHOICE_SCORE_2: {
                        required: true,
                        number: true
                    },
                    QUESTION_CHOICE_SCORE_3: {
                        required: true,
                        number: true
                    },
                    QUESTION_CHOICE_SCORE_4: {
                        required: true,
                        number: true
                    },
                    QUESTION_CHOICE_DESC_1 :{
                        required: true
                    },
                    QUESTION_CHOICE_DESC_2 :{
                        required: true
                    },
                    QUESTION_CHOICE_DESC_3 :{
                        required: true
                    },
                    QUESTION_CHOICE_DESC_4 :{
                        required: true
                    }

                },
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

//                    alert("error");
                }
            });

$("#btn_save_question").on('click',function(){


    var vlid = $("#form_step_3").valid();
    var QUIZ_ID = $("#quisid").val();

    var QUESTION_NO = $("#QUESTION_NO").val();
    var QUESTION_DESC = $("#QUESTION_DESC").val();
    var QUESTION_CHOICE_SCORE_1 = $("#QUESTION_CHOICE_SCORE_1").val();
    var QUESTION_CHOICE_SCORE_2 = $("#QUESTION_CHOICE_SCORE_2").val();
    var QUESTION_CHOICE_SCORE_3 = $("#QUESTION_CHOICE_SCORE_3").val();
    var QUESTION_CHOICE_SCORE_4 = $("#QUESTION_CHOICE_SCORE_4").val();
    var QUESTION_CHOICE_DESC_1 = $("#QUESTION_CHOICE_DESC_1").val();
    var QUESTION_CHOICE_DESC_2 = $("#QUESTION_CHOICE_DESC_2").val();
    var QUESTION_CHOICE_DESC_3 = $("#QUESTION_CHOICE_DESC_3").val();
    var QUESTION_CHOICE_DESC_4 = $("#QUESTION_CHOICE_DESC_4").val();


    if(QUESTION_NO == "" || QUESTION_DESC == "" | QUESTION_CHOICE_SCORE_1 == ""| QUESTION_CHOICE_SCORE_2 == ""| QUESTION_CHOICE_SCORE_3 == ""| QUESTION_CHOICE_SCORE_4 == ""| QUESTION_CHOICE_DESC_1 == ""| QUESTION_CHOICE_DESC_2 == ""| QUESTION_CHOICE_DESC_3 == ""| QUESTION_CHOICE_DESC_4 == "" ){
        Alert("Error!","กรุณากรอกข้อมูลให้ครบ ทุกช่อง");
    }else {

        if($("#quisid").val() == ""){
            Alert("Error!","กรุณาใส่ข้อมูลใน Step 1 ก่อน ");
        }else {


            if(vlid){
                var json = {PLAN_ID:$("#quisid").val() };

                var dataimport = new FormData();



                dataimport.append('QUIZ_ID',QUIZ_ID);
                dataimport.append('QUESTION_NO',QUESTION_NO);
                dataimport.append('QUESTION_DESC',QUESTION_DESC);
                dataimport.append('QUESTION_CHOICE_SCORE_1',QUESTION_CHOICE_SCORE_1);
                dataimport.append('QUESTION_CHOICE_SCORE_2',QUESTION_CHOICE_SCORE_2);
                dataimport.append('QUESTION_CHOICE_SCORE_3',QUESTION_CHOICE_SCORE_3);
                dataimport.append('QUESTION_CHOICE_SCORE_4',QUESTION_CHOICE_SCORE_4);
                dataimport.append('QUESTION_CHOICE_DESC_1',QUESTION_CHOICE_DESC_1);
                dataimport.append('QUESTION_CHOICE_DESC_2',QUESTION_CHOICE_DESC_2);
                dataimport.append('QUESTION_CHOICE_DESC_3',QUESTION_CHOICE_DESC_3);
                dataimport.append('QUESTION_CHOICE_DESC_4',QUESTION_CHOICE_DESC_4);


                $.ajax({

                    type: 'POST', // or post?
//                dataType: 'json',
                    contentType: false,
                    processData: false,
                    url: '/admin/risk/question',
                    data: dataimport,

                    success: function(data){

                        if(data.success){


                            //$('html').append('<input type="hidden" value=""+QUIZ_ID+"" />')

                            AlertSuccess("บันทึกช่วงคะแนนแบบประเมินเรียบร้อยแล้ว");


                            var json = {QUIZ_ID:$("#quisid").val() };

                            GetQuestionLsit(json);

                        }else {
                            Alert("",data.html,null,null);
                        }



                    },
                    error: function(xhr, textStatus, thrownError) {

                    }
                });

            }


            return false;
        }

    }




});




        });



        function gen_question_update(){


            $(".btn-question-edit").on('click',function(){
                var QUIZ_ID = $(this).data('quiz_id');
                var QUESTION_NO = $(this).data('question_no');

                var QUESTION_NO_new = $("#QUESTION_NO_" +QUIZ_ID).val();
                var QUESTION_DESC_new = $("#QUESTION_DESC_" +QUIZ_ID).val();


                var QUESTION_CHOICE_SCORE_1= $("#QUESTION_CHOICE_SCORE_1_" +QUIZ_ID + "_" +QUESTION_NO ).val();
                var QUESTION_CHOICE_DESC_1= $("#QUESTION_CHOICE_DESC_1_" +QUIZ_ID + "_" +QUESTION_NO ).val();

                var QUESTION_CHOICE_SCORE_2= $("#QUESTION_CHOICE_SCORE_2_" +QUIZ_ID + "_" +QUESTION_NO ).val();
                var QUESTION_CHOICE_DESC_2= $("#QUESTION_CHOICE_DESC_2_" +QUIZ_ID + "_" +QUESTION_NO ).val();

                var QUESTION_CHOICE_SCORE_3= $("#QUESTION_CHOICE_SCORE_3_" +QUIZ_ID + "_" +QUESTION_NO ).val();
                var QUESTION_CHOICE_DESC_3= $("#QUESTION_CHOICE_DESC_3_" +QUIZ_ID + "_" +QUESTION_NO ).val();

                var QUESTION_CHOICE_SCORE_4= $("#QUESTION_CHOICE_SCORE_4_" +QUIZ_ID + "_" +QUESTION_NO ).val();
                var QUESTION_CHOICE_DESC_4= $("#QUESTION_CHOICE_DESC_4_" +QUIZ_ID + "_" +QUESTION_NO ).val();


                var json = {
                    QUIZ_ID:QUIZ_ID,
                    QUESTION_NO:QUESTION_NO,
                    QUESTION_NO_new:QUESTION_NO_new,
                    QUESTION_DESC_new:QUESTION_DESC_new,
                    QUESTION_CHOICE_SCORE_1:QUESTION_CHOICE_SCORE_1,
                    QUESTION_CHOICE_DESC_1:QUESTION_CHOICE_DESC_1,
                    QUESTION_CHOICE_SCORE_2:QUESTION_CHOICE_SCORE_2,
                    QUESTION_CHOICE_DESC_2:QUESTION_CHOICE_DESC_2,
                    QUESTION_CHOICE_SCORE_3:QUESTION_CHOICE_SCORE_3,
                    QUESTION_CHOICE_DESC_3:QUESTION_CHOICE_DESC_3,
                    QUESTION_CHOICE_SCORE_4:QUESTION_CHOICE_SCORE_4,
                    QUESTION_CHOICE_DESC_4:QUESTION_CHOICE_DESC_4
                };


                MeaAjax(json,'/admin/risk/editquestion',function(data){
                    if(data.success){
                        AlertSuccess("แก้ไขเรียบร้อยแล้ว");
                        var jsons = {QUIZ_ID:$("#quisid").val() };
                        GetQuestionLsit(jsons);
                    }
                });


            });

        }


        function gen_question_delete(){


            $(".btn-question-delete").on('click',function(){

                var QUIZ_ID = $(this).data('quiz_id');
                var QUESTION_NO = $(this).data('question_no');

                var json = {
                    QUIZ_ID:QUIZ_ID,
                    QUESTION_NO:QUESTION_NO

                };


                AlertConfirm("Alert",'ท่านแน่ใจที่ต้องการลบ',function(){







                            MeaAjax(json,'/admin/risk/deletequestion',function(data){
                                if(data.success){
                                    AlertSuccess("ดำเนินการลบออกเรียบร้อยแล้ว");
                                    var jsons = {QUIZ_ID:$("#quisid").val() };
                                    GetQuestionLsit(jsons);
                                }
                            });

                        },
                        function(){

                            return false;
                        });



            });

        }


    function  GetQuestionLsit(json){

        $("#ret_question").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
        MeaAjax(json,'/admin/risk/getquestion',function(data){
            $("#ret_question").html(data.html);
            gen_question_update();
            gen_question_delete();
        });
    }



    </script>

@stop