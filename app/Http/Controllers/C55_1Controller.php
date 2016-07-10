<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroup;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class C55_1Controller extends Controller
{
    //

    public function getindex()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 55,
            'menu_id' => 1,
            'title' => getMenuName($data,55,1) . ' | MEA'
        ] );

        $location= DB::table('TBL_MAP_LOCATION')->get()[0];

        return view('backend.pages.c55_1')->with(['location'=>$location]);


    }



    public function postAdd(Request $request)
    {

        $ret = false;
        $rethtml = "";





        $LOCATION_ID =  $request->input("LOCATION_ID");
        $LOCATION_NAME = $request->input("LOCATION_NAME");
        $LOCATION_ADDRESS = $request->input("LOCATION_ADDRESS");
        $LOCATION_SERVICE_CENTER = $request->input("LOCATION_SERVICE_CENTER");

        $LOCATION_EMAIL= $request->input("LOCATION_EMAIL");

        $LOCATION_TRAVEL= $request->input("LOCATION_TRAVEL");
        $LOCATION_GPS_LAT = $request->input("LOCATION_GPS_LAT");
        $LOCATION_GPS_LNG = $request->input("LOCATION_GPS_LNG");

        $meapath =DB::table('TBL_CONTROL_CFG')->get();
        $pathpdf =  getenv('CONTENT_PDF_PATH');



        $chk = "SELECT * FROM TBL_MAP_LOCATION WHERE LOCATION_ID = ".$LOCATION_ID;
        $all = DB::select(DB::raw($chk));


        $importpdf =  $request->file('mappdf');
        $WEB_NEWS_ROOT_PATH  = $meapath[0]->WEB_NEWS_ROOT_PATH;
        $filePDF = "";
        $LOCATION_PIC = "";


        if($importpdf != null){
//            $filePDF = $importpdf->getClientOriginalName();
            $filePDF = 'map.pdf';
            $importpdf->move(public_path().$pathpdf , $filePDF);
            $LOCATION_PIC = $WEB_NEWS_ROOT_PATH.$filePDF;
        }



//        var_dump($LOCATION_ADDRESS);

        $data = array('LOCATION_ID' => $LOCATION_ID,
            'LOCATION_NAME' =>$LOCATION_NAME,
            'LOCATION_ADDRESS' => $LOCATION_ADDRESS,
            'LOCATION_SERVICE_CENTER' =>  $LOCATION_SERVICE_CENTER ,
            'LOCATION_EMAIL' => $LOCATION_EMAIL,
            'LOCATION_TRAVEL' =>$LOCATION_TRAVEL,

            'LOCATION_GPS_LAT' => $LOCATION_GPS_LAT,
            'LOCATION_GPS_LNG' => $LOCATION_GPS_LNG,
            'LOCATION_PIC' => $LOCATION_PIC
        );



        if($all){

            $ret = DB::table('TBL_MAP_LOCATION')->where('LOCATION_ID',"=",$LOCATION_ID)->update($data);

        }else{



            $ret = DB::table('TBL_MAP_LOCATION')->insert($data);
        }


//        return response()->json(array('success' => $ret, 'html'=> $rethtml ));

        return redirect()->to('admin/contact')->with('message','ok');




    }

}
