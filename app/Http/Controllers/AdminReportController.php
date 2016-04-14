<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Jenssegers\Date\Date;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportController extends Controller
{




    public function getreport1()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 1,
            'title' => getMenuName($data,58,1) . '|  MEA FUND'
        ] );

        $allquery = "SELECT * FROM TBL_INVESTMENT_PLAN";
        $planlist = DB::select(DB::raw($allquery));

        return view('backend.pages.report1')->with(['planlist'=>$planlist]);

    }

    public  function  DataSourceCount($ArrParam,$IsCase){
        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        if($IsCase) {

            $emp_id = $ArrParam['emp_id'];
            $depart = $ArrParam['depart'];
            $plan = $ArrParam['plan'];
            $date_start = $ArrParam['date_start'];
            $date_end = $ArrParam['date_end'];

            $check_name = $ArrParam["check_name"];
            $check_depart = $ArrParam["check_depart"];
            $check_plan = $ArrParam["check_plan"];
            $check_date = $ArrParam["check_date"];


            $where = " WHERE focus.EMP_ID IS NOT  NULL";

            if (!empty($emp_id) && $check_name == "true") {
                $where .= " AND focus.EMP_ID = '" . $emp_id . "'";
            }
            if (!empty($depart) && $check_depart == "true") {
                $where .= " AND em.DEP_SHT  = '" . $depart . "'";
            }
            if (!empty($plan) && $check_plan == "true") {
                $where .= " AND new.PLAN_ID = '" . $plan . "'";
            }
            if (!empty($date_start) && !empty($date_end) && $check_date == "true") {
                $where .= " AND new.MODIFY_DATE BETWEEN '" . $date_start . "' AND '" . $date_end . "'";
            }
        }

//        $where = " WHERE (focus.EMP_ID = '".$emp_id."' OR em.DEP_SHT  = '".$depart."' OR new.PLAN_ID = '".$plan."' OR new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."')";

        $allquery = "SELECT COUNT(focus.EMP_ID) AS total FROM (SELECT f.EMP_ID, MAX(f.MODIFY_DATE) as datenew FROM TBL_USER_FUND_CHOOSE f GROUP BY f.EMP_ID) AS focus INNER JOIN TBL_EMPLOYEE_INFO em ON em.EMP_ID = focus.EMP_ID CROSS APPLY ( SELECT TOP 1 be.LEVEL_CODE, be.AGE_YEAR FROM TBL_MEMBER_BENEFITS be WHERE be.EMP_ID = focus.EMP_ID ORDER BY be.RECORD_DATE DESC) AS mb CROSS APPLY ( SELECT TOP 1 fn.PLAN_ID,fn.EQUITY_RATE,fn.DEBT_RATE,fn.MODIFY_DATE FROM TBL_USER_FUND_CHOOSE fn WHERE fn.EMP_ID = focus.EMP_ID ORDER BY fn.MODIFY_DATE DESC) AS new OUTER APPLY (SELECT  TOP 1 ol.PLAN_ID,ol.EQUITY_RATE,ol.DEBT_RATE,ol.MODIFY_DATE FROM TBL_USER_FUND_CHOOSE ol WHERE ol.EMP_ID = focus.EMP_ID AND ol.MODIFY_DATE < new.MODIFY_DATE) As old";

        if($IsCase){
            $allquery .= $where;
        }

        $all = DB::select(DB::raw($allquery));
        return  $all[0]->total;
    }

    public  function  DataSource($ArrParam, $IsCase, $ispageing= true){

        $where = "";
        if($ispageing){
            $PageSize = $ArrParam['pagesize'];
            $PageNumber = $ArrParam['PageNumber'];
        }

        if($IsCase) {

            $emp_id = $ArrParam['emp_id'];
            $depart = $ArrParam['depart'];
            $plan = $ArrParam['plan'];
            $date_start = $ArrParam['date_start'];
            $date_end = $ArrParam['date_end'];

            $check_name =$ArrParam["check_name"] ;
            $check_depart =$ArrParam["check_depart"] ;
            $check_plan=$ArrParam["check_plan"] ;
            $check_date=$ArrParam["check_date"] ;


            $where = " WHERE focus.EMP_ID IS NOT  NULL";

            if (!empty($emp_id)&& $check_name== "true") {
                $where .= " AND focus.EMP_ID = '" . $emp_id . "'";
            }
            if (!empty($depart)&& $check_depart== "true") {
                $where .= " AND em.DEP_SHT  = '" . $depart . "'";
            }
            if (!empty($plan)&& $check_plan== "true") {
                $where .= " AND new.PLAN_ID = '" . $plan . "'";
            }
            if (!empty($date_start) && !empty($date_end)&& $check_date== "true") {
                $where .= " AND new.MODIFY_DATE BETWEEN '" . $date_start . "' AND '" . $date_end . "'";
            }
        }


        $query="SELECT focus.EMP_ID As EMP_ID,em.FULL_NAME AS FULL_NAME,em.DEP_SHT AS DEP_SHT,mb.LEVEL_CODE AS LEVEL_CODE,mb.AGE_YEAR AS AGE_YEAR,new.PLAN_ID AS PLAN_ID_NEW,new.EQUITY_RATE AS EQUITY_RATE_NEW,new.DEBT_RATE AS DEBT_RATE_NEW,new.MODIFY_DATE AS MODIFY_DATE_NEW ,old.PLAN_ID AS PLAN_ID_OLD,old.EQUITY_RATE AS EQUITY_RATE_OLD,old.DEBT_RATE AS DEBT_RATE_OLD,old.MODIFY_DATE AS MODIFY_DATE_OLD FROM (SELECT f.EMP_ID, MAX(f.MODIFY_DATE) as datenew FROM TBL_USER_FUND_CHOOSE f GROUP BY f.EMP_ID) AS focus INNER JOIN TBL_EMPLOYEE_INFO em ON em.EMP_ID = focus.EMP_ID CROSS APPLY ( SELECT TOP 1 be.LEVEL_CODE, be.AGE_YEAR FROM TBL_MEMBER_BENEFITS be WHERE be.EMP_ID = focus.EMP_ID ORDER BY be.RECORD_DATE DESC) AS mb CROSS APPLY ( SELECT TOP 1 fn.PLAN_ID,fn.EQUITY_RATE,fn.DEBT_RATE,fn.MODIFY_DATE FROM TBL_USER_FUND_CHOOSE fn WHERE fn.EMP_ID = focus.EMP_ID ORDER BY fn.MODIFY_DATE DESC) AS new OUTER APPLY (SELECT  TOP 1 ol.PLAN_ID,ol.EQUITY_RATE,ol.DEBT_RATE,ol.MODIFY_DATE FROM TBL_USER_FUND_CHOOSE ol WHERE ol.EMP_ID = focus.EMP_ID AND ol.MODIFY_DATE < new.MODIFY_DATE) AS old ";


        if($IsCase){
            $query .= $where;
        }

        $query .= " ORDER BY focus.datenew DESC";

        if($ispageing){
            $query .=  " OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }


        return DB::select(DB::raw($query));
    }

    public function ajax_report1_search(Request $request)
    {
//        $data = getmemulist();
//        $this->pageSetting( [
//            'menu_group_id' => 58,
//            'menu_id' => 1,
//            'title' => getMenuName($data,58,1) . '|  MEA FUND'
//        ] );

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');

        $emp_id = $request->input('emp_id');
        $depart = $request->input('depart');
        $plan = $request->input('plan');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        $check_name = $request->input('check_name');
        $check_depart = $request->input('check_depart');
        $check_plan = $request->input('check_plan');
        $check_date = $request->input('check_date');

        $ArrParam = array();
        $ArrParam["pagesize"] =$PageSize;
        $ArrParam["PageNumber"] =$PageNumber;
        $ArrParam["emp_id"] =$emp_id;
        $ArrParam["depart"] =$depart;
        $ArrParam["plan"] =$plan;
        $ArrParam["date_start"] =$date_start;
        $ArrParam["date_end"] =$date_end;

        $ArrParam["check_name"] =$check_name;
        $ArrParam["check_depart"] =$check_depart;
        $ArrParam["check_plan"] =$check_plan;
        $ArrParam["check_date"] =$check_date;


        $data = $this->DataSource($ArrParam,true);

        $totals =  $this->DataSourceCount($ArrParam,true);

        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click_search',$PageNumber);





        $returnHTML = view('backend.pages.ajax.ajax_report1')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data' => $data,
            'totals' => $totals,
            'PageSize' =>$PageSize,
            'PageNumber' =>$PageNumber

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }

    public function ajax_report1(Request $request)
    {
//        $data = getmemulist();
//        $this->pageSetting( [
//            'menu_group_id' => 58,
//            'menu_id' => 1,
//            'title' => getMenuName($data,58,1) . '|  MEA FUND'
//        ] );

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');
        $ArrParam = array();
        $ArrParam["pagesize"] =$PageSize;
        $ArrParam["PageNumber"] =$PageNumber;
        $ArrParam["emp_id"] ="";
        $ArrParam["depart"] ="";
        $ArrParam["plan"] ="";
        $ArrParam["date_start"] ="";
        $ArrParam["date_end"] ="";

        $data = $this->DataSource($ArrParam,false);

        $totals =  $this->DataSourceCount($ArrParam,false);
//
        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click',$PageNumber);




        $returnHTML = view('backend.pages.ajax.ajax_report1')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data' => $data,
            'totals' => $totals,
            'PageSize' =>$PageSize,
            'PageNumber' =>$PageNumber

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }


    public  function  ajax_report1_search_ana(Request $request){
        $ArrParam = array();
        $ArrParam["pagesize"] ="";
        $ArrParam["PageNumber"] ="";
        $ArrParam["emp_id"] ="";
        $ArrParam["depart"] ="";
        $ArrParam["plan"] ="";
        $ArrParam["date_start"] ="";
        $ArrParam["date_end"] ="";

        $per_start = $request->input('Perstart');
        $per_end = $request->input('PerEnd');
        $arrRet = array();
        $data = $this->DataSource($ArrParam,false,false);
        if($per_start < $per_end){



            for($i= $per_start; $i <=$per_end ; $i++ ){
                    $total = 0;
                if(count($data) > 0){

                    foreach($data as $item){
                        if($item->EQUITY_RATE_NEW == $i){
                            $total = $total +1;
                        }
                    }
                }

                $arrRet[$i] = $total;


            }
        }


        $returnHTML = view('backend.pages.ajax.ajax_report1_ana')->with([
            'arrRet'=> $arrRet,
            'data'=>$data,
            'per_start'=>$per_start,
            'per_end'=>$per_end

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));


    }


    public function ajax_report1_all_export()
    {

        $ArrParam = array();
        $ArrParam["pagesize"] ="";
        $ArrParam["PageNumber"] ="";
        $ArrParam["emp_id"] ="";
        $ArrParam["depart"] ="";
        $ArrParam["plan"] ="";
        $ArrParam["date_start"] ="";
        $ArrParam["date_end"] ="";
        // $sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $data = $this->DataSource($ArrParam,false,false);

        $results = array();
        foreach ($data as $item) {
//            $item->filed1 = 'some modification';
//            $item->filed2 = 'some modification2';
            $results[] = (array)$item;

            // $results[5] = get_date_notime($item->modify_new);

            #or first convert it and then change its properties using
            #an array syntax, it's up to you
        }


        Excel::create('ExcelExport', function ($excel) use ($results){

            $excel->sheet('Sheetname', function ($sheet) use ($results){

                $sheet->mergeCells('A1:M1');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Comic Sans MS');
                    $row->setFontSize(20);
                    $row->setAlignment('center');
                });

//                $header = array('รายชื่อสมาชิกเปลี่ยนอัตราสะสม');

                $sheet->row(1, array('รายชื่อสมาชิกทั้งหมดในระบบ'));




                $header[] = null;
                $header[0] = 'รหัสพนักงาน';
                $header[1] = "ชื่อ-นามสกุล";
                $header[2] = "หน่วยงาน";
                $header[3] = "ระดับ";
                $header[4] = "อายุ";
                $header[5] = "แผนการลงทุนเดิม";
                $header[6] = "ตราสารทุน(เดิม)";
                $header[7] = "ตราสารหนี้(เดิม)";
                $header[8] = "วันที่ทำรายการ(เดิม)";
                $header[9] = "แผนการลงทุนใหม่";
                $header[10] = "ตราสารทุน(ใหม่)";
                $header[11] = "ตราสารหนี้(ใหม่)";
                $header[12] = "วันที่ทำรายการ(ใหม่)";


                $sheet->row(2, $header);


                foreach ($results as $user) {

                    $sheet->appendRow($user);
                }



            });

        })->download('xls');

//        Excel::create('Export1', function($excel) use ($data){
//
//            $excel->sheet('New sheet', function($sheet)use ($data) {
//                $sheet->mergeCells('A1:M1');
//                $sheet->mergeCells('A3:M3');
//
//                $sheet->loadView('backend.pages.export.export_report1')->with([
//                    'data' => $data,
//                    'topic' => "รายชื่อสมาชิกทั้งหมดในระบบ"
//                ]);
//
//            });
//
//        })->download('xls');
    }
    public function ajax_report1_search_export()
    {
//        window.location.href =  "report1/exportsearch?EmpID=" + EmpID +"&depart=" + depart + "&plan=" + plan + "&date_start" + "&date_end=" + date_end;
//        Input::get("param");

        $ArrParam = array();
        $ArrParam["pagesize"] ="";
        $ArrParam["PageNumber"] ="";
        $ArrParam["emp_id"] =Input::get("EmpID");
        $ArrParam["depart"] =Input::get("depart");
        $ArrParam["plan"] =Input::get("plan");
        $ArrParam["date_start"] =Input::get("date_start");
        $ArrParam["date_end"] =Input::get("date_end");

        $ArrParam["check_name"] =Input::get("check_name");
        $ArrParam["check_depart"] =Input::get("check_depart");
        $ArrParam["check_plan"] =Input::get("check_plan");
        $ArrParam["check_date"] =Input::get("check_date");
        // $sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $data = $this->DataSource($ArrParam,true,false);


        $results = array();
        foreach ($data as $item) {
//            $item->filed1 = 'some modification';
//            $item->filed2 = 'some modification2';
            $results[] = (array)$item;

            // $results[5] = get_date_notime($item->modify_new);

            #or first convert it and then change its properties using
            #an array syntax, it's up to you
        }


        Excel::create('ExcelExport', function ($excel) use ($results,$ArrParam){

            $excel->sheet('Sheetname', function ($sheet) use ($results,$ArrParam){

                $sheet->mergeCells('A1:M1');
                $sheet->mergeCells('A2:M2');
                $sheet->mergeCells('A3:M3');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Comic Sans MS');
                    $row->setFontSize(20);
                    $row->setAlignment('center');
                });

                $sheet->row(2, function ($row) {$row->setAlignment('center');});
                $sheet->row(3, function ($row) {$row->setAlignment('center');});
//                $header = array('รายชื่อสมาชิกเปลี่ยนอัตราสะสม');

                $sheet->row(1, array('รายชื่อสมาชิกเปลี่ยนแผนการลงทุน'));
//                $sheet->row(2, array($ArrParam["date_start"] ));
                if($ArrParam["check_date"] == "true" && $ArrParam["date_start"] != "" && $ArrParam["date_end"] != ""){
                    $sheet->row(2, array('ในช่วงวันที่ ' . get_date_notime($ArrParam["date_start"]) . ' ถึง ' . get_date_notime($ArrParam["date_end"])   ));
                }



                $sheet->row(3, array('รายงานข้อมูล ณ วันที่ ' . get_date_notime(date("Y-m-d H:i:s"))));


                $header[] = null;
                $header[0] = 'รหัสพนักงาน';
                $header[1] = "ชื่อ-นามสกุล";
                $header[2] = "หน่วยงาน";
                $header[3] = "ระดับ";
                $header[4] = "อายุ";
                $header[5] = "แผนการลงทุนเดิม";
                $header[6] = "ตราสารทุน(เดิม)";
                $header[7] = "ตราสารหนี้(เดิม)";
                $header[8] = "วันที่ทำรายการ(เดิม)";
                $header[9] = "แผนการลงทุนใหม่";
                $header[10] = "ตราสารทุน(ใหม่)";
                $header[11] = "ตราสารหนี้(ใหม่)";
                $header[12] = "วันที่ทำรายการ(ใหม่)";


                $sheet->row(4, $header);


                foreach ($results as $user) {

                    $sheet->appendRow($user);
                }



            });

        })->download('xls');

//        Excel::create('Export1', function($excel) use ($data){
//
//            $excel->sheet('New sheet', function($sheet)use ($data) {
//                $sheet->mergeCells('A1:M1');
//                $sheet->mergeCells('A3:M3');
//
//                $sheet->loadView('backend.pages.export.export_report1')->with([
//                    'data' => $data,
//                    'topic' => "รายชื่อสมาชิกเปลี่ยนแผนการลงทุน"
//                ]);
//
//            });
//
//        })->download('xls');
    }

    public function ajax_report1_search_ana_export()
    {



        $ArrParam = array();
        $ArrParam["pagesize"] ="";
        $ArrParam["PageNumber"] ="";
        $ArrParam["emp_id"] ="";
        $ArrParam["depart"] ="";
        $ArrParam["plan"] ="";
        $ArrParam["date_start"] ="";
        $ArrParam["date_end"] ="";

        $per_start = Input::get("Perstart");
        $per_end = Input::get("PerEnd");
        $arrRet = array();
        $data = $this->DataSource($ArrParam,false,false);
        if($per_start < $per_end){



            for($i= $per_start; $i <=$per_end ; $i++ ){
                $total = 0;
                if(count($data) > 0){

                    foreach($data as $item){
                        if($item->EQUITY_RATE_NEW == $i){
                            $total = $total +1;
                        }
                    }
                }

                $arrRet[$i] = $total;


            }
        }



        Excel::create('ExcelExport', function ($excel) use ($arrRet){

            $excel->sheet('Sheetname', function ($sheet) use ($arrRet){



                $header[] = null;
                $header[0] = 'สัดส่วนตราสารทุน (%)';
                $header[1] = "จำนวน (คน)";


                $sheet->row(2, $header);



                foreach ($arrRet as $index => $item) {

                    if($arrRet[$index] > 0){
                        $data[] = null;
                        $data[0] = $index;
                        $data[1] = $arrRet[$index];
                        $sheet->appendRow($data);
                    }


                }




            });

        })->download('xls');

//        Excel::create('Export1', function($excel) use ($arrRet){
//
//            $excel->sheet('New sheet', function($sheet)use ($arrRet) {
////                $sheet->mergeCells('A1:M1');
////                $sheet->mergeCells('A3:M3');
//
//                $sheet->loadView('backend.pages.export.export_report1_ana')->with([
//                    'arrRet' => $arrRet
//
//                ]);
//
//            });
//
//        })->download('xls');
    }














}
