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
            'title' => 'แก้ไขข้อมูลส่วนตัว'
        ] );


        $sqlinfo = "SELECT * FROM TBL_EMPLOYEE_INFO info
INNER JOIN TBL_USER us ON us.EMP_ID = info.EMP_ID
WHERe info.EMP_ID = '".get_userID()."'";
        $userinfo =  DB::select(DB::raw($sqlinfo))[0];



        $sqlbenefit = "SELECT * FROM TBL_USER_BENEFICIARY  WHERe EMP_ID = '1234567' ORDER BY CREATE_DATE DESC";
        $userbenefit =  DB::select(DB::raw($sqlbenefit));







        return view('frontend.pages.20p1')->with(['userinfo'=>$userinfo,'userbenefit'=>$userbenefit]);


    }

    public  function  EditProfile(Request $request){



        $sql = "UPDATE TBL_USER SET PHONE='".$request->input('phone')."', ADDRESS='".$request->input('address')."' , EMAIL='".$request->input('email')."' WHERE EMP_ID='".get_userID()."'";

         DB::update(DB::raw($sql));





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

        var_dump($data);
        $curl = new Curl('CHANGE_PASS', $data);

        $result_login = $curl->getResult();
        if($result_login->errCode != 0) {
            // login fail
            return redirect()->to('editprofile')->withErrors(['ไม่พบชื่อ login นี้', 'The email or password you entered is incorrect.']);
        } else {
            // logged in
//            session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);

            return redirect()->to('editprofile')->with('message','ท่านได้เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
        }
    }
}
