
@if($data)
@foreach($data as $index =>$list  )
<div class="list" style="margin-bottom: 10px; padding: 10px">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="text-align: center">ลำดับที่</th>
            <th></th>

            <th style="text-align: center">มูลค่าต่อหน่วย (บาท)</th>
            <th style="text-align: center">มูลค่าทรัพย์สินสุทธิ (ล้านบาท)</th>
            <th style="text-align: center">อัตราผลตอบแทนการลงทุนสะสม (%)</th>
            <th style="text-align: center">ข้อมูล ณ วันที่</th>
            <th style="text-align: center">action</th>
        </tr>
        <tbody>
        <tr>

            <td rowspan="2" style="vertical-align: middle;text-align: center">{{($index+1)}}</td>
            <td><strong>นโยบายตราสารทุน</strong></td>
            <td><input type="text" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_UNIT_1}}" /></td>
            <td><input type="text" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_1}}"/></td>
            @if($list->RETURN_RATE_1 < 0)
            <td><input type="text" class="form-control" style="text-align: right;background: #fff0f0;border-color: #A90329;" value="{{$list->RETURN_RATE_1}}"/></td>
            @else
                <td><input type="text" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->RETURN_RATE_1}}"/></td>
            @endif
            <td rowspan="2" style="text-align: center"> {{get_date_notime($list->REFERENCE_DATE)}}</td>
            <td rowspan="2" style="vertical-align: middle;text-align: center">
                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                <a href="javascript:void(0);"   class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>

            </td>
        </tr>
        <tr>

            {{--background: #f0fff0;--}}
            {{--border-color: #7DC27D;--}}
            {{--background: #fff0f0;--}}
            {{--border-color: #A90329;--}}

            <td> <strong>นโยบายตราสารหนี้</strong></td>
            <td><input type="text" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_UNIT_2}}" /></td>
            <td><input type="text" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_2}}"/></td>

            @if($list->RETURN_RATE_2 < 0)
                <td><input type="text" class="form-control" style="text-align: right;background: #fff0f0;border-color: #A90329;" value="{{$list->RETURN_RATE_2}}"/></td>
                @else
                <td><input type="text" class="form-control" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->RETURN_RATE_2}}"/></td>

            @endif


        </tr>
        </tbody>
        </thead>

    </table>
</div>
@endforeach

@else
    <div class="list" style="margin-bottom: 10px; padding: 10px">
        <p style="font-size: 20px;padding: 10px;text-align: center;width: 100%;background-color: #f1f1f1;border: 1px solid #E1E8F3">ไม่พบข้อมูล</p>
    </div>

@endif


