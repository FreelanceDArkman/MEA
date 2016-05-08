<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C59_3Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 59,
            'menu_id' => 3,
            'title' => getMenuName($data,59,3) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c59_3');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 59,
            'menu_id' => 3,
            'title' => getMenuName($data,57,3) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c57_1_add');
    }

    public  function  getSearch(Request $request){





            $query =  "SELECT * FROM TBL_CONTROL_CFG";

           $data= DB::select(DB::raw($query));


            $returnHTML = view('backend.pages.ajax.ajax_59_3')->with([

                'data'=>$data

            ])->render();

            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }





    public function editsave(Request $request){
        $ret = false;

        $data = array();

        $CONTROL_ID=$request->input('CONTROL_ID');
        $WEB_NEWS_ROOT_PATH=$request->input('WEB_NEWS_ROOT_PATH');
        $WS_BENEFICIARY_ROOT_PATH=$request->input('WS_BENEFICIARY_ROOT_PATH');
        $WEB_BENEFICIARY_ROOT_PATH=$request->input('WEB_BENEFICIARY_ROOT_PATH');




        $data = array(

            'WEB_NEWS_ROOT_PATH' =>$WEB_NEWS_ROOT_PATH,
            'WS_BENEFICIARY_ROOT_PATH' => $WS_BENEFICIARY_ROOT_PATH,
            'WEB_BENEFICIARY_ROOT_PATH' => $WEB_BENEFICIARY_ROOT_PATH
        );

        $ret = DB::table('TBL_CONTROL_CFG')->where('CONTROL_ID ',"=",$CONTROL_ID)->update($data);


        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }




}
