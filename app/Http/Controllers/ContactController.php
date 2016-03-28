<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package\Curl;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use App\Package\MeaAgent;

class ContactController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'ติดต่อ กสช | MEA FUND'
        ] );


        $sqlinfo = "SELECT * FROM TBL_EMPLOYEE_INFO info
INNER JOIN TBL_USER us ON us.EMP_ID = info.EMP_ID
WHERe info.EMP_ID = '".get_userID()."'";

        $userinfo =  DB::select(DB::raw($sqlinfo));

        if($userinfo){

            return view('frontend.pages.8p1')->with(['userinfo'=>$userinfo]);
        }else{

            return view('frontend.pages.8p1');
        }

    }


    public function  SendMail(Request $request){

       /// var_dump($request);$name = $_POST['name'];

        $name = $_POST['name'];
        $email = $_POST['email'];

        $phone = $_POST['PHONE'];
        $DEP_LNG= $_POST['DEP_LNG'];
        $TYPE_TOPIC = $_POST['TYPE_TOPIC'];

        $detail = $_POST['DETAIL'];

        $create_date = new Date();


        $sql = "INSERT INTO tbl_inform (INFM_NAME,INFM_EMAIL,INFM_PHONE,INFM_DEPT,INFM_TOPIC,INFM_DETAIL,INFM_FLAG) VALUES('".$name."','".$email."','".$phone."','".$DEP_LNG."','".$TYPE_TOPIC."','".$detail."',0)";




        $ret =  DB::insert(DB::raw($sql));

        $val =  array(
            "emp_id" => get_userID(),
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "DEP_LNG"=>$DEP_LNG,
            "TYPE_TOPIC"=>$TYPE_TOPIC,
            "detail"=>$detail

        );

        if($ret){
            Logprocess(6,$val);
        }


//
        return redirect()->to('/contact')->with('message','ok');




    }
}
