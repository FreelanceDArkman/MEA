@extends('frontend.layouts.content_chart')
@section('content')

    <div class="row">
        <!--Left Sidebar-->
        <div class="col-md-3 md-margin-bottom-40">
            {{--<img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/img32-md.jpg" alt="">--}}

            <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                <li class="list-group-item ">
                    <a href="/profile"><i class="fa fa-home"></i> Overall Profile</a>
                </li>

                <li class="list-group-item">
                    <a href="/trends"><i class="fa fa-bar-chart-o"></i> ข้อมูลการลงทุน</a>
                </li>


                <li class="list-group-item">
                    <a href="/changeplan"><i class="fa fa-cubes"></i> แผนการลงทุน</a>
                </li>
                <li class="list-group-item active">
                    <a href="/cumulative"><i class="fa fa-level-up"></i> ข้อมูลอัตราสะสม</a>
                </li>
                <li class="list-group-item">
                    <a href="/riskassessment"><i class="fa fa-exclamation-triangle"></i> แบบประเมินความเสียง</a>
                </li>
                <li class="list-group-item ">
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
                                            <small>ข้อมูลวันที่</small>
                                            <h4 class="counter">{{get_date_notime($infoaset->REFERENCE_DATE)}}</h4>
                                        </li>
                                        <li>
                                            <small>เงินลงทุนทั้งหมด</small>
                                            <h4 class="counter">{{meaNumbermoney($infoaset->INVESTMENT_MONEY) }} บาท</h4>
                                        </li>
                                        <li>
                                            <small>เงินตราสารทุน</small>
                                            <h4 class="counter">{{meaNumbermoney($infoaset->EQUITY_FUNDS) }} บาท</h4>
                                        </li>
                                        <li>
                                            <small>เงินตราสารหนี้</small>
                                            <h4 class="counter">{{meaNumbermoney($infoaset->BOND_FUNDS) }} บาท</h4>
                                        </li>

                                    </ul>
                                </div>



                            </div>


                        </div>
                    </div>

                </div><!--/end row-->
                <!--End Service Block v3-->

                <hr>

                <div class="tab-v2">
                    <ul class="nav nav-tabs">

                        @if($ishowhis)
                        <li class=""><a href="#home-1" data-toggle="tab" aria-expanded="true" >เปลี่ยนอัตราสะสม</a></li>
                        <li class="active"><a href="#profile-1" data-toggle="tab" aria-expanded="true">ประวัตการเปลี่ยนอัตราสะสม</a></li>
                        @else
                            <li class="active"><a href="#home-1" data-toggle="tab" aria-expanded="true" >เปลี่ยนอัตราสะสม</a></li>
                            <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="true">ประวัตการเปลี่ยนอัตราสะสม</a></li>
                        @endif

                    </ul>
                    <div class="tab-content">
                        @if($ishowhis)
                            <div class="tab-pane fade " id="home-1" style="position: relative" >
                                @else
                                    <div class="tab-pane fade active in" id="home-1" style="position: relative" >
                                        @endif


                            <div id="all_invest" style="{{objectcheckdisplaynone($CurrnentPlan)}}" >
                                <div class="row">
                                    <div class="headline-center margin-bottom-60">
                                        <h2>อัตราสะสมเดิม</h2>
                                        @if($CurrnentPlan)
                                        <p> {{$CurrnentPlan[0]->USER_SAVING_RATE}} %</p>
                                        @else
                                            <p> %</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12" style="padding: 0 100px 0 100px;">

                                        <a  href="{{action('cumulativeController@deleplan')}}" class="btn-u btn-u-lg btn-block btn-u-blue" id="btn_changplan" type="submit">ยกเลิกอัตราสะสมปัจจุบัน</a>

                                    </div>

                                </div>
                            </div>

                            <div id="invest_form" style="{{objectcheckdisplayblock($CurrnentPlan)}}"  >
                                <form action="{{ action('cumulativeController@InsertPlan') }}" id="sky-form1" class="sky-form" method="post">
                                    {!! csrf_field() !!}
                                    <header>เลือกแผนการลงทุน</header>
                                    <div class="alert alert-warning fade in">
                                        <strong> * การเปลี่นแปลงและแก้ไขอัตราสะสม ทำได้ภายในวันที่ {{$dataCheck->SAVING_RATE_CHANGE_PERIOD}} ของทุกเดือนและมีผลตั้งแต่วันที่ 1 ของเดือนถัดไป </strong>
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
                                                        <input type="text" style="background-color:#ccc" name="maxVal1" id="maxVal1"  value="{{$effective[0]->USER_SAVING_RATE}}" disabled>
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
                                        <input type="hidden" id="count_modify" name="count_modify" value="{{$effective[0]->MODIFY_COUNT}}">
                                        <input type="hidden" id="date_modify" name="date_modify" value="{{$effective[0]->CHANGE_SAVING_RATE_DATE}}">
                                    @endif
                                    <footer>
                                        <button type="submit" class="btn-u btn-u-default">ส่งข้อมูล</button>
                                        <button type="button" class="btn-u" id="btn_cancelinvest" >ยกเลิก</button>
                                    </footer>
                                </form>
                            </div>



                        </div>

                        @if($ishowhis)
                            <div class="tab-pane fade active in" id="profile-1">
                                @else
                                    <div class="tab-pane fade " id="profile-1">
                                        @endif



                            <form class="form-inline mea_searchbox" role="form" method="post" action="{{action('cumulativeController@getIndexbysearch')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                    <select name="drop_year" id="drop_year">
                                            {!! $ret !!}}
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
                                <table class="table table-bordered table-striped tbl_mea">
                                    <thead>

                                    <tr style="background-color: #26A9E0;color:white;">
                                        <th style="text-align:center;">ครั้งที่</th>
                                        <th style="text-align:center;">รหัสพนักงาน</th>
                                        <th style="text-align:center;">ชื่อ-สกุล</th>
                                        <th style="text-align:center;">อัตราการสะสมเดิม</th>
                                        <th style="text-align:center;">อัตราการสะสมใหม่</th>

                                        <th style="text-align:center;">วันทำรายการ</th>
                                        <th style="text-align:center;">วันที่มีผล</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @if($historyPlan)
                                        @foreach($historyPlan as $index => $item)
                                            <tr>

                                                <td style="text-align: center;">{{$item->MODIFY_COUNT .'/'.get_date_year($item->CHANGE_SAVING_RATE_DATE) }}</td>
                                                <td style="text-align: center;">{{$item->EMP_ID}}</td>
                                                <td style="text-align: center;">{{$item->FULL_NAME}}</td>

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

