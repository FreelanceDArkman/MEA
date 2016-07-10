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
                        <form id="smart-form-register" enctype="multipart/form-data" method="post" action="{{action('C55_1Controller@postAdd')}}" style="margin-bottom: 20px"  >
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}


                            <div class="smart-form">



                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">รหัส</span>
                                            <input type="text" value="{{$location->LOCATION_ID}}" id="LOCATION_ID" name="LOCATION_ID" placeholder="รหัส">
                                        </label>
                                    </section>

                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">ชื่อหน่วยงาน</span>
                                            <input type="text" value="{{$location->LOCATION_NAME}}" id="LOCATION_NAME" name="LOCATION_NAME" placeholder="ชื่อหน่วยงาน">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">ที่ตั้ง</span>
                                            <textarea class="form-control" style="font-size: 18px" rows="5" id="LOCATION_ADDRESS" name="LOCATION_ADDRESS" >{{$location->LOCATION_ADDRESS}}</textarea>
                                            {{--<input type="text" id="FILE_NAME" name="FILE_NAME" placeholder="ชื่อหัวข้อข่าว">--}}
                                        </label>
                                    </section>
                                </fieldset>

                                <fieldset>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">ศูนย์บริการ</span>
                                            <input type="text" value="{{$location->LOCATION_SERVICE_CENTER}}" id="LOCATION_SERVICE_CENTER" name="LOCATION_SERVICE_CENTER" placeholder="ศูนย์บริการ">
                                        </label>
                                    </section>

                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">อีเมล์</span>
                                            <input type="text" value="{{$location->LOCATION_EMAIL}}" id="LOCATION_EMAIL" name="LOCATION_EMAIL" placeholder="อีเมล์">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <span style="font-size: 18px">การเดินทาง</span>
                                            <textarea class="form-control" style="font-size: 18px" value="{{$location->LOCATION_TRAVEL}}" rows="5" id="LOCATION_TRAVEL" name="LOCATION_TRAVEL" ></textarea>
                                            {{--<input type="text" id="FILE_NAME" name="FILE_NAME" placeholder="ชื่อหัวข้อข่าว">--}}
                                        </label>
                                    </section>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">ละติจูด</span>
                                            <input type="text" id="LOCATION_GPS_LAT" value="{{$location->LOCATION_GPS_LAT}}" name="LOCATION_GPS_LAT" placeholder="ละติจูด">
                                        </label>
                                    </section>
                                    <section>

                                        <label class="input">
                                            <span style="font-size: 18px">ลองติจูด</span>
                                            <input type="text" id="LOCATION_GPS_LNG" value="{{$location->LOCATION_GPS_LNG}}" name="LOCATION_GPS_LNG" placeholder="ลองติจูด">
                                        </label>
                                    </section>
                                </fieldset>


                                <fieldset>
                                    <header>
                                        แนบไฟล์ แผนที่
                                    </header>
                                    <section style="margin-top: 15px;margin-left: 20px;">
                                        @if($location->LOCATION_PIC)
                                        <a href="{{$location->LOCATION_PIC}}">แผนที่ คลิ๊ก >></a><br/>
                                        @endif
                                        <span style="font-size: 20px;color: #3276b1;">รูปแบบไฟล์ : เป็นไฟล์ภาพ สกุล PDF เท่านั้น </span>
                                        {{--<label style="color: darkred ;font-weight: bold">ข่าว|ประชาสัมพันธ์|กองทุน|ลงทุน|ความรู้ </label>--}}
                                        <label class="input">
                                            <input type="file" class="btn btn-default" id="mappdf" name="mappdf">
                                        </label>
                                    </section>


                                </fieldset>

                            </div>




                            <div class="smart-form">

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


        $(document).ready(function() {


            @if (Session::has('message'))
             AlertSuccess("บันทึกช่องทางติดต่อเรียบร้อยแล้ว",function(){



                // window.location.href = "/admin/news";
            });


            @endif

            <?php   Session::forget('message'); ?>

                $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            $("#smart-form-register").validate({



                // Rules for form validation
                rules : {
                    LOCATION_ID : {
                        required : true,
                        number:true
                    },
                    LOCATION_NAME : {
                        required : true
                    },
                    LOCATION_ADDRESS : {
                        required : true,
                    },
                    LOCATION_SERVICE_CENTER : {
                        required : true,
                    }

                },

                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());

//                    alert("error");
                }
            });


            $("#btn_form").on('click',function(){



                if($("#smart-form-register").valid()){



                    $("#smart-form-register").submit();
//                    var dataimport = new FormData();
//
//                    var LOCATION_ID = $("#LOCATION_ID").val();
//                    var LOCATION_NAME = $("#LOCATION_NAME").val();
//                    var LOCATION_ADDRESS= $("#LOCATION_ADDRESS").val();
//                    var LOCATION_SERVICE_CENTER= $("#LOCATION_SERVICE_CENTER").val();
//                    var LOCATION_EMAIL= $("#LOCATION_EMAIL").val();
//
//                    var LOCATION_TRAVEL= $("#LOCATION_TRAVEL").val();
//                    var LOCATION_GPS_LAT= $("#LOCATION_GPS_LAT").val();
//
//                    var LOCATION_GPS_LNG = $("#LOCATION_GPS_LNG").val();
//
//
//
//                    dataimport.append('LOCATION_ID',LOCATION_ID);
//                    dataimport.append('LOCATION_NAME',LOCATION_NAME);
//                    dataimport.append('LOCATION_ADDRESS',LOCATION_ADDRESS);
//                    dataimport.append('LOCATION_SERVICE_CENTER',LOCATION_SERVICE_CENTER);
//                    dataimport.append('LOCATION_EMAIL',LOCATION_EMAIL);
//                    dataimport.append('LOCATION_TRAVEL',LOCATION_TRAVEL);
//                    dataimport.append('LOCATION_GPS_LAT',LOCATION_GPS_LAT);
//                    dataimport.append('LOCATION_GPS_LNG',LOCATION_GPS_LNG);
//
//
//                    var filesPDF = $("#mappdf").get(0).files;
//
//
//                    if (filesPDF.length > 0) {
//                        dataimport.append("filesPDF", filesPDF[0]);
//                    }
//
//                    $.ajax({
//
//                        type: 'POST', // or post?
////                dataType: 'json',
//                        contentType: false,
//                        processData: false,
//                        url: '/admin/contact/add',
//                        data: dataimport,
//
//                        success: function(data){
//
//                            if(data.success){
//
//                                AlertSuccess("บันทึกช่องทางติดต่อเรียบร้อยแล้ว",function(){
//
//                                    window.location.href = "/admin/contact";
//                                });
//
//                            }else {
//                                Alert("",data.html,null,null);
//                            }
//
//
//
//                        },
//                        error: function(xhr, textStatus, thrownError) {
//
//                        }
//                    });


                    return false;
                }

                return false;

            });


            meaDatepicker("START_DATE","EXPIRE_DATE");

            meaDatepicker("EXPIRE_DATE");





        });

    </script>

@stop