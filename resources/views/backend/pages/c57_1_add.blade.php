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
                <li class="sparks-info">

                    <a href="{{action('C57_1Controller@getAdd')}}" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> เพิ่ม</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <div class="row">
            <div class="col-xs-12">
                <section style="float: left">
                    <label class="label" style="color:#333;font-size: 20px">เลือกช่วงที่ต้องการดู</label>
                    <label class="select">
                        <select id="drop_month_start" class="form-control" id="drop_month">
                            <option selected="selected" value="1">เลือกเดือน</option><option value="1">ม.ค.</option><option value="2">ก.พ.</option><option value="3">มี.ค.</option><option value="4">เม.ย.</option><option value="5">พ.ค.</option><option value="6">มิ.ย.</option><option value="7">ก.ค.</option><option value="8">ส.ค.</option><option value="9">ก.ย.</option><option value="10">ต.ค.</option><option value="11">พ.ย.</option><option value="12">ธ.ค.</option>
                        </select> <i></i> </label>

                    <label class="select">
                        <select id="drop_year_start" class="form-control" id="drop_year">
                            <option selected="selected" value="2001">เลือกปี</option><option value="2015">2558</option><option value="2016">2559</option><option value="2017">2560</option><option value="2018">2561</option>
                        </select> <i></i> </label>
                </section>
                <section style="float: left"> <label class="label" style="color:#333;font-size: 20px">ถึง</label></section>
                <section style="float: left">

                    <label class="select">
                        <select id="drop_month_end" class="form-control" id="drop_month">
                            <option selected="selected" value="12">เลือกเดือน</option><option value="1">ม.ค.</option><option value="2">ก.พ.</option><option value="3">มี.ค.</option><option value="4">เม.ย.</option><option value="5">พ.ค.</option><option value="6">มิ.ย.</option><option value="7">ก.ค.</option><option value="8">ส.ค.</option><option value="9">ก.ย.</option><option value="10">ต.ค.</option><option value="11">พ.ย.</option><option value="12">ธ.ค.</option>
                        </select> <i></i> </label>
                    <label class="select">
                        <select id="drop_year_end" class="form-control" id="drop_year">
                            <option selected="selected" value="9999">เลือกปี</option><option value="2015">2558</option><option value="2016">2559</option><option value="2017">2560</option><option value="2018">2561</option>
                        </select> <i></i> </label>
                </section>
                <section style="float: left;margin-left: 15px;">
                    <a href="#" id="search_click" class="btn btn-primary btn-xs">ค้นหา</a>
                </section>
            </div>
        </div>

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

                                    <div class="list" style="margin-bottom: 10px; padding: 10px">
                                        <p style="font-size: 20px;padding: 10px;text-align: center;width: 100%;background-color: #f1f1f1;border: 1px solid #E1E8F3">กรุณาเลือกช่วงที่ต้องการค้นหา</p>
                                    </div>
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


    function Render(data){
//        $("#all_data").hide();
        $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        $(".result").html(data.html);
        $(".result").fadeIn('300');

        $("#mainCheck").on("click",function(){$(".item_checked").not(this).prop('checked', this.checked);});

        $(".mea_delete_by").on('click',function(){

            var id = $(this).attr("data-id");
            $.SmartMessageBox({
                title : "Error!",
                content : "ท่านแน่ใจที่ต้องการจะลบ รายการที่ท่านเลือก",
                buttons : '[ยกเลิก][OK]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "OK") {

                    var plan_id = $("#plan_id").val();

                    var jsondata = {group_id : id,plan_id : plan_id};

                    $.ajax({

                        type: 'post', // or post?
                        dataType: 'json',
                        url: '/admin/newstopic/delete',
                        data: jsondata,

                        success: function(data) {

                            if(data.ret == "1"){
                                $.smallBox({
                                    title: "Congratulations! Your form was submitted",
                                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                                    color: "#5F895F",
                                    iconSmall: "fa fa-check bounce animated",
                                    timeout: 4000
                                });

                                window.location.href = '/admin/newstopic';
                            }



                        },
                        error: function(xhr, textStatus, thrownError) {
//                                alert(xhr.status);
//                                alert(thrownError);
//                                alert(textStatus);
                        }
                    });
                }
                if (ButtonPressed === "ยกเลิก") {

                }

            });

        });

        $("#mea_delete").on('click',function(){



            var checkcount = $(".item_checked:checked").length;


            if(checkcount > 0){
                var checked = "";
                $(".item_checked").each(function(){

                    if($(this).is(":checked")){
                        checked = checked + $(this).val() + ",";
                    }


                });
                var jsondata = {group_id : checked};

                $.ajax({

                    type: 'post', // or post?
                    dataType: 'json',
                    url: '/admin/newstopic/delete',
                    data: jsondata,

                    success: function(data) {

                        if(data.ret == "1"){
                            $.smallBox({
                                title: "Congratulations! Your form was submitted",
                                content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                                color: "#5F895F",
                                iconSmall: "fa fa-check bounce animated",
                                timeout: 4000
                            });

                            window.location.href = '/admin/newstopic';
                        }



                    },
                    error: function(xhr, textStatus, thrownError) {
//                                alert(xhr.status);
//                                alert(thrownError);
//                                alert(textStatus);
                    }
                });
            }else {
                $.SmartMessageBox({
                    title : "Error!",
                    content : "ท่านยังไม่ได้เลือกรายการ",
                    buttons : '[OK]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "OK") {


                    }
                    if (ButtonPressed === "No") {

                    }

                });
            }

        });

        $("#mea_edit").on('click',function(){

            var checkcount = $(".item_checked:checked").length;



            if(checkcount > 1 || checkcount  == 0){
                $.SmartMessageBox({
                    title : "Error!",
                    content : "ไม่สามารถแก้ไขได้ กรุณาเลือกรายการเพียงรายการเดียว",
                    buttons : '[OK]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "OK") {

                        return false;
                    }
                    if (ButtonPressed === "No") {

                    }

                });
            }else {
                window.location.href = "/admin/newstopic/edit/" + $(".item_checked:checked").val();
            }






        })
    }



    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        $("#search_click").on('click',function(){


            var jsondata = {pagesize : 20,PageNumber:1};

            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

            var drop_month_start = $("#drop_month_start").val();

            var drop_year_start = $("#drop_year_start").val();

            var drop_month_end = $("#drop_month_end").val();

            var drop_year_end = $("#drop_year_end").val();

            var json = {drop_month_start:drop_month_start,drop_year_start:drop_year_start,drop_month_end:drop_month_end,drop_year_end:drop_year_end};

            MeaAjax(json,"/admin/nav/getlist",function(data){

                $(".result").html(data.html);

            });

        });



    })

</script>

@stop