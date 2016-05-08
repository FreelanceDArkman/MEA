<table class="table table-bordered table-striped" style="margin: 0 auto; font-size: 18px">
    <tr>

        <th style="width: 20%">ช่วงคะแนน</th>
        <th style="width: 20%">ระดับความเส่ียง</th>
        <th style="width: 40%">สัดส่วนการลงทุนที่แนะนํา</th>
        <th style="width: 10%"></th>
        <th style="width: 10%"></th>

    </tr>

    @if($data)
        @foreach($data as $item)
    <tr>
        <td>
            <input placeholder="10-16" id="data-rage_{{$item->SCORE_ID}}" value="{{$item->SCORE_RANGE}}"  class="form-control" type="text">
        </td>
        <td> <input placeholder="ต่ำ" id="data-riskrate_{{$item->SCORE_ID}}" value="{{$item->RISK_RATE}}"  class="form-control" type="text"></td>
        <td>
            <input  value="{{$item->RATIO_RECOMMENDED}}" id="data-ratiorecom_{{$item->SCORE_ID}}" placeholder="มีสัดส่วนการลงทุนตราสารทนุ 0%"  class="form-control" type="text">
        </td>
        <td> <a  data-val="{{$item->SCORE_ID}}" data-rage="{{$item->SCORE_RANGE}}" data-riskrate="{{$item->RISK_RATE}}" data-ratiorecom="{{$item->RATIO_RECOMMENDED}}" class="btn bg-color-green txt-color-white gen_risk_update"><i class="fa fa-plus"></i> แก้ไข</a></td>
        <td> <a  data-val="{{$item->SCORE_ID}}" data-rage="{{$item->SCORE_RANGE}}" data-riskrate="{{$item->RISK_RATE}}" data-ratiorecom="{{$item->RATIO_RECOMMENDED}}"  class="btn bg-color-red txt-color-white gen_risk_delete"><i class="glyphicon glyphicon-trash"></i> ลบ</a></td>
    </tr>
        @endforeach
    @endif
</table>