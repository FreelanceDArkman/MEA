<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package\Curl;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Input;

class UserManageController extends Controller
{

    public function getsimple()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 51,
            'menu_id' => 1,
            'title' => getMenuName($data,58,2) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.usersimple');
    }

    public  function  Checkdate(Request $request){

        $results = null;



        $result=   Excel::load($request->file('exelimport'))->toArray();
        $count = count($result);
//
//      Excel::load($request->file('exelimport'), function ($reader) use($count) {
//
//            $results = $reader->get();
//
//            $ret = $results->toArray();
//
//
//            $count = count($ret);
//
//
//        });

        return response()->json(array('success' => true, 'html'=>"ข้อมูลถูกต้อง มีจำนวนทั้งหมด " .$count ." record  กรุณากดปุ่ม นำเข้าข้อมูล ด้านล่างเพื่อ ดำเนินการ import"));



    }


    public function importdata(Request $request){



        $results = null;

        $type = $request->input('type');



        Excel::load($request->file('exelimport'), function ($reader) use($type) {

            $results = $reader->get();

            $ret = $results->toArray();

//            var_dump($ret);

            foreach($ret as $index => $value){

                $EMP_ID = $value["empid"];

                $userinfo = DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID', $EMP_ID)->get();

                $user = DB::table('TBL_USER')->where('EMP_ID', $EMP_ID)->get();

//                $StatusID = $value["user_status_id"];

            if($userinfo == null){


                $insert = "INSERT INTO TBL_EMPLOYEE_INFO (EMP_ID,PREFIX,FULL_NAME,ENG_NAME,FIRST_NAME,LAST_NAME,PRIORITY,JOB_ID,JOB_DESC_SHT,JOB_DESC,PER_ID,START_DATE,END_DATE,COST_CENTER,C_LEVEL,POST_ID,POS_DESC,ORG_ID,ENG_FIRST_NAME,ENG_LAST_NAME,
BIRTH_DATE,ORG_DESC,PATH_ID,DEP_ID,DIV_ID,SEC_ID,PART_ID,PARTH_SHT,DEP_SHT,DIV_SHT,SEC_SHT,PATH_SHT,PARTH_LNG,DEP_LNG,
DIV_LNG,SEC_LNG,PART_LNG) VALUES('".$EMP_ID."','".$value["prefix"]."','".$value["fullname"]."','".$value["engname"]."','".$value["firstname"]."','".$value["lastname"]."',".$value["priority"].",".$value["jobid"].",'".$value["jobdescsht"]."','".$value["jobdesc"]."','".$value["perid"]."','".$value["startdate"]."','".$value["enddate"]."','".$value["costcenter"]."',".$value["clevel"].",".$value["posid"].",'".$value["posdesc"]."',".$value["orgid"].",'".$value["engfirstname"]."','".$value["englastname"]."','".$value["birthdate"]."','".$value["orgdesc"]."',".$value["pathid"].",".$value["depid"].",".$value["divid"].",".$value["secid"].",".$value["partid"].",'".$value["pathsht"]."','".$value["depsht"]."','".$value["divsht"]."','".$value["secsht"]."','".$value["partsht"]."','".$value["pathlng"]."','".$value["deplng"]."','".$value["divlng"]."','".$value["seclng"]."','".$value["partlng"]."')";

                DB::insert(DB::raw($insert));
            }

            if($user == null){

                $date = new Date();

                $pri = $userinfo = DB::table('TBL_PRIVILEGE')->where('USER_PRIVILEGE_ID', 2)->get();

                 $datedata = $value["birthdate"];

                $rest = substr("abcdef", -1);    // returns "f"
                $rest = substr("abcdef", -2);    // returns "ef"
                $rest = substr("abcdef", -3, 1);

                $newDate = substr($datedata, -2) . substr($datedata, -3,2). ((int)substr($datedata, 1, 4)) + 543;

                $ecPass = exec("cmd /c md5.bat -e ".$newDate." 2>&1");

                $ecPass = explode(':',$ecPass)[1];

                $datedefault = new Date("9999-12-31 00:00:00.000") ;


                $insetuser = "INSERT INTO TBL_USER (EMP_ID,USERNAME,PASSWORD,PASSWORD_EXPIRE_DATE,CREATE_DATE
,CREATE_BY,LAST_MODIFY_DATE,USER_PRIVILEGE_ID,ACCESS_PERMISSIONS,USER_STATUS_ID,FIRST_LOGIN_FLAG,EMAIL_NOTIFY_FLAG)
VALUES('".$EMP_ID."','".$EMP_ID."','".$ecPass."','9999-12-31 00:00:00.000','".$date."','Administrator','".$date."'
,'2','".$pri[0]->ACCESS_PERMISSIONS."','13','0','1')";

                DB::insert(DB::raw($insetuser));
//
//                DB::table('TBL_USER')->insert(
//                    [
//                        'EMP_ID' => "'".$EMP_ID."'",
//                        'USERNAME' => "'".$EMP_ID."'",
//                        'PASSWORD' => "'".$ecPass."'",
//                        'PASSWORD_EXPIRE_DATE' =>"'".$datedefault."'",
//                        'CREATE_DATE' => "'".$date."'",
//                        'CREATE_BY' => 'Administrator',
//                        'LAST_MODIFY_DATE' => "'".$date."'",
//                        'USER_PRIVILEGE_ID' => '2',
//                        'ACCESS_PERMISSIONS' => "'".$pri[0]->ACCESS_PERMISSIONS."'",
//                        'USER_STATUS_ID' => '13',
//                        'FIRST_LOGIN_FLAG' => '0',
//                        'EMAIL_NOTIFY_FLAG' => '1'
//                    ]
//
//                );
             }



            }




            $staturet= true;
            $data = "ok";


        });





        return response()->json(array('success' => true, 'html'=>"hello"));
    }


    public function getUsers(Request $request)
    {

        Date::setLocale('th');
        $records = [];
        $records["data"] = [];
        $filters = [];

        if ($request->input('customActionType') && $request->input('customActionType') == "group_action" && $request->input('customActionName') == "delete") {
            if (count($request->input('id')) > 0) {
                $deleted = DB::table('TBL_PRIVILEGE')->whereIn('USER_PRIVILEGE_ID', $request->input('id'))->delete();
                if ($deleted) {
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = "ลบข้อมูลผู้ใช้เรียบร้อยแล้ว";
                } else {
                    $records["customActionStatus"] = "Errors";
                    $records["customActionMessage"] = "ไม่สามารถลบข้อมูลผู้ใช้ได้";
                }
            }
        }


        $query = DB::table('TBL_USER')
            ->select('TBL_USER.EMP_ID','TBL_EMPLOYEE_INFO.FULL_NAME','TBL_USER.USERNAME','TBL_USER.USER_STATUS_ID','TBL_USER_STATUS.STATUS_DESC','TBL_USER.USER_PRIVILEGE_ID','TBL_PRIVILEGE.USER_PRIVILEGE_DESC','TBL_USER.EMAIL','TBL_USER.PHONE','TBL_USER.CREATE_DATE','TBL_USER.LAST_MODIFY_DATE')
            ->leftJoin('TBL_EMPLOYEE_INFO','TBL_USER.EMP_ID', '=', 'TBL_EMPLOYEE_INFO.EMP_ID')
            ->leftJoin('TBL_PRIVILEGE','TBL_PRIVILEGE.USER_PRIVILEGE_ID', '=', 'TBL_USER.USER_PRIVILEGE_ID')
            ->leftJoin('TBL_USER_STATUS', 'TBL_USER_STATUS.USER_STATUS_ID', '=', 'TBL_USER.USER_STATUS_ID');


        if(!empty($request->input('user_id'))) {
            $filters = ['TBL_USER.EMP_ID',$request->input('user_id')];
        }

        if(!empty($request->input('full_name'))) {
            $filters = ['TBL_EMPLOYEE_INFO.FULL_NAME','like',$request->input('full_name').'%'];
        }

        if($request->input('user_group') != "") {
            $filters = ['TBL_USER.USER_PRIVILEGE_ID',$request->input('user_group')];
        }

        if(!empty($request->input('email'))) {
            $filters = ['TBL_USER.EMAIL','like',$request->input('email').'%'];
        }

        if(!empty($request->input('phone'))) {
            $filters = ['TBL_USER.PHONE','like',$request->input('phone').'%'];
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
            1 => 'TBL_USER.EMP_ID',
            2 => 'TBL_EMPLOYEE_INFO.FULL_NAME',
            3 => 'TBL_USER.USERNAME',
            4 => 'TBL_USER_STATUS.STATUS_DESC',
            5 => 'TBL_PRIVILEGE.USER_PRIVILEGE_DESC',
            6 => 'TBL_USER.EMAIL',
            7 => 'TBL_USER.PHONE',
            8 => 'TBL_USER.CREATE_DATE',
            9 => 'TBL_USER.LAST_MODIFY_DATE'
        ];
        if ($order) {
            $query->orderBy($orderColumns[$order[0]['column']], $order[0]['dir']);
        } else {
            $query->orderBy('TBL_USER.EMP_ID', 'desc');
        }
        $users = $query->skip($iDisplayStart)->take($limit)->get();
        if ($users) {
            foreach ($users as $user) {

                $create_date_str = '';
                if($user->CREATE_DATE)
                {
                    $create_date = new Date($user->CREATE_DATE);
                    $create_date_str = $create_date->add('543 years')->format('d M Y H:i:s');
                }
                $last_modify_date_str = '';
                if($user->LAST_MODIFY_DATE)
                {
                    $last_modify_date = new Date($user->LAST_MODIFY_DATE);
                    $last_modify_date_str = $last_modify_date->add('543 years')->format('d M Y H:i:s');
                }

                $records["data"][] = [
                    sprintf('<input type="checkbox" name="id[]" value="%1$s">', $user->EMP_ID),
                    $user->EMP_ID,
                    $user->FULL_NAME,
                    $user->USERNAME,
                    $user->STATUS_DESC,
                    $user->USER_PRIVILEGE_DESC,
                    $user->EMAIL,
                    $user->PHONE,
                    $create_date_str,
                    $last_modify_date_str,
                    sprintf('<a href="%1$s" target="_blank"  class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i>&nbsp;แก้ไข</a><a data-toggle="modal" href="#deleteUserGroup" data-group_name="%2$s" data-group_id="%3$s" class="btn btn-sm btn-outline red-thunderbird row-user-group-%4$s"><i class="fa fa-remove"></i>&nbsp;ลบ</a>',action('UserGroupController@getEditUserGroup',$user->EMP_ID),$user->EMP_ID,$user->EMP_ID,$user->EMP_ID)
                ];
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $total;
        $records["recordsFiltered"] = $total;
        return response()->json($records);
    }
}
