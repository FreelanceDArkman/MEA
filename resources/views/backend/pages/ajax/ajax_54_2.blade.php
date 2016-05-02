<table class="table table-striped  table-bordered"  >

    <thead>

    <tr>
        <th style="width:3%;text-align: center" id="index_th">
            <input type="checkbox" id="mainCheck" />
        </th>
        <th style="width:8%;text-align: center">Action</th>

        <th style="width:20%;">ชื่อหมวดหมู่ข่าว</th>
        <th style="width:5%;">รหัสคำถาม</th>
        <th style="width:20%;">รายละเอียดคำถาม</th>
        <th style="width:5%;">รหัสคำตอบ</th>
        <th style="width:20%;">รายละเอียดคำตอบ</th>
        <th style="width:5%;">สถานะ</th>
        <th style="width:7%;">วันที่เริ่มต้น</th>
        <th style="width:7%;">วันที่สิ้นสุด</th>


    </tr>
    </thead>

    <tbody>
    @if($data)
        @foreach($data as $item)

            @if($item->FAQ_TOPIC_FLAG == 1)
            <tr style="background-color: #f1f1f1">
                @else
                <tr>
            @endif
                <td style="text-align: center"><input type="checkbox"  name="check_item_edit[]" value="{{$item->FAQ_CATE_ID .",". $item->FAQ_QUESTION_ID}}" class="item_checked" id="item_check_{{$item->FAQ_CATE_ID .",". $item->FAQ_QUESTION_ID}}" />

                </td>
                <td style="text-align: center">
                    <a href="/admin/faqtopic/edit/{{$item->FAQ_CATE_ID .",". $item->FAQ_QUESTION_ID}}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                    <a href="javascript:void(0);"  data-id="{{$item->FAQ_CATE_ID .",". $item->FAQ_QUESTION_ID}}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>

                </td>
                <td>{{$item->FAQ_CATE_NAME}}</td>
                <td>{{$item->FAQ_QUESTION_ID}}</td>
                    <td>{{$item->FAQ_QUESTION_DETAIL}}</td>
                    <td>{{$item->FAQ_ANSWER_ID}}</td>
                    <td>{{$item->FAQ_ANSWER_DETAIL}}</td>


                <td>{{($item->FAQ_TOPIC_FLAG == "0" ? "Active" : "Inactive")}}</td>
                <td>{{get_date_notime($item->START_DATE) }}</td>
                <td>{{get_date_notime($item->EXPIRE_DATE) }}</td>


            </tr>


        @endforeach
    @else

        <tr><td colspan="10"> No Data</td></tr>

    @endif

    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            {!! $htmlPaginate !!}
        </td>
    </tr>
    </tfoot>
</table>