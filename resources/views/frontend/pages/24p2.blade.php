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
                <li class="list-group-item">
                    <a href="/cumulative"><i class="fa fa-level-up"></i> ข้อมูลอัตราสะสม</a>
                </li>
                <li class="list-group-item active">
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


            <div id="quiztest">
                <div class="heading margin-bottom-40">
                    <h2>แบบประเมินความเสี่ยง "กองทุนสำรองเลี้ยงชีพ พนักงานการไฟฟ้านครหลวง ซึ่งจดทะเบียนแล้ว"</h2>
                    <p>การจัดทำ "แบบประเมินความเสียงเพื่อความเหมาะสมในการเลือกสัดส่วนการลงทุนระหว่างตราสารหนี้และตราสารทุน" (Member Risk Profile)
                        <strong> มีวัตถุประสงค์เพื่อให้สมาชิกทราบถึงระดับความเสี่ยงที่ยอมรับได้ของตนเอง เพื่อเป็น่สวนหนึ่งในการประกอบการตัดสินใสเลือกแผนการลงทุน</strong>
                    </p>
                </div>



                <div class="quiz">
                    <form action="{{ action('riskassessmentController@insertQuiz') }}" method="post" class="sky-form">


                        {!! csrf_field() !!}

                        <fieldset>


                            @if($dataqtopic)

                                @foreach($dataqtopic as $index => $item)
                                    @if($index ==0)
                                        <section id="sec_{{$index}}" style="display: block">
                                            @else
                                                <section id="sec_{{$index}}" style="display: none">
                                                    @endif
                                                    <p class="qa-topic">
                                                        <span class="dropcap dropcap-bg bg-color-dark" style="background-color: #fe5000;">{{$index +1}}</span>{{$item->QUESTION_DESC}}</p>
                                                    <div class="clearfix"></div>
                                                    {{--<label class="label"> . </label>--}}
                                                    <div class="row">
                                                        <div class="col col-12 qa-choice">

                                                            @foreach($datachoice as $index1 => $items)
                                                                @if($items->QUESTION_NO == $item->QUESTION_NO)
                                                                    <label class="radio"><input type="radio" id="radio_{{$index}}"  name="radio_{{$item->QUESTION_NO}}"  value="{{$items->QUESTION_CHOICE_SCORE}}" ><i class="rounded-x"></i>{{$items->QUESTION_CHOICE_DESC}}</label>

                                                                @endif
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                    <br/>
                                                    <div class="nextquiz">
                                                        @if($index > 0)
                                                            <button style="float: left;background-color: #95a5a6 !important; border-color: #95a5a6!important;" class="btn-u btn-brd btn-brd-hover rounded btn-u-green btn-u-sm" onclick='previous({{$index}})' type="button"><i class="fa fa-angle-double-left"></i> ข้อก่อนหน้า</button>
                                                        @endif
        <span class="qa-page"> {{ ($index+1) . "/".  count($dataqtopic)}} </span>
                                                        @if(($index+1) < count($dataqtopic))
                                                            <button class="btn-u btn-brd btn-brd-hover rounded btn-u-green btn-u-sm" onclick='next({{$index}})'  style="float: right" type="button"> ข้อถัดไป <i class="fa fa-angle-double-right"></i></button>
                                                        @endif
                                                    </div>
                                                </section>


                                                @endforeach

                                            @endif


                                            <input type="hidden" id="totalquiz" value="{{count($dataqtopic)}}">


                                </fieldset>



                        <footer>
                            <button type="submit" class="btn-u" onclick="return Checkbefore()">ส่งคำตอบแบบสอบถาม</button>
                            <button type="button" class="btn-u btn-u-default" onclick="window.history.back();">Back</button>
                        </footer>
                    </form>

                </div>
            </div>

            <div id="quizresult" style="display: none;">

                <div class="heading margin-bottom-40">
                    <h2> <strong>ท่านทำแบบประเมินความเสี่ยงฯ เสร็จสมบูรณ์แล้ว</strong></h2>

                    @if($quizprofile && $mappingret)

                    <p>  คะแนนรวมของท่าน : {{$quizprofile->QUIZ_SCORE}}  คะแนน</p>
                    <p>ระดับความเสี่ยงที่ยอมรับได้ : {{$mappingret->RISK_RATE}}</p>
                    @endif

                </div>



                <div class="row-fluid privacy">
                    <h2><strong>แนวทางในการพิจารณาเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้</strong></h2>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td style="background-color: #fe5000;color: #fff" >คะแนนรวม</td>
                            <td style="background-color: #fe5000;color: #fff">ความเสี่ยงที่ยอมรับได้</td>
                            <td style="background-color: #fe5000;color: #fff">สัดส่วนการลงทุนระหว่างตราสารหนี้และตราสารทุน</td>
                        </tr>

                        </thead>
                        <tbody>
                        @if($mapping)
                            @foreach($mapping as $index=>$item)
                            <tr>
                                <td>{{$item->SCORE_RANGE}}</td>
                                <td>{{$item->RISK_RATE}}</td>
                                <td>{{$item->RATIO_RECOMMENDED}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <p>  <strong>หมายเหตุ:</strong> ตารางข้างต้นเป็นเพียงส่วนหนึ่งในการประกอบการตัดสินใจเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้ของท่านเท่านั้นมิได้เป็นสิ่งยืนยันว่า สัดส่วนการลงทุนดังกล่าว เหมาะสมกับท่านทุกประการ ทั้งนี้ ท่านต้องศึกษาข้อมูลจากปัจจัยอื่นๆประกอบเพิ่มเติม</p>

                    <p> <strong>ข้อกำหนดและเงื่อนไขแนบท้าย “แบบประเมินความเสี่ยงเพื่อความเหมาะสมในการเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้”</strong></p>
                    <ol>
                        <li>1. ข้าพเจ้ารับทราบและตกลงว่า ข้าพเจ้ามีหน้าที่จะต้องทบทวนข้อมูลใน “แบบประเมินความเสี่ยงเพื่อความเหมาะสมในการเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้” ให้เป็นปัจจุบันตามรอบระยะเวลาที่หน่วยงานกำกับดูแลที่เกี่ยวข้องหรือบริษัทจัดการกำหนด รวมถึงที่จะมีการเปลี่ยนแปลงในอนาคตด้วย</li>
                        <li> 2. ในกรณีที่ครบรอบระยะเวลาการทบทวนข้อมูลใน “แบบประเมินความเสี่ยงเพื่อความเหมาะสมในการเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้” หากบริษัทจัดการไม่ได้รับข้อมูลในแบบประเมินในรอบใหม่จากข้าพเจ้าภายในระยะเวลาที่บริษัทจัดการกำหนด ข้าพเจ้าตกลงและยินยอมให้บริษัทจัดการถือเอาข้อมูลของข้าพเจ้าที่ปรากฎตาม “แบบประเมินความเสี่ยงเพื่อความเหมาะสมในการเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้” ครั้งล่าสุดเป็นข้อมูลปัจจุบันของข้าพเจ้า โดยมีผลใช้ได้จนถึงเวลาที่บริษัทจัดการได้รับข้อมูลในแบบประเมินความเสี่ยงเพื่อความเหมาะสมในการเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้แล้ว</li>
                        <li>3. ข้าพเจ้าขอรับรองว่าเป็นผู้ตอบคำถามดังกล่าวทั้งหมดด้วยตนเอง จึงได้ลงลายมือชื่อไว้เป็นหลักฐาน</li>
                        <li> 4. ข้าพเจ้ารับทราบเรื่องระดับความเสี่ยงของการเลือกสัดส่วนการลงทุนระหว่างตราสารทุนและตราสารหนี้ข้างต้น หากสัดส่วนที่ข้าพเจ้าเลือกมีระดับความเสี่ยงสูงกว่าแบบประเมินความเสี่ยงนี้ ข้าพเจ้ายอมรับและขอยืนยันที่จะลงทุนสัดส่วนตามที่ได้แจ้งไว้</li>

                    </ol><br>




                </div>




















            </div>





        </div>

    </div>

    <script>


        $(document).ready(function(){

            @if (Session::has('insertok'))

                        $('#quiztest').hide();
            $('#quizresult').show();


            @endif

        });

        function  Checkbefore(){

         var total =   $("#totalquiz").val();

            if($("input[id='radio_" + (total-1) +"']:checked").length<=0){
                alert("ท่านยังไม่ได้เลือกคำตอบของข้อนี้")

                return false;;
            }

        }


        function  next(index){


            if($("input[id='radio_" + index +"']:checked").length<=0)
            {
                alert("ท่านยังไม่ได้เลือกคำตอบของข้อนี้")
            }else {
                $("#sec_" + index).slideUp('300',function(){


                    $("#sec_" + (index +1)).slideDown(300);
                });
            }


            //alert(index);

        }

        function  previous(index){

            $("#sec_" + index).slideUp('300',function(){


                $("#sec_" + (index -1)).slideDown(300);
            });
        }
    </script>

@stop

