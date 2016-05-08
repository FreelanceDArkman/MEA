@extends('backend.layouts.default')
@section('content')
<?php
$data = getmemulist();
$arrSidebar =getSideBar($data);
?>
        <!-- MAIN CONTENT -->
<div id="content">

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-table fa-fw "></i>

                {{getMenutitle($arrSidebar)}}
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <ul id="sparks" class="">

            </ul>
        </div>
    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">



        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false"
                     data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">
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
                        <div class="widget-body no-padding">

                            <div class="table-responsive">
                                <div class="result" style="width: 100%; padding: 10px;">
                                    <form action="" id="formadd" class="smart-form">
                                        <div class="list" style="margin-bottom: 10px; padding: 10px">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>

                                                    <th></th>

                                                    <th style="text-align: center">มูลค่าต่อหน่วย (บาท)</th>
                                                    <th style="text-align: center">มูลค่าทรัพย์สินสุทธิ (ล้านบาท)</th>
                                                    <th style="text-align: center">อัตราผลตอบแทนการลงทุนสะสม (%)</th>
                                                    <th style="text-align: center">ข้อมูล ณ วันที่</th>
                                                    <th style="text-align: center">action</th>
                                                </tr>
                                                <tbody>
                                                <tr>


                                                    <td><strong>นโยบายตราสารทุน</strong></td>
                                                    <td>
                                                        <section>
                                                            <label class="input">
                                                                <input type="text" id="NAV_UNIT_1" name="NAV_UNIT_1" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;"  />
                                                            </label>
                                                        </section>
                                                       </td>
                                                    <td>
                                                        <section>
                                                            <label class="input">
                                                        <input type="text" id="NAV_1" name="NAV_1" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" />
                                                            </label>
                                                        </section>
                                                    </td>
                                                    <td>
                                                        <section>
                                                            <label class="input">
                                                        <input type="text" id="RETURN_RATE_1" name="RETURN_RATE_1" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" />
                                                        </label>
    </section>
                                                    </td>

                                                    <td rowspan="2" style="text-align: center">

                                                        <section>
                                                            <label class="input">
                                                        <select  class="form-control" id="drop_day" name="drop_day">
                                                            <option selected="selected" value="default">เลือกวัน</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option>
                                                            <option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                                        </select>

                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="input">
                                                        <select  class="form-control" id="drop_month" name="drop_month">
                                                            <option selected="selected" value="default">เลือกเดือน</option><option value="1">ม.ค.</option><option value="2">ก.พ.</option><option value="3">มี.ค.</option><option value="4">เม.ย.</option><option value="5">พ.ค.</option><option value="6">มิ.ย.</option><option value="7">ก.ค.</option><option value="8">ส.ค.</option><option value="9">ก.ย.</option><option value="10">ต.ค.</option><option value="11">พ.ย.</option><option value="12">ธ.ค.</option>
                                                        </select>
                                                            </label>
                                                        </section>
                                                                <section>
                                                                    <label class="input">
                                                        <select  class="form-control" id="drop_year" name="drop_year">
                                                            <option selected="selected" value="default">เลือกปี</option><option value="2015">2558</option><option value="2016">2559</option><option value="2017">2560</option><option value="2018">2561</option>
                                                            <option value="2019">2562</option><option value="2020">2563</option><option value="2021">2564</option>
                                                        </select>
                                                                    </label>
                                                                </section>

                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle;text-align: center">
                                                        <a href="#" id="btn_save" class="btn btn-primary btn-xs">บันทึก</a>


                                                    </td>
                                                </tr>
                                                <tr>

                                                    {{--background: #f0fff0;--}}
                                                    {{--border-color: #7DC27D;--}}
                                                    {{--background: #fff0f0;--}}
                                                    {{--border-color: #A90329;--}}

                                                    <td> <strong>นโยบายตราสารหนี้</strong></td>
                                                    <td>
                                                        <section>
                                                            <label class="input">
                                                        <input type="text" id="NAV_UNIT_2" name="NAV_UNIT_2" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" />
                                                            </label>
                                                        </section>
                                                    </td>
                                                    <td>

                                                        <section>
                                                            <label class="input">
                                                                <input type="text" id="NAV_2" name="NAV_2"  class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" />
                                                            </label>
                                                        </section>
                                                    </td>
                                                    <td>
                                                        <section>
                                                            <label class="input">
                                                        <input type="text" id="RETURN_RATE_2" name="RETURN_RATE_2" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" />
                                                            </label>
                                                        </section>
                                                    </td>



                                                </tr>
                                                </tbody>
                                                </thead>

                                            </table>
                                        </div>
                                    </form>

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

        <!-- end row -->

        <!-- end row -->

    </section>
    <!-- end widget grid -->


</div>
<!-- END MAIN CONTENT -->


<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{asset('backend/js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>

<script type="text/javascript">




    $(document).ready(function() {

        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg != value;
        }, "Please Choose one");

//        MENU_GROUP_ID :{
//            valueNotEquals: "default"
//        },
        $("#formadd").validate({
            rules: {

                drop_day: {
                    valueNotEquals: "default"
                },
                drop_month: {
                    valueNotEquals: "default"
                },
                drop_year: {
                    valueNotEquals: "default"
                },
                NAV_UNIT_1: {
                    required: true,
                    number: true
                },
                NAV_1: {
                    required: true,
                    number: true
                },
                RETURN_RATE_1 :{
                    required: true,
                    number: true
                },
                NAV_UNIT_2 :{
                    required: true,
                    number: true
                },
                NAV_2 :{
                    required: true,
                    number: true
                },
                RETURN_RATE_2 :{
                    required: true,
                    number: true
                }

            },
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());

//                    alert("error");
            }
        });


        $("#btn_save").on('click',function(){


            var drop_day = $("#drop_day").val();
            var drop_month = $("#drop_month").val();
            var drop_year = $("#drop_year").val();
            var NAV_UNIT_1 = $("#NAV_UNIT_1").val();
            var NAV_1 = $("#NAV_1").val();
            var RETURN_RATE_1 = $("#RETURN_RATE_1").val();
            var NAV_UNIT_2 = $("#NAV_UNIT_2").val();
            var NAV_2 = $("#NAV_2").val();
            var RETURN_RATE_2 = $("#RETURN_RATE_2").val();

            if($("#formadd").valid()){


                var json = {
                    drop_day:drop_day,
                    drop_month:drop_month,
                    drop_year:drop_year,
                    NAV_UNIT_1:NAV_UNIT_1,
                    NAV_1:NAV_1,
                    RETURN_RATE_1:RETURN_RATE_1,
                    NAV_UNIT_2:NAV_UNIT_2,
                    NAV_2:NAV_2,
                    RETURN_RATE_2:RETURN_RATE_2


                }

                MeaAjax(json,"/admin/nav/addsave",function(data){
                    if(data.success){
                        AlertSuccess("บันทึกเรียบร้อยแล้ว",function(){
                            window.location.href = "/admin/nav";
                        });
                    }
                });
            }

            return false;
        });

    })

</script>

@stop