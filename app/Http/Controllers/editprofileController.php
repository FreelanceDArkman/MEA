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

class editprofileController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 20,
            'menu_id' => 1,
            'title' => 'แก้ไขข้อมูลส่วนตัว | MEA FUND'
        ] );

        $agent = new MeaAgent();
//        var_dump($agent->device());
        $sqlinfo = "SELECT * FROM TBL_EMPLOYEE_INFO info
INNER JOIN TBL_USER us ON us.EMP_ID = info.EMP_ID
WHERe info.EMP_ID = '".get_userID()."'";
        $userinfo =  DB::select(DB::raw($sqlinfo))[0];



        $sqlbenefit = "SELECT * FROM TBL_USER_BENEFICIARY  WHERe EMP_ID = '".get_userID()."' ORDER BY CREATE_DATE DESC";
        $userbenefit =  DB::select(DB::raw($sqlbenefit));


        $sql44  = "SELECT TOP 1 * FROM TBL_INFORMATION_FROM_ASSET WHERE EMP_ID =  '".get_userID()."' ORDER BY CREATE_DATE DESC";


        $infoaset_db = DB::select(DB::raw($sql44));
        $infoaset = null;
        if($infoaset_db){
            $infoaset = $infoaset_db[0];
        }


        $sql111 = "SELECT TOP  5 * FROM  TBL_EMPLOYEE_INFO WHERE EMP_ID = '".get_userID()."'";
        $empinfo = DB::select(DB::raw($sql111))[0];


        $sql222 = "SELECT TOP 1 * FROM TBL_USER_FUND_CHOOSE fm
INNER JOIN TBL_INVESTMENT_PLAN pl ON pl.PlAN_ID = fm.PLAN_ID
WHERE fm.EMP_ID = '".get_userID()."' ORDER BY fm.MODIFY_DATE DESC";

        $planchoose= null;
        $planchoose_db =  DB::select(DB::raw($sql222));
        if($planchoose_db){
            $planchoose =$planchoose_db[0];
        }




        return view('frontend.pages.20p1')->with(['userinfo'=>$userinfo,'userbenefit'=>$userbenefit, 'infoaset'=>$infoaset,'empinfo'=>$empinfo,'planchoose'=>$planchoose]);


    }

    public  function  EditProfile(Request $request){



//        var_dump($request->input('phone'));
//
//        var_dump($request->input('address'));
//        var_dump($request->input('email'));

        $sql = "UPDATE TBL_USER SET PHONE='".$request->input('phone')."', ADDRESS='".$request->input('address')."' , EMAIL='".$request->input('email')."' WHERE EMP_ID='".get_userID()."'";

        $ret =  DB::update(DB::raw($sql));

        $val =  array(
            "emp_id" => get_userID(),
            "PHONE" => $request->input('phone'),
            "ADDRESS" => $request->input('address'),
            "EMAIL" => $request->input('email')

        );

        if($ret){
            Logprocess(5,$val);
        }





        return redirect()->to('/editprofile')->with('updateok' ,true);


    }


    public function ResetPassworduser(Request $request)
    {

        $netasset  = DB::table('TBL_USER')->Where('EMP_ID', '=' , get_userID())->first();

        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $netasset->USERNAME,
            "old_password" => $request->input('old_password'),
            "new_password" => $request->input('new_password')


        );

//        var_dump($data);
        $curl = new Curl('CHANGE_PASS', $data);

        $result_login = $curl->getResult();
        if($result_login->errCode != 0) {
            // login fail
            return redirect()->to('editprofile')->withErrors(['ไม่พบชื่อ login นี้', 'The email or password you entered is incorrect.']);
        } else {
            // logged in
//            session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);
            Logprocess(7,$data);
            return redirect()->to('editprofile')->with('message','ท่านได้เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
        }
    }
}
