<?php

namespace App\Http\Controllers\Auth;

use App\Package\Curl;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use App\Package\MeaAgent;

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


    public function showLogin()
    {

        $this->pageSetting( [
            'title' => 'Login | MEA FUND'
        ] );

        if(logged_in())
            return redirect()->to('/');

        return view('frontend.pages.login');
    }

    public function checkLogin(Request $request)
    {
        $agent = new MeaAgent();
        $data = array(
            "session_id" => Session::getId(),
            "username" => $request->input('username'),
            "pwd" => $request->input('password'),
            "os" => $agent->device(),
            "browser" => $agent->browser(),
            "ip_address" => $request->ip(),
            "access_channel" => $agent->access_channel(),
            "device_id" => "",
            "device_os" => $agent->platform()
        );
        $curl = new Curl('Login', $data);
        $result_login = $curl->getResult();
        if($result_login->errCode != 0) {
            // login fail
            return redirect()->to('login')->with('messages', 'The email or password you entered is incorrect.');
        } else {
            // logged in
            session(['logged_in' => true, 'user_data' => $result_login->result[0], 'access_channel' => 'frontend']);
            return redirect()->intended('/');
        }
    }

    public function checkLogout()
    {
        Session::flush();
        return redirect()->to('login');
    }
}
