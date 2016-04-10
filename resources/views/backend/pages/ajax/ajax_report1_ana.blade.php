

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

