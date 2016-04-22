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

class UserManageBenefitcontroller extends Controller
{

    public function getsimple()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 51,
            'menu_id' => 4,
            'title' => getMenuName($data,51,4) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.userbenefit');
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
                $EMP_ID = $value["emp_id"];
//                $PERIOD = $value["period"];
//                $user = DB::table('TBL_MEMBER_BENEFITS')->where('EMP_ID', $EMP_ID)->where('PERIOD', $PERIOD)->count();
                $allquery = "SELECT COUNT(EMP_ID) AS total FROM TBL_USER_BENEFICIARY  WHERE EMP_ID= '".$EMP_ID."'";

                $all = DB::select(DB::raw($allquery));
               $total =  $all[0]->total;
                    $date = new Date();
//                array_push($data,'asd','asda');

                if ($total == 0) {
                        array_push($data,array(
                            'EMP_ID' => $value["emp_id"],
                            'FULL_NAME' =>$value["full_name"],
                            'FILE_NO' => $value["file_no"],
                            'FILE_PATH' => $value["file_path"],
                            'CREATE_DATE' => $value["create_date"],
                            'CREATE_BY' => $value["create_by"],
                            'FILE_NAME' =>$value["file_name"]

                        ));


                }

            }

//            var_dump($data);
            DB::table('TBL_USER_BENEFICIARY')->insert($data);
            //DB::insert(DB::raw($insert));
        });



        return response()->json(array('success' => true, 'html'=>$ret));
    }

    public function importdata_pdf(Request $request){



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
                $EMP_ID = $value["emp_id"];
//                $PERIOD = $value["period"];
//                $user = DB::table('TBL_MEMBER_BENEFITS')->where('EMP_ID', $EMP_ID)->where('PERIOD', $PERIOD)->count();
                $allquery = "SELECT COUNT(EMP_ID) AS total FROM TBL_USER_BENEFICIARY  WHERE EMP_ID= '".$EMP_ID."'";

                $all = DB::select(DB::raw($allquery));
                $total =  $all[0]->total;
                $date = new Date();
//                array_push($data,'asd','asda');

                if ($total == 0) {
                    array_push($data,array(
                        'EMP_ID' => $value["emp_id"],
                        'FULL_NAME' =>$value["full_name"],
                        'FILE_NO' => $value["file_no"],
                        'FILE_PATH' => $value["file_path"],
                        'CREATE_DATE' => $value["create_date"],
                        'CREATE_BY' => $value["create_by"],
                        'FILE_NAME' =>$value["file_name"]

                    ));


                }

            }

//            var_dump($data);
            DB::table('TBL_USER_BENEFICIARY')->insert($data);
            //DB::insert(DB::raw($insert));
        });



        return response()->json(array('success' => true, 'html'=>$ret));
    }
}
