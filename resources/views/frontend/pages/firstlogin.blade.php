@extends('frontend.layouts.login')
@section('content')


    <div class="row">
        <div class="col-md-12">

            @if (Session::has('message'))
                <div class="alert alert-warning fade in alert-dismissable">

                    <strong>{{ Session::get('message') }}</strong>
                </div>
                <p> </p>

                @else
                <div class="alert alert-success fade in alert-dismissable">

                    <strong> สมาชิกเข้าใช้งานระบบในครั้งแรก เพื่อความสะดวกรวดเร็ว ถูกต้องในการบริการกรุณากรอกข้อมูลในช่องข้อความให้ครบถ้วน</strong>
                </div>
            @endif



        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">


            <form id="form_resetpass" class="reg-page sky-form" action="{{ action('Auth\AuthController@ResetPassword') }}" method="post">
                {!! csrf_field() !!}
                <div class="reg-header">
                    <h2>เปลี่ยนรหัสผ่าน</h2>
                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                    {{--@if (Session::has('emp_id'))--}}
                        <input type="hidden" name="emp_id" value="{{ Session::get('emp_id') }}" />
                    {{--@endif--}}
                </div>


                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="email" placeholder="อีเมล์" class="form-control" name="email" id="email">
                </div>
                <div class="margin-bottom-20"></div>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="รหัสผ่านเดิม" class="form-control" name="old_password" id="old_password">
                </div>
                <div class="margin-bottom-20"></div>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="รหัสผ่านใหม่" class="form-control" name="new_password" id="new_password">
                </div>
                <div class="margin-bottom-20"></div>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="ยืนยันรหัสผ่านใหม่" class="form-control" name="con_password" id="con_password">
                </div>
                <div class="margin-bottom-20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn-u btn-u-lg btn-block btn-u-red" type="submit" onclick="return confirm('กรุณาตรวจสอบอีเมลที่ได้ลงทะเบียนไว้กับ ระบบ เพื่อยืนยันตัวตนและตรวจสอบสิทธิ์การใช้งานของท่าน')">ส่งข้อมูล</button>
                    </div>
                </div>

            </form>
        </div>
    </div><!--/row-->

        <script>
            $(document).ready(function(){
                $("#form_resetpass").validate({

                    rules:
                    {
                        email:{
                            required: true,
                            email :true
                        },

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
                        email:{
                            required: 'กรุณากรอกข้อมูล',
                            email: 'ท่านกรอก อีเมล์ ไม่ถูก format'
                        },

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


        </script>

@stop


