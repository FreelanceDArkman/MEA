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
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body ">
                    {{--action="{{action('UserController@postAddUser') }}"--}}
                    <form id="smart-form-register" enctype="multipart/form-data" method="post" action="{{action('C53_2Controller@postAdd')}}" style="margin-bottom: 20px"  >
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
                                                <option value="{{$item->NEWS_CATE_ID}}">{{$item->NEWS_CATE_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </label></section>
                            </fieldset>

                        </div>

                        <div class="smart-form">



                            <fieldset>
                                {{--<section>--}}

                                {{--<label class="input">--}}
                                {{--<span style="font-size: 18px">รหัสหัวข้อข่าว</span>--}}
                                {{--<input type="text" id="NEWS_TOPIC_ID" name="NEWS_TOPIC_ID" placeholder="รหัสหัวข้อข่าว">--}}
                                {{--</label>--}}
                                {{--</section>--}}

                                <section>
                                    <label class="input">
                                        <span style="font-size: 18px">ชื่อหัวข้อข่าว</span>
                                        <input type="text" id="FILE_NAME" name="FILE_NAME" placeholder="ชื่อหัวข้อข่าว">
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
                                    <span style="font-size: 20px;color: #3276b1;">รูปแบบไฟล์ : เป็นไฟล์นามสกุล PDF เท่านั้น</span>
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

                                <input type="hidden" name="NEWS_TOPIC_DETAIL" id="NEWS_TOPIC_DETAIL" />
                                <textarea class="summernote" name="summernote"></textarea>

                                {{--<iframe id='my_iframe' name='my_iframe' style="display: none;" src="">--}}
                                {{--</iframe>--}}
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
                                    <span style="font-size: 20px;color: #3276b1;">รูปแบบไฟล์ : เเป็นไฟล์ภาพ นามสกุล JPG ขนาด 350x230 pixel เท่านั้น</span>
                                    {{--<label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>--}}
                                    <label class="input">
                                        <input type="file" class="btn btn-default" id="thumbnail" name="thumbnail">
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
                                            <input type="radio" class="NEWS_TOPIC_FLAG" name="NEWS_TOPIC_FLAG" checked="" value="0">
                                            <i></i>เปิด</label>
                                        <label class="radio">
                                            <input type="radio" class="NEWS_TOPIC_FLAG" name="NEWS_TOPIC_FLAG" value="1">
                                            <i></i>ปิด</label>

                                    </div>


                                </section>


                            </fieldset>


                            <fieldset>

                                <section >
                                            <span style="font-size: 20px;color: #3276b1;">รูปแบบ: Keyword1|Keyword2|Keyword3|Keyword4 <br/>ตัวอย่างเช่น
                                            <label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>  </span>
                                    <label class="input">


                                        <input type="text" id="NEWS_TOPIC_KEYWORD" name="NEWS_TOPIC_KEYWORD" placeholder="คีย์เวิร์ดในการค้นหา ข้อมูล">
                                    </label>
                                </section>



                            </fieldset>



                            <fieldset>


                                <div class="row">



                                    <section class="col col-6">
                                        <label style="font-size: 18px">วันที่เริ่มต้น</label>
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            {{--<span style="font-size: 18px">รหัสหัวข้อข่าว</span>--}}

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

                            {{--//notic pan--}}

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
                                        <span style="font-size: 18px">ข้อความที่ต้องการส่ง (ความยาวไม่เกิน 88 ตัวอักษร สำหรับข้อความภาษาไทย)</span>
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
                                <button type="button" id="btn_form" class="btn btn-primary">ส่งข้อมูล
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
                url: "imageupload",
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



            Checkoncontentinput($("#NEWS_CATE_ID_select").val());

            $("#NEWS_CATE_ID_select").on('change',function(){
                var catVal = $(this).val();
                Checkoncontentinput(catVal);



            });

            meaDatepicker("START_DATE","EXPIRE_DATE");

            meaDatepicker("EXPIRE_DATE");


            meaDatepicker("Notice_start_DATE","Notice_End_DATE");
            meaDatepicker("Notice_End_DATE");

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            $("#smart-form-register").validate({

                rules : {

                    FILE_NAME : {
                        required : true
                    }
                },
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

                }
            });

            $("#btn_form").on('click',function(){



                if($("#smart-form-register").valid()){


                    $("#NEWS_TOPIC_DETAIL").val($('.summernote').code());

                    $("#smart-form-register").submit();



                    <!-- widget div-->


                    <!-- widget edit box -->

                    return false;


                }

                return false;

            });


        });

        function update_professional_details(){
            var options = {
                url     : 'add',
                type    : 'POST',
                dataType: 'json',
                beforeSubmit: function ($form,$option) {

                    $.each($form, function (i, obj) {
                        if (obj != null) {
//                            if (obj.name == "START_DATE" || obj.name == "EXPIRE_DATE")
//                                delete $form[i]; //delete the elements which are not required.
                        }
                    });

//                    $form.push("",$('.summernote').code());

                    $form.push({name:"NEWS_TOPIC_DETAIL",value:$('.summernote').code()});

                    var filesPDF = $("#importpdf").get(0).files;

                    var filethumbnail = $("#thumbnail").get(0).files;

                    if (filesPDF != null && filesPDF != "undefined")  {
                        $form.push({name:"filesPDF",value:filesPDF[0]});

                    }
                    if (filethumbnail != null && filesPDF != "undefined") {
                        $form.push({name:"filethumbnail",value:filethumbnail[0]});

                    }
                    //formData.clean(undefined);//remove deleted elements
                },
                success:function( data ) {

                    if(data.success){

                        AlertSuccess("บันทึกหัวข้อข่าวเรียบร้อยแล้ว",function(){

                            window.location.href = "/admin/news";
                        });

                    }else {
                        Alert("",data.html,null,null);
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert(xhr.responseText);
            }
            };
            $('#smart-form-register').ajaxSubmit(options);
            return false;
        }

    </script>

@stop