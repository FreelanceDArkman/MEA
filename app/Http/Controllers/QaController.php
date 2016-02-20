<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QaController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );

    $qatopic = DB::table('TBL_FAQ_CATE')->get();

    $netasset  = DB::table('TBL_FAQ_TOPIC')->where('FAQ_CATE_ID','1')->paginate(10);

        return view('frontend.pages.6p1')->with(['qatopic' => $qatopic,'netasset' => $netasset]);
    }

    public function getIndexByID($id)
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );

        $qatopic = DB::table('TBL_FAQ_CATE')->get();

        $netasset  = DB::table('TBL_FAQ_TOPIC')->where('FAQ_CATE_ID',$id)->paginate(10);

        return view('frontend.pages.6p1')->with(['qatopic' => $qatopic,'netasset' => $netasset]);
    }
}
