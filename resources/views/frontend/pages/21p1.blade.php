@extends('frontend.layouts.content_chart')
@section('content')
    <?php
    $data = getmemulist();
    ?>
    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">
            {{--<img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/img32-md.jpg" alt="">--}}

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item ">
                    <a href="/profile"><i class="fa fa-home"></i> Overall Profile</a>
                </li>

                <li class="list-group-item active">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> {{ getGoupName($data,21) }}</a>
                </li>


                <li class="list-group-item">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> {{ getGoupName($data,22) }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/cumulative"><i class="fa fa-level-up"></i> {{ getGoupName($data,23) }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/riskassessment"><i class="fa fa-exclamation-triangle"></i> {{ getGoupName($data,24) }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/editprofile"><i class="fa fa-user"></i> {{ getMenuName($data,20,1) }}</a>
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

                <div class="tab-v2">
                    <ul class="nav nav-tabs">

                        @if($show2 == 1)
                        <li class="active"><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,21,1) }}</a></li>
                        <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,21,2) }}</a></li>
                            @if(get_is_before_status_2538() == 0)
                        <li class=""><a href="#messages-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,21,3) }}</a></li>
                            @endif
                            @elseif($show2 == 2)
                            <li class=""><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,21,1) }}</a></li>
                            <li class="active"><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,21,2) }}</a></li>
                            @if(get_is_before_status_2538() == 0)
                            <li class=""><a href="#messages-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,21,3) }}</a></li>
                            @endif
                        @elseif($show2 == 3)

                            <li class=""><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,21,1) }}</a></li>
                            <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,21,2) }}</a></li>
                            @if(get_is_before_status_2538() == 0)
                            <li class="active"><a href="#messages-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,21,3) }}</a></li>
                            @endif
                        @endif

                    </ul>
                    <div class="tab-content">

                        @if($show2 == 1)
                            <div class="tab-pane fade active in" id="home-1" style="position: relative" >
                            @else
                                <div class="tab-pane fade" id="home-1" style="position: relative" >
                            @endif

                            <form class="form-inline mea_searchbox" role="form" method="post" action="{{action('TrendsController@getIndexbysearchColum')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">

                                    <select name="drop_month" id="drop_month">
                                         {!! $monthColum !!}
                                    </select>
                                    <select name="drop_year" id="drop_year">
                                        {!! $yearColume !!}}
                                        {{--<option value="2011">2554</option>--}}
                                        {{--<option value="2012">2555</option>--}}
                                        {{--<option value="2013">2556</option>--}}
                                        {{--<option value="2014">2557</option>--}}
                                        {{--<option value="2015">2558</option>--}}
                                        {{--<option value="2016">2559</option>--}}
                                        {{--<option value="2017">2560</option>--}}
                                        {{--<option value="2018">2561</option>--}}
                                    </select>
                                </div>


                                <button type="submit" class="btn-u btn-u-default">ค้นหา</button>
                            </form>

                            <div id="container" data-reflow="1" style=" min-width: 310px; height: 400px; margin: 0 auto">

                                <div class="alert alert-danger fade in " id="nodata-1" style="display: none;">
                                    <strong>ขออภัย!</strong>ไม่พบข้อมูล
                                </div>
                            </div>
                        </div>

                                @if($show2 == 2)
                        <div class="tab-pane fade active in" id="profile-1">
                            @else
                                <div class="tab-pane fade " id="profile-1">
                                @endif


                            <form class="form-inline mea_searchbox" role="form" method="post" action="{{action('TrendsController@getIndexbysearchgp2')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label>ตั้งแต่</label>
                                    <select name="drop_month_2_start" id="drop_month_2_start">
                                        {!! $monthColum2 !!}
                                    </select>
                                    <select name="drop_year_2_start" id="drop_year_2_start">
                                        {!! $yearColume2 !!}}
                                        {{--<option value="2011">2554</option>--}}
                                        {{--<option value="2012">2555</option>--}}
                                        {{--<option value="2013">2556</option>--}}
                                        {{--<option value="2014">2557</option>--}}
                                        {{--<option value="2015">2558</option>--}}
                                        {{--<option value="2016">2559</option>--}}
                                        {{--<option value="2017">2560</option>--}}
                                        {{--<option value="2018">2561</option>--}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ถึง</label>
                                    <select name="drop_month_2_end" id="drop_month_2_end">
                                        {!! $monthColumend2 !!}
                                    </select>
                                    <select name="drop_year_2_end" id="drop_year_2_end">
                                        {!! $yearColumeend2 !!}}
                                        {{--<option value="2011">2554</option>--}}
                                        {{--<option value="2012">2555</option>--}}
                                        {{--<option value="2013">2556</option>--}}
                                        {{--<option value="2014">2557</option>--}}
                                        {{--<option value="2015">2558</option>--}}
                                        {{--<option value="2016">2559</option>--}}
                                        {{--<option value="2017">2560</option>--}}
                                        {{--<option value="2018">2561</option>--}}
                                    </select>
                                </div>


                                <button type="submit" class="btn-u btn-u-default">ค้นหา</button>
                            </form>
                            <div id="container2"  data-reflow="1"  style=" min-width: 310px; height: 400px; margin: 0 auto"></div>

                            <hr>

                            {{--<form class="reg-page" action="{{ action('TrendsController@ExportExcel1') }}" method="post">--}}
                                {{--</form>--}}
                            <a href="{{ action('TrendsController@ExportExcel1') }}" class="btn btn-success" style="margin-bottom: 10px" type="button"><i class="fa fa-download"></i> Export</a>

                            <div class="table-responsive">
                                @if($netasset2tbl)
                                <table class="table table-bordered table-striped tbl_mea">
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
                                        <th colspan="2" style="text-align:center;background-color: #ffeba7">ส่วนของนายจ้าง</th>
                                        <th colspan="2" style="text-align:center;background-color: #fff5b4">ส่วนของลูกจ้าง</th>


                                    </tr>

                                    <tr >
                                        <th style="text-align:center;background-color: #ffeba7">เงินสมทบ</th>
                                        <th style="text-align:center;background-color: #ffeba7">ผลประโยชน์เงินสมทบ</th>

                                        <th style="text-align:center;background-color: #fff5b4">เงินสะสม</th>
                                        <th style="text-align:center;background-color: #fff5b4">ผลประโยชน์เงินสะสม</th>
                                    </tr>

                                    {{--<tr >--}}
                                        {{--<th style="text-align:center;">1</th>--}}
                                        {{--<th style="text-align:center;">2</th>--}}
                                        {{--<th style="text-align:center;">3</th>--}}
                                        {{--<th style="text-align:center;">4</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">5</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">6</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">7</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">8</th>--}}
                                        {{--<th style="text-align:center;">9</th>--}}
                                    {{--</tr>--}}
                                    </thead>


                                    <tbody>

                                    @foreach($netasset2tbl as $index =>$item)
                                        <tr>
                                            <td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>
                                            <td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>
                                            <td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>
                                            <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>
                                            <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>
                                            <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>
                                            <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>
                                            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2+$item->MEMBER_CONTRIBUTION_3+$item->MEMBER_EARNING_4)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                                @endif
                            </div>

                        </div>


                           @if(get_is_before_status_2538() == 0)
                                @if($show2 == 3)
                            <div class="tab-pane fade active in" id="messages-1">
                                     @else
                            <div class="tab-pane fade" id="messages-1">
                                    @endif

                            <form class="form-inline mea_searchbox" role="form" method="post" action="{{action('TrendsController@getIndexbysearchgpLastest')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label>ตั้งแต่</label>
                                    <select name="drop_month_3_start" id="drop_month_3_start">
                                        {!! $monthColum3 !!}
                                    </select>
                                    <select name="drop_year_3_start" id="drop_year_3_start">
                                        {!! $yearColume3 !!}}
                                        {{--<option value="2011">2554</option>--}}
                                        {{--<option value="2012">2555</option>--}}
                                        {{--<option value="2013">2556</option>--}}
                                        {{--<option value="2014">2557</option>--}}
                                        {{--<option value="2015">2558</option>--}}
                                        {{--<option value="2016">2559</option>--}}
                                        {{--<option value="2017">2560</option>--}}
                                        {{--<option value="2018">2561</option>--}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ถึง</label>
                                    <select name="drop_month_3_end" id="drop_month_3_end">
                                        {!! $monthColumend3 !!}
                                    </select>
                                    <select name="drop_year_3_end" id="drop_year_3_end">
                                        {!! $yearColumeend3 !!}}
                                        {{--<option value="2011">2554</option>--}}
                                        {{--<option value="2012">2555</option>--}}
                                        {{--<option value="2013">2556</option>--}}
                                        {{--<option value="2014">2557</option>--}}
                                        {{--<option value="2015">2558</option>--}}
                                        {{--<option value="2016">2559</option>--}}
                                        {{--<option value="2017">2560</option>--}}
                                        {{--<option value="2018">2561</option>--}}
                                    </select>
                                </div>


                                <button type="submit" class="btn-u btn-u-default">ค้นหา</button>
                            </form>

                            <div id="container3" data-reflow="1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


                            <hr>
                            <a href="{{ action('TrendsController@ExportExcel2') }}" class="btn btn-success" style="margin-bottom: 10px" type="button"><i class="fa fa-download"></i> Export</a>

                            <div class="table-responsive">

                                @if($netasset2tbl)
                                <table class="table table-bordered table-striped tbl_mea">
                                    <thead>
                                    <tr >
                                        <th rowspan="3" width="70" style="text-align:center;">งวด</th>
                                        <th rowspan="3" width="60" style="text-align:center;">เงินเดือน</th>
                                        <th rowspan="3" width="60" style="text-align:center;">อายุ <br>(ปี/วัน)</th>
                                        <th rowspan="3" width="60" style="text-align:center;">อายุงาน<br> (ปี/วัน)</th>
                                        <th colspan="6" style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</th>



                                        <th width="100" rowspan="2" colspan="3" style="text-align:center;background-color: #ffeba7">เงินบำเหน็จ (บาท)</th>
                                        <th width="100" rowspan="2" colspan="3" style="text-align:center;background-color: #fff5b4">เปรียบเทียบกองทุนสำรองเลี้ยงชีพฯ กับเงินบำเหน็จ(บาท)</th>
                                    </tr>
                                    <tr >
                                        <th colspan="3" style="text-align:center;background-color: #ffeba7">ส่วนของนายจ้าง</th>
                                        <th colspan="3" style="text-align:center;background-color: #fff5b4">ส่วนของลูกจ้าง</th>
                                    </tr>
                                    <tr >
                                        <th style="text-align:center;background-color: #ffeba7">เงินสมทบ</th>
                                        <th style="text-align:center;background-color: #ffeba7">ผลประโยชน์เงินสมทบ</th>
                                        <th style="text-align:center;background-color: #ffeba7">รวม</th>

                                        <th style="text-align:center;background-color: #fff5b4">เงินสะสม</th>
                                        <th style="text-align:center;background-color: #fff5b4">ผลประโยชน์เงินสะสม</th>
                                        <th style="text-align:center;background-color: #fff5b4">รวม</th>

                                        <th style="text-align:center;background-color: #ffeba7">เงินบำเหน็จก่อนหักภาษี</th>
                                        <th style="text-align:center;background-color: #ffeba7">ภาษี</th>
                                        <th style="text-align:center;background-color: #ffeba7">เงินบำเหน็จสุทธิหลังหักภาษี</th>


                                        <th style="text-align:center;background-color: #fff5b4">ผลรวมส่วนของนายจ้าง </th>
                                        <th style="text-align:center;background-color: #fff5b4">เงินสุทธิหลังหักภาษี</th>
                                        <th style="text-align:center;background-color: #fff5b4">ส่วนต่าง </th>


                                    </tr>
                                    {{--<tr >--}}
                                        {{--<th style="text-align:center;">1</th>--}}
                                        {{--<th style="text-align:center;">2</th>--}}
                                        {{--<th style="text-align:center;">3</th>--}}
                                        {{--<th style="text-align:center;">4</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">5</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">6</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">7</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">8</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">9</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">10</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">11</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">12</th>--}}
                                        {{--<th style="text-align:center;background-color: #ffeba7">13</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">14</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">15</th>--}}
                                        {{--<th style="text-align:center;background-color: #fff5b4">16</th>--}}
                                    {{--</tr>--}}



                                    </thead>


                                    <tbody style="cellpadding:2px;">

                                    @foreach($netasset2tbl as $index =>$item)
                                    <tr>
                                        <td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>
                                        <td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>
                                        <td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>

                                        <td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>
                                        <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>
                                        <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>
                                        <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1  + $item->EMPLOYER_EARNING_2)}}</td>
                                        <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>
                                        <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>
                                        <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3 + $item->MEMBER_EARNING_4)}}</td>
                                        <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->GRATUITY)}}</td>
                                        <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->GRATUITY_TAX)}}</td>
                                        <td style="text-align: right;background-color: #ffeba7">{{meaNumbermoney($item->GRATUITY - $item->GRATUITY_TAX)}}</td>
                                        <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2 )}}</td>
                                        <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney($item->GRATUITY - $item->GRATUITY_TAX)}}</td>
                                        <td style="text-align: right;background-color: #fff5b4">{{meaNumbermoney(($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2) - ($item->GRATUITY - $item->GRATUITY_TAX))}}</td>

                                    </tr>
                                    @endforeach



                                    </tbody>


                                </table>
                                @endif
                            </div>

                             </div>
                                @endif

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
Highcharts.setOptions({
    lang: {
        thousandsSep: ','
    }
});
        $(function () {

            {{--var showw = {{$show2}};--}}

            {{--if(showw == "1"){--}}
                {{--$("#home-1").attr("class","active in")--}}
                {{--$("#profile-1").removeAttr("class","active in")--}}
                {{--$("#messages-1").removeAttr("class","active in")--}}
            {{--}--}}

            {{--if(showw == "2"){--}}

            {{--}--}}

            {{--if(showw == "3"){--}}

            {{--}--}}

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//                e.target // newly activated tab
//                e.relatedTarget // previous active tab
                //alert("asd");
                //$("#container").resize();

                $('DIV[data-reflow="1"]').highcharts().reflow();

                $("#container2").highcharts().reflow();
                $("#container3").highcharts().reflow();

            })

           // chart.showLoading('No data to display');

            jQuery('#container').highcharts(
                    {!! json_encode($graph)!!}
            )


            jQuery('#container2').highcharts(
                    {!! json_encode($graph2)!!}
            )

            jQuery('#container3').highcharts(
                    {!! json_encode($graph3)!!}
            )


            {{--@if(!$netasset)--}}
            {{--$("#nodata-1").show();--}}
            {{--@endif--}}


        });
    </script>
@stop

