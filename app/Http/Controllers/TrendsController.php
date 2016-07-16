<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Package\Curl;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Facades\Excel;

class TrendsController extends Controller
{


    public  function  getIndexbysearchgp2(Request $request){

        $this->pageSetting( [
            'menu_group_id' => 21,
            'menu_id' => 1,
            'title' => 'ข้อมูลการลงทุน MEA FUND'
        ] );

        $monthstart = $request->input('drop_month_2_start');
        $yearstart =$request->input('drop_year_2_start');

        $monthend = $request->input('drop_month_2_end');
        $yearend =$request->input('drop_year_2_end');




         //var_dump($monthstart ."--" . $yearstart . "----" .$monthend . "--". $yearend);

        $netasset = $this->getDB_TBL_INFORMATION_FROM_ASSET();


        $netasset2 =$this->getDB_TBL_MEMBER_BENEFITS_bysearch($monthstart,$yearstart,$monthend,$yearend);
        $netasset2tbl =$this->getDB_TBL_MEMBER_BENEFITS_bysearch_table($monthstart,$yearstart,$monthend,$yearend);





        $empStart =DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID','=',get_userID())->first();


        $show = $this->isShowGraph($empStart);

        $graph = array();
        $graph = $this->getGraphColum($netasset);

        $graph2 = $this->getGraphBenefit($netasset2);
        $graph3 =$this->getGraphfund($netasset2,$show);

        $yearColume = $this->getYearDrop(null);
        $monthColum = $this->getMonthDrop(null);

        $monthColum2 = $this->getMonthDrop($monthstart);
        $yearColume2 = $this->getYearDrop($yearstart);


        $yearColumeend2 = $this->getYearDrop($yearend);
        $monthColumend2 = $this->getMonthDrop($monthend);

        $monthColum3 = $this->getMonthDrop(null);
        $yearColume3 = $this->getYearDrop(null);


        $yearColumeend3 = $this->getYearDrop(null);
        $monthColumend3 = $this->getMonthDrop(null);

        $show2 = 2;

        $empinfo = $this->getempINFO();
        $planchoose = $this->getPLanchoose();

        //var_dump($yearColumeend);

        return view('frontend.pages.21p1')->with(['netasset' => $netasset,'graph' =>$graph , 'netasset2'=>$netasset2, 'graph2'=>$graph2 , 'show'=>$show , 'graph3'=>$graph3,'yearColume2' =>$yearColume2 ,'monthColum2'=>$monthColum2 , 'yearColumeend2'=>$yearColumeend2, 'monthColumend2'=>$monthColumend2 ,'yearColume' =>$yearColume ,'monthColum'=>$monthColum,'monthColum3'=>$monthColum3 ,'yearColume3'=>$yearColume3 ,'yearColumeend3'=>$yearColumeend3 ,'monthColumend3'=>$monthColumend3  ,'show2'=>$show2,'empinfo'=>$empinfo ,'planchoose'=>$planchoose,'netasset2tbl'=>$netasset2tbl]);


    }

    public  function getIndexbysearchgpLastest(Request $request){

        $this->pageSetting( [
            'menu_group_id' => 21,
            'menu_id' => 1,
            'title' => 'ข้อมูลการลงทุน MEA FUND'
        ] );



        $monthstart = $request->input('drop_month_3_start');
        $yearstart =$request->input('drop_year_3_start');

        $monthend = $request->input('drop_month_3_end');
        $yearend =$request->input('drop_year_3_end');


//        var_dump($monthstart ."--" . $yearstart);

        $netasset = $this->getDB_TBL_INFORMATION_FROM_ASSET();


        $netasset2 =$this->getDB_TBL_MEMBER_BENEFITS_bysearch($monthstart,$yearstart,$monthend,$yearend);
        $netasset2tbl =$this->getDB_TBL_MEMBER_BENEFITS_bysearch_table($monthstart,$yearstart,$monthend,$yearend);



        $empStart =DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID','=',get_userID())->first();


        $show = $this->isShowGraph($empStart);

        $graph = array();
        $graph = $this->getGraphColum($netasset);

        $graph2 = $this->getGraphBenefit($netasset2);
        $graph3 =$this->getGraphfund($netasset2,$show);

        $yearColume = $this->getYearDrop(null);
        $monthColum = $this->getMonthDrop(null);

        $monthColum2 = $this->getMonthDrop(null);
        $yearColume2 = $this->getYearDrop(null);


        $yearColumeend2 = $this->getYearDrop(null);
        $monthColumend2 = $this->getMonthDrop(null);


        $monthColum3 = $this->getMonthDrop($monthstart);
        $yearColume3 = $this->getYearDrop($yearstart);


        $yearColumeend3 = $this->getYearDrop($yearend);
        $monthColumend3 = $this->getMonthDrop($monthend);


        $show2 = 3;

        $empinfo = $this->getempINFO();
        $planchoose = $this->getPLanchoose();

        return view('frontend.pages.21p1')->with(['netasset' => $netasset,'graph' =>$graph , 'netasset2'=>$netasset2, 'graph2'=>$graph2 , 'show'=>$show , 'graph3'=>$graph3,'yearColume' =>$yearColume ,'monthColum'=>$monthColum ,'yearColumeend2'=>$yearColumeend2, 'monthColumend2'=>$monthColumend2 ,'monthColum3'=>$monthColum3 ,'yearColume3'=>$yearColume3 ,'yearColumeend3'=>$yearColumeend3 ,'monthColumend3'=>$monthColumend3 ,'monthColum2'=>$monthColum2 ,  'yearColume2'=>$yearColume2, 'show2'=>$show2,'empinfo'=>$empinfo ,'planchoose'=>$planchoose,'netasset2tbl'=>$netasset2tbl]);


    }

    public  function  getIndexbysearchColum(Request $request){

        $this->pageSetting( [
            'menu_group_id' => 21,
            'menu_id' => 1,
            'title' => 'ข้อมูลการลงทุน MEA FUND'
        ] );

        $month = $request->input('drop_month');
        $year =$request->input('drop_year');


       // var_dump($month ."--" . $year);

        $netasset = $this->getDB_TBL_INFORMATION_FROM_ASSET_bysearch($month,$year);


        $netasset2 =$this->getDB_TBL_MEMBER_BENEFITS();
        $netasset2tbl =$this->getDB_TBL_MEMBER_BENEFITS_table();


        $empStart =DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID','=',get_userID())->first();


        $show = $this->isShowGraph($empStart);

        $graph = array();
        $graph = $this->getGraphColum($netasset);

        $graph2 = $this->getGraphBenefit($netasset2);
        $graph3 =$this->getGraphfund($netasset2,$show);

        $yearColume = $this->getYearDrop($year);
        $monthColum = $this->getMonthDrop($month);

        $monthColum2 = $this->getMonthDrop(null);
        $yearColume2 = $this->getYearDrop(null);


        $yearColumeend2 = $this->getYearDrop(null);
        $monthColumend2 = $this->getMonthDrop(null);


        $monthColum3 = $this->getMonthDrop(null);
        $yearColume3 = $this->getYearDrop(null);


        $yearColumeend3 = $this->getYearDrop(null);
        $monthColumend3 = $this->getMonthDrop(null);

        $show2 = 1;

        $empinfo = $this->getempINFO();
        $planchoose = $this->getPLanchoose();

        return view('frontend.pages.21p1')->with(['netasset' => $netasset,'graph' =>$graph , 'netasset2'=>$netasset2, 'graph2'=>$graph2 , 'show'=>$show , 'graph3'=>$graph3,'yearColume' =>$yearColume ,'monthColum'=>$monthColum , 'yearColumeend2'=>$yearColumeend2, 'monthColumend2'=>$monthColumend2 ,'monthColum2'=>$monthColum2 ,'yearColume2'=>$yearColume2,'monthColum3'=>$monthColum3 ,'yearColume3'=>$yearColume3 ,'yearColumeend3'=>$yearColumeend3 ,'monthColumend3'=>$monthColumend3, 'show2'=>$show2,'empinfo'=>$empinfo ,'planchoose'=>$planchoose,'netasset2tbl'=>$netasset2tbl]);


    }


    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 21,
            'menu_id' => 1,
            'title' => 'ข้อมูลการลงทุน MEA FUND'
        ] );


        $netasset = $this->getDB_TBL_INFORMATION_FROM_ASSET();
        $netasset2 =$this->getDB_TBL_MEMBER_BENEFITS();
        $netasset2tbl =$this->getDB_TBL_MEMBER_BENEFITS_table();

        $empStart =DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID','=',get_userID())->first();


        $show = $this->isShowGraph($empStart);
        $graph = $this->getGraphColum($netasset);


        $graph2 = $this->getGraphBenefit($netasset2);
        $graph3 =$this->getGraphfund($netasset2,$show);

        $yearColume = $this->getYearDrop(null);
        $monthColum = $this->getMonthDrop(null);

        $monthColum2 = $this->getMonthDrop(null);
        $yearColume2 = $this->getYearDrop(null);


        $yearColumeend2 = $this->getYearDrop(null);
        $monthColumend2 = $this->getMonthDrop(null);


        $monthColum3 = $this->getMonthDrop(null);
        $yearColume3 = $this->getYearDrop(null);


        $yearColumeend3 = $this->getYearDrop(null);
        $monthColumend3 = $this->getMonthDrop(null);

        $show2 = 1;

        $empinfo = $this->getempINFO();
        $planchoose = $this->getPLanchoose();

        return view('frontend.pages.21p1')->with([
            'netasset' => $netasset,
            'graph' =>$graph ,
            'netasset2'=>$netasset2,
            'graph2'=>$graph2 ,
            'show'=>$show ,
            'graph3'=>$graph3,
            'yearColume' =>$yearColume ,
            'monthColum'=>$monthColum ,
            'yearColumeend2'=>$yearColumeend2,
            'monthColumend2'=>$monthColumend2,
            'monthColum2' => $monthColum2 ,
            'yearColume2'=>$yearColume2 ,
            'monthColum3'=>$monthColum3 ,
            'yearColume3'=>$yearColume3 ,
            'yearColumeend3'=>$yearColumeend3 ,
            'monthColumend3'=>$monthColumend3,
            'show2'=>$show2 ,
            'empinfo'=>$empinfo ,
            'planchoose'=>$planchoose,
            'netasset2tbl'=>$netasset2tbl]);

    }



    function getDB_TBL_INFORMATION_FROM_ASSET_bysearch($month,$year){
        $sql = "SELECT * FROM (
SELECT TOP  5 * FROM  TBL_INFORMATION_FROM_ASSET  WHERe MONTH(CREATE_DATE) = ".$month." AND YEAR(CREATE_DATE) = '".$year."' AND EMP_ID = ".get_userID()." ORDER BY CREATE_DATE DESC) As Tmp ORDER BY tmp.CREATE_DATE ASC";

        return  DB::select(DB::raw($sql));
    }


    function getDB_TBL_INFORMATION_FROM_ASSET(){

        $sql = "SELECT * FROM
(sELECT TOP  5 * FROM  TBL_INFORMATION_FROM_ASSET WHERe EMP_ID = ".get_userID()."  ORDER BY CREATE_DATE DESC) AS tmp
ORDER BY tmp.CREATE_DATE ASC";
//        $sql = "SELECT TOP  5 * FROM  TBL_INFORMATION_FROM_ASSET WHERe EMP_ID = ".get_userID()." ORDER BY CREATE_DATE DESC";
        return  DB::select(DB::raw($sql));
    }


    function  getDB_TBL_MEMBER_BENEFITS_bysearch($month,$year,$monthend,$yearend){

        $dateStart = new Date($year."-".$month."-1");

        $dateEnd = new Date($yearend."-".$monthend."-1");


        $datenextmont =  date ("Y-m-d", strtotime("+1 month", strtotime($dateEnd)));

        $dateEndreal = New Date(date("Y",strtotime($datenextmont))."-".date("m",strtotime($datenextmont))."-1");



        $sql2 = "SELECT TOP  12 * FROM  TBL_MEMBER_BENEFITS WHERe RECORD_DATE BETWEEN '".$dateStart->format('Y-m-d')."' AND  '" .$dateEndreal->format('Y-m-d')."' AND EMP_ID = ".get_userID()." ORDER BY RECORD_DATE ASC";

        return DB::select(DB::raw($sql2));
    }

    function  getDB_TBL_MEMBER_BENEFITS_bysearch_table($month,$year,$monthend,$yearend){

        $dateStart = new Date($year."-".$month."-1");

        $dateEnd = new Date($yearend."-".$monthend."-1");


        $datenextmont =  date ("Y-m-d", strtotime("+1 month", strtotime($dateEnd)));

        $dateEndreal = New Date(date("Y",strtotime($datenextmont))."-".date("m",strtotime($datenextmont))."-1");



        $sql2 = "SELECT  * FROM  TBL_MEMBER_BENEFITS WHERe RECORD_DATE BETWEEN '".$dateStart->format('Y-m-d')."' AND  '" .$dateEndreal->format('Y-m-d')."' AND EMP_ID = ".get_userID()." ORDER BY RECORD_DATE DESC";
        return DB::select(DB::raw($sql2));
    }


    function  getDB_TBL_MEMBER_BENEFITS(){

        $sql = "SELECT * FROM ( SELECT  TOP 12 *  FROM TBL_MEMBER_BENEFITS WHERe EMP_ID = ".get_userID()." ORDER BY RECORD_DATE DESC ) AS tmp  ORDER BY RECORD_DATE ASC";
        //return DB::table('TBL_MEMBER_BENEFITS')->where('EMP_ID','=',get_userID())->orderBy('RECORD_DATE', 'desc')->take(12)->get();
         return  DB::select(DB::raw($sql));
    }


    function  getDB_TBL_MEMBER_BENEFITS_table(){
        $sql2 = "SELECT  * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE DESC";
        return DB::select(DB::raw($sql2));
    }



    function  getempINFO(){
        $sql = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        return DB::select(DB::raw($sql))[0];

    }

    function  getPLanchoose(){

        $sql2 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $ret = DB::select(DB::raw($sql2));
        if($ret){
            return $ret[0];
        }else{
            return null;
        }


    }



    function getMonthDrop($month){

        if($month){
            $ret ="<option  value='1' >เลือกเดือน</option>";
        }else{
            $ret ="<option selected='selected' value='1' >เลือกเดือน</option>";
        }


        $arrMonth = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];

        for($i = 1; $i<=12;$i++){
            if($month){

                if($month == $i){
                    $ret = $ret . "<option selected='selected' value=".$i.">".$arrMonth[$i-1]."</option>";
                }else{
                    $ret = $ret . "<option value=".$i.">".$arrMonth[$i-1]."</option>";
                }

        }else{
                $ret = $ret . "<option value=".$i.">".$arrMonth[$i-1]."</option>";
            }


        }

        return $ret;

    }

    function  getYearDrop($year){

        $today = new Date();
        $currentyear = get_date_year($today);

        $arrDropYear = array();
        $count = 0;
        if($year){
            $ret ="<option value='2001' >เลือกปี</option>";
        }else{
            $ret ="<option selected='selected' value='2001' >เลือกปี</option>";
        }


        for($i = ((int)$currentyear) - 5; $i <=  $currentyear ; $i++){
            $arrDropYear[$count] = $i;


            if($year){
                if($year == ($i-543) ){
                    $ret = $ret . "<option selected='selected' value=".($i-543).">".$i."</option>";
                }else{
                    $ret = $ret . "<option value=".($i-543).">".$i."</option>";
                }

            }else{
                $ret = $ret . "<option value=".($i-543).">".$i."</option>";
            }





            $count = $count+1;


        }
        return $ret;
    }



    function  isShowGraph($empStart){
        $compardate = new Date('1995-11-3');


        $arrday = explode('/',$empStart->START_DATE);

        $day = $arrday[0];
        $mont = $arrday[1];
        $year =$arrday[2];

        if($mont < 10){
            $mont = intval($mont);
        }
        $stringDate = $day .'-'.$mont.'-'.$year;



        $START_DATE = new Date($stringDate);
        $show = true;
//        var_dump($START_DATE);
//        if($START_DATE < $compardate){
//
//        }else{
//            $show = false;
//        }

        return $show;
    }

    function  getGraphfund($netasset2,$show){



        $item2_1 =array();
        $item2_2 =array();
        $item1Date = array();



        if($show){

            $count1 = 0;
            foreach($netasset2 as $index => $arrItem2){
                $item2_1[$count1] =  ((float)$arrItem2->EMPLOYER_CONTRIBUTION_1) +  ((float)$arrItem2->MEMBER_EARNING_4) ;
                $item2_2[$count1] =  ((float)$arrItem2->GRATUITY) -  ((float)$arrItem2->GRATUITY_TAX) ;
                $count1 = $count1 +1;

            }

        }

        $count2 = 0;
        foreach($netasset2 as $index => $arrItem2){
            $item1[$count2] =  ((float)$arrItem2->EMPLOYER_EARNING_2) +  ((float)$arrItem2->MEMBER_EARNING_4) ;
            $item1Date[$count2] = get_date_nodate($arrItem2->RECORD_DATE);
            $count2 = $count2 +1;
        }
        //Graph 3
        $graph3["title"] = array("text" => 'เปรียบเทียบเงินกองทุนเลี้ยงชีพ กับเงินบำเหน็จ');
        $graph3["xAxis"] = array(
            "categories" => $item1Date
        );
        $graph3["exporting"] = array("enabled" => false);
        $graph3["credits"] = array("enabled" => false);
        $graph3["tooltip"] =array(
            "valueSuffix" => "บาท",
            "valueDecimals" => 2,
            "pointFormat" => "{point.y:,.2f}"
        );
        $graph3["yAxis"] = array(
            "title" => array("text"=>"(บาท)")
        );
        $graph3["legend"] = array(
            'align'=> 'right',
            'x'=> -30,
            'verticalAlign'=> 'top',
            'y'=> 25,
            'floating'=> true,
            'backgroundColor'=> '#fff',
            'borderColor'=> '#CCC',
            'borderWidth'=> 1,
            'shadow'=> false
        );
//        $graph3["legend"] = array(
//            'layout' => 'vertical',
//            'align' => 'right',
//            'verticalAlign'=> 'middle',
//            'borderWidth' => 0
//        );

        $graph3["series"] = array(
            array(
                "name" => "เงินสมทบ + ผลประโยชน์สมทบ",
                "color" => "#f35000",
                "data" =>$item2_1
            ),
            array(
                "name" => "เงินบำเหน็จสุทธิหลักหักภาษี",
                "data" =>$item2_2,
                "color" => "#FFBF3F"
            )
        );

        return $graph3;
    }

    function getGraphBenefit($netasset2){


        $item1 = array();
        $item1Date = array();

       $count = 0;
        foreach($netasset2 as $index => $arrItem2){

            $item1[$count] =  ((float)$arrItem2->EMPLOYER_EARNING_2) +  ((float)$arrItem2->MEMBER_EARNING_4) ;
            $item1Date[$count] = get_date_nodate($arrItem2->RECORD_DATE);
            $count = $count +1;
        }

        //Graph 2
        $graph2["title"] = array("text" => 'ผลประโยชน์สมาชิก');
        $graph2["xAxis"] = array(
            "categories" => $item1Date
        );
        $graph2["exporting"] = array("enabled" => false);
        $graph2["credits"] = array("enabled" => false);
        $graph2["tooltip"] =array(
            "valueSuffix" => "บาท",
            "valueDecimals" => 2,
            "pointFormat" => "{point.y:,.2f}"
        );
        $graph2["legend"] = array(
            'align'=> 'right',
            'x'=> -30,
            'verticalAlign'=> 'top',
            'y'=> 25,
            'floating'=> true,
            'backgroundColor'=> '#fff',
            'borderColor'=> '#CCC',
            'borderWidth'=> 1,
            'shadow'=> false
        );
        $graph2["yAxis"] = array(
            "title" => array("text"=>"(บาท)")
        );

//        $graph2["legend"] = array(
//            'layout' => 'vertical',
//            'align' => 'right',
//            'verticalAlign'=> 'middle',
//            'borderWidth' => 0
//        );

        $graph2["series"] = array(
            array(
                "name" => "จำนวนเงิน",
                "data" =>$item1,
                "color" => "#ffbf3f",
            )
        );

        return $graph2;
    }

    function getGraphColum($netasset){



        $euqity = array();
        $Debt = array();
        $DateCreate = array();

        $count=0;
        foreach($netasset as $index => $arrItem){

            $euqity[$count] =  (float)$arrItem->EQUITY;
            $Debt[$count] = (float)$arrItem->DEBT;
            $DateCreate[$count] = get_date_notime($arrItem->CREATE_DATE);

            $count = $count +1;

        }


        //piechart creation
        $graph["chart"] = array("type" => 'column','plotBackgroundColor' => NULL,'plotBorderWidth'=> NULL,'plotShadow'=> false );
        $graph["title"] = array("text" => 'สัดส่วนการลงทุน');
        $graph["exporting"] = array("enabled" => false);
        $graph["credits"] = array("enabled" => false);
        //$graph["tooltip"] = array("pointFormat" => '{series.name}: <b>{point.percentage:.1f}%</b>');
        $graph["legend"] = array(
            'align'=> 'right',
            'x'=> -30,
            'verticalAlign'=> 'top',
            'y'=> 25,
            'floating'=> true,
            'backgroundColor'=> '#fff',
            'borderColor'=> '#CCC',
            'borderWidth'=> 1,
            'shadow'=> false
        );

        $graph["xAxis"] = array(
            "categories" => $DateCreate
        );
        $graph["yAxis"] = array(
            "title" => array(
                "text" => "%(เปอร์เซ็นต์)"
            )
        );
        $graph["plotOptions"] = array(
            'column' =>array(
                'stacking'=> 'normal',

                'dataLabels'=>array(
                    'enabled'=>true,
                    'color' => "#fff " ,
                    'style'=>array(
                        'textShadow'=> '0 0 3px black'

                    )
                )

            )

        );
        $graph['series']=array(

            array(
                "name"=>'ตราสารหนี้',
                "color"=> "#ffbf3f",
                "data" => $Debt
            ),
            array(

                "name"=>'ตราสารทุน',
                "color"=> "#fe5000",
                "data" => $euqity
            )
        );

        return $graph;
    }


    public function ExportExcel1(Request $request)
    {
        //$sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $netasset2 = $this->getDB_TBL_MEMBER_BENEFITS_table();
        Excel::create('Export2', function($excel) use ($netasset2){

            $excel->sheet('New sheet', function($sheet)use ($netasset2) {
                $sheet->mergeCells('E1:H1');
                $sheet->mergeCells('E2:F2');
                $sheet->mergeCells('G2:H2');

                $sheet->setMergeColumn(array(
                    'columns' => array('A','B','C','D','I'),
                    'rows' => array(
                        array(1,3)

                    )
                ));
//                $sheet->setColumnFormat(array(
//                    'A' => '0.00',
//                    'B' => '0.00',
//                    'C' => '0.00',
//                    'D' => '0.00',
//                    'E' => '0.00',
//                    'F' => '0.00',
//                    'G' => '0.00',
//                    'H' => '0.00',
//                    'I' => '0.00',
//                ));
                $sheet->loadView('frontend.exels.21')->with(['netasset2' => $netasset2]);

            });

        })->download('xls');
    }
    public function ExportExcel2(Request $request)
    {
       // $sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $netasset2 = $this->getDB_TBL_MEMBER_BENEFITS_table();
        Excel::create('Export1', function($excel) use ($netasset2){

            $excel->sheet('New sheet', function($sheet)use ($netasset2) {
                $sheet->mergeCells('E1:J1');
                $sheet->mergeCells('K1:M1');
                $sheet->mergeCells('N1:P1');


                $sheet->mergeCells('E2:G2');
                $sheet->mergeCells('H2:J2');
//                $sheet->mergeCells('G2:H2');
//
                $sheet->setMergeColumn(array(
                    'columns' => array('A','B','C','D'),
                    'rows' => array(
                        array(1,3)

                    )
                ));

                $sheet->setMergeColumn(array(
                    'columns' => array('K','L','M','N','O','P'),
                    'rows' => array(
                        array(1,2)

                    )
                ));
//                $sheet->setColumnFormat(array(
//                    'A' => '0.00',
//                    'B' => '0.00',
//                    'C' => '0.00',
//                    'D' => '0.00',
//                    'E' => '0.00',
//                    'F' => '0.00',
//                    'G' => '0.00',
//                    'H' => '0.00',
//                    'I' => '0.00',
//                ));
                $sheet->loadView('frontend.exels.trends2')->with(['netasset2' => $netasset2]);

            });

        })->download('xls');
    }
}
