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
                        <form id="smart-form-register" action="" style="margin-bottom: 20px"  >
                            {!! csrf_field() !!}
                            {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}


                            <div class="smart-form">



                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">รหัสหมวดหมู่</span>
                                            <input type="text" id="FAQ_CATE_ID" name="FAQ_CATE_ID" placeholder="รหัสหมวดหมู่">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">ชื่อหมวดหมู่</span>
                                            <input type="text" id="FAQ_CATE_NAME" name="FAQ_CATE_NAME" placeholder="ชื่อหมวดหมู่">
                                        </label>
                                    </section>
                                </fieldset>

                            </div>








                            <div class="smart-form">

                                <fieldset>





                                    <header>
                                        สถานะ
                                    </header>

                                    <section style="margin-top: 15px;margin-left: 20px;">
                                        <div class="inline-group">
                                            <label class="radio">
                                                <input type="radio" class="FAQ_CATE_FLAG" name="FAQ_CATE_FLAG" checked="" value="0">
                                                <i></i>เปิด</label>
                                            <label class="radio">
                                                <input type="radio" class="FAQ_CATE_FLAG" name="FAQ_CATE_FLAG" value="1">
                                                <i></i>ปิด</label>

                                        </div>


                                    </section>


                                </fieldset>


                                <fieldset>

                                        <section >
                                            <span style="font-size: 20px;color: #3276b1;">รูปแบบ: Keyword1|Keyword2|Keyword3|Keyword4 <br/>ตัวอย่างเช่น
                                            <label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>  </span>
                                            <label class="input">


                                                <input type="text" id="FAQ_CATE_KEYWORD" name="FAQ_CATE_KEYWORD" placeholder="คีย์เวิร์ดในการค้นหา ข้อมูล">
                                            </label>
                                        </section>






                                </fieldset>



                                <fieldset>


                                    <div class="row">



                                        <section class="col col-6">
                                            <span style="font-size: 18px">วันที่เริ่มต้น</span>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>

                                                <input type="text" name="START_DATE"  class="mea_date_picker" id="START_DATE" placeholder="วันที่เริ่มต้น"  >
                                            </label>
                                        </section>

                                        <section class="col col-6">
                                            <span style="font-size: 18px">วันที่สิ้นสุด</span>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="EXPIRE_DATE"  class="mea_date_picker" id="EXPIRE_DATE" placeholder="วันที่สิ้นสุด" >

                                                {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">



                                        <section class="col col-6">
                                            <span style="font-size: 18px">หน่วยงานติดต่อ</span>
                                            <label class="input">

                                                <input type="text" name="FAQ_CONTACT_DEPT"  id="FAQ_CONTACT_DEPT" placeholder="หน่วยงานติดต่อ"  >
                                            </label>
                                        </section>

                                        <section class="col col-6">
                                            <span style="font-size: 18px">หมายเลขติดต่อ</span>
                                            <label class="input">
                                                <input type="text" name="FAQ_CONTACT_PHONE"   id="FAQ_CONTACT_PHONE" placeholder="หมายเลขติดต่อ" >

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
                            </div>





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
    {{--<script src="{{asset('backend/js/plugin/summernote/summernote.min.js')}}"></script>--}}

    <script type="text/javascript">





        $(document).ready(function() {



            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            var $registerForm = $("#smart-form-register").validate({



                // Rules for form validation
                rules : {
                    FAQ_CATE_ID : {
                        required : true,
                        number : true

                    },
                    FAQ_CATE_NAME : {
                        required : true

                    },
                    FAQ_CATE_KEYWORD : {
                        required : true
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

                                    var FAQ_CATE_ID = $("#FAQ_CATE_ID").val();
                                    var FAQ_CATE_NAME = $("#FAQ_CATE_NAME").val();


                                    var FAQ_CATE_FLAG = $('input[name=FAQ_CATE_FLAG]:checked').val();
                                    var START_DATE= $("#hd_START_DATE").val();
                                    var EXPIRE_DATE= $("#hd_EXPIRE_DATE").val();

                                    var FAQ_CATE_KEYWORD = $("#FAQ_CATE_KEYWORD").val();

                                    var FAQ_CONTACT_DEPT = $("#FAQ_CONTACT_DEPT").val();
                                    var FAQ_CONTACT_PHONE = $("#FAQ_CONTACT_PHONE").val();




                                    dataimport.append('FAQ_CATE_ID',FAQ_CATE_ID);
                                    dataimport.append('FAQ_CATE_NAME',FAQ_CATE_NAME);
                                    dataimport.append('FAQ_CATE_FLAG',FAQ_CATE_FLAG);
                                    dataimport.append('START_DATE',START_DATE);
                                    dataimport.append('EXPIRE_DATE',EXPIRE_DATE);
                                    dataimport.append('FAQ_CATE_KEYWORD',FAQ_CATE_KEYWORD);
                                    dataimport.append('FAQ_CONTACT_DEPT',FAQ_CONTACT_DEPT);
                                    dataimport.append('FAQ_CONTACT_PHONE',FAQ_CONTACT_PHONE);


                                    $.ajax({

                                        type: 'POST', // or post?
//                dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        url: 'add',
                                        data: dataimport,

                                        success: function(data){

                                            if(data.success){

                                                AlertSuccess("บันทึกหมวดหมู่ถามตอบเรียบร้อยแล้ว",function(){

                                                    window.location.href = "/admin/faqcate";
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




            meaDatepicker("START_DATE","EXPIRE_DATE");

            meaDatepicker("EXPIRE_DATE");





        });

    </script>

@stop