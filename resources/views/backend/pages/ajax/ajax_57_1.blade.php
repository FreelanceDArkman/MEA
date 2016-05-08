
@if($data)
@foreach($data as $index =>$list  )
<div class="list" style="margin-bottom: 10px; padding: 10px">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="text-align: center">ลำดับที่</th>
            <th></th>

            <th style="text-align: center">มูลค่าต่อหน่วย (บาท)</th>
            <th style="text-align: center">มูลค่าทรัพย์สินสุทธิ (ล้านบาท)</th>
            <th style="text-align: center">อัตราผลตอบแทนการลงทุนสะสม (%)</th>
            <th style="text-align: center">ข้อมูล ณ วันที่</th>
            <th style="text-align: center">action</th>
        </tr>
        <tbody>
        <tr>

            <td rowspan="2" style="vertical-align: middle;text-align: center">{{($index+1)}}</td>
            <td><strong>นโยบายตราสารทุน</strong></td>
            <td><input type="text" class="form-control" id="NAV_UNIT_1_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_UNIT_1}}" /></td>
            <td><input type="text" class="form-control" id="NAV_1_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_1}}"/></td>
            @if($list->RETURN_RATE_1 < 0)
            <td><input type="text" class="form-control" id="RETURN_RATE_1_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #fff0f0;border-color: #A90329;" value="{{$list->RETURN_RATE_1}}"/></td>
            @else
                <td><input type="text" class="form-control" id="RETURN_RATE_1_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->RETURN_RATE_1}}"/></td>
            @endif
            <td rowspan="2" style="text-align: center">

                <?php
                $ret = "";
                    $retmonth= "";
                $retyear ="";
                    $today = new Date();
                    $years = date("Y", strtotime($today)) + 5;
                $days = 31;
                    $months = ['ม.ค.','ก.พ.','มี.ค.','เม.ษ.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
                for($i=1; $i<= $days; $i++){
                    if(date("d", strtotime($list->REFERENCE_DATE)) == $i){
                        $ret  = $ret . "<option selected=\"selected\" value=\"".$i."\">".$i."</option>";
                    }else{
                        $ret  = $ret . "<option value=\"".$i."\">".$i."</option>";
                    }

                }


                foreach($months as $index => $month){
                    if(date("m", strtotime($list->REFERENCE_DATE)) == ($index+1)){
                        $retmonth  = $retmonth . "<option selected=\"selected\" value=\"".($index+1)."\">".$month."</option>";
                    }else{
                        $retmonth  = $retmonth . "<option value=\"".($index+1)."\">".$month."</option>";
                    }

                }

                for($i= (date("Y", strtotime($today)) -2); $i<= $years; $i++){
                    if(date("Y", strtotime($list->REFERENCE_DATE)) == $i){
                        $retyear  = $retyear . "<option selected=\"selected\" value=\"".$i."\">".($i)."</option>";
                    }else{
                        $retyear  = $retyear . "<option value=\"".$i."\">".($i)."</option>";
                    }

                }


                ?>
                <select id="drop_day">


               {!! $ret !!}
                </select>

                <select id="drop_month">
                    {!! $retmonth !!}
                </select>

                    <select id="drop_year">
                        {!! $retyear !!}
                    </select>




            </td>
            <td rowspan="2" style="vertical-align: middle;text-align: center">
                <a href="#" class="btn btn-primary btn-xs btn_edit_list" data-date_ref="{{get_date_sql($list->REFERENCE_DATE)}}"  ><i class="fa fa-plus"></i>แก้ไข</a>
                <a href="javascript:void(0);" data-date_ref="{{get_date_sql($list->REFERENCE_DATE)}}"  class="btn_delete_list btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i>ลบ</a>

            </td>
        </tr>
        <tr>

            {{--background: #f0fff0;--}}
            {{--border-color: #7DC27D;--}}
            {{--background: #fff0f0;--}}
            {{--border-color: #A90329;--}}

            <td> <strong>นโยบายตราสารหนี้</strong></td>
            <td><input type="text" class="form-control" id="NAV_UNIT_2_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_UNIT_2}}" /></td>
            <td><input type="text" class="form-control" id="NAV_2_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->NAV_2}}"/></td>

            @if($list->RETURN_RATE_2 < 0)
                <td><input type="text" class="form-control" id="RETURN_RATE_2_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #fff0f0;border-color: #A90329;" value="{{$list->RETURN_RATE_2}}"/></td>
                @else
                <td><input type="text" class="form-control" id="RETURN_RATE_2_{{get_date_sql($list->REFERENCE_DATE)}}" style="text-align: right;background: #f0fff0;border-color: #7DC27D;" value="{{$list->RETURN_RATE_2}}"/></td>

            @endif


        </tr>
        </tbody>
        </thead>

    </table>
</div>
@endforeach

@else
    <div class="list" style="margin-bottom: 10px; padding: 10px">
        <p style="font-size: 20px;padding: 10px;text-align: center;width: 100%;background-color: #f1f1f1;border: 1px solid #E1E8F3">ไม่พบข้อมูล</p>
    </div>

@endif


