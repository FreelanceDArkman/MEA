

<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <th colspan="3" style="text-align: center">รายงานข้อมูล ณ วันที่ {{get_date_notime(date("Y-m-d H:i:s"))}}</th>
    </tr>
    <tr>
        <th>วันที่</th>
        <th>คำสืบค้น</th>
        <th>จำนวนครั้ง</th>
        {{--<th>ระบบปฏิบัติงาน</th>--}}
        {{--<th>บราวเซอร์</th>--}}
        {{--<th>IP Address</th>--}}

    </tr>
    </thead>
    <tbody>
    @foreach($data as $index =>$d)
        @if(($index%2)==0)
    <tr>
        @else
            <tr class="odd">
            @endif
        <td>{{get_date_notime($d->SEARCH_DATE)}}</td>
        <td>{{$d->KEYWORD}}</td>
        <td>{{$d->HITS_COUNT}}</td>
        {{--<td>{{$d->OS}}</td>--}}
        {{--<td>{{$d->BROWSER}}</td>--}}
        {{--<td>{{$d->IP_ADDRESS}}</td>--}}






    </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="13">
                {!! $htmlPaginate !!}
            </td>
        </tr>
    </tfoot>

    @else
        <tbody>
            <tr>
                <td >ไม่พบรายการ</td>
            </tr>
        </tbody>
    @endif
</table>

<div>


</div>