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

class AdminReport2Controller extends Controller
{


    public function getreport2()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 2,
            'title' =>  getMenuName($data,58,2) . '|  MEA FUND'
        ] );

//        $allquery = "SELECT * FROM TBL_INVESTMENT_PLAN";
//        $planlist = DB::select(DB::raw($allquery));->with(['planlist'=>$planlist]);
        return view('backend.pages.report2');
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

        $where = " WHERE focus.EMP_ID IS NOT  NULL";

        if(!empty($emp_id)&& $check_name== "true"){
            $where .= " AND focus.EMP_ID = '".$emp_id."'";
        }
        if(!empty($depart)&& $check_depart== "true"){
            $where .= " AND em.DEP_SHT  = '".$depart."'";
        }
        if(!empty($plan)&& $check_plan== "true"){
            $where .= " AND new.USER_SAVING_RATE = '".$plan."'";
        }
        if(!empty($date_start) && !empty($date_end)&& $check_date== "true"){
            $where .= " AND new.CHANGE_SAVING_RATE_DATE  BETWEEN '".$date_start."' AND '".$date_end."'";
        }


//        $where = " WHERE (focus.EMP_ID = '".$emp_id."' OR em.DEP_SHT  = '".$depart."' OR new.PLAN_ID = '".$plan."' OR new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."')";

        $allquery = "SELECT COUNT(focus.EMP_ID ) AS total FROM (SELECT f.EMP_ID, MAX(f.CHANGE_SAVING_RATE_DATE) as datenew FROM TBL_USER_SAVING_RATE f GROUP BY f.EMP_ID) AS focus INNER JOIN TBL_EMPLOYEE_INFO em ON em.EMP_ID = focus.EMP_ID CROSS APPLY (SELECT TOP 1 fn.USER_SAVING_RATE,fn.CHANGE_SAVING_RATE_DATE , fn.EFFECTIVE_DATE, fn.MODIFY_BY FROM TBL_USER_SAVING_RATE fn WHERE fn.EMP_ID = focus.EMP_ID ORDER BY fn.CHANGE_SAVING_RATE_DATE DESC) AS new OUTER APPLY (SELECT TOP 1 ol.USER_SAVING_RATE FROM TBL_USER_SAVING_RATE ol WHERE ol.EMP_ID = focus.EMP_ID AND ol.CHANGE_SAVING_RATE_DATE <new.CHANGE_SAVING_RATE_DATE) AS old";

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

            if(!empty($emp_id)&& $check_name== "true"){
                $where .= " AND focus.EMP_ID = '".$emp_id."'";
            }
            if(!empty($depart)&& $check_depart== "true"){
                $where .= " AND em.DEP_SHT  = '".$depart."'";
            }
            if(!empty($plan)&& $check_plan== "true"){
                $where .= " AND new.USER_SAVING_RATE = '".$plan."'";
            }
            if(!empty($date_start) && !empty($date_end)&& $check_date== "true"){
                $where .= " AND new.CHANGE_SAVING_RATE_DATE  BETWEEN '".$date_start."' AND '".$date_end."'";
            }
        }


        $query="SELECT focus.EMP_ID As EMP_ID,em.FULL_NAME AS FULL_NAME,em.DEP_SHT AS DEP_SHT ,old.USER_SAVING_RATE as rate_old, new.USER_SAVING_RATE AS rate_new,new.CHANGE_SAVING_RATE_DATE AS modify_new , new.EFFECTIVE_DATE AS effec_new,new.MODIFY_BY AS new_modify_by,new.STATUS_DESC,new.LEAVE_FUND_GROUP_DATE
FROM (SELECT f.EMP_ID, MAX(f.CHANGE_SAVING_RATE_DATE) as datenew FROM TBL_USER_SAVING_RATE f GROUP BY f.EMP_ID) AS focus
INNER JOIN TBL_EMPLOYEE_INFO em ON em.EMP_ID = focus.EMP_ID CROSS APPLY (SELECT TOP 1 fn.USER_SAVING_RATE,fn.CHANGE_SAVING_RATE_DATE , fn.EFFECTIVE_DATE, fn.MODIFY_BY,uss.STATUS_DESC,fn.USER_STATUS_ID,fn.LEAVE_FUND_GROUP_DATE FROM TBL_USER_SAVING_RATE fn LEFT OUTER JOIN TBL_USER_STATUS uss ON uss.USER_STATUS_ID = fn.USER_STATUS_ID WHERE fn.EMP_ID = focus.EMP_ID ORDER BY fn.CHANGE_SAVING_RATE_DATE DESC) AS new
OUTER APPLY (SELECT TOP 1 ol.USER_SAVING_RATE FROM TBL_USER_SAVING_RATE ol WHERE ol.EMP_ID = focus.EMP_ID AND ol.CHANGE_SAVING_RATE_DATE <new.CHANGE_SAVING_RATE_DATE ORDER BY ol.CHANGE_SAVING_RATE_DATE DESC) AS old";


        if($IsCase){
            $query .= $where;
        }

        $query .= " ORDER BY focus.datenew DESC";

        if($ispageing){
            $query .=  " OFFSET ".$PageSize." * (".$PageNumber." - 1) ROWS FETCH NEXT ".$PageSize." ROWS ONLY OPTION (RECOMPILE)";
        }


        return DB::select(DB::raw($query));
    }

    public function ajax_report2_search(Request $request)
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





        $returnHTML = view('backend.pages.ajax.ajax_report2')->with([
            'htmlPaginate'=> $htmlPaginate,
            'data' => $data,
            'totals' => $totals,
            'PageSize' =>$PageSize,
            'PageNumber' =>$PageNumber

        ])->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }




    public function ajax_report2_search_export()
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
                $sheet->mergeCells('A1:J1');
                $sheet->mergeCells('A2:J2');
                $sheet->mergeCells('A3:J3');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Comic Sans MS');
                    $row->setFontSize(20);
                    $row->setAlignment('center');
                });


                $sheet->row(2, function ($row) {$row->setAlignment('center');});
                $sheet->row(3, function ($row) {$row->setAlignment('center');});
//                $header = array('รายชื่อสมาชิกเปลี่ยนอัตราสะสม');

                $sheet->row(1, array('รายชื่อสมาชิกเปลี่ยนอัตราสะสม'));

                if($ArrParam["check_date"] == "true" && $ArrParam["date_start"] != "" && $ArrParam["date_end"] != ""){
                    $sheet->row(2, array('ในช่วงวันที่ ' . get_date_notime($ArrParam["date_start"]) . ' ถึง ' . get_date_notime($ArrParam["date_end"])   ));
                }


                $sheet->row(3, array('รายงานข้อมูล ณ วันที่ ' . get_date_notime(date("Y-m-d H:i:s"))));

                $header[] = null;
                $header[0] = 'รหัสพนักงาน';
                $header[1] = "ชื่อ-นามสกุล";
                $header[2] = "หน่วยงาน";
                $header[3] = "อัตราสะสม(เดิม)";
                $header[4] = "อัตราสะสม(ใหม่)";
                $header[5] = "วันที่ทำรายการ";
                $header[6] = "วันที่มีผล";
                $header[7] = "ผู้ทำรายการ";
                $header[8] = "สถานะ";
                $header[9] = "วันที่พ้นสภาพ";


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
