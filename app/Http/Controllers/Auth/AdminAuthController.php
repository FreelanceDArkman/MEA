<?php

namespace App\Http\Controllers\Auth;

use App\Package\Curl;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use App\Package\MeaAgent;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    public function showfirstlogin()
    {
//        if(is_admin())
//            return redirect()->to('admin');


        $this->pageSetting( [
            'title' => 'เปลี่ยนรหัสผ่าน | MEA FUND'
        ] );

        return view('backend.pages.firstlogin');
    }
    public function showforgot()
    {
        if(is_admin())
            return redirect()->to('admin');


        $this->pageSetting( [
            'title' => 'ลืมรหัสผ่าน | MEA FUND'
        ] );

        return view('backend.pages.forgotpassword');
    }

    public function showLogin()
    {
        if(is_admin())
            return redirect()->to('admin');


        $this->pageSetting( [
            'title' => 'เข้าสู่ระบบ | MEA FUND'
        ] );
        return view('backend.pages.login');
    }

    public function ResetPassword(Request $request)
    {

        $netasset  = DB::table('TBL_USER')->Where('EMP_ID', '=' , $request->input('emp_id'))->first();

        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $netasset->USERNAME,
            "old_password" => $request->input('old_password'),
            "new_password" => $request->input('new_password'),
            "email" => $netasset->EMAIL

        );
        $curl = new Curl('FIRST_LOGIN', $data);

        $result_login = $curl->getResult();
        if($result_login->errCode != 0) {
            // login fail
            return redirect()->to('admin/firstlogin')->withErrors(['ไม่พบชื่อ login นี้', 'The email or password you entered is incorrect.']);
        } else {
            // logged in
//            session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);

            return redirect()->to('admin/firstlogin')->with('message','กรุณาตรวจสอบอีเมล์ที่ได้ลงทะเบียนไว้กับระบบ เพื่อยืนยันตัวตนและตรวจสอบสิทธิ์การใช้งานของท่าน');
        }
    }

    public function ReqPassword(Request $request)
    {
//        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $request->input('username')

        );
        $curl = new Curl('REQUEST_NEW_PASS', $data);

        $result_login = $curl->getResult();
        var_dump($result_login);
        if($result_login->errCode != 0) {
            // login fail
            return redirect()->to('admin/forgotpassword')->withErrors(['ไม่พบชื่อ login นี้', 'The email or password you entered is incorrect.']);
        } else {
            // logged in
           // session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);

            return redirect()->to('admin/forgotpassword')->with('message','ระบบได้ส่ง password ใหม่ไปให้ท่านเรียบร้อยแล้ว');
        }
    }

    public function checkLogin(Request $request)
    {
        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $request->input('username'),
            "pwd" => $request->input('password'),
            "os" => $agent->platform(),
            "browser" => $agent->browser(),
            "ip_address" => $request->ip(),
            "access_channel" => $agent->access_channel(),
            "device_id" => "",
            "device_os" => $agent->platform()
        );
        $curl = new Curl('Login', $data);
        $result_login = $curl->getResult();
        $retError = "";
        if($result_login->errCode != 0) {
            // login fail

            switch($result_login->errCode){
                case  1:
                    $retError = "ท่านระบุรหัสผู้ใช้งานไม่ถูกต้อง";
                    break;
                case  2:
                    $retError = "ท่านระบุรหัสผ่านไม่ถูกต้อง" ;
                    break;
                case 7706:
                    $retError = "รหัสผู้ใช้งานของท่านไม่ได้รับอนุญาตให้เข้าใช้งานระบบ กรุณาติดต่อผู้ดูแลระบบ"  ;
                    break;
                case 7707:
                    $retError = "ท่านไม่สามารถเข้าใช้งานระบบได้ เนื่องจากท่านได้ลาออกจากสมาชิกกองทุน เมื่อวันที่ "  . get_date_notime($result_login->leave_fund_group_date)  . " หากต้องการรายละเอียดเพิ่มเติม กรุณาติดต่อกองทุนสำรองเลี้ยงชีพ";
                    break;

                default:
                    $retError=   'The email or password you entered is incorrect.';
                    break;
            }
            return redirect()->to('admin/login')->with('messages', $retError);
        } else {
            // logged in
            if(!in_array($result_login->result[0]->user_privilege_id, Config::get('mea.admin_groups'))) {
                return redirect()->to('admin/login')->with('messages', 'The username or password you entered is incorrect.');
            }
            session(['logged_in' => true, 'user_data' => $result_login->result[0],'access_channel' => 'backend']);


            if($result_login->result[0]->first_login_flag == "0"){
//                var_dump($result_login->result[0]->first_login_flag);
                //echo "asdasd" . $result_login->result[0]->first_login_flag;
                return redirect()->to('admin/firstlogin')->with('emp_id',$result_login->result[0]->emp_id);
            }else{
                // logged in
                // echo  "hello";
                return redirect()->intended('/admin');
            }

//            return redirect()->intended('admin');
        }
    }

    public function checkLogout()
    {
        Session::flush();
        return redirect()->to('admin/login');
    }
}
