<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class historycumulativeController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 23,
            'menu_id' => 2,
            'title' => 'จัดการผู้ใช้'
        ] );


        return view('frontend.pages.23p2');
    }
}
