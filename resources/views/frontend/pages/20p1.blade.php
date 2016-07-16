@extends('frontend.layouts.content_chart')
@section('content')


    <?php

    $data = getmemulist();

    // Make the page validate
    ini_set('session.use_trans_sid', '0');

    // Create a random string, leaving out 'o' to avoid confusion with '0'
    $char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));

    // Concatenate the random string onto the random numbers
    // The font 'Anorexia' doesn't have a character for '8', so the numbers will only go up to 7
    // '0' is left out to avoid confusion with 'O'
    $str = rand(1, 7) . rand(1, 7) . $char;

    // Begin the session
    session_start();

    // Set the session contents
    $_SESSION['captcha_id'] = $str;

    ?>

    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">
            {{--<img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/img32-md.jpg" alt="">--}}

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item ">
                    <a href="/profile"><i class="fa fa-home"></i> Overall Profile</a>
                </li>

                <li class="list-group-item">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> {{ getGoupName($data,21) }}</a>
                </li>


                <li class="list-group-item">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> {{ getGoupName($data,22) }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/cumulative"><i class="fa fa-level-up"></i> {{ getGoupName($data,23) }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/riskassessment"><i class="fa fa-exclamation-triangle"></i> {{ getGoupName($data,24) }}</a>
                </li>
                <li class="list-group-item active">
                    <a href="/editprofile"><i class="fa fa-user"></i> {{ getMenuName($data,20,1) }}</a>
                </li>

            </ul>



        </div>



        <!--End Left Sidebar-->

        <!-- Profile Content -->
        <div class="col-md-9">
            <div class="profile-body">
                <!--Service Block v3-->
                <div class="row margin-bottom-10">
                    <div class="col-sm-12 sm-margin-bottom-20">
                        <div class="service-block-v3 service-block-u">
                            <i class="icon-users"></i>
                            <span class="service-heading">Overall Profile</span>
                            <span class="counter">ยินดีต้อนรับคุณ {{$empinfo->FULL_NAME}}</span>



                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 service-in">
                        <div style="background-color: #f1f1f1;width: 100%">
                            <ul>
                                <li>
                                    <small>รหัสพนักงาน</small>
                                    <h4 class="counter">{{$empinfo->EMP_ID}}</h4>
                                </li>
                                <li>
                                    <small>สังกัด</small>
                                    <h4 class="counter">{{$empinfo->DEP_SHT}}</h4>
                                </li>
                                <li>
                                    <small>แผนการลงทุน</small>

                                    @if($planchoose)
                                    <h4 style="text-align: center" class="counter">{{$planchoose->PLAN_NAME}}</h4>
                                        @else
                                        <h4 style="text-align: center" class="counter"></h4>
                                    @endif
                                </li>

                            </ul>
                        </div>
                    </div>

                </div><!--/end row-->
                <!--End Service Block v3-->

                <hr>

                <?php

                $page = 1;
                $p = Request::path();
                $arrP = explode('/',$p);


                //                    var_dump(count($arrP));

                if(count($arrP) > 1){
                    if($arrP[1] != null){
                        $page = $arrP[1];
                    }
                }





                function getde ($page,$target){
                    $ret = "";
                    if($page== $target || $page == "e".$target){
                        $ret = "active";
                    }

                    return $ret;
                }
                ?>
                <div class="tab-v2">
                    <ul class="nav nav-tabs">

                            <li class="<?php echo getde($page,1) ?>"><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,20,1) }}</a></li>
                            <li class="<?php echo getde($page,2) ?>"><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,20,2) }}</a></li>
                        <li class="<?php echo getde($page,3) ?>"><a href="#profile-2" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,20,3) }}</a></li>

                    </ul>
                    <div class="tab-content">

                            <div class="tab-pane fade <?php echo getde($page,1) ?> in" id="home-1" style="position: relative" >

                                <form action="{{action('editprofileController@EditProfile')}}" method="post" id="sky-form3" class="sky-form contact-style">

                                    {!! csrf_field() !!}<fieldset class="no-padding">
                                        <label>รหัสสมาชิก <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="emp_id" id="emp_id" disabled class="form-control" value="{{$userinfo->EMP_ID}}">
                                                </div>
                                            </div>
                                        </div>

                                        <label>คำนำหน้าชื่อ <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="emp_prefix" id="emp_prefix" disabled value="{{$userinfo->PREFIX}}" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <label>ชื่อ <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="name"  disabled id="name" class="form-control" value="{{$userinfo->FIRST_NAME}}">
                                                </div>
                                            </div>
                                        </div>

                                        <label>สกุล <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="surname" id="surname" disabled class="form-control" value="{{$userinfo->LAST_NAME}}">
                                                </div>
                                            </div>
                                        </div>



                                        <label>หน่วยงาน <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="depart" id="depart" disabled class="form-control" value="{{$userinfo->DEP_LNG}}">
                                                </div>
                                            </div>
                                        </div>

                                        <label>อีเมล์ <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="email" id="email" class="form-control" value="{{$userinfo->EMAIL}}">
                                                </div>
                                            </div>
                                        </div>
                                        <label>โทรศัพท์ <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="phone" id="phone" class="form-control" value="{{$userinfo->PHONE}}">
                                                </div>
                                            </div>
                                        </div>
                                        <label>ที่อยู่ <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="address" id="address" class="form-control" value="{{$userinfo->ADDRESS}}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row sky-space-20">
                                            <div class="col-md-11 col-md-offset-0">
                                                <div>
                                                    <label class="label">Enter characters below:</label>
                                                    <img src="{{asset("frontend/assets/plugins/sky-forms-pro/skyforms/captcha/image.php?")}}<?php echo time(); ?>" width="100" height="32" alt="Captcha image" />
                                                    <input type="text" maxlength="6" name="captcha" id="captcha">
                                                </div>
                                            </div>
                                        </div>
                                        {{--<section>--}}
                                        {{--<label class="label">Enter characters below:</label>--}}
                                        {{--<label class="input input-captcha">--}}

                                        {{--</label>--}}
                                        {{--</section>--}}

                                        <p><button type="submit" class="btn-u">ส่งข้อมูล</button></p>
                                    </fieldset>

                                    <div class="message">
                                        <i class="rounded-x fa fa-check"></i>
                                        <p>Your message was successfully sent!</p>
                                    </div>
                                </form>


                           </div>
                         <div class="tab-pane fade <?php echo getde($page,2) ?> in" id="profile-1">
                            <div class="table-responsiv">
                                {{--$_SERVER['SCRIPT_FILENAME'];--}}
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <td>ลำดับที่</td>
                                        <td>ชื่อไฟล์</td>
                                        <td>วันที่เปลี่ยนแปลงข้อมูล</td>
                                        <td>ดูไฟล์</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($userbenefit)

                                        @foreach($userbenefit as $index=>$row)
                                        <tr>
                                            <td>{{$row->FILE_NO}}</td>
                                            <td>{{$row->FILE_NAME}}</td>
                                            <td>{{get_date_notime($row->CREATE_DATE)}}</td>
                                            <td><a  href="/editprofile/download/{{base64_encode(get_userID())}}" class="btn-u btn-u-red" type="button">ดูไฟล์</a></td>
                                        </tr>
                                        @endforeach

                                        @endif
                                    </tbody>

                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade <?php echo getde($page,3) ?> in" id="profile-2">

                            <form id="form_resetpass" style="font-family: DB Ozone X !important;" class="reg-page" action="{{ action('editprofileController@ResetPassworduser') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="reg-header">
                                    <h2>เปลี่ยนรหัสผ่าน</h2>
                                    @if($errors->any())
                                        <h4>{{$errors->first()}}</h4>
                                    @endif

                                    @if (Session::has('emp_id'))
                                        <input type="hidden" name="emp_id" value="{{ Session::get('emp_id') }}" />
                                    @endif
                                </div>
                                @if (Session::has('message'))
                                    <p>{{ Session::get('message') }} </p>
                                @endif



                                <label style="margin-left: 45px">รหัสผ่านเดิม <span class="color-red">*</span></label>
                                <div class="input-group margin-bottom-20" style="padding: 0 40px 0 40px;">

                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" maxlength="12" placeholder="รหัสผ่านเดิม" class="form-control" name="old_password" id="old_password">
                                </div>
                                <label style="margin-left: 45px">รหัสผ่านใหม่ <span class="color-red">*</span></label>
                                <div class="input-group "  style="padding: 0 40px 0 40px;">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" maxlength="12" placeholder="รหัสผ่านใหม่" class="form-control" name="new_password" id="new_password">
                                </div>
                                <span style="margin-left: 45px;font-size: 16px; color: red; line-height: 10px; height: 20px">*รหัสผ่านมีความยาวไม่น้อยกว่า 8-12 หลัก โดยมีทั้งตัวเลขและตัวอักษร   </span>
                                <div class="margin-bottom-20"></div>
                                <label style="margin-left: 45px">ยืนยันรหัสผ่านใหม่ <span class="color-red">*</span></label>
                                <div class="input-group "  style="padding: 0 40px 0 40px;">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" maxlength="12" placeholder="ยืนยันรหัสผ่านใหม่" class="form-control" name="con_password" id="con_password">
                                </div>
                                <div class="margin-bottom-20"></div>
                                <div class="row">
                                    <div class="col-md-12"   style="padding: 0 40px 30px 40px;">
                                        <button class="btn-u btn-u-lg btn-block btn-u-red" type="submit">ส่งข้อมูล</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>



                    </div>
                </div>
                <!-- End Profile Content -->
            </div>
        </div>

            <script>

                $(document).ready(function(){

                    ContactForm.initContactForm();


            $("#form_resetpass").validate({

                rules:
                {

                    old_password:
                    {
                        required: true,
                        minlength : 8,
                        maxlength :12

                    },
                    new_password:{
                        required: true,
                        minlength : 8,
                        maxlength :12

                    },


                    con_password:
                    {
                        required: true,
                        equalTo : '#new_password',
                        minlength : 8,
                        maxlength :12

                    }

                },

                // Messages for form validation
                messages:
                {

                    old_password:
                    {
                        required: 'กรุณากรอกข้อมูล',
                        minlength: 'กรุณากรอก 8 ตัวอักษร',
                        maxlength : 'กรุณากรอกไม่เกิน 12 ตัวอักษร'
                    },
                    new_password  :{
                        required: 'กรุณากรอกข้อมูล',
                        minlength: 'กรุณากรอก 8 ตัวอักษร',
                        maxlength : 'กรุณากรอกไม่เกิน 12 ตัวอักษร'

                    },
                    con_password  :{
                        equalTo: 'กรุณาใส่ รหัสผ่านให้ถูกต้อง',
                        required: 'กรุณากรอกข้อมูล',
                        minlength: 'กรุณากรอก 8 ตัวอักษร',
                        maxlength : 'กรุณากรอกไม่เกิน 12 ตัวอักษร'

                    }
                },

                // Do not change code below
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                }
            });



                });


                var ContactForm = function () {

                    return {

                        //Contact Form
                        initContactForm: function () {

                            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                                return arg != value;
                            }, "Value must not equal arg.");


                            //$("form").validate({
                            //	rules: {
                            //		SelectName: { valueNotEquals: "default" }
                            //	},
                            //	messages: {
                            //		SelectName: { valueNotEquals: "Please select an item!" }
                            //	}
                            //});

                            // Validation
                            $("#sky-form3").validate({
                                // Rules for form validation
                                rules:
                                {

                                    email:
                                    {
                                        required: true,
                                        email: true
                                    },
                                    phone:{
                                        required: true,
                                        number: true
                                    },


                                    address:
                                    {
                                        required: true

                                    },
                                    captcha:
                                    {
                                        required: true,
                                        remote: 'frontend/assets/plugins/sky-forms-pro/skyforms/captcha/process.php'
                                    }
                                },

                                // Messages for form validation
                                messages:
                                {

                                    email:
                                    {
                                        required: 'กรุณากรอกข้อมูล',
                                        email: 'ท่านกรอก อีเมล์ไม่ถูกต้อง'
                                    },
                                    phone  :{
                                        required: 'กรุณากรอกข้อมูล',
                                        number: 'เบอร์โทรศัพท์ เป็นตัวเลขเท่านั้น'
                                    },


                                    captcha:
                                    {
                                        required: 'Please enter characters',
                                        remote: 'Correct captcha is required'
                                    }
                                },

//                                // Ajax form submition
//                                submitHandler: function(form)
//                                {
//                                    $(form).ajaxSubmit(
//                                            {
//                                                beforeSend: function()
//                                                {
//                                                    $('#sky-form3 button[type="submit"]').attr('disabled', true);
//                                                },
//                                                success: function()
//                                                {
//                                                    $("#sky-form3").addClass('submited');
//                                                }
//                                            });
//                                },

                                // Do not change code below
                                errorPlacement: function(error, element)
                                {
                                    error.insertAfter(element.parent());
                                }
                            });
                        }

                    };

                }();




            </script>


@stop

