

<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <th colspan="11" style="text-align: center">รายงานข้อมูล ณ วันที่ {{get_date_notime(date("Y-m-d H:i:s"))}}</th>
    </tr>
    <tr>
        <th>งวด</th>
        <th>รหัสพนักงาน</th>
        <th>ชื่อ-นามสกุล</th>
        <th>หน่วยงาน</th>
        <th>เงินสมทบ</th>
        <th>ผลประโยชน์เงินสมทบ</th>
        <th>เงินสะสม</th>
        <th>ผลประโยชน์เงินสะสม</th>
        <th>ผลรวมส่วนของนายจ้าง</th>
        <th>เงินบำเหน็จสุทธิหลังหักภาษี</th>
        <th>ส่วนต่าง</th>


    </tr>
    </thead>
    <tbody>
    @foreach($data as $index =>$d)
        @if(($index%2)==0)
    <tr>
        @else
            <tr class="odd">
         @endif
        <td>{{get_date_period($d->PERIOD)}}</td>
        <td>{{$d->EMP_ID}}</td>
        <td>{{$d->FULL_NAME}}</td>
        <td>{{$d->DEP_SHT}}</td>
        <td>{{$d->EMPLOYER_CONTRIBUTION_1}}</td>
        <td>{{$d->EMPLOYER_EARNING_2}}</td>
        <td>{{$d->MEMBER_CONTRIBUTION_3}}</td>
        <td>{{$d->MEMBER_EARNING_4}}</td>
        <td>{{$d->totalA}}</td>
        <td>{{$d->tax}}</td>
        <td>{{$d->totalAB}}</td>



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