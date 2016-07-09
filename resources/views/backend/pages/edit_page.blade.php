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
                                    <lable style="font-size:18px">รหัสแผนการลงทุน</lable>
                                    <label class="input">
                                        <input type="text" id="plan_id" disabled="disabled" style="background-color: #f1f1f1"  value="{{$editdata->PLAN_ID}}" name="plan_id" placeholder="รหัสแผนการลงทุน">
                                       </label>
                                </section>

                                <section>
                                    <lable style="font-size:18px">ชื่อแผนการลงทุน</lable>
                                    <label class="input">
                                        <input type="text" id="plan_name" value="{{$editdata->PLAN_NAME}}" name="plan_name" placeholder="ชื่อแผนการลงทุน">
                                         </label>
                                </section>




                                <header>
                                    สถานะ
                                </header>

                                <?php

                                $logno = "";
                                $logyes = "";

                                if($editdata->PLAN_ACTIVE_FLAG == "0"){
                                    $logyes = "checked";


                                }else{
                                    $logno = "checked";

                                }
                                //                                            $ret = ($user->PASSWORD_EXPIRE_DATE == "asda")


                                ?>
                                <section style="margin-top: 15px;margin-left: 20px;">
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" {{$logyes}} class="plan_status" name="plan_status" checked="" value="0">
                                            <i></i>เปิด</label>
                                        <label class="radio">
                                            <input type="radio" {{$logno}} class="plan_status" name="plan_status" value="1">
                                            <i></i>ปิด</label>

                                    </div>


                                </section>


                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <lable style="font-size:18px">สัดส่วนตราสารทุน (ขั้นต่ำ)</lable>
                                        <label class="input">
                                            <input type="text"  id="EQUITY_MIN" name="EQUITY_MIN" value="{{$editdata->EQUITY_MIN_PERCENTAGE}}" placeholder="สัดส่วนตราสารทุน (ขั้นต่ำ)  ">
                                             </label>
                                    </section>
                                    <section class="col col-6">
                                        <lable style="font-size:18px">สัดส่วนตราสารทุน (ขั้นสูง)</lable>
                                        <label class="input">
                                            <input type="text" id="EQUITY_MAX" name="EQUITY_MAX" value="{{$editdata->EQUITY_MAX_PERCENTAGE}}" placeholder="สัดส่วนตราสารทุน (ขั้นสูง)">
                                           </label>
                                    </section>
                                </div>

                                <div class="row">

                                    <section class="col col-6">
                                        <label class="input">
                                            <lable style="font-size:18px">สัดส่วนตราสารหนี้ (ขั้นต่ำ)</lable>
                                            <input type="text" id="DEBT_MIN" name="DEBT_MIN" value="{{$editdata->DEBT_MIN_PERCENTAGE}}" placeholder="สัดส่วนตราสารหนี้ (ขั้นต่ำ)">
                                             </label>
                                    </section>

                                    <section class="col col-6" id="expire_check">
                                        <lable style="font-size:18px">สัดส่วนตราสารหนี้ (ขั้นสูง)</lable>
                                        <label class="input state-success">
                                            <input type="text" id="DEBT_MAX" name="DEBT_MAX"  value="{{$editdata->DEBT_MAX_PERCENTAGE}}"class="mea_date_picker" placeholder="สัดส่วนตราสารหนี้ (ขั้นสูง)"   >
                                        </label>
                                    </section>
                                </div>



                            </fieldset>

                            <fieldset>


                                <div class="row">

                                    <section class="col col-6">
                                        <lable style="font-size:18px">วันที่เริ่มต้น</lable>
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="plan_start"  value="{{get_date_notime_en($editdata->PLAN_ACTIVE_DATE)}}" class="mea_date_picker" id="plan_start" placeholder="วันที่เริ่มต้น"  >
                                            <input type="hidden" id="hd_plan_start" value="{{get_date_sql($editdata->PLAN_ACTIVE_DATE)}}">
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <lable style="font-size:18px">วันที่สิ้นสุด</lable>
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="plan_end" value="{{get_date_notime_en($editdata->PLAN_EXPIRE_DATE)}}" class="mea_date_picker" id="plan_end" placeholder="วันที่สิ้นสุด" >
                                            <input type="hidden" id="hd_plan_end" value="{{get_date_sql($editdata->PLAN_EXPIRE_DATE)}}">

                                            {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                        </label>
                                    </section>
                                </div>


                            </fieldset>
                            <footer>
                                <button type="button" id=“btn_form” class="btn btn-primary">ส่งข้อมูล
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




            $("#btn_form").on('click',function(){

                var $registerForm = $("#smart-form-register").validate({

                    rules : {
                        plan_id : {
                            required : true,

                        },
                        plan_name : {
                            required : true

                        },
                        EQUITY_MIN : {
                            required : true,
                            number : true,
                        },
                        EQUITY_MAX : {
                            required : true,
                            number : true,
                        },
                        DEBT_MIN : {
                            required : true,
                            number : true,
                        },
                        DEBT_MAX : {
                            required : true,
                            number : true,
                        }


                    },

                    errorPlacement : function(error, element) {
                        error.insertAfter(element.parent());

//                    alert("error");
                    }
                });

                if($registerForm.valid()){
                    var plan_id = $("#plan_id").val();
                    var plan_name = $("#plan_name").val();
                    var EQUITY_MIN= $("#EQUITY_MIN").val();

                    var EQUITY_MAX= $("#EQUITY_MAX").val();
                    var DEBT_MIN= $("#DEBT_MIN").val();

                    var DEBT_MAX= $("#DEBT_MAX").val();
                    var plan_start= $("#hd_plan_start").val();
                    var plan_end= $("#hd_plan_end").val();

                    var plan_status =  $('input[name=plan_status]:checked').val();
//                                    $(".plan_status").val();
                    var jsondata = {
                        plan_id:plan_id,
                        plan_name :plan_name,
                        EQUITY_MIN:EQUITY_MIN,
                        EQUITY_MAX:EQUITY_MAX,
                        DEBT_MIN:DEBT_MIN,
                        DEBT_MAX:DEBT_MAX,
                        plan_start:plan_start,
                        plan_end:plan_end,
                        plan_status :plan_status
                    };


//                            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
                    MeaAjax(jsondata,"/admin/chooseplan/edits",function(data){
                        if(data.success){

                            AlertSuccess("บันทึกแผนการลงทุนเรียบร้อยแล้ว",function(){

                                window.location.href = "/admin/chooseplan/edit/" + plan_id;
                            });

                        }else {
                            Alert("",data.html,null,null);
                        }
                    });

                    return false;
                }

                return false;

            });

            meaDatepicker("plan_start","plan_end");

            meaDatepicker("plan_end");
//            meaDatepicker("comeback");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");

            var dd = $("#hd_plan_start").val();
            var todaya = new Date(dd);



            $("#plan_end").datepicker('option', 'minDate', todaya);


        });

    </script>

@stop