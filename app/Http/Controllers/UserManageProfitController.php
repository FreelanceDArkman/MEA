<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package\Curl;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Input;
use Illuminate\Http\UploadedFile;

class UserManageProfitController extends Controller
{

    public function getsimple()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 51,
            'menu_id' => 5,
            'title' => getMenuName($data,51,5) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.userprofit');
    }
    public  function  dowloadsample(){
        $file = 'contents/sample/member_investment_ratio.xls';
        $headers = array(
            'Content-Type: application/pdf',
        );
        return \Response::download($file, 'member_investment_ratio.xls', $headers);
    }
    public  function  Checkdate(Request $request){

        $results = null;

        $result=   Excel::load($request->file('exelimport'))->get();
        $count = $result->count();
//
//      Excel::load($request->file('exelimport'), function ($reader) use($count) {
//
//            $results = $reader->get();
//
//            $ret = $results->toArray();
//
//
//            $count = count($ret);
//
//
//        });

        return response()->json(array('success' => true, 'html'=>$count));



    }


    public function importdata(Request $request){



        $results = null;


//        $results = $reader->get();
//
//        $ret = $results->toArray();

        $file = $request->file('exelimport');


        $request->file('exelimport')->move(storage_path().'/public/import/' , 'import.xlsx');

        //$request->file('exelimport')

//        $results =    Excel::load($request->file('exelimport'))->toArray();

        $ret = Excel::filter('chunk')->load(storage_path('/public/import/import.xlsx'))->chunk(250, function($results){

            $data = array();

//            $results = $reader->toArray();
            foreach($results as $index => $value) {
//                $EMP_ID = $value["emp_id"];
//                $PERIOD = $value["period"];
//                $user = DB::table('TBL_MEMBER_BENEFITS')->where('EMP_ID', $EMP_ID)->where('PERIOD', $PERIOD)->count();
//                $allquery = "SELECT COUNT(EMP_ID) AS total FROM TBL_MEMBER_BENEFITS  WHERE EMP_ID= '".$EMP_ID."' AND (PERIOD='".$PERIOD."' OR PERIOD IS NULL)";

//                $all = DB::select(DB::raw($allquery));
//               $total =  $all[0]->total;
                    $date = new Date();
//                array_push($data,'asd','asda');

//                if ($total == 0) {
                        array_push($data,array(
                            'EMP_ID' => $value["emp_id"],
                            'INVESTMENT_PLAN' =>$value["investment_plan"],
                            'EQUITY' => $value["equity"],
                            'DEBT' => $value["debt"],
                            'EQUITY_FUNDS' => $value["equity_funds"],
                            'BOND_FUNDS' => $value["bond_funds"],
                            'INVESTMENT_MONEY' =>$value["investment_money"],
                            'REFERENCE_DATE' => $value["reference_date"],
                            'MEMBER_STATUS' => $value["member_status"],
                            'CREATE_DATE' => $date



                        ));


//                }

            }

//            var_dump($data);
            DB::table('TBL_INFORMATION_FROM_ASSET')->insert($data);
            //DB::insert(DB::raw($insert));
        });



        return response()->json(array('success' => true, 'html'=>$ret));
    }


}
