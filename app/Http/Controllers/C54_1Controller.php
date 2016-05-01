<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C54_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 54,
            'menu_id' => 1,
            'title' => getMenuName($data,54,1) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c54_1');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 54,
            'menu_id' => 1,
            'title' => getMenuName($data,54,1) . ' | MEA'
        ] );


        return view('backend.pages.54_1_add_page');
    }

    public function getEdit($id)
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 54,
            'menu_id' => 1,
            'title' => getMenuName($data,54,1) . ' | MEA'
        ] );



        //if(isset($id)) abort(404);
        $Topicdata = DB::table('TBL_FAQ_CATE')->where("FAQ_CATE_ID" ,"=",$id)->get()[0];



        return view('backend.pages.54_1_edit_page')->with(['Topicdata'=>$Topicdata]);
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

        $returnHTML = view('backend.pages.ajax.ajax_54_1')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


    public  function  getCountAll($ArrParam){
        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];

        return DB::table('TBL_FAQ_CATE')->where('FAQ_CATE_FLAG','=', $NEWS_TOPIC_FLAG)->get();

    }
    public  function  getData($ArrParam){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];



        $query =  "SELECT * FROM TBL_FAQ_CATE nt WHERE FAQ_CATE_FLAG = ".$NEWS_TOPIC_FLAG." ORDER BY nt.CREATE_DATE DESC  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";


        return DB::select(DB::raw($query));
    }



    public function delete(Request $request)
    {
        $deleted = false;
        $arrId = explode(':',$request->input('group_id'));


//        var_dump($request["plan_id"]);
        foreach($arrId as $index => $item){

            if($item != ""){



                $data = array(
                    'FAQ_CATE_FLAG' => 1

                );



                $deleted =  DB::table('TBL_FAQ_CATE')->where('FAQ_CATE_ID',"=",$item)->update($data);
            }

        }


        if($deleted)  {
            return response()->json(["ret" => "1"]);
        }else{
            return response()->json(["ret" => "0"]);
        }


    }








    public function postAdd(Request $request)
    {

        $ret = false;
        $rethtml = "";


        $FAQ_CATE_ID =  $request->input("FAQ_CATE_ID");
        $FAQ_CATE_NAME = $request->input("FAQ_CATE_NAME");


        $FAQ_CATE_FLAG = $request->input("FAQ_CATE_FLAG");

        $START_DATE= $request->input("START_DATE");
        $EXPIRE_DATE = $request->input("EXPIRE_DATE");
        $FAQ_CATE_KEYWORD = $request->input("FAQ_CATE_KEYWORD");

        $FAQ_CONTACT_DEPT = $request->input("FAQ_CONTACT_DEPT");
        $FAQ_CONTACT_PHONE = $request->input("FAQ_CONTACT_PHONE");





        $chk = "SELECT COUNT(FAQ_CATE_ID) As total FROM TBL_FAQ_CATE WHERE FAQ_CATE_ID = ".$FAQ_CATE_ID ;
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;


        if($total > 0){

            $rethtml = "รหัสหมวดหมู่ ที่ท่านเลือกมีอยู่ในระบบแล้ว";

        }else{



            $datestart = new Date('2000-1-1 00:00:00.000') ;
            $dateEnd = new Date('9999-12-31 00:00:00.000') ;


            if($START_DATE != ""){
                $datestart = new Date($START_DATE);
            }

            if($EXPIRE_DATE != ""){
                $dateEnd = new Date($EXPIRE_DATE);
            }


            $today = new Date();
            $data = array('FAQ_CATE_ID' => $FAQ_CATE_ID,
                'FAQ_CATE_NAME' =>$FAQ_CATE_NAME,
                'FAQ_CATE_FLAG' => $FAQ_CATE_FLAG,
                'START_DATE' => $datestart,
                'EXPIRE_DATE' => $dateEnd,
                'FAQ_CATE_KEYWORD' =>$FAQ_CATE_KEYWORD,
                'FAQ_CONTACT_DEPT' => $FAQ_CONTACT_DEPT,
                'FAQ_CONTACT_PHONE' => $FAQ_CONTACT_PHONE,
                'CREATE_DATE' =>$today,
                'CREATE_BY'=>"Admin"
                );




            $ret = DB::table('TBL_FAQ_CATE')->insert($data);
        }




        return response()->json(array('success' => $ret, 'html'=> $rethtml ));






    }



    public function postEdit(Request $request)
    {
        $ret = false;
        $rethtml = "";


        $FAQ_CATE_ID =  $request->input("FAQ_CATE_ID");
        $FAQ_CATE_NAME = $request->input("FAQ_CATE_NAME");


        $FAQ_CATE_FLAG = $request->input("FAQ_CATE_FLAG");

        $START_DATE= $request->input("START_DATE");
        $EXPIRE_DATE = $request->input("EXPIRE_DATE");
        $FAQ_CATE_KEYWORD = $request->input("FAQ_CATE_KEYWORD");

        $FAQ_CONTACT_DEPT = $request->input("FAQ_CONTACT_DEPT");
        $FAQ_CONTACT_PHONE = $request->input("FAQ_CONTACT_PHONE");





        $chk = "SELECT COUNT(FAQ_CATE_ID) As total FROM TBL_FAQ_CATE WHERE FAQ_CATE_ID = ".$FAQ_CATE_ID ;
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;


        $datestart = new Date('2000-1-1 00:00:00.000') ;
        $dateEnd = new Date('9999-12-31 00:00:00.000') ;


        if($START_DATE != ""){
            $datestart = new Date($START_DATE);
        }

        if($EXPIRE_DATE != ""){
            $dateEnd = new Date($EXPIRE_DATE);
        }

        $data = array('FAQ_CATE_ID' => $FAQ_CATE_ID,
            'FAQ_CATE_NAME' =>$FAQ_CATE_NAME,
            'FAQ_CATE_FLAG' => $FAQ_CATE_FLAG,
            'START_DATE' => $datestart,
            'EXPIRE_DATE' => $dateEnd,
            'FAQ_CATE_KEYWORD' =>$FAQ_CATE_KEYWORD,
            'FAQ_CONTACT_DEPT' => $FAQ_CONTACT_DEPT,
            'FAQ_CONTACT_PHONE' => $FAQ_CONTACT_PHONE

        );



        $ret = DB::table('TBL_FAQ_CATE')->where('FAQ_CATE_ID',"=",$FAQ_CATE_ID)->update($data);




        return response()->json(array('success' => $ret, 'html'=> $rethtml ));




    }



    public function imageupload(Request $request){
        $file = $request->file('file');


        $d1 = new Date();
        $t1 = $d1->getTimestamp();
        $name = $t1. ".jpg";

        $request->file('file')->move(public_path().getenv('IMAGE_PATH') , $name);

        return response()->json(array('success' => true, 'html'=>'ok', 'url'=>getenv('IMAGE_PATH') .$name));
    }
}
