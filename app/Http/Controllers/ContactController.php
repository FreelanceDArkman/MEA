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
}
