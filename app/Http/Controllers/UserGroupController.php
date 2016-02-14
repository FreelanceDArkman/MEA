<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;

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


        if ($request->input('customActionType') && $request->input('customActionType') == "group_action" && $request->input('customActionName') == "delete") {
            if (count($request->input('id')) > 0) {
                $deleted = DB::table('TBL_PRIVILEGE')->whereIn('USER_PRIVILEGE_ID', $request->input('id'))->delete();
                if ($deleted) {
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = "ลบข้อมูลกลุ่มผู้ใช้เรียบร้อยแล้ว";
                } else {
                    $records["customActionStatus"] = "Errors";
                    $records["customActionMessage"] = "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้";
                }
            }
        }


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
                    sprintf('<a href="%1$s" target="_blank"  class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i>&nbsp;แก้ไข</a><a data-toggle="modal" href="#deleteUserGroup" data-group_name="%2$s" data-group_id="%3$s" class="btn btn-sm btn-outline red-thunderbird row-user-group-%4$s"><i class="fa fa-remove"></i>&nbsp;ลบ</a>',action('UserGroupController@getEditUserGroup',$group->USER_PRIVILEGE_ID),$group->USER_PRIVILEGE_DESC,$group->USER_PRIVILEGE_ID,$group->USER_PRIVILEGE_ID)
                ];
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $total;
        $records["recordsFiltered"] = $total;
        return response()->json($records);
    }

    public function deleteUserGroup(Request $request)
    {
        if($request->ajax())
        {
            $user_group_exist = UserGroup::UserGroupExist($request->input('group_id'))->first();
            if(!$user_group_exist) return response()->json(["errors" => "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้"]);
            $deleted = DB::table('TBL_PRIVILEGE')->where('USER_PRIVILEGE_ID', $request->input('group_id'))->delete();
            if($deleted) return response()->json(["success" => "ลบข้อมูลกลุ่มผู้ใช้เรียบร้อยแล้ว"]);
            else return response()->json(["errors" => "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้"]);
        }
        return response()->json(["errors" => "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้"]);
    }



    public function getAddUserGroup()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 1,
            'title' => 'เพิ่มกลุ่มผู้ใช้ | จัดการผู้ใช้'
        ] );
        $arr = $this->getMenuList();
        return view('backend.pages.add_user_group')->with([
            'menu_frontend_list' => $arr['frontend'],
            'menu_backend_list' => $arr['backend']
        ]);
    }

    public function getMenuList($menu_access = '')
    {
        $menu = DB::select(DB::raw("SELECT a.MENU_GROUP_ID, a.MENU_GROUP_NAME,a.MENU_FLAG AS MENU_GROUP_FLAG ,b.MENU_ID,b.MENU_NAME,b.MENU_FLAG FROM TBL_MENU_GROUP a LEFT JOIN TBL_MENU_LIST b ON a.MENU_GROUP_ID = b.MENU_GROUP_ID"));
        if($menu_access) {
            $menu_access = explode('|',$menu_access);
        }

        $arr = [];
        $type = "frontend";
        if($menu)
        {
            foreach($menu as $key => $value)
            {
                if((int)$value->MENU_GROUP_ID > 49) {
                    $type = "backend";
                }

                $arr[$type][$value->MENU_GROUP_ID]['MENU_GROUP_ID'] = $value->MENU_GROUP_ID;
                $arr[$type][$value->MENU_GROUP_ID]['MENU_GROUP_NAME'] = $value->MENU_GROUP_NAME;
                $arr[$type][$value->MENU_GROUP_ID]['MENU_GROUP_FLAG'] = $value->MENU_GROUP_FLAG;
                $arr[$type][$value->MENU_GROUP_ID]['MENU_GROUP_NAME'] = $value->MENU_GROUP_NAME;
                $arr[$type][$value->MENU_GROUP_ID]['item'][$key] = [
                    'MENU_ID'   => $value->MENU_ID,
                    'MENU_FLAG' => $value->MENU_FLAG,
                    'MENU_NAME' => $value->MENU_NAME
                ];
                if($menu_access && is_array($menu_access))
                {
                    if(in_array($value->MENU_GROUP_ID.":".$value->MENU_ID,$menu_access)) {
                        $arr[$type][$value->MENU_GROUP_ID]['item'][$key]['MENU_SELECTED'] = 1;
                    } else {
                        $arr[$type][$value->MENU_GROUP_ID]['item'][$key]['MENU_SELECTED'] = 0;
                    }
                }
            }
        }
        return $arr;
    }

    public function UserGroupIdExist(Request $request)
    {
        $return_data = true;
        if($request->ajax()) {
            $user_group_exist = UserGroup::UserGroupExist($request->input('USER_PRIVILEGE_ID'))->first();
            if($user_group_exist)
                $return_data = false;
        }

        return response()->json($return_data);
    }

    public function postAddUserGroup(Request $request)
    {
        $messages = [
            'USER_PRIVILEGE_ID.required'    => 'กรุณาระบุรหัสกลุ่มผู้ใช้',
            'USER_PRIVILEGE_ID.unique'      => 'มีรหัสกลุ่มผู้ใช้นี้ในระบบแล้ว',
            'USER_PRIVILEGE_ID.numeric'     => 'กรุณาระบุรหัสกลุ่มผู้ใช้ เป็นรูปแบบตัวเลขเท่านั้น',
            'user_group_name.required'      => 'กรุณาระบุชื่อรหัสกลุ่มผู้ใช้',
            'menuSelected.required'         => 'กรุณากําหนดสิทธิ์ในการเข้าถึงเมนูของกลุ่มผู้ใช้'
        ];

        $rules = [
            'USER_PRIVILEGE_ID'     => 'required|numeric|unique:TBL_PRIVILEGE',
            'user_group_name'       => 'required',
            'menuSelected'          => 'required'
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if($validator->fails()) {
            return redirect()->action('UserGroupController@getAddUserGroup')->withErrors($validator)->withInput();
        } else {
            $access_permissions = implode('|',json_decode($request->input('menuSelected')));
            $insert = DB::table('TBL_PRIVILEGE')->insert([
                'USER_PRIVILEGE_ID' => $request->input('USER_PRIVILEGE_ID'),
                'USER_PRIVILEGE_DESC' => $request->input('user_group_name'),
                'ACCESS_PERMISSIONS' => $access_permissions
            ]);

            if($insert) {
                return redirect()->action('UserGroupController@getEditUserGroup',$request->input('USER_PRIVILEGE_ID'))->with('submit_success', 'เพิ่มข้อมูลกลุ่มผู้ใช้เรียบร้อยแล้ว');
            } else {
                return redirect()->action('UserGroupController@getAddUserGroup')->with('submit_errors', 'ไม่สามารถเพิ่มข้อมูลกลุ่มผู้ใช้ได้');
            }
        }
    }

    public function getEditUserGroup($id)
    {
        $this->pageSetting([
            'menu_group_id' => 50,
            'menu_id' => 1,
            'title' => 'แก้ไขข้อมูลกลุ่มผู้ใช้ | จัดการผู้ใช้'
        ]);

        //if(isset($id)) abort(404);

        $user_group_data = UserGroup::where('USER_PRIVILEGE_ID', $id)->first();
        $arr = $this->getMenuList($user_group_data->ACCESS_PERMISSIONS);
        return view('backend.pages.edit_user_group')->with([
            'menu_frontend_list'    => $arr['frontend'],
            'menu_backend_list'     => $arr['backend'],
            'user_group'            => $user_group_data
        ]);
    }

    public function postEditUserGroup(Request $request)
    {
        $messages = [
            'USER_PRIVILEGE_ID.required'    => 'กรุณาระบุรหัสกลุ่มผู้ใช้',
            'USER_PRIVILEGE_ID.numeric'     => 'กรุณาระบุรหัสกลุ่มผู้ใช้ เป็นรูปแบบตัวเลขเท่านั้น',
            'user_group_name.required'      => 'กรุณาระบุชื่อรหัสกลุ่มผู้ใช้',
            'menuSelected.required'         => 'กรุณากําหนดสิทธิ์ในการเข้าถึงเมนูของกลุ่มผู้ใช้'
        ];

        $rules = [
            'USER_PRIVILEGE_ID'     => 'required|numeric',
            'user_group_name'       => 'required',
            'menuSelected'          => 'required'
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if($validator->fails()) {
            return redirect()->action('UserGroupController@getEditUserGroup')->withErrors($validator);
        } else {
            $access_permissions = implode('|',json_decode($request->input('menuSelected')));
            $updated = DB::table('TBL_PRIVILEGE')
                            ->where('USER_PRIVILEGE_ID',$request->input('USER_PRIVILEGE_ID'))
                            ->update([
                                'USER_PRIVILEGE_DESC' => $request->input('user_group_name'),
                                'ACCESS_PERMISSIONS' => $access_permissions
                            ]);

            if($updated) {
                return redirect()->action('UserGroupController@getEditUserGroup',$request->input('USER_PRIVILEGE_ID'))->with('submit_success', 'แก้ไขข้อมูลกลุ่มผู้ใช้เรียบร้อยแล้ว');
            } else {
                return redirect()->action('UserGroupController@getEditUserGroup')->with('submit_errors', 'ไม่สามารถแก้ไขข้อมูลกลุ่มผู้ใช้ได้');
            }
        }
    }


}
