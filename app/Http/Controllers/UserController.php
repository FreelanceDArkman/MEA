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

class UserController extends Controller
{

    public function users()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 2,
            'title' => 'จัดการผู้ใช้ | MEA'
        ]);

//        $user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();
        $user_group = DB::table('TBL_USER_STATUS')->select('USER_STATUS_ID','STATUS_DESC')->orderBy('USER_STATUS_ID', 'asc')->get();

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
            $where .= " AND us.USER_STATUS_ID = '" . $filter1 . "'";

            session(['USER_STATUS_ID' => $filter1]);
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
            'title' => 'เพิ่มผู้ใช้ | MEA'
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
            $data = "รหัสผู้ใช้ที่ท่าน กรอก มีแล้วในระบบ";
        }else{

//          $html = passthru("cmd /c md5.bat -e asdasd 2>&1");


            //$ecPass = MEAMD5($password);

            $date = new Date();
            $MEASecEncoe = new \Security();
            $ecPass =  $MEASecEncoe->encrypt($newDate,"#Gm2014$06$30@97");

//            $ecPass = exec("cmd /c md5.bat -e ".$password." 2>&1");
//
//            $ecPass = explode(':',$ecPass)[1];

            $user_group =  DB::table('TBL_PRIVILEGE')->where('USER_PRIVILEGE_ID',$group_id)->get();

//            var_dump($user_group);
            $per = $user_group[0]->ACCESS_PERMISSIONS;



            $insert = "INSERT INTO TBL_USER (EMP_ID,USERNAME,PASSWORD,PASSWORD_EXPIRE_DATE,USER_STATUS_ID,
USER_PRIVILEGE_ID,ACCESS_PERMISSIONS,FIRST_LOGIN_FLAG,LEAVE_FUND_GROUP_DATE
,RETURN_FUND_GROUP_DATE,EMAIL,PHONE,ADDRESS,CREATE_DATE,LAST_MODIFY_DATE

)VALUES('".$user_id."','".$user_name."','".$ecPass."','".$expire."','".$status."','".$group_id."','".$per."','".$chk_firstlogin."',".($retire== "" ? NULL: "'". $retire ."'" ).",".($comeback== "" ? NULL: "'". $comeback . "'" ).",'".$email."','".$phone."','".$address."','".$date."','".$date."')";


        DB::insert(DB::raw($insert));



            $staturet= true;
            $data = "ok";
        }


        return response()->json(array('success' => $staturet, 'html'=>$data));
    }



    public  function  getEditUser($id){
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 2,
            'title' => 'แก้ไขข้อมูลผู้ใช้ | MEA'
        ] );


        $user =  DB::table('TBL_USER')->where('EMP_ID',$id)->get();

        $user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();
        $user_status = DB::table('TBL_USER_STATUS')->get();

        $userplan = DB::table('TBL_INVESTMENT_PLAN')->get();
        return view('backend.pages.edit_user')->with([
            'user' => $user[0],
            'user_group' => $user_group,
            'user_status' => $user_status,
            'userplan'=>$userplan
        ]);
    }




    public  function  postEditUser(Request $request){


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


        $date = new Date();



        $insert = "UPDATE TBL_USER SET EMAIL = '".$email."' , PHONE= '".$phone."' , ADDRESS='".$address."',FIRST_LOGIN_FLAG ='".$chk_firstlogin."',PASSWORD_EXPIRE_DATE='".$expire."',USER_PRIVILEGE_ID='".$group_id."',USER_STATUS_ID='".$status."'
        ,LEAVE_FUND_GROUP_DATE= ".($retire== "" ? 'NULL': "'". $retire ."'" ).",RETURN_FUND_GROUP_DATE = ".($comeback== "" ? 'NULL': "'". $comeback . "'" )." ,LAST_MODIFY_DATE ='".$date."'  WHERE EMP_ID = '".$user_id."'";





        DB::insert(DB::raw($insert));



        $staturet= true;
        $data = "ok";


        return response()->json(array('success' => $staturet, 'html'=>$data));
    }

    public  function  postEditUser1(Request $request){

        $arrPlanTopic = explode(",", $request->input('PLAN_ID'));
        $user_id=$request->input('user_id');
        $PLAN_ID =$arrPlanTopic[0];
        $EQUITY_RATE=$request->input('EQUITY_RATE');
        $DEBT_RATE=$request->input('DEBT_RATE');
        $MODIFY_COUNT=$request->input('MODIFY_COUNT');


        $MODIFY_DATE  = new Date($request->input('MODIFY_DATE'));
        $EFFECTIVE_DATE = new Date($request->input('EFFECTIVE_DATE'));




          $users = DB::table('TBL_USER')->where('EMP_ID','=',$user_id)->get();

//        var_dump($users[0]->USER_STATUS_ID);

        $date = new Date();


        $data = array(
            'EMP_ID' => $user_id,
            'PLAN_ID' =>$PLAN_ID,
            'EQUITY_RATE' => $EQUITY_RATE,
            'DEBT_RATE' => $DEBT_RATE ,
            'MODIFY_DATE' => $MODIFY_DATE,
            'EFFECTIVE_DATE' =>$EFFECTIVE_DATE,
            'MODIFY_COUNT' => $MODIFY_COUNT,
            'MODIFY_BY' => get_userID(),
            'USER_STATUS_ID' => $users[0]->USER_STATUS_ID,
            'LEAVE_FUND_GROUP_DATE' => $users[0]->LEAVE_FUND_GROUP_DATE
        );




        $ret = DB::table('TBL_USER_FUND_CHOOSE')->insert($data);






        return response()->json(array('success' => $ret, 'html'=>"ok"));
    }

    public  function  postEditUser2(Request $request){


        $user_id=$request->input('user_id');
        $USER_SAVING_RATE =$request->input('USER_SAVING_RATE');


        $MODIFY_COUNT=$request->input('MODIFY_COUNT');


        $CHANGE_SAVING_RATE_DATE  = new Date($request->input('CHANGE_SAVING_RATE_DATE'));
        $EFFECTIVE_DATE = new Date($request->input('EFFECTIVE_DATE'));




        $users = DB::table('TBL_USER')->where('EMP_ID','=',$user_id)->get();

//        var_dump($users[0]->USER_STATUS_ID);

        $date = new Date();


        $data = array(
            'EMP_ID' => $user_id,
            'USER_SAVING_RATE' =>$USER_SAVING_RATE,
            'CHANGE_SAVING_RATE_DATE' => $CHANGE_SAVING_RATE_DATE,
            'EFFECTIVE_DATE' =>$EFFECTIVE_DATE,
            'MODIFY_COUNT' => $MODIFY_COUNT,
            'MODIFY_BY' => get_userID(),
            'USER_STATUS_ID' => $users[0]->USER_STATUS_ID,
            'LEAVE_FUND_GROUP_DATE' => $users[0]->LEAVE_FUND_GROUP_DATE
        );




        $ret = DB::table('TBL_USER_SAVING_RATE')->insert($data);






        return response()->json(array('success' => $ret, 'html'=>"ok"));
    }

    public  function  postEditUser3(Request $request){


        $user_id=$request->input('user_id');
        $FULL_NAME =$request->input('FULL_NAME');



//        $file = $request->file('pdfimport')->getClientOriginalName();
//        $emp_id = explode('.',$file)[0];
//        $extension = explode('.',$file)[1];


//        $file_name = $emp_id . "." . $extension;

        $file_name  = $user_id. ".pdf";
        $filePath = "";


        $qfileName = "SELECT WEB_BENEFICIARY_ROOT_PATH FROM TBL_CONTROL_CFG";
        $datafile_name= DB::select(DB::raw($qfileName));

        if($datafile_name)
        {
            $filePath = $datafile_name[0]->WEB_BENEFICIARY_ROOT_PATH . $user_id . ".pdf";
        }

        $TBL_USER_BENEFICIARY = DB::table('TBL_USER_BENEFICIARY')->where('EMP_ID','=',$user_id)->get();

//        var_dump($users[0]->USER_STATUS_ID);

        $date = new Date();


        $data = array(
            'EMP_ID' => $user_id,
            'FULL_NAME' =>$FULL_NAME,
            'FILE_PATH' => $filePath,
            'CREATE_DATE' =>$date,
            'CREATE_BY' => get_userID(),
            'FILE_NAME' => $file_name

        );



        if($TBL_USER_BENEFICIARY){
            $ret = DB::table('TBL_USER_BENEFICIARY')->where('EMP_ID','=',$user_id)->update($data);
        }else{
            $ret = DB::table('TBL_USER_BENEFICIARY')->insert($data);
        }


        $request->file('pdfimport')->move(public_path().getenv('BENEFICIARY_PDF_PATH') , $file_name);




        return response()->json(array('success' => $ret, 'html'=>"ok"));
    }

    public function deleteUser(Request $request)
    {

        $arrId = explode(',',$request->input('group_id'));

        foreach($arrId as $index => $item){

            if($item != ""){
                $deleted = DB::table('TBL_USER')->where('EMP_ID', $item)->delete();
            }

        }
        $staturet= true;
        $data = "ok";
//
//        if($deleted)  {
//            return response()->json(["ret" => "1"]);
//        }else{
//            return response()->json(["ret" => "0"]);
//        }


        return response()->json(array('success' => $staturet, 'html'=>$data));

    }


    public function ReqPassword(Request $request)
    {

        $data = array(
            "session_id" => Session::getId(),
            "username" => $request->input('username')

        );


        $curl = new Curl('REQUEST_NEW_PASS', $data);

        $result_login = $curl->getResult();
//        var_dump($result_login);
        $staturet = false;
        $message  ="";
        if($result_login->errCode != 0) {

            $message = "ไม่พบผู้ใช้นี้";
        } else {

            $message = "ระบบได้ส่ง password ใหม่ไปทางอีเมล์ ของผู้ใช้นี้เรียบร้อยแล้ว";
            $staturet = true;

        }

        return response()->json(array('success' => $staturet, 'html'=>$message));
    }




    public function getimport()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 2,
            'title' => 'นำเข้าข้อมูล | MEA'
        ]);

        $user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.users_import')->with([
            'user_group' => $user_group
        ]);
    }


    public function importdata(Request $request){

//        var_dump($request->file('exelimport'));
//        $inputfile= $request->input('exelimport');
        //Input::file('import1')

        $results = null;

        $type = $request->input('type');

//        var_dump($type . "jjjjjj");

        Excel::load($request->file('exelimport'), function ($reader) use($type) {

            $results = $reader->get();

            $ret = $results->toArray();

            foreach($ret as $index => $value){

                $EMP_ID = $value["emp_id"];
                $StatusID = $value["user_status_id"];

//

//                /$type = 1;

//                RETURN_FUND_GROUP_DATE

                switch($type){
                    case  "1":

                        $update1 = "UPDATE TBL_USER SET USER_STATUS_ID = '".$StatusID."' WHERE EMP_ID = '".$EMP_ID."' ";
                        DB::insert(DB::raw($update1));
                        break;

                    case  "2":
                        $fund = $value["leave_fund_group_date"];
                        $firstlogin = $value["leave_fund_flag"];

                        $update1 = "UPDATE TBL_USER SET USER_STATUS_ID = '".$StatusID."', LEAVE_FUND_GROUP_DATE='".$fund."' ,LEAVE_FUND_FLAG = '".$firstlogin."' WHERE EMP_ID = '".$EMP_ID."' ";
                        DB::insert(DB::raw($update1));
                        break;
                    case "3":
                        $return = $value["return_fund_group_date"];
                        $update1 = "UPDATE TBL_USER SET USER_STATUS_ID = '".$StatusID."', RETURN_FUND_GROUP_DATE = '".$return."' WHERE EMP_ID = '".$EMP_ID."' ";
                        DB::insert(DB::raw($update1));
                        break;

                }


            }



           // var_dump($results);


//            $reader->each(function($sheet) {
//                foreach ($sheet->toArray() as $row) {
////                    User::firstOrCreate($row);
////                    $ret .= $row;
//                    $ret = $row-.
//                }
//            });

//            $ret = (array)$results;



//            var_dump($ret[0]["emp_id"]);





//            $insert = "UPDATE TBL_USER SET USER_STATUS_ID = '".."' ";





//            DB::insert(DB::raw($insert));



            $staturet= true;
            $data = "ok";

//
//            array(2) {
//                ["*title"]=> string(6) "Sheet1"
//                ["*items"]=>
//  array(1) {
//                    [0]=>
//    object(Maatwebsite\Excel\Collections\CellCollection)#823 (2) {
//    ["title":protected]=>
//      NULL
//      ["items":protected]=>
//      array(2) {
//                        ["emp_id"]=>
//        string(8) "00000001"
//                        ["user_status_id"]=>
//        float(11)
//      }
//    }
//  }
//}
        });





        return response()->json(array('success' => true, 'html'=>"hello"));
    }



    public function importdata2(Request $request){



        $results = null;
        $GLOBALS['empidReturn'] ="";

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

            $empidtoStatus = "123";
            foreach($ret as $index => $value){



//                var_dump($value["enddate"]);

                $EMP_ID = $value["empid"];

                $GLOBALS['empidReturn'] = $value["empid"];

                $userinfo = DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID', $EMP_ID)->get();

                $user = DB::table('TBL_USER')->where('EMP_ID', $EMP_ID)->get();

                $TBL_EMP_PENSION =DB::table('TBL_EMP_PENSION')->where('EMP_ID', $EMP_ID)->get();

//                $StatusID = $value["user_status_id"];


                if($TBL_EMP_PENSION == null){
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


                        $MEASecEncoe = new \Security();
                        $ecPass =  $MEASecEncoe->encrypt($newDate,"#Gm2014$06$30@97");
                       // $ecPass = exec("cmd /c md5.bat -e ".$newDate." 2>&1");

                        //$ecPass = explode(':',$ecPass)[1];

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

                $empidtoStatus .= ",". $EMP_ID ;

            }

            DB::table('TBL_EMPLOYEE_INFO')->insert($data);
            DB::table('TBL_USER')->insert($datauser);

//
//            $sql = "UPDATE TBL_USER SET user_status_id= 14  WHERE EMP_ID NOT IN (".$empidtoStatus.")";
//
//            DB::update(DB::raw($sql));



        });
        return response()->json(array('success' => true, 'html'=>$GLOBALS['empidReturn']));








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
