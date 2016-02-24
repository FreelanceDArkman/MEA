<!DOCTYPE html>

<html>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{--<link rel="stylesheet" href="{{asset('frontend/assets/plugins/bootstrap/css/bootstrap.min.css')}}">--}}
    {{--<script type="text/javascript" src="{{asset('frontend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>--}}

    <style>

        .table{
            background-color: #00A0D1;
        }
    </style>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>



<table class="table table-bordered table-striped">
    <thead>
    <tr >
        <th rowspan="3" width="70" style="text-align:center;">งวด</th>
        <th rowspan="3" width="60" style="text-align:center;">เงินเดือน</th>
        <th rowspan="3" width="60" style="text-align:center;">อายุ <br>(ปี/วัน)</th>
        <th rowspan="3" width="60" style="text-align:center;">อายุงาน<br> (ปี/วัน)</th>
        <th colspan="6" style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</th>



        <th width="100" rowspan="2" colspan="3" style="text-align:center;">เงินบำเหน็จ (บาท)</th>
        <th width="100" rowspan="2" colspan="3" style="text-align:center;">เปรียบเทียบกองทุนสำรองเลี้ยงชีพฯ กับเงินบำเหน็จ(บาท)</th>
    </tr>
    <tr >
        <th colspan="3" style="text-align:center;">ส่วนของนายจ้าง</th>
        <th colspan="3" style="text-align:center;">ส่วนของลูกจ้าง</th>
    </tr>
    <tr >
        <th style="text-align:center;">เงินสมทบ</th>
        <th style="text-align:center;">ผลประโยชน์เงินสมทบ</th>
        <th style="text-align:center;">รวม</th>

        <th style="text-align:center;">เงินสะสม</th>
        <th style="text-align:center;">ผลประโยชน์เงินสะสม</th>
        <th style="text-align:center;">รวม</th>

        <th style="text-align:center;">เงินบำเหน็จก่อนหักภาษี</th>
        <th style="text-align:center;">ภาษี</th>
        <th style="text-align:center;">เงินบำเหน็จสุทธิหลังหักภาษี</th>


        <th style="text-align:center;">ผลรวมส่วนของนายจ้าง </th>
        <th style="text-align:center;">เงินสุทธิหลังหักภาษี</th>
        <th style="text-align:center;">ส่วนต่าง </th>


    </tr>
    <tr >
        <th style="text-align:center;">1</th>
        <th style="text-align:center;">2</th>
        <th style="text-align:center;">3</th>
        <th style="text-align:center;">4</th>
        <th style="text-align:center;">5</th>
        <th style="text-align:center;">6</th>
        <th style="text-align:center;">7</th>
        <th style="text-align:center;">8</th>
        <th style="text-align:center;">9</th>
        <th style="text-align:center;">10</th>
        <th style="text-align:center;">11</th>
        <th style="text-align:center;">12</th>
        <th style="text-align:center;">13</th>
        <th style="text-align:center;">14</th>
        <th style="text-align:center;">15</th>
        <th style="text-align:center;">16</th>
    </tr>



    </thead>


    <tbody style="cellpadding:2px;">

    @foreach($netasset2 as $index =>$item)
        <tr>
            <td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>
            <td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>

            <td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1  + $item->EMPLOYER_EARNING_2)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3 + $item->MEMBER_EARNING_4)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY_TAX)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY - $item->GRATUITY_TAX)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2 )}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->GRATUITY - $item->GRATUITY_TAX)}}</td>
            <td style="text-align: right;">{{meaNumbermoney(($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2) - ($item->GRATUITY - $item->GRATUITY_TAX))}}</td>

        </tr>
    @endforeach



    </tbody>


</table>


{{--{{!! HTML::style(asset('frontend/assets/plugins/bootstrap/js/bootstrap.min.js')); }}--}}
{{--<table class="table table-bordered table-striped">--}}

    {{--<tr>--}}
        {{--<td widtd="100" style="text-align:center;">งวด</td>--}}
        {{--<td  widtd="100" style="text-align:center;">เงินเดือน</td>--}}
        {{--<td  widtd="100" style="text-align:center;">อายุ (ปี/วัน)</td>--}}
        {{--<td  widtd="100" style="text-align:center;">อายุงาน (ปี/วัน)</td>--}}
        {{--<td style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td widtd="100"  style="text-align:center;">รวม</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td style="text-align:center;">ส่วนของนายจ้าง</td>--}}
        {{--<td></td>--}}
        {{--<td style="text-align:center;">ส่วนของลูกจ้าง</td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--<td style="text-align:center;">เงินสมทบ</td>--}}
        {{--<td style="text-align:center;">ผลประโยชน์เงินสมทบ</td>--}}
        {{--<td style="text-align:center;">เงินสะสม</td>--}}
        {{--<td style="text-align:center;">ผลประโยชน์เงินสะสม</td>--}}
        {{--<td></td>--}}

    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td style="text-align:center;">1</td>--}}
        {{--<td style="text-align:center;">2</td>--}}
        {{--<td style="text-align:center;">3</td>--}}
        {{--<td style="text-align:center;">4</td>--}}
        {{--<td style="text-align:center;">5</td>--}}
        {{--<td style="text-align:center;">6</td>--}}
        {{--<td style="text-align:center;">7</td>--}}
        {{--<td style="text-align:center;">8</td>--}}
        {{--<td style="text-align:center;">9</td>--}}
    {{--</tr>--}}





    {{--@foreach($netasset2 as $index =>$item)--}}
        {{--<tr>--}}
            {{--<td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>--}}
            {{--<td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>--}}
            {{--<td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>--}}
            {{--<td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>--}}
            {{--<td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>--}}
            {{--<td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>--}}
            {{--<td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>--}}
            {{--<td style="text-align: right;">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>--}}
            {{--<td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2+$item->MEMBER_CONTRIBUTION_3+$item->MEMBER_EARNING_4)}}</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}



{{--</table>--}}


</body>
<!-- END BODY -->
</html>



