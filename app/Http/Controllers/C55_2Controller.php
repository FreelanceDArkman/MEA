<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C55_2Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 55,
            'menu_id' => 2,
            'title' => getMenuName($data,55,2) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_FAQ_CATE')->where('FAQ_CATE_FLAG' ,'=',  0)->get();
        return view('backend.pages.c55_2');
    }




    public function getreply($id)
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 55,
            'menu_id' => 2,
            'title' => getMenuName($data,55,2) . ' | MEA'
        ] );




        //if(isset($id)) abort(404);
        $Topicdata = DB::table('TBL_INFORM')->where("INFM_ID" ,"=",$id)->get()[0];



        return view('backend.pages.55_2_reply_page')->with(['Topicdata'=>$Topicdata]);
    }
    public function getforward($id)
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 55,
            'menu_id' => 2,
            'title' => getMenuName($data,55,2) . ' | MEA'
        ] );


        //if(isset($id)) abort(404);
        $Topicdata = DB::table('TBL_INFORM')->where("INFM_ID" ,"=",$id)->get()[0];



        return view('backend.pages.55_2_forward_page')->with(['Topicdata'=>$Topicdata]);
    }


    public  function Ajax_Index(Request $request){

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');
        $NEWS_CATE_ID = $request->input('NEWS_CATE_ID');
        $NEWS_TOPIC_FLAG = $request->input('NEWS_TOPIC_FLAG');

        $ArrParam["pagesize"] =$PageSize;
        $ArrParam["PageNumber"] =$PageNumber;
        $ArrParam["NEWS_CATE_ID"] =$NEWS_CATE_ID;
        $ArrParam["NEWS_TOPIC_FLAG"] =$NEWS_TOPIC_FLAG;

        $Datacount = $this->getCountAll($ArrParam);
        $Data = $this->getData($ArrParam);

        $totals = count($Datacount);

        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click_search',$PageNumber);

        $returnHTML = view('backend.pages.ajax.ajax_55_2')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


    public  function  getCountAll($ArrParam){
        $NEWS_CATE_ID = $ArrParam["NEWS_CATE_ID"];
        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];

        if($NEWS_CATE_ID != ""){
            return DB::table('TBL_INFORM')->where("INFM_TOPIC","LIKE",$NEWS_CATE_ID)->where("INFM_FLAG","=",$NEWS_TOPIC_FLAG)->get();
        }
        else{
            return DB::table('TBL_INFORM')->where("INFM_FLAG","=",$NEWS_TOPIC_FLAG)->get();
        }

    }
    public  function  getData($ArrParam){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];
        $NEWS_CATE_ID = $ArrParam["NEWS_CATE_ID"];
        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];

//        var_dump($NEWS_CATE_ID);
//        var_dump($NEWS_CATE_ID);
        $query = "";
        if($NEWS_CATE_ID != ""){

            $query =  "SELECT * FROM TBL_INFORM nt WHERE nt.INFM_TOPIC LIKE '%".$NEWS_CATE_ID."%' AND nt.INFM_FLAG = '".$NEWS_TOPIC_FLAG."'  ORDER BY nt.INFM_DATE DESC  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }else{
            $query =  "SELECT * FROM TBL_INFORM nt WHERE  nt.INFM_FLAG = '".$NEWS_TOPIC_FLAG."' ORDER BY nt.INFM_DATE DESC  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }


        return DB::select(DB::raw($query));
    }



    public  function SendReply(Request $request){




        $INFM_ID =  $request->input("INFM_ID");

        $INFM_EMAIL =  $request->input("INFM_EMAIL");
        $INFM_topic =  $request->input("INFM_topic");
        $Detail =  $request->input("Detail");
        $REMARK =  $request->input("REMARK");

        $admin = get_username();

        $today = new Date();

        $data = array(
            'name' => $Detail,
        );

        \Mail::send('email.welcome', $data, function ($message) use($INFM_topic,$INFM_EMAIL) {

            $message->from('oh_darkman@hotmail.com', 'MEA ADMIN');

            $message->to($INFM_EMAIL)->subject($INFM_topic);

        });



        $data = array(
            'REPLY_DATE' => $today,
            'REPLY_BY' =>$admin,
            'INFM_FLAG' => 2,
            'REMARK' => $REMARK
        );



        $ret = DB::table('TBL_INFORM')->where('INFM_ID',"=",$INFM_ID)->update($data);


        return response()->json(array('success' => true, 'html'=> 'ok' ));
    }

    public function SendForward(Request $request){




        $INFM_ID =  $request->input("INFM_ID");

        $INFM_EMAIL =  $request->input("INFM_EMAIL");
        $INFM_topic =  $request->input("INFM_topic");
        $Detail =  $request->input("Detail");
        $REMARK =  $request->input("REMARK");

        $admin = get_username();

        $today = new Date();

        $data = array(
            'name' => $Detail,
        );

        \Mail::send('email.welcome', $data, function ($message) use($INFM_topic,$INFM_EMAIL) {

            $message->from('oh_darkman@hotmail.com', 'MEA ADMIN');

            $message->to($INFM_EMAIL)->subject($INFM_topic);

        });



        $data = array(

            'INFM_FLAG' => 1,
            'REMARK' => $REMARK
        );



        $ret = DB::table('TBL_INFORM')->where('INFM_ID',"=",$INFM_ID)->update($data);


        return response()->json(array('success' => true, 'html'=> 'ok' ));
    }



}
