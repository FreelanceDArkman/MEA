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

                <li class="list-group-item">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> {{ getGoupName($data,21) }}</a>
                </li>


                <li class="list-group-item active">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> {{ getGoupName($data,22) }}</a>
                </li>
                <li class="list-group-item ">
                    <a href="/cumulative"><i class="fa fa-level-up"></i> {{ getGoupName($data,23) }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/riskassessment"><i class="fa fa-exclamation-triangle"></i> {{ getGoupName($data,24) }}</a>
                </li>
                <li class="list-group-item ">
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
                                @if($planchoose)
                                <li>
                                    <small>แผนการลงทุน</small>
                                    <h4 style="text-align: center" class="counter">{{$planchoose->PLAN_NAME}}</h4>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div><!--/end row-->
                <!--End Service Block v3-->

                <hr>

                <?php

                    $page = 1;
                    $p = Request::path();
                    $arrP = explode('/',$p);


//                    var_dump(count($arrP));

                    if(count($arrP) > 1){
                        if($arrP[1] != null){
                            $page = 2;
                        }
                    }





                    function getde ($page,$target){
                            $ret = "";
                        if($page== $target){
                            $ret = "active";
                        }

                        return $ret;
                    }
                ?>
                {{--{{  Request::path()   }}--}}
                <div class="tab-v2">
                    <ul class="nav nav-tabs">
                        @if($ishowhis)
                        <li class="<?php echo getde($page,1) ?>"><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,22,1) }}</a></li>
                        <li class="<?php echo getde($page,2) ?>"><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,22,2) }}</a></li>
                        @else
                            <li class="<?php echo getde($page,1) ?>"><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,22,1) }}</a></li>
                            <li class="<?php echo getde($page,2) ?>"><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,22,2) }}</a></li>
                        @endif

                    </ul>
                    <div class="tab-content">
                        @if($ishowhis)
                        <div class="tab-pane fade " id="home-1" style="position: relative" >
                            @else
                                <div class="tab-pane fade <?php echo getde($page,1) ?> in" id="home-1" style="position: relative" >
                                    @endif


                            @if($CurrnentPlan)
                                @if($numberofchange == (intval(session()->get('user_data')->fund_plan_change_per_year) - 1))
                                    {{--<div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">--}}
                                        {{--<strong> ท่านกําลังทําการเปลี่ยนแผนการลงทุนครบจํานวนครั้งที่กองทุนฯ กําหนด กรุณายืนยันการทํารายการ หรือยกเลิก</strong>--}}
                                    {{--</div>--}}
                                    @endif
                            @else
                                @if($effective)
                                            @if($numberofchange == (intval(session()->get('user_data')->fund_plan_change_per_year) - 1))
                                            {{--<div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">--}}
                                                {{--<strong> ท่านกําลังทําการเปลี่ยนแผนการลงทุนครบจํานวนครั้งที่กองทุนฯ กําหนด กรุณายืนยันการทํารายการ หรือยกเลิก</strong>--}}
                                            {{--</div>--}}
                                            @endif
                                @endif
                            @endif


                            <div id="all_invest" style="{{objectcheckdisplaynone($CurrnentPlan)}}" >
                                <div class="row">

                                    <div class="headline-center margin-bottom-60">
                                        <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                            <strong> * การเปลี่ยนแปลงและแก้ไขแผนการลงทุน เปลี่ยนได้ไม่เกินปีละ {{$dataCheck->FUND_PLAN_TIME_CHANGE_PER_YEAR}} ครั้ง ภายในวันที่ {{$dataCheck->FUND_PLAN_CHANGE_PERIOD}} ของทุกเดือน และมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป</strong>
                                        </div>

                                        {{--@if($Isaccess && get_user_access_status_flag() != 2)--}}

                                        <h2>แผนการลงทุนปัจจุบันที่ท่านเลือก</h2>

                                            @if($CurrnentPlan)
                                            <p class="plan_name">{{$CurrnentPlan[0]->PLAN_NAME}}</p>
                                                @else
                                                    @if($effective)
                                                        <p class="plan_name">{{$effective[0]->PLAN_NAME}}</p>
                                                    @endif
                                            @endif


                                            @if($CurrnentPlan)
                                            <div>วันที่ทำรายการล่าสุด {{get_date_notime($CurrnentPlan[0]->MODIFY_DATE)}}</div>
                                                @else
                                                @if($effective)
                                                <div>วันที่ทำรายการล่าสุด {{get_date_notime($effective[0]->MODIFY_DATE)}}</div>
                                                @endif
                                            @endif
                                        {{--@endif--}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="inner-pchart col-md-6 col-xs-6" style="text-align: right">
                                        <div class="circle" id="circles-1"></div>
                                        <h3 class="circle-title">สัดส่วนตราสารทุน</h3>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>--}}
                                    </div>
                                    <div class="inner-pchart col-md-6 col-xs-6" style="text-align: left">
                                        <div class="circle" id="circles-2"></div>
                                        <h3 class="circle-title">สัดส่วนตราสารหนี้</h3>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>--}}
                                    </div>

                                </div>
                                {{--&& get_user_access_status_flag() != 2--}}

                                @if($Isaccess &&  (get_user_access_status_flag() == 2 ||get_user_access_status_flag() == 0))
                                        @if($quizdoit)
                                        <div class="row">
                                            <div class="col-md-12" style="padding: 0 100px 0 100px;">
                                                <a href="{{action('changeplanController@deleplan')}}" class="btn-u btn-u-lg btn-block btn-u-blue" id="btn_changplan" type="button">ยกเลิกแผนปัจจุบัน</a>
                                            </div>

                                        </div>
                                    @else
                                        <div class="alert alert-info fade in">
                                            <strong>กรุณาทำแบบประเมินความเสี่ยง ก่อนเปลี่ยนแผนการลงทุน</strong>
                                        </div>
                                    @endif
                                @endif

                            </div>


                            <div id="invest_form" style="{{objectcheckdisplayblock($CurrnentPlan)}}" >

                                @if($numberofchange < 4)

                                {{--{{$Isaccess . "---" .get_user_access_status_flag()}}--}}

                                @if( $Isaccess && (get_user_access_status_flag() == 2 ||get_user_access_status_flag() == 0))

                                    @if($quizdoit)
                                        <form action="{{ action('changeplanController@InsertInvestPlan') }}" id="sky-form1" class="sky-form" method="post">
                                            {!! csrf_field() !!}
                                            <header>เลือกแผนการลงทุน</header>
                                            <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                                <strong> * การเปลี่ยนแปลงและแก้ไขแผนการลงทุน เปลี่ยนได้ไม่เกินปีละ {{$dataCheck->FUND_PLAN_TIME_CHANGE_PER_YEAR}} ครั้ง ภายในวันที่ {{$dataCheck->FUND_PLAN_CHANGE_PERIOD}} ของทุกเดือน และมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป</strong>
                                            </div>
                                            <fieldset>
                                                <legend>เปลี่ยนแผนการลงทุน</legend>
                                                <div class="row">
                                                    <section class="col col-6">
                                                        <label class="label">แผนการลงทุน</label>


                                                        <select name="TYPE_TOPIC" id="TYPE_TOPIC"  class="form-control">
                                                            <option value="default"> กรุณาเลือก </option>
                                                            @foreach($dropplan as $index => $item)

                                                                @if($item->PLAN_NAME == 'DIY')

                                                                <option selected value="{{$item->PLAN_ID ."," .$item->EQUITY_MIN_PERCENTAGE."," .$item->EQUITY_MAX_PERCENTAGE."," .$item->DEBT_MIN_PERCENTAGE."," .$item->DEBT_MAX_PERCENTAGE}}">{{$item->PLAN_NAME}}</option>
                                                                @else
                                                                    <option value="{{$item->PLAN_ID ."," .$item->EQUITY_MIN_PERCENTAGE."," .$item->EQUITY_MAX_PERCENTAGE."," .$item->DEBT_MIN_PERCENTAGE."," .$item->DEBT_MAX_PERCENTAGE}}">{{$item->PLAN_NAME}}</option>
                                                                    @endif

                                                            @endforeach
                                                        </select>
                                                    </section>

                                                </div>


                                                <input type="hidden" id="user" name="user" value="{{$users->USER_PRIVILEGE_DESC}}">
                                            </fieldset>
                                            <br/>
                                            <fieldset>
                                                <legend>ระบุสัดส่วนการลงทุน</legend>
                                                <div class="row">
                                                    <section class="col col-6">
                                                        <label class="label">สัดส่วนตราสารทุน (%)     <span style="font-size: 11px;color: red;" class="minmax_label"></span></label>

                                                        <label class="input">
                                                            <i class="icon-append fa fa-asterisk"></i>
                                                            <input type="text" name="maxVal1" id="maxVal1">
                                                        </label>
                                                    </section>
                                                    <section class="col col-6">
                                                        <label class="label">สัดส่วนตราสารหนี้ (%)</label>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-asterisk"></i>
                                                            <input type="text" name="maxVal2" style="background-color: #e0e4ee"  readonly id="maxVal2">
                                                        </label>
                                                    </section>
                                                </div>


                                            </fieldset>
                                            @if($CurrnentPlan)
                                                <input type="hidden" id="count_modify" name="count_modify" value="{{$CurrnentPlan[0]->MODIFY_COUNT}}">
                                                <input type="hidden" id="date_modify" name="date_modify" value="{{$CurrnentPlan[0]->MODIFY_DATE}}">
                                            @else
                                                @if($effective)
                                                    <input type="hidden" id="count_modify" name="count_modify" value="{{$effective[0]->MODIFY_COUNT}}">
                                                    <input type="hidden" id="date_modify" name="date_modify" value="{{$effective[0]->MODIFY_DATE}}">
                                                @endif
                                            @endif
                                            <footer>


                                                @if($numberofchange == 3)
                                                <button type="submit" onclick="return check();"  class="btn-u btn-u-default">ส่งข้อมูล</button>
                                                @else
                                                    <button type="submit" class="btn-u btn-u-default">ส่งข้อมูล</button>
                                                    @endif
                                                <button type="button" class="btn-u" id="btn_cancelinvest" >ยกเลิก</button>
                                            </footer>
                                        </form>
                                    @else
                                        <div class="alert alert-info fade in">
                                            <strong>กรุณาทำแบบประเมินความเสี่ยง ก่อนเปลี่ยนแผนการลงทุน</strong>
                                        </div>
                                    @endif

                                    @else

                                        <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                            <strong> * การเปลี่ยนแปลงและแก้ไขแผนการลงทุน เปลี่ยนได้ไม่เกินปีละ {{$dataCheck->FUND_PLAN_TIME_CHANGE_PER_YEAR}} ครั้ง ภายในวันที่ {{$dataCheck->FUND_PLAN_CHANGE_PERIOD}} ของทุกเดือน และมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป</strong>
                                        </div>


                                    @endif


                                @else
                                    <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                        <strong> * ท่านทำการเปลี่ยนแผนการลงทุนของปีปัจจุบัน ครบจํานวนครั้งที่กองทุนสำรองเลี้ยงชีพกําหนดแล้ว  </strong>
                                    </div>
                                @endif

                            </div>




                        </div>

                                @if($ishowhis)
                                <div class="tab-pane fade  <?php echo getde($page,2) ?> in" id="profile-1">
                                @else
                                <div class="tab-pane fade <?php echo getde($page,2) ?> in" id="profile-1">
                                @endif

{{--//action="{{action('changeplanController@getIndexbysearch')}}"--}}
                                    <form class="form-inline mea_searchbox" role="form" method="post"  action="/changeplan/{{$page}}">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                            <select name="drop_year" id="drop_year">
                                                {!!$ret !!}
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



                            <div class="table-responsive">

                                <table  class="table table-bordered table-striped tbl_mea">
                                    <thead>

                                    <tr style="background-color: #26A9E0;color:white;">
                                        <th style="text-align:center;">ครั้งที่</th>
                                        {{--<th style="text-align:center;">รหัสพนักงาน</th>--}}
                                        {{--<th style="text-align:center;">ชื่อ-สกุล</th>--}}
                                        <th style="text-align:center;">แผนการลงทุน(เดิม)</th>
                                        <th style="text-align:center;">ตราสารทุน(เดิม)</th>
                                        <th style="text-align:center;">ตราสารหนี้(เดิม)</th>

                                        <th style="text-align:center;">แผนการลงทุน(ใหม่)</th>
                                        <th style="text-align:center;">ตราสารทุน(ใหม่)</th>
                                        <th style="text-align:center;">ตราสารหนี้(ใหม่)</th>

                                        <th style="text-align:center;">วันทำรายการ</th>
                                        <th style="text-align:center;">วันที่มีผล</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if($historyPlan)
                                        @foreach($historyPlan as $index => $item)


                                            @if(checkShowList_valid($dataCheck->FUND_PLAN_CHANGE_PERIOD,$item->MODIFY_DATE ))
                                            <tr>

                                                <td style="text-align: center;">{{$item->MODIFY_COUNT .'/'.get_date_year($item->MODIFY_DATE) }}</td>
                                                {{--<td style="text-align: center;">{{$item->EMP_ID}}</td>--}}
                                                {{--<td style="text-align: center;">{{$item->FULL_NAME}}</td>--}}

                                                @if( count($historyPlan) > $index+1)

                                                <td style="text-align: center;">{{$historyPlan[$index+1]->PLAN_NAME}}</td>
                                                <td style="text-align: center;">{{$historyPlan[$index+1]->EQUITY_RATE}}</td>
                                                <td style="text-align: center;">{{$historyPlan[$index+1]->DEBT_RATE}}</td>
                                                @else
                                                    <td style="text-align: center;">-</td>
                                                    <td style="text-align: center;">-</td>
                                                    <td style="text-align: center;">-</td>
                                                @endif

                                                <td style="text-align: center;">{{$item->PLAN_NAME}}</td>
                                                <td style="text-align: center;">{{$item->EQUITY_RATE}}</td>
                                                <td style="text-align: center;">{{$item->DEBT_RATE}}</td>

                                                <td style="text-align: center;">{{get_date_notime($item->MODIFY_DATE)}}</td>
                                                <td style="text-align: center;">
                                                    {{get_date_notime($item->EFFECTIVE_DATE)}}</td>
                                            </tr>

                                           @endif

                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9" style="text-align: center" >

                                                    <strong>ไม่พบข้อมูลในระบบ</strong>

                                            </td>
                                        </tr>

                                    @endif

                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                </div>



            </div>
        </div>
        <!-- End Profile Content -->
    </div>
            </div>

        </div>
<input type="hidden" id="flag100"  value="{{get_user_access_status_flag()}}" />


   <script type="text/javascript">


        function  check(){
           return confirm('ท่านกำลังทำการเปลี่ยนแผนการลงทุนครบจํานวนครั้งที่กองทุนฯ กําหนด กรุณายืนยันการทำรายการ หรือยกเลิก');
        }


       
        $(document).ready(function(){


            $('#maxVal1').on('keyup',function(){

              var val =  $(this).val();
                if(val <= 100){

                    $('#maxVal2').val(100 -val);
                }else {

                    alert('กรุณาใส่ข้อมูล ไม่เกิน 100');
                }


            });

            $('#maxVal2').on('keyup',function(){
                var val =  $(this).val();

                if(val <= 100){

                    $('#maxVal1').val(100 -val);
                }else {

                    alert('กรุณาใส่ข้อมูล ไม่เกิน 100');
                }


            });



            var colors = [
                ['#D3B6C6', '#9B6BCC'], ['#C9FF97', '#72c02c'], ['#BEE3F7', '#3498DB'], ['#FFC2BB', '#E74C3C']
            ];




                Circles.create({
                id:         'circles-1',
                    @if($CurrnentPlan)
                    percentage: '{{$CurrnentPlan[0]->EQUITY_RATE}}',
                    @else
                            @if($effective)
                            percentage: '{{$effective[0]->EQUITY_RATE}}',
                            @else
                                percentage: '0',
                            @endif
                    @endif
                radius:     70,
                width:      2,
                    @if($CurrnentPlan)
                number:     '{{$CurrnentPlan[0]->EQUITY_RATE}}',
                    @else
                            @if($effective)
                            number: '{{$effective[0]->EQUITY_RATE}}',
                            @else
                            number: '0',
                            @endif
                    @endif
                text:       '%',
                colors:      ['#FFC2BB', '#fe5000'],
                duration:   2000,
            });

            Circles.create({
                id:         'circles-2',
                @if($CurrnentPlan)
                percentage: '{{$CurrnentPlan[0]->DEBT_RATE}}',
                @else
                        @if($effective)
                        percentage: '{{$effective[0]->DEBT_RATE}}',
                        @else
                        percentage: '0',
                        @endif
                @endif

                radius:     70,
                width:      2,
                    @if($CurrnentPlan)
                number: '{{$CurrnentPlan[0]->DEBT_RATE}}',
                @else
                        @if($effective)
                        number:'{{$effective[0]->DEBT_RATE}}',
                        @else
                        number:'0',
                        @endif
                @endif
                text:       '%',
                colors:     ['#ffeba7', '#ffbf3f'],
                duration:   2000,
            });





            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg != value;
            }, "Value must not equal arg.");


            //$("form").validate({
            //	rules: {
            //		SelectName: { valueNotEquals: "default" }
            //	},
            //	messages: {
            //		SelectName: { valueNotEquals: "Please select an item!" }
            //	}
            //});


            var flag100 = $("#flag100").val();
            var arrval_1 =  $("#TYPE_TOPIC").val().split(',');

            var maxeq_1 = arrval_1[2]
            var mineq_1 = arrval_1[1]
            var maxdeb_1 =arrval_1[4]
            var mindeb_1 =arrval_1[3]

            if(flag100 == 2) {
                maxeq_1 = 100;
            }

            $("#maxVal1").attr('placeholder',mineq_1 + "-" + maxeq_1)

            $(".minmax_label").html('ค่าที่สามารถใส่ได้ ระหว่าง ' + mineq_1 + "-" + maxeq_1)


            $("#TYPE_TOPIC").on('change',function(){

//                alert($(this).val());

                var arrval = $(this).val().split(',');

                var maxeq = arrval[2]
                var mineq = arrval[1]
                var maxdeb =arrval[4]
                var mindeb =arrval[3]

                if(flag100 == 2) {
                    maxeq = 100;
                }

                $("#maxVal1").attr('placeholder',mineq + "-" + maxeq)
                $(".minmax_label").html('ค่าที่สามารถใส่ได้ ระหว่าง ' + mineq + "-" + maxeq)
//                $("#maxVal2").attr('placeholder',mindeb + "-" + maxdeb)



            });

            // Validation
            $("#sky-form1").validate({
                // Rules for form validation
                rules:
                {

                    TYPE_TOPIC:{
                        valueNotEquals: "default"
                    },
                    maxVal1:{
                        required: true,
                        number:true
                    },
                    maxVal2:{
                        required: true,
                        number:true
                    }

                },

                // Messages for form validation
                messages:
                {

                    TYPE_TOPIC:{
                        valueNotEquals: "Please select an item!"
                    }

                },

// Ajax form submition
                submitHandler: function(form)
                {



                    var arrval =  $("#TYPE_TOPIC").val().split(',');


                    var flag100 = $("#flag100").val();

                    var maxeq = arrval[2]
                    if(flag100 == 2){
                        maxeq = 100;
                    }else if (flag100 == 0){
                        maxeq = 50;
                    }

                    var mineq = arrval[1]
                    var maxdeb =arrval[4]
                    var mindeb =arrval[3]


                    var maxVal1 = $("#maxVal1").val();
                    var maxVal2 = $("#maxVal2").val();


//                    if(((parseInt(maxVal1)>=parseInt(mineq) && parseInt(maxVal1)<=parseInt(maxeq)) && (parseInt(maxVal2)>=parseInt(mindeb) && parseInt(maxVal2)<=parseInt(maxdeb)) ) ){
                    if(((parseInt(maxVal1)>=parseInt(mineq) && parseInt(maxVal1)<=parseInt(maxeq)) ) ){
                        $(form).submit();
                    }else {
                        alert('ท่านเลือกจำนวนสัดส่วนตราสารทุน เกินจำนวนที่กำหนด' );
                    }
//                    $(form).ajaxSubmit(
//                            {
//                                beforeSend: function()
//                                {
//                                    $('#sky-form3 button[type="submit"]').attr('disabled', true);
//                                },
//                                success: function()
//                                {
//                                    $("#sky-form3").addClass('submited');
//                                }
//                            });
                },

                // Do not change code below
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                }
            });


        });



    </script>

@stop
 
