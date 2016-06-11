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

class UserManageExtendController extends Controller
{

    public function getsimple()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 51,
            'menu_id' => 6,
            'title' => getMenuName($data,51,6) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.userextend');
    }
    public  function  dowloadsample(){
        $file = 'contents/sample/member_contribution.xls';
        $headers = array(
            'Content-Type: application/pdf',
        );
        return \Response::download($file, 'member_contribution.xls', $headers);
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




            foreach($results as $index => $value) {

//
//                $rest = substr("abcdef", -1);    // returns "f"
//                $rest = substr("abcdef", -2);    // returns "ef"
//                $rest = substr("abcdef", -3, 1);



                $im_date_start = $value["contribution_start_date"];
                $ret_data_start = str_replace("'","",$im_date_start);



                $im_date_end = $value["contribution_end_date"];
                $ret_data_end = str_replace("'","",$im_date_end);

                $im_date_modify = $value["contribution_modify_date"];
                $ret_data_modify = str_replace("'","",$im_date_modify);

//                var_dump($ret_data_start);

//                var_dump($ret_data_start);

                $date_start = new Date($ret_data_start);
                $date_end = new Date($ret_data_end);
                $date_modify = new Date($ret_data_modify);



                $update = array(
                    'EMP_ID' => $value["emp_id"],
                    'CONTRIBUTION_START_DATE' =>$date_start,
                    'CONTRIBUTION_END_DATE' => $date_end,
                    'CONTRIBUTION_MODIFY_DATE' => $date_modify,
                    'CONTRIBUTION_RATE_OLD' => $value["contribution_rate_old"],
                    'CONTRIBUTION_RATE_NEW' => $value["contribution_rate_new"]


                );

                DB::table('TBL_EMPLOYEE_INFO')->where('EMP_ID',"=",$value["emp_id"])->update($update);


            }


        });



        return response()->json(array('success' => true, 'html'=>$ret));
    }


}
