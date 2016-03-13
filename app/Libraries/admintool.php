<?php

use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;


if (!function_exists('activeSidemenu')) {

    function activeSidemenu($currentPage)
    {
        $ret = "";
        //Route::getCurrentRoute()->getPath();

        if(Request::is('admin/'.$currentPage))
            $ret = "active open";
        else
            $ret = "";

        return $ret;

    }
}

if (!function_exists('activeGroupMenu')) {

    function activeGroupMenu($currentPage)
    {
        $ret = "";
        //Route::getCurrentRoute()->getPath();

        $arrpages = explode(",", $currentPage);



        foreach ($arrpages as $v) {
            if(Request::is('admin/'.$v)){
                $ret = "active open";
                break;
            }
        }


        return $ret;

    }
}


if (!function_exists('activeDisplay')) {

    function activeDisplay($currentPage)
    {
        $ret = "none";
        //Route::getCurrentRoute()->getPath();

        $arrpages = explode(",", $currentPage);



        foreach ($arrpages as $v) {
            if(Request::is('admin/'.$v)){
                $ret = "block";
                break;
            }
        }


        return $ret;

    }
}