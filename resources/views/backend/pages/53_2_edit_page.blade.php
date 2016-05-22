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
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            <div class="smart-form">
                                <fieldset>
                                    <section>
                                        <label class="input">
                                            <span style="font-size: 24px">เลือกหมวดหมู่ข่าว</span>
                                                <select class="form-control" id="NEWS_CATE_ID_select" name="NEWS_CATE_ID_select">
                                                    @foreach($menucate as $item)
                                                        @if($item->NEWS_CATE_ID == $Topicdata->NEWS_CATE_ID)
                                                        <option selected="selected" value="{{$item->NEWS_CATE_ID}}">{{$item->NEWS_CATE_NAME}}</option>
                                                            @else
                                                            <option  value="{{$item->NEWS_CATE_ID}}">{{$item->NEWS_CATE_NAME}}</option>
                                                        @endif
                                                     @endforeach
                                                </select>
                                        </label></section>
                                </fieldset>
                                
                            </div>

                            <div class="smart-form">



                                <fieldset>
                                    <section style="display: none">

                                        <label class="input">
                                            <span style="font-size: 18px">รหัสหัวข้อข่าว</span>
                                            <input type="text" id="NEWS_TOPIC_ID" style="background-color: #f1f1f1;" disabled="disabled" value="{{$Topicdata->NEWS_TOPIC_ID}}" name="NEWS_TOPIC_ID" placeholder="รหัสหัวข้อข่าว">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">ชื่อหัวข้อข่าว</span>
                                            <input type="text" id="FILE_NAME" value="{{$Topicdata->FILE_NAME}}" name="FILE_NAME" placeholder="ชื่อหัวข้อข่าว">
                                        </label>
                                    </section>
                                </fieldset>

                            </div>

                            <div class="smart-form" id="pdf">

                                <fieldset>
                                    <header>
                                        แนบไฟล์
                                    </header>
                                    <section style="margin-top: 15px;margin-left: 20px;">
                                        <span style="font-size: 20px;color: #3276b1;">รูปแบบไฟล์ : เป็นไฟล์ภาพ สกุล PDF เท่านั้น </span>
                                        <label class="input">
                                            <input type="file" class="btn btn-default" id="importpdf" name="importpdf">
                                        </label>
                                    </section>


                                </fieldset>

                            </div>
                            <div id="editor" style="padding:15px;display: none;">
                                <header>
                                    รายละเอียด
                                </header>
                                <span style="font-size: 20px;color: #3276b1;">กรณีขึ้นบรรทัดใหม่ ให้กด : Shift + Enter </span><br/>
                                <span style="font-size: 20px;color: #3276b1;">กรณีขึ้นย่อหน้าใหม่: Enter </span>
                                <div  style="border: 1px solid #BDBDBD">


                                    <textarea class="summernote" name="summernote">{{$Topicdata->NEWS_TOPIC_DETAIL}}</textarea>
                                    {{--<div class="summernote"  >--}}

                                    {{--</div>--}}
                                </div>
                            </div>



                            <div class="smart-form" id="thunb" style="display: none;">

                                <fieldset>
                                    <header>
                                        Thumbnail
                                    </header>
                                    <section style="margin-top: 15px;margin-left: 20px;">
                                         <span style="font-size: 20px;color: #3276b1;">รูปแบบไฟล์ : เป็นไฟล์ภาพ สกุล JPG เท่านั้น </span>
                                            {{--<label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>--}}
                                        <label class="input">
                                            <input type="file" class="btn btn-default" id="thumbnail" name="thumbnail">
                                        </label>
                                    </section>


                                </fieldset>

                            </div>

                            <div class="smart-form">

                                <fieldset>



                                    <?php

                                    $logno = "";
                                    $logyes = "";

                                    if($Topicdata->NEWS_TOPIC_FLAG == "0"){
                                        $logyes = "checked";


                                    }else{
                                        $logno = "checked";

                                    }
                                    //                                            $ret = ($user->PASSWORD_EXPIRE_DATE == "asda")


                                    ?>

                                    <header>
                                        สถานะ
                                    </header>

                                    <section style="margin-top: 15px;margin-left: 20px;">
                                        <div class="inline-group">
                                            <label class="radio">
                                                <input type="radio" {{$logyes}} class="NEWS_TOPIC_FLAG" name="NEWS_TOPIC_FLAG" checked="" value="0">
                                                <i></i>เปิด</label>
                                            <label class="radio">
                                                <input type="radio" {{$logno}}  class="NEWS_TOPIC_FLAG" name="NEWS_TOPIC_FLAG" value="1">
                                                <i></i>ปิด</label>

                                        </div>


                                    </section>


                                </fieldset>


                                <fieldset>

                                        <section >
                                            <span style="font-size: 20px;color: #3276b1;">รูปแบบ: Keyword1|Keyword2|Keyword3|Keyword4 <br/>ตัวอย่างเช่น
                                            <label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>  </span>
                                            <label class="input">


                                                <input type="text" id="NEWS_TOPIC_KEYWORD" value="{{$Topicdata->NEWS_TOPIC_KEYWORD}}" name="NEWS_TOPIC_KEYWORD" placeholder="คีย์เวิร์ดในการค้นหา ข้อมูล">
                                            </label>
                                        </section>






                                </fieldset>



                                <fieldset>


                                    <div class="row">
                                        <section class="col col-6">
                                            <span style="font-size: 18px">วันที่เริ่มต้น</span>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>

                                                <input type="text" name="START_DATE"  value="{{get_date_notime_en($Topicdata->START_DATE)}}" class="mea_date_picker" id="START_DATE" placeholder="วันที่เริ่มต้น"  >
                                                <input type="hidden" id="hd_START_DATE" value="{{get_date_sql($Topicdata->START_DATE)}}">
                                            </label>
                                        </section>

                                        <section class="col col-6">
                                            <span style="font-size: 18px">วันที่สิ้นสุด</span>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="EXPIRE_DATE"  value="{{get_date_notime_en($Topicdata->EXPIRE_DATE)}}" class="mea_date_picker" id="EXPIRE_DATE" placeholder="วันที่สิ้นสุด" >
                                                <input type="hidden" id="hd_EXPIRE_DATE" value="{{get_date_sql($Topicdata->EXPIRE_DATE)}}">

                                                {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                            </label>
                                        </section>
                                    </div>


                                </fieldset>

                                <fieldset>

                                    <header>
                                        ท่านต้องการส่ง Notification หรือไม่
                                    </header>

                                    <section style="margin-top: 15px;margin-left: 20px;">
                                        <div class="inline-group">
                                            <label class="radio">
                                                <input type="radio" class="Notice" name="Notice"  value="0">
                                                <i></i>ใช่</label>
                                            <label class="radio">
                                                <input type="radio" checked="checked" class="Notice" name="Notice" value="1">
                                                <i></i>ไม่</label>

                                        </div>


                                    </section>


                                </fieldset>
                                <fieldset id="noti_pan" style="display: none">

                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">ข้อความที่ต้องการส่ง</span>
                                            <input type="text" id="noti_message" name="noti_message" placeholder="ข้อความที่ต้องการส่ง">
                                        </label>
                                    </section>
                                    <div class="row">



                                        <section class="col col-6">
                                            <label style="font-size: 18px">วันที่เริ่มต้น</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                {{--<span style="font-size: 18px">รหัสหัวข้อข่าว</span>--}}

                                                <input type="text" name="Notice_start_DATE"  class="mea_date_picker" id="Notice_start_DATE" placeholder="วันที่เริ่มต้น"  >
                                            </label>
                                        </section>

                                        <section class="col col-6">
                                            <label style="font-size: 18px">วันที่สิ้นสุด</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="Notice_End_DATE"  class="mea_date_picker" id="Notice_End_DATE" placeholder="วันที่สิ้นสุด" >

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
    <script src="{{asset('backend/js/plugin/summernote/summernote.min.js')}}"></script>

    <script type="text/javascript">


        function  Checkoncontentinput(catVal){

            //                Download PDF: multiple
//
//                15,16,3,4,5,6,9,10,11,12,13,14
//
//                Content View (Rich box) optional to download or show content  : multiple
//                9,1,2
//                Content Only: Only one
//
//                7,8
            if( parseInt(catVal)  == 9 || parseInt(catVal)  == 1||parseInt(catVal)  == 2) {
                $("#editor").show();
                $("#thunb").show();
                $("#pdf").show();
            }
            else  if(parseInt(catVal)  == 7||parseInt(catVal)  == 8){
                $("#editor").show();
                $("#pdf").hide();

            }else {
                $("#editor").hide();
                $("#thunb").hide();
                $("#pdf").show();
            }
        }

        function sendFile(file, editor, welEditable) {
//            alert("adas");
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "/admin/news/imageupload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
//                    alert(data.url);
                    editor.insertImage(welEditable, data.url);
                }
            });
        }
        $(document).ready(function() {


            $(".Notice").on('click',function(){

                var val = $(this).val();

                if(val == 0){
                    $("#noti_pan").show();
                }else {
                    $("#noti_pan").hide();
                }

//                var style = $("#noti_pan").css("display");
//                if(style)
//                $("#noti_pan").slideToggle('fast');
            });

            $('.summernote').summernote({
                enterHtml: '<p><br></p>' ,
                height : 400,
                focus : false,
                tabsize : 2,
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }

            });

            //$('.summernote').summernote('formatPara');

            Checkoncontentinput($("#NEWS_CATE_ID_select").val());

            $("#NEWS_CATE_ID_select").on('change',function(){
                var catVal = $(this).val();
                Checkoncontentinput(catVal);

            });



            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            var $registerForm = $("#smart-form-register").validate({



                // Rules for form validation
                rules : {
                    NEWS_TOPIC_ID : {
                        required : true,

                    },
                    FILE_NAME : {
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

                                    var NEWS_CATE_ID = $("#NEWS_CATE_ID_select").val();
                                    var NEWS_TOPIC_ID = $("#NEWS_TOPIC_ID").val();
                                    var FILE_NAME= $("#FILE_NAME").val();

                                    var NEWS_TOPIC_FLAG =  $('input[name=NEWS_TOPIC_FLAG]:checked').val();
                                    var START_DATE= $("#hd_START_DATE").val();
                                    var EXPIRE_DATE= $("#hd_EXPIRE_DATE").val();

                                    var NEWS_TOPIC_KEYWORD = $("#NEWS_TOPIC_KEYWORD").val();

                                    var NEWS_TOPIC_DETAIL = $('.summernote').code();


                                    var Notice = $('input[name=Notice]:checked').val();
                                    var Notice_start_DATE = $("#hd_Notice_start_DATE").val();
                                    var Notice_End_DATE = $("#hd_Notice_End_DATE").val();
                                    var noti_message = $("#noti_message").val();


                                    dataimport.append('NEWS_CATE_ID',NEWS_CATE_ID);
                                    dataimport.append('NEWS_TOPIC_ID',NEWS_TOPIC_ID);
                                    dataimport.append('FILE_NAME',FILE_NAME);
                                    dataimport.append('NEWS_TOPIC_FLAG',NEWS_TOPIC_FLAG);
                                    dataimport.append('START_DATE',START_DATE);
                                    dataimport.append('EXPIRE_DATE',EXPIRE_DATE);
                                    dataimport.append('NEWS_TOPIC_DETAIL',NEWS_TOPIC_DETAIL);
                                    dataimport.append('NEWS_TOPIC_KEYWORD',NEWS_TOPIC_KEYWORD);


                                    dataimport.append('Notice',Notice);
                                    dataimport.append('Notice_start_DATE',Notice_start_DATE);
                                    dataimport.append('Notice_End_DATE',Notice_End_DATE);
                                    dataimport.append('noti_message',noti_message);

                                    var filesPDF = $("#importpdf").get(0).files;

                                    var filethumbnail = $("#thumbnail").get(0).files;

                                    if (filesPDF.length > 0) {
                                        dataimport.append("filesPDF", filesPDF[0]);
                                    }
                                    if (filethumbnail.length > 0) {
                                        dataimport.append("filethumbnail", filethumbnail[0]);
                                    }


//                                        alert(filesPDF);
                                    $.ajax({

                                        type: 'POST', // or post?
//                dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        url: '/admin/news/edits',
                                        data: dataimport,

                                        success: function(data){

                                            if(data.success){

                                                AlertSuccess("แก้ไขหัวข้อข่าวเรียบร้อยแล้ว",function(){

                                                    window.location.href = "/admin/news";
                                                });

                                            }else {
                                                Alert("",data.html,null,null);
                                            }

//                Alert('OK', "ข้อมูลได้ถูก update เรียบร้อยแล้ว");

                                        },
                                        error: function(xhr, textStatus, thrownError) {

                                        }
                                    });
//                            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
//                                    MeaAjax(jsondata,"add",function(data){
//                                        if(data.success){
//
//                                            AlertSuccess("บันทึกหมวดหมู่ข่าวเรียบร้อยแล้ว",function(){
//
//                                                window.location.href = "/admin/newstopic";
//                                            });
//
//                                        }else {
//                                            Alert("",data.html,null,null);
//                                        }
//                                    });

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

            meaDatepicker("Notice_start_DATE");
            meaDatepicker("Notice_End_DATE");
//            meaDatepicker("comeback");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");




        });

    </script>

@stop