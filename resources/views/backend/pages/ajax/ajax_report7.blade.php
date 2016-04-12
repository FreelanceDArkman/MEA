

<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <th>รหัสพนักงาน</th>
        <th>ชื่อ-นามสกุล</th>
        <th>หน่วยงาน</th>
        <th>สถานะของสมาชิก</th>
        <th>วันที พ้นสภาพ</th>


    </tr>
    </thead>
    <tbody>
    @foreach($data as $index =>$d)
        @if(($index%2)==0)
    <tr>
        @else
            <tr class="odd">
            @endif

        <td>{{$d->EMP_ID}}</td>
        <td>{{$d->FULL_NAME}}</td>
        <td>{{$d->DEP_SHT}}</td>
        <td>{{$d->STATUS_DESC}}</td>
        <td>{{get_date_notime($d->LEAVE_FUND_GROUP_DATE)}}</td>




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