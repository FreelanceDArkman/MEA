<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
class UserGroupController extends Controller
{
    //

    public function userGroups()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 1,
            'title' => 'จัดการกลุ่มผู้ใช้ | จัดการผู้ใช้'
        ] );

        return view('backend.pages.user_group');
    }

    public function getUserGroups(Request $request)
    {
        $records = [];
        $records["data"] = [];
        $filters = [];

        $query = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC');


        if(!empty($request->input('user_group_id'))) {
            $filters = ['USER_PRIVILEGE_ID',$request->input('user_group_id')];
        }

        if(!empty($request->input('user_group_name'))) {
            $filters = ['USER_PRIVILEGE_DESC','like',$request->input('user_group_name').'%'];
        }

        if($filters)
            $query->where([$filters]);

        $total = $query->count();
        $limit = intval($request->input('length'));
        $limit = $limit < 0 ? $limit : $limit;
        $iDisplayStart = intval($request->input('start'));
        $sEcho = intval($request->input('draw'));

        $order = $request->input('order');
        $orderColumns = [
            1 => 'USER_PRIVILEGE_ID',
            2 => 'USER_PRIVILEGE_DESC'
        ];
        if ($order) {
            $query->orderBy($orderColumns[$order[0]['column']], $order[0]['dir']);
        } else {
            $query->orderBy('USER_PRIVILEGE_ID', 'desc');
        }

        $user_groups = $query->skip($iDisplayStart)->take($limit)->get();

        if ($user_groups) {
            foreach ($user_groups as $group) {
                $records["data"][] = [
                    sprintf('<input type="checkbox" name="id[]" value="%1$s">', $group->USER_PRIVILEGE_ID),
                    $group->USER_PRIVILEGE_ID,
                    $group->USER_PRIVILEGE_DESC,
                    sprintf('<a href="javascript:;" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i>&nbsp;แก้ไข</a><a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird"><i class="fa fa-remove"></i>&nbsp;ลบ</a>')
                ];
            }
        }
        if ($request->input('customActionType') && $request->input('customActionType') == "group_action" && $request->input('customActionName') != "-1") {
            if (count($request->input('id')) > 0) {
                $update_result = DB::table('orders')->whereIn('order_id', $request->input('id'))->update(['order_status' => $request->input('customActionName')]);
                if ($update_result) {
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = "Update orders status successfully has been completed. Well done!";
                } else {
                    $records["customActionStatus"] = "Errors";
                    $records["customActionMessage"] = "Cannot update orders status. Please try again!";
                }
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $total;
        $records["recordsFiltered"] = $total;
        return response()->json($records);
    }


    public function getAddUserGroup()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 1,
            'title' => 'เพิ่มกลุ่มผู้ใช้ | จัดการผู้ใช้'
        ] );
        return view('backend.pages.add_user_group');
    }

}
