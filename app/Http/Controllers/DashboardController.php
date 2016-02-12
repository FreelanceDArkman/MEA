<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use App\SampleModel;

class DashboardController extends Controller
{
    //

    public function showIndex()
    {
        $this->pageSetting( [
            'menu_group_id' => 1,
            'menu_id' => 2,
            'title' => 'Some title page'
        ] );

        $obj = new SampleModel();
        dd($obj->getRows());
        return view('backend.pages.dashboard');
    }

}
