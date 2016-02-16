@extends('frontend.layouts.login')
@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <form class="reg-page" action="{{ action('Auth\AuthController@checkLogin') }}">
                {!! csrf_field() !!}
                <div class="reg-header">
                    <h2>เข้าสู่ระบบ</h2>
                </div>

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" placeholder="Username" class="form-control" name="username" id="username" >
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="Password" class="form-control" name="password" id="password">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button class="btn-u pull-right" type="submit">Login</button>
                    </div>
                </div>

                <hr>
                <h4>ลืมรหัสผ่าน ?</h4>
                <p> <a class="color-green" href="#">กดที่นี่</a> ตั้งค่ารหัสผ่านใหม่.</p>
            </form>
        </div>
    </div><!--/row-->



@stop


