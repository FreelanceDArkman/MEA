<table class="table  table-bordered"  >

    <thead>

    <tr>
        <th style="width:5%;text-align: center" id="index_th">
            <input type="checkbox" id="mainCheck" />
        </th>
        <th style="width:10%;text-align: center">Action</th>
        <th  data-class="expand">รหัส แผนการ ลงทุน</th>
        <th  data-hide="phone">ชื่อแผนการ ลงทุน</th>
        <th style="width:10%;">สถานะ</th>
        <th style="width:10%;">วันที่เริ่มต้น</th>
        <th style="width:10%;">วันที่สิ้นสุด</th>
        <th style="width:10%;">สัดส่วนตรา สารทุน (ขั้น ต่ำ)</th>
        <th style="width:10%;">สัดส่วนตรา สารทุน (ขั้น สูง)</th>
        <th style="width:10%;">สัดส่วนตรา สารหนี้ (ขั้น ต่ำ)</th>
        <th style="width:10%;">สัดส่วนตรา สารหนี้ (ขั้น สูง)</th>

    </tr>
    </thead>

    <tbody>
    @if($data)
        @foreach($data as $item)

            @if($item->PLAN_ACTIVE_FLAG == 1)
            <tr style="background-color: #f1f1f1">
                @else
                <tr>
            @endif
                <td style="text-align: center"><input type="checkbox"  name="check_item_edit[]" value="{{$item->PLAN_ID}}" class="item_checked" id="item_check_{{$item->PLAN_ID}}" />

                </td>
                <td style="text-align: center">
                    <a href="/admin/chooseplan/edit/{{$item->PLAN_ID}}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                    <a href="javascript:void(0);"  data-id="{{$item->PLAN_ID}}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>

                </td>
                <td>{{$item->PLAN_ID}}</td>
                <td>{{$item->PLAN_NAME}}</td>


                <td>{{($item->PLAN_ACTIVE_FLAG == "0" ? "Active" : "Inactive")}}</td>
                <td>{{get_date_notime_en($item->PLAN_ACTIVE_DATE) }}</td>
                <td>{{get_date_notime_en($item->PLAN_EXPIRE_DATE) }}</td>
                <td>{{$item->EQUITY_MIN_PERCENTAGE}}</td>
                <td>{{$item->EQUITY_MAX_PERCENTAGE}}</td>
                <td>{{$item->DEBT_MIN_PERCENTAGE}}</td>
                <td>{{$item->DEBT_MAX_PERCENTAGE}}</td>

            </tr>


        @endforeach

    @endif

    </tbody>
    <tfoot>
    <tr>
        <td colspan="11">
            {!! $htmlPaginate !!}
        </td>
    </tr>
    </tfoot>
</table>