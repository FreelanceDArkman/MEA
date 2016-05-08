<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C57_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 57,
            'menu_id' => 1,
            'title' => getMenuName($data,57,1) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c57_1');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 57,
            'menu_id' => 1,
            'title' => getMenuName($data,57,1) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c57_1_add');
    }

        public  function  getSearch(Request $request){

            $drop_month_start=$request->input('drop_month_start');
            $drop_year_start=$request->input('drop_year_start');
            $drop_month_end=$request->input('drop_month_end');
            $drop_year_end=$request->input('drop_year_end');



            $query =  "SELECT ss.REFERENCE_DATE,po1.NAV_UNIT as NAV_UNIT_1,po1.NAV as NAV_1,po1.RETURN_RATE as RETURN_RATE_1
,po2.NAV_UNIT as NAV_UNIT_2,po2.NAV as NAV_2,po2.RETURN_RATE as RETURN_RATE_2,po1.CREATE_DATE AS CREATE_DATE_1,po2.CREATE_DATE as CREATE_DATE_2 FROM TBL_FUND_SIZE ss OUTER APPLY (SELECT * FROM TBL_FUND_SIZE st WHERE ss.REFERENCE_DATE = st.REFERENCE_DATE AND  st.POLICY_ID = 1) As po1 OUTER APPLY (
SELECT * FROM TBL_FUND_SIZE st WHERE ss.REFERENCE_DATE = st.REFERENCE_DATE AND  st.POLICY_ID = 2) As po2
WHERe MONTH(ss.REFERENCE_DATE) BETWEEN ".$drop_month_start." AND ".$drop_month_end." AND YEAR(ss.REFERENCE_DATE) BETWEEN ".$drop_year_start." AND ".$drop_year_end." GROUP BY ss.REFERENCE_DATE,po1.NAV_UNIT,po1.NAV,po1.RETURN_RATE,po2.NAV_UNIT,po2.NAV,po2.RETURN_RATE,po1.CREATE_DATE,po2.CREATE_DATE";

           $data= DB::select(DB::raw($query));


            $returnHTML = view('backend.pages.ajax.ajax_57_1')->with([

                'data'=>$data

            ])->render();

            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }

    public  function  Navsave(Request $request){
        $ret = false;

        $data = array();

        $drop_day=$request->input('drop_day');
        $drop_month=$request->input('drop_month');
        $drop_year=$request->input('drop_year');
        $NAV_UNIT_1=$request->input('NAV_UNIT_1');
        $NAV_1=$request->input('NAV_1');
        $RETURN_RATE_1=$request->input('RETURN_RATE_1');
        $NAV_UNIT_2=$request->input('NAV_UNIT_2');
        $NAV_2=$request->input('NAV_2');
        $RETURN_RATE_2=$request->input('RETURN_RATE_2');


        $REFERENCE_DATE =  new Date($drop_year."-".$drop_month."-".$drop_day);

            $today = new Date();


        array_push($data,array(
            'POLICY_ID' => 1,
            'NAV_UNIT' =>$NAV_UNIT_1,
            'NAV' => $NAV_1,
            'RETURN_RATE' => $RETURN_RATE_1,
            'REFERENCE_DATE'=>$REFERENCE_DATE,
            'CREATE_DATE'=>$today,
            'CREATE_BY'=>'Admin'
        ));
        array_push($data,array(
            'POLICY_ID' => 2,
            'NAV_UNIT' =>$NAV_UNIT_2,
            'NAV' => $NAV_2,
            'RETURN_RATE' => $RETURN_RATE_2,
            'REFERENCE_DATE'=>$REFERENCE_DATE,
            'CREATE_DATE'=>$today,
            'CREATE_BY'=>'Admin'
        ));

        $ret = DB::table('TBL_FUND_SIZE')->insert($data);




        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }




    public function editsave(Request $request){
        $ret = false;

        $data = array();

        $key =$request->input('key');
        $drop_day=$request->input('drop_day');
        $drop_month=$request->input('drop_month');
        $drop_year=$request->input('drop_year');
        $NAV_UNIT_1=$request->input('NAV_UNIT_1');
        $NAV_1=$request->input('NAV_1');
        $RETURN_RATE_1=$request->input('RETURN_RATE_1');
        $NAV_UNIT_2=$request->input('NAV_UNIT_2');
        $NAV_2=$request->input('NAV_2');
        $RETURN_RATE_2=$request->input('RETURN_RATE_2');


        $REFERENCE_DATE =  new Date($drop_year."-".$drop_month."-".$drop_day);

        $today = new Date();


        $data1 = array(
            'POLICY_ID' => 1,
            'NAV_UNIT' =>$NAV_UNIT_1,
            'NAV' => $NAV_1,
            'RETURN_RATE' => $RETURN_RATE_1,
            'REFERENCE_DATE'=>$REFERENCE_DATE


        );

        $data2 = array(
            'POLICY_ID' => 2,
            'NAV_UNIT' =>$NAV_UNIT_2,
            'NAV' => $NAV_2,
            'RETURN_RATE' => $RETURN_RATE_2,
            'REFERENCE_DATE'=>$REFERENCE_DATE


        );

        $ret = DB::table('TBL_FUND_SIZE')->where('REFERENCE_DATE ',"=",$key)->where('POLICY_ID','=','1')->update($data1);
        $ret = DB::table('TBL_FUND_SIZE')->where('REFERENCE_DATE ',"=",$key)->where('POLICY_ID','=','2')->update($data2);






        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }


    public  function  deletenav(Request $request){

        $ret = false;

        $REFERENCE_DATE =  $request->input("key");




        $ret =   DB::table('TBL_FUND_SIZE')->where('REFERENCE_DATE',"=",$REFERENCE_DATE)->delete();

        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }

}
