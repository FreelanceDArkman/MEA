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

        $ret = Excel::filter('chunk')->load(storage_path('/public/import/import.xlsx'))->chunk(250, function($results){





//            var_dump($ret);

            foreach($results as $index => $value){

                $EMP_ID = $value["empid"];

                $userinfo = DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID', $EMP_ID)->get();

                $user = DB::table('TBL_USER')->where('EMP_ID', $EMP_ID)->get();

//                $StatusID = $value["user_status_id"];

                if($userinfo == null){

                    $dateS = new Date($value["startdate"]);

                    $dateStart = date("d/m/Y", strtotime($dateS));

                    $dateE = new Date($value["enddate"]);
                    $dateEnd = date("d/m/Y", strtotime($dateE));

                    $insert = "INSERT INTO TBL_EMPLOYEE_INFO (EMP_ID,PREFIX,FULL_NAME,ENG_NAME,FIRST_NAME,LAST_NAME,PRIORITY,JOB_ID,JOB_DESC_SHT,JOB_DESC,PER_ID,START_DATE,END_DATE,COST_CENTER,C_LEVEL,POST_ID,POS_DESC,ORG_ID,ENG_FIRST_NAME,ENG_LAST_NAME,
BIRTH_DATE,ORG_DESC,PATH_ID,DEP_ID,DIV_ID,SEC_ID,PART_ID,PARTH_SHT,DEP_SHT,DIV_SHT,SEC_SHT,PATH_SHT,PARTH_LNG,DEP_LNG,
DIV_LNG,SEC_LNG,PART_LNG) VALUES('".$EMP_ID."','".$value["prefix"]."','".$value["fullname"]."','".$value["engname"]."','".$value["firstname"]."','".$value["lastname"]."',".$value["priority"].",".$value["jobid"].",'".$value["jobdescsht"]."','".$value["jobdesc"]."','".$value["perid"]."','".$dateStart."','".$dateEnd."','".$value["costcenter"]."',".$value["clevel"].",".$value["posid"].",'".$value["posdesc"]."',".$value["orgid"].",'".$value["engfirstname"]."','".$value["englastname"]."','".$value["birthdate"]."','".$value["orgdesc"]."',".$value["pathid"].",".$value["depid"].",".$value["divid"].",".$value["secid"].",".$value["partid"].",'".$value["pathsht"]."','".$value["depsht"]."','".$value["divsht"]."','".$value["secsht"]."','".$value["partsht"]."','".$value["pathlng"]."','".$value["deplng"]."','".$value["divlng"]."','".$value["seclng"]."','".$value["partlng"]."')";

                    DB::insert(DB::raw($insert));
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


                    $insetuser = "INSERT INTO TBL_USER (EMP_ID,USERNAME,PASSWORD,PASSWORD_EXPIRE_DATE,CREATE_DATE
,CREATE_BY,LAST_MODIFY_DATE,USER_PRIVILEGE_ID,ACCESS_PERMISSIONS,USER_STATUS_ID,FIRST_LOGIN_FLAG,EMAIL_NOTIFY_FLAG)
VALUES('".$EMP_ID."','".$EMP_ID."','".$ecPass."','9999-12-31 00:00:00.000','".$date."','Administrator','".$date."'
,'2','".$pri[0]->ACCESS_PERMISSIONS."','13','0','1')";

                    DB::insert(DB::raw($insetuser));

                }

            }



        });


        return response()->json(array('success' => true, 'html'=>$ret));

        $type = $request->input('type');


    }


}
