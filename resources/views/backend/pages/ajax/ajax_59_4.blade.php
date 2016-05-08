
@if($data)

    <table class="table table-bordered table-striped">
        <thead >
        <tr>
            <th style="width: 20%">จํานวนครั้งในการเปลี่ยนแผน</th>
            <th style="width: 20%">ช่วงเวลาในการเปลี่ยนแผน</th>
            <th style="width: 20%">จํานวนครั้งในการเปลี่ยนอตั ราสะสม</th>
            <th style="width: 20%">ช่วงเวลาในการเปลี่ยนอัตราสะสม</th>
        <th style="width: 20%">Action</th>
        </tr>
        </thead>
        <tbody>
@foreach($data as $index =>$list  )

    <tr>

        <td><input type="text" id="FUND_PLAN_TIME_CHANGE_PER_YEAR{{$list->CONTROL_ID}}" value="{{$list->FUND_PLAN_TIME_CHANGE_PER_YEAR}}" class="form-control"></td>
        <td><input type="text" id="FUND_PLAN_CHANGE_PERIOD{{$list->CONTROL_ID}}" value="{{$list->FUND_PLAN_CHANGE_PERIOD}}" class="form-control"></td>
        <td><input type="text" id="SAVING_RATE_TIME_CHANGE_PER_MONTH{{$list->CONTROL_ID}}" value="{{$list->SAVING_RATE_TIME_CHANGE_PER_MONTH}}" class="form-control"></td>
        <td><input type="text" id="SAVING_RATE_CHANGE_PERIOD{{$list->CONTROL_ID}}" value="{{$list->SAVING_RATE_CHANGE_PERIOD}}" class="form-control"></td>
        <td>
            <a href="#" class="btn btn-primary btn-xs btn_edit_list" data-id="{{$list->CONTROL_ID}}"  ><i class="fa fa-plus"></i>แก้ไข</a>

        </td>
    </tr>


@endforeach
        </tbody>
    </table>
@else
    <div class="list" style="margin-bottom: 10px; padding: 10px">
        <p style="font-size: 20px;padding: 10px;text-align: center;width: 100%;background-color: #f1f1f1;border: 1px solid #E1E8F3">ไม่พบข้อมูล</p>
    </div>

@endif


