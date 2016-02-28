@extends('frontend.layouts.content_chart')
@section('content')

    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">
            {{--<img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/img32-md.jpg" alt="">--}}

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item ">
                    <a href="/profile"><i class="fa fa-bar-chart-o"></i> Overall Profile</a>
                </li>

                <li class="list-group-item ">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> ข้อมูลการลงทุน</a>
                </li>


                <li class="list-group-item ">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> แผนการลงทุน</a>
                </li>
                <li class="list-group-item ">
                    <a href="/cumulative"><i class="fa fa-comments"></i> ข้อมูลอัตราสะสม</a>
                </li>
                <li class="list-group-item active">
                    <a href="/riskassessment"><i class="fa fa-history"></i> แบบประเมินความเสียง</a>
                </li>
                <li class="list-group-item">
                    <a href="/editprofile"><i class="fa fa-user"></i> แก้ไขข้อมูลส่วนตัว</a>
                </li>

            </ul>



        </div>



        <!--End Left Sidebar-->

        <!-- Profile Content -->
        <div class="col-md-9">

            @if($ischeckok)
            <div class="profile-body">


                <div class="row">

                    <div class="headline-center-v2 headline-center-v2-dark margin-bottom-60">
                        <h2>ท่านทำแบบประเมินความเสี่ยงการลงทุนครั้งล่าสุด</h2>
                        <span class="bordered-icon"><i class="fa fa-th-large"></i></span>
                        <p> {{get_date_notime($quizprofile->QUIZ_TEST_DATE)}}</p>
                    </div>



                </div>

                <div class="row margin-bottom-60">
                    <div class="col-sm-4">
                        <div class="service-block-v1 md-margin-bottom-50">
                            <i class="rounded-x icon-energy"></i>
                            <h3 class="title-v3-bg text-uppercase">คะแนนรวม</h3>
                            <p>{{$quizprofile->QUIZ_SCORE}} คะแนน</p>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="service-block-v1 md-margin-bottom-50">
                            <i class="rounded-x icon-badge"></i>
                            <h3 class="title-v3-bg text-uppercase">ระดับความเสี่ยงที่ยอมรับได้</h3>
                            <p>{{$mappingret->RISK_RATE}}</p>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="service-block-v1 md-margin-bottom-50">
                            <i class="rounded-x icon-diamond"></i>
                            <h3 class="title-v3-bg text-uppercase">สัดส่วนการลงทุนที่แนะนำ</h3>
                            <p>{{$mappingret->RATIO_RECOMMENDED}}</p>

                        </div>
                    </div>
                </div>


                <div class="row">

                     <div class="col-xs-12 col-md-12" style="text-align: center">
                         <a href="quiz" class="btn-u btn-u-lg btn-u-red" type="button">ทำแบบสอบถาม</a>
                     </div>
                </div>

            </div>
                @else
                <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>ไม่มีข้อมูลแบบประเมินความเสี่ยง!</h4>

                </div>
            @endif

        </div>

    </div>

    <script>


    </script>

@stop

