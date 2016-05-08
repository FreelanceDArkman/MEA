
@if($datag)

    @foreach($datag as $item)
<div class="row" style="padding: 10px">
    <form action="#" id="form_step_{{$item->QUESTION_NO}}" class="smart-form">

        <div class="col-xs-12" style="text-align: center" >
            <table class="table table-bordered " style="margin-bottom: 0px; border-bottom: 0;">
                <tr>
                    <td style="width: 10%">

                        <section>

                            <label class="input">
                                <label><strong>คำถามที่ </strong></label>

                                <input id="QUESTION_NO_{{$item->QUIZ_ID}}" value="{{$item->QUESTION_NO}}"   class="form-control" type="text">
                            </label></section>
                    </td>

                    <td style="width: 90%">

                        <section>

                            <label class="input">
                                <label><strong>รายละเอียดคําถาม </strong></label>
                                <input id="QUESTION_DESC_{{$item->QUIZ_ID}}" value="{{$item->QUESTION_DESC}}"   class="form-control" type="text">

                            </label></section>
                    </td></tr>

            </table>
            {{--<td> <a id="gen_risk"  class="btn bg-color-green txt-color-white"><i class="fa fa-plus"></i> เพิ่ม</a></td>--}}
            <table class="table table-bordered table-striped" style="margin: 0 auto; font-size: 18px">

                <tr>
                <td>
                    @foreach($data as $lis)
                        @if($lis->QUESTION_NO == $item->QUESTION_NO && $lis->QUESTION_CHOICE_NO == 1)
                    <section style="float: left">
                        <label class="input">
                            <label><strong>ตัวเลือกที่ 1 </strong></label>

                            {{--id="QUESTION_CHOICE_SCORE_1_{{$lis->QUIZ_ID}}_{{$lis->QUESTION_CHOICE_NO}}"--}}
                            <input id="QUESTION_CHOICE_SCORE_1_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}" value="{{$lis->QUESTION_CHOICE_SCORE}}"  style="width: 100px;display: inline" class="form-control" type="text">


                        </label></section>
                    <section style="float: left;margin-left: 5px;">
                        <label class="input">
                            <input id="QUESTION_CHOICE_DESC_1_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}" value="{{$lis->QUESTION_CHOICE_DESC}}"    style="width: 300px;display: inline"  class="form-control" type="text">
                        </label></section>
                    @endif
                    @endforeach

                </td>
                <td>
                    @foreach($data as $lis)
                        @if($lis->QUESTION_NO == $item->QUESTION_NO && $lis->QUESTION_CHOICE_NO == 2)
                    <section style="float: left"><label class="input">
                            <label><strong>ตัวเลือกที่ 2 </strong></label>
                            <input id="QUESTION_CHOICE_SCORE_2_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}" value="{{$lis->QUESTION_CHOICE_SCORE}}"  style="width: 100px;display: inline" class="form-control" type="text">
                        </label></section>
                    <section style="float: left;margin-left: 5px;"><label class="input">
                            <input id="QUESTION_CHOICE_DESC_2_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}" value="{{$lis->QUESTION_CHOICE_DESC}}"   style="width: 300px;display: inline"  class="form-control" type="text">
                        </label></section>
                        @endif
                    @endforeach
                </td>



                </tr>
                <tr>
                    <td>
                        @foreach($data as $lis)
                            @if($lis->QUESTION_NO == $item->QUESTION_NO && $lis->QUESTION_CHOICE_NO == 3)
                        <section style="float: left"><label class="input">
                                <label><strong>ตัวเลือกที่ 3 </strong></label>
                                <input id="QUESTION_CHOICE_SCORE_3_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}"  value="{{$lis->QUESTION_CHOICE_SCORE}}" style="width: 100px;display: inline" class="form-control" type="text">
                            </label></section>
                        <section style="float: left;margin-left: 5px;"><label class="input">
                                <input id="QUESTION_CHOICE_DESC_3_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}" value="{{$lis->QUESTION_CHOICE_DESC}}"    style="width: 300px;display: inline"  class="form-control" type="text">
                            </label></section>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($data as $lis)
                            @if($lis->QUESTION_NO == $item->QUESTION_NO && $lis->QUESTION_CHOICE_NO == 4)
                        <section style="float: left"><label class="input">
                                <label><strong>ตัวเลือกที่ 4 </strong></label>
                                <input id="QUESTION_CHOICE_SCORE_4_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}"  value="{{$lis->QUESTION_CHOICE_SCORE}}"    style="width: 100px;display: inline" class="form-control" type="text">
                            </label></section>
                        <section style="float: left;margin-left: 5px;"><label class="input">
                                <input id="QUESTION_CHOICE_DESC_4_{{$item->QUIZ_ID}}_{{$item->QUESTION_NO}}" value="{{$lis->QUESTION_CHOICE_DESC}}"    style="width: 300px;display: inline"  class="form-control" type="text">
                            </label></section>
                        @endif
                        @endforeach
                    </td>



                </tr>

            </table>
        </div>
    </form>


</div>




<div class="smart-form"><footer>
        <a data-val="2"  data-QUIZ_ID="{{$item->QUIZ_ID}}" data-QUESTION_NO="{{$item->QUESTION_NO}}" class="btn bg-color-red txt-color-white btn-question-delete"><i class="glyphicon glyphicon-trash"></i> ลบ</a>
        <button type="button" data-QUIZ_ID="{{$item->QUIZ_ID}}" data-QUESTION_NO="{{$item->QUESTION_NO}}"  href="" class="btn bg-color-green txt-color-white btn-question-edit"><i class="fa fa-plus"></i> แก้ไข</button>

    </footer></div>

    @endforeach

    @else
    <div class="row" >
        <form action="#" id="form_step_3" class="smart-form">

            <div class="col-xs-12" style="text-align: center" >
                <table class="table table-bordered " style="margin-bottom: 0px; border-bottom: 0;">
                    <tr>
                        <td> กรุณาสร้าง รายการคำถาม</td>
                    </tr>

                </table>

            </div>
        </form>


    </div>
    @endif