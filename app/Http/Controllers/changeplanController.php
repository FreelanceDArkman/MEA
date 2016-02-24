<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class changeplanController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 22,
            'menu_id' => 1,
            'title' => 'จัดการผู้ใช้'
        ] );


//        SELECT * FROM TBL_USER_FUND_CHOOSE wHERE EMP_ID  = 1234567
//
//
//SELECT * FROM TBL_INVESTMENT_PLAN
//
//SELECT * FROM TBL_CONTROL_CFG

        //select dropdown
        $dropplan  = DB::table('TBL_INVESTMENT_PLAN')->where('PLAN_ACTIVE_FLAG','=','0')->get();



      $sql = "SELECT TOP 1  * FROM TBL_USER_FUND_CHOOSE pl
            INNER JOIN TBL_INVESTMENT_PLAN ip ON ip.plan_id = pl.plan_id
            wHERE pl.EMP_ID  =  '".get_userID()."' AND MONTH(pl.EFFECTIVE_DATE) = MONTH(GETDATe())
            ORDER BY pl.Modify_count_timestamp DESC";

        $CurrnentPlan = DB::select(DB::raw($sql))[0];



        $sql2 = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID  = 1234567  ORDER BY Create_DATE DESC";

        $Currnentasset = DB::select(DB::raw($sql2))[0];





//var_dump($dropplan);
        return view('frontend.pages.22p1')->with(['dropplan' => $dropplan, 'CurrnentPlan'=>$CurrnentPlan , 'Currnentasset'=>$Currnentasset]);
    }
}
