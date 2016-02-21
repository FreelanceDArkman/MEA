@extends('frontend.layouts.login')
@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <form class="reg-page" action="{{ action('Auth\AuthController@GetPassword') }}" method="post">
                {!! csrf_field() !!}
                <div class="reg-header">
                    <h2>ลืมรหัสผ่าน?</h2>
                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                </div>

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" placeholder="Username" class="form-control" name="username" id="username" >
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button class="btn-u btn-u-lg btn-block btn-u-red" type="submit">ส่งข้อมูล</button>
                    </div>
                </div>

                {{--<hr>--}}
                {{--<h4>ลืมรหัสผ่าน ?</h4>--}}
                {{--<p> <a class="color-green" href="#">กดที่นี่</a> ตั้งค่ารหัสผ่านใหม่.</p>--}}
            </form>
        </div>
    </div><!--/row-->



@stop


