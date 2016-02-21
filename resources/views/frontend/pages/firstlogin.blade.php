@extends('frontend.layouts.login')
@section('content')



    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">


            <form class="reg-page" action="{{ action('Auth\AuthController@ResetPassword') }}" method="post">
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

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="รหัสผ่านเดิม" class="form-control" name="old_password" id="old_password">
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="รหัสผ่านใหม่" class="form-control" name="new_password" id="new_password">
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" placeholder="ยืนยันรหัสผ่านใหม่" class="form-control" name="con_password" id="con_password">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn-u btn-u-lg btn-block btn-u-red" type="submit">ส่งข้อมูล</button>
                    </div>
                </div>

            </form>
        </div>
    </div><!--/row-->



@stop


