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

                <li class="list-group-item active">
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

                <div class="tab-v2">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home-1" data-toggle="tab" aria-expanded="true" >เปลี่ยนแผนการลงทุน</a></li>
                        <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="true">ประวัติเลือกแผนการลงทุน</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home-1" style="position: relative" >

                            <form action="#" id="sky-form1" class="sky-form">
                                <header>เลือกแผนการลงทุน</header>
                                <div class="alert alert-warning fade in">
                                    <strong>Warning!</strong> * สามารถเปลี่ยนแผนได้ ระหว่างวันที่ 01-31 ของทุกเดือน
                                </div>
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Required field</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="required">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Email validation</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-envelope"></i>
                                                <input type="email" name="email">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">URL validation</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-globe"></i>
                                                <input type="url" name="url">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Date validation</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="date">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Minimum length</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="min">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Maximum length</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="max">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Range length</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="range">
                                            </label>
                                        </section>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Digits validation</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="digits">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Decimal number validation</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="number">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Minimum value</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="minVal">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Maximum value</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="maxVal">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Range value</label>
                                            <label class="input">
                                                <i class="icon-append fa fa-asterisk"></i>
                                                <input type="text" name="rangeVal">
                                            </label>
                                        </section>
                                    </div>
                                </fieldset>

                                <footer>
                                    <button type="submit" class="btn-u btn-u-default">Submit</button>
                                    <button type="button" class="btn-u" onclick="window.history.back();">Back</button>
                                </footer>
                            </form>

                        </div>
                        <div class="tab-pane fade " id="profile-1">



                        </div>


                    </div>
                </div>



            </div>
        </div>
        <!-- End Profile Content -->
    </div>


@stop

