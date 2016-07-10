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

                    <a href="{{action('C53_2Controller@getAdd')}}" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> สร้างหัวข้อข่าว</a>
                </li>
                <li class="sparks-info">
                    <a href="javascript:void(0);" id="mea_edit"  class="btn bg-color-blueDark txt-color-white"><i class="fa fa-gear fa-lg"></i> แก้ไข</a>

                </li>
                <li class="sparks-info">
                    <a href="javascript:void(0);" id="mea_delete" class="btn bg-color-red txt-color-white"><i class="glyphicon glyphicon-trash"></i> ปิดการใช้งาน</a>
                </li>

            </ul>
        </div>
    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <div class="row">
            <div class="col-xs-12">
                <section>
                    <label class="label" style="color:#333;font-size: 20px">เลือกหมวดหมู่</label>
                    <label class="select">
                        <select class="form-control" id="news_topice_select">
                            <option value="0">ทั้งหมด</option>
                           @foreach($menucate as $item)
                                <option value="{{$item->NEWS_CATE_ID}}">{{$item->NEWS_CATE_NAME}}</option>
                               @endforeach
                        </select> <i></i> </label>
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
                    <header role="heading">
                        <ul class="nav nav-tabs pull-left in">

                            <li class="active">

                                <a data-toggle="tab" href="#hr1" class="data-tab" data-val="0"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> Active </span> </a>

                            </li>

                            <li>
                                <a data-toggle="tab" href="#hr2" class="data-tab" data-val="1"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> Inactive  </span> </a>
                            </li>

                        </ul>
                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>


                    <div role="content">


                        <!-- widget content -->
                        <div class="widget-body">

                            <div class="tab-content">
                                <div class="tab-pane active" id="hr1">

                                    <div class="table-responsive">
                                        <div class="result" style="width: 100%; padding: 10px;">


                                        </div>
                                    </div>




                                </div>
                                <div class="tab-pane" id="hr2">


                                    <div class="table-responsive">
                                        <div class="result" style="width: 100%; padding: 10px;">


                                        </div>
                                    </div>

                                </div>

                                </div>
                            </div>
                    </div>
                        <!-- end widget content -->



                    <!-- widget div-->

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
                        url: '/admin/news/delete',
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

                                window.location.href = '/admin/news';
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
                        checked = checked + $(this).val() + ":";
                    }


                });
                var jsondata = {group_id : checked};

                $.ajax({

                    type: 'post', // or post?
                    dataType: 'json',
                    url: '/admin/news/delete',
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

                            window.location.href = '/admin/news';
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
                window.location.href = "/admin/news/edit/" + $(".item_checked:checked").val();
            }






        })


        //page click
        $("#page_click_search li a").on('click',PageRender);
    }


    //function Pageclick
    function PageRender(){
        var p = $(this).attr('data-page');
        var page_size = 10;
        var CurPage = $('#currentpage_search').val();
        $("#all_data").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        if(p == "pre"){
            p = parseInt(CurPage) - 1;
        }

        if(p == "next"){
            p = parseInt(CurPage) + 1;
        }
        $('#currentpage_all').val(p);

        var NEWS_CATE_ID = $("#news_topice_select").val();



        var NEWS_TOPIC_FLAG = $("#hd_NEWS_TOPIC_FLAG").val();


        var jsondata = {pagesize : page_size,PageNumber:p, NEWS_CATE_ID: NEWS_CATE_ID,NEWS_TOPIC_FLAG:NEWS_TOPIC_FLAG};

        MeaAjax(jsondata,"news/getall",Render);
    };

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {


        @if (Session::has('message'))
             AlertSuccess("บันทึกหัวข้อข่าวเรียบร้อยแล้ว",function(){

           // window.location.href = "/admin/news";
        });
        @endif

        //add current Pageing
        $('html').append('<input type="hidden" value="1" id="currentpage_search" />');
        $('html').append('<input type="hidden" value="0" id="hd_NEWS_TOPIC_FLAG" />');
        var NEWS_CATE_ID = $("#news_topice_select").val();
        var NEWS_TOPIC_FLAG = 0;
        var jsondata = {pagesize : 10,PageNumber:1, NEWS_CATE_ID: NEWS_CATE_ID,NEWS_TOPIC_FLAG:NEWS_TOPIC_FLAG};

        $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        MeaAjax(jsondata,"news/getall",Render);



        $(".data-tab").on('click',function(){
            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
//            $(".result").html("");
            var val = $(this).attr("data-val");
//            alert(val);
            var NEWS_CATE_ID = $("#news_topice_select").val();
            var NEWS_TOPIC_FLAG = val;

            $("#hd_NEWS_TOPIC_FLAG").val(val);
            var jsondata = {pagesize : 10,PageNumber:1, NEWS_CATE_ID: NEWS_CATE_ID,NEWS_TOPIC_FLAG:NEWS_TOPIC_FLAG};
            MeaAjax(jsondata,"news/getall",Render);

        });


        $("#news_topice_select").on('change',function(){
            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
//            $(".result").html("");
            var val = $(this).val();
//            alert(val);
            var NEWS_CATE_ID = val;
//            var NEWS_TOPIC_FLAG = val;

            var NEWS_TOPIC_FLAG = $("#hd_NEWS_TOPIC_FLAG").val();
            var jsondata = {pagesize : 10,PageNumber:1, NEWS_CATE_ID: NEWS_CATE_ID,NEWS_TOPIC_FLAG:NEWS_TOPIC_FLAG};
            MeaAjax(jsondata,"news/getall",Render);
        });


    })

</script>

@stop