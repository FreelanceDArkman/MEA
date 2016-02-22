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
                        <li class="active"><a href="#home-1" data-toggle="tab" aria-expanded="true" >แนวโน้มสัดส่วนการลงทุน</a></li>
                        <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="true">รายงานผลประโยชน์สมาชิก</a></li>
                        <li class=""><a href="#messages-1" data-toggle="tab" aria-expanded="true">รายงานเปรียบเทียบกองทุนสำรองเลี้ยงชีพ กับเงินบำเหน็จ</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home-1" style="position: relative" >

                            <div id="container" data-reflow="1" style=" min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                        <div class="tab-pane fade " id="profile-1">


                            <div id="container2"  data-reflow="1"  style=" min-width: 310px; height: 400px; margin: 0 auto"></div>

                            <hr>
                            <div class="table-responsive">

                                @if($netasset2)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr >
                                        <th rowspan="3" width="100" style="text-align:center;">งวด</th>
                                        <th rowspan="3" width="100" style="text-align:center;">เงินเดือน</th>
                                        <th rowspan="3" width="100" style="text-align:center;">อายุ (ปี/วัน)</th>
                                        <th rowspan="3" width="100" style="text-align:center;">อายุงาน (ปี/วัน)</th>
                                        <th colspan="4" style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</th>
                                        <th width="100" rowspan="3" style="text-align:center;">รวม</th>
                                    </tr>
                                    <tr >
                                        <th colspan="2" style="text-align:center;">ส่วนของนายจ้าง</th>
                                        <th colspan="2" style="text-align:center;">ส่วนของลูกจ้าง</th>


                                    </tr>

                                    <tr >
                                        <th style="text-align:center;">เงินสมทบ</th>
                                        <th style="text-align:center;">ผลประโยชน์เงินสมทบ</th>

                                        <th style="text-align:center;">เงินสะสม</th>
                                        <th style="text-align:center;">ผลประโยชน์เงินสะสม</th>
                                    </tr>

                                    <tr >
                                        <th style="text-align:center;">1</th>
                                        <th style="text-align:center;">2</th>
                                        <th style="text-align:center;">3</th>
                                        <th style="text-align:center;">4</th>
                                        <th style="text-align:center;">5</th>
                                        <th style="text-align:center;">6</th>
                                        <th style="text-align:center;">7</th>
                                        <th style="text-align:center;">8</th>
                                        <th style="text-align:center;">9</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @foreach($netasset2 as $index =>$item)
                                        <tr>
                                            <td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>
                                            <td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>
                                            <td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2+$item->MEMBER_CONTRIBUTION_3+$item->MEMBER_EARNING_4)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                                @endif
                            </div>

                        </div>
                        <div class="tab-pane fade" id="messages-1">

                            <div id="container3" data-reflow="1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


                            <hr>
                            <div class="table-responsive">

                                @if($netasset2)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr >
                                        <th rowspan="3" width="70" style="text-align:center;">งวด</th>
                                        <th rowspan="3" width="60" style="text-align:center;">เงินเดือน</th>
                                        <th rowspan="3" width="60" style="text-align:center;">อายุ <br>(ปี/วัน)</th>
                                        <th rowspan="3" width="60" style="text-align:center;">อายุงาน<br> (ปี/วัน)</th>
                                        <th colspan="6" style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</th>



                                        <th width="100" rowspan="2" colspan="3" style="text-align:center;">เงินบำเหน็จ (บาท)</th>
                                        <th width="100" rowspan="2" colspan="3" style="text-align:center;">เปรียบเทียบกองทุนสำรองเลี้ยงชีพฯ กับเงินบำเหน็จ(บาท)</th>
                                    </tr>
                                    <tr >
                                        <th colspan="3" style="text-align:center;">ส่วนของนายจ้าง</th>
                                        <th colspan="3" style="text-align:center;">ส่วนของลูกจ้าง</th>
                                    </tr>
                                    <tr >
                                        <th style="text-align:center;">เงินสมทบ</th>
                                        <th style="text-align:center;">ผลประโยชน์เงินสมทบ</th>
                                        <th style="text-align:center;">รวม</th>

                                        <th style="text-align:center;">เงินสะสม</th>
                                        <th style="text-align:center;">ผลประโยชน์เงินสะสม</th>
                                        <th style="text-align:center;">รวม</th>

                                        <th style="text-align:center;">เงินบำเหน็จก่อนหักภาษี</th>
                                        <th style="text-align:center;">ภาษี</th>
                                        <th style="text-align:center;">เงินบำเหน็จสุทธิหลังหักภาษี</th>


                                        <th style="text-align:center;">ผลรวมส่วนของนายจ้าง </th>
                                        <th style="text-align:center;">เงินสุทธิหลังหักภาษี</th>
                                        <th style="text-align:center;">ส่วนต่าง </th>


                                    </tr>
                                    <tr >
                                        <th style="text-align:center;">1</th>
                                        <th style="text-align:center;">2</th>
                                        <th style="text-align:center;">3</th>
                                        <th style="text-align:center;">4</th>
                                        <th style="text-align:center;">5</th>
                                        <th style="text-align:center;">6</th>
                                        <th style="text-align:center;">7</th>
                                        <th style="text-align:center;">8</th>
                                        <th style="text-align:center;">9</th>
                                        <th style="text-align:center;">10</th>
                                        <th style="text-align:center;">11</th>
                                        <th style="text-align:center;">12</th>
                                        <th style="text-align:center;">13</th>
                                        <th style="text-align:center;">14</th>
                                        <th style="text-align:center;">15</th>
                                        <th style="text-align:center;">16</th>
                                    </tr>



                                    </thead>


                                    <tbody style="cellpadding:2px;">

                                    @foreach($netasset2 as $index =>$item)
                                    <tr>
                                        <td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>
                                        <td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>

                                        <td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1  + $item->EMPLOYER_EARNING_2)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3 + $item->MEMBER_EARNING_4)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY_TAX)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY - $item->GRATUITY_TAX)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2 )}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY - $item->GRATUITY_TAX)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney(($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2) - ($item->GRATUITY - $item->GRATUITY_TAX))}}</td>

                                    </tr>
                                    @endforeach



                                    </tbody>


                                </table>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>



            </div>
        </div>
        <!-- End Profile Content -->
    </div>



    <script type="text/javascript">

//        function recall(){
//
//            alert('eee');
//        }

        $(function () {


            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//                e.target // newly activated tab
//                e.relatedTarget // previous active tab
                //alert("asd");
                //$("#container").resize();

                $('DIV[data-reflow="1"]').highcharts().reflow();

                $("#container2").highcharts().reflow();
                $("#container3").highcharts().reflow();

            })

            jQuery('#container').highcharts(
                    {!! json_encode($graph)!!}
            )

            jQuery('#container2').highcharts(
                    {!! json_encode($graph2)!!}
            )

            jQuery('#container3').highcharts(
                    {!! json_encode($graph3)!!}
            )


        });
    </script>
@stop

