<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C59_4Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 59,
            'menu_id' => 4,
            'title' => getMenuName($data,59,4) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c59_4');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 59,
            'menu_id' => 4,
            'title' => getMenuName($data,57,4) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c57_1_add');
    }

    public  function  getSearch(Request $request){





            $query =  "SELECT * FROM TBL_CONTROL_CFG";

           $data= DB::select(DB::raw($query));


            $returnHTML = view('backend.pages.ajax.ajax_59_4')->with([

                'data'=>$data

            ])->render();

            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }





    public function editsave(Request $request){
        $ret = false;

        $data = array();


//        FUND_PLAN_TIME_CHANGE_PER_YEAR:FUND_PLAN_TIME_CHANGE_PER_YEAR,
//                        FUND_PLAN_CHANGE_PERIOD:FUND_PLAN_CHANGE_PERIOD,
//                        SAVING_RATE_TIME_CHANGE_PER_MONTH:SAVING_RATE_TIME_CHANGE_PER_MONTH,
//                        SAVING_RATE_CHANGE_PERIOD:SAVING_RATE_CHANGE_PERIOD

        $CONTROL_ID=$request->input('CONTROL_ID');
        $FUND_PLAN_TIME_CHANGE_PER_YEAR=$request->input('FUND_PLAN_TIME_CHANGE_PER_YEAR');
        $FUND_PLAN_CHANGE_PERIOD=$request->input('FUND_PLAN_CHANGE_PERIOD');
        $SAVING_RATE_TIME_CHANGE_PER_MONTH=$request->input('SAVING_RATE_TIME_CHANGE_PER_MONTH');
          $SAVING_RATE_CHANGE_PERIOD=$request->input('SAVING_RATE_CHANGE_PERIOD');




        $data = array(

            'FUND_PLAN_TIME_CHANGE_PER_YEAR' =>$FUND_PLAN_TIME_CHANGE_PER_YEAR,
            'FUND_PLAN_CHANGE_PERIOD' => $FUND_PLAN_CHANGE_PERIOD,
            'SAVING_RATE_TIME_CHANGE_PER_MONTH' => $SAVING_RATE_TIME_CHANGE_PER_MONTH,
            'SAVING_RATE_CHANGE_PERIOD' =>$SAVING_RATE_CHANGE_PERIOD
        );

        $ret = DB::table('TBL_CONTROL_CFG')->where('CONTROL_ID ',"=",$CONTROL_ID)->update($data);


        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }




}
