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
                {{--<li class="sparks-info">--}}

                    {{--<a href="#" id="btn_add" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> เพิ่ม</a>--}}
                {{--</li>--}}


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

                    <div id="insert-pan" style="padding: 20px 20px 0px 20px ;display:none;" >
                        <div class="widget-body no-padding">

                            <form action="" id="formadd" class="smart-form">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>รหัส</th>
                                        <th>ชื่อหน่วยงาน</th>
                                        <th>Path</th>
                                        <th>Url</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
<tbody>

<tr>
    <td style="width: 5%">
        <section>
            <label class="input">
                <input type="text" id="ID" name="ID" class="form-control" style="background: #f0fff0;border-color: #7DC27D;"  />
            </label>
        </section>
    </td>
    <td style="width: 20%">
        <section>
            <label class="input">
                <input type="text" id="NAME" name="NAME" class="form-control" style="background: #f0fff0;border-color: #7DC27D;"  />
            </label>
        </section>
    </td>
    <td style="width: 35%">
        <section>
            <label class="input">
                <input type="text" id="FILE_PATH" name="FILE_PATH" class="form-control" style="background: #f0fff0;border-color: #7DC27D;"  />
            </label>
        </section>
    </td>
    <td style="width: 35%">
        <section>
            <label class="input">
                <input type="text" id="URL" name="URL" class="form-control" style="background: #f0fff0;border-color: #7DC27D;"  />
            </label>
        </section>
    </td>
    <td style="width: 5%">
        <a id="add-con1" style="padding: 5px 10px 5px 10px" class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> เพิ่ม</a>
    </td>
</tr>
</tbody>
                                </table>
                            </form>
                        </div>
                    </div>
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



        function gendedit(){
            $(".btn_edit_list").on('click',function(){


                var ID = $(this).data('id');

                var WEB_NEWS_ROOT_PATH = $("#WEB_NEWS_ROOT_PATH_" + ID).val();
                var WS_BENEFICIARY_ROOT_PATH = $("#WS_BENEFICIARY_ROOT_PATH_" + ID).val();
                var WEB_BENEFICIARY_ROOT_PATH = $("#WEB_BENEFICIARY_ROOT_PATH_" + ID).val();



                if($("#formadd").valid()){
                    var jsondata = {
                        CONTROL_ID : ID,
                        WEB_NEWS_ROOT_PATH:WEB_NEWS_ROOT_PATH,
                        WS_BENEFICIARY_ROOT_PATH:WS_BENEFICIARY_ROOT_PATH,
                        WEB_BENEFICIARY_ROOT_PATH:WEB_BENEFICIARY_ROOT_PATH};

                }

                MeaAjax(jsondata,"/admin/con3/editsave",function(data){
                    if(data.success){
                        AlertSuccess("แก้ไขเรียบร้อยแล้ว",function(){
                            getlist();
                        });
                    }
                });


                return false;

            });
        }




        function  getlist(){
            var jsondata = {pagesize : 20,PageNumber:1};

            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');



            var json = {id:1};

            MeaAjax(json,"/admin/con3/getlist",function(data){

                $(".result").html(data.html);

                gendedit();
            });
        }

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        getlist();





    })

</script>

@stop