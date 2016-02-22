<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class TrendsController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 21,
            'menu_id' => 1,
            'title' => 'จัดการผู้ใช้'
        ] );


        $sql = "SELECT TOP  5 * FROM  TBL_INFORMATION_FROM_ASSET WHERe EMP_ID = ".get_userID()." ORDER BY CREATE_DATE ASC";
        $netasset = DB::select(DB::raw($sql));


        $sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $netasset2 = DB::select(DB::raw($sql2));

        //$netasset  = DB::table('TBL_INFORMATION_FROM_ASSET')->where('EMP_ID','=',get_userID())->take(5)->get()->count();





        $empStart =DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID','=',get_userID())->first();

        $START_DATE = new Date($empStart->START_DATE);

        $compardate = new Date('1995-11-3');

        $show = true;








        $item1 = array();
        $item1Date = array();

        $euqity = array();
        $Debt = array();
        $DateCreate = array();

        foreach($netasset as $index => $arrItem){

            $euqity[$index] =  (float)$arrItem->EQUITY;
            $Debt[$index] = (float)$arrItem->DEBT;
            $DateCreate[$index] = get_date_nodate($arrItem->CREATE_DATE);

         }

        foreach($netasset2 as $index => $arrItem2){
            $item1[$index] =  ((float)$arrItem2->EMPLOYER_EARNING_2) +  ((float)$arrItem2->MEMBER_EARNING_4) ;
            $item1Date[$index] = get_date_nodate($arrItem2->RECORD_DATE);
        }

        $item2_1 =array();
        $item2_2 =array();

        $item2Date=array();

//        var_dump($compardate->format('d M Y'));
        if($START_DATE < $compardate){

            foreach($netasset2 as $index => $arrItem2){
                $item2_1[$index] =  ((float)$arrItem2->EMPLOYER_CONTRIBUTION_1) +  ((float)$arrItem2->MEMBER_EARNING_4) ;
                $item2_2[$index] =  ((float)$arrItem2->GRATUITY) -  ((float)$arrItem2->GRATUITY_TAX) ;


            }

        }else{
            $show = false;
        }

        //var_dump($item1);
//        $('#container2').highcharts({
//                title: {
//        text: 'ผลประโยชน์สมาชิก',
//                    x: -20 //center
//                },
//
//                xAxis: {
//        categories: ['Jan 2558', 'Feb 2558', 'Mar 2558', 'Apr 2558']
//                },
//                yAxis: {
//        title: {
//            text: null
//                    },
//        plotLines: [{
//            value: 0,
//                        width: 1,
//                        color: '#808080'
//                    }]
//                },
//                tooltip: {
//        valueSuffix: '°C'
//                },
//                legend: {
//        layout: 'vertical',
//                    align: 'right',
//                    verticalAlign: 'middle',
//                    borderWidth: 0
//                },
//                series: [{
//        name: 'Tokyo',
//                    data: [7.0, 6.9, 9.5, 14.5, 18.2]
//                }]
//            });

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
            "title" => array("text"=>null)
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
                "data" =>$item1
            )
        );


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
            "title" => array("text"=>null)
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
                "data" =>$item2_2
            )
        );


//        var_dump($Debt);

//Graph 1

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
            "title" => null
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




        return view('frontend.pages.21p1')->with(['netasset' => $netasset,'graph' =>$graph , 'netasset2'=>$netasset2, 'graph2'=>$graph2 , 'show'=>$show , 'graph3'=>$graph3]);
    }
}
