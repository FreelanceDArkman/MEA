

<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <th colspan="6" style="text-align: center">รายงานข้อมูล ณ วันที่ {{get_date_notime(date("Y-m-d H:i:s"))}}</th>
    </tr>
    <tr>
        <th>รหัสพนักงาน</th>
        <th>ชื่อ-นามสกุล</th>
        <th>หน่วยงาน</th>
        <th>วันที่ทำแบบประเมินความเสี่ยง</th>
        <th>คะแนนรวม</th>
        <th>รายละเอียด</th>


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
        <td>{{get_date_notime($d->QUIZ_TEST_DATE)}}</td>
        <td>{{$d->QUIZ_SCORE}}</td>
        <td>{{$d->QUIZ_RESULT}}</td>




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