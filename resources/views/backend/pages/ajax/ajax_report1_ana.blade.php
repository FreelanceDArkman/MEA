

<table class="table table-bordered">
    @if($arrRet)

    <thead>
    <tr>
        <th>สัดส่วนตราสารทุน (%)</th>
        <th>จำนวน (คน)</th>

    </tr>
    </thead>
    <tbody>
    <?php $count = 0; ?>
    @foreach($arrRet as $index => $list)

            @if($arrRet[$index] > 0)
                @if(($count%2)==0)
                    <tr>
                @else
                    <tr class="odd">
                    @endif

                <td>{{$index}}</td>
                <td>{{$arrRet[$index]}}</td>



         <?php $count = $count + 1; ?>
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

