<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C59_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 59,
            'menu_id' => 1,
            'title' => getMenuName($data,59,1) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c59_1');
    }


    public function getAdd()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 59,
            'menu_id' => 1,
            'title' => getMenuName($data,59,1) . ' | MEA'
        ] );

//        $menucate= DB::table('TBL_NEWS_CATE')->get();
        return view('backend.pages.c57_1_add');
    }

    public  function  getSearch(Request $request){





            $query =  "SELECT * FROM TBL_EXT_LINK";

           $data= DB::select(DB::raw($query));


            $returnHTML = view('backend.pages.ajax.ajax_59_1')->with([

                'data'=>$data

            ])->render();

            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }

    public  function  Navsave(Request $request){
        $ret = false;
        $rethtml = "";
        $data = array();


        $ID=$request->input('ID');
        $NAME=$request->input('NAME');

        $URL=$request->input('URL');

        $thumbnail = $request->file('client_upload');
        $fileThumb= "";
        $pathThunb = getenv('THUMB_PATH');

        $FILE_PATH="http://measvp.mea.or.th:8081/contents/".$fileThumb;
        $chk = "SELECT COUNT(ID) As total FROM TBL_EXT_LINK WHERE ID = ".$ID ;
        $all = DB::select(DB::raw($chk));
        $total =  $all[0]->total;


        if($total > 0){
            $rethtml = "รหัส ที่ท่านเลือกมีอยู่ในระบบแล้ว";
        }else{
            $data = array(
                'ID' => $ID,
                'NAME' =>$NAME,
                'FILE_PATH' => $FILE_PATH,
                'URL' => $URL
            );

            if($thumbnail != null){
                $fileThumb = "client_". $ID .".png";
                $thumbnail->move(public_path().$pathThunb , $fileThumb);

                //file_put_contents( 'C:\FileSharing\fund_file\contents', $fileThumb);
            }
            $ret = DB::table('TBL_EXT_LINK')->insert($data);
        }






        return response()->json(array('success' => $ret, 'html'=>$rethtml));
    }




    public function editsave(Request $request){
        $ret = false;

        $data = array();

        $ID=$request->input('ID');
        $NAME=$request->input('NAME');
//        $FILE_PATH=$request->input('FILE_PATH');
        $URL=$request->input('URL');


        $thumbnail = $request->file('client_upload');
        $fileThumb= "";
        $pathThunb = getenv('THUMB_PATH');

        $FILE_PATH="http://measvp.mea.or.th:8081/contents/".$fileThumb;
        $data = array(

            'NAME' =>$NAME,
            'FILE_PATH' => $FILE_PATH,
            'URL' => $URL
        );


        if($thumbnail != null){
            $fileThumb = "client_". $ID .".png";
            $thumbnail->move(public_path().$pathThunb , $fileThumb);

            //file_put_contents( 'C:\FileSharing\fund_file\contents', $fileThumb);
        }
        $ret = DB::table('TBL_EXT_LINK')->where('ID ',"=",$ID)->update($data);


        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }


    public  function  deletenav(Request $request){

        $ret = false;

        $ID =  $request->input("key");




        $ret =   DB::table('TBL_EXT_LINK')->where('ID',"=",$ID)->delete();

        return response()->json(array('success' => $ret, 'html'=>'ok'));
    }

}
