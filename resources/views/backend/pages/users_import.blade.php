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
                                <small>รูปแบบที่ 1</small>
                            </div>
                            <div class="smart-timeline-content">
                                <p>
                                    <a href="javascript:void(0);"><strong>เพื่อทําการ update status ให้กับ user จํานวนมาก</strong></a>
                                </p>
                                <p>
                                    ชนิดไฟล์ที่อนุญาติให้นำเข้า:Exel

                                <table style="width: 100px;" class="table table-bordered">
                                    <tr><td>EMP_ID</td><td>USER_STATUS_ID</td></tr>
                                    <tr><td>0000001</td><td>11</td></tr>
                                </table>

                                </p>

                                <p>
                                <p class="help-block">
                                    เลือกไฟล์
                                </p>
                                <input type="file" class="btn btn-default" id="import1" name="import1">


                                </p>
                                <p>
                                    <a href="javascript:void(0);"  data-input="import1" data-import="1" class="btn_import btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>
                                </p>

                                <div class="row">

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="smart-timeline-icon bg-color-greenDark">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="smart-timeline-time">
                                <small>รูปแบบที่ 2</small>
                            </div>
                            <div class="smart-timeline-content">
                                <p>
                                    <a href="javascript:void(0);"><strong>เพื่อทําการ update status, ค่า flag ที่เกี่ยวข้อง กรณีท่ีมีสมาชิกลาออกจากกองทุน</strong></a>
                                </p>
                                <p>ชนิดไฟล์ที่อนุญาติให้นำเข้า:Exel
                                <table style="width: 100px;" class="table table-bordered">
                                    <tr><td>EMP_ID</td><td>USER_STATUS_ID</td><td>LEAVE_FUND_GROUP_DATE</td><td>FIRST_LOGIN_FLAG</td></tr>
                                    <tr><td>0000001</td><td>11</td>
                                    <td>2015-01-01</td>
                                    <td>1</td></tr>
                                </table>
                                </p>
                                <p>
                                <p class="help-block">
                                    เลือกไฟล์
                                </p>
                                <input type="file" class="btn btn-default" id="exampleInputFile1">


                                </p>
                                <p>
                                    <a href="javascript:void(0);" class="btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>
                                </p>

                                <div class="row">

                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="smart-timeline-icon bg-color-greenDark">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="smart-timeline-time">
                                <small>รูปแบบที่ 3</small>
                            </div>
                            <div class="smart-timeline-content">
                                <p>
                                    <a href="javascript:void(0);"><strong>เพื่อทําการ update status, ค่า flag ที่เกี่ยวข้อง กรณีที่มีสมาชิกกลับเข้ากองทุน</strong></a>
                                </p>
                                <p>ชนิดไฟล์ที่อนุญาติให้นำเข้า:Exel
                                <table style="width: 100px;" class="table table-bordered">
                                    <tr><td>EMP_ID</td><td>USER_STATUS_ID</td><td>RETURN_FUND_GROUP_DATE</td></tr>
                                    <tr><td>0000001</td><td>12</td><td>2016-01-01</td></tr>
                                </table>
                                </p>
                                <p>
                                <p class="help-block">
                                    เลือกไฟล์
                                </p>
                                <input type="file" class="btn btn-default" id="exampleInputFile1">


                                </p>
                                <p>
                                    <a href="javascript:void(0);" class="btn btn-xs btn-primary"><i class="fa fa-download"></i> นำเข้าข้อมูล</a>
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


<!-- PAGE RELATED PLUGIN(S) -->
{{--<script src="{{asset('backend/js/plugin/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/plugin/datatables/dataTables.colVis.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>--}}

<script type="text/javascript">




    $(document).ready(function() {


        $('.btn_import').on('click',function(){


            var dataimport = new FormData();
            var target = $(this).attr('data-input');


            var files = $("#" + target).get(0).files;

            var importType= $(this).attr('data-import');


            if (files.length > 0) {
                dataimport.append("exelimport", files[0]);


            }

            dataimport.append('type',importType);
//            var files = $("#imageInput_" + id).get(0).files;



            $.ajax({

                type: 'POST', // or post?
//                dataType: 'json',
                contentType: false,
                processData: false,
                url: 'import',
                data: dataimport,

                success: function(data){


                    alert(data.html);

                },
                error: function(xhr, textStatus, thrownError) {

                }
            });

        });





    });




</script>

@stop