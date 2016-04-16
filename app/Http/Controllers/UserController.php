<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class UserController extends Controller
{

    public function users()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 2,
            'title' => 'จัดการผู้ใช้'
        ]);

        $user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.users')->with([
            'user_group' => $user_group
        ]);
    }


    public  function  getUserAlllData($ArrParam,$IsCase){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $query =  "SELECT us.EMP_ID, emp.FULL_NAME , us.USERNAME, us.USER_STATUS_ID, st.STATUS_DESC,
			us.USER_PRIVILEGE_ID, pri.USER_PRIVILEGE_DESC,us.EMAIL, us.PHONE ,us.CREATE_DATE,us.LAST_MODIFY_DATE
			FROM TBL_USER us
			LEFT JOIN TBL_EMPLOYEE_INFO emp ON emp.EMP_ID = us.EMP_ID
			LEFT JOIN TBL_PRIVILEGE pri ON pri.USER_PRIVILEGE_ID = us.USER_PRIVILEGE_ID
			LEFT JOIN TBL_USER_STATUS st ON st.USER_STATUS_ID = us.USER_STATUS_ID";

        if($IsCase){
            $query .= $this->Getfilter($ArrParam);
        }

        $query .= " ORDER BY us.EMP_ID DESC";
        $query .= " OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";

        return DB::select(DB::raw($query));
    }

    public  function  getUserAlllCount($ArrParam,$IsCase){



        $allquery =  "SELECT COUNT(us.EMP_ID) AS total
			FROM TBL_USER us
			LEFT JOIN TBL_EMPLOYEE_INFO emp ON emp.EMP_ID = us.EMP_ID
			LEFT JOIN TBL_PRIVILEGE pri ON pri.USER_PRIVILEGE_ID = us.USER_PRIVILEGE_ID
			LEFT JOIN TBL_USER_STATUS st ON st.USER_STATUS_ID = us.USER_STATUS_ID";

        if($IsCase){
            $allquery .= $this->Getfilter($ArrParam);
        }


        $all = DB::select(DB::raw($allquery));
        return  $all[0]->total;
    }

    public  function  Getfilter($ArrParam){



        $filter1 =$ArrParam['filter1'];
        $filter2 =$ArrParam['filter2'];
        $datasearch =$ArrParam['datasearch'];
        $operator = $ArrParam['operator'];


        $where = " WHERE pri.USER_PRIVILEGE_ID IS NOT  NULL";

        if ($filter1 != "") {
            $where .= " AND pri.USER_PRIVILEGE_ID = '" . $filter1 . "'";
        }

        if ($filter2 != "" && $datasearch != ""){
            if($operator == 'LIKE'){
                $where .= " AND ".$datasearch." ".$operator." '%" . $filter2 . "%'";
            }else{
                $where .= " AND ".$datasearch." ".$operator." '" . $filter2 . "'";
            }

        }


        return $where;

    }

    public  function  Ajax_GetUser(Request $request){

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');

        $filter1 = $request->input('filter1');
        $filter2 = $request->input('filter2');
        $datasearch = $request->input('datasearch');
        $operator = $request->input('operator');

        $ArrParam["pagesize"] =$PageSize;
        $ArrParam["PageNumber"] =$PageNumber;
        $ArrParam["filter1"] =$filter1;
        $ArrParam["filter2"] =$filter2;
        $ArrParam["datasearch"] =$datasearch;
        $ArrParam["operator"] =$operator;

        $userAll = $this->getUserAlllData($ArrParam,true);

        $totals = $this->getUserAlllCount($ArrParam,true);

        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click_search',$PageNumber);

        $returnHTML = view('backend.pages.ajax.ajax_user')->with([
            'htmlPaginate'=> $htmlPaginate,
            'userAll'=>$userAll,
            'totals' => $totals,
            'PageSize' =>$PageSize,
            'PageNumber' =>$PageNumber

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function getAddUser()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 2,
            'title' => 'เพิ่มผู้ใช้'
        ] );
        $user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();
        $user_status = DB::table('TBL_USER_STATUS')->get();
        return view('backend.pages.add_user')->with([
            'user_group' => $user_group,
            'user_status' => $user_status
        ]);
    }

    public  function  postAddUser(Request $request){


                $user_id=$request->input('user_id');
                $user_name =$request->input('user_name');
                $password=$request->input('password');
                $chk_firstlogin=$request->input('chk_firstlogin');
                $chk_expire=$request->input('chk_expire');
                $email=$request->input('email');
                $phone=$request->input('phone');
                $address=$request->input('address');
                $retire=$request->input('retire');
                $comeback=$request->input('comeback');
                $expire=$request->input('expire');
                $group_id=$request->input('group_id');
                $status=$request->input('status');


                if($chk_expire == 1){
                    $expire = "9999-12-31 00:00:00.000";
                }



                if($chk_firstlogin == 1){

                }



        $allquery =  "SELECT COUNT(EMP_ID) AS total FROM TBL_USER WHERE EMP_ID =" .$user_id ;
        $all = DB::select(DB::raw($allquery));
        $total =$all[0]->total;
        $data ="";
        if($total > 0){
            $staturet  = false;
            $data = "user_id are used";
        }else{

//          $html = passthru("cmd /c md5.bat -e asdasd 2>&1");


            //$ecPass = MEAMD5($password);

            $date = new Date();

            $ecPass = exec("cmd /c md5.bat -e ".$password." 2>&1");

            $user_group =  DB::table('TBL_PRIVILEGE')->where('USER_PRIVILEGE_ID',$group_id)->get();

            $per = $user_group[0]->ACCESS_PERMISSIONS;


            $retire =

            $insert = "INSERT INTO TBL_USER (EMP_ID,EMP_ID,PASSWORD,PASSWORD_EXPIRE_DATE,USER_STATUS_ID,
USER_PRIVILEGE_ID,ACCESS_PERMISSIONS,FIRST_LOGIN_FLAG,LEAVE_FUND_GROUP_DATE
,RETURN_FUND_GROUP_DATE,EMAIL,PHONE,ADDRESS,CREATE_DATE,LAST_MODIFY_DATE

)VALUES('".$user_id."','".$user_name."','".$ecPass."','".$ecPass."','".$expire."','".$status."','".$group_id."','".$per."','".$chk_firstlogin."',".($retire== "" ? NULL: "'". $retire ."'" ).",".($comeback== "" ? NULL: "'". $retire . "'" ).",'".$email."','".$phone."','".$address."','".$date."','".$date."')";


        DB::insert(DB::raw($insert));



            $staturet= true;
            $data = "ok";
        }


        return response()->json(array('success' => $staturet, 'html'=>$data));
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
