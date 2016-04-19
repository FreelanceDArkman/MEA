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
                                    <a href="javascript:void(0);"><strong>เป็นเมนูนําเข้าข้อมูลโปรไฟล์ทั่วไปของพนักงาน กฟน ที่ได้จากระบบ SAP เข้าสู่ฐานข้อมูลของ ระบบกองทุนสํารองเลี้ยงชีพ</strong></a>
                                </p>
                                <p>
                                    ชนิดไฟล์ที่อนุญาติให้นำเข้า:Exel <br/>

                                <label>37 คอลัม</label>
                                <table style="width: 100px;" class="table table-bordered">
                                    <tr><td>EMP_ID</td><td>Prefix </td><td>FullName </td><td>EngName  </td><td>FirstName </td><td>LastName </td><td>.....</td><td>PartLng </td></tr>
                                    <tr>
                                        <td>0000001</td>
                                        <td>นาย</td>
                                        <td>ปัญญา ปิยะจันทร์วิจิตต</td>
                                        <td>MR.PUNYA  PIYAJUNVIJITT</td>
                                        <td>ปัญญา</td>
                                        <td>ปิยะจันทร์วิจิตต์</td>
                                        <td>....</td>
                                        <td>แผนกพัสดุ</td>

                                    </tr>
                                </table>

                                </p>

                                <p>
                                <p class="help-block">
                                    เลือกไฟล์
                                </p>
                                <input type="file" class="btn btn-default" id="import1" name="import1">


                                </p>
                                <p id="progress_check" style="display: none;"><img src="{{asset('backend/img/shot.gif')}}"  /> กำลังตรวจสอบ ไฟล์</p>
                                <p id="check_ret" style="display: none"></p>
                                <p>
                                    {{--<a href="javascript:void(0);"  data-input="import1" data-import="1" class="btn_check btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>--}}{{-- style="display: none"--}}
                                    <a href="javascript:void(0);"  data-input="import1" data-import="1" class="btn_import btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>
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
                            url: 'simple/check',
                            data: dataimport,

                            success: function(data){
                                if(data.success){
                                    $('#progress_check').hide();
                                    $('.btn_check').hide();
                                    $('.btn_import').show();
//                                    AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว");


                                    $('#check_ret').show();
                                    $('#check_ret').html(data.html);
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
                url: 'simple/import',
                data: dataimport,

                success: function(data){
                    if(data.success){
                        AlertSuccess("ข้อมูลได้ถูก update เรียบร้อยแล้ว");
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