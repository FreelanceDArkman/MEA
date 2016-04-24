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
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" id="plan_id" name="plan_id" placeholder="รหัสแผนการลงทุน">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" id="plan_name" name="plan_name" placeholder="ชื่อแผนการลงทุน">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>




                                <header>
                                    สถานะ
                                </header>

                                <section style="margin-top: 15px;margin-left: 20px;">
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" class="plan_status" name="plan_status" checked="" value="0">
                                            <i></i>เปิด</label>
                                        <label class="radio">
                                            <input type="radio" class="plan_status" name="plan_status" value="1">
                                            <i></i>ปิด</label>

                                    </div>


                                </section>


                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input">
                                            <input type="text"  id="EQUITY_MIN" name="EQUITY_MIN" placeholder="สัดส่วนตราสารทุน (ขั้นต่ำ)  ">
                                             </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input">
                                            <input type="text" id="EQUITY_MAX" name="EQUITY_MAX" placeholder="สัดส่วนตราสารทุน (ขั้นสูง)">
                                           </label>
                                    </section>
                                </div>

                                <div class="row">

                                    <section class="col col-6">
                                        <label class="input">
                                            <input type="text" id="DEBT_MIN" name="DEBT_MIN" placeholder="สัดส่วนตราสารหนี้ (ขั้นต่ำ)">
                                             </label>
                                    </section>

                                    <section class="col col-6" id="expire_check">
                                        <label class="input state-success">
                                            <input type="text" id="DEBT_MAX" name="DEBT_MAX"  class="mea_date_picker" placeholder="สัดส่วนตราสารหนี้ (ขั้นสูง)"   >
                                        </label>
                                    </section>
                                </div>



                            </fieldset>

                            <fieldset>


                                <div class="row">

                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="plan_start"  class="mea_date_picker" id="plan_start" placeholder="วันที่เริ่มต้น"  >
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="plan_end"  class="mea_date_picker" id="plan_end" placeholder="วันที่สิ้นสุด" >

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

                                    var plan_id = $("#plan_id").val();
                                    var plan_name = $("#plan_name").val();
                                    var EQUITY_MIN= $("#EQUITY_MIN").val();

                                    var EQUITY_MAX= $("#EQUITY_MAX").val();
                                    var DEBT_MIN= $("#DEBT_MIN").val();

                                    var DEBT_MAX= $("#DEBT_MAX").val();
                                    var plan_start= $("#hd_plan_start").val();
                                    var plan_end= $("#hd_plan_end").val();

                                    var plan_status = $(".plan_status").val();

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
                                    MeaAjax(jsondata,"add",function(data){
                                        if(data.success){

                                            AlertSuccess("บันทึกแผนการลงทุนเรียบร้อยแล้ว",function(){

                                                window.location.href = "/admin/chooseplan";
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




            meaDatepicker("plan_start");

            meaDatepicker("plan_end");
//            meaDatepicker("comeback");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");




        });

    </script>

@stop