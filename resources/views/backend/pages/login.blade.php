@extends('backend.layouts.default_login')
@section('content')

<div class="row ">

    @if (Session::has('messages'))
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">
                ×
            </button>
            <i class="fa-fw fa fa-times"></i>
            <strong>Error!</strong> {{ Session::get('messages') }}

        </div>


    @endif
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm login-bg">
            {{--<h1 class="txt-color-red login-header-big">มุ่งสู่องค์สมถนะสูง</h1>--}}

            <h1 style="height: 50px"></h1>
            <div class="hero">

                <div class="pull-left login-desc-box-l">
                    <h1 class="txt-color-red login-header-big">เป็นองค์กรชั้นนำ <br/>
                        ด้านธุรกิจพลังงานไฟฟ้าในระดับสากล </h1>
                    {{--<div class="login-app-icons">--}}
                        {{--<a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>--}}
                        {{--<a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>--}}
                    {{--</div>--}}
                </div>

                <img src="{{asset('/backend/img/logo.png')}}" class="pull-right display-image" alt="" style="width:210px">

            </div>



        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
            <div class="well no-padding">
                <form action="{{ action('Auth\AdminAuthController@checkLogin') }}"  method="post" id="login-form" class="smart-form client-form">
                    {!! csrf_field() !!}
                    <header>
                        เข้าสู่ระบบ
                    </header>

                    <fieldset>

                        <section>
                            <label class="label">Username</label>
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <input type="text" name="username">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                        </section>

                        <section>
                            <label class="label">Password</label>
                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                                <input type="password" name="password">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                            <div class="note">
                                <a href="forgotpassword">ลืมรหัสผ่าน?</a>
                            </div>
                        </section>

                        {{--<section>--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" name="remember" checked="">--}}
                                {{--<i></i>Stay signed in</label>--}}
                        {{--</section>--}}
                    </fieldset>
                    <footer>
                        <button type="submit" class="btn btn-primary">
                            Sign in
                        </button>
                    </footer>
                </form>

            </div>

            {{--<h5 class="text-center"> - Or sign in using -</h5>--}}

            {{--<ul class="list-inline text-center">--}}
                {{--<li>--}}
                    {{--<a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>--}}
                {{--</li>--}}
            {{--</ul>--}}

        </div>
    </div>
<!-- END MAIN PANEL -->

<script type="text/javascript">
    runAllForms();

    $(function() {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules : {
                username : {
                    required : true,
                    minlength : 1,
                    maxlength : 7

                },
                password : {
                    required : true,
                    minlength : 8,
                    maxlength : 12
                }
            },

            // Messages for form validation
            messages : {
                username : {
                    required : 'กรุณาใส่ชื่อผุ้ใช้',

                },
                password : {
                    required : 'กรุณาใส่รหัสผ่าน',
                    minlength: 'กรุณากรอก 8 ตัวอักษร',
                    maxlength : 'กรุณากรอกไม่เกิน 12 ตัวอักษร'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>

@stop

