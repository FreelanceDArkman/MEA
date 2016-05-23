<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package\Curl;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;


class riskassessmentController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 24,
            'menu_id' => 1,
            'title'=> 'แบบประเมินความเสี่ยง MEA FUND'
        ] );


        $sql2 = "SELECT TOP 1 * FROM TBL_RISK_QUIZ_RESULT WHERE EMP_ID = '".get_userID()."' ORDER BY QUIZ_TEST_DATE DESC";

        $quizprofile_data =  DB::select(DB::raw($sql2));



        $quizprofile = null;
        $mappingret = null;
        $ischeckok = false;

        if($quizprofile_data){

            $quizprofile = $quizprofile_data[0];
            $sql = "SELECT * FROM TBL_RISK_QUIZ_SCORE_MAPPING";
            $mapping = DB::select(DB::raw($sql));

            $mappingret  = null;

            foreach($mapping as $index => $item){

                $arr = explode("-", $item->SCORE_RANGE);

                $min = $arr[0];
                $max =$arr[1];

                if($quizprofile->QUIZ_SCORE >=$min && $quizprofile->QUIZ_SCORE <=$max){
                    $mappingret = $item;
                    break;
                }
            }

            $sqlcheckquiz = "SELECT TOP 1 * FROM TBL_RISK_QUIZ WHERE QUIZ_ACTIVE_FLAG = 0";
            $checkquiz = DB::select(DB::raw($sqlcheckquiz))[0];


            $ischeckok = true;

            if($checkquiz->QUIZ_ACTIVE_FLAG == "1"){
                $ischeckok = false;
            }

            $today = new Date();

            $dateQUIZ_EXPIRE_DATE = new Date($checkquiz->QUIZ_EXPIRE_DATE);

            $dateQUIZ_ACTIVE_DATE = new Date($checkquiz->QUIZ_ACTIVE_DATE);



            if($today < $dateQUIZ_ACTIVE_DATE){
                $ischeckok = false;
            }

            if($today > $dateQUIZ_EXPIRE_DATE){
                $ischeckok = false;
            }
        }

//        if($mappingret == null){
//            $mappingret=0;
//        }
        //QUIZ_ACTIVE_DATE

        //QUIZ_EXPIRE_DATE

        //QUIZ_ACTIVE_FLAG
        //var_dump($mappingret);


        //var_dump(quizScore($quizprofile->QUIZ_RESULT));

//var_dump($mappingret);

        return view('frontend.pages.24p1')->with([
            'quizprofile'=>$quizprofile,
            'mappingret'=>$mappingret,
            'ischeckok'=>$ischeckok,
            'quizprofile_data'=>$quizprofile_data
        ]);
    }


    public function getquiz()
    {
        $this->pageSetting( [
            'menu_group_id' => 24,
            'menu_id' => 1,
            'title' => 'แบบประเมินความเสี่ยง MEA FUND'
        ] );


        $sqlchoice = "SELECT  * FROM TBL_RISK_QUIZ_MANAGE qm INNER JOIN TBL_RISK_QUIZ qq ON qq.QUIZ_ID = qm.QUIZ_ID WHERE qq.QUIZ_ACTIVE_FLAG = 0";

        $datachoice = DB::select(DB::raw($sqlchoice));


        $sqlqtopic ="SELECT DISTINCT(QUESTION_NO),QUESTION_DESC FROM TBL_RISK_QUIZ_MANAGE qm INNER JOIN TBL_RISK_QUIZ qq ON qq.QUIZ_ID = qm.QUIZ_ID WHERE qq.QUIZ_ACTIVE_FLAG = 0";
        $dataqtopic = DB::select(DB::raw($sqlqtopic));
       // var_dump($datachoice);



        $sql2 = "SELECT TOP 1 * FROM TBL_RISK_QUIZ_RESULT WHERE EMP_ID = '".get_userID()."' ORDER BY QUIZ_TEST_DATE DESC";
        $quizprofile_profile =  DB::select(DB::raw($sql2));

        $quizprofile = null;
        $mapping =null;
        $mappingret  = null;

        if($quizprofile_profile){
            $quizprofile = $quizprofile_profile[0];

            $sql = "SELECT * FROM TBL_RISK_QUIZ_SCORE_MAPPING qm INNER JOIN TBL_RISK_QUIZ qq ON qq.QUIZ_ID = qm.PLAN_ID WHERE qq.QUIZ_ACTIVE_FLAG = 0";
            $mapping = DB::select(DB::raw($sql));



            foreach($mapping as $index => $item){

                $arr = explode("-", $item->SCORE_RANGE);

                $min = $arr[0];
                $max =$arr[1];

                if($quizprofile->QUIZ_SCORE >=$min && $quizprofile->QUIZ_SCORE <=$max){
                    $mappingret = $item;
                    break;
                }
            }
        }


//


        return view('frontend.pages.24p2')->with([
            'datachoice'=>$datachoice,
            'dataqtopic'=>$dataqtopic,
            'mapping'=>$mapping ,
            'quizprofile'=>$quizprofile ,
            'mappingret'=>$mappingret]);
    }


    public function  insertQuiz(Request $request){


//        $sqlqtopic ="SELECT DISTINCT(QUESTION_NO),QUESTION_DESC FROM TBL_RISK_QUIZ_MANAGE";
        $sqlqtopic ="SELECT DISTINCT(QUESTION_NO),QUESTION_DESC FROM TBL_RISK_QUIZ_MANAGE qm INNER JOIN TBL_RISK_QUIZ qq ON qq.QUIZ_ID = qm.QUIZ_ID WHERE qq.QUIZ_ACTIVE_FLAG = 0";
        $dataqtopic = DB::select(DB::raw($sqlqtopic));

        $counttopic = count($dataqtopic);
        $quizret = "";
        $totalScore =0;
        foreach($dataqtopic as $index => $item){

           // var_dump($request->input('radio_' . $item->QUESTION_NO));

            $score = $request->input('radio_' . $item->QUESTION_NO);
             $fag = "";
            if($score == "1"){
                $fag = "A";
            }
            if($score == "2"){
                $fag = "B";
            }
            if($score == "3"){
                $fag = "C";
            }
            if($score == "4"){
                $fag = "D";
            }


            $quizret = $quizret  . $item->QUESTION_NO .":" .$fag;

            if(($index+1)<$counttopic){
                $quizret = $quizret . "|";
            }
            $totalScore =$totalScore + (int)$score;
        }

    //var_dump($quizret);


        $create_date = new Date();
        $emp_id =  get_userID();

        $sql = "INSERT INTO TBL_RISK_QUIZ_RESULT (EMP_ID,QUIZ_RESULT,QUIZ_TEST_DATE,QUIZ_SCORE)
VALUES( '".$emp_id."' ,'".$quizret."', '".$create_date."','".$totalScore."' )";

        DB::insert(DB::raw($sql));



        return redirect()->to('/quiz')->with('insertok','ok');


    }
}
