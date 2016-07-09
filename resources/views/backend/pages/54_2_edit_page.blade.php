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
                                            <span style="font-size: 24px">เลือกหมวดหมู่ถาม-ตอบ</span>
                                            <select class="form-control" id="NEWS_CATE_ID_select" name="NEWS_CATE_ID_select">
                                                @foreach($menucate as $item)
                                                    @if($item->FAQ_CATE_ID == $Topicdata->FAQ_CATE_ID)
                                                    <option selected="selected" value="{{$item->FAQ_CATE_ID}}">{{$item->FAQ_CATE_NAME}}</option>
                                                    @else
                                                        <option value="{{$item->FAQ_CATE_ID}}">{{$item->FAQ_CATE_NAME}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </label></section>
                                </fieldset>

                            </div>

                            <div class="smart-form">

                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">รหัสคำถาม</span>
                                            <input type="text" style="background-color: #f1f1f1;" disabled="disabled" value="{{$Topicdata->FAQ_QUESTION_ID}}" id="FAQ_QUESTION_ID" value="" name="FAQ_QUESTION_ID" placeholder="รหัสหัวข้อข่าว">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">รายละเอียดคำถาม</span>
                                            <textarea class="form-control" style="font-size: 18px"  rows="10"  id="FAQ_QUESTION_DETAIL" name="FAQ_QUESTION_DETAIL" >{{$Topicdata->FAQ_QUESTION_DETAIL}}</textarea>
                                            {{--<input type="text" id="FILE_NAME" name="FILE_NAME" placeholder="ชื่อหัวข้อข่าว">--}}
                                        </label>
                                    </section>
                                </fieldset>

                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">รหัสคำตอบ</span>
                                            <input type="text" id="FAQ_ANSWER_ID" style="background-color: #f1f1f1;" value="{{$Topicdata->FAQ_ANSWER_ID}}" disabled="disabled" name="FAQ_ANSWER_ID" placeholder="รหัสหัวข้อข่าว">
                                        </label>
                                    </section>


                                </fieldset>

                            </div>

                            {{--<section>--}}
                                {{--<label class="input">--}}
                                    {{--<span style="font-size: 18px">รายละเอียดคำตอบ</span>--}}
                                    {{--<textarea class="form-control"  rows="10" style="font-size: 18px" id="FAQ_ANSWER_DETAIL" name="FAQ_ANSWER_DETAIL" >{{$Topicdata->FAQ_ANSWER_DETAIL}}</textarea>--}}
                                {{--</label>--}}
                            {{--</section>--}}
                            <div id="editor" style="padding:15px;">
                                <header>
                                    รายละเอียดคำตอบ
                                </header>

                                <div  style="border: 1px solid #BDBDBD">


                                    <div  id="FAQ_ANSWER_DETAIL" name="FAQ_ANSWER_DETAIL">{!! $Topicdata->FAQ_ANSWER_DETAIL!!}</div>
                                    {{--<div class="summernote"  >--}}

                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="smart-form">

                                <fieldset>

                                    <?php

                                    $logno = "";
                                    $logyes = "";

                                    if($Topicdata->FAQ_TOPIC_FLAG == "0"){
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
                                                <input type="radio" {{$logyes}}  class="FAQ_TOPIC_FLAG" name="FAQ_TOPIC_FLAG" checked="" value="0">
                                                <i></i>เปิด</label>
                                            <label class="radio">
                                                <input type="radio" {{$logno}} class="FAQ_TOPIC_FLAG" name="FAQ_TOPIC_FLAG" value="1">
                                                <i></i>ปิด</label>

                                        </div>


                                    </section>


                                </fieldset>


                                <fieldset>

                                    <section >
                                        <span style="font-size: 20px">คีย์เวิร์ดการค้นหา (คําถาม)</span><br/>
                                            <span style="font-size: 16px;color: #3276b1;">รูปแบบ: Keyword1|Keyword2|Keyword3|Keyword4 <br/>ตัวอย่างเช่น
                                            <label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>  </span>
                                        <label class="input">
                                            <input type="text" id="FAQ_QUESTION_KEYWORD" value="{{$Topicdata->FAQ_QUESTION_KEYWORD}}" name="FAQ_QUESTION_KEYWORD" placeholder="คีย์เวิร์ดในการค้นหา ข้อมูล">
                                        </label>
                                    </section>

                                </fieldset>
                                <fieldset>

                                    <section >
                                        <span style="font-size: 20px">คีย์เวิร์ดการค้นหา (คําตอบ)</span><br/>
                                            <span style="font-size: 16px;color: #3276b1;">รูปแบบ: Keyword1|Keyword2|Keyword3|Keyword4 <br/>ตัวอย่างเช่น
                                            <label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>  </span>
                                        <label class="input">


                                            <input type="text" id="FAQ_ANSWER_KEYWORD" value="{{$Topicdata->FAQ_ANSWER_KEYWORD}}" name="FAQ_ANSWER_KEYWORD" placeholder="คีย์เวิร์ดในการค้นหา ข้อมูล">
                                        </label>
                                    </section>






                                </fieldset>


                                <fieldset>


                                    <div class="row">



                                        <section class="col col-6">
                                            <span style="font-size: 18px">วันที่เริ่มต้น</span>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="START_DATE"  value="{{get_date_notime($Topicdata->START_DATE)}}" class="mea_date_picker" id="START_DATE" placeholder="วันที่เริ่มต้น"  >
                                                <input type="hidden" id="hd_START_DATE" value="{{get_date_sql($Topicdata->START_DATE)}}">
                                            </label>
                                        </section>

                                        <section class="col col-6">
                                            <span style="font-size: 18px">วันที่สิ้นสุด</span>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="EXPIRE_DATE"  value="{{get_date_notime($Topicdata->EXPIRE_DATE)}}" class="mea_date_picker" id="EXPIRE_DATE" placeholder="วันที่สิ้นสุด" >
                                                <input type="hidden" id="hd_EXPIRE_DATE" value="{{get_date_sql($Topicdata->EXPIRE_DATE)}}">
                                                {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                            </label>
                                        </section>
                                    </div>


                                </fieldset>



                                <footer>
                                    <button type="button"  id=“btn_form” class="btn btn-primary">ส่งข้อมูล
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


            $('#FAQ_ANSWER_DETAIL').summernote({
                enterHtml: '<p><br></p>' ,
                height : 400,
                focus : true,
                tabsize : 2,
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }




            });

            {{--$('#FAQ_ANSWER_DETAIL').code({!! $Topicdata->FAQ_ANSWER_DETAIL!!});--}}



            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");



            $("#btn_form").on('click',function(){


                var $registerForm = $("#smart-form-register").validate({

                    // Rules for form validation
                    rules : {
                        FAQ_QUESTION_ID : {
                            required : true,
                        },
                        FAQ_QUESTION_DETAIL : {
                            required : true
                        },
                        FAQ_ANSWER_ID : {
                            required : true,
                        },
                        FAQ_ANSWER_DETAIL : {
                            required : true,
                        },
                        FAQ_QUESTION_KEYWORD : {
                            required : true,
                        },
                        FAQ_ANSWER_KEYWORD : {
                            required : true,
                        },


                    },

                    errorPlacement : function(error, element) {
                        error.insertAfter(element.parent());

                    }
                });

                if($registerForm.valid()){

                    var dataimport = new FormData();

                    var FAQ_CATE_ID = $("#NEWS_CATE_ID_select").val();
                    var FAQ_QUESTION_ID = $("#FAQ_QUESTION_ID").val();
                    var FAQ_QUESTION_DETAIL= $("#FAQ_QUESTION_DETAIL").val();
                    var FAQ_ANSWER_ID= $("#FAQ_ANSWER_ID").val();
                    var FAQ_ANSWER_DETAIL= $("#FAQ_ANSWER_DETAIL").code();

                    var FAQ_TOPIC_FLAG =  $('input[name=FAQ_TOPIC_FLAG]:checked').val();
                    var START_DATE= $("#hd_START_DATE").val();
                    var EXPIRE_DATE= $("#hd_EXPIRE_DATE").val();

                    var FAQ_QUESTION_KEYWORD = $("#FAQ_QUESTION_KEYWORD").val();
                    var FAQ_ANSWER_KEYWORD = $("#FAQ_ANSWER_KEYWORD").val();



                    dataimport.append('FAQ_CATE_ID',FAQ_CATE_ID);
                    dataimport.append('FAQ_QUESTION_ID',FAQ_QUESTION_ID);
                    dataimport.append('FAQ_QUESTION_DETAIL',FAQ_QUESTION_DETAIL);
                    dataimport.append('FAQ_ANSWER_ID',FAQ_ANSWER_ID);
                    dataimport.append('FAQ_ANSWER_DETAIL',FAQ_ANSWER_DETAIL);
                    dataimport.append('FAQ_TOPIC_FLAG',FAQ_TOPIC_FLAG);
                    dataimport.append('START_DATE',START_DATE);
                    dataimport.append('EXPIRE_DATE',EXPIRE_DATE);

                    dataimport.append('FAQ_QUESTION_KEYWORD',FAQ_QUESTION_KEYWORD);
                    dataimport.append('FAQ_ANSWER_KEYWORD',FAQ_ANSWER_KEYWORD);



                    $.ajax({

                        type: 'POST', // or post?
//                dataType: 'json',
                        contentType: false,
                        processData: false,
                        url: '/admin/faqtopic/edits',
                        data: dataimport,

                        success: function(data){

                            if(data.success){

                                AlertSuccess("บันทึกหัวข้อถาม-ตอบเรียบร้อยแล้ว",function(){

                                    window.location.href = "/admin/faqtopic";
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
                return false;

            });


            meaDatepicker("START_DATE","EXPIRE_DATE");

            meaDatepicker("EXPIRE_DATE");


            var dd = $("#hd_START_DATE").val();
            var todaya = new Date(dd);



            $("#EXPIRE_DATE").datepicker('option', 'minDate', todaya);


        });

    </script>

@stop