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
                                        <input type="text" name="depart" id="depart">
                                    </label>
                                </section>
                                {{--<section class="col col-4">--}}
                                    {{--<label class="label">อัตราสะสม</label>--}}
                                    {{--<label class="input">--}}
                                        {{--<input type="text" name="plan" id="plan">--}}
                                        {{--<input type="text" name="plan" id="plan">--}}
                                    {{--</label>--}}
                                {{--</section>--}}
                            </div>

                            <div class="row">
                                <section class="col col-3">
                                    <label class="label"><input type="checkbox" id="check_date" value="date_start"> ระบุช่วงเวลา</label>
                                    <label class="input">
                                        <select id="month_start" class="form-control" style="width: 60px;display: inline-block;">
                                            <option value="">เลือกเดือน</option>
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <select id="year_start" class="form-control" style="width: 70px;display: inline-block;">

                                            {!! getYearDrop(null) !!}
                                        </select>

                                    </label>

                                </section>
                                <section class="col col-3">
                                    <label class="label">ถึง</label>
                                    <label class="input">
                                        <select id="month_end" class="form-control" style="width: 60px;display: inline-block;">
                                            <option value="">เลือกเดือน</option>
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <select id="year_end" class="form-control" style="width: 70px;display: inline-block;">

                                            {!! getYearDrop(null) !!}
                                        </select>
                                    </label>
                                </section>
                                <section class="col col-3">
                                    <button type="submit" id="btn_search" style="padding: 5px 20px 5px 20px; margin-top:20px;font-size: 18px;" name="submit" class="btn btn-primary">
                                        ค้นหา
                                    </button>
                                </section>
                            </div>
                        </fieldset>




                    </form>

                </div>



                <a href="#" id="export_search" style="margin-top: 30px;" class="btn btn-labeled btn-success mea-btn-export"> <span class="btn-label"><i class="glyphicon glyphicon-download-alt"></i></span>Export </a>
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueDark" style="margin-top: 5px;" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">


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
                                รายงานข้อมูลการลงทุนของสมาชิก

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






            </article>
            <!-- WIDGET END -->



        </div>



    </div>
    <!-- END MAIN CONTENT -->


    <script type="text/javascript">




        $(document).ready(function(){



            $('#export_search').on('click',function(){

                var PageSizeAll = $('#page-size-search').val();
                var EmpID = $('#name').val();
                var depart = $('#depart').val();
                var plan = "";
                var date_start = "";
                var date_end ="";
                if($('#year_start').val() != "" &&$('#month_start').val() != ""){
                    date_start=$('#year_start').val() + '.' +$('#month_start').val();
                }
                if($('#year_end').val() != "" &&$('#month_end').val() != ""){
                    date_end =$('#year_end').val() + '.' +$('#month_end').val();
//                date_start=$('#year_start').val() + '.' +$('#month_start').val();
                }

                var check_name =$('#check_name').is(':checked');
                var check_depart =$('#check_depart').is(':checked');
                var check_plan =$('#check_plan').is(':checked');
                var check_date =$('#check_date').is(':checked');

                window.location.href =  "report4/exportsearch?EmpID=" + EmpID +"&depart=" + depart + "&plan=" + plan + "&date_start=" +date_start + "&date_end=" + date_end+ '&check_name=' + check_name+ '&check_depart=' + check_depart+ '&check_plan=' + check_plan+ '&check_date=' + check_date;

                return false;
            });

//            meaDatepicker("date_start");
//            meaDatepicker("date_end");


            $('html').append('<input type="hidden" value="1" id="currentpage_search" />');






            $('#btn_search').on('click',function(){

                var PageSizeAll = $('#page-size-search').val();
                var EmpID = $('#name').val();
                var depart = $('#depart').val();
                var plan = "";
                var date_start = "";
                var date_end ="";
                if($('#year_start').val() != "" &&$('#month_start').val() != ""){
                    date_start=$('#year_start').val() + '.' +$('#month_start').val();
                }
                if($('#year_end').val() != "" &&$('#month_end').val() != ""){
                    date_end =$('#year_end').val() + '.' +$('#month_end').val();
//                date_start=$('#year_start').val() + '.' +$('#month_start').val();
                }

                var check_name =$('#check_name').is(':checked');
                var check_depart =$('#check_depart').is(':checked');
                var check_plan =$('#check_plan').is(':checked');
                var check_date =$('#check_date').is(':checked');

                if(check_date && date_start != "" && date_end != "" ){
                    var str =  'ในช่วงวันที่ ' + GetDateFormat(date_start) + ' ถึง ' + GetDateFormat(date_end);
                    $('.report-period').html(str);
                }
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
                MeaAjax(jsondata,"report4/search",RenderSearch);

                return false;

            });


            $("#page-size-search").on('change',function(){
                $("#serch_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
                var val = $(this).val();

                var EmpID = $('#name').val();
                var depart = $('#depart').val();
                var plan = "";
                var date_start = "";
                var date_end ="";
                if($('#year_start').val() != "" &&$('#month_start').val() != ""){
                    date_start=$('#year_start').val() + '.' +$('#month_start').val();
                }
                if($('#year_end').val() != "" &&$('#month_end').val() != ""){
                    date_end =$('#year_end').val() + '.' +$('#month_end').val();
//                date_start=$('#year_start').val() + '.' +$('#month_start').val();
                }

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
                MeaAjax(jsondata,"report4/search",RenderSearch);


            });


        });



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
            var plan = "";
            var date_start = "";
            var date_end ="";
            if($('#year_start').val() != "" &&$('#month_start').val() != ""){
                date_start=$('#year_start').val() + '.' +$('#month_start').val();
            }
            if($('#year_end').val() != "" &&$('#month_end').val() != ""){
                date_end =$('#year_end').val() + '.' +$('#month_end').val();
//                date_start=$('#year_start').val() + '.' +$('#month_start').val();
            }

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

            MeaAjax(jsondata,"report4/search",RenderSearch);
        };


    </script>

@stop