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
                                        <input type="text" name="user_id" placeholder="รหัสพนักงาน">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="user_name" placeholder="ชื่อผู้ใช้">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>



                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password" placeholder="Password" id="password">
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
                                            <input type="radio" name="first_login" checked="" value="1">
                                            <i></i>ใช่</label>
                                        <label class="radio">
                                            <input type="radio" name="first_login" value="0">
                                            <i></i>ไม่ใช่</label>

                                    </div>
                                </section>
                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="email" name="email" placeholder="อีเมล์">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input"><i class="icon-append fa fa-phone"></i>
                                            <input type="text" name="phone" placeholder="โทรศัพท์">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>
                                </div>

                                <div class="row">

                                    <section class="col col-6">
                                        <label class="input"><i class="icon-append fa fa-phone"></i>
                                            <input type="text" name="address" placeholder="ที่อยู่">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                               <input type="text" id="expire" name="expire"  class="mea_date_picker" placeholder="ระบุวันที่หมดอายุของรหัสผ่าน"   >
                                        </label>
                                    </section>
                                </div>



                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="select">
                                            <select name="grop_id">
                                                @if($user_group)
                                                    <option value="">กลุ่มผู้ใช้</option>
                                                    @foreach($user_group as $group)
                                                        <option value="{{ $group->USER_PRIVILEGE_ID }}">{{ $group->USER_PRIVILEGE_DESC }}</option>
                                                    @endforeach
                                                @endif
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="select">
                                            <select name="status">
                                                <option value="">สถานะ</option>
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
                                <button type="submit" class="btn btn-primary">ส่งข้อมูล
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



            var $registerForm = $("#smart-form-register").validate({

                // Rules for form validation
                rules : {
                    username : {
                        required : true
                    },
                    email : {
                        required : true,
                        email : true
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
                    },
                    firstname : {
                        required : true
                    },
                    lastname : {
                        required : true
                    },
                    gender : {
                        required : true
                    },
                    terms : {
                        required : true
                    }
                },

                // Messages for form validation
                messages : {
                    login : {
                        required : 'Please enter your login'
                    },
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    password : {
                        required : 'Please enter your password'
                    },
                    passwordConfirm : {
                        required : 'Please enter your password one more time',
                        equalTo : 'Please enter the same password as above'
                    },
                    firstname : {
                        required : 'Please select your first name'
                    },
                    lastname : {
                        required : 'Please select your last name'
                    },
                    gender : {
                        required : 'Please select your gender'
                    },
                    terms : {
                        required : 'You must agree with Terms and Conditions'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });






            meaDatepicker("mea_date_picker");
//
//
//            meaDatepicker("retire");
//
//            meaDatepicker("comeback");




        })

    </script>

@stop