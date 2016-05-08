
@if($data)

    <table class="table table-bordered table-striped">
        <thead >
        <tr>
            <th style="width: 5%">รหัส</th>
            <th style="width: 25%">ชื่อหน่วยงาน</th>
            <th style="width: 35%">Path</th>
            <th style="width: 35%">Url</th>
            <th style="width: 5%">Action</th>
        </tr>
        </thead>
        <tbody>
@foreach($data as $index =>$list  )

    <tr>
        <td> {{$list->ID}} </td>
        <td><input type="text" id="NAME_{{$list->ID}}" value="{{$list->NAME}}" class="form-control"></td>
        <td><input type="text" id="FILE_PATH_{{$list->ID}}" value="{{$list->FILE_PATH}}" class="form-control"></td>
        <td><input type="text" id="URL_{{$list->ID}}" value="{{$list->URL}}" class="form-control"></td>
        <td>
            <a href="#" class="btn btn-primary btn-xs btn_edit_list" data-id="{{$list->ID}}"  ><i class="fa fa-plus"></i>แก้ไข</a>
            <a href="javascript:void(0);"  data-id="{{$list->ID}}" class="btn_delete_list btn bg-color-red txt-color-white btn-xs"> <i class="glyphicon glyphicon-trash"></i>ลบ</a>
        </td>
    </tr>


@endforeach
        </tbody>
    </table>
@else
    <div class="list" style="margin-bottom: 10px; padding: 10px">
        <p style="font-size: 20px;padding: 10px;text-align: center;width: 100%;background-color: #f1f1f1;border: 1px solid #E1E8F3">ไม่พบข้อมูล</p>
    </div>

@endif


