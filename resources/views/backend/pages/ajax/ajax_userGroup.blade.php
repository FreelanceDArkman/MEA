<table class="table table-striped table-bordered" width="100%">

    <thead>
    {{--<tr>--}}
        {{--<th style="width:5%;text-align: center">--}}

        {{--</th>--}}

        {{--<th style="width:10%;text-align: center">--}}

        {{--</th>--}}
        {{--<th class="hasinput" style="width:15%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter รหัสกลุ่มผู้ใช้" />--}}


        {{--</th>--}}
        {{--<th class="hasinput" style="width:70%">--}}
            {{--<input type="text" class="form-control" placeholder="Filter ชื่อกลุ่มผู้ใช้" />--}}
        {{--</th>--}}

    {{--</tr>--}}
    <tr>
        <th style="width:5%;text-align: center" id="index_th">
            <input type="checkbox" id="mainCheck" />
        </th>
        <th style="width:10%;text-align: center">Action</th>
        <th style="width:15%" data-class="expand">รหัสกลุ่มผู้ใช้</th>
        <th style="width:70%" data-hide="phone">ชื่อกลุ่มผู้ใช้</th>

    </tr>
    </thead>

    <tbody>
    @if($UserGroupData)
        @foreach($UserGroupData as $userGroup)

            <tr>
                <td style="text-align: center"><input type="checkbox"  name="check_item_edit[]" value="{{$userGroup->USER_PRIVILEGE_ID}}" class="item_checked" id="item_check_{{$userGroup->USER_PRIVILEGE_ID}}" />

                </td>
                <td style="text-align: center">
                    <a href="/admin/userGroup/edit/{{$userGroup->USER_PRIVILEGE_ID}}" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i></a>
                    <a href="javascript:void(0);"  data-id="{{$userGroup->USER_PRIVILEGE_ID}}" class="mea_delete_by btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i></a>

                </td>
                <td>{{$userGroup->USER_PRIVILEGE_ID}}</td>
                <td>{{$userGroup->USER_PRIVILEGE_DESC}}</td>

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