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


        $sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $netasset2 = DB::select(DB::raw($sql2));
        Excel::create('New file', function($excel) use ($netasset2){

            $excel->sheet('New sheet', function($sheet)use ($netasset2) {

                $sheet->loadView('frontend.exels.21')->with(['netasset2' => $netasset2]);

            });

        })->download('xls');







//var_dump($dropplan);
        return view('frontend.pages.22p1')->with(['dropplan' => $dropplan]);
    }
}
