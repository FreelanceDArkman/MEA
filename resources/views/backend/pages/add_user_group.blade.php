@extends('backend.layouts.default')
@section('content')

    <?php
    $data = getmemulist();
    $arrSidebar =getSideBar($data);
    ?>
<style type="text/css">
    .tree span{
        font-size: 20px !important;
        padding: 3px 7px 3px 7px !important;
    }
    .tree label{
        font-size: 18px !important;
    }

    .form-horizontal .checkbox, .form-horizontal .checkbox-inline, .form-horizontal .radio, .form-horizontal .radio-inline{
        padding-top: 0px !important;
    }
</style>
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i>

                    {{getMenutitle($arrSidebar)}}
                </h1>
            </div>

        </div>


        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false">
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
                    <div class="widget-body fuelux">

                        <div class="wizard" >
                            <ul class="steps form-wizard">
                                <li data-target="#step1" class="active">
                                    <a data-toggle="tab" class="badge badge-info">1</a>สร้างชื่อกลุ่มผู้ใช้<span class="chevron"></span>
                                </li>
                                <li data-target="#step2">
                                    <a data-toggle="tab" class="badge">2</a>กําหนดสิทธิ์ในการเข้าถึงเมนู <span class="chevron"></span>
                                </li>
                                <li data-target="#step3">
                                    <a data-toggle="tab" class="badge">3</a>เสร็จสมบูรณ์<span class="chevron"></span>
                                </li>

                            </ul>
                            <div class="actions">
                                <button type="button" class="btn btn-sm btn-primary btn-prev">
                                    <i class="fa fa-arrow-left"></i>ย้อนกลับ
                                </button>
                                <button type="button" class="btn btn-sm btn-success btn-next" data-last="Save">
                                    ต่อไป<i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="step-content">
                            <form class="form-horizontal" action="{{ action('UserGroupController@postAddUserGroup') }}" id="fuelux-wizard" method="post">
                                {!! csrf_field() !!}
                                <div class="step-pane active" id="step1">
                                    <h3><strong>Step 1 </strong> - สร้างชื่อกลุ่มผู้ใช้</h3>

                                    <!-- wizard form starts here -->
                                    <fieldset>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">รหัสกลุ่มผู้ใช้</label>
                                            <div class="col-md-10 col-lg-6">
                                                <input class="form-control" id="USER_PRIVILEGE_ID" name="USER_PRIVILEGE_ID" type="text">

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ชื่อกลุ่มผู้ใช้</label>
                                            <div class="col-md-10 col-lg-6">
                                                <input class="form-control" name="user_group_name" type="text">

                                            </div>

                                        </div>




                                    </fieldset>

                                </div>

                                <div class="step-pane" id="step2">
                                    <h3><strong>Step 2 </strong> - กําหนดสิทธิ์ในการเข้าถึงเมนู </h3>


                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12 col-md-12">
                                            <div class="tree smart-form">
                                                <ul role="tree">
                                                    <li class="parent_li" role="treeitem">
                                                        <span><i class="fa fa-lg fa-plus-circle"></i> เมนูระดับผู้ใช้</span>
                                                        <ul role="group">


                                                            @if(isset($menu_frontend_list))

                                                                @foreach($menu_frontend_list as $menu)

                                                                    {{--MENU_GROUP_FLAG--}}

                                                                    <li style="display:block" class="parent_li" role="treeitem">
															    <span> <label class="checkbox inline-block">

                                                                        @if($menu['MENU_GROUP_FLAG'] == 0)
                                                                        <input type="checkbox"  checked="checked" value="{{$menu['MENU_GROUP_ID']}}" class="check_menu_group" name="checkbox-inline">
                                                                        @else
                                                                            <input type="checkbox"   value="{{$menu['MENU_GROUP_ID']}}" class="check_menu_group" name="checkbox-inline">

                                                                        @endif

                                                                        <i></i>{{$menu['MENU_GROUP_NAME']}}</label> </span>

                                                                        @if($menu['item'])
                                                                            <ul role="group">
                                                                                @foreach($menu['item'] as $sub_menu)
                                                                                    {{--$sub_menu['MENU_FLAG']--}}

                                                                                    <li style="display:block" class="parent_li" role="treeitem">
															    <span> <label class="checkbox inline-block">
                                                                        @if($sub_menu['MENU_FLAG'] == 0)
                                                                            <input type="checkbox" class="check_submenu" checked="checked" value="{{$menu['MENU_GROUP_ID'].":".$sub_menu['MENU_ID']}}" name="checkbox_menu_list[]">
                                                                        @else
                                                                            <input type="checkbox" class="check_submenu" value="{{$menu['MENU_GROUP_ID'].":".$sub_menu['MENU_ID']}}" name="checkbox_menu_list[]">
                                                                        @endif
                                                                        <i></i>{{$sub_menu['MENU_NAME']}}</label> </span>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif

                                                                    </li>

                                                                @endforeach

                                                            @endif


                                                        </ul>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xs-12 col-md-12">
                                            <div class="tree smart-form">
                                                <ul role="tree">
                                                    <li class="parent_li" role="treeitem">
                                                        <span><i class="fa fa-lg fa-plus-circle"></i> เมนูระดับผู้ดูแลระบบ</span>
                                                        <ul role="group">


                                                            @if(isset($menu_backend_list))

                                                                @foreach($menu_backend_list as $menu)



                                                                    <li style="display:block" class="parent_li" role="treeitem">
															    <span> <label class="checkbox inline-block">
                                                                        @if($menu['MENU_GROUP_FLAG'] == 0)
                                                                        <input type="checkbox" checked="checked" value="{{$menu['MENU_GROUP_ID']}}" class="check_menu_group" name="checkbox-inline">
                                                                         @else
                                                                            <input type="checkbox" value="{{$menu['MENU_GROUP_ID']}}" class="check_menu_group" name="checkbox-inline">
                                                                        @endif
                                                                        <i></i>{{$menu['MENU_GROUP_NAME']}}</label> </span>

                                                                        @if($menu['item'])
                                                                            <ul role="group">
                                                                                @foreach($menu['item'] as $sub_menu)
                                                                                    {{--$sub_menu['MENU_FLAG']--}}

                                                                                    <li style="display:block" class="parent_li" role="treeitem">
															    <span> <label class="checkbox inline-block">
                                                                        @if($sub_menu['MENU_FLAG'] == 0)
                                                                        <input type="checkbox" checked="checked" class="check_submenu" value="{{$menu['MENU_GROUP_ID'].":".$sub_menu['MENU_ID']}}" name="checkbox_menu_list[]">
                                                                            @else
                                                                            <input type="checkbox" class="check_submenu" value="{{$menu['MENU_GROUP_ID'].":".$sub_menu['MENU_ID']}}" name="checkbox_menu_list[]">
                                                                        @endif
                                                                        <i></i>{{$sub_menu['MENU_NAME']}}</label> </span>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>

                                                                @endforeach

                                                            @endif


                                                        </ul>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="step-pane" id="step3">
                                    <h3><strong>Step 5 </strong> - Finished!</h3>
                                    <br>
                                    <br>
                                    <h1 class="text-center text-success"><i class="fa fa-check"></i> ท่านได้ทำรายการครบทุกขั้นตอนแล้ว
                                        <br>
                                        <small>กรุณากดปุ่ม ส่งข้อมูล ด้านล่างเพื่อบันทึกรายการ</small></h1>
                                    <br>
                                    <div style="width: 100%;text-align: center">
                                        <button type="submit" class="btn btn-sm btn-success " >
                                            ส่งข้อมูล
                                        </button>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
                                </div>


                            </form>
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
    <input type="hidden" id="isPass"  />

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('backend/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{asset('backend/js/plugin/fuelux/wizard/wizard.min.js')}}"></script>

    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!



        function  checkishave(){
            var ret ;
            var jsondata = {code_id : 0};
            $.ajax({

                type: 'post', // or post?
                dataType: 'json',
                url: '/admin/userGroup/ishave',
                data: jsondata,

                success: function(data) {

                    $("#isPass").val(data);
                   //ret = data;
                    return $("#isPass").val();

                },
                error: function(xhr, textStatus, thrownError) {
//                                alert(xhr.status);
//                                alert(thrownError);
//                                alert(textStatus);
                }
            });



        }

        $(document).ready(function() {


            $(".check_submenu").on('click',function(){

                var chk = $(this).parent().parent().parent().parent().parent().find(".check_menu_group")

                var childcheck = $(this).parent().parent().parent().parent().find(":checked").length
                chk.not(this).prop('checked', this.checked);

                if(childcheck>0){
                    chk.prop("checked","checked");
                }

            })

            $(".check_menu_group").on("click",function(){

                var $this =  $(this);
                var chk = $(this).parent().parent().parent().find("ul[role='group']").find("input:checkbox");

                    chk.not(this).prop('checked', this.checked);




//                $("#mainCheck").on("click",function(){$(".item_checked").not(this).prop('checked', this.checked);});
            });

            $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
//            $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
//                var children = $(this).parent('li.parent_li').find(' > ul > li');
//                if (children.is(':visible')) {
//                    children.hide('fast');
//                    $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
//                } else {
//                    children.show('fast');
//                    $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
//                }
//                e.stopPropagation();
//            });


            var $validator = $("#fuelux-wizard").validate({

                rules: {

                    USER_PRIVILEGE_ID: {
                        required: true,
                        number: true
                    },
                    user_group_name: {
                        required: true
                    }

                },

                messages: {
                    USER_PRIVILEGE_ID:{
                        required : "กรุณาระบุรหัสกลุ่มผู้ใช",
                        number : "กรุณาระบุรหัสกลุ่มผู้ใช้ เป็นรูปแบบตัวเลขเท่านั้น"
                    },

                    user_group_name: {
                        required: "กรุณาระบุชื่อรหัสกลุ่มผู้ใช",

                    }
                },

                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });


            $(".badge").parent().stop().on('click',function(){

                var thival = $(this).find("a").stop().val();
                $(".wizard .actions .btn-next").show();
                if(thival == "3"){
                    $(".wizard .actions .btn-next").hide();
                }
            });

            // fuelux wizard
            var wizard = $('.wizard').wizard();

            $('.wizard').on('change', function(e, data) {
                $(".wizard .actions .btn-next").show();
                console.log('change');

                console.log(data.step);
                console.log(data.direction);

                if(data.step===3 && data.direction==='finished') {
                    alert('hello');

                }

                if(data.step===2 && data.direction==='next') {
                    $(".wizard .actions .btn-next").hide();
                    var checkcount = $(".check_submenu:checked").length;

                    if(checkcount > 0){

                    }else {

                        $.SmartMessageBox({
                            title : "Error!",
                            content : "กรุณากําหนดสิทธิ์ในการเข้าถึงเมนูของกลุ่มผู้ใช้",
                            buttons : '[OK]'
                        }, function(ButtonPressed) {
                            if (ButtonPressed === "OK") {


                            }
                            if (ButtonPressed === "No") {

                            }

                        });
                        return false;
                    }
                }

                if(data.step===1 && data.direction==='next') {

                    var $valid = $("#fuelux-wizard").valid($validator);
                    if($valid){

                        e.preventDefault();

                        var jsondata = {code_id : $("#USER_PRIVILEGE_ID").val()};
                        $.ajax({

                            type: 'post', // or post?
                            dataType: 'json',
                            url: '/admin/userGroup/ishave',
                            data: jsondata,

                            success: function(data) {

                                if(data == 0){
                                    $('.wizard').wizard('selectedItem', { step: 2 });
                                }else {
                                        $.SmartMessageBox({
                                            title : "Error!",
                                            content : "มีรหัสกลุ่มผู้ใช้นี้ในระบบแล้ว",
                                            buttons : '[OK]'
                                        }, function(ButtonPressed) {
                                            if (ButtonPressed === "OK") {


                                            }
                                            if (ButtonPressed === "No") {

                                            }

                                        });
                                }



                            },
                            error: function(xhr, textStatus, thrownError) {
//                                alert(xhr.status);
//                                alert(thrownError);
//                                alert(textStatus);
                            }
                        });





                    }else{
                        $validator.focusInvalid();
                        return false;
                        // cancel change
                    }
                }
            });

            wizard.on('finished', function (e, data) {
                $("#fuelux-wizard").submit();
                //console.log("submitted!");
                $.smallBox({
                    title: "Congratulations! Your form was submitted",
                    content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                    color: "#5F895F",
                    iconSmall: "fa fa-check bounce animated",
                    timeout: 4000
                });

            });


        })

    </script>

@stop