<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>
<table class="table table-bordered table-striped">
    <thead>
    <tr >
        <th rowspan="3" width="100" style="text-align:center;">งวด</th>
        <th rowspan="3" width="100" style="text-align:center;">เงินเดือน</th>
        <th rowspan="3" width="100" style="text-align:center;">อายุ (ปี/วัน)</th>
        <th rowspan="3" width="100" style="text-align:center;">อายุงาน (ปี/วัน)</th>
        <th colspan="4" style="text-align:center;">เงินกองทุนสำรองเลี้ยงชีพฯ (บาท)</th>
        <th width="100" rowspan="3" style="text-align:center;">รวม</th>
    </tr>
    <tr >
        <th colspan="2" style="text-align:center;">ส่วนของนายจ้าง</th>
        <th colspan="2" style="text-align:center;">ส่วนของลูกจ้าง</th>


    </tr>

    <tr >
        <th style="text-align:center;">เงินสมทบ</th>
        <th style="text-align:center;">ผลประโยชน์เงินสมทบ</th>

        <th style="text-align:center;">เงินสะสม</th>
        <th style="text-align:center;">ผลประโยชน์เงินสะสม</th>
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
    </tr>
    </thead>


    <tbody>

    @foreach($netasset2 as $index =>$item)
        <tr>
            <td style="text-align: center;">{{ get_date_nodate($item->RECORD_DATE)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->SALARY)}}</td>
            <td style="text-align: center;">{{ $item->AGE_YEAR .'/'. $item->AGE_DAY }}</td>
            <td style="text-align: center;">{{ $item->JOB_YEAR .'/'. $item->JOB_DAY }}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_EARNING_2)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_CONTRIBUTION_3)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->MEMBER_EARNING_4)}}</td>
            <td style="text-align: right;">{{meaNumbermoney($item->EMPLOYER_CONTRIBUTION_1 + $item->EMPLOYER_EARNING_2+$item->MEMBER_CONTRIBUTION_3+$item->MEMBER_EARNING_4)}}</td>
        </tr>
    @endforeach
    </tbody>


</table>


</body>
<!-- END BODY -->
</html>



