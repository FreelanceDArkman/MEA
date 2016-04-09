<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
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

    public  function  DataSourceCount($request,$IsCase){
        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');

        $emp_id = $request->input('emp_id');
        $depart = $request->input('depart');
        $plan = $request->input('plan');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');


        $where = " WHERE focus.EMP_ID IS NOT  NULL";

        if(!empty($emp_id)){
            $where .= " AND focus.EMP_ID = '".$emp_id."'";
        }
        if(!empty($depart)){
            $where .= " AND em.DEP_SHT  = '".$depart."'";
        }
        if(!empty($plan)){
            $where .= " AND new.PLAN_ID = '".$plan."'";
        }
        if(!empty($date_start) && !empty($date_end)){
            $where .= " AND new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."'";
        }


//        $where = " WHERE (focus.EMP_ID = '".$emp_id."' OR em.DEP_SHT  = '".$depart."' OR new.PLAN_ID = '".$plan."' OR new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."')";

        $allquery = "SELECT COUNT(focus.EMP_ID) AS total FROM (SELECT f.EMP_ID, MAX(f.MODIFY_DATE) as datenew FROM TBL_USER_FUND_CHOOSE f GROUP BY f.EMP_ID) AS focus INNER JOIN TBL_EMPLOYEE_INFO em ON em.EMP_ID = focus.EMP_ID CROSS APPLY ( SELECT TOP 1 be.LEVEL_CODE, be.AGE_YEAR FROM TBL_MEMBER_BENEFITS be WHERE be.EMP_ID = focus.EMP_ID ORDER BY be.RECORD_DATE DESC) AS mb CROSS APPLY ( SELECT TOP 1 fn.PLAN_ID,fn.EQUITY_RATE,fn.DEBT_RATE,fn.MODIFY_DATE FROM TBL_USER_FUND_CHOOSE fn WHERE fn.EMP_ID = focus.EMP_ID ORDER BY fn.MODIFY_DATE DESC) AS new OUTER APPLY (SELECT  TOP 1 ol.PLAN_ID,ol.EQUITY_RATE,ol.DEBT_RATE,ol.MODIFY_DATE FROM TBL_USER_FUND_CHOOSE ol WHERE ol.EMP_ID = focus.EMP_ID AND ol.MODIFY_DATE < new.MODIFY_DATE) As old";

        if($IsCase){
            $allquery .= $where;
        }

        $all = DB::select(DB::raw($allquery));
        return  $all[0]->total;
    }

    public  function  DataSource($request, $IsCase, $ispageing= true){

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');

        $emp_id = $request->input('emp_id');
        $depart = $request->input('depart');
        $plan = $request->input('plan');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');


        $where = " WHERE focus.EMP_ID IS NOT  NULL";

        if(!empty($emp_id)){
            $where .= " AND focus.EMP_ID = '".$emp_id."'";
        }
        if(!empty($depart)){
            $where .= " AND em.DEP_SHT  = '".$depart."'";
        }
        if(!empty($plan)){
            $where .= " AND new.PLAN_ID = '".$plan."'";
        }
        if(!empty($date_start) && !empty($date_end)){
            $where .= " AND new.MODIFY_DATE BETWEEN '".$date_start."' AND '".$date_end."'";
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
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 1,
            'title' => getMenuName($data,58,1) . '|  MEA FUND'
        ] );

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');




        $data = $this->DataSource($request,true);

        $totals =  $this->DataSourceCount($request,true);

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
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 1,
            'title' => getMenuName($data,58,1) . '|  MEA FUND'
        ] );

        $PageSize = $request->input('pagesize');
        $PageNumber = $request->input('PageNumber');



        $data = $this->DataSource($request,false);

        $totals =  $this->DataSourceCount($request,false);
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


    public function ajax_report1_all_export(Request $request)
    {
        // $sql2 = "SELECT TOP  5 * FROM  TBL_MEMBER_BENEFITS WHERe EMP_ID = '".get_userID()."' ORDER BY RECORD_DATE ASC";
        $data = $this->DataSource($request,false,false);

        Excel::create('Export1', function($excel) use ($data){

            $excel->sheet('New sheet', function($sheet)use ($data) {
//                $sheet->mergeCells('E1:J1');
//                $sheet->mergeCells('K1:M1');
//                $sheet->mergeCells('N1:P1');
//
//
//                $sheet->mergeCells('E2:G2');
//                $sheet->mergeCells('H2:J2');
////                $sheet->mergeCells('G2:H2');
////
//                $sheet->setMergeColumn(array(
//                    'columns' => array('A','B','C','D'),
//                    'rows' => array(
//                        array(1,3)
//
//                    )
//                ));
//
//                $sheet->setMergeColumn(array(
//                    'columns' => array('K','L','M','N','O','P'),
//                    'rows' => array(
//                        array(1,2)
//
//                    )
//                ));
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
                $sheet->loadView('backend.pages.export.export_report1')->with([
                    'data' => $data
                ]);

            });

        })->download('xls');
    }
    public function ajax_report1_search_export(Request $request)
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
                $sheet->loadView('backend.pages.export.export_report1')->with([
                    'netasset2' => $netasset2
                ]);

            });

        })->download('xls');
    }

    public function getreport2()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 2,
            'title' =>  getMenuName($data,58,2) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport3()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 3,
            'title' => getMenuName($data,58,3) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport4()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 4,
            'title' => getMenuName($data,58,4) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport5()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 5,
            'title' =>  getMenuName($data,58,5) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport6()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 6,
            'title' =>  getMenuName($data,58,6) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport7()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 7,
            'title' =>  getMenuName($data,58,7) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport8()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 8,
            'title' =>  getMenuName($data,58,8) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport9()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 9,
            'title' =>  getMenuName($data,58,9) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport10()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 10,
            'title' =>  getMenuName($data,58,10) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport11()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 11,
            'title' => getMenuName($data,58,11) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport12()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 12,
            'title' =>  getMenuName($data,58,12) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport13()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 13,
            'title' =>  getMenuName($data,58,13) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }


}
