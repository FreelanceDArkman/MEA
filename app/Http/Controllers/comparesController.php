<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class comparesController extends Controller
{
    public function getIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 21,
            'menu_id' => 3,
            'title' => 'จัดการผู้ใช้'
        ] );


        return view('frontend.pages.21p3');
    }
}
