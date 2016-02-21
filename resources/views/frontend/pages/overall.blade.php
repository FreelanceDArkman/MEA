@extends('frontend.layouts.content')
@section('content')

    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">
            {{--<img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/img32-md.jpg" alt="">--}}

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item active">
                    <a href="/profile"><i class="fa fa-bar-chart-o"></i> Overall Profile</a>
                </li>

                <li class="list-group-item">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> ข้อมูลการลงทุน</a>
                </li>


                <li class="list-group-item">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> แผนการลงทุน</a>
                </li>
                <li class="list-group-item">
                    <a href="/cumulative"><i class="fa fa-comments"></i> ข้อมูลอัตราสะสม</a>
                </li>
                <li class="list-group-item">
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
            <div class="profile-body">
                <!--Service Block v3-->
                <div class="row margin-bottom-10">
                    <div class="col-sm-12 sm-margin-bottom-20">
                        <div class="service-block-v3 service-block-u">
                            <i class="icon-users"></i>
                            <span class="service-heading">Overall Profile</span>
                            <span class="counter">ยินดีต้อนรับคุณ นัฐวุฒิ สกุณา</span>

                            <div class="clearfix margin-bottom-10"></div>

                            <div class="row margin-bottom-20">
                                <div class="col-xs-12 col-md-12 service-in">
                                    <ul>
                                        <li>
                                            <small>รหัสพนักงาน</small>
                                            <h4 class="counter">1234567</h4>
                                        </li>
                                        <li>
                                            <small>สังกัด</small>
                                            <h4 class="counter">ฝ่ายพัฒนาระบบงานประยุกต์</h4>
                                        </li>
                                        <li>
                                            <small>แผนการลงทุน</small>
                                            <h4 class="counter">แบบที่ 4 (D.I.Y)</h4>
                                        </li>
                                        <li>
                                            <small>สัดส่วนการลงทุน</small>
                                            <h4 class="counter">ข้อมูลวันที่ 14 ก.ย. 2558</h4>
                                        </li>
                                    </ul>
                                </div>


                                {{--<div class="col-xs-4 col-md-3 service-in">--}}
                                    {{--<small>สังกัด</small>--}}
                                    {{--<h4 class="counter">ฝ่ายพัฒนาระบบงานประยุกต์</h4>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 col-md-3 service-in">--}}
                                    {{--<small>แผนการลงทุน</small>--}}
                                    {{--<h4 class="counter">แบบที่ 4 (D.I.Y)</h4>--}}
                                {{--</div>--}}

                                {{--<div class="col-xs-6 text-right service-in">--}}
                                    {{--<small>สังกัด</small>--}}
                                    {{--<h4 class="counter">6,048</h4>--}}
                                {{--</div>--}}
                            </div>


                        </div>
                    </div>

                </div><!--/end row-->
                <!--End Service Block v3-->

                <hr>
                <div class="row pie-progress-charts margin-bottom-60">
                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-1"><div class="circles-wrp" style="position:relative; display:inline-block;"><svg width="160" height="160"><path fill="transparent" stroke="#eee" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 79.89443752470656 4.0000733121155605 Z"></path><path fill="transparent" stroke="#72c02c" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 24.568484463513414 28.00627840471269 "></path></svg><div class="circles-text-wrp" style="position:absolute; top:0; left:0; text-align:center; width:100%; font-size:40px; height:160px; line-height:160px;"><span class="circles-number"><span class="circles-number">55</span></span><span class="circles-text">%</span></div></div></div>
                        <h3 class="circle-title">ตราสารทุน</h3>

                    </div>
                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-2"><div class="circles-wrp" style="position:relative; display:inline-block;"><svg width="160" height="160"><path fill="transparent" stroke="#eee" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 79.89443752470656 4.0000733121155605 Z"></path><path fill="transparent" stroke="#72c02c" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 4.153621191303614 84.82978484072875 "></path></svg><div class="circles-text-wrp" style="position:absolute; top:0; left:0; text-align:center; width:100%; font-size:40px; height:160px; line-height:160px;"><span class="circles-number"><span class="circles-number">45</span></span><span class="circles-text">%</span></div></div></div>
                        <h3 class="circle-title">ตราสารหนี้</h3>
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
                    </div>
                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-3"><div class="circles-wrp" style="position:relative; display:inline-block;"><svg width="160" height="160"><path fill="transparent" stroke="#eee" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 79.89443752470656 4.0000733121155605 Z"></path><path fill="transparent" stroke="#72c02c" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 18.57167552753244 124.74998270955244 "></path></svg><div class="circles-text-wrp" style="position:absolute; top:0; left:0; text-align:center; width:100%; font-size:40px; height:160px; line-height:160px;"><span class="circles-number"><span class="circles-number">13</span></span><span class="circles-text">%</span></div></div></div>
                        <h3 class="circle-title">อัตราสะสม</h3>
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
                    </div>
                    <div class="inner-pchart col-md-3">
                        <div class="circle" id="circle-3"><div class="circles-wrp" style="position:relative; display:inline-block;"><svg width="160" height="160"><path fill="transparent" stroke="#eee" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 79.89443752470656 4.0000733121155605 Z"></path><path fill="transparent" stroke="#72c02c" stroke-width="8" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 18.57167552753244 124.74998270955244 "></path></svg><div class="circles-text-wrp" style="position:absolute; top:0; left:0; text-align:center; width:100%; font-size:40px; height:160px; line-height:160px;"><span class="circles-number"><span class="circles-number">10</span></span><span class="circles-text">%</span></div></div></div>
                        <h3 class="circle-title">อัตราสมทบ</h3>
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
                    </div>
                </div>
                <hr>
                <div class="row margin-bottom-40">
                    <div class="counters col-md-4 col-sm-4">
                        <i class="fa fa-gift rounded"></i><br/>
                        <span class="counter">140,000.00 บาท</span>
                        <h4>เงินลงทุนทั้งหมด</h4>
                    </div>
                    <div class="counters col-md-4 col-sm-4">
                        <i class="fa fa-gift rounded"></i><br/>
                        <span class="counter">55,000.00 บาท</span>
                        <h4>เงินตราสารทุน</h4>
                    </div>
                    <div class="counters col-md-4 col-sm-4">
                        <i class="fa fa-gift rounded"></i><br/>
                        <span class="counter">80,000.00 บาท</span>
                        <h4>เงินตราสารหนี้</h4>
                    </div>

                </div>

            </div>
        </div>
        <!-- End Profile Content -->
    </div>

@stop

