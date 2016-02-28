<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package\Curl;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Facades\Excel;

class ProfileController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 20,
            'menu_id' => 1,
            'title' => 'จัดการผู้ใช้'
        ] );

        $sql = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        $empinfo = DB::select(DB::raw($sql))[0];


        $sql2 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $planchoose = DB::select(DB::raw($sql2))[0];


        $sql3 = "SELECT TOP 1 * FROM TBL_USER_SAVING_RATE WHERE EMP_ID = '".get_userID()."' ORDER BY CHANGE_SAVING_RATE_DATE DESC";
        $savingrate = DB::select(DB::raw($sql3))[0];


        $sql4  = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID =  '".get_userID()."' ORDER BY CREATE_DATE DESC";

        $infoaset = DB::select(DB::raw($sql4))[0];


        return view('frontend.pages.overall')->with(['empinfo'=>$empinfo , 'planchoose'=>$planchoose , 'savingrate'=>$savingrate , 'infoaset'=>$infoaset]);
    }
}
