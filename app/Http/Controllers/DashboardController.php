<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;

class DashboardController extends Controller
{
    //

    public function showIndex()
    {
        $this->pageSetting( [
            'title' => 'Dashboard | MEA FUND'
        ] );

        return view('frontend.pages.dashboard');
    }

}
