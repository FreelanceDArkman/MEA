<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportController extends Controller
{




    public function getreport1()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 1,
            'title' => getMenuName($data,58,1) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport2()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 2,
            'title' =>  getMenuName($data,58,2) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport3()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 3,
            'title' => getMenuName($data,58,3) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport4()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 4,
            'title' => getMenuName($data,58,4) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport5()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 5,
            'title' =>  getMenuName($data,58,5) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport6()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 6,
            'title' =>  getMenuName($data,58,6) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport7()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 7,
            'title' =>  getMenuName($data,58,7) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport8()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 8,
            'title' =>  getMenuName($data,58,8) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport9()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 9,
            'title' =>  getMenuName($data,58,9) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport10()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 10,
            'title' =>  getMenuName($data,58,10) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport11()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 11,
            'title' => getMenuName($data,58,11) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport12()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 12,
            'title' =>  getMenuName($data,58,12) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }
    public function getreport13()
    {
        $data = getmemulist();
        $this->pageSetting( [
            'menu_group_id' => 58,
            'menu_id' => 13,
            'title' =>  getMenuName($data,58,13) . '|  MEA FUND'
        ] );

//->with();
        return view('backend.pages.report1');
    }


}
