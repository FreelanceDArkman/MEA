<?php

namespace App\Http\Controllers\Auth;

use App\Package\Curl;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use App\Package\MeaAgent;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
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


    public function ShowSetNewpass()
    {

        $this->pageSetting( [
            'title' => 'เข้าสู่ระบบ | MEA FUND'
        ] );

//        if(logged_in())
//            return redirect()->to('/');

        return view('frontend.pages.firstlogin');
    }

    public function showLogin()
    {

        $this->pageSetting( [
            'title' => 'เข้าสู่ระบบ | MEA FUND'
        ] );

        if(logged_in())
            return redirect()->to('/');

        return view('frontend.pages.login');
    }




    public function showForgotPassword()
    {

        $this->pageSetting( [
            'title' => 'ลืมรหัสผ่าน | MEA FUND'
        ] );

        if(logged_in())
            return redirect()->to('/');

        return view('frontend.pages.forgotpassword');
    }




    public function ResetPassword(Request $request)
    {
        $id =  $request->input('emp_id');

        $netasset  = DB::table('TBL_USER')->Where('EMP_ID', '=' , $id)->first();




       // $email = $netasset->EMAIL;
        if($request->input('email')){
            $email = $request->input('email');
        }

//        var_dump($email);
        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $netasset->USERNAME,
            "old_password" => $request->input('old_password'),
            "new_password" => $request->input('new_password'),
            "email" => $email

        );

//        var_dump($netasset->USERNAME);
//        var_dump($email);
        $curl = new Curl('FIRST_LOGIN', $data);

        $result_login = $curl->getResult();

//        var_dump($netasset );

        if($result_login->errCode != 0) {
            // login fail
            $retError = "";
            switch($result_login->errCode){
                case  1:
                    $retError = "ท่านระบุรหัสผู้ใช้งานไม่ถูกต้อง" ;
                    break;
                case  2:
                    $retError = "ท่านระบุรหัสผ่านไม่ถูกต้อง" ;
                    break;
                case 7706:
                    $retError = "รหัสผู้ใช้งานของท่านไม่ได้รับอนุญาตให้เข้าใช้งานระบบ กรุณาติดต่อผู้ดูแลระบบ"  ;
                    break;
                default:
                    $retError=   'ไม่พบชื่อ login นี้';
                    break;
            }
          //  return redirect()->to('firstlogin')->withErrors([$retError]);
        } else {

            Session::flush();
            // logged in
//            session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);
            return redirect()->intended('/');
            //return redirect()->to('firstlogin')->with('message','กรุณาตรวจสอบอีเมล์ที่ได้ลงทะเบียนไว้กับระบบ เพื่อยืนยันตัวตนและตรวจสอบสิทธิ์การใช้งานของท่าน');
        }
    }

    public function GetPassword(Request $request)
    {
        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $request->input('username')

        );


        $curl = new Curl('REQUEST_NEW_PASS', $data);

        $result_login = $curl->getResult();



        if($result_login->errCode != 0) {

            $head = "";
            $body = "";
            switch($result_login->errCode){
                case 7705:
                    $head = "ไม่พบชื่อ Email ท่านในระบบ " ;
                    $body = "ติดต่อกองจัดการกองทุนสำรองเลี้ยงชีพ ฝ่ายการเงิน";
                    break;
                default:
                    $head = "ไม่พบชื่อ login นี้";
                    $body = "'ติดต่อกองจัดการกองทุนสำรองเลี้ยงชีพ ฝ่ายการเงิน";
                    break;

            }
            return redirect()->to('forgotpassword')->withErrors([$head, $body]);
        } else {
            // logged in
            //session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);

            return redirect()->to('forgotpassword')->with('message','ระบบได้ส่ง password ใหม่ไปให้ท่านเรียบร้อยแล้ว');
        }
    }

    public function checkLogin(Request $request)
    {
        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $request->input('username'),
            "pwd" => $request->input('password'),
            "os" =>$agent->platform(),
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
            // login fail
            return redirect()->to('login')->withErrors([$retError]);
        } else {


            if($result_login->result[0]->first_login_flag == "0"){
                //echo "asdasd" . $result_login->result[0]->first_login_flag;
//                session(['first_emp_id' => $filter1]);
                return redirect()->to('firstlogin')->with('emp_id',$result_login->result[0]->emp_id);
            }else{
                // logged in
                session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);
                // echo  "hello";
                return redirect()->intended('/profile');
            }

        }
    }

    public function checkLogout()
    {
        Session::flush();
        return redirect()->to('login');
    }
}
