@extends('backend.layouts.default')
@section('content')
    <?php
    $data = getmemulist();
    $arrSidebar =getSideBar($data);
    ?>

    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i>

                    {{getMenutitle($arrSidebar)}}
                </h1>
            </div>

        </div>


        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>


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

                        <form id="smart-form-register" action="{{action('UserController@postAddUser') }}" method="post"  class="smart-form">
                            {!! csrf_field() !!}


                            <fieldset>
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" id="user_id" name="user_id" placeholder="รหัสพนักงาน">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" id="user_name" name="user_name" placeholder="ชื่อผู้ใช้">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>



                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" id="password" name="password" placeholder="Password" id="password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="passwordConfirm" placeholder="Confirm password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                </section>

                                <header>
                                    ล็อกอินเข้าระบบครั้งแรก
                                </header>

                                <section style="margin-top: 15px;margin-left: 20px;">
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" class="chk_firstlogin" name="first_login" checked="" value="1">
                                            <i></i>ใช่</label>
                                        <label class="radio">
                                            <input type="radio" class="chk_firstlogin" name="first_login" value="0">
                                            <i></i>ไม่ใช่</label>

                                    </div>


                                </section>

                                <header>
                                    รหัสผ่านหมดอายุ
                                </header>

                                <section style="margin-top: 15px;margin-left: 20px;">
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" class="chk_expire" name="pass_expire" checked="" value="1">
                                            <i></i>ใช่</label>
                                        <label class="radio">
                                            <input type="radio" class="chk_expire" name="pass_expire" value="0">
                                            <i></i>ไม่ใช่</label>

                                    </div>


                                </section>
                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="email"  id="email" name="email" placeholder="อีเมล์">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input"><i class="icon-append fa fa-phone"></i>
                                            <input type="text" id="phone" name="phone" placeholder="โทรศัพท์">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>
                                </div>

                                <div class="row">

                                    <section class="col col-6">
                                        <label class="input"><i class="icon-append fa fa-phone"></i>
                                            <input type="text" id="address" name="address" placeholder="ที่อยู่">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>

                                    <section class="col col-6" id="expire_check">
                                        <label class="input state-success"> <i class="icon-append fa fa-calendar"></i>
                               <input type="text" id="expire" name="expire"  class="mea_date_picker" placeholder="ระบุวันที่หมดอายุของรหัสผ่าน"   >
                                        </label>
                                    </section>
                                </div>



                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="select">
                                            <select id="group_id" name="group_id">
                                                @if($user_group)
                                                    <option value="default">กลุ่มผู้ใช้</option>
                                                    @foreach($user_group as $group)
                                                        <option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>
                                                    @endforeach
                                                @endif
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="select">
                                            <select id="status" name="status">
                                                <option value="default">สถานะ</option>
                                                @if($user_status)
                                                    @foreach($user_status as $status)
                                                        <option value="{{ $status->USER_STATUS_ID }}">{{ $status->STATUS_DESC }}</option>
                                                    @endforeach
                                                @endif
                                            </select> <i></i> </label>
                                    </section>
                                </div>

                                <div class="row">

                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="retire"  class="mea_date_picker" id="retire" placeholder="วันที่ลาออกจากกองทุน"  >
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="comeback"  class="mea_date_picker" id="comeback" placeholder="วันที่กลับเข้ากองทุน" >

                                            {{--class="datepicker" data-dateformat='dd/mm/yy'--}}
                                        </label>
                                    </section>
                                </div>


                            </fieldset>
                            <footer>
                                <button type="submit"  class="btn btn-primary">ส่งข้อมูล
                                </button>
                                <button type="button" class="btn btn-default" onclick="window.history.back();">
                                    ยกเลิก
                                </button>
                            </footer>
                        </form>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->






        </article>
        <!-- END COL -->

    </div>






    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('backend/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function() {

            $(".chk_expire").on('click',function(){

                    var res = $(this).val();

                if(res == 0){
                    $("#expire_check").hide();
                }
                if(res == 1){
                    $("#expire_check").show();
                }

            });

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Please Choose one");

            var $registerForm = $("#smart-form-register").validate({



                // Rules for form validation
                rules : {
                    user_id : {
                        required : true,
                        maxlength: 7,
                        number : true
                    },
                    user_name : {
                        required : true

                    },
                    email : {
                        required : true,
                        email : true
                    },
                    status : {valueNotEquals: "default"},
                    group_id:{
                        valueNotEquals: "default"
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 20
                    },
                    passwordConfirm : {
                        required : true,
                        minlength : 3,
                        maxlength : 20,
                        equalTo : '#password'
                    }
                },

                // Messages for form validation
//                messages : {
//                    username : {
//                        required : "กรุณากรอก ชื่อผู้ใช้",
//                        maxlength: "ชื่อผู้ใช้ต้องมีจำนวนไม่เกิน 7 หลัก",
//                        number : "ชื่อผู้ใช้ต้องเป็นตัวเลขเท่านั้น"
//                    },
//                    email : {
//                        required : "กรุณากรอก ที่อยู่อีเมล์",
//                        email :"ใส่อีเมล์ไม่ถูกต้อง"
//                    },
//                    password : {
//                        required : true,
//                        minlength : 3,
//                        maxlength : 20
//                    },
//                    passwordConfirm : {
//                        required : true,
//                        minlength : 3,
//                        maxlength : 20,
//                        equalTo : '#password'
//                    },
//                    firstname : {
//                        required : true
//                    },
//                    lastname : {
//                        required : true
//                    },
//                    gender : {
//                        required : true
//                    },
//                    terms : {
//                        required : true
//                    }
//                },
                // Ajax form submition
                submitHandler: function(form)
                {
                    $(form).ajaxSubmit(
                    {
//                        beforeSend: function()
//                        {
//                            alert('no');
//                        },
                        success: function()
                        {
//                            alert('sdsd');

                            var user_id = $("#user_id").val();
                            var user_name = $("#user_name").val();
                            var password= $("#password").val();

                            var chk_firstlogin= $("#chk_firstlogin").val();
                            var chk_expire= $("#chk_expire").val();

                            var email= $("#email").val();
                            var phone= $("#phone").val();
                            var address= $("#address").val();

                            var retire= $("#hd_retire").val();
                            var comeback= $("#hd_comeback").val();
                            var expire= $("#hd_expire").val();

                            var group_id= $("#group_id").val();
                            var status= $("#status").val();

                            var jsondata = {
                                user_id:user_id,
                                user_name :user_name,
                                password:password,
                                chk_firstlogin:chk_firstlogin,
                                chk_expire:chk_expire,
                                email:email,
                                phone:phone,
                                address:address,
                                retire:retire,
                                comeback:comeback,
                                expire:expire,
                                group_id:group_id,
                                status:status
                            };

//                            $(".result").html('<img style="margin: 0 auto;" src="/backend/img/spiner.gif" />');
                            MeaAjax(jsondata,"add",function(data){
                                    alert(data.html);
                            });
                        }
                    });
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });




            meaDatepicker("expire");

            meaDatepicker("retire");
            meaDatepicker("comeback");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");




        })

    </script>

@stop