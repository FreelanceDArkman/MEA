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

class UserManageCurrentController extends Controller
{

    public function getsimple()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 51,
            'menu_id' => 7,
            'title' => getMenuName($data,51,7) ." | MEA"
        ]);

        //$user_group = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC')->orderBy('USER_PRIVILEGE_ID', 'asc')->get();

        return view('backend.pages.usercurrent');
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

            foreach($results as $index => $value) {

//

                $im_date_start = $value["change_saving_rate_date"];
                $ret_data_start = str_replace("'","",$im_date_start);



                $im_date_modify = $value["effective_date"];
                $ret_data_modify = str_replace("'","",$im_date_modify);

//                var_dump($ret_data_start);

                $date_start = new Date($ret_data_start);

                $date_modify = new Date($ret_data_modify);



                $EMP_ID = $value["emp_id"];
//             $PERIOD = $value["period"];


              $allquery = "SELECT COUNT(EMP_ID) AS total FROM TBL_USER_SAVING_RATE  WHERE EMP_ID= '".$EMP_ID."' AND CHANGE_SAVING_RATE_DATE='".$date_start."'";

               $all = DB::select(DB::raw($allquery));
              $total =  $all[0]->total;

                if ($total == 0) {
                    array_push($data, array(
                        'EMP_ID' => $value["emp_id"],
                        'USER_SAVING_RATE' => $value["user_saving_rate"],
                        'CHANGE_SAVING_RATE_DATE' => $date_start,
                        'EFFECTIVE_DATE' => $date_modify,
                        'MODIFY_COUNT' => $value["modify_count"],
                        'MODIFY_BY' => $value["modify_by"]


                    ));
                }



            }

            DB::table('TBL_USER_SAVING_RATE')->insert($data);


        });



        return response()->json(array('success' => true, 'html'=>$ret));
    }


}
