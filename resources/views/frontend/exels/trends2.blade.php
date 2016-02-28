<!DOCTYPE html>

<html>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{--<link rel="stylesheet" href="{{asset('frontend/assets/plugins/bootstrap/css/bootstrap.min.css')}}">--}}
    {{--<script type="text/javascript" src="{{asset('frontend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>--}}

    <style>


    </style>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>



<table class="table table-bordered table-striped">

    <tr >
        <td   style="text-align:center;">งวด</td>
        <td  style="text-align:center;">เงินเดือน</td>
        <td  style="text-align:center;">อายุ <br>(ปี/วัน)</td>
        <td   style="text-align:center;">อายุงาน<br> (ปี/วัน)</td>
        <td  style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td  style="text-align:center;">เงินบำเหน็จ (บาท)</td>
        <td></td>
        <td></td>
        <td  style="text-align:center;">เปรียบเทียบกองทุนสำรองเลี้ยงชีพฯ กับเงินบำเหน็จ(บาท)</td>
        <td></td>
        <td></td>
    </tr>
    <tr >
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td  style="text-align:center;">ส่วนของนายจ้าง</td>
        <td></td>
        <td></td>
        <td  style="text-align:center;">ส่วนของลูกจ้าง</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr >
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align:center;">เงินสมทบ</td>
        <td style="text-align:center;">ผลประโยชน์เงินสมทบ</td>
        <td style="text-align:center;">รวม</td>

        <td style="text-align:center;">เงินสะสม</td>
        <td style="text-align:center;">ผลประโยชน์เงินสะสม</td>
        <td style="text-align:center;">รวม</td>

        <td style="text-align:center;">เงินบำเหน็จก่อนหักภาษี</td>
        <td style="text-align:center;">ภาษี</td>
        <td style="text-align:center;">เงินบำเหน็จสุทธิหลังหักภาษี</td>


        <td style="text-align:center;">ผลรวมส่วนของนายจ้าง </td>
        <td style="text-align:center;">เงินสุทธิหลังหักภาษี</td>
        <td style="text-align:center;">ส่วนต่าง </td>


    </tr>
    <tr >
        <td style="text-align:center;">1</td>
        <td style="text-align:center;">2</td>
        <td style="text-align:center;">3</td>
        <td style="text-align:center;">4</td>
        <td style="text-align:center;">5</td>
        <td style="text-align:center;">6</td>
        <td style="text-align:center;">7</td>
        <td style="text-align:center;">8</td>
        <td style="text-align:center;">9</td>
        <td style="text-align:center;">10</td>
        <td style="text-align:center;">11</td>
        <td style="text-align:center;">12</td>
        <td style="text-align:center;">13</td>
        <td style="text-align:center;">14</td>
        <td style="text-align:center;">15</td>
        <td style="text-align:center;">16</td>
    </tr>






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



