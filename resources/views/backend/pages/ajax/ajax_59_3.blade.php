
@if($data)

    <table class="table table-bordered table-striped">
        <thead >
        <tr>
            <th style="width: 30%">Root Path for Web Application:(ข้อมูลข่าว)</th>
            <th style="width: 30%">Root Path for Web Service:(ข้อมูลผู้รับผลประโยชน์)</th>
            <th style="width: 30%">Root Path for Web Application:(ข้อมูลผู้รับผลประโยชน์)</th>
        <th style="width: 10%">Action</th>
        </tr>
        </thead>
        <tbody>
@foreach($data as $index =>$list  )

    <tr>

        <td><input type="text" id="WEB_NEWS_ROOT_PATH_{{$list->CONTROL_ID}}" value="{{$list->WEB_NEWS_ROOT_PATH}}" class="form-control"></td>
        <td><input type="text" id="WS_BENEFICIARY_ROOT_PATH_{{$list->CONTROL_ID}}" value="{{$list->WS_BENEFICIARY_ROOT_PATH}}" class="form-control"></td>
        <td><input type="text" id="WEB_BENEFICIARY_ROOT_PATH_{{$list->CONTROL_ID}}" value="{{$list->WEB_BENEFICIARY_ROOT_PATH}}" class="form-control"></td>
        <td>
            <a href="#" class="btn btn-primary btn-xs btn_edit_list" data-id="{{$list->CONTROL_ID}}"  >บันทึก</a>

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


