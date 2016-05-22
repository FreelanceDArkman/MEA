@extends('backend.layouts.default')
@section('content')
<?php
$data = getmemulist();
$arrSidebar =getSideBar($data);
?>


<div id="content">

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-table fa-fw "></i>

                {{getMenutitle($arrSidebar)}}

            </h1>
        </div>

    </div>


    <div class="row" id="widget-grid" >

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-5" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false">
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
                    <ul class="nav nav-tabs pull-left in">

                        <li class="active">

                            <a data-toggle="tab" href="#hr1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> ระบุเงื่อนไขการค้นหา </span> </a>

                        </li>

                        <li>
                            <a data-toggle="tab" href="#hr2"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> รายงานสรุปของตราสารทุน  </span> </a>
                        </li>

                    </ul>
                </header>

                <!-- widget div-->
                <div>


                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="tab-content">
                            <div class="tab-pane active" id="hr1">

                                <div class="widget-body no-padding" style="width: 90% ;margin: 0 auto;background-color: #000000;border: 1px solid #E1E8F3">
                                    <header style="color: #fff; height: 40px; line-height: 40px; font-size: 18px; background-color: #a90329;padding-left: 20px;"> กล่องค้นหา </header>

                                    <form  id="comment-form_darkman" class="smart-form" novalidate="novalidate">

                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label"><input type="checkbox" id="check_name"  value="name"> รหัสพนักงาน</label>
                                                    <label class="input">
                                                        <input type="text" name="name" id="name">
                                                    </label>
                                                </section>
                                                <section class="col col-4">
                                                    <label class="label"><input type="checkbox" id="check_depart" value="depart"> หน่วยงาน</label>
                                                    <label class="input">
                                                        <input type="text" name="email" id="depart">
                                                    </label>
                                                </section>
                                                <section class="col col-4">
                                                    <label class="label"><input type="checkbox" id="check_plan" value="plan"> แผนการลงทุน</label>
                                                    <label class="input">
                                                        <select name="plan" id="plan" class="form-control">
                                                            <option value="">แผนการลงทุน</option>
                                                            @if($planlist)
                                                                @foreach($planlist as $plan)
                                                                    <option value="{{$plan->PLAN_ID}}">{{$plan->PLAN_NAME}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        {{--<input type="text" name="plan" id="plan">--}}
                                                    </label>
                                                </section>
                                            </div>

                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label"><input type="checkbox" id="check_date" value="date_start"> ระบุช่วงเวลา</label>
                                                    <label class="input"><i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" class="mea_date_picker" id="date_start"  >
                                                    </label>
                                                </section>
                                                <section class="col col-4">
                                                    <label class="label">ถึง</label>
                                                    <label class="input"><i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" class="mea_date_picker" id="date_end" >
                                                    </label>
                                                </section>
                                                <section class="col col-4">
                                                    <button type="submit" id="btn_search" style="padding: 5px 20px 5px 20px; margin-top:20px;font-size: 18px;" name="submit" class="btn btn-primary">
                                                        ค้นหา
                                                    </button>
                                                </section>
                                            </div>
                                        </fieldset>




                                    </form>

                                </div>



                                <a href="#" id="export_search" style="margin-top: 30px;" class="btn btn-labeled btn-success mea-btn-export"> <span class="btn-label"><i class="glyphicon glyphicon-download-alt"></i></span>Export </a>
                                <a href="#" id="export_search_txt" style="margin-top: 30px;" class="btn btn-labeled btn-warning mea-btn-export"> <span class="btn-label"><i class="glyphicon glyphicon-download-alt"></i></span>Export .txt </a>
                                <!-- Widget ID (each widget will need unique ID)-->
                                <div class="jarviswidget jarviswidget-color-blueDark" style="margin-top: 5px;" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">
                                    <!-- widget options:
                                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                    data-widget-colorbutton="false"
                                    data-widget-editbutton="false"
                                    data-widget-togglebutton="false"
                                    data-widget-deletebutton="false"
                                    data-widget-fullscreenbutton="false"
                                    data-widget-custombutton="false"
                                    data-widget-collapsed="true"export_search
                                    data-widget-sortable="false"

                                    -->

                                    <select class="form-control mea-pagesize" id="page-size-search">
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>

                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>


                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->

                                        </div>
                                        <!-- end widget edit box -->

                                        <!-- widget content -->
                                        <div class="widget-body">
                                            <p class="report-title">
                                                รายชื่อสมาชิกเปลี่ยนแผนการลงทุน

                                            </p>
                                            <p class="report-period"> </p>
                                            <div class="table-responsive">
                                                <div id="serch_data">

                                                </div>
                                            </div>

                                        </div>
                                        <!-- end widget content -->

                                    </div>
                                    <!-- end widget div -->

                                </div>
                                <!-- end widget -->


                                <a href="{{action('AdminReportController@ajax_report1_all_export')}}" style="margin-top: 30px;" class="btn btn-labeled btn-success mea-btn-export"> <span class="btn-label"><i class="glyphicon glyphicon-download-alt"></i></span>Export </a>

                                <a href="{{action('AdminReportController@ajax_report1_all_export_text')}}"  style="margin-top: 30px;" class="btn btn-labeled btn-warning mea-btn-export"> <span class="btn-label"><i class="glyphicon glyphicon-download-alt"></i></span>Export .txt </a>

                                <div class="jarviswidget jarviswidget-color-blueDark" style="margin-top: 5px;" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">

                                    <select class="form-control mea-pagesize" id="page-size-all">
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>

                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-table"></i>

                                        </span>


                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->

                                        </div>
                                        <!-- end widget edit box -->

                                        <!-- widget content -->
                                        <div class="widget-body">
                                            <p class="report-title">
                                                รายชื่อสมาชิกทั้งหมดในระบบ

                                            </p>

                                            <div class="table-responsive">
                                                <div id="all_data">

                                                </div>

                                            </div>

                                        </div>
                                        <!-- end widget content -->

                                    </div>
                                    <!-- end widget div -->

                                </div>
                                <!-- end widget -->


                            </div>
                            <div class="tab-pane" id="hr2">

                                <div class="widget-body no-padding" style="width: 90% ;margin: 0 auto;background-color: #000000;border: 1px solid #E1E8F3">
                                    <header style="color: #fff; height: 40px; line-height: 40px; font-size: 18px; background-color: #a90329;padding-left: 20px;"> กล่องค้นหา </header>

                                    <form  id="ana_search_form" class="smart-form" novalidate="novalidate">

                                        <fieldset>


                                            <div class="row">
                                                <section class="col col-4">
                                                    <label class="label">ระบุตราสารทุน​ (%)</label>
                                                    <label class="input">
                                                        <input type="text"  id="per_start" name="per_start" >
                                                    </label>
                                                </section>
                                                <section class="col col-4">
                                                    <label class="label">ถึง</label>
                                                    <label class="input">
                                                        <input type="text" id="per_end" name="per_end" >
                                                    </label>
                                                </section>
                                                <section class="col col-4">
                                                    <button type="submit" id="btn_search_2" style="padding: 5px 20px 5px 20px; margin-top:20px;font-size: 18px;" name="submit" class="btn btn-primary">
                                                        ค้นหา
                                                    </button>
                                                </section>
                                            </div>
                                        </fieldset>




                                    </form>

                                </div>


                                <a href="#" id="export_cal" style="margin-top: 30px;" class="btn btn-labeled btn-success mea-btn-export"> <span class="btn-label"><i class="glyphicon glyphicon-download-alt"></i></span>Export </a>
                                <!-- Widget ID (each widget will need unique ID)-->
                                <div class="jarviswidget jarviswidget-color-blueDark" style="margin-top: 5px;" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">

                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>


                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->

                                        </div>
                                        <!-- end widget edit box -->

                                        <!-- widget content -->
                                        <div class="widget-body">
                                            {{--<p class="report-title">--}}
                                                {{--รายชื่อสมาชิกเปลี่ยนแผนการลงทุน--}}

                                            {{--</p>--}}
                                            <div class="table-responsive">
                                                <div id="cal_data">

                                                </div>
                                            </div>

                                        </div>
                                        <!-- end widget content -->

                                    </div>
                                    <!-- end widget div -->

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



</div>
<!-- END MAIN CONTENT -->


<script type="text/javascript">

    function Render(data){
//        $("#all_data").hide();
        $("#all_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        $("#all_data").html(data.html);
        $("#all_data").fadeIn('300');


        $("#page_click li a").on('click',PageRender);
    }


    function PageRender(){
        var p = $(this).attr('data-page');
        var page_size = $('#page-size-all').val();
        var CurPage = $('#currentpage_all').val();
        $("#all_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        if(p == "pre"){
            p = parseInt(CurPage) - 1;
        }

        if(p == "next"){
            p = parseInt(CurPage) + 1;
        }
        $('#currentpage_all').val(p);
        var jsondata = {pagesize : page_size,PageNumber:p};

        MeaAjax(jsondata,"report1/all",Render);
    };

    $(document).ready(function(){


        var $loginForm = $("#ana_search_form").validate({
            // Rules for form validation
            rules : {
                per_start : {
                    required : true,
                    number : true,
                    min : 0,
                    max : 100

                },
                per_end : {
                    required : true,
                    number : true,
                    min : 0,
                    max : 100
                }
            },

            // Messages for form validation
            messages : {
                per_start : {
                    required : "ท่านยังไม่ได้กรอกตัวเลขที่ต้องการค้นหา",
                    max : "ท่านกรอกช่วงตัวเลข(%)ไม่ถูกต้อง"


                },
                per_end : {
                    required : "ท่านยังไม่ได้กรอกตัวเลขที่ต้องการค้นหา",
                    max : "ท่านกรอกช่วงตัวเลข(%)ไม่ถูกต้อง"


                }
            },
            // Ajax form submition
            submitHandler : function(form) {
//                $(form).ajaxSubmit({
//                    success : function() {
//                        $("#comment-form").addClass('submited');
//                    }
//                });

            var Perstart = $('#per_start').val();
            var PerEnd = $('#per_end').val();

                var jsondata = {
                Perstart : Perstart,
                PerEnd:PerEnd

            };

            $("#cal_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            MeaAjax(jsondata,"report1/search_ana",RenderSearch_ana);
//                alert('hello');
            },


            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });




        $('#export_cal').on('click',function(){

            var Perstart = $('#per_start').val();
            var PerEnd = $('#per_end').val();

//            var jsondata = {
//                Perstart : Perstart,
//                PerEnd:PerEnd
//
//            };

            window.location.href =  "report1/exportsearch_ana?Perstart=" + Perstart +"&PerEnd=" + PerEnd ;

            return false;
        });

        $('#export_search').on('click',function(){

            var PageSizeAll = $('#page-size-search').val();
            var EmpID = $('#name').val();
            var depart = $('#depart').val();
            var plan = $('#plan').val();
            var date_start = $('#hd_date_start').val();
            var date_end =$('#hd_date_end').val();

            var check_name =$('#check_name').is(':checked');
            var check_depart =$('#check_depart').is(':checked');
            var check_plan =$('#check_plan').is(':checked');
            var check_date =$('#check_date').is(':checked');



                window.location.href =  "report1/exportsearch?EmpID=" + EmpID +"&depart=" + depart + "&plan=" + plan + "&date_start=" +date_start + "&date_end=" + date_end+ '&check_name=' + check_name+ '&check_depart=' + check_depart+ '&check_plan=' + check_plan+ '&check_date=' + check_date;

            return false;
        });

        $('#export_search_txt').on('click',function(){

            var PageSizeAll = $('#page-size-search').val();
            var EmpID = $('#name').val();
            var depart = $('#depart').val();
            var plan = $('#plan').val();
            var date_start = $('#hd_date_start').val();
            var date_end =$('#hd_date_end').val();

            var check_name =$('#check_name').is(':checked');
            var check_depart =$('#check_depart').is(':checked');
            var check_plan =$('#check_plan').is(':checked');
            var check_date =$('#check_date').is(':checked');



            window.location.href =  "report1/exportsearch_txt?EmpID=" + EmpID +"&depart=" + depart + "&plan=" + plan + "&date_start=" +date_start + "&date_end=" + date_end+ '&check_name=' + check_name+ '&check_depart=' + check_depart+ '&check_plan=' + check_plan+ '&check_date=' + check_date;

            return false;
        });

        meaDatepicker("date_start");
        meaDatepicker("date_end");

        $("#all_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        var jsondata = {pagesize : 25,PageNumber:1};

        $('html').append('<input type="hidden" value="1" id="currentpage_all" />');
        $('html').append('<input type="hidden" value="1" id="currentpage_search" />');

        MeaAjax(jsondata,"report1/all",Render);






        $("#page-size-all").on('change',function(){
            $("#all_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            var val = $(this).val();
            var jsondata = {pagesize : val,PageNumber:1};
            MeaAjax(jsondata,"report1/all",Render);


            });


        //end all data

        //Start Search data




        $('#btn_search').on('click',function(){

            var PageSizeAll = $('#page-size-search').val();
            var EmpID = $('#name').val();
            var depart = $('#depart').val();
            var plan = $('#plan').val();
            var date_start = $('#hd_date_start').val();
            var date_end =$('#hd_date_end').val();

            var check_name =$('#check_name').is(':checked');
            var check_depart =$('#check_depart').is(':checked');
            var check_plan =$('#check_plan').is(':checked');
            var check_date =$('#check_date').is(':checked');

            if(check_date && date_start != "" && date_end != "" ){
                var str =  'ในช่วงวันที่ ' + GetDateFormat(date_start) + ' ถึง ' + GetDateFormat(date_end);
                $('.report-period').html(str);
            }

//            <p class=""> ในช่วงวันที่  1 - 10 กรกฎาคม 2558</p>
//

            var jsondata = {
                pagesize : PageSizeAll,
                PageNumber:1,
                emp_id : EmpID,
                depart :depart,
                plan : plan,
                date_start:date_start,
                date_end:date_end,
                check_name :check_name,
                check_depart:check_depart,
                check_plan:check_plan,
                check_date:check_date

            };

            console.log(jsondata);
            $("#serch_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            MeaAjax(jsondata,"report1/search",RenderSearch);

            return false;

        });


        $("#page-size-search").on('change',function(){
            $("#serch_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            var val = $(this).val();

            var EmpID = $('#name').val();
            var depart = $('#depart').val();
            var plan = $('#plan').val();
            var date_start = $('#hd_date_start').val();
            var date_end =$('#hd_date_end').val();

            var check_name =$('#check_name').is(':checked');
            var check_depart =$('#check_depart').is(':checked');
            var check_plan =$('#check_plan').is(':checked');
            var check_date =$('#check_date').is(':checked');

            var jsondata = {
                pagesize : val,
                PageNumber:1,
                emp_id : EmpID,
                depart :depart,
                plan : plan,
                date_start:date_start,
                date_end:date_end,
                check_name :check_name,
                check_depart:check_depart,
                check_plan:check_plan,
                check_date:check_date

            };
//            var jsondata = {pagesize : val,PageNumber:1};
            $("#serch_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            MeaAjax(jsondata,"report1/search",RenderSearch);


        });


    });

    function RenderSearch_ana(data){

        $("#cal_data").html(data.html);
        $("#cal_data").fadeIn('300');
    }

    function RenderSearch(data){
//        $("#all_data").hide();


        $("#serch_data").html(data.html);
        $("#serch_data").fadeIn('300');


        $("#page_click_search li a").on('click',PageRenderSearch);
    }

    function PageRenderSearch(){
        var p = $(this).attr('data-page');
        var page_size = $('#page-size-search').val();
        var CurPage = $('#currentpage_search').val();
        $("#serch_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        if(p == "pre"){
            p = parseInt(CurPage) - 1;
        }

        if(p == "next"){
            p = parseInt(CurPage) + 1;
        }
        $('#currentpage_search').val(p);

//        var PageSizeAll = $('#page-size-search').val();
        var EmpID = $('#name').val();
        var depart = $('#depart').val();
        var plan = $('#plan').val();
        var date_start = $('#hd_date_start').val();
        var date_end =$('#hd_date_end').val();

        var check_name =$('#check_name').is(':checked');
        var check_depart =$('#check_depart').is(':checked');
        var check_plan =$('#check_plan').is(':checked');
        var check_date =$('#check_date').is(':checked');


        var jsondata = {
            pagesize : page_size,
            PageNumber:p,
            emp_id : EmpID,
            depart :depart,
            plan : plan,
            date_start:date_start,
            date_end:date_end,
            check_name :check_name,
            check_depart:check_depart,
            check_plan:check_plan,
            check_date:check_date

        };
//        var jsondata = {pagesize : page_size,PageNumber:p};

        MeaAjax(jsondata,"report1/search",RenderSearch);
    };


</script>

@stop