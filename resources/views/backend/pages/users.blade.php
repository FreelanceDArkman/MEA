@extends('backend.layouts.default')
@section('content')
<?php
$data = getmemulist();
$arrSidebar =getSideBar($data);
?>

    <style type="text/css">
        #sort-by-year{
            /*position:absolute;*/
            width: 100%;
            margin-bottom: 10px;
            /*z-index: 999;*/
            /*left: 200px;*/
            /*top:5px*/
        }
        #sort-by-year select{
            width: 300px;

        }
        #datatable_fixed_column tbody tr td a i{
            font-size: 11px !important;
            line-height: 12px!important;
        }
        #datatable_fixed_column tbody tr td a{
            line-height: 12px!important;

        }
    </style>
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
                    <a href="{{action('UserController@getimport')}}" class="btn bg-color-orange txt-color-white"><i class="fa fa-download"></i> นำเข้า</a>
                </li>
                <li class="sparks-info">

                    <a href="{{action('UserController@getAddUser')}}" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> สร้างผู้ใช้</a>
                </li>
                <li class="sparks-info">
                    <a href="javascript:void(0);" id="mea_edit"  class="btn bg-color-blueDark txt-color-white"><i class="fa fa-gear fa-lg"></i> แก้ไข</a>

                </li>
                <li class="sparks-info">
                    <a href="javascript:void(0);" id="mea_delete" class="btn bg-color-red txt-color-white"><i class="glyphicon glyphicon-trash"></i> ลบ</a>
                </li>

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


                    <input type="hidden" id="currentStatus" value="{{session()->get('USER_STATUS_ID')}}" />
                    <header>


                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->
                        <div id="sort-by-year">
                            <div style="display: inline-block">

                                <span style="font-size: 16px;">สถานะผู้ใช้</span><br/>
                                <select name="group_drop" id="group_drop" class="form-control" style="display: inline-block">

                                    @if($user_group)
                                        {{--<option value="0" >ค้นหากลุ่มผู้ใช้</option>--}}
                                        <option value="" >แสดงทั้งหมด</option>
                                        @foreach($user_group as $index => $group)
                                            @if(session()->get('USER_STATUS_ID') == $group->USER_STATUS_ID)
                                                <option selected="selected" value="{{$group->USER_STATUS_ID}}">{{$group->STATUS_DESC}}</option>
                                            @else
                                                <option value="{{$group->USER_STATUS_ID}}">{{$group->STATUS_DESC}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div style="display: inline-block"> <span style="font-size: 16px;">รหัสพนักงาน</span><br/>
                                <input type="text" style="display: inline-block;width: 200px" class="form-control filter_row" id="user_code"   data-filter="us.EMP_ID" placeholder="Filter รหัสพนักงาน" data-operator="=" /></div>

                            <div style="display: inline-block"> <span style="font-size: 16px;">ชื่อ-สกุล</span><br/><input type="text" style="display: inline-block;width: 200px" class="form-control filter_row" id="user_profile"  data-filter="emp.FULL_NAME" placeholder="Filter ชื่อ-สกุล" data-operator="LIKE" /></div>

                            <div style="display: inline-block"> <span style="font-size: 16px;">ชื่อผู้ใช้</span><br/><input type="text" style="display: inline-block;width: 200px" class="form-control filter_row" id="user_name"  data-filter="us.USERNAME" placeholder="Filter ชื่อผู้ใช้" data-operator="LIKE"/></div>

                        </div>
                        <!-- widget content -->
                        <div class="widget-body no-padding">


                            <div class="table-responsive">
                                <div class="result" style="width: 100%; padding: 10px;">


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



    function PageRenderSearch(){

        var p = $(this).attr('data-page');
        var page_size = $('#page-size-search').val();
        var CurPage = $('#currentpage_search').val();
//        $("#result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        if(p == "pre"){
            p = parseInt(CurPage) - 1;
        }

        if(p == "next"){
            p = parseInt(CurPage) + 1;
        }
        $('#currentpage_search').val(p);


        var jsondata = {pagesize : 25,PageNumber:p};

        $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        MeaAjax(jsondata,"users/getall",Render);


    }

    function Render(data){
//        $("#all_data").hide();
        $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        $(".result").html(data.html);
        $(".result").fadeIn('300');

        $(".mea_delete_by").on('click',function(){

            var id = $(this).attr("data-id");
            $.SmartMessageBox({
                title : "Error!",
                content : "ท่านแน่ใจที่ต้องการจะลบ รายการที่ท่านเลือก",
                buttons : '[ยกเลิก][OK]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "OK") {



                    var jsondata = {group_id : id};

                    $.ajax({

                        type: 'post', // or post?
                        dataType: 'json',
                        url: '/admin/users/delete',
                        data: jsondata,

                        success: function(data) {

                            if(data.success){
                                $.smallBox({
                                    title: "Congratulations! Your form was submitted",
                                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                                    color: "#5F895F",
                                    iconSmall: "fa fa-check bounce animated",
                                    timeout: 1000
                                },function(){window.location.href = '/admin/users';});

//
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


        $(".mea_resetpass").on('click',function(){
            var id = $(this).attr("data-id");
            var user =  $(this).attr("data-user");
            $.SmartMessageBox({
                title : "Error!",
                content : "ท่านแน่ใจที่ต้องการจะ reset  password ของผู้ใช้ใช่หรือไม่",
                buttons : '[ยกเลิก][OK]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "OK") {


                    var jsondata = {username : user};

                    $.ajax({

                        type: 'post', // or post?
                        dataType: 'json',
                        url: '/admin/users/ReqPass',
                        data: jsondata,

                        success: function(data) {

                            if(data.success){
                                $.smallBox({
                                    title: "Congratulations! Your form was submitted",
                                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                                    color: "#5F895F",
                                    iconSmall: "fa fa-check bounce animated",
                                    timeout: 1000
                                });

//
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


            if(checkcount > 0 ){
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
                    url: '/admin/users/delete',
                    data: jsondata,

                    success: function(data) {

                        if(data.success){
                            $.smallBox({
                                title: "Congratulations! Your form was submitted",
                                content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                                color: "#5F895F",
                                iconSmall: "fa fa-check bounce animated",
                                timeout: 1000
                            },function(){window.location.href = '/admin/users';});

//                            window.location.href = '/admin/users';
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



            if(checkcount > 1 || checkcount == 0){
                $.SmartMessageBox({
                    title : "Error!",
                    content : "ไม่สามารถแก้ไขได้ กรุณาเลือกรายการเพียงรายการเดียว",
                    buttons : '[OK]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "OK") {


                    }
                    if (ButtonPressed === "No") {

                    }

                });
            }else {
                window.location.href = "/admin/users/edit/" + $(".item_checked:checked").val();
            }

        })


        $("#mainCheck").on("click",function(){$(".item_checked").not(this).prop('checked', this.checked);});

        $("#page_click_search li a").on('click',PageRenderSearch);


    }


    //user is "finished typing," do something

    function doneTyping () {
        var jsondata = {
            pagesize : 25,
            PageNumber:1,
            filter2 : jQuery(this).val(),
            datasearch : jQuery(this).attr('data-filter'),
            operator :jQuery(this).attr('data-operator')
        };
        jQuery(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
        MeaAjax(jsondata,"users/getall",Render);
    }

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        $('html').append('<input type="hidden" value="1" id="currentpage_search" />');

        var cu = $("#currentStatus").val();
        var jsondata = {pagesize : 25,PageNumber:1,filter1:cu};

        $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');

        MeaAjax(jsondata,"users/getall",Render);


        $('#group_drop').on('change',function(){

            var jsondata = {
                pagesize : 25,
                PageNumber:1,
                filter1 : $(this).val()
            };

            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            MeaAjax(jsondata,"users/getall",Render);
        });


        var typingTimer;
        var doneTypingInterval = 5000;
        $('.filter_row').on('keyup',function(){

//            jQuery(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
            var filter2 = jQuery(this).val();
            var datasearch = jQuery(this).attr('data-filter');
            var operator = jQuery(this).attr('data-operator');

            delay(function(){
                var jsondata = {
                    pagesize : 25,
                    PageNumber:1,
                    filter2 : filter2,
                    datasearch : datasearch,
                    operator :operator
                };

//                alert(filter2);

                MeaAjax(jsondata,"users/getall",Render);
            }, 1000 ,filter2,datasearch,operator);


        });







    })


    var delay = (function(){
        var timer = 0;
        return function(callback, ms,filter2,datasearch,operator){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

</script>

@stop