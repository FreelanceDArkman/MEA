@extends('backend.layouts.default')
@section('content')
<?php
$data = getmemulist();
$arrSidebar =getSideBar($data);
?>

    <style type="text/css">
        #sort-by-year{
            position:absolute;
            width: 300px;
            z-index: 999;
            left: 200px;
            top:5px
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
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
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

                            <div id="sort-by-year">

                                <select name="group_drop" id="group_drop" class="form-control">

                                    @if($user_group)
                                            <option value="0" >ค้นหากลุ่มผู้ใช้</option>
                                            <option value="1" >แสดงทั้งหมด</option>
                                        @foreach($user_group as $index => $group)
                                            <option value="{{$group->USER_PRIVILEGE_DESC}}">{{$group->USER_PRIVILEGE_DESC}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">

                                <thead>
                                <tr>
                                    <th style="width:3%;text-align: center">

                                    </th>

                                    <th style="width:7%;text-align: center">

                                    </th>
                                    <th class="hasinput" style="width:7%">
                                        <input type="text" class="form-control" placeholder="Filter รหัสพนักงาน" />


                                    </th>
                                    <th class="hasinput" style="width:15%">
                                        <input type="text" class="form-control" placeholder="Filter ชื่อ-สกุล" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Filter ชื่อผู้ใช้" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Filter สถานะ" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Filter กลุ่มผู้ใช้" />
                                    </th>
                                    <th class="hasinput" style="width:8%">
                                        <input type="text" class="form-control" placeholder="Filter อีเมล์" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Filter โทรศัพท์" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Filter วันที่สร้าง" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Filter วันที่แก้ไขล่าสุด" />
                                    </th>

                                </tr>
                                <tr>
                                    <th id="index_th" class="sorting_disabled">
                                        <input type="checkbox" id="mainCheck" />
                                    </th>
                                    <th style="text-align: center">Action</th>
                                    <th>รหัสพนักงาน</th>
                                    <th data-class="expand">ชื่อ-สกุล</th>
                                    <th data-hide="phone">ชื่อผู้ใช้</th>
                                    <th data-hide="phone">สถานะ</th>
                                    <th data-hide="phone">กลุ่มผู้ใช้</th>
                                    <th data-hide="phone">อีเมล์</th>
                                    <th data-hide="phone">โทรศัพท์</th>
                                    <th data-hide="phone">วันที่สร้าง</th>
                                    <th data-hide="phone">วันที่แก้ไขล่าสุด</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if($userAll)
                                    @foreach($userAll as $userGroup)

                                        <tr>
                                            <td><input type="checkbox"  name="check_item_edit[]" value="{{$userGroup->EMP_ID}}" class="item_checked" id="item_check_{{$userGroup->EMP_ID}}" />

                                            </td>
                                            <td style="text-align: center">
                                                <a href="/admin/userGroup/edit/{{$userGroup->EMP_ID}}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                                                <a href="javascript:void(0);"  data-id="{{$userGroup->EMP_ID}}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>

                                            </td>
                                            <td>{{$userGroup->EMP_ID}}</td>
                                            <td>{{$userGroup->FULL_NAME}}</td>
                                            <td>{{$userGroup->USERNAME}}</td>
                                            <td>{{$userGroup->STATUS_DESC}}</td>
                                            <td>{{$userGroup->USER_PRIVILEGE_DESC}}</td>
                                            <td>{{$userGroup->EMAIL}}</td>
                                            <td>{{$userGroup->PHONE}}</td>
                                            <td>{{get_date_notime($userGroup->CREATE_DATE)}}</td>
                                            <td>{{get_date_notime($userGroup->LAST_MODIFY_DATE)}}</td>
                                        </tr>


                                    @endforeach

                                @endif

                                </tbody>

                            </table>

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






    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

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
                        url: '/admin/userGroup/delete',
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

                                window.location.href = '/admin/userGroup';
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
                    url: '/admin/userGroup/delete',
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

                            window.location.href = '/admin/userGroup';
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



            if(checkcount > 1){
                $.SmartMessageBox({
                    title : "Error!",
                    content : "ไม่สามารถแก้ไขได้ กรุณาเลือกรายการเดียว",
                    buttons : '[OK]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "OK") {


                    }
                    if (ButtonPressed === "No") {

                    }

                });
            }else {
                window.location.href = "/admin/userGroup/edit/" + $(".item_checked:checked").val();
            }

        })


        $("#mainCheck").on("click",function(){$(".item_checked").not(this).prop('checked', this.checked);});

        // With Callback


        /* // DOM Position key index //

         l - Length changing (dropdown)
         f - Filtering input (search)
         t - The Table! (datatable)
         i - Information (records)
         p - Pagination (paging)
         r - pRocessing
         < and > - div elements
         <"#id" and > - div with an id
         <"class" and > - div with a class
         <"#id.class" and > - div with an id and class

         Also see: http://legacy.datatables.net/usage/features
         */
        var responsiveHelper_datatable_fixed_column = undefined;
        var breakpointDefinition = {
            tablet : 1024,
            phone : 480
        };


        /* COLUMN FILTER  */
        var otable = $('#datatable_fixed_column').DataTable({
            //"bFilter": false,
            //"bInfo": false,
            "bLengthChange": true,
            //"bAutoWidth": false,
            //"bPaginate": false,
            //"bStateSave": true // saves sort state using localStorage
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'Tl>r>"+"t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,1 ] } ],
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "csv",
                    "xls",
                    {
                        "sExtends": "pdf",
                        "sTitle": "SmartAdmin_PDF",
                        "sPdfMessage": "SmartAdmin PDF Export",
                        "sPdfSize": "letter"
                    },
                    {
                        "sExtends": "print",
                        "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                    }
                ],
                "sSwfPath": "{{ asset('backend/js/plugin/datatables/swf/copy_csv_xls_pdf.swf')}}"
            },

            "autoWidth" : true,
            "initComplete": function () {
                this.api().columns(6).every(function () {

                    var column = this;

                    var selectDropdown = $("#group_drop")
                            .on('change', function () {

                                if($(this).val() == 1 || $(this).val() == 0){
                                    column.search("").draw();
                                }else {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()

                                    );
                                    column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                }

                            });

//                    var selectDropdown = $('<select><option></option></select>')
//                            .appendTo($('#sort-by-year'))
//                            .on('change', function () {
//                                var val = $.fn.dataTable.util.escapeRegex(
//                                        $(this).val()
//
//                                );
//                                column
//                                        .search(val ? '^' + val + '$' : '', true, false)
//                                        .draw();
//                            });

//                    column.data().unique().sort().each(function (d, j) {
//                        selectDropdown.append('<option value="' + d + '">' + d + '</option>')
//                    });
                });
            },
            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
            }

        });

        // custom toolbar
//        $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

        // Apply the filter
        $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

            otable
                    .column( $(this).parent().index()+':visible' )
                    .search( this.value )
                    .draw();

        } );
        /* END COLUMN FILTER */


        $("#index_th").removeClass("sorting_asc");
        $("#index_th").addClass("sorting_disabled");

    })

</script>

@stop