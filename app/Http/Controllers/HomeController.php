<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Response;
use Jenssegers\Date\Date;


class HomeController extends Controller
{

    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'หน้าแรก | MEA FUND'
        ] );


        $netasset = $this->GetFeed(1);

        return view('frontend.pages.dashboard')->with(['netasset' => $netasset,'sortby'=>1]);
    }


    public function getIndexByID($id)
    {
        $this->pageSetting( [
            'title' => 'หน้าแรก | MEA FUND'
        ] );


        $netasset = $this->GetFeed($id);

        return view('frontend.pages.dashboard')->with(['netasset' => $netasset, 'sortby'=>$id]);
    }

    public function  GetFeed($feedby){

        $today = new Date();
        $sql = "";
        if($feedby == null || $feedby == 1){


            return DB::table('tbl_news_topic')->where('START_DATE','<=',get_date_sql($today))->where('EXPIRE_DATE','>=',get_date_sql($today))->whereIn('NEWS_CATE_ID',[1, 2])->where('NEWS_TOPIC_FLAG','=',0)->orderBy('create_date', 'desc')->paginate(6);


        }

        if($feedby == 2){

            return DB::table('tbl_news_topic')->where('START_DATE','<=',get_date_sql($today))->where('EXPIRE_DATE','>=',get_date_sql($today))->whereIn('NEWS_CATE_ID',[1, 2])->where('NEWS_TOPIC_FLAG','=',0)->orderBy('VIEW_STAT', 'desc')->paginate(6);
        }

        if($feedby == 3){

            return DB::table('tbl_news_topic')->where('START_DATE','<=',get_date_sql($today))->where('EXPIRE_DATE','>=',get_date_sql($today))->whereIn('NEWS_CATE_ID',[1, 2])->where('NEWS_TOPIC_FLAG','=',0)->orderBy('DL_STAT', 'desc')->paginate(6);
//            return DB::table('tbl_news_topic')->where('NEWS_TOPIC_FLAG','=',0)->where('NEWS_CATE_ID','1')->orWhere('NEWS_CATE_ID','2')->orderBy('DL_STAT', 'desc')->paginate(6);
        }

        DB::update(DB::raw($sql));

    }


    public  function  ViewFile($id){
        $arr = explode("-", $id);

        $cate_id = $arr[0];
        $topic_id = $arr[1];

        $today = new Date();

        $data =  DB::table('TBL_NEWS_TOPIC')->where('NEWS_CATE_ID',$cate_id)->Where('NEWS_TOPIC_ID',$topic_id)->first();



        $dlno = ((int)$data->VIEW_STAT) + 1;

        $sql = "UPDATE tbl_news_topic SET VIEW_STAT='".$dlno."', LAST_VIEW_DATE='".$today."'  WHERE NEWS_CATE_ID='".$cate_id."' AND NEWS_TOPIC_ID = '".$topic_id."'";

        DB::update(DB::raw($sql));

        return redirect()->to($data->FILE_PATH);
    }



    public  function  viewrecord(Request $request){

            //return $request->input('rec');

        $arr = explode("-", $request->input('rec'));

        $cate_id = $arr[0];
        $topic_id = $arr[1];

        $today = new Date();

        $data =  DB::table('TBL_NEWS_TOPIC')->where('NEWS_CATE_ID',$cate_id)->Where('NEWS_TOPIC_ID',$topic_id)->first();

        $dlno = ((int)$data->VIEW_STAT) + 1;

        $sql = "UPDATE tbl_news_topic SET VIEW_STAT='".$dlno."', LAST_VIEW_DATE='".$today."'  WHERE NEWS_CATE_ID='".$cate_id."' AND NEWS_TOPIC_ID = '".$topic_id."'";

        DB::update(DB::raw($sql));

    }

    public function  DownloadFile($id){

        //User::where('encrypted_id', $file)->firstOrFail();
//        $decrypted = \Crypt::decrypt($file);
//
//        var_dump($decrypted);


        $arr = explode("-", $id);

        $cate_id = $arr[0];
        $topic_id = $arr[1];

        $today = new Date();




        $data =  DB::table('TBL_NEWS_TOPIC')->where('NEWS_CATE_ID',$cate_id)->Where('NEWS_TOPIC_ID',$topic_id)->first();



//download file from url

        // file_put_contents("downloadtmp/Tmpfile3.pdf", fopen($data->FILE_PATH, 'r'));

        $arrfile  = explode("/", $data->FILE_PATH);


        $arrfileName= $arrfile[count($arrfile) - 1];



        //http://suntrue.sun-system.com:8843/contents/fundnews1.pdf
       // http://suntrue.sun-system.com:8843/contents/t_fundnews1.jpg


        $dlno = ((int)$data->DL_STAT) + 1;

         $sql = "UPDATE tbl_news_topic SET DL_STAT='".$dlno."', LAST_DL_DATE='".$today."'  WHERE NEWS_CATE_ID='".$cate_id."' AND NEWS_TOPIC_ID = '".$topic_id."'";

        DB::update(DB::raw($sql));


        $file = 'contents/' . $arrfileName;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return \Response::download($file, $arrfileName, $headers);

    }




}
