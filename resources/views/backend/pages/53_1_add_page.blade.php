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
                                    <label style="font-size: 18px">รหัสหมวดหมู่ข่าว</label>
                                    <label class="input">
                                        <input type="text" id="NEWS_CATE_ID" name="NEWS_CATE_ID" placeholder="รหัสหมวดหมู่ข่าว">
                                       </label>
                                </section>

                                <section>
                                    <label style="font-size: 18px">ชื่อหมวดหมู่ข่าว</label>
                                    <label class="input">
                                        <input type="text" id="NEWS_CATE_NAME" name="NEWS_CATE_NAME" placeholder="ชื่อหมวดหมู่ข่าว">
                                         </label>
                                </section>




                                <header>
                                    สถานะ
                                </header>

                                <section style="margin-top: 15px;margin-left: 20px;">
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" class="NEWS_CATE_FLAG" name="NEWS_CATE_FLAG" checked="" value="0">
                                            <i></i>เปิด</label>
                                        <label class="radio">
                                            <input type="radio" class="NEWS_CATE_FLAG" name="NEWS_CATE_FLAG" value="1">
                                            <i></i>ปิด</label>

                                    </div>


                                </section>


                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label style="font-size: 18px">เลือกเมนูหลัก</label>
                                        <label class="input">
                                            <select class="form-control" id="MENU_GROUP_ID" name="MENU_GROUP_ID">
                                                <option value="default">เลือกเมนูหลัก</option>
                                                @if($menugroup)

                                                    @foreach($menugroup as $item)
                                                        <option value="{{$item->MENU_GROUP_ID}}">{{$item->MENU_GROUP_NAME}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label style="font-size: 18px">เลือกเมนูย่อย</label>
                                        <label class="input">
                                          <select class="form-control" id="MENU_ID" name="MENU_ID">
                                              <option value="default">เลือกเมนูย่อย</option>

                                          </select>
                                        </label>
                                    </section>
                                </div>




                            </fieldset>



                            <fieldset>


                                <div class="row">

                                    <section class="col col-6">
                                        <label style="font-size: 18px">วันที่เริ่มต้น</label>
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="START_DATE"  class="mea_date_picker" id="START_DATE" placeholder="วันที่เริ่มต้น"  >
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label style="font-size: 18px">วันที่สิ้นสุด</label>
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="EXPIRE_DATE"  class="mea_date_picker" id="EXPIRE_DATE" placeholder="วันที่สิ้นสุด" >

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



            $("#MENU_GROUP_ID").on('change',function(){

                if($(this).val() != "default"){
                    var jsondata = {
                        MENU_GROUP_ID:$(this).val()
                    };

                    MeaAjax(jsondata,"menulist",function(data){

                        var ss= data;

                        var ret =  data.html;

                        var html = "";
                        for (var i = 0; i < ret.length; i++) {
                        html = html + "<option value='"+ret[i].MENU_ID+"'>"+ret[i].MENU_NAME+"</option>";

                        }
                        $("#MENU_ID").html("<option value='default'>เลือกเมนูย่อย</option>");


                        $("#MENU_ID").append(html);

                    });
                }

            });

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
                    NEWS_CATE_ID : {
                        required : true,

                    },
                    NEWS_CATE_NAME : {
                        required : true

                    },
                    MENU_GROUP_ID :{
                        valueNotEquals: "default"
                    },
                    MENU_ID :{
                        valueNotEquals: "default"
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

                                    var NEWS_CATE_ID = $("#NEWS_CATE_ID").val();
                                    var NEWS_CATE_NAME = $("#NEWS_CATE_NAME").val();
                                    var NEWS_CATE_FLAG= $(".NEWS_CATE_FLAG").val();

                                    var MENU_GROUP_ID= $("#MENU_GROUP_ID").val();
                                    var MENU_ID= $("#MENU_ID").val();

                                    var START_DATE= $("#hd_START_DATE").val();
                                    var EXPIRE_DATE= $("#hd_EXPIRE_DATE").val();



                                    var jsondata = {
                                        NEWS_CATE_ID:NEWS_CATE_ID,
                                        NEWS_CATE_NAME :NEWS_CATE_NAME,
                                        NEWS_CATE_FLAG:NEWS_CATE_FLAG,
                                        START_DATE:START_DATE,
                                        EXPIRE_DATE:EXPIRE_DATE,
                                        MENU_GROUP_ID :MENU_GROUP_ID,
                                        MENU_ID :MENU_ID
                                    };


//                            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
                                    MeaAjax(jsondata,"add",function(data){
                                        if(data.success){

                                            AlertSuccess("บันทึกหมวดหมู่ข่าวเรียบร้อยแล้ว",function(){

                                                window.location.href = "/admin/newstopic";
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




            meaDatepicker("START_DATE");

            meaDatepicker("EXPIRE_DATE");
//            meaDatepicker("comeback");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");




        });

    </script>

@stop