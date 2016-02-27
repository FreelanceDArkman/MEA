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



        $create_date = new Date();
        $dateCurrentModify = new Date($request->input('date_modify'));
        $datenextmont = date("Y-m-d H:i:s",strtotime('+1 month'));
        $currentCount = $request->input('count_modify');

        $Modify_count = 0;

        if(date("m",strtotime($create_date)) == date("m",strtotime($dateCurrentModify)) && date("Y",strtotime($create_date)) == date("Y",strtotime($dateCurrentModify))){
            $Modify_count = $request->input('count_modify');
        }else{
            $Modify_count = $request->input('count_modify') + 1;
        }

        $effectiveDate = New Date(date("Y",strtotime($datenextmont))."-".date("m",strtotime($datenextmont))."-1");
        $emp_id =  get_userID();
        $plan_id =   $request->input('TYPE_TOPIC');
        $equip =   $request->input('maxVal1');
        $dept =   $request->input('maxVal2');


        $sql = "INSERT INTO TBL_USER_FUND_CHOOSE (EMP_ID,PLAN_ID,EQUITY_RATE,DEBT_RATE,MODIFY_DATE,EFFECTIVE_DATE,MODIFY_COUNT)
VALUES($emp_id,$plan_id,$equip,$dept,'".$create_date."','".$effectiveDate."',$Modify_count)";

       DB::insert(DB::raw($sql));
//
        return redirect()->to('/changeplan');
    }



    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 22,
            'menu_id' => 1,
            'title' => 'จัดการผู้ใช้'
        ] );


        //history

        $sqlhis = "SELECT uc.MODIFY_COUNT,uc.MODIFY_DATE,uc.EMP_ID,enf.FULL_NAME ,uc.PLAN_ID , pl.PLAN_NAME ,uc.DEBT_RATE
,uc.EQUITY_RATE,uc.EFFECTIVE_DATE, ROW_NUMBER() OVER (ORDER BY uc.MODIFY_DATE DESC) AS rownum
FROM TBL_EMPLOYEE_INFO enf
INNER JOIN TBL_USER_FUND_CHOOSE uc ON uc.EMP_ID = enf.EMP_ID
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PLAN_ID =uc.PLAN_ID
WHERE enf.EMP_ID ='".get_userID()."'";

        $historyPlan = DB::select(DB::raw($sqlhis));



        $dropplan  = DB::table('TBL_INVESTMENT_PLAN')->where('PLAN_ACTIVE_FLAG','=','0')->get();



        $sql = "SELECT TOP 1  * FROM TBL_USER_FUND_CHOOSE pl
            INNER JOIN TBL_INVESTMENT_PLAN ip ON ip.plan_id = pl.plan_id
            wHERE pl.EMP_ID  =  '".get_userID()."' AND (MONTH(pl.EFFECTIVE_DATE) = MONTH(GETDATe()) AND YEAR(pl.EFFECTIVE_DATE) = YEAR(GETDATE()))
            ORDER BY pl.Modify_count_timestamp DESC";

        $CurrnentPlan = DB::select(DB::raw($sql))[0];



        $sql2 = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID  = '".get_userID()."'  ORDER BY Create_DATE DESC";

        $Currnentasset = DB::select(DB::raw($sql2))[0];





//var_dump($dropplan);
        return view('frontend.pages.22p1')->with(['dropplan' => $dropplan, 'CurrnentPlan'=>$CurrnentPlan , 'Currnentasset'=>$Currnentasset, 'historyPlan'=>$historyPlan]);
    }
}
