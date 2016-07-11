<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C52_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 52,
            'menu_id' => 1,
            'title' => getMenuName($data,52,1) . ' | MEA'
        ] );


        return view('backend.pages.c52_1');
    }


    public  function Ajax_Index(Request $request){

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');

        $ArrParam["pagesize"] =$PageSize;
        $ArrParam["PageNumber"] =$PageNumber;

        $Datacount = $this->getCountAll();
        $Data = $this->getData($ArrParam);

        $totals = count($Datacount);

        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click_search',$PageNumber);

        $returnHTML = view('backend.pages.ajax.ajax_52_1')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public  function  getCountAll(){

        return DB::table('TBL_INVESTMENT_PLAN')->orderby("PLAN_ACTIVE_FLAG")->get();
    }
    public  function  getData($ArrParam){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $query =  "SELECT * FROM TBL_INVESTMENT_PLAN ORDER BY PLAN_ACTIVE_FLAG  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        return DB::select(DB::raw($query));
    }



    public function delete(Request $request)
    {
        $deleted = false;
        $arrId = explode(',',$request->input('group_id'));


//        var_dump($request["plan_id"]);
        foreach($arrId as $index => $item){

            if($item != ""){
                $data = array(
                    'PLAN_ACTIVE_FLAG' => 1

                );


                $deleted =  DB::table('TBL_INVESTMENT_PLAN')->where('PLAN_ID',"=",$item)->update($data);
            }

        }

        if($deleted)  {
            return response()->json(["ret" => "1"]);
        }else{
            return response()->json(["ret" => "0"]);
        }


    }



    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 52,
            'menu_id' => 1,
            'title' => getMenuName($data,52,1) . ' | MEA'
        ] );


        return view('backend.pages.add_page');
    }

    public function getEdit($id)
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 52,
            'menu_id' => 1,
            'title' => getMenuName($data,52,1) . ' | MEA'
        ] );


        $editdata = DB::table('TBL_INVESTMENT_PLAN')->where("PLAN_ID" ,"=",$id)->get()[0];
        //if(isset($id)) abort(404);


        return view('backend.pages.edit_page')->with(['editdata'=>$editdata]);
    }




    public function postAdd(Request $request)
    {

        $ret = false;


        $datestart  = new Date($request["plan_start"]);
       $datereq = $request["plan_end"];
        if($request["plan_end"] == ""){
            $datereq = "9999-12-31 00:00:00.000";
        }
        $dateEnd =  new Date($datereq);
        $today = new Date();
        $data = array();
        array_push($data,array(
            'PLAN_ID' => $request["plan_id"],
            'PLAN_NAME' =>$request["plan_name"],
            'PLAN_ACTIVE_FLAG' => $request["plan_status"],
            'PLAN_ACTIVE_DATE' => $datestart,
            'PLAN_EXPIRE_DATE' => $dateEnd,
            'EQUITY_MIN_PERCENTAGE' => $request["EQUITY_MIN"],
            'EQUITY_MAX_PERCENTAGE' =>$request["EQUITY_MAX"],
            'DEBT_MIN_PERCENTAGE' => $request["DEBT_MIN"],
            'DEBT_MAX_PERCENTAGE' => $request["DEBT_MAX"],
            'CREATE_DATE' =>$today,
            'CREATE_BY'=>"Admin"


        ));


        $chk = "SELECT COUNT(PLAN_ID) As total FROM TBL_INVESTMENT_PLAN WHERE PLAN_ID = ".$request["plan_id"];
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;

        $rethtml = "";



       if($total > 0){
           $rethtml = "Plan id ที่ท่านเลือกมีอยู่ในระบบแล้ว";

       }else{
           $insert = DB::table('TBL_INVESTMENT_PLAN')->insert($data);

           $ret = $insert;
       }







        return response()->json(array('success' => $ret, 'html'=>$rethtml));

//        if($insert) {
//            return redirect()->action('UserGroupController@userGroups');
//        } else {
//            return redirect()->action('UserGroupController@getAddUserGroup')->with('submit_errors', 'ไม่สามารถเพิ่มข้อมูลกลุ่มผู้ใช้ได้');
//        }

    }



    public function postEdit(Request $request)
    {
        $ret = false;


        $datestart  = new Date($request["plan_start"]);
        $datereq = $request["plan_end"];
        if($request["plan_end"] == ""){
            $datereq = "9999-12-31 00:00:00.000";
        }
        $dateEnd =  new Date($datereq);
        $today = new Date();
        $data = array(

            'PLAN_NAME' =>$request["plan_name"],
            'PLAN_ACTIVE_FLAG' => $request["plan_status"],
            'PLAN_ACTIVE_DATE' => $datestart,
            'PLAN_EXPIRE_DATE' => $dateEnd,
            'EQUITY_MIN_PERCENTAGE' => $request["EQUITY_MIN"],
            'EQUITY_MAX_PERCENTAGE' =>$request["EQUITY_MAX"],
            'DEBT_MIN_PERCENTAGE' => $request["DEBT_MIN"],
            'DEBT_MAX_PERCENTAGE' => $request["DEBT_MAX"],

            'CREATE_BY'=>"Admin"


        );







        $update = DB::table('TBL_INVESTMENT_PLAN')->where('PLAN_ID',"=",$request["plan_id"])->update($data);


        $ret = $update;



        return response()->json(array('success' => $ret, 'html'=>'OK'));


    }


}
