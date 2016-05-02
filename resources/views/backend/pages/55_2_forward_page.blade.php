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

                            <div class="smart-form">


                                <input type="hidden" id="INFM_ID" name="INFM_ID" value="{{$Topicdata->INFM_ID}}">
                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">อีเมล์ผู้รับ:</span>
                                            <input type="text"   id="INFM_EMAIL" value="" name="INFM_EMAIL" placeholder="อีเมล์ผู้รับ:">
                                        </label>
                                    </section>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">หัวเรื่องอีเมล์:</span>
                                            <input type="text"  id="INFM_topic" value="" name="INFM_topic" placeholder="หัวเรื่องอีเมล์:">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">รายละเอียด</span>


                                            <div class="summernote"></div>

                                            <input type="hidden" value='<p style="font-size: 20px">เรียนหน่วยงาน</p><p style="font-size: 24px">ตามที่ท่านสมาชิกได้สอบถามข้อมูล ดังข้อมูลอ้างอิงต่อไปนี้</p><p style="font-size: 18px"><strong>เลขที่อ้างอิงคำถาม :</strong> {{$Topicdata->INFM_ID}}</p><p style="font-size: 18px"><strong>วันที่สอบถาม : </strong>{{get_date($Topicdata->INFM_DATE) }}</p><div style="font-size: 18px"><p> <strong>รายละเอียดคำถาม : </strong></p><p>{{$Topicdata->INFM_DETAIL}}</p></div><br/><hr/><br/><br/><p style="font-size: 18px">กองทุนสำรองเลี้ยงชีพพนักงานการไฟฟ้านครหลวง ซึ่งจดทะเบียนแล้ว <br/>ขอความอนุเคราะห์ในการให้รายละเอียดข้อมูลคำตอบจากหน่วยงานของท่าน<br/> เพื่อความถูกต้องของข้อมูลในการชี้แจงสมาชิกกองทุนฯในลำดับต่อไป</p><br/><hr/><br/><p>......................................................<p><p style="font-size: 18px">ขอแสดงความนับถือ</p><p style="font-size: 20px">กองทุนสำรองเลี้ยงชีพพนักงานการไฟฟ้านครหลวง ซึงจดทะเบียนแล้ว</p>' id="hddata"/>
                                            {{--<textarea class="form-control summernote" style="font-size: 18px"  rows="20"   id="INFM_answser" name="INFM_answser"  >--}}


                                            {{--</textarea>--}}



                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">หมายเหตุ</span>
                                            <textarea class="form-control" style="font-size: 18px"  rows="5"  id="REMARK" name="REMARK" ></textarea>
                                            {{--<input type="text" id="FILE_NAME" name="FILE_NAME" placeholder="ชื่อหัวข้อข่าว">--}}
                                        </label>
                                    </section>
                                </fieldset>



                            </div>


                            <div class="smart-form">




                                <footer>
                                    <button type="submit"  class="btn btn-primary">ส่งข้อความ
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
    <script src="{{asset('backend/js/plugin/summernote/summernote.min.js')}}"></script>

    <script type="text/javascript">


        $(document).ready(function() {

            var ss = "<p style=\"font-size: 24px\">เรียนท่านสมาชิก</p><p style=\"font-size: 24px\">ตามที่ท่านสมาชิกได้สอบถามข้อมูล ดังข้อมูลอ้างอิงต่อไปนี้</p><p style=\"font-size: 20px\"><strong>เลขที่อ้างอิงคำถาม :</strong> {{$Topicdata->INFM_ID}}</p><p style=\"font-size: 20px\"><strong>วันที่สอบถาม : </strong>{{get_date($Topicdata->INFM_DATE) }}</p><div style=\"font-size: 20px\"><p> <strong>รายละเอียดคำถาม : </strong></p><p>{{$Topicdata->INFM_DETAIL}}</p><div style=\"font-size: 20px\"><p><strong>รายละเอียดคำถาม : </strong></p><p>{{$Topicdata->INFM_DETAIL}}</p></div><p>ส่วนตอบข้อมูล</p>";

            var ff = "<br/><br/><br/><br/><hr/><br/><p style=\"font-size:20px\">ขอแสดงความนับถือ</p><p style=\"font-size: 20px\">กองทุนสำรองเลี้ยงชีพพนักงานการไฟฟ้านครหลวง ซึงจดทะเบียนแล้ว</p>"





            var markupStr = 'hello world';
//            $('.summernote').summernote('code', markupStr);
            $('.summernote').summernote({
                enterHtml: '<p><br></p>' ,
                height : 400,
                focus : true,
                tabsize : 2,


//                toolbar: [
//                    // [groupName, [list of button]]
//                    ['style', ['bold', 'italic', 'underline', 'clear']],
//                    ['font', ['strikethrough', 'superscript', 'subscript']],
//                    ['fontsize', ['fontsize']],
//                    ['color', ['color']],
//                    ['para', ['ul', 'ol', 'paragraph']],
//                    ['height', ['height']]
//                ]

            });


            $('.summernote').code($("#hddata").val());



//            $('.summernote').summernote('code');

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            var $registerForm = $("#smart-form-register").validate({



                // Rules for form validation
                rules : {
                    INFM_EMAIL : {
                        required : true,
                        email : true
                    },
                    INFM_topic : {
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

                                    var INFM_ID = $("#INFM_ID").val();
                                    var INFM_EMAIL = $("#INFM_EMAIL").val();
                                    var INFM_topic = $("#INFM_topic").val();
                                    var Detail =  $('.summernote').code();
                                    var REMARK = $("#REMARK").val();



                                    dataimport.append('INFM_ID',INFM_ID);
                                    dataimport.append('INFM_EMAIL',INFM_EMAIL);
                                    dataimport.append('INFM_topic',INFM_topic);
                                    dataimport.append('Detail',Detail);
                                    dataimport.append('REMARK',REMARK);

                                    $.ajax({

                                        type: 'POST', // or post?
//                dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        url: '/admin/cmail/forward',
                                        data: dataimport,

                                        success: function(data){

                                            if(data.success){

                                                AlertSuccess("ส่งอีเมล์ ตอบกลับไปยังท่านสมาชิกเรียบร้อยแล้ว",function(){

                                                    window.location.href = "/admin/cmail";
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

                }
            });






        });

    </script>

@stop