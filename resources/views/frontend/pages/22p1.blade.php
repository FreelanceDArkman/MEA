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


                <li class="list-group-item active">
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


                            <div id="all_invest" style="{{objectcheckdisplaynone($CurrnentPlan)}}" >
                                <div class="row">
                                    <div class="headline-center margin-bottom-60">
                                        <h2>แผนปัจจุบัน</h2>
                                        <p>แบบที่ {{$CurrnentPlan->PLAN_ID}} ({{$CurrnentPlan->PLAN_NAME}})</p>
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
                                <div class="row">
                                    <div class="col-md-12" style="padding: 0 100px 0 100px;">
                                        <button class="btn-u btn-u-lg btn-block btn-u-blue" id="btn_changplan" type="button">ยกเลิกแผนปัจจุบัน</button>
                                    </div>

                                </div>
                            </div>

                            <div id="invest_form" style="{{objectcheckdisplayblock($CurrnentPlan)}}" >
                                <form action="{{ action('changeplanController@InsertInvestPlan') }}" id="sky-form1" class="sky-form" method="post">
                                    {!! csrf_field() !!}
                                    <header>เลือกแผนการลงทุน</header>
                                    <div class="alert alert-warning fade in">
                                        <strong> * การเปลี่ยนแปลงและแก้ไขแผนการลงทุน เปลี่ยนได้ไม่เกินปีละ 4 ครั้ง ภายในวันที่ 1-10 ของทุกเดือน และมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป</strong>
                                    </div>
                                    <fieldset>
                                        <legend>เปลี่ยนแผนการลงทุน</legend>
                                        <div class="row">
                                            <section class="col col-6">
                                                <label class="label">แผนการลงทุน</label>


                                                <select name="TYPE_TOPIC" id="TYPE_TOPIC"  class="form-control">
                                                    <option value="default"> กรุณาเลือก </option>
                                                    @foreach($dropplan as $index => $item)

                                                    <option value="{{$item->PLAN_ID}}">{{$item->PLAN_NAME}}</option>

                                                    @endforeach
                                                </select>
                                            </section>

                                        </div>



                                    </fieldset>
                                    <br/>
                                    <fieldset>
                                        <legend>ระบุสัดส่วนการลงทุน</legend>
                                        <div class="row">
                                            <section class="col col-4">
                                                <label class="label">สัดส่วนตราสารทุน (%)</label>
                                                <label class="input">
                                                    <i class="icon-append fa fa-asterisk"></i>
                                                    <input type="text" name="maxVal1" id="maxVal1">
                                                </label>
                                            </section>
                                            <section class="col col-4">
                                                <label class="label">สัดส่วนตราสารหนี้ (%)</label>
                                                <label class="input">
                                                    <i class="icon-append fa fa-asterisk"></i>
                                                    <input type="text" name="maxVal2"  id="maxVal2">
                                                </label>
                                            </section>
                                        </div>


                                    </fieldset>

                                    <input type="hidden" id="count_modify" name="count_modify" value="{{$CurrnentPlan->MODIFY_COUNT}}">
                                    <input type="hidden" id="date_modify" name="date_modify" value="{{$CurrnentPlan->MODIFY_DATE}}">
                                    <footer>
                                        <button type="submit" class="btn-u btn-u-default">ส่งข้อมูล</button>
                                        <button type="button" class="btn-u" id="btn_cancelinvest" >ยกเลิก</button>
                                    </footer>
                                </form>
                            </div>



                        </div>
                        <div class="tab-pane fade " id="profile-1">

                            <div class="table-responsive">

                                <table style="width:1024px ; font-size:12px; border:solid thin #C7DCF9; border-spacing: 1px !important;
               border-collapse: separate !important;">
                                    <thead>

                                    <tr style="background-color: #26A9E0;color:white;">
                                        <th style="text-align:center;">ครั้งที่</th>
                                        <th style="text-align:center;">รหัสพนักงาน</th>
                                        <th style="text-align:center;">ชื่อ-สกุล</th>
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
                                            <tr>

                                                <td style="text-align: center;">{{$item->MODIFY_COUNT .'/'.get_date_year($item->MODIFY_DATE) }}</td>
                                                <td style="text-align: center;">{{$item->EMP_ID}}</td>
                                                <td style="text-align: center;">{{$item->FULL_NAME}}</td>

                                                @if( count($historyPlan) > $index+1)

                                                <td style="text-align: center;">{{$historyPlan[$index+1]->PLAN_NAME}}</td>
                                                <td style="text-align: center;">{{$historyPlan[$index+1]->DEBT_RATE}}</td>
                                                <td style="text-align: center;">{{$historyPlan[$index+1]->EQUITY_RATE}}</td>
                                                @else
                                                    <td style="text-align: center;">-</td>
                                                    <td style="text-align: center;">-</td>
                                                    <td style="text-align: center;">-</td>
                                                @endif

                                                <td style="text-align: center;">{{$item->PLAN_NAME}}</td>
                                                <td style="text-align: center;">{{$item->DEBT_RATE}}</td>
                                                <td style="text-align: center;">{{$item->EQUITY_RATE}}</td>

                                                <td style="text-align: center;">{{get_date_notime($item->MODIFY_DATE)}}</td>
                                                <td style="text-align: center;">
                                                    01 มี.ค. 2559</td>
                                            </tr>
                                        @endforeach
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

            $('#btn_changplan').on('click',function(){

                $('#all_invest').slideUp('400',function(){
                    $('#invest_form').slideDown();

                })
               //
            //invest_form
            });

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

                Circles.create({
                id:         'circles-1',
                percentage: '{{$CurrnentPlan->EQUITY_RATE}}',
                radius:     70,
                width:      2,
                number:     '{{$CurrnentPlan->EQUITY_RATE}}',
                text:       '%',
                colors:      ['#D3B6C6', '#9B6BCC'],
                duration:   2000,
            });

            Circles.create({
                id:         'circles-2',
                percentage: '{{$CurrnentPlan->DEBT_RATE}}',
                radius:     70,
                width:      2,
                number:     '{{$CurrnentPlan->DEBT_RATE}}',
                text:       '%',
                colors:     ['#FFC2BB', '#E74C3C'],
                duration:   2000,
            });
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
                        max: 100
                    },
                    TYPE_TOPIC:{
                        valueNotEquals: "default"
                    },

                },

                // Messages for form validation
                messages:
                {
                    maxVal:
                    {
                        required: 'Please enter some value'
                    },
                    required:
                    {
                        required: 'Please enter something'
                    },
                    TYPE_TOPIC:{
                        valueNotEquals: "Please select an item!"
                    },

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

