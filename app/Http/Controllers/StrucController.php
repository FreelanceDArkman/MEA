<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StrucController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );

//        $sql = "SELECT * FROM tbl_news_topic WHERE NEWS_CATE_ID = 8 ORDER BY create_date DESC";
//        $netasset = DB::select(DB::raw($sql));

        $netasset  = DB::table('tbl_news_topic')->where('NEWS_CATE_ID','8')->orderBy('create_date', 'desc')->paginate(10);

        return view('frontend.pages.3p2')->with(['netasset' => $netasset]);
    }
}
