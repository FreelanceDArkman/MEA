<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C56_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 56,
            'menu_id' => 1,
            'title' => getMenuName($data,56,1) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c56_1');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 54,
            'menu_id' => 1,
            'title' => getMenuName($data,54,1) . ' | MEA'
        ] );

        $quiz = null;
//        $menucate= DB::table('TBL_NEWS_CATE')->get();

        return view('backend.pages.56_1_add_page')->with(['quiz'=>$quiz]);
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
        $quiz = DB::table('TBL_RISK_QUIZ')->where("QUIZ_ID" ,"=",$id)->get()[0];



        return view('backend.pages.56_1_add_page')->with(['quiz'=>$quiz]);
    }

    public function  CheckUserGroup(Request $request){
        $ret = false;
        $rethtml = "";


        $QUIZ_ID =  $request->input("QUIZ_ID");
        $QUIZ_DESC = $request->input("QUIZ_DESC");


        $QUIZ_ACTIVE_FLAG = $request->input("QUIZ_ACTIVE_FLAG");

        $QUIZ_ACTIVE_DATE= $request->input("QUIZ_ACTIVE_DATE");
        $QUIZ_EXPIRE_DATE = $request->input("QUIZ_EXPIRE_DATE");


        $isupdate = $request->input('isupdate');


        $chk = "SELECT COUNT(QUIZ_ID) As total FROM TBL_RISK_QUIZ WHERE QUIZ_ID = ".$QUIZ_ID ;
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;

        $datestart = new Date('2000-1-1 00:00:00.000') ;
        $dateEnd = new Date('9999-12-31 00:00:00.000') ;


//        if($QUIZ_ACTIVE_DATE != ""){
//            $datestart = new Date($QUIZ_ACTIVE_DATE);
//        }
//
//        if($QUIZ_EXPIRE_DATE != ""){
//            $dateEnd = new Date($QUIZ_EXPIRE_DATE);
//        }

        $data = array('QUIZ_ID' => $QUIZ_ID,
            'QUIZ_DESC' =>$QUIZ_DESC,
            'QUIZ_ACTIVE_FLAG' => $QUIZ_ACTIVE_FLAG,
            'QUIZ_ACTIVE_DATE' => $datestart,
            'QUIZ_EXPIRE_DATE' => $dateEnd,

        );


//        var_dump($isupdate);

        if($isupdate == "true"){


            $ret=  DB::table('TBL_RISK_QUIZ')->where('QUIZ_ID',"=",$QUIZ_ID)->update($data);
        }else
        {
//            var_dump('hello');
            if($total > 0){

                $rethtml = "รหัสแบบสอบถาม ที่ท่านเลือกมีอยู่ในระบบแล้ว";

            }else{

                $today = new Date();


                $ret = DB::table('TBL_RISK_QUIZ')->insert($data);
                $rethtml = $ret;
            }
        }





        return response()->json(array('success' => $ret, 'html'=> $rethtml ));

    }
    public function  addperiod(Request $request){
        $ret = false;
        $rethtml = "";


        $PLAN_ID =  $request->input("PLAN_ID");
        $SCORE_RANGE = $request->input("SCORE_RANGE");


        $RISK_RATE = $request->input("RISK_RATE");

        $RATIO_RECOMMENDED= $request->input("RATIO_RECOMMENDED");





        $chk = "SELECT COUNT(PLAN_ID) As total FROM TBL_RISK_QUIZ_SCORE_MAPPING WHERE PLAN_ID = ".$PLAN_ID." AND SCORE_RANGE = '" .$SCORE_RANGE."'" ;
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;


        if($total > 0){

            $rethtml = "ช่วงคะแนนที่ท่าเลือกมีอยู่ในระบบแล้ว";

        }else{




            $today = new Date();
            $data = array('PLAN_ID' => $PLAN_ID,
                'SCORE_RANGE' =>$SCORE_RANGE,
                'RISK_RATE' => $RISK_RATE,
                'RATIO_RECOMMENDED' => $RATIO_RECOMMENDED

            );




            $ret = DB::table('TBL_RISK_QUIZ_SCORE_MAPPING')->insert($data);
        }




        return response()->json(array('success' => $ret, 'html'=> $rethtml ));

    }





    public  function ajax_getperiod(Request $request){

        $PLAN_ID =  $request->input("PLAN_ID");
        $SCORE_RANGE = $request->input("SCORE_RANGE");

        $chk = "SELECT * FROM TBL_RISK_QUIZ_SCORE_MAPPING WHERE PLAN_ID = ".$PLAN_ID ;
        $Data = DB::select(DB::raw($chk));





        $returnHTML = view('backend.pages.ajax.ajax_56_1_period')->with([

            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }




    public  function ajax_deleteperiod(Request $request){


        $SCORE_ID =  $request->input("SCORE_ID");


//        $data = array(
//
//            'SCORE_ID' =>$SCORE_ID,
//            'RISK_RATE' => $RISK_RATE,
//            'RATIO_RECOMMENDED' => $RATIO_RECOMMENDED
//        );



        $ret =  DB::table('TBL_RISK_QUIZ_SCORE_MAPPING')->where('SCORE_ID',"=",$SCORE_ID)->delete();

        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }
    public  function ajax_editperiod(Request $request){


        $SCORE_ID =  $request->input("SCORE_ID");
        $SCORE_RANGE = $request->input("SCORE_RANGE");


        $RISK_RATE = $request->input("RISK_RATE");

        $RATIO_RECOMMENDED= $request->input("RATIO_RECOMMENDED");


        $data = array(

            'SCORE_RANGE' =>$SCORE_RANGE,
            'RISK_RATE' => $RISK_RATE,
            'RATIO_RECOMMENDED' => $RATIO_RECOMMENDED
        );



        $ret =  DB::table('TBL_RISK_QUIZ_SCORE_MAPPING')->where('SCORE_ID',"=",$SCORE_ID)->update($data);

        return response()->json(array('success' => $ret, 'html'=>'ok'));
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

        $returnHTML = view('backend.pages.ajax.ajax_56_1')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


    public  function  getCountAll($ArrParam){
        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];

        return DB::table('TBL_RISK_QUIZ')->get();
//->where('QUIZ_ACTIVE_FLAG','=', $NEWS_TOPIC_FLAG)
    }
    public  function  getData($ArrParam){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];

//WHERE QUIZ_ACTIVE_FLAG = ".$NEWS_TOPIC_FLAG."

        $query =  "SELECT * FROM TBL_RISK_QUIZ nt  ORDER BY nt.QUIZ_ACTIVE_FLAG   OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";


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




//Questtion Section

    public  function ajax_getquestion(Request $request){


        $QUIZ_ID =  $request->input("QUIZ_ID");


        $chk = "SELECT * FROM TBL_RISK_QUIZ_MANAGE WHERE QUIZ_ID = ".$QUIZ_ID ." ORDER BY QUESTION_NO ASC ,QUESTION_CHOICE_NO ASC ";
        $Data = DB::select(DB::raw($chk));


        $chk2 = "SELECT QUESTION_NO,QUIZ_ID,QUESTION_DESC FROM TBL_RISK_QUIZ_MANAGE WHERE QUIZ_ID =".$QUIZ_ID ." GROUP BY QUESTION_NO ,QUIZ_ID,QUESTION_DESC ORDER BY QUESTION_NO ASC";

        $Datag = DB::select(DB::raw($chk2));

        $returnHTML = view('backend.pages.ajax.ajax_56_1_question')->with([

            'data'=>$Data,
            'datag'=>$Datag

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public  function ajax_editquestion(Request $request){

    $ret = false;

        $QUIZ_ID =  $request->input("QUIZ_ID");
        $QUESTION_NO = $request->input("QUESTION_NO");

        $QUESTION_NO_new =  $request->input("QUESTION_NO_new");
        $QUESTION_DESC_new = $request->input("QUESTION_DESC_new");
        $QUESTION_CHOICE_SCORE_1 =  $request->input("QUESTION_CHOICE_SCORE_1");
        $QUESTION_CHOICE_DESC_1 = $request->input("QUESTION_CHOICE_DESC_1");

        $QUESTION_CHOICE_SCORE_2 =  $request->input("QUESTION_CHOICE_SCORE_2");
        $QUESTION_CHOICE_DESC_2 = $request->input("QUESTION_CHOICE_DESC_2");

        $QUESTION_CHOICE_SCORE_3 =  $request->input("QUESTION_CHOICE_SCORE_3");
        $QUESTION_CHOICE_DESC_3 = $request->input("QUESTION_CHOICE_DESC_3");

        $QUESTION_CHOICE_SCORE_4 =  $request->input("QUESTION_CHOICE_SCORE_4");
        $QUESTION_CHOICE_DESC_4 = $request->input("QUESTION_CHOICE_DESC_4");



        $data = array();

        array_push($data,array(
            'QUIZ_ID' => $QUIZ_ID,
            'QUESTION_NO' =>$QUESTION_NO_new,
            'QUESTION_DESC' => $QUESTION_DESC_new,
            'QUESTION_CHOICE_NO' => 1,
            'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_1,
            'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_1

        ));
        array_push($data,array(
            'QUIZ_ID' => $QUIZ_ID,
            'QUESTION_NO' =>$QUESTION_NO_new,
            'QUESTION_DESC' => $QUESTION_DESC_new,
            'QUESTION_CHOICE_NO' => 2,
            'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_2,
            'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_2

        ));
        array_push($data,array(
            'QUIZ_ID' => $QUIZ_ID,
            'QUESTION_NO' =>$QUESTION_NO_new,
            'QUESTION_DESC' => $QUESTION_DESC_new,
            'QUESTION_CHOICE_NO' => 3,
            'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_3,
            'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_3

        ));
        array_push($data,array(
            'QUIZ_ID' => $QUIZ_ID,
            'QUESTION_NO' =>$QUESTION_NO_new,
            'QUESTION_DESC' => $QUESTION_DESC_new,
            'QUESTION_CHOICE_NO' => 4,
            'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_4,
            'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_4

        ));

        $deleted =  DB::table('TBL_RISK_QUIZ_MANAGE')->where('QUIZ_ID',"=",$QUIZ_ID)->where('QUESTION_NO','=',$QUESTION_NO)->delete();

        if($deleted){
            $ret =  DB::table('TBL_RISK_QUIZ_MANAGE')->insert($data);
        }



        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }


    public  function ajax_updateflag(Request $request){
        $ret = false;

        $QUIZ_ID =  $request->input("QUIZ_ID");

        $data2 = array('QUIZ_ACTIVE_FLAG' => 1);
        $ret =   DB::table('TBL_RISK_QUIZ')->update($data2);

        $data = array('QUIZ_ACTIVE_FLAG' => 0);
        $ret =   DB::table('TBL_RISK_QUIZ')->where('QUIZ_ID',"=",$QUIZ_ID)->update($data);

        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }

    public  function ajax_deletequestion(Request $request){


        $ret = false;

        $QUIZ_ID =  $request->input("QUIZ_ID");
        $QUESTION_NO = $request->input("QUESTION_NO");



        $ret =   DB::table('TBL_RISK_QUIZ_MANAGE')->where('QUIZ_ID',"=",$QUIZ_ID)->where('QUESTION_NO','=',$QUESTION_NO)->delete();

        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }


    public  function ajax_deleteQuiz(Request $request){


        $ret = false;

        $QUIZ_ID =  $request->input("QUIZ_ID");

        $arrQuiz = explode(':',$QUIZ_ID);

        foreach($arrQuiz as $qz){
            $ret =   DB::table('TBL_RISK_QUIZ')->where('QUIZ_ID',"=",$qz)->delete();
            $ret =   DB::table('TBL_RISK_QUIZ_SCORE_MAPPING')->where('PLAN_ID',"=",$qz)->delete();

            $ret =   DB::table('TBL_RISK_QUIZ_MANAGE')->where('QUIZ_ID',"=",$qz)->delete();
        }



        return response()->json(array('success' => true, 'html'=>'ok'));
    }



    public function  addquestion(Request $request){
        $ret = false;
        $rethtml = "";

        $id = false;



        $QUIZ_ID = $request->input("QUIZ_ID");
        $QUESTION_NO = $request->input("QUESTION_NO");
        $QUESTION_DESC = $request->input("QUESTION_DESC");
        $QUESTION_CHOICE_SCORE_1= $request->input("QUESTION_CHOICE_SCORE_1");
        $QUESTION_CHOICE_SCORE_2 = $request->input("QUESTION_CHOICE_SCORE_2");
        $QUESTION_CHOICE_SCORE_3 = $request->input("QUESTION_CHOICE_SCORE_3");
        $QUESTION_CHOICE_SCORE_4 = $request->input("QUESTION_CHOICE_SCORE_4");
        $QUESTION_CHOICE_DESC_1 = $request->input("QUESTION_CHOICE_DESC_1");
        $QUESTION_CHOICE_DESC_2 = $request->input("QUESTION_CHOICE_DESC_2");
        $QUESTION_CHOICE_DESC_3 = $request->input("QUESTION_CHOICE_DESC_3");
        $QUESTION_CHOICE_DESC_4 = $request->input("QUESTION_CHOICE_DESC_4");





        $chk = "SELECT COUNT(QUESTION_ID) As total FROM TBL_RISK_QUIZ_MANAGE WHERE QUIZ_ID = ".$QUIZ_ID." AND QUESTION_NO = '" .$QUESTION_NO."'" ;
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;


        if($total > 0){

            $rethtml = "ข้อคำถามมีอยู่ในระบบแล้ว กรุณาเปลี่ยนข้อคำถาม";

        }else{
            $data = array();

            array_push($data,array(
                'QUIZ_ID' => $QUIZ_ID,
                'QUESTION_NO' =>$QUESTION_NO,
                'QUESTION_DESC' => $QUESTION_DESC,
                'QUESTION_CHOICE_NO' => 1,
                'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_1,
                'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_1

            ));
            array_push($data,array(
                'QUIZ_ID' => $QUIZ_ID,
                'QUESTION_NO' =>$QUESTION_NO,
                'QUESTION_DESC' => $QUESTION_DESC,
                'QUESTION_CHOICE_NO' => 2,
                'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_2,
                'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_2

            ));
            array_push($data,array(
                'QUIZ_ID' => $QUIZ_ID,
                'QUESTION_NO' =>$QUESTION_NO,
                'QUESTION_DESC' => $QUESTION_DESC,
                'QUESTION_CHOICE_NO' => 3,
                'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_3,
                'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_3

            ));
            array_push($data,array(
                'QUIZ_ID' => $QUIZ_ID,
                'QUESTION_NO' =>$QUESTION_NO,
                'QUESTION_DESC' => $QUESTION_DESC,
                'QUESTION_CHOICE_NO' => 4,
                'QUESTION_CHOICE_DESC' =>$QUESTION_CHOICE_DESC_4,
                'QUESTION_CHOICE_SCORE' =>$QUESTION_CHOICE_SCORE_4

            ));



            $id = DB::table('TBL_RISK_QUIZ_MANAGE')->insert($data);
        }




        return response()->json(array('success' => $ret, 'html'=> $rethtml ,'id'=>$id ));

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
