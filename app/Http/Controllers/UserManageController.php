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
            'title' => getMenuName($data,51,1) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.usersimple');
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

        return response()->json(array('success' => true, 'html'=> $count));



    }


    public function importdata(Request $request){



        $results = null;


        $file = $request->file('exelimport');



        $request->file('exelimport')->move(storage_path().'/public/import/' , 'import.xlsx');

        $retdate = Excel::load(storage_path('/public/import/import.xlsx'), function ($reader)  {
            $results =$reader->setDateColumns(array(
                'startdate',
                'enddate'
            ))->get();
            $data = array();
            $dataupdate = array();
            $datauser = array();
//            $results = $reader->get();  
            $ret = $results->toArray();
            foreach($ret as $index => $value){

//                var_dump($value["enddate"]);

                $EMP_ID = $value["empid"];

                $userinfo = DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID', $EMP_ID)->get();

                $user = DB::table('TBL_USER')->where('EMP_ID', $EMP_ID)->get();

//                $StatusID = $value["user_status_id"];

                if($userinfo == null) {

//                    var_dump($value["enddate"]);

                    $dateS = new Date($value["startdate"]);

                    $dateStart = date("d/m/Y", strtotime($dateS));

                    $dateE = new Date($value["enddate"]);
                    $dateEnd = date("d/m/Y", strtotime($dateE));

                    array_push($data, array(
                        'EMP_ID' => $value["empid"],
                        'PREFIX' => $value["prefix"],
                        'FULL_NAME' => $value["fullname"],
                        'ENG_NAME' =>$value["engname"],
                        'FIRST_NAME' => $value["firstname"],
                        'LAST_NAME' => $value["lastname"],
                        'PRIORITY' => $value["priority"],
                        'JOB_ID' => $value["jobid"],
                        'JOB_DESC_SHT' => $value["jobdescsht"],
                        'JOB_DESC' => $value["jobdesc"],
                        'PER_ID' => $value["perid"],
                        'START_DATE' => $dateStart,
                        'END_DATE' => $dateEnd,
                        'COST_CENTER' => $value["costcenter"],
                        'C_LEVEL' => $value["clevel"],
                        'POST_ID' => $value["posid"],
                        'POS_DESC' => $value["posdesc"],
                        'ORG_ID' => $value["orgid"],
                        'ENG_FIRST_NAME' => $value["engfirstname"],
                        'ENG_LAST_NAME' => $value["englastname"],
                        'BIRTH_DATE' => $value["birthdate"],
                        'ORG_DESC' => $value["orgdesc"],
                        'PATH_ID' => $value["pathid"],
                        'DEP_ID' => $value["depid"],
                        'DIV_ID' => $value["divid"],
                        'SEC_ID' => $value["secid"],
                        'PART_ID' => $value["partid"],
                        'PARTH_SHT' => $value["pathsht"],
                        'DEP_SHT' => $value["depsht"],
                        'DIV_SHT' => $value["divsht"],
                        'SEC_SHT' => $value["secsht"],
                        'PATH_SHT' => $value["partsht"],
                        'PARTH_LNG' => $value["pathlng"],
                        'DEP_LNG' => $value["deplng"],
                        'DIV_LNG' => $value["divlng"],
                        'SEC_LNG' => $value["seclng"],
                        'PART_LNG' => $value["partlng"],


                    ));
                }else{

                    $dateS = new Date($value["startdate"]);

                    $dateStart = date("d/m/Y", strtotime($dateS));

                    $dateE = new Date($value["enddate"]);
                    $dateEnd = date("d/m/Y", strtotime($dateE));
                    $dataupdate = array(
                        'EMP_ID' => $value["empid"],
                        'PREFIX' => $value["prefix"],
                        'FULL_NAME' => $value["fullname"],
                        'ENG_NAME' =>$value["engname"],
                        'FIRST_NAME' => $value["firstname"],
                        'LAST_NAME' => $value["lastname"],
                        'PRIORITY' => $value["priority"],
                        'JOB_ID' => $value["jobid"],
                        'JOB_DESC_SHT' => $value["jobdescsht"],
                        'JOB_DESC' => $value["jobdesc"],
                        'PER_ID' => $value["perid"],
                        'START_DATE' => $dateStart,
                        'END_DATE' => $dateEnd,
                        'COST_CENTER' => $value["costcenter"],
                        'C_LEVEL' => $value["clevel"],
                        'POST_ID' => $value["posid"],
                        'POS_DESC' => $value["posdesc"],
                        'ORG_ID' => $value["orgid"],
                        'ENG_FIRST_NAME' => $value["engfirstname"],
                        'ENG_LAST_NAME' => $value["englastname"],
                        'BIRTH_DATE' => $value["birthdate"],
                        'ORG_DESC' => $value["orgdesc"],
                        'PATH_ID' => $value["pathid"],
                        'DEP_ID' => $value["depid"],
                        'DIV_ID' => $value["divid"],
                        'SEC_ID' => $value["secid"],
                        'PART_ID' => $value["partid"],
                        'PARTH_SHT' => $value["pathsht"],
                        'DEP_SHT' => $value["depsht"],
                        'DIV_SHT' => $value["divsht"],
                        'SEC_SHT' => $value["secsht"],
                        'PATH_SHT' => $value["partsht"],
                        'PARTH_LNG' => $value["pathlng"],
                        'DEP_LNG' => $value["deplng"],
                        'DIV_LNG' => $value["divlng"],
                        'SEC_LNG' => $value["seclng"],
                        'PART_LNG' => $value["partlng"],


                    );

                    DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID',"=",$value["empid"])->update($dataupdate);
                }


                if($user == null){

                    $date = new Date();

                    $pri = $userinfo = DB::table('TBL_PRIVILEGE')->where('USER_PRIVILEGE_ID', 2)->get();

                    $datedata = $value["birthdate"];

                    $rest = substr("abcdef", -1);    // returns "f"
                    $rest = substr("abcdef", -2);    // returns "ef"
                    $rest = substr("abcdef", -3, 1);



                    $newDate = substr($datedata, -2) . substr($datedata, -4,2). ((int)substr($datedata, -8, 4)) + 543;



                    $ecPass = exec("cmd /c md5.bat -e ".$newDate." 2>&1");

                    $ecPass = explode(':',$ecPass)[1];

                    $datedefault = new Date("9999-12-31 00:00:00.000") ;
                    $admin= 'Administrator';
                    $user_id = '2';

                    array_push($datauser, array(
                        'EMP_ID' => $EMP_ID,
                        'USERNAME' => $EMP_ID,
                        'PASSWORD' => $ecPass,
                        'PASSWORD_EXPIRE_DATE' =>$datedefault,
                        'CREATE_DATE' => $date,
                        'CREATE_BY' => $admin,
                        'LAST_MODIFY_DATE' =>$date,
                        'USER_PRIVILEGE_ID' => $user_id,
                        'ACCESS_PERMISSIONS' => $pri[0]->ACCESS_PERMISSIONS,
                        'USER_STATUS_ID' => 13,
                        'FIRST_LOGIN_FLAG' => 0,
                        'EMAIL_NOTIFY_FLAG' => 1

                    ));


                }
            }

            DB::table('TBL_EMPLOYEE_INFO')->insert($data);
            DB::table('TBL_USER')->insert($datauser);

        });
        return response()->json(array('success' => true, 'html'=>$retdate));
//    $sd =    Excel::load(storage_path('/public/import/import.xlsx'), function($file) {
//
//            // modify stuff
//
//        })->convert('csv')->move(storage_path().'/public/import/' , 'import.csv');;
//
//        $ret = Excel::filter('chunk')->load(storage_path('/public/import/import.xlsx'))->chunk(250, function($results){
//
////            $results->formatDates(true, 'Y-m-d');
//
//
//
//            $data = array();
//            $datauser = array();
//
//            var_dump($results);
//
//            foreach($results as $index => $value){
//
//                $EMP_ID = $value["empid"];
//
//                $userinfo = DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID', $EMP_ID)->get();
//
//                $user = DB::table('TBL_USER')->where('EMP_ID', $EMP_ID)->get();
//
////                $StatusID = $value["user_status_id"];
//
//                if($userinfo == null){
//
////                    var_dump($value["enddate"]);
//
//                    $dateS = new Date($value["startdate"]);
//
//                    $dateStart = date("d/m/Y", strtotime($dateS));
//
//                    $dateE = new Date($value["enddate"]);
//                    $dateEnd = date("d/m/Y", strtotime($dateE));
//
//
////                    array_push($data, array(
////                        'EMP_ID' => $value["emp_id"],
////                        'PREFIX' => $value["prefix"],
////                        'FULL_NAME' => $value["fullname"],
////                        'ENG_NAME' =>$value["engname"],
////                        'FIRST_NAME' => $value["firstname"],
////                        'LAST_NAME' => $value["lastname"],
////                        'PRIORITY' => $value["priority"],
////                        'JOB_ID' => $value["jobid"],
////                        'JOB_DESC_SHT' => $value["jobdescsht"],
////                        'JOB_DESC' => $value["jobdesc"],
////                        'PER_ID' => $value["perid"],
////                        'START_DATE' => $dateStart,
////                        'END_DATE' => $dateEnd,
////                        'COST_CENTER' => $value["costcenter"],
////                        'C_LEVEL' => $value["clevel"],
////                        'POST_ID' => $value["posid"],
////                        'POS_DESC' => $value["posdesc"],
////                        'ORG_ID' => $value["orgid"],
////                        'ENG_FIRST_NAME' => $value["engfirstname"],
////                        'ENG_LAST_NAME' => $value["englastname"],
////                        'BIRTH_DATE' => $value["birthdate"],
////                        'ORG_DESC' => $value["orgdesc"],
////                        'PATH_ID' => $value["pathid"],
////                        'DEP_ID' => $value["depid"],
////                        'DIV_ID' => $value["divid"],
////                        'SEC_ID' => $value["secid"],
////                        'PART_ID' => $value["partid"],
////                        'PARTH_SHT' => $value["pathsht"],
////                        'DEP_SHT' => $value["depsht"],
////                        'DIV_SHT' => $value["divsht"],
////                        'SEC_SHT' => $value["secsht"],
////                        'PATH_SHT' => $value["partsht"],
////                        'PARTH_LNG' => $value["pathlng"],
////                        'DEP_LNG' => $value["deplng"],
////                        'DIV_LNG' => $value["divlng"],
////                        'SEC_LNG' => $value["seclng"],
////                        'PART_LNG' => $value["partlng"],
////
////
////                    ));
//
//
//
//
//                }
//
//                if($user == null){
//
//                    $date = new Date();
//
//                    $pri = $userinfo = DB::table('TBL_PRIVILEGE')->where('USER_PRIVILEGE_ID', 2)->get();
//
//                    $datedata = $value["birthdate"];
//
//                    $rest = substr("abcdef", -1);    // returns "f"
//                    $rest = substr("abcdef", -2);    // returns "ef"
//                    $rest = substr("abcdef", -3, 1);
//
//
//
//                    $newDate = substr($datedata, -2) . substr($datedata, -4,2). ((int)substr($datedata, -8, 4)) + 543;
//
//
//
//                    $ecPass = exec("cmd /c md5.bat -e ".$newDate." 2>&1");
//
//                    $ecPass = explode(':',$ecPass)[1];
//
//                    $datedefault = new Date("9999-12-31 00:00:00.000") ;
//                    $admin= 'Administrator';
//                    $user_id = '2';
//
//                    array_push($datauser, array(
//                        'EMP_ID' => $EMP_ID,
//                        'USERNAME' => $EMP_ID,
//                        'PASSWORD' => $ecPass,
//                        'PASSWORD_EXPIRE_DATE' =>$datedefault,
//                        'CREATE_DATE' => $date,
//                        'CREATE_BY' => $admin,
//                        'LAST_MODIFY_DATE' =>$date,
//                        'USER_PRIVILEGE_ID' => $user_id,
//                        'ACCESS_PERMISSIONS' => $pri[0]->ACCESS_PERMISSIONS,
//                        'USER_STATUS_ID' => 13,
//                        'FIRST_LOGIN_FLAG' => 0,
//                        'EMAIL_NOTIFY_FLAG' => 1
//
//                    ));
//
//
//                }
//
//            }
//
//
////            DB::table('TBL_EMPLOYEE_INFO')->insert($data);
////            DB::table('TBL_USER')->insert($datauser);
//
//        });







    }


}
