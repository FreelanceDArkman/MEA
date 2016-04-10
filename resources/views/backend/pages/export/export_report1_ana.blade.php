
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
    @if($arrRet)

        <thead>
        <tr>
            <th>สัดส่วนตราสารทุน (%)</th>
            <th>จำนวน (คน)</th>

        </tr>
        </thead>
        <tbody>
        @foreach($arrRet as $index => $list)

            @if($arrRet[$index] > 0)
                @if(($index%2)==0)
                    <tr>
                @else
                    <tr class="odd">
                        @endif

                        <td>{{$index}}</td>
                        <td>{{$arrRet[$index]}}</td>




                    </tr>

                @endif
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