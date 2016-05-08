
<table class="table  table-bordered"  >

    <thead>

    <tr>
        <th style="width:5%;text-align: center" id="index_th">
            <input type="checkbox" id="mainCheck" class="mainCheck" />
        </th>
        <th style="width:10%;text-align: center">Action</th>

        <th style="width:15%;">รหัสแบบประเมินความเสี่ยง</th>
        <th style="width:35%;">ชื่อแบบประเมินความเสี่ยง</th>

        <th style="width:5%;">สถานะ</th>
        {{--<th style="width:15%;">วันที่เริ่มต้น</th>--}}
        {{--<th style="width:15%;">วันที่สิ้นสุด</th>--}}



    </tr>
    </thead>

    <tbody>
    @if($data)
        @foreach($data as $item)

            @if($item->QUIZ_ACTIVE_FLAG == 1)
            <tr style="background-color: #f1f1f1">
            @else
                <tr>
            @endif
                <td style="text-align: center"><input type="checkbox"  name="check_item_edit[]" value="{{$item->QUIZ_ID }}" class="item_checked" id="item_check_{{$item->QUIZ_ID }}" />

                </td>
                <td style="text-align: center">
                    <a href="/admin/risk/edit/{{$item->QUIZ_ID }}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>

                    {{--<a href="javascript:void(0);"  data-id="{{$item->QUIZ_ID }}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>--}}

                </td>
                <td>{{$item->QUIZ_ID}}</td>
                <td>{{$item->QUIZ_DESC}}</td>



                <td style="text-align: center">

                    {{--{{($item->QUIZ_ACTIVE_FLAG == "0" ? "Active" : "Inactive")}}--}}
                    @if($item->QUIZ_ACTIVE_FLAG == "0")

                        <input type="radio" class="raio_chck" data-check="true" name="QUIZ_ACTIVE_FLAG" value="{{$item->QUIZ_ID}}"   />
                    @else
                        <input type="radio" class="raio_chck"  name="QUIZ_ACTIVE_FLAG" value="{{$item->QUIZ_ID}}" />
                    @endif

                </td>
                {{--<td>{{get_date_notime($item->QUIZ_ACTIVE_DATE) }}</td>--}}
                {{--<td>{{get_date_notime($item->QUIZ_EXPIRE_DATE) }}</td>--}}


            </tr>


        @endforeach
    @else

        <tr><td colspan="7"> No Data</td></tr>

    @endif

    </tbody>
    {{--<tfoot>--}}
    {{--<tr>--}}
        {{--<td colspan="7">--}}
            {{--{!! $htmlPaginate !!}--}}
        {{--</td>--}}
    {{--</tr>--}}
    {{--</tfoot>--}}
</table>