<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class ValueFundController extends Controller
{


    public function getIndex(Request $request)
    {
        $this->pageSetting( [
            'title' => 'มูลค่ากองทุน | MEA FUND'
        ] );


        $showsearch = false;

        $sql = "SELECT * FROM TBL_FUND_SIZE WHERE policy_id IN (1,2) ORDER BY REFERENCE_DATE DESC, POLICY_ID";
        $FUNDSIZE = DB::select(DB::raw($sql));

        $sql2 = "SELECT DISTINCT(REFERENCE_DATE) AS dateref FROM TBL_FUND_SIZE ORDER BY REFERENCE_DATE DESC";
        if($request->input('drop_year') != null){
            $showsearch = true;
            $sql2 = "SELECT DISTINCT(REFERENCE_DATE) AS dateref FROM TBL_FUND_SIZE WHERE YEAR(REFERENCE_DATE) = ".$request->input('drop_year')." ORDER BY REFERENCE_DATE DESC";
        }

        $sqlAll = "SELECT DISTINCT(REFERENCE_DATE) AS dateref FROM TBL_FUND_SIZE ORDER BY REFERENCE_DATE DESC";
        $FUNDSIZErefAll = DB::select(DB::raw($sqlAll));
        $FUNDSIZEref = DB::select(DB::raw($sql2));




        //Generate Drop
        $colObj = collect($FUNDSIZErefAll);
        $max = null;
        $min = null;
        $max = $colObj->max('dateref');
        $min = $colObj->min('dateref');


        $dateMin = new Date($min);
        $dateMax = new Date($max);


        $yearMin = date("Y",strtotime($dateMin));
        $yearMax = date("Y",strtotime($dateMax));



        $intYearhMin =  intval($yearMin) + 543;
        $intYearhMax= intval($yearMax) + 543;

        $arrDropYear = array();
        $count = 0;
        $ret ="<option value='1990'>เลือกปี</option>";


        for($i = $intYearhMin; $i <= $intYearhMax; $i++){
            $arrDropYear[$count] = $i;

            if(($i-543) == (int)$request->input('drop_year')){
                $ret = $ret . "<option selected='selected' value=".($i-543).">".$i."</option>";
            }else{
                $ret = $ret . "<option value=".($i-543).">".$i."</option>";
            }


            $count = $count+1;


        }




        return view('frontend.pages.1p1')->with(['FUNDSIZE' => $FUNDSIZE,'FUNDSIZEref' => $FUNDSIZEref, 'ret'=>$ret , 'showsearch'=>$showsearch]);

    }




    public function getRows()
    {
        //return DB::table('TBL_USER')->skip(10)->take(5)->where('USER_PRIVILEGE_ID',0)->get();

        $sql = "SELECT TOP 5 * FROM TBL_USER";
        return DB::select(DB::raw($sql));
    }

}
