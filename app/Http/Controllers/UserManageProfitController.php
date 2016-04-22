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
use Illuminate\Http\UploadedFile;

class UserManageFundController extends Controller
{

    public function getsimple()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 51,
            'menu_id' => 3,
            'title' => getMenuName($data,51,3) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.userfund');
    }

    public  function  Checkdate(Request $request){

        $results = null;

        $result=   Excel::load($request->file('exelimport'))->get();
        $count = $result->count();
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

        return response()->json(array('success' => true, 'html'=>$count));



    }


    public function importdata(Request $request){



        $results = null;


//        $results = $reader->get();
//
//        $ret = $results->toArray();

        $file = $request->file('exelimport');


        $request->file('exelimport')->move(storage_path().'/public/import/' , 'import.xlsx');

        //$request->file('exelimport')

//        $results =    Excel::load($request->file('exelimport'))->toArray();

        $ret = Excel::filter('chunk')->load(storage_path('/public/import/import.xlsx'))->chunk(250, function($results){

            $data = array();

//            $results = $reader->toArray();
            foreach($results as $index => $value) {
                $EMP_ID = $value["emp_id"];
                $PERIOD = $value["period"];
//                $user = DB::table('TBL_MEMBER_BENEFITS')->where('EMP_ID', $EMP_ID)->where('PERIOD', $PERIOD)->count();
                $allquery = "SELECT COUNT(EMP_ID) AS total FROM TBL_MEMBER_BENEFITS  WHERE EMP_ID= '".$EMP_ID."' AND (PERIOD='".$PERIOD."' OR PERIOD IS NULL)";

                $all = DB::select(DB::raw($allquery));
               $total =  $all[0]->total;

//                array_push($data,'asd','asda');

                if ($total == 0) {
                        array_push($data,array(
                            'EMP_ID' => $value["emp_id"],
                            'FULL_NAME' =>$value["full_name"],
                            'PATH_CODE' => $value["path_code"],
                            'DEP_CODE' => $value["dep_code"],
                            'DIV_CODE' => $value["div_code"],
                            'SEC_CODE' => $value["sec_code"],
                            'HIRE_DATE' =>$value["hire_date"],
                            'END_DATE' => $value["end_date"],
                            'POSITION_CODE' => $value["position_code"],
                            'POSITION_NAME' => $value["position_name"],
                            'JOB_LINE' => $value["job_line"],
                            'LEVEL_CODE' => $value["level_code"],
                            'EXE_NAME' => $value["exe_name"],
                            'EXE1_NAME' => $value["exe1_name"],
                            'AGE_YEAR' => $value["age_year"],
                            'AGE_DAY' => $value["age_day"],
                            'JOB_YEAR' => $value["job_year"],
                            'JOB_DAY' => $value["job_day"],
                            'EMPLOYER_CONTRIBUTION_1' => $value["employer_contribution_1"],
                            'EMPLOYER_EARNING_2' => $value["employer_earning_2"],
                            'MEMBER_CONTRIBUTION_3' => $value["member_contribution_3"],
                            'MEMBER_EARNING_4' => $value["member_earning_4"],
                            'TAX_1' => $value["tax_1"],
                            'TAX_12' => $value["tax_12"],
                            'TAX_124' => $value["tax_124"],
                            'TAX_1234' => $value["tax_1234"],
                            'GRATUITY' => $value["gratuity"],
                            'GRATUITY_TAX' => $value["gratuity_tax"],

                            'RECORD_DATE' => $value["record_date"]

                        ));


                }

            }

//            var_dump($data);
            DB::table('TBL_MEMBER_BENEFITS')->insert($data);
            //DB::insert(DB::raw($insert));
        });



        return response()->json(array('success' => true, 'html'=>$ret));
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
