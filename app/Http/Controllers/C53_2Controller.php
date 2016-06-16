<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C53_2Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 53,
            'menu_id' => 2,
            'title' => getMenuName($data,53,2) . ' | MEA'
        ] );

        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c53_2')->with(['menucate'=>$menucate]);
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 53,
            'menu_id' => 2,
            'title' => getMenuName($data,53,2) . ' | MEA'
        ] );

        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.53_2_add_page')->with(['menucate'=>$menucate]);
    }

    public function getEdit($id)
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 53,
            'menu_id' => 2,
            'title' => getMenuName($data,53,2) . ' | MEA'
        ] );


        $arrid = explode(',',$id);


        $newcate = $arrid[0];
        $topic = $arrid[1];



        $menucate = DB::table('TBL_NEWS_CATE')->get();

        //if(isset($id)) abort(404);
        $Topicdata = DB::table('TBL_NEWS_TOPIC')->where("NEWS_CATE_ID" ,"=",$newcate)->where("NEWS_TOPIC_ID",'=',$topic)->get()[0];



        return view('backend.pages.53_2_edit_page')->with(['menucate'=>$menucate,'Topicdata'=>$Topicdata]);
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

        $returnHTML = view('backend.pages.ajax.ajax_53_2')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data'=>$Data

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


    public  function  getCountAll($ArrParam){
        $NEWS_CATE_ID = $ArrParam["NEWS_CATE_ID"];
        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];

        if($NEWS_CATE_ID > 0){
            return DB::table('TBL_NEWS_TOPIC')->where("NEWS_CATE_ID","=",$NEWS_CATE_ID)->where("NEWS_TOPIC_FLAG","=",$NEWS_TOPIC_FLAG)->get();
        }
        else{
            return DB::table('TBL_NEWS_TOPIC')->where("NEWS_TOPIC_FLAG","=",$NEWS_TOPIC_FLAG)->get();
        }

    }
    public  function  getData($ArrParam){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];
        $NEWS_CATE_ID = $ArrParam["NEWS_CATE_ID"];
        $NEWS_TOPIC_FLAG = $ArrParam["NEWS_TOPIC_FLAG"];



        $query = "";
        if($NEWS_CATE_ID > 0){
            $query =  "SELECT nt.NEWS_CATE_ID AS NEWS_CATE_ID, nt.NEWS_TOPIC_ID AS NEWS_TOPIC_ID, nc.NEWS_CATE_NAME AS NEWS_CATE_NAME, nt.FILE_NAME AS FILE_NAME, nt.START_DATE AS START_DATE ,nt.EXPIRE_DATE AS  EXPIRE_DATE , nt.NEWS_TOPIC_FLAG AS NEWS_TOPIC_FLAG FROM TBL_NEWS_TOPIC nt INNER JOIN TBL_NEWS_CATE nc ON nc.NEWS_CATE_ID=nt.NEWS_CATE_ID WHERE nt.NEWS_CATE_ID = '".$NEWS_CATE_ID."' AND nt.NEWS_TOPIC_FLAG = '".$NEWS_TOPIC_FLAG."'  ORDER BY nt.CREATE_DATE DESC  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }else{
            $query =  "SELECT nt.NEWS_CATE_ID AS NEWS_CATE_ID, nt.NEWS_TOPIC_ID AS NEWS_TOPIC_ID, nc.NEWS_CATE_NAME AS NEWS_CATE_NAME, nt.FILE_NAME AS FILE_NAME, nt.START_DATE AS START_DATE ,nt.EXPIRE_DATE AS  EXPIRE_DATE , nt.NEWS_TOPIC_FLAG AS NEWS_TOPIC_FLAG FROM TBL_NEWS_TOPIC nt INNER JOIN TBL_NEWS_CATE nc ON nc.NEWS_CATE_ID=nt.NEWS_CATE_ID  WHERE  nt.NEWS_TOPIC_FLAG = '".$NEWS_TOPIC_FLAG."' ORDER BY nt.CREATE_DATE DESC  OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }


        return DB::select(DB::raw($query));
    }



    public function delete(Request $request)
    {
        $deleted = false;
        $arrId = explode(':',$request->input('group_id'));


//        var_dump($request["plan_id"]);
        foreach($arrId as $index => $item){

            if($item != ""){

                $arrid = explode(',',$item);


                $newcate = $arrid[0];
                $topic = $arrid[1];

                $data = array(
                    'NEWS_TOPIC_FLAG' => 1

                );



                $deleted =  DB::table('TBL_NEWS_TOPIC')->where('NEWS_CATE_ID',"=",$newcate)->where('NEWS_TOPIC_ID','=',$topic)->update($data);
            }

        }


        if($deleted)  {
            return response()->json(["ret" => "1"]);
        }else{
            return response()->json(["ret" => "00"]);
        }


    }








    public function postAdd(Request $request)
    {

        $ret = false;
        $rethtml = "";


        $NEWS_CATE_ID =  $request->input("NEWS_CATE_ID");
//        $NEWS_TOPIC_ID = $request->input("NEWS_TOPIC_ID");


        $FILE_NAME = $request->input("FILE_NAME");
        $NEWS_TOPIC_FLAG = $request->input("NEWS_TOPIC_FLAG");
        $START_DATE= $request->input("START_DATE");
        $EXPIRE_DATE = $request->input("EXPIRE_DATE");
        $NEWS_TOPIC_DETAIL = $request->input("NEWS_TOPIC_DETAIL");

        $NEWS_TOPIC_KEYWORD = $request->input("NEWS_TOPIC_KEYWORD");



        $Notice = $request->input("Notice");
        $Notice_start_DATE = $request->input("Notice_start_DATE");
        $Notice_End_DATE = $request->input("Notice_End_DATE");
        $noti_message = $request->input("noti_message");


//        $chk = "SELECT COUNT(NEWS_TOPIC_ID) As total FROM TBL_NEWS_TOPIC WHERE NEWS_CATE_ID = ".$NEWS_CATE_ID . " AND NEWS_TOPIC_ID = ".$NEWS_TOPIC_ID;
//        $all = DB::select(DB::raw($chk));
       // $total =  $all[0]->total;
        $total =  0;


        if($total > 0){

            $rethtml = "news_cate_id ที่ท่านเลือกมีอยู่ในระบบแล้ว";

        }else{
            $thumbnail = $request->file('filethumbnail');

            $importpdf =  $request->file('filesPDF');

            $today = new Date();

            $pathpdf =  getenv('CONTENT_PDF_PATH');
            $pathThunb = getenv('THUMB_PATH');

//        $file = $importpdf->getClientOriginalName();

            $meapath =DB::table('TBL_CONTROL_CFG')->get();


            $datestart = new Date('2000-1-1 00:00:00.000');
            $dateEnd = new Date('9999-12-31 00:00:00.000');


            if($START_DATE != ""){
                $datestart = new Date($START_DATE);
            }

            if($EXPIRE_DATE != ""){
                $dateEnd = new Date($EXPIRE_DATE);
            }

            $FILE_PATH = "NULL";
            $THUMBNAIL = "NULL";
            $MENU_GROUP_ID = "";
            $MENU_ID = "";

            $menucate= DB::table('TBL_NEWS_CATE')->where('NEWS_CATE_ID','=',$NEWS_CATE_ID)->get();

             if($menucate){
                 $MENU_GROUP_ID = $menucate[0]->MENU_GROUP_ID;
                 $MENU_ID = $menucate[0]->MENU_ID;
             }


            //                Download PDF: multiple
//
//                15,16,3,4,5,6,9,10,11,12,13,14
//
//                Content View (Rich box) optional to download or show content  : multiple
//                9,1,2
//                Content Only: Only one
//
//                7,8

            $filePDF = "";
            $fileThumb= "";

            if($importpdf != null){
//                $filePDF = $importpdf->getClientOriginalName();

                $filePDF  = uniqid().".pdf";
                $importpdf->move(public_path().$pathpdf , $filePDF);

                //file_put_contents( 'C:\FileSharing\fund_file\contents', $filePDF);
            }


            if($thumbnail != null){
                $fileThumb  = uniqid(). ".jpg";
//                $fileThumb = $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path().$pathThunb , $fileThumb);

                //file_put_contents( 'C:\FileSharing\fund_file\contents', $fileThumb);
            }else{
                $fileThumb = 'default.jpg';
//                $thumbnail->move(public_path().$pathThunb , 'default.jpg');
            }



            $WEB_NEWS_ROOT_PATH  = $meapath[0]->WEB_NEWS_ROOT_PATH;

            $FILE_PATH = $WEB_NEWS_ROOT_PATH.$filePDF;
            $THUMBNAIL = $WEB_NEWS_ROOT_PATH .$fileThumb;


            if($NEWS_CATE_ID == 9 || $NEWS_CATE_ID == 1 || $NEWS_CATE_ID == 2|| $NEWS_CATE_ID == 7|| $NEWS_CATE_ID == 8){

                if($importpdf == null){
                    $FILE_PATH = "";
                }else{
                    $NEWS_TOPIC_DETAIL = "";
                }


                if($NEWS_CATE_ID == 9 || $NEWS_CATE_ID == 1 || $NEWS_CATE_ID == 2){



                }else{
                    //7,8
                }

            }else{

                $NEWS_TOPIC_DETAIL = "";
            }



            $data = array(
                'NEWS_CATE_ID' => $NEWS_CATE_ID,
//                'NEWS_TOPIC_ID' =>$NEWS_TOPIC_ID,
                'FILE_NAME' => $FILE_NAME,
                'NEWS_TOPIC_DETAIL' => $NEWS_TOPIC_DETAIL ,
                'FILE_PATH' => $FILE_PATH,
                'THUMBNAIL' =>$THUMBNAIL,
                'NEWS_TOPIC_FLAG' => $NEWS_TOPIC_FLAG,
                'START_DATE' => $datestart,
                'EXPIRE_DATE' => $dateEnd,
                'MENU_GROUP_ID' => $MENU_GROUP_ID,
                'MENU_ID' => $MENU_ID,
                'NEWS_TOPIC_KEYWORD' =>$NEWS_TOPIC_KEYWORD,
                'CREATE_DATE' =>$today,
                'CREATE_BY'=>"Admin");

//            array_push($data,array(
//
//
//            ));

            $ret = DB::table('TBL_NEWS_TOPIC')->insert($data);

//            $Notice = $request->input("Notice");
//            $Notice_start_DATE = $request->input("Notice_start_DATE");
//            $Notice_End_DATE = $request->input("Notice_End_DATE");
//            $noti_message = $request->input("noti_message");

            if($Notice == 0){
                $datanotice = array(

                    'NOTIFY_MSG' =>$noti_message,
                    'START_DATE'=>$Notice_start_DATE,
                    'END_DATE'=>$Notice_End_DATE
                );

                DB::table('TBL_NEWS_NOTIFICATION')->insert($datanotice);
            }
        }




        return response()->json(array('success' => $ret, 'html'=> $rethtml ));






    }



    public function postEdit(Request $request)
    {
        $ret = false;
        $rethtml = "";


        $NEWS_CATE_ID =  $request->input("NEWS_CATE_ID");
        $NEWS_TOPIC_ID = $request->input("NEWS_TOPIC_ID");


        $FILE_NAME = $request->input("FILE_NAME");
        $NEWS_TOPIC_FLAG = $request->input("NEWS_TOPIC_FLAG");
        $START_DATE= $request->input("START_DATE");
        $EXPIRE_DATE = $request->input("EXPIRE_DATE");
        $NEWS_TOPIC_DETAIL = $request->input("NEWS_TOPIC_DETAIL");

        $NEWS_TOPIC_KEYWORD = $request->input("NEWS_TOPIC_KEYWORD");





        $Notice = $request->input("Notice");
        $Notice_start_DATE = $request->input("Notice_start_DATE");
        $Notice_End_DATE = $request->input("Notice_End_DATE");
        $noti_message = $request->input("noti_message");
//        $chk = "SELECT COUNT(NEWS_TOPIC_ID) As total FROM TBL_NEWS_TOPIC WHERE NEWS_CATE_ID = ".$NEWS_CATE_ID . " AND NEWS_TOPIC_ID = ".$NEWS_TOPIC_ID;
//        $all = DB::select(DB::raw($chk));
//        $total =  $all[0]->total;


//        if($total > 0){
//
//            $rethtml = "news_cate_id ที่ท่านเลือกมีอยู่ในระบบแล้ว";
//
//        }else{
            $thumbnail = $request->file('filethumbnail');

            $importpdf =  $request->file('filesPDF');

            $today = new Date();

            $pathpdf =  getenv('CONTENT_PDF_PATH');
            $pathThunb = getenv('THUMB_PATH');

//        $file = $importpdf->getClientOriginalName();

            $meapath =DB::table('TBL_CONTROL_CFG')->get();


            $datestart = new Date('2000-1-1 00:00:00.000') ;
            $dateEnd = new Date('9999-12-31 00:00:00.000') ;


            if($START_DATE != ""){
                $datestart = new Date($START_DATE);
            }

            if($EXPIRE_DATE != ""){
                $dateEnd = new Date($EXPIRE_DATE);
            }

            $FILE_PATH = "NULL";
            $THUMBNAIL = "NULL";
            $MENU_GROUP_ID = "";
            $MENU_ID = "";

            $menucate= DB::table('TBL_NEWS_CATE')->where('NEWS_CATE_ID','=',$NEWS_CATE_ID)->get();

            if($menucate){
                $MENU_GROUP_ID = $menucate[0]->MENU_GROUP_ID;
                $MENU_ID = $menucate[0]->MENU_ID;
            }


            //                Download PDF: multiple
//
//                15,16,3,4,5,6,9,10,11,12,13,14
//
//                Content View (Rich box) optional to download or show content  : multiple
//                9,1,2
//                Content Only: Only one
//
//                7,8
            $THUMBNAIL = "";
            $currentthumb = $request->input("THUMBNAIL");

            $WEB_NEWS_ROOT_PATH  = $meapath[0]->WEB_NEWS_ROOT_PATH;
            $filePDF = "";
            $fileThumb= "";

            if($importpdf != null){
                $filePDF = $importpdf->getClientOriginalName();
                $importpdf->move(public_path().$pathpdf , $filePDF);
            }


            if($thumbnail != null){
                $fileThumb = $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path().$pathThunb , $fileThumb);
                $THUMBNAIL = $WEB_NEWS_ROOT_PATH .$fileThumb;
            }else{

                $fileThumb = 'default.jpg';
                if($currentthumb != ""){
                    $THUMBNAIL = $currentthumb;
                }else{
                    $THUMBNAIL = $WEB_NEWS_ROOT_PATH .$fileThumb;
                }
            }



            $FILE_PATH = $WEB_NEWS_ROOT_PATH.$filePDF;





            if($NEWS_CATE_ID == 9 || $NEWS_CATE_ID == 1 || $NEWS_CATE_ID == 2|| $NEWS_CATE_ID == 7|| $NEWS_CATE_ID == 8){

                if($importpdf == null){
                    $FILE_PATH = "";
                }else{
                    $NEWS_TOPIC_DETAIL = "";
                }


                if($NEWS_CATE_ID == 9 || $NEWS_CATE_ID == 1 || $NEWS_CATE_ID == 2){



                }else{
                    //7,8
                }

            }else{

                $NEWS_TOPIC_DETAIL = "";
            }



            $data = array('NEWS_CATE_ID' => $NEWS_CATE_ID,
//                'NEWS_TOPIC_ID' =>$NEWS_TOPIC_ID,
                'FILE_NAME' => $FILE_NAME,
                'NEWS_TOPIC_DETAIL' =>  $NEWS_TOPIC_DETAIL ,
                'FILE_PATH' => $FILE_PATH,
                'THUMBNAIL' =>$THUMBNAIL,
                'NEWS_TOPIC_FLAG' => $NEWS_TOPIC_FLAG,
                'START_DATE' => $datestart,
                'EXPIRE_DATE' => $dateEnd,
                'MENU_GROUP_ID' => $MENU_GROUP_ID,
                'MENU_ID' => $MENU_ID,
                'NEWS_TOPIC_KEYWORD' =>$NEWS_TOPIC_KEYWORD
            );

//            array_push($data,array(
//
//
//            ));
            $ret = DB::table('TBL_NEWS_TOPIC')->where('NEWS_CATE_ID',"=",$NEWS_CATE_ID)->where('NEWS_TOPIC_ID','=',$NEWS_TOPIC_ID)->update($data);
//        }

        if($Notice == 0){
            $datanotice = array(

                'NOTIFY_MSG' =>$noti_message,
                'START_DATE'=>$Notice_start_DATE,
                'END_DATE'=>$Notice_End_DATE
            );

            DB::table('TBL_NEWS_NOTIFICATION')->insert($datanotice);
        }


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
