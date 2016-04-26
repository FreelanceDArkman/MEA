<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C53_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 53,
            'menu_id' => 1,
            'title' => getMenuName($data,53,1) . ' | MEA'
        ] );


        //TBL_MENU_GROUP

       // TBL_MENU_LIST

//        $menugroup = DB::table('TBL_MENU_GROUP')->get();

//        $menulist = DB::table('TBL_MENU_LIST')->get();

        return view('backend.pages.c53_1');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 53,
            'menu_id' => 1,
            'title' => getMenuName($data,53,1) . ' | MEA'
        ] );

        $menugroup = DB::table('TBL_MENU_GROUP')->get();
        return view('backend.pages.53_1_add_page')->with(['menugroup'=>$menugroup]);
    }

    public function getEdit($id)
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 53,
            'menu_id' => 1,
            'title' => getMenuName($data,53,1) . ' | MEA'
        ] );

        $menugroup = DB::table('TBL_MENU_GROUP')->get();

        $editdata = DB::table('TBL_NEWS_CATE')->where("NEWS_CATE_ID" ,"=",$id)->get()[0];
        //if(isset($id)) abort(404);
        $menulist = DB::table('TBL_MENU_LIST')->get();

        return view('backend.pages.53_1_edit_page')->with(['editdata'=>$editdata,'menugroup'=>$menugroup,'menulist'=>$menulist]);
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

        $returnHTML = view('backend.pages.ajax.ajax_53_1')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function Ajax_menulist(Request $request){

        $menulist = DB::table('TBL_MENU_LIST')->where("MENU_GROUP_ID","=",$request->input('MENU_GROUP_ID'))->get();

        $data = array();

        if($menulist){

            foreach($menulist as $index => $item){
                $data[$index] = array(
                    'MENU_ID'=> $item->MENU_ID,
                    'MENU_NAME'=>$item->MENU_NAME

                );
            }

        }


        return response()->json(array('success' => true, 'html'=>$data));
    }

    public  function  getCountAll(){

        return DB::table('TBL_NEWS_CATE')->orderby("NEWS_CATE_FLAG")->get();
    }
    public  function  getData($ArrParam){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $query =  "SELECT * FROM TBL_NEWS_CATE ORDER BY NEWS_CATE_FLAG,NEWS_CATE_ID  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
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
                    'NEWS_CATE_FLAG' => 1

                );


                $deleted =  DB::table('TBL_NEWS_CATE')->where('NEWS_CATE_ID',"=",$item)->update($data);
            }

        }


        if($deleted)  {
            return response()->json(["ret" => "1"]);
        }else{
            return response()->json(["ret" => "0"]);
        }

            //return redirect()->action('UserGroupController@userGroups');

//        if($request->ajax())
//        {
//            $user_group_exist = UserGroup::UserGroupExist($request->input('group_id'))->first();
//            if(!$user_group_exist) return response()->json(["errors" => "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้"]);
//
//            else return response()->json(["errors" => "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้"]);
//        }
//        return response()->json(["errors" => "ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้"]);
    }








    public function postAdd(Request $request)
    {

        $ret = false;


        $datestart  = new Date($request["START_DATE"]);
       $datereq = $request["EXPIRE_DATE"];
        if($request["EXPIRE_DATE"] == ""){
            $datereq = "9999-12-31 00:00:00.000";
        }
        $dateEnd =  new Date($datereq);
        $today = new Date();
        $data = array();
        array_push($data,array(
            'NEWS_CATE_ID' => $request["NEWS_CATE_ID"],
            'NEWS_CATE_NAME' =>$request["NEWS_CATE_NAME"],
            'NEWS_CATE_FLAG' => $request["NEWS_CATE_FLAG"],
            'START_DATE' => $datestart,
            'EXPIRE_DATE' => $dateEnd,
            'MENU_GROUP_ID' => $request["MENU_GROUP_ID"],
            'MENU_ID' => $request["MENU_ID"],
            'CREATE_DATE' =>$today,
            'CREATE_BY'=>"Admin"

        ));


        $chk = "SELECT COUNT(NEWS_CATE_ID) As total FROM TBL_NEWS_CATE WHERE NEWS_CATE_ID = ".$request["NEWS_CATE_ID"];
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;

        $rethtml = "";



       if($total > 0){
           $rethtml = "news_cate_id ที่ท่านเลือกมีอยู่ในระบบแล้ว";

       }else{
           $insert = DB::table('TBL_NEWS_CATE')->insert($data);

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


        $datestart  = new Date($request["START_DATE"]);
        $datereq = $request["EXPIRE_DATE"];
        if($request["EXPIRE_DATE"] == ""){
            $datereq = "9999-12-31 00:00:00.000";
        }
        $dateEnd =  new Date($datereq);
        $today = new Date();
        $data = array(
            'NEWS_CATE_ID' => $request["NEWS_CATE_ID"],
            'NEWS_CATE_NAME' =>$request["NEWS_CATE_NAME"],
            'NEWS_CATE_FLAG' => $request["NEWS_CATE_FLAG"],
            'START_DATE' => $datestart,
            'EXPIRE_DATE' => $dateEnd,
            'MENU_GROUP_ID' => $request["MENU_GROUP_ID"],
            'MENU_ID' => $request["MENU_ID"],
            'CREATE_DATE' =>$today,
            'CREATE_BY'=>"Admin"

        );



        $update = DB::table('TBL_NEWS_CATE')->where('NEWS_CATE_ID',"=",$request["NEWS_CATE_ID"])->update($data);


        $ret = $update;



        return response()->json(array('success' => $ret, 'html'=>'OK'));


    }


}
