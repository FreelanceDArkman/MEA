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

    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="well well-sm">
                <!-- Timeline Content -->
                <div class="smart-timeline">
                    <ul class="smart-timeline-list">
                        <li>
                            <div class="smart-timeline-icon bg-color-greenDark">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="smart-timeline-time">
                                {{--<small>รูปแบบที่ 1</small>--}}
                            </div>
                            <div class="smart-timeline-content">
                                <p class="import_title">
                                    <a href="javascript:void(0);"><strong>เป็นเมนูนําเข้าข้อมูลการเลือกแผนการลงทุนของสมาชิก</strong></a>
                                </p>

                                <p>
                                    ชนิดไฟล์ที่อนุญาติให้นำเข้า:Exel <br/>

                                <label>9 คอลัม</label>
                                </p>
                                <a class="btn btn-xs btn-success" href="{{ action('UserManagePlanController@dowloadsample')}}"> ดูตัวอย่างไฟล์</a>
                                <p></p>
                                <table style="width: 100px;" class="table table-bordered">
                                    <tr><td>PLAN_ID</td><td>EMP_ID </td><td>EQUITY_RATE </td><td>DEBT_RATE  </td><td>MODIFY_DATE </td><td>EFFECTIVE_DATE </td><td>MODIFY_COUNT</td><td>MODIFY_COUNT_TIMESTAMP </td><td>MODIFY_BY</td></tr>
                                    <tr>
                                        <td>4</td>
                                        <td>2078906</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>2016-01-02 7:43</td>
                                        <td>2016-02-01</td>
                                        <td>1</td>
                                        <td>2016-01-02 7:43</td>
                                        <td>User</td>
                                    </tr>
                                </table>
                                <p>PLAN_ID = รหัสแผนการลงทุน (4 = DIY)
                                </p>
                                <p>EMP_ID = รหัสพนักงาน
                                </p>
                                <p>EQUITY_RATE = สัดส่วนทุนที่สมาชิกเลือก
                                </p>
                                <p>DEBT_RATE = สัดส่วนหนี้ที่สมาชิกเลือก
                                </p>
                                <p>MODIFY_DATE = วัน-เวลาที่สมาชิกทำรายการ (รูปแบบ yyyy-mm-dd hh:mm) ***กรณีไม่มีข้อมูลเวลา (ใช้รูปแบบ yyyy-mm-dd)
                                </p>
                                <p>EFFECTIVE_DATE = วันที่มีผล (รูปแบบ yyyy-mm-dd)
                                </p>
                                <p>MODIFY_COUNT = ครั้งที่ทำรายการเลือกแผน
                                </p>
                                <p>MODIFY_COUNT_TIME_STAMP = วัน-เวลาที่สมาชิกทำรายการ (รูปแบบ yyyy-mm-dd hh:mm) ใช้ข้อมูลเดียวกับคอลัมภ์ MODIFY_DATE
                                </p>
                                <p>MODIFY_BY = รหัสพนักงานที่ทำรายการ
                                </p>

                                <p>
                                <p class="help-block">
                                    เลือกไฟล์<br/>
                                    <span style="color: red">จำนวน record ที่สามารถ import ได้สูงสุดต่อครั้งคือ <strong>1,000 record เท่านั้น!!!</strong></span>
                                </p>
                                <input type="file" class="btn btn-default" id="import1" name="import1">


                                </p>
                                <p id="progress_check" style="display: none;"><img src="{{asset('backend/img/shot.gif')}}"  /> กำลังตรวจสอบ ไฟล์</p>
                                <p id="progress_import" style="display: none;"><img src="{{asset('backend/img/shot.gif')}}"  /> กำลังนำเข้าข้อมูล</p>
                                <p id="check_ret" style="display: none"></p>
                                <p>
                                    <a href="javascript:void(0);"  data-input="import1" data-import="1" class="btn_check btn btn-xs btn-primary"><i class="fa fa-download"></i> ตรวจสอบไฟล์</a>
                                    <a href="javascript:void(0);" style="display: none"  data-input="import1" data-import="1" class="btn_import btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>
                                </p>

                                <div class="row">

                                </div>
                            </div>
                        </li>




                    </ul>
                </div>
                <!-- END Timeline Content -->

            </div>

        </div>

    </div>


</div>
<!-- END MAIN CONTENT -->



<script type="text/javascript">




    $(document).ready(function() {


        $('.btn_check').on('click',function(){


            var dataimport = new FormData();
            var target = $(this).attr('data-input');

            var extall="xlsx,xls.xlx";
            var files = $("#" + target).get(0).files;

            if(files.length){

                ext = files[0].name.split('.').pop().toLowerCase();
                if(parseInt(extall.indexOf(ext)) < 0)
                {
                    Alert("Import",'Extension support : ' + extall);

                    return false;

                }else {
                    $('#progress_check').show();
                    if (files.length > 0) {
                        dataimport.append("exelimport", files[0]);


                    }

                    dataimport.append('type',importType);

                    $.ajax({

                            type: 'POST', // or post?
            //                dataType: 'json',
                            contentType: false,
                            processData: false,
                            url: 'plan/check',
                            data: dataimport,

                            success: function(data){
                                if(data.success){
                                    $('#progress_check').hide();
                                    if(parseInt(data.html) > 1000){

                                        Alert('Import', "จำนวน record สูงสุดที่อนุญาติให้ import คือ 10000 record");

                                    }else {
                                        $('.btn_check').hide();
                                        $('.btn_import').show();
//                                    AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว");


                                        $('#check_ret').show();
                                        //
                                        $('#check_ret').html("ข้อมูลถูกต้อง มีจำนวนทั้งหมด " +data.html +" record  กรุณากดปุ่ม นำเข้าข้อมูล ด้านล่างเพื่อ ดำเนินการ import");
                                    }
                                }

            //                Alert('OK', "ข้อมูลได้ถูก update เรียบร้อยแล้ว");

                            },
                            error: function(xhr, textStatus, thrownError) {

                            }
                    });
                }

            }else {
                Alert("Import","ท่านยังไม่ได้เลือกไฟล์");
            }

            var importType= $(this).attr('data-import');



//

////            var files = $("#imageInput_" + id).get(0).files;
//
//
//


        });

        $('.btn_import').on('click',function(){


            $('#check_ret').hide();
            $('#progress_import').show();

            var dataimport = new FormData();
            var target = $(this).attr('data-input');


            var files = $("#" + target).get(0).files;

            var importType= $(this).attr('data-import');


            if (files.length > 0) {
                dataimport.append("exelimport", files[0]);


            }

//            dataimport.append('type',importType);
//            var files = $("#imageInput_" + id).get(0).files;



            $.ajax({

                type: 'POST', // or post?
//                dataType: 'json',
                contentType: false,
                processData: false,
                url: 'plan/import',
                data: dataimport,

                success: function(data){
                    if(data.success){
                        $('#progress_import').hide();
                        AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว",function(){

                            window.location.href = "plan";
                        });
                    }else {
                        Alert('Import','การ import ข้อมูลผิดพลาด กรุณาตรวจสอบ รูปแบบข้อมูลของ ไฟล์ ')
                    }

//                Alert('OK', "ข้อมูลได้ถูก update เรียบร้อยแล้ว");

                },
                error: function(xhr, textStatus, thrownError) {

                }
            });

        });





    });




</script>

@stop