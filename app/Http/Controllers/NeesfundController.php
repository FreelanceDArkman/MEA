<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NeesfundController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );




        $netasset  = DB::table('tbl_news_topic')->where('NEWS_CATE_ID','2')->orderBy('create_date', 'desc')->paginate(10);
        return view('frontend.pages.7p2')->with(['netasset' => $netasset]);


    }
}
