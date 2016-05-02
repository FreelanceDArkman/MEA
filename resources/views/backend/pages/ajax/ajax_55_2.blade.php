<table class="table table-striped  table-bordered"  >

    <thead>

    <tr>
        {{--<th style="width:3%;text-align: center" id="index_th">--}}
            {{--<input type="checkbox" id="mainCheck" />--}}
        {{--</th>--}}
        <th style="width:5%;text-align: center">Action</th>

        <th style="width:5%;">เลขที่คำถาม</th>
        <th style="width:15%;">หัวข้อเรื่อง</th>
        <th style="width:35%;">รายละเอียดคำถาม</th>
        <th style="width:5%;">สถานะ</th>
        <th style="width:5%;">วันที่สอบถาม</th>
        <th style="width:5%;">ผู้สอบถาม</th>
        <th style="width:5%;">หน่วยงาน</th>
        <th style="width:5%;">โทรศัพท์</th>
        <th style="width:5%;">อีเมล์</th>
        <th style="width:5%;">วันที่ตอบกลับ</th>
        <th style="width:5%;">ผู้ตอบ</th>
        <th style="width:5%;">หมายเหตุ</th>
    </tr>
    </thead>

    <tbody>
    @if($data)
        @foreach($data as $item)

            @if($item->INFM_FLAG == 2)
            <tr style="background-color: #f1f1f1">
                @else
                <tr>
            @endif
                {{--<td style="text-align: center"><input type="checkbox"  name="check_item_edit[]" value="{{$item->FAQ_CATE_ID .",". $item->FAQ_QUESTION_ID}}" class="item_checked" id="item_check_{{$item->FAQ_CATE_ID .",". $item->FAQ_QUESTION_ID}}" />--}}

                {{--</td>--}}
                <td style="text-align: center">
                    <a href="/admin/cmail/forward/{{$item->INFM_ID }}" title="Forward"  class="btn btn-primary btn-xs"><i class="fa fa-mail-forward"></i></a>
                    <a href="/admin/cmail/reply/{{$item->INFM_ID }}" title="Reply" class="btn bg-color-green btn-xs txt-color-white"><i class="fa fa-mail-reply"></i></a>

                    {{--<a href="javascript:void(0);"  data-id="{{$item->INFM_ID }}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>--}}

                </td>
                <td>{{$item->INFM_ID}}</td>
                <td>{{$item->INFM_TOPIC}}</td>
                    <td>{{$item->INFM_DETAIL}}</td>
                    <td>{{($item->INFM_FLAG == "0" ? "Active" : "Inactive")}}</td>
                    <td>{{ get_date($item->INFM_DATE) }}</td>

                    <td>{{$item->INFM_NAME}}</td>
                    <td>{{$item->INFM_DEPT}}</td>
                    <td>{{$item->INFM_PHONE}}</td>
                    <td>{{$item->INFM_EMAIL}}</td>
                    <td>{{ ($item->REPLY_DATE == "" ? "" : get_date($item->REPLY_DATE))  }}</td>
                    <td>{{$item->REPLY_BY}}</td>
                    <td>{{$item->REMARK}}</td>




            </tr>


        @endforeach
    @else

        <tr><td colspan="13"> No Data</td></tr>

    @endif

    </tbody>
    <tfoot>
    <tr>
        <td colspan="13">
            {!! $htmlPaginate !!}
        </td>
    </tr>
    </tfoot>
</table>