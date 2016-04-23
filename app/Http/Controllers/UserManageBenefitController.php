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



//        var_dump(getenv('BENEFICIARY_PDF_PATH'));
        $data = array();

        foreach($request->file() as $value){
//            $file = $request->file('exelimport_' . $index);
            $file = $value->getClientOriginalName();
            $emp_id = explode('.',$file)[0];
            $extension = explode('.',$file)[1];

            $full_name = "";
            $file_name = $emp_id . "." . $extension;
            $filePath = "";

            $qfullname = "SELECT FULL_NAME FROM TBL_EMPLOYEE_INFO WHERE EMP_ID= '".$emp_id."'";
             $datafull_name = DB::select(DB::raw($qfullname));
            if($datafull_name)
            {
                $full_name = $datafull_name[0]->FULL_NAME;
            }


            $qfileName = "SELECT WEB_BENEFICIARY_ROOT_PATH FROM TBL_CONTROL_CFG";
            $datafile_name= DB::select(DB::raw($qfileName));
            if($datafile_name)
            {
                $filePath = $datafile_name[0]->WEB_BENEFICIARY_ROOT_PATH . $emp_id . ".pdf";
            }

            $allquery = "SELECT COUNT(EMP_ID) AS total FROM TBL_USER_BENEFICIARY  WHERE EMP_ID= '".$emp_id."'";
            $all = DB::select(DB::raw($allquery));
            $total =  $all[0]->total;
            $date = new Date();

            if ($total == 0) {
                array_push($data,array(
                    'EMP_ID' => $emp_id,
                    'FULL_NAME' =>$full_name,
                    'FILE_NO' => 1,
                    'FILE_PATH' =>$filePath,
                    'CREATE_DATE' => $date,
                    'CREATE_BY' => '"Admin"',
                    'FILE_NAME' =>$file_name,

                ));

                $value->move(storage_path().getenv('BENEFICIARY_PDF_PATH') , $file_name);
            }

        }



        DB::table('TBL_USER_BENEFICIARY')->insert($data);



        return response()->json(array('success' => true, 'html'=>"ok"));
    }
}
