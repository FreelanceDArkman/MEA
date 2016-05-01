<table class="table  table-bordered"  >

    <thead>

    <tr>
        <th style="width:5%;text-align: center" id="index_th">
            <input type="checkbox" id="mainCheck" />
        </th>
        <th style="width:10%;text-align: center">Action</th>

        <th style="width:20%;">ชื่อหมวดหมู่ข่าว</th>
        <th style="width:5%;">รหัสหัวข้อข่าว</th>
        <th style="width:35%;">ชือหัวข้อข่าว</th>
        <th style="width:5%;">สถานะ</th>
        <th style="width:10%;">วันที่เริ่มต้น</th>
        <th style="width:10%;">วันที่สิ้นสุด</th>


    </tr>
    </thead>

    <tbody>
    @if($data)
        @foreach($data as $item)

            @if($item->NEWS_CATE_FLAG == 1)
            <tr style="background-color: #f1f1f1">
                @else
                <tr>
            @endif
                <td style="text-align: center"><input type="checkbox"  name="check_item_edit[]" value="{{$item->NEWS_CATE_ID .",". $item->NEWS_TOPIC_ID}}" class="item_checked" id="item_check_{{$item->NEWS_CATE_ID .",". $item->NEWS_TOPIC_ID}}" />

                </td>
                <td style="text-align: center">
                    <a href="/admin/news/edit/{{$item->NEWS_CATE_ID .",". $item->NEWS_TOPIC_ID}}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                    <a href="javascript:void(0);"  data-id="{{$item->NEWS_CATE_ID .",". $item->NEWS_TOPIC_ID}}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>

                </td>
                <td>{{$item->NEWS_CATE_NAME}}</td>
                <td>{{$item->NEWS_TOPIC_ID}}</td>
                    <td>{{$item->FILE_NAME}}</td>


                <td>{{($item->NEWS_TOPIC_FLAG == "0" ? "Active" : "Inactive")}}</td>
                <td>{{get_date_notime($item->START_DATE) }}</td>
                <td>{{get_date_notime($item->EXPIRE_DATE) }}</td>


            </tr>


        @endforeach
    @else

        <tr><td colspan="8"> No Data</td></tr>

    @endif

    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            {!! $htmlPaginate !!}
        </td>
    </tr>
    </tfoot>
</table>