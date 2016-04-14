

<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <th>วันที่</th>
        <th>รหัสพนักงาน</th>
        <th>ช่องทางเข้าใช้งาน</th>
        <th>ระบบปฏิบัติงาน</th>
        <th>บราวเซอร์</th>
        <th>IP Address</th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $index =>$d)
        @if(($index%2)==0)
    <tr>
        @else
            <tr class="odd">
            @endif
        <td>{{get_date($d->DATETIME)}}</td>
        <td>{{$d->USERNAME}}</td>
        <td>{{$d->ACCESS_CHANNEL}}</td>
        <td>{{$d->OS}}</td>
        <td>{{$d->BROWSER}}</td>
        <td>{{$d->IP_ADDRESS}}</td>






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