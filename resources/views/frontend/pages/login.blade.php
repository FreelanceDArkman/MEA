@extends('frontend.layouts.login')
@section('content')



    <div class="row">
        <div class="col-md-5 col-md-offset-4 col-sm-5 col-sm-offset-3">




            <form class="reg-page" action="{{ action('Auth\AuthController@checkLogin') }}" method="post">
                {!! csrf_field() !!}
                <div class="reg-header">
                    <h2>เข้าสู่ระบบ</h2>
                    @if($errors->any())
                        <h4 style="color: red;">{{$errors->first()}}</h4>
                    @endif
                </div>
                <label for="username">ชื่อผู้ใช้</label>
                <div class="input-group margin-bottom-20">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" placeholder="Username" class="form-control" name="username" id="username" >
                </div>
                <label for="password" >รหัสผ่าน</label>
                <div class="input-group " >

                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" maxlength="12" placeholder="Password" class="form-control" name="password" id="password">

                </div>
                <span style="font-size: 16px; color: red; line-height: 10px; height: 20px">*กรณีเข้าระบบครั้งแรก รหัสผ่านคือ ว/ด/ป เกิดของพนักงาน เช่น 31082525</span><br/>
                <span style="font-size: 16px; color: red; line-height: 10px; height: 20px">*รหัสผ่านมีความยาวไม่น้อยกว่า 8-12 หลัก โดยมีทั้งตัวเลขและตัวอักษร   </span>


                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <button class="btn-u btn-u-lg btn-block btn-u-red" type="submit">เข้าสู่ระบบ</button>
                    </div>
                </div>

                <hr>
                <h4>ลืมรหัสผ่าน ?</h4>
                <p> 
<a class="color-green" style="color:#e74c3c!important;font-weight:bold;" href="/forgotpassword">กดที่นี่</a> ตั้งค่ารหัสผ่านใหม่.</p>
            </form>
        </div>
    </div><!--/row-->



@stop


