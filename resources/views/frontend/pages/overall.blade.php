@extends('frontend.layouts.content_chart')
@section('content')

    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">
            {{--<img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/img32-md.jpg" alt="">--}}

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item active">
                    <a href="/profile"><i class="fa fa-home"></i> Overall Profile</a>
                </li>

                <li class="list-group-item">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> ข้อมูลการลงทุน</a>
                </li>


                <li class="list-group-item">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> แผนการลงทุน</a>
                </li>
                <li class="list-group-item">
                    <a href="/cumulative"><i class="fa fa-level-up"></i> ข้อมูลอัตราสะสม</a>
                </li>
                <li class="list-group-item">
                    <a href="/riskassessment"><i class="fa fa-exclamation-triangle"></i> แบบประเมินความเสียง</a>
                </li>
                <li class="list-group-item">
                    <a href="/editprofile"><i class="fa fa-user"></i> แก้ไขข้อมูลส่วนตัว</a>
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
                <div class="row pie-progress-charts margin-bottom-60">

                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-1"></div>
                        <h3 class="circle-title">อัตราสะสม</h3>

                    </div>

                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-2"></div>
                        <h3 class="circle-title">อัตราสมทบ</h3>

                    </div>

                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-3"></div>
                        <h3 class="circle-title">ตราสารทุน</h3>

                    </div>
                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-4"></div>
                        <h3 class="circle-title">ตราสารหนี้</h3>

                    </div>


                </div>




                <div class="row margin-bottom-10">
                    <div class="col-sm-12 sm-margin-bottom-20">
                        <div class="service-block-v3 service-block-u" style="background-color: #ffbf3f">
                            {{--<i class="icon-users"></i>--}}
                            <span class="service-heading"></span>
                            <span class="counter">สัดส่วนการลงทุน</span>






                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 service-in" >
                        <div style="background-color: #f1f1f1;width: 100%">

                            <ul>
                                @if($infoaset)
                                <li>
                                    <small>ข้อมูลวันที่</small>
                                    <h4 class="counter">{{get_date_notime($infoaset->REFERENCE_DATE)}}</h4>
                                </li>
                                @endif
                                    @if($infoaset)
                                <li>
                                    <small>เงินลงทุนทั้งหมด</small>
                                    <h4 class="counter">{{meaNumbermoney($infoaset->INVESTMENT_MONEY) }} บาท</h4>
                                </li>
                                    @endif
                                        @if($infoaset)
                                <li>
                                    <small>เงินตราสารทุน</small>
                                    <h4 class="counter">{{meaNumbermoney($infoaset->EQUITY_FUNDS) }} บาท</h4>
                                </li>
                                    @endif
                                            @if($infoaset)
                                <li>
                                    <small>เงินตราสารหนี้</small>
                                    <h4 class="counter">{{meaNumbermoney($infoaset->BOND_FUNDS) }} บาท</h4>
                                </li>
                                    @endif

                            </ul>
                        </div>

                    </div>

                </div><!--/end row-->
                <!--End Service Block v3-->


                <hr>

                <div class="row pie-progress-charts margin-bottom-60">


                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-5"></div>
                        <h3 class="circle-title">ตราสารทุน</h3>

                    </div>
                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-6"></div>
                        <h3 class="circle-title">ตราสารหนี้</h3>

                    </div>


                </div>

                {{--<div class="row margin-bottom-40">--}}
                    {{--<div class="counters col-md-4 col-sm-4">--}}
                        {{--<i class="fa fa-gift rounded"></i><br/>--}}
                        {{--<span class="counter">140,000.00 บาท</span>--}}
                        {{--<h4>เงินลงทุนทั้งหมด</h4>--}}
                    {{--</div>--}}
                    {{--<div class="counters col-md-4 col-sm-4">--}}
                        {{--<i class="fa fa-gift rounded"></i><br/>--}}
                        {{--<span class="counter">55,000.00 บาท</span>--}}
                        {{--<h4>เงินตราสารทุน</h4>--}}
                    {{--</div>--}}
                    {{--<div class="counters col-md-4 col-sm-4">--}}
                        {{--<i class="fa fa-gift rounded"></i><br/>--}}
                        {{--<span class="counter">80,000.00 บาท</span>--}}
                        {{--<h4>เงินตราสารหนี้</h4>--}}
                    {{--</div>--}}

                {{--</div>--}}

            </div>
        </div>
        <!-- End Profile Content -->
    </div>


    <script>

        $(document).ready(function(){

            CirclesMaster.initCirclesMaster1();

        });

        var CirclesMaster = function () {

            return {

                //Circles Master v1
                initCirclesMaster1: function () {
                    //Circles 1
                    @if($savingrate)
                 Circles.create({
                        id:         'circle-1',
                        percentage: {{$savingrate->USER_SAVING_RATE}},
                        radius:     80,
                        width:      3,
                        number:     {{$savingrate->USER_SAVING_RATE}},
                        text:       '%',
                        colors:     ['#eee', '#FE5000'],
                        duration:   2000
                    })
                    @endif
                    @if($empinfo)
                    //Circles 2
                    Circles.create({
                        id:         'circle-2',
                        percentage: {{$empinfo->CONTRIBUTION_RATE_NEW}},
                        radius:     80,
                        width:      3,
                        number:     {{$empinfo->CONTRIBUTION_RATE_NEW}},
                        text:       '%',
                        colors:     ['#eee', '#FE5000'],
                        duration:   2000
                    })
                    @endif

                    @if($planchoose)
                    //Circles 3
                    Circles.create({
                        id:         'circle-3',
                        percentage: {{$planchoose->EQUITY_RATE}},
                        radius:     80,
                        width:      3,
                        number:     {{$planchoose->EQUITY_RATE}},
                        text:       '%',
                        colors:     ['#eee', '#FE5000'],
                        duration:   2000
                    })
                    @endif

                    @if($planchoose)
                    //Circles 4
                    Circles.create({
                        id:         'circle-4',
                        percentage: {{$planchoose->DEBT_RATE}},
                        radius:     80,
                        width:      3,
                        number:     {{$planchoose->DEBT_RATE}},
                        text:       '%',
                        colors:     ['#eee', '#FFBF3F'],
                        duration:   2000
                    })
                    @endif
                    @if($infoaset)
                    //Circles 5
                    Circles.create({
                        id:         'circle-5',
                        percentage: {{meaNumbermoney($infoaset->EQUITY) }},
                        radius:     80,
                        width:      3,
                        number:     {{meaNumbermoney($infoaset->EQUITY) }},
                        text:       '%',
                        colors:     ['#eee', '#fe5000'],
                        duration:   2000
                    })
                    @endif
                    @if($infoaset)
                    //Circles 6
                    Circles.create({
                        id:         'circle-6',
                        percentage: {{meaNumbermoney($infoaset->DEBT) }},
                        radius:     80,
                        width:      3,
                        number:     {{meaNumbermoney($infoaset->DEBT) }},
                        text:       '%',
                        colors:     ['#eee', '#FFBF3F'],
                        duration:   2000
                    })
                    @endif

                }

            };

        }();
    </script>
@stop

