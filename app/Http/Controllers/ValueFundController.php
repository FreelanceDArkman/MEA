<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ValueFundController extends Controller
{


    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );


        $sql = "SELECT TOP 2 * FROM TBL_FUND_SIZE WHERE policy_id IN (1,2) ORDER BY REFERENCE_DATE DESC, POLICY_ID";
        $FUNDSIZE = DB::select(DB::raw($sql));

        return view('frontend.pages.1p1')->with(['FUNDSIZE' => $FUNDSIZE]);
    }




    public function getRows()
    {
        //return DB::table('TBL_USER')->skip(10)->take(5)->where('USER_PRIVILEGE_ID',0)->get();

        $sql = "SELECT TOP 5 * FROM TBL_USER";
        return DB::select(DB::raw($sql));
    }

}
