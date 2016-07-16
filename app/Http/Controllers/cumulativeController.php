<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class cumulativeController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 23,
            'menu_id' => 1,
            'title' => 'ข้อมูลอัตราสะสม MEA FUND'
        ] );


        $sqlchk = "SELECT * FROM TBL_CONTROL_CFG";
        $dataCheck =  DB::select(DB::raw($sqlchk))[0];



       // saving_rate_change_period
       // var_dump(session()->get('user_data')->saving_rate_change_period);
//access_status_flag

        $sql = "SELECT TOP 1 * FROM TBL_USER_SAVING_RATE WHERe EMP_ID =  '".get_userID()."' AND MONTH(CHANGE_SAVING_RATE_DATE) = MONTH(GETDATE())
AND YEAR(CHANGE_SAVING_RATE_DATE) = YEAR(GETDATE())";

        $CurrnentPlan = DB::select(DB::raw($sql));


        $sql4 ="SELECT TOP 1 * FROM TBL_USER_SAVING_RATE WHERe EMP_ID = '".get_userID()."' ORDER BY EFFeCTIVE_DATE DESC";
        $effective = DB::select(DB::raw($sql4));





        $sql2 = "SELECT * FROM TBL_SAVING_RATE_INFO";
        $Workcheck =  DB::select(DB::raw($sql2))[0];


        $sql3 ="SELECT TOP 1 * FROM TBL_MEMBER_BENEFITS WHERE EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE DESC";
        $Workhrs =  DB::select(DB::raw($sql3));



        $sql5 = "SELECT USER_PRIVILEGE_DESC FROM tbl_USER us
INNER JOIN tbl_privilege pi ON pi.USER_PRIVILEGE_ID = us.USER_PRIVILEGE_ID
WHERE us.EMP_ID = '".get_userID()."'";
        $users =  DB::select(DB::raw($sql5))[0];





        $sqlhis = "SELECT * FROM TBL_EMPLOYEE_INFO emp
INNER JOIN TBL_USER_SAVING_RATE sav ON sav.EMP_ID = emp.EMP_ID
WHERe sav.EMP_ID = '".get_userID()."' ORDER BY sav.CHANGE_SAVING_RATE_DATE DESC";

        $historyPlan = DB::select(DB::raw($sqlhis));




        $currentyear = "2016";

        if($CurrnentPlan){
            $currentyear = get_date_year($CurrnentPlan[0]->CHANGE_SAVING_RATE_DATE);
        }else{
            if($effective){
                $currentyear = get_date_year($effective[0]->CHANGE_SAVING_RATE_DATE);
            }

        }

        //Generate Drop
        $colObj = collect($historyPlan);
        $max = null;
        $min = null;
        $max = $colObj->max('CHANGE_SAVING_RATE_DATE');
        $min = $colObj->min('CHANGE_SAVING_RATE_DATE');


        $dateMin = new Date($min);
        $dateMax = new Date($max);


        $yearMin = date("Y",strtotime($dateMin));
        $yearMax = date("Y",strtotime($dateMax));



        $intYearhMin =  intval($yearMin) + 543;
        $intYearhMax= intval($yearMax) + 543;



        $arrDropYear = array();
        $count = 0;
        $ret ="<option selected='selected' value='1999'>เลือกปี</option>";
        for($i = $intYearhMin; $i <=  $intYearhMax; $i++){
            $arrDropYear[$count] = $i;

            $ret = $ret . "<option value=".($i-543).">".$i."</option>";

            $count = $count+1;



        }

        $sql44  = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID =  '".get_userID()."' ORDER BY CREATE_DATE DESC";


        $infoaset_db =  DB::select(DB::raw($sql44));
        $infoaset =null;
        if($infoaset_db){
            $infoaset = $infoaset_db[0];
        }


        $sql111 = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        $empinfo = DB::select(DB::raw($sql111))[0];


        $sql222 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $planchoose_db = DB::select(DB::raw($sql222));

        $planchoose= null;
        if($planchoose_db){
            $planchoose = $planchoose_db[0];
        }



        $Isaccess = true;
        $arrpages = explode("-", $dataCheck->SAVING_RATE_CHANGE_PERIOD);
        $Modify_count = 0;


        $today = new Date();
        $datetoday =  date("d",strtotime($today));

        if($datetoday < $arrpages[0] || $datetoday>$arrpages[1]){
            $Isaccess = false;
        }





        return view('frontend.pages.23p1')->with([
            'CurrnentPlan'=>$CurrnentPlan,
            'dataCheck'=>$dataCheck ,
            'effective'=>$effective,
            'Workcheck' =>$Workcheck,
            'users'=>$users ,
            'historyPlan'=>$historyPlan,
            'ishowhis'=>false,
            'ret'=>$ret ,
            'infoaset'=>$infoaset,
            'empinfo'=>$empinfo,
            'planchoose'=>$planchoose,
            'Isaccess'=>$Isaccess
        ]);
    }


    public function getIndexbysearch(Request $request)
    {
        $this->pageSetting( [
            'menu_group_id' => 23,
            'menu_id' => 1,
            'title' => 'ข้อมูลอัตราสะสม MEA FUND'
        ] );


        $sqlchk = "SELECT * FROM TBL_CONTROL_CFG";
        $dataCheck =  DB::select(DB::raw($sqlchk))[0];





        // saving_rate_change_period
        // var_dump(session()->get('user_data')->saving_rate_change_period);
//access_status_flag

        $sql = "SELECT TOP 1 * FROM TBL_USER_SAVING_RATE WHERe EMP_ID =  '".get_userID()."' AND MONTH(CHANGE_SAVING_RATE_DATE) = MONTH(GETDATE())
AND YEAR(CHANGE_SAVING_RATE_DATE) = YEAR(GETDATE())";

        $CurrnentPlan = DB::select(DB::raw($sql));


        $sql4 ="SELECT TOP 1 * FROM TBL_USER_SAVING_RATE WHERe EMP_ID = '".get_userID()."' ORDER BY EFFeCTIVE_DATE DESC";
        $effective = DB::select(DB::raw($sql4));





        $sql2 = "SELECT * FROM TBL_SAVING_RATE_INFO";
        $Workcheck =  DB::select(DB::raw($sql2))[0];


        $sql3 ="SELECT TOP 1 * FROM TBL_MEMBER_BENEFITS WHERE EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE DESC";
        $Workhrs =  DB::select(DB::raw($sql3));



        $sql5 = "SELECT USER_PRIVILEGE_DESC FROM tbl_USER us
INNER JOIN tbl_privilege pi ON pi.USER_PRIVILEGE_ID = us.USER_PRIVILEGE_ID
WHERE us.EMP_ID = '".get_userID()."'";
        $users =  DB::select(DB::raw($sql5))[0];





        $sqlhis = "SELECT * FROM TBL_EMPLOYEE_INFO emp
INNER JOIN TBL_USER_SAVING_RATE sav ON sav.EMP_ID = emp.EMP_ID
WHERe YEAR(sav.CHANGE_SAVING_RATE_DATE) = '".$request->input('drop_year')."' AND sav.EMP_ID = '".get_userID()."'  ORDER BY sav.CHANGE_SAVING_RATE_DATE DESC";

        $historyPlan = DB::select(DB::raw($sqlhis));


        $ishowhis = true;




        $currentyear = "";

        if($CurrnentPlan){
            $currentyear = get_date_year($CurrnentPlan[0]->CHANGE_SAVING_RATE_DATE);
        }else{
            $currentyear = get_date_year($effective[0]->CHANGE_SAVING_RATE_DATE);
        }



        $sqlhisall = "SELECT * FROM TBL_EMPLOYEE_INFO emp
INNER JOIN TBL_USER_SAVING_RATE sav ON sav.EMP_ID = emp.EMP_ID
WHERe sav.EMP_ID = '".get_userID()."' ORDER BY sav.CHANGE_SAVING_RATE_DATE DESC";

        $historyPlanAll = DB::select(DB::raw($sqlhisall));


        //Generate Drop
        $colObj = collect($historyPlanAll);
        $max = null;
        $min = null;
        $max = $colObj->max('CHANGE_SAVING_RATE_DATE');
        $min = $colObj->min('CHANGE_SAVING_RATE_DATE');


        $dateMin = new Date($min);
        $dateMax = new Date($max);


        $yearMin = date("Y",strtotime($dateMin));
        $yearMax = date("Y",strtotime($dateMax));



        $intYearhMin =  intval($yearMin) + 543;
        $intYearhMax= intval($yearMax) + 543;

        $arrDropYear = array();
        $count = 0;
        $ret ="<option value='1990'>เลือกปี</option>";
        for($i = $intYearhMin; $i <=  $intYearhMax; $i++){
            $arrDropYear[$count] = $i;

            if(($i-543) == (int)$request->input('drop_year')){
                $ret = $ret . "<option selected='selected' value=".($i-543).">".$i."</option>";
            }else{
                $ret = $ret . "<option value=".($i-543).">".$i."</option>";
            }


            $count = $count+1;



        }

        $sql44  = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID =  '".get_userID()."' ORDER BY CREATE_DATE DESC";

        $infoaset = DB::select(DB::raw($sql44))[0];

        $sql111 = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        $empinfo = DB::select(DB::raw($sql111))[0];


        $sql222 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $planchoose = DB::select(DB::raw($sql222))[0];


        $Isaccess = true;
        $arrpages = explode("-", $dataCheck->SAVING_RATE_CHANGE_PERIOD);
        $Modify_count = 0;


        $today = new Date();
        $datetoday =  date("d",strtotime($today));

        if($datetoday < $arrpages[0] || $datetoday>$arrpages[1]){
            $Isaccess = false;
        }


        return view('frontend.pages.23p1')->with([
            'CurrnentPlan'=>$CurrnentPlan,
            'dataCheck'=>$dataCheck ,
            'effective'=>$effective,
            'Workcheck' =>$Workcheck,
            'users'=>$users ,
            'historyPlan'=>$historyPlan,
            'ishowhis'=>$ishowhis,
            'ret'=>$ret,
            'infoaset'=>$infoaset,
            'empinfo'=>$empinfo,
            'planchoose'=>$planchoose,
            'Isaccess'=>$Isaccess
        ]);
    }

    public  function  InsertPlan(Request $request){



        $create_date = new Date();
        $dateCurrentModify = new Date($request->input('date_modify'));
        $datenextmont = date("Y-m-d H:i:s",strtotime('+1 month'));

        $sqlchk = "SELECT * FROM TBL_CONTROL_CFG";
        $dataCheck =  DB::select(DB::raw($sqlchk))[0];


        $arrpages = explode("-", $dataCheck->SAVING_RATE_CHANGE_PERIOD);
        $Modify_count = 0;

       if(date("Y",strtotime($create_date)) != date("Y",strtotime($dateCurrentModify))){
           $Modify_count = 1;
       }else{

           if( date("d",strtotime($create_date)) == (int)$arrpages[1] &&  date("m",strtotime($create_date)) == date("m",strtotime($dateCurrentModify)) && date("Y",strtotime($create_date)) == date("Y",strtotime($dateCurrentModify))){

               $Modify_count = $request->input('count_modify');

           }else{
               $Modify_count = $request->input('count_modify') + 1;
           }

       }


        $USER = DB::table('TBL_USER')->where("EMP_ID" ,"=",get_userID())->get()[0];

        $effectiveDate = New Date(date("Y",strtotime($datenextmont))."-".date("m",strtotime($datenextmont))."-1");
        $emp_id =  get_userID();
        $plan_id =   $request->input('TYPE_TOPIC');
        $USER_SAVING_RATE =   $request->input('maxVal2');
        $addby = get_userID();
        $USER_STATUS_ID = $USER->USER_STATUS_ID;
        $LEAVE_FUND_GROUP_DATE = null;
        if($USER->LEAVE_FUND_GROUP_DATE != null){
            $LEAVE_FUND_GROUP_DATE = $USER->LEAVE_FUND_GROUP_DATE;
        }



        $data = array(
            'EMP_ID' => $emp_id,
            'USER_SAVING_RATE' =>$USER_SAVING_RATE,
            'CHANGE_SAVING_RATE_DATE' => $create_date,
            'EFFECTIVE_DATE' => $effectiveDate,
            'MODIFY_COUNT' => $Modify_count,
            'MODIFY_BY' =>$addby,
            'USER_STATUS_ID' => $USER_STATUS_ID,
            'LEAVE_FUND_GROUP_DATE' => $LEAVE_FUND_GROUP_DATE

        );




        $ret = DB::table('TBL_USER_SAVING_RATE')->insert($data);





        $val =  array(
            "emp_id" => $emp_id,
            "plan_id" => $plan_id,
            "USER_SAVING_RATE" => $USER_SAVING_RATE,
            "create_date" =>$create_date
        );

        if($ret){
            Logprocess(4,$val);
        }
//
        return redirect()->to('/cumulative');
    }

    public function deleplan(Request $request)
    {

        $sql = "DELETE FROM TBL_USER_SAVING_RATE WHERE EMP_ID = '".get_userID()."' AND MONTH(CHANGE_SAVING_RATE_DATE) = MONTH(GETDATE())
AND YEAR(CHANGE_SAVING_RATE_DATE) = YEAR(GETDATE())";

        $ret = DB::delete(DB::raw($sql));

        if($ret){
            Logprocess(3);
        }

        return redirect()->to('/cumulative')->with('del2','ok');
    }
}
