<?php
ini_set('max_execution_time', 600);
//?>
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
{{--<div>Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>--}}
<table class="table table-bordered">
    @if($data)

    <thead>
    <tr>
        <td style="text-align:center;">{{$topic}}</td>
    </tr>
    <tr>
        <td></td>
    </tr>

    <tr>
        <td style="text-align:center;">รายงานข้อมูล ณ วันที่ {{ get_date_notime(date("Y-m-d H:i:s"))  }}</td>

    </tr>
    <tr>
        <th>รหัสพนักงาน</th>
        <th>ชื่อ-นามสกุล</th>
        <th>หน่วยงาน</th>
        <th>อัตราสะสม(เดิม)</th>
        <th>อัตราสะสม(ใหม่)</th>
        <th>วันที่ทำรายการ</th>
        <th>วันที่มีผล</th>
        <th>ผู้ทำรายการ</th>
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
                <td>{{$d->rate_old}}</td>
                <td>{{$d->rate_new}}</td>
                <td>{{get_date_notime($d->modify_new)}}</td>
                <td>{{get_date_notime($d->effec_new)}}</td>
                <td>{{$d->new_modify_by}}</td>



    </tr>
    @endforeach
    </tbody>


    @else
        <tbody>
            <tr>
                <td >ไม่พบรายการ</td>
            </tr>
        </tbody>
    @endif
</table>

</body>
</html>