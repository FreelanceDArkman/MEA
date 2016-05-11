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

class AdminReport9Controller extends Controller
{


    public function getreport()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 9,
            'title' =>  getMenuName($data,58,9) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report9');
    }



    public  function  DataSourceCount($ArrParam,$IsCase){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $emp_id =$ArrParam['emp_id'];
        $depart = $ArrParam['depart'];
        $plan = $ArrParam['plan'];
        $date_start = $ArrParam['date_start'];
        $date_end = $ArrParam['date_end'];


        $check_name =$ArrParam["check_name"] ;
        $check_depart =$ArrParam["check_depart"] ;
        $check_plan=$ArrParam["check_plan"] ;
        $check_date=$ArrParam["check_date"] ;


        $where = " WHERE  fn.EMP_ID IS NOT  NULL";

        if (!empty($emp_id) && $check_name== "true") {
            $where .= " AND fn.EMP_ID = '" . $emp_id . "'";
        }
        if (!empty($depart) && $check_depart== "true") {
            $where .= " AND fn.DEP_SHT  = '" . $depart . "'";
        }
//        if (!empty($plan) && $check_plan== "true") {
//            $where .= " AND us.USER_STATUS_ID = '" . $plan . "'";
//        }
        if (!empty($date_start) && !empty($date_end) && $check_date== "true") {

            $arr_start = explode('.',$date_start);

            $arr_end =  explode('.',$date_end);

            $montstart  = $arr_start[1];
            $yearStart = $arr_start[0];

            $montend  = $arr_end[1];
            $yearend = $arr_end[0];


            $DateStart = new Date($yearStart ."-".$montstart."-1");



            $da =date('Y-m-d', strtotime("+1 months", strtotime($DateStart)));

            $DateEnd = date('Y-m-d', strtotime($da. ' - 1 days'));

            if($montstart<10){
                $montstart = "0".$montstart;
            }

            if($montend<10){
                $montend = "0".$montend;
            }
            $strStart = $yearStart .".".$montstart;
            $strEnd = $yearend .".".$montend;

            $where .= " AND mm.PERIOD  BETWEEN '" . $strStart . "' AND '" . $strEnd . "'";
        }


//        $where = " WHERE (focus.EMP_ID = '".$emp_id."' OR em.DEP_SHT  = '".$depart."' OR new.PLAN_ID = '".$plan."' OR new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."')";

        $allquery = "SELECT COUNT(fn.EMP_ID) AS total
FROM TBL_EMPLOYEE_INFO fn
OUTER APPLY ( SELECT TOP 1  m.PERIOD ,m.EMPLOYER_CONTRIBUTION_1,m.EMPLOYER_EARNING_2
,m.MEMBER_CONTRIBUTION_3,m.MEMBER_EARNING_4,(CAST(m.EMPLOYER_CONTRIBUTION_1  AS float)+ CAST(m.EMPLOYER_EARNING_2  AS float)+ CAST(m.MEMBER_EARNING_4 As float) + CAST(m.MEMBER_CONTRIBUTION_3 AS float) ) AS total FROM TBL_MEMBER_BENEFITS m WHERE m.EMP_ID= fn.EMP_ID ORDER BY m.PERIOD DESC)  mm";

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



            $where = " WHERE fn.EMP_ID IS NOT  NULL";

            if (!empty($emp_id) && $check_name == "true") {
                $where .= " AND fn.EMP_ID = '" . $emp_id . "'";
            }
            if (!empty($depart) && $check_depart== "true") {
                $where .= " AND fn.DEP_SHT  = '" . $depart . "'";
            }
//            if (!empty($plan) && $check_plan== "true") {
//                $where .= " AND us.USER_STATUS_ID = '" . $plan . "'";
//            }
            if (!empty($date_start) && !empty($date_end) && $check_date== "true") {



                $arr_start = explode('.',$date_start);

                $arr_end =  explode('.',$date_end);

                $montstart  = $arr_start[1];
                $yearStart = $arr_start[0];

                $montend  = $arr_end[1];
                $yearend = $arr_end[0];


                $DateStart = new Date($yearStart ."-".$montstart."-1");



                $da =date('Y-m-d', strtotime("+1 months", strtotime($DateStart)));

                $DateEnd = date('Y-m-d', strtotime($da. ' - 1 days'));

                if($montstart<10){
                    $montstart = "0".$montstart;
                }

                if($montend<10){
                    $montend = "0".$montend;
                }
                $strStart = $yearStart .".".$montstart;
                $strEnd = $yearend .".".$montend;

                $where .= " AND mm.PERIOD  BETWEEN '" . $strStart . "' AND '" . $strEnd . "'";
            }
        }


        $query="SELECT mm.PERIOD, fn.EMP_ID,fn.FULL_NAME,fn.DEP_SHT,mm.EMPLOYER_CONTRIBUTION_1,mm.EMPLOYER_EARNING_2,mm.MEMBER_CONTRIBUTION_3,mm.MEMBER_EARNING_4,mm.total
FROM TBL_EMPLOYEE_INFO fn
OUTER APPLY ( SELECT TOP 1  m.PERIOD ,m.EMPLOYER_CONTRIBUTION_1,m.EMPLOYER_EARNING_2
,m.MEMBER_CONTRIBUTION_3,m.MEMBER_EARNING_4,(CAST(m.EMPLOYER_CONTRIBUTION_1  AS float)+ CAST(m.EMPLOYER_EARNING_2  AS float)+ CAST(m.MEMBER_EARNING_4 As float) + CAST(m.MEMBER_CONTRIBUTION_3 AS float) ) AS total FROM TBL_MEMBER_BENEFITS m WHERE m.EMP_ID= fn.EMP_ID ORDER BY m.PERIOD DESC)  mm";


        if($IsCase){
            $query .= $where;
        }

        $query .= " ORDER BY mm.PERIOD DESC";

        if($ispageing){
            $query .=  " OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }


        return DB::select(DB::raw($query));
    }

    public function ajax_report_search(Request $request)
    {



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

        $data =null;
        $totals= 0;

        $data = $this->DataSource($ArrParam,true);

        $totals =  $this->DataSourceCount($ArrParam,true);

        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click_search',$PageNumber);





        $returnHTML = view('backend.pages.ajax.ajax_report9')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data' => $data,
            'totals' => $totals,
            'PageSize' =>$PageSize,
            'PageNumber' =>$PageNumber

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }


    public function ajax_report_search_export()
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

                //format
//                $sheet->setColumnFormat(array(
//                    'D' => '0.00',
//
//                ));
                //
                // first row styling and writing content
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->mergeCells('A3:I3');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Comic Sans MS');
                    $row->setFontSize(20);
                    $row->setAlignment('center');
                });

                $sheet->row(2, function ($row) {$row->setAlignment('center');});
                $sheet->row(3, function ($row) {$row->setAlignment('center');});

                $sheet->row(1, array('รายงานข้อมูลผลประโยชน์สมาชิก'));
                if($ArrParam["check_date"] == "true" && $ArrParam["date_start"] != "" && $ArrParam["date_end"] != ""){
                    $sheet->row(2, array('ในช่วงวันที่ ' . $ArrParam["date_start"] . ' ถึง ' . $ArrParam["date_end"]   ));
                }

                $sheet->row(3, array('รายงานข้อมูล ณ วันที่ ' . get_date_notime(date("Y-m-d H:i:s"))));

                $header[] = null;
                $header[0] = "งวด";
                $header[1] = 'รหัสพนักงาน';
                $header[2] = "ชื่อ-นามสกุล";
                $header[3] = "หน่วยงาน";
                $header[4] = "เงินสมทบ";
                $header[5] = "ผลประโยชน์เงินสมทบ";
                $header[6] = "เงินสะสม";
                $header[7] = "ผลประโยชน์เงินสะสม";
                $header[8] = "รวม";



                $sheet->row(4, $header);




                foreach ($results as $user) {


                    $sheet->appendRow($user);
                }


//                }
            });

        })->download('xls');

//        Excel::create('Export1', function($excel) use ($data){
//
//            $excel->sheet('New sheet', function($sheet)use ($data) {
//                $sheet->mergeCells('A1:M1');
//                $sheet->mergeCells('A3:M3');
//
//                $sheet->loadView('backend.pages.export.export_report2')->with([
//                    'data' => $data,
//                    'topic' => "รายชื่อสมาชิกเปลี่ยนอัตราสะสม"
//                ]);
//
//            });
//
//        })->download('xls');





    }



//    Search@2 -------------------------------------------

    public  function  DataSourceCount2($ArrParam,$IsCase){

        $PageSize = $ArrParam['pagesize'];
        $PageNumber = $ArrParam['PageNumber'];

        $emp_id =$ArrParam['emp_id'];
        $depart = $ArrParam['depart'];
        $plan = $ArrParam['plan'];
        $date_start = $ArrParam['date_start'];
        $date_end = $ArrParam['date_end'];


        $check_name =$ArrParam["check_name"] ;
        $check_depart =$ArrParam["check_depart"] ;
        $check_plan=$ArrParam["check_plan"] ;
        $check_date=$ArrParam["check_date"] ;


        $where = " WHERE  fn.EMP_ID IS NOT  NULL";

        if (!empty($emp_id) && $check_name== "true") {
            $where .= " AND fn.EMP_ID = '" . $emp_id . "'";
        }
        if (!empty($depart) && $check_depart== "true") {
            $where .= " AND fn.DEP_SHT  = '" . $depart . "'";
        }
//        if (!empty($plan) && $check_plan== "true") {
//            $where .= " AND us.USER_STATUS_ID = '" . $plan . "'";
//        }
        if (!empty($date_start) && !empty($date_end) && $check_date== "true") {
            $arr_start = explode('.',$date_start);

            $arr_end =  explode('.',$date_end);

            $montstart  = $arr_start[1];
            $yearStart = $arr_start[0];

            $montend  = $arr_end[1];
            $yearend = $arr_end[0];


            $DateStart = new Date($yearStart ."-".$montstart."-1");



            $da =date('Y-m-d', strtotime("+1 months", strtotime($DateStart)));

            $DateEnd = date('Y-m-d', strtotime($da. ' - 1 days'));

            if($montstart<10){
                $montstart = "0".$montstart;
            }

            if($montend<10){
                $montend = "0".$montend;
            }
            $strStart = $yearStart .".".$montstart;
            $strEnd = $yearend .".".$montend;

            $where .= " AND mm.PERIOD  BETWEEN '" . $strStart . "' AND '" . $strEnd . "'";
        }


//        $where = " WHERE (focus.EMP_ID = '".$emp_id."' OR em.DEP_SHT  = '".$depart."' OR new.PLAN_ID = '".$plan."' OR new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."')";

        $allquery = "SELECT COUNT(fn.EMP_ID) AS total
FROM TBL_EMPLOYEE_INFO fn
OUTER APPLY ( SELECT TOP 1  m.PERIOD ,m.EMPLOYER_CONTRIBUTION_1,m.EMPLOYER_EARNING_2
,m.MEMBER_CONTRIBUTION_3,m.MEMBER_EARNING_4,(CAST(m.EMPLOYER_CONTRIBUTION_1  AS float)+ CAST(m.EMPLOYER_EARNING_2  AS float)+ CAST(m.MEMBER_EARNING_4 As float) + CAST(m.MEMBER_CONTRIBUTION_3 AS float) ) AS total FROM TBL_MEMBER_BENEFITS m WHERE m.EMP_ID= fn.EMP_ID ORDER BY m.PERIOD DESC)  mm";

        if($IsCase){
            $allquery .= $where;
        }

        $all = DB::select(DB::raw($allquery));
        return  $all[0]->total;
    }

    public  function  DataSource2($ArrParam, $IsCase, $ispageing= true){

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



            $where = " WHERE fn.EMP_ID IS NOT  NULL";

            if (!empty($emp_id) && $check_name == "true") {
                $where .= " AND fn.EMP_ID = '" . $emp_id . "'";
            }
            if (!empty($depart) && $check_depart== "true") {
                $where .= " AND fn.DEP_SHT  = '" . $depart . "'";
            }
//            if (!empty($plan) && $check_plan== "true") {
//                $where .= " AND us.USER_STATUS_ID = '" . $plan . "'";
//            }
            if (!empty($date_start) && !empty($date_end) && $check_date== "true") {
                $arr_start = explode('.',$date_start);

                $arr_end =  explode('.',$date_end);

                $montstart  = $arr_start[1];
                $yearStart = $arr_start[0];

                $montend  = $arr_end[1];
                $yearend = $arr_end[0];


                $DateStart = new Date($yearStart ."-".$montstart."-1");



                $da =date('Y-m-d', strtotime("+1 months", strtotime($DateStart)));

                $DateEnd = date('Y-m-d', strtotime($da. ' - 1 days'));

                if($montstart<10){
                    $montstart = "0".$montstart;
                }

                if($montend<10){
                    $montend = "0".$montend;
                }
                $strStart = $yearStart .".".$montstart;
                $strEnd = $yearend .".".$montend;
                $where .= " AND mm.PERIOD  BETWEEN '" . $strStart . "' AND '" . $strEnd . "'";
            }
        }

//        (CAST(m.EMPLOYER_CONTRIBUTION_1  AS float)+ CAST(m.EMPLOYER_EARNING_2  AS float)+ CAST(m.MEMBER_EARNING_4 As float) + CAST(m.MEMBER_CONTRIBUTION_3 AS float) ) AS total
        $query="SELECT mm.PERIOD, fn.EMP_ID,fn.FULL_NAME,fn.DEP_SHT,mm.EMPLOYER_CONTRIBUTION_1,mm.EMPLOYER_EARNING_2,mm.MEMBER_CONTRIBUTION_3,mm.MEMBER_EARNING_4,mm.totalA,mm.tax,mm.totalAB
FROM TBL_EMPLOYEE_INFO fn
OUTER APPLY ( SELECT TOP 1  m.PERIOD ,m.EMPLOYER_CONTRIBUTION_1,m.EMPLOYER_EARNING_2
,m.MEMBER_CONTRIBUTION_3,m.MEMBER_EARNING_4,
(CAST(m.EMPLOYER_CONTRIBUTION_1 AS float) + CAST(EMPLOYER_EARNING_2 AS float)) AS totalA
,m.GRATUITY_TAX AS tax,
((CAST(m.EMPLOYER_CONTRIBUTION_1 AS float) + CAST(EMPLOYER_EARNING_2 AS float)) - CAST(m.GRATUITY_TAX As float)) AS totalAB

FROM TBL_MEMBER_BENEFITS m WHERE m.EMP_ID= fn.EMP_ID ORDER BY m.PERIOD DESC)  mm";


        if($IsCase){
            $query .= $where;
        }

        $query .= " ORDER BY mm.PERIOD DESC";

        if($ispageing){
            $query .=  " OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }


        return DB::select(DB::raw($query));
    }

    public function ajax_report_search2(Request $request)
    {



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

        $data =null;
        $totals= 0;

        $data = $this->DataSource2($ArrParam,true);

        $totals =  $this->DataSourceCount2($ArrParam,true);

        $htmlPaginate =Paginatre_gen($totals,$PageSize,'page_click_search',$PageNumber);





        $returnHTML = view('backend.pages.ajax.ajax_report9_2')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data' => $data,
            'totals' => $totals,
            'PageSize' =>$PageSize,
            'PageNumber' =>$PageNumber

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }


    public function ajax_report_search_export2()
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

        $data = $this->DataSource2($ArrParam,true,false);
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

                //format
//                $sheet->setColumnFormat(array(
//                    'D' => '0.00',
//
//                ));
                //
                // first row styling and writing content
                $sheet->mergeCells('A1:K1');
                $sheet->mergeCells('A2:K2');
                $sheet->mergeCells('A3:K3');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Comic Sans MS');
                    $row->setFontSize(20);
                    $row->setAlignment('center');
                });

                $sheet->row(2, function ($row) {$row->setAlignment('center');});
                $sheet->row(3, function ($row) {$row->setAlignment('center');});

                $sheet->row(1, array('รายงานข้อมูลเปรียบเทียบเงินกองทุนและเงินบำเหน็จ'));

                if($ArrParam["check_date"] == "true" && $ArrParam["date_start"] != "" && $ArrParam["date_end"] != ""){
                    $sheet->row(2, array('ในช่วงวันที่ ' . $ArrParam["date_start"] . ' ถึง ' . $ArrParam["date_end"]  ));
                }

                $sheet->row(3, array('รายงานข้อมูล ณ วันที่ ' . get_date_notime(date("Y-m-d H:i:s"))));

                $header[] = null;
                $header[0] = "งวด";
                $header[1] = 'รหัสพนักงาน';
                $header[2] = "ชื่อ-นามสกุล";
                $header[3] = "หน่วยงาน";
                $header[4] = "เงินสมทบ";
                $header[5] = "ผลประโยชน์เงินสมทบ";
                $header[6] = "เงินสะสม";
                $header[7] = "ผลประโยชน์เงินสะสม";
                $header[8] = "ผลรวมส่วนของนายจ้าง";
                $header[9] = "เงินบำเหน็จสุทธิหลังหักภาษี";
                $header[10] = "ส่วนต่าง";



                $sheet->row(4, $header);




                foreach ($results as $user) {


                    $sheet->appendRow($user);
                }


//                }
            });

        })->download('xls');

//        Excel::create('Export1', function($excel) use ($data){
//
//            $excel->sheet('New sheet', function($sheet)use ($data) {
//                $sheet->mergeCells('A1:M1');
//                $sheet->mergeCells('A3:M3');
//
//                $sheet->loadView('backend.pages.export.export_report2')->with([
//                    'data' => $data,
//                    'topic' => "รายชื่อสมาชิกเปลี่ยนอัตราสะสม"
//                ]);
//
//            });
//
//        })->download('xls');





    }







}
