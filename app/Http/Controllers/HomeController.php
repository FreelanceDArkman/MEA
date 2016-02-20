<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );


        $netasset  = DB::table('tbl_news_topic')->where('NEWS_CATE_ID','1')->orWhere('NEWS_CATE_ID','2')->orderBy('create_date', 'desc')->paginate(10);

        return view('frontend.pages.dashboard')->with(['netasset' => $netasset]);
    }

}
