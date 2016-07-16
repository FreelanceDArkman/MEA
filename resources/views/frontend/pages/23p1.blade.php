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


                <li class="list-group-item">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> {{ getGoupName($data,22) }}</a>
                </li>
                <li class="list-group-item active">
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

                <?php

                $page = 1;
                $p = Request::path();
                $arrP = explode('/',$p);



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

                <div class="tab-v2">
                    <ul class="nav nav-tabs">

                        @if($ishowhis)
                        <li class="<?php echo getde($page,1) ?>"><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,23,1) }}</a></li>
                        <li class="<?php echo getde($page,2) ?>"><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,23,2) }}</a></li>
                        @else
                            <li class="<?php echo getde($page,1) ?>"><a href="#home-1" data-toggle="tab" aria-expanded="true" >{{ getMenuName($data,23,1) }}</a></li>
                            <li class="<?php echo getde($page,2) ?>"><a href="#profile-1" data-toggle="tab" aria-expanded="true">{{ getMenuName($data,23,2) }}</a></li>
                        @endif

                    </ul>
                    <div class="tab-content">
                        {{--//$ishowhis--}}
                        @if($ishowhis)
                            <div class="tab-pane fade <?php echo getde($page,1) ?> in" id="home-1" style="position: relative" >
                                @else
                                    <div class="tab-pane fade <?php echo getde($page,1) ?> in" id="home-1" style="position: relative" >
                                        @endif


                            <div id="all_invest" style="{{objectcheckdisplaynone($CurrnentPlan)}}" >


                                <div class="row">
                                    <div class="headline-center margin-bottom-60">

                                        <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                            <strong> * การเปลี่ยนแปลงและแก้ไขอัตราสะสม ทำได้ภายในวันที่ {{$dataCheck->SAVING_RATE_CHANGE_PERIOD}} ของทุกเดือนและมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป </strong>
                                        </div>

                                        {{--@if($Isaccess && get_user_access_status_flag() != 2)--}}
                                            @if($CurrnentPlan)
                                                <div style="width: 100% ;padding:0 70px 0 70px; "><h3 class="heading-xs" style="font-size: 20px"><span class="pull-left">0%</span>อัตราสะสมปัจจุบันที่ท่านเลือก <span class="pull-right">{{$Workcheck->SAVING_MAX_RATE}}%</span></h3>
                                                    <div class="progress progress-u">
                                                        <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="{{$CurrnentPlan[0]->USER_SAVING_RATE}}" aria-valuemin="0" aria-valuemax="{{$Workcheck->SAVING_MAX_RATE}}" style="width:{!! ($CurrnentPlan[0]->USER_SAVING_RATE * 100)/$Workcheck->SAVING_MAX_RATE  !!}%">
                                                            <span style="font-size: 18px">{{$CurrnentPlan[0]->USER_SAVING_RATE}}%</span>
                                                        </div>
                                                    </div></div>

                                                <div>วันที่ทำรายการล่าสุด {{get_date_notime($CurrnentPlan[0]->CHANGE_SAVING_RATE_DATE)}}</div>

                                            {{--<p> {{$CurrnentPlan[0]->USER_SAVING_RATE}} %</p>--}}
                                            @else
                                                <p> %</p>
                                            @endif

                                         {{--@endif--}}
                                    </div>
                                </div>


                                @if($Isaccess && (get_user_access_status_flag() == 2 || get_user_access_status_flag() == 0))
                                <div class="row">
                                    <div class="col-md-12" style="padding: 0 100px 0 100px;">

                                        <a  href="{{action('cumulativeController@deleplan')}}" class="btn-u btn-u-lg btn-block btn-u-blue" id="btn_changplan" type="submit">ยกเลิกอัตราสะสมปัจจุบัน</a>

                                    </div>

                                </div>
                                @endif
                            </div>

                                   {{--{{get_user_access_status_flag()}}--}}
                                        {{--&& get_user_access_status_flag() != 2--}}

                                        {{--{{$Isaccess . "asdasd"}}--}}

                           @if( $Isaccess && (get_user_access_status_flag() == 2 || get_user_access_status_flag() == 0))
                            <div id="invest_form" style="{{objectcheckdisplayblock($CurrnentPlan)}}"  >
                                <form action="{{ action('cumulativeController@InsertPlan') }}" id="sky-form1" class="sky-form" method="post">
                                    {!! csrf_field() !!}
                                    <header>เลือกแผนการลงทุน</header>
                                    <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                        <strong> * การเปลี่ยนแปลงและแก้ไขอัตราสะสม ทำได้ภายในวันที่ {{$dataCheck->SAVING_RATE_CHANGE_PERIOD}} ของทุกเดือนและมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป </strong>
                                    </div>

                                    <br/>
                                    <fieldset>
                                        <legend>ระบุสัดส่วนการลงทุน</legend>
                                        <div class="row">

                                            <section>
                                                <h1>ระบุอัตราสะสม ({{$Workcheck->SAVING_MIN_RATE}}% - {{$Workcheck->SAVING_MAX_RATE}}%)</h1>
                                            </section>
                                            <section class="col col-4">


                                                <label class="label">อัตราสะสมเดิม (%)</label>
                                                <label class="input">
                                                    <i class="icon-append fa fa-asterisk"></i>


                                                    @if($CurrnentPlan)
                                                    <input type="text" style="background-color:#ccc" name="maxVal1" id="maxVal1" value="{{$CurrnentPlan[0]->USER_SAVING_RATE}}" disabled>
                                                    @else
                                                        @if($effective)
                                                        <input type="text" style="background-color:#ccc" name="maxVal1" id="maxVal1"  value="{{$effective[0]->USER_SAVING_RATE}}" disabled>
                                                        @else
                                                            <input type="text"  name="maxVal1" id="maxVal1"  value="" >
                                                        @endif
                                                    @endif

                                                </label>
                                            </section>
                                            <section class="col col-4">
                                                <label class="label">อัตราสะสมใหม่ (%)</label>
                                                <label class="input">
                                                    <i class="icon-append fa fa-asterisk"></i>
                                                    <input type="text" name="maxVal2"  id="maxVal2">
                                                </label>
                                            </section>
                                        </div>


                                    </fieldset>

                                    <input type="hidden" id="user" name="user" value="{{$users->USER_PRIVILEGE_DESC}}">

                                    @if($CurrnentPlan)
                                    <input type="hidden" id="count_modify" name="count_modify" value="{{$CurrnentPlan[0]->MODIFY_COUNT}}">
                                        <input type="hidden" id="date_modify" name="date_modify" value="{{$CurrnentPlan[0]->CHANGE_SAVING_RATE_DATE}}">
                                    @else
                                        @if($effective)
                                            <input type="hidden" id="count_modify" name="count_modify" value="{{$effective[0]->MODIFY_COUNT}}">
                                            <input type="hidden" id="date_modify" name="date_modify" value="{{$effective[0]->CHANGE_SAVING_RATE_DATE}}">
                                        @else
                                            <input type="hidden" id="count_modify" name="count_modify" value="">
                                            <input type="hidden" id="date_modify" name="date_modify" value="">
                                        @endif
                                    @endif
                                    <footer>
                                        <button type="submit" class="btn-u btn-u-default">ส่งข้อมูล</button>
                                        <button type="button" class="btn-u" id="btn_cancelinvest" >ยกเลิก</button>
                                    </footer>
                                </form>
                            </div>

                                @else

                               @if(get_user_access_status_flag() == 2)
                            <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                <strong>สถานะของท่าน คือ สมาชิกแบบคงเงินหรือรับเงินเป็นงวด ไม่สามารถเปลี่ยนอัตราสะสมได้
                                </strong>
                            </div>
                                @else
                                                <div class="alert alert-warning fade in" style="margin-left: 20px; margin-right: 20px">
                                                    <strong> * การเปลี่ยนแปลงและแก้ไขอัตราสะสม ทำได้ภายในวันที่ {{$dataCheck->SAVING_RATE_CHANGE_PERIOD}} ของทุกเดือนและมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป </strong>
                                                </div>
                                            @endif


                            @endif


                        </div>

                        @if($ishowhis)
                            <div class="tab-pane fade <?php echo getde($page,2) ?> in" id="profile-1">
                                @else
                                    <div class="tab-pane fade <?php echo getde($page,2) ?> in" id="profile-1">
                                        @endif



                            <form class="form-inline mea_searchbox" role="form" method="post" action="/cumulative/{{$page}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                    <select name="drop_year" id="drop_year">
                                            {!! $ret !!}}
                                    </select>
                                </div>


                                <button type="submit" class="btn-u btn-u-default">ค้นหา</button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped tbl_mea">
                                    <thead>

                                    <tr style="background-color: #26A9E0;color:white;">
                                        <th style="text-align:center;">ครั้งที่</th>
                                        {{--<th style="text-align:center;">รหัสพนักงาน</th>--}}
                                        {{--<th style="text-align:center;">ชื่อ-สกุล</th>--}}
                                        <th style="text-align:center;">อัตราการสะสมเดิม</th>
                                        <th style="text-align:center;">อัตราการสะสมใหม่</th>

                                        <th style="text-align:center;">วันทำรายการ</th>
                                        <th style="text-align:center;">วันที่มีผล</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @if($historyPlan)
                                        @foreach($historyPlan as $index => $item)

                                            @if(checkShowList_valid($dataCheck->SAVING_RATE_CHANGE_PERIOD,$item->CHANGE_SAVING_RATE_DATE ))
                                            <tr>

                                                <td style="text-align: center;">{{$item->MODIFY_COUNT .'/'.get_date_year($item->CHANGE_SAVING_RATE_DATE) }}</td>
                                                {{--<td style="text-align: center;">{{$item->EMP_ID}}</td>--}}
                                                {{--<td style="text-align: center;">{{$item->FULL_NAME}}</td>--}}

                                                @if( count($historyPlan) > $index+1)

                                                    <td style="text-align: center;">{{$historyPlan[$index+1]->USER_SAVING_RATE}}</td>

                                                @else
                                                    <td style="text-align: center;">-</td>

                                                @endif

                                                <td style="text-align: center;">{{$item->USER_SAVING_RATE}}</td>


                                                <td style="text-align: center;">{{get_date_notime($item->CHANGE_SAVING_RATE_DATE)}}</td>
                                                <td style="text-align: center;">
                                                    {{get_date_notime($item->EFFECTIVE_DATE)}}</td>
                                            </tr>

                                            @endif
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center" >

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

    <script>
        $(document).ready(function(){





            @if (Session::has('del2'))

             $('#all_invest').hide();
            $('#invest_form').show();


            @endif

//        $('#btn_changplan').on('click',function(){
//
//                $('#all_invest').slideUp('400',function(){
//                    $('#invest_form').slideDown();
//
//                })
//                //
//                //invest_form
//            });

            $('#btn_cancelinvest').on('click',function(){

                $('#invest_form').slideUp('400',function(){
                    $('#all_invest').slideDown();

                })
                //
                //invest_form
            });



            var colors = [
                ['#D3B6C6', '#9B6BCC'], ['#C9FF97', '#72c02c'], ['#BEE3F7', '#3498DB'], ['#FFC2BB', '#E74C3C']
            ];

            // for (var i = 1; i <= 2; i++) {

            // var child = document.getElementById('circles-' + i),
            //percentage = 45 + (i * 9);

            // $CurrnentPlan
            //$Currnentasset->EQUITY
            //$Currnentasset->DEBT}}

            {{--Circles.create({--}}
                {{--id:         'circles-1',--}}
                {{--percentage: '{{$CurrnentPlan->EQUITY_RATE}}',--}}
                {{--radius:     70,--}}
                {{--width:      2,--}}
                {{--number:     '{{$CurrnentPlan->EQUITY_RATE}}',--}}
                {{--text:       '%',--}}
                {{--colors:      ['#D3B6C6', '#9B6BCC'],--}}
                {{--duration:   2000,--}}
            {{--});--}}

            {{--Circles.create({--}}
                {{--id:         'circles-2',--}}
                {{--percentage: '{{$CurrnentPlan->DEBT_RATE}}',--}}
                {{--radius:     70,--}}
                {{--width:      2,--}}
                {{--number:     '{{$CurrnentPlan->DEBT_RATE}}',--}}
                {{--text:       '%',--}}
                {{--colors:     ['#FFC2BB', '#E74C3C'],--}}
                {{--duration:   2000,--}}
            {{--});--}}
            // }




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

            // Validation
            $("#sky-form1").validate({
                // Rules for form validation
                rules:
                {
                    maxVal1:
                    {
                        required: true,
                        max: 100
                    },
                    maxVal2:
                    {
                        required: true,
                        max:  {{ $Workcheck->SAVING_MAX_RATE }},
                        min: {{$Workcheck->SAVING_MIN_RATE}}
                    }


                },

                // Messages for form validation
                messages:
                {
                    maxVal2:{
                        max : "อัตราสะสมต้องไม่เกิน " + {{$Workcheck->SAVING_MAX_RATE}} + "%",
                        min : "อัตราสะสมต้องไม่น้อยกว่า " + {{$Workcheck->SAVING_MIN_RATE}} +"%",
                        required: 'Please enter some value'
                    },

                    required:
                    {
                        required: 'Please enter something'
                    }

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

