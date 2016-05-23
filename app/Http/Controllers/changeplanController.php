<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class changeplanController extends Controller
{

    public  function  InsertInvestPlan(Request $request){


        $sqlchk = "SELECT * FROM TBL_CONTROL_CFG";
        $dataCheck =  DB::select(DB::raw($sqlchk))[0];
        $create_date = new Date();
        $dateCurrentModify = new Date($request->input('date_modify'));
        $datenextmont = date("Y-m-d H:i:s",strtotime('+1 month'));
        $currentCount = $request->input('count_modify');

        $Modify_count = 0;

        $arrpages = explode("-", $dataCheck->FUND_PLAN_CHANGE_PERIOD);

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
        $arrPlanTopic = explode(",", $request->input('TYPE_TOPIC'));

        $effectiveDate = New Date(date("Y",strtotime($datenextmont))."-".date("m",strtotime($datenextmont))."-1");
        $emp_id =  get_userID();
        $plan_id =   $arrPlanTopic[0];
        $equip =   $request->input('maxVal1');
        $dept =   $request->input('maxVal2');
        $addby = get_userID();
        $USER_STATUS_ID = $USER->USER_STATUS_ID;
        $LEAVE_FUND_GROUP_DATE = "NULL";


        if($USER->LEAVE_FUND_GROUP_DATE != null){
            $LEAVE_FUND_GROUP_DATE = $USER->LEAVE_FUND_GROUP_DATE;
        }


//        $addby = $request->input('user');

//    var_dump($USER);

        $sql = "INSERT INTO TBL_USER_FUND_CHOOSE (EMP_ID,PLAN_ID,EQUITY_RATE,DEBT_RATE,MODIFY_DATE,EFFECTIVE_DATE,MODIFY_COUNT,MODIFY_BY,USER_STATUS_ID,LEAVE_FUND_GROUP_DATE)
VALUES($emp_id,$plan_id,$equip,$dept,'".$create_date."','".$effectiveDate."',$Modify_count,'".$addby."','".$USER_STATUS_ID."','".$LEAVE_FUND_GROUP_DATE."')";

        $val =  array(
            "emp_id" => $emp_id,
            "plan_id" => $plan_id,
            "dept_rate" => $dept,
            "create_date" =>$create_date
        );



      $ret = DB::insert(DB::raw($sql));

        if($ret){
            Logprocess(2,$val);
        }


//
        return redirect()->to('/changeplan');
    }


    public function getIndexbysearch(Request $request)
    {
        $this->pageSetting( [
            'menu_group_id' => 22,
            'menu_id' => 1,
            'title' => 'แผนการลงทุน MEA FUND'
        ] );


        $numberofchange = $this->getNumofPlan()->TOTAL;
        // saving_rate_change_periodaccess_status_flag
//         var_dump(session()->get('user_data')->fund_plan_change_per_year . "<br/>");
//        var_dump(session()->get('user_data')->current_fund_plan_modify_count);
//access_status_flag

        $sql5 = "SELECT USER_PRIVILEGE_DESC FROM tbl_USER us
INNER JOIN tbl_privilege pi ON pi.USER_PRIVILEGE_ID = us.USER_PRIVILEGE_ID
WHERE us.EMP_ID = '".get_userID()."'";
        $users =  DB::select(DB::raw($sql5))[0];

        $sqlchk = "SELECT * FROM TBL_CONTROL_CFG";
        $dataCheck =  DB::select(DB::raw($sqlchk))[0];

        //history

        $sqlhis = "SELECT uc.MODIFY_COUNT,uc.MODIFY_DATE,uc.EMP_ID,enf.FULL_NAME ,uc.PLAN_ID , pl.PLAN_NAME ,uc.DEBT_RATE
,uc.EQUITY_RATE,uc.EFFECTIVE_DATE, ROW_NUMBER() OVER (ORDER BY uc.MODIFY_DATE DESC) AS rownum
FROM TBL_EMPLOYEE_INFO enf
INNER JOIN TBL_USER_FUND_CHOOSE uc ON uc.EMP_ID = enf.EMP_ID
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PLAN_ID =uc.PLAN_ID
WHERE GETDATE() > pl.PLAN_ACTIVE_DATE AND GETDATE() < pl.PLAN_EXPIRE_DATE AND YEAR(uc.MODIFY_DATE) = '". $request->input('drop_year') ."' AND  enf.EMP_ID ='".get_userID()."'";

        $historyPlan = DB::select(DB::raw($sqlhis));



        $dropplan  = DB::table('TBL_INVESTMENT_PLAN')->where('PLAN_ACTIVE_FLAG','=','0')->get();



        $sql = "SELECT TOP 1  * FROM TBL_USER_FUND_CHOOSE pl
            INNER JOIN TBL_INVESTMENT_PLAN ip ON ip.plan_id = pl.plan_id
            wHERE pl.EMP_ID  =  '".get_userID()."' AND (MONTH(pl.MODIFY_DATE) = MONTH(GETDATe()) AND YEAR(pl.MODIFY_DATE) = YEAR(GETDATE()))
            ORDER BY pl.Modify_DATE DESC";

        $CurrnentPlan = DB::select(DB::raw($sql));


        $sql4 ="SELECT TOP 1  * FROM TBL_USER_FUND_CHOOSE pl
            INNER JOIN TBL_INVESTMENT_PLAN ip ON ip.plan_id = pl.plan_id
            wHERE pl.EMP_ID  =  '".get_userID()."'
            ORDER BY pl.Modify_DATE DESC";
        $effective = DB::select(DB::raw($sql4));


         $currentyear = "2016";

        if($CurrnentPlan){
            $currentyear = get_date_year($CurrnentPlan[0]->MODIFY_DATE);
        }else{

            if($effective){
                $currentyear = get_date_year($effective[0]->MODIFY_DATE);
            }

        }



        $arrDropYear = array();
        $count = 0;
        $ret ="<option>เลือกปี</option>";


        for($i = ((int)$currentyear) - 5; $i <=  $currentyear +1; $i++){
            $arrDropYear[$count] = $i;

            if(($i-543) == (int)$request->input('drop_year')){
                $ret = $ret . "<option selected='selected' value=".($i-543).">".$i."</option>";
            }else{
                $ret = $ret . "<option value=".($i-543).">".$i."</option>";
            }


            $count = $count+1;


        }



        $sql2 = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID  = '".get_userID()."'  ORDER BY Create_DATE DESC";

        $Currnentasset = DB::select(DB::raw($sql2))[0];


        $ishowhis = true;



        $sql44  = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID =  '".get_userID()."' ORDER BY CREATE_DATE DESC";

        $infoaset = DB::select(DB::raw($sql44))[0];


        $sql111 = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        $empinfo = DB::select(DB::raw($sql111))[0];


        $sql222 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $planchoose = DB::select(DB::raw($sql222))[0];


        $Isaccess = true;
        $arrpages = explode("-", $dataCheck->FUND_PLAN_CHANGE_PERIOD);
        $Modify_count = 0;


        $today = new Date();
        $datetoday =  date("d",strtotime($today));

        if($datetoday < $arrpages[0] || $datetoday>$arrpages[1]){
            $Isaccess = false;
        }
//var_dump($dropplan);
        return view('frontend.pages.22p1')->with([
            'dropplan' => $dropplan,
            'CurrnentPlan'=>$CurrnentPlan ,
            'Currnentasset'=>$Currnentasset,
            'historyPlan'=>$historyPlan,
            'dataCheck'=>$dataCheck,
            'effective'=>$effective,
            'users'=>$users,
            'ishowhis'=> $ishowhis,
            'ret'=>$ret ,
            'infoaset'=>$infoaset,
            'empinfo'=>$empinfo,
            'planchoose'=>$planchoose,
            'Isaccess' =>$Isaccess,
            'numberofchange'=>$numberofchange
        ] );
    }


    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 22,
            'menu_id' => 1,
            'title' => 'แผนการลงทุน MEA FUND'
        ] );


        $numberofchange = $this->getNumofPlan()->TOTAL;



        $sql5 = "SELECT USER_PRIVILEGE_DESC FROM tbl_USER us
INNER JOIN tbl_privilege pi ON pi.USER_PRIVILEGE_ID = us.USER_PRIVILEGE_ID
WHERE us.EMP_ID = '".get_userID()."'";
        $users =  DB::select(DB::raw($sql5))[0];

        $sqlchk = "SELECT * FROM TBL_CONTROL_CFG";
        $dataCheck =  DB::select(DB::raw($sqlchk))[0];

        //history

        $sqlhis = "SELECT uc.MODIFY_COUNT,uc.MODIFY_DATE,uc.EMP_ID,enf.FULL_NAME ,uc.PLAN_ID , pl.PLAN_NAME ,uc.DEBT_RATE
,uc.EQUITY_RATE,uc.EFFECTIVE_DATE, ROW_NUMBER() OVER (ORDER BY uc.MODIFY_DATE DESC) AS rownum
FROM TBL_EMPLOYEE_INFO enf
INNER JOIN TBL_USER_FUND_CHOOSE uc ON uc.EMP_ID = enf.EMP_ID
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PLAN_ID =uc.PLAN_ID
WHERE GETDATE() > pl.PLAN_ACTIVE_DATE AND GETDATE() < pl.PLAN_EXPIRE_DATE AND enf.EMP_ID ='".get_userID()."' ";

        $historyPlan = DB::select(DB::raw($sqlhis));



        $dropplan  = DB::table('TBL_INVESTMENT_PLAN')->where('PLAN_ACTIVE_FLAG','=','0')->get();



        $sql = "SELECT TOP 1  * FROM TBL_USER_FUND_CHOOSE pl
            INNER JOIN TBL_INVESTMENT_PLAN ip ON ip.plan_id = pl.plan_id
            wHERE pl.EMP_ID  =  '".get_userID()."' AND (MONTH(pl.MODIFY_DATE) = MONTH(GETDATe()) AND YEAR(pl.MODIFY_DATE) = YEAR(GETDATE()))
            ORDER BY pl.Modify_DATE DESC";

        $CurrnentPlan = DB::select(DB::raw($sql));


        $sql4 ="SELECT TOP 1  * FROM TBL_USER_FUND_CHOOSE pl
            INNER JOIN TBL_INVESTMENT_PLAN ip ON ip.plan_id = pl.plan_id
            wHERE pl.EMP_ID  =  '".get_userID()."'
            ORDER BY pl.Modify_DATE DESC";
        $effective = DB::select(DB::raw($sql4));


        $sql2 = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID  = '".get_userID()."'  ORDER BY Create_DATE DESC";

        $Currnentasset = null;
        $ret = null;
        $infoaset = null;
        $empinfo = null;
        $planchoose = null;
        $Isaccess = null;
        $Currnentasset = DB::select(DB::raw($sql2))[0];




        $currentyear = "2016";

        if($CurrnentPlan){
            $currentyear = get_date_year($CurrnentPlan[0]->MODIFY_DATE);
        }else{
            if($effective){
                $currentyear = get_date_year($effective[0]->MODIFY_DATE);
            }

        }


        $arrDropYear = array();
        $count = 0;
        $ret ="<option selected='selected'>เลือกปี</option>";
        for($i = ((int)$currentyear) - 5; $i <=  $currentyear +1; $i++){
            $arrDropYear[$count] = $i;

            $ret = $ret . "<option value=".($i-543).">".$i."</option>";

            $count = $count+1;

        }

        $sql44  = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID =  '".get_userID()."' ORDER BY CREATE_DATE DESC";

        $infoaset = DB::select(DB::raw($sql44))[0];

        $sql111 = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        $empinfo = DB::select(DB::raw($sql111))[0];


        $sql222 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $planchoose_profile = DB::select(DB::raw($sql222));

        $planchoose = null;
        if($planchoose_profile){
            $planchoose = $planchoose_profile[0];
        }

        $Isaccess = true;
        $arrpages = explode("-", $dataCheck->FUND_PLAN_CHANGE_PERIOD);
        $Modify_count = 0;


        $today = new Date();
        $datetoday =  date("d",strtotime($today));

        if($datetoday < $arrpages[0] || $datetoday>$arrpages[1]){
            $Isaccess = false;
        }

        $q =   "SELECT * FROM TBL_RISK_QUIZ_RESULT WHERe EMP_ID = '".get_userID()."' AND YEAR(QUIZ_TEST_DATE) = YEAR(GETDATE())";

        $quizdoit =DB::select(DB::raw($q));


        return view('frontend.pages.22p1')->with([
            'dropplan' => $dropplan,
            'CurrnentPlan'=>$CurrnentPlan ,
            'Currnentasset'=>$Currnentasset,
            'historyPlan'=>$historyPlan,
            'dataCheck'=>$dataCheck,
            'effective'=>$effective,
            'users'=>$users,
            'ishowhis'=> false,
            'ret'=>$ret,
            'infoaset'=>$infoaset,
            'empinfo'=>$empinfo,
            'planchoose'=>$planchoose,
            'Isaccess'=>$Isaccess,
            'quizdoit' => $quizdoit,
            'numberofchange'=>$numberofchange
        ]);
    }




    public function deleplan(Request $request)
    {

        $sql = "DELETE FROM TBL_USER_FUND_CHOOSE WHERE EMP_ID = '".get_userID()."' AND MONTH(MODIFY_DATE) = MONTH(GETDATE())
AND YEAR(MODIFY_DATE) = YEAR(GETDATE())";

        $ret=  DB::delete(DB::raw($sql));

        //log
        if($ret){
            Logprocess(1);
        }

        return redirect()->to('/changeplan')->with('del2','ok');
    }


    public function  getNumofPlan(){

        $count = "SELECT COUNT(*) AS TOTAL FROM TBL_USER_FUND_CHOOSE WHERE EMP_ID = 1234567  AND YEAR(MODIFY_DATE) = YEAR(GETDATE())";

        return DB::select(DB::raw($count))[0];
    }
}
