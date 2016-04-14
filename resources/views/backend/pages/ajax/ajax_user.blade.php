
<div class="page_total">Showing {{$PageNumber}} to {{ (($PageSize * $PageNumber) > $totals? $totals:($PageSize * $PageNumber))  }} of {{ $totals }}</div>
<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">

    <thead>
    {{--<tr>--}}
        {{--<th style="width:3%;text-align: center">--}}

        {{--</th>--}}

        {{--<th style="width:11%;text-align: center">--}}

        {{--</th>--}}
        {{--<th class="hasinput" style="width:7%">--}}



        {{--</th>--}}
        {{--<th class="hasinput" style="width:15%">--}}

        {{--</th>--}}
        {{--<th class="hasinput" style="width:10%">--}}

        {{--</th>--}}
        {{--<th class="hasinput" style="width:10%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter สถานะ" />--}}
        {{--</th>--}}
        {{--<th class="hasinput" style="width:10%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter กลุ่มผู้ใช้" />--}}
        {{--</th>--}}
        {{--<th class="hasinput" style="width:8%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter อีเมล์" />--}}
        {{--</th>--}}
        {{--<th class="hasinput" style="width:6%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter โทรศัพท์" />--}}
        {{--</th>--}}
        {{--<th class="hasinput" style="width:10%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter วันที่สร้าง" />--}}
        {{--</th>--}}
        {{--<th class="hasinput" style="width:10%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter วันที่แก้ไขล่าสุด" />--}}
        {{--</th>--}}

    {{--</tr>--}}
    <tr>
        <th style="width:3%;text-align: center" id="index_th" class="sorting_disabled">
            <input type="checkbox" id="mainCheck" />
        </th>
        <th style="text-align: center;width:10%">Action</th>
        <th style="width:7%">รหัสพนักงาน</th>
        <th style="width:19%" data-class="expand">ชื่อ-สกุล</th>
        <th style="width:7%" data-hide="phone">ชื่อผู้ใช้</th>
        <th style="width:10%" data-hide="phone">สถานะ</th>
        <th style="width:5%" data-hide="phone">กลุ่มผู้ใช้</th>
        <th style="width:10%" data-hide="phone">อีเมล์</th>
        <th style="width:9%" data-hide="phone">โทรศัพท์</th>
        <th style="width:10%" data-hide="phone">วันที่สร้าง</th>
        <th style="width:10%" data-hide="phone">วันที่แก้ไขล่าสุด</th>
    </tr>
    </thead>

    <tbody>
    @if($userAll)
        @foreach($userAll as $userGroup)

            <tr>
                <td><input type="checkbox"  name="check_item_edit[]" value="{{$userGroup->EMP_ID}}" class="item_checked" id="item_check_{{$userGroup->EMP_ID}}" />

                </td>
                <td style="text-align: center">
                    <a href="/admin/userGroup/edit/{{$userGroup->EMP_ID}}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                    <a href="javascript:void(0);"  data-id="{{$userGroup->EMP_ID}}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>
                    <a href="javascript:void(0);"  data-id="{{$userGroup->EMP_ID}}" class="mea_delete_by btn txt-color-white bg-color-blueDark btn-xs"><i class="glyphicon glyphicon-repeat"></i></a></td>
                </td>
                <td>{{$userGroup->EMP_ID}}</td>
                <td>{{$userGroup->FULL_NAME}}</td>
                <td>{{$userGroup->USERNAME}}
                <td>{{$userGroup->STATUS_DESC}}</td>
                <td>{{$userGroup->USER_PRIVILEGE_DESC}}</td>
                <td>{{$userGroup->EMAIL}}</td>
                <td>{{$userGroup->PHONE}}</td>
                <td>{{get_date_notime($userGroup->CREATE_DATE)}}</td>
                <td>{{get_date_notime($userGroup->LAST_MODIFY_DATE)}}</td>
            </tr>


        @endforeach

    @endif

    </tbody>
    <tfoot>
    <tr>
        <td colspan="13">
            {!! $htmlPaginate !!}
        </td>
    </tr>
    </tfoot>
</table>