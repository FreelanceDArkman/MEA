<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class YearbookController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );

        $sql = "SELECT * FROM tbl_news_topic WHERE NEWS_CATE_ID = 9 ORDER BY create_date DESC";
        $netasset = DB::select(DB::raw($sql));
        return view('frontend.pages.3p3')->with(['netasset' => $netasset]);
    }
}
