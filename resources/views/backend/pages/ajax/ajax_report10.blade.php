

<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <th colspan="3" style="text-align: center">รายงานข้อมูล ณ วันที่ {{get_date_notime(date("Y-m-d H:i:s"))}}</th>
    </tr>
    <tr>
        <th>วันที่</th>
        <th>จำนวนผู้ติดตั้งบน IOS</th>
        <th>จำนวนผู้ติดตั้งบน Andriod</th>



    </tr>
    </thead>
    <tbody>
    @foreach($data as $index =>$d)

        @if($d->IOSUSE > 0 || $d->ANDRIODUSE >0)

        @if(($index%2)==0)
    <tr>
        @else
            <tr class="odd">
            @endif

        <td>{{get_date_notime($d->DAteStamp)}}</td>
        <td>{{$d->IOSUSE}}</td>
        <td>{{$d->ANDRIODUSE}}</td>
        {{--<td>{{get_date_notime($d->QUIZ_TEST_DATE)}}</td>--}}
        {{--<td>{{$d->QUIZ_SCORE}}</td>--}}
        {{--<td>{{$d->QUIZ_RESULT}}</td>--}}


                @endif

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