<?php

use Jenssegers\Date\Date;





if (!function_exists('logged_in')) {

    function logged_in()
    {
        if (session()->get('logged_in'))
            return true;
        else
            return false;

    }
}

if (!function_exists('get_user_group')) {
    function get_user_group()
    {
        return (int)session()->get('user_data')->user_privilege_id;

    }
}


if (!function_exists('is_admin')) {
    function is_admin()
    {
        if (logged_in() && in_array(get_user_group(), \Illuminate\Support\Facades\Config::get('mea.admin_groups'))) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('access_menu_list')) {
    function access_menu_list()
    {
        if(session()->has('user_data')){

            $menu_data = session()->get('user_data')->access_menu_list;
            if(!$menu_data) return false;
            return $menu_data;
        }

        return false;

    }
}


if (!function_exists('access_menu')) {
    function menu_access($id, $group_id)
    {
        if (empty($id) || empty($group_id))
            return false;

        $access_menu_list = access_menu_list();
        if (!$access_menu_list) return false;

        if(is_array($access_menu_list)) {
            foreach($access_menu_list as $menu) {
                if($menu->group_id == $group_id && $menu->menu_id == $id) return true;
            }
        }
        return false;
    }
}


if (!function_exists('objectToArray')) {

    function objectToArray($d)
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        } else {
            // Return array
            return $d;
        }
    }
}


if(!function_exists('get_userID')) {
    function get_userID()
    {
        if(session()->has('user_data')){

            return session()->get('user_data')->emp_id;
        }
        return '';
    }
}



if(!function_exists('get_username')) {
    function get_username()
    {
        if(session()->has('user_data')){

            return session()->get('user_data')->full_name;
        }
        return '';
    }
}


if(!function_exists('meaFormatDate')){
    function meaFormatDate($input){

        $create_date = new Date($input);
        $create_date_str = $create_date->add('543 years')->format('d M Y H:i:s');

        return $create_date_str;
    }
}

if(!function_exists('get_date')) {
    function get_date($input)
    {
        Date::setLocale('th');
        $create_date = new Date($input);
        return $create_date->add('543 years')->format('j F Y H:i:s');
    }
}

if(!function_exists('get_date_notime')) {
    function get_date_notime($input)
    {
        Date::setLocale('th');

//        Date::setLocale('th');
        $create_date = new Date($input);
        return $create_date->add('543 years')->format('j F Y');
    }
}

if(!function_exists('get_date_nodate')) {
    function get_date_nodate($input)
    {
        Date::setLocale('th');
        $create_date = new Date($input);
        return $create_date->add('543 years')->format('F Y');
    }
}

if(!function_exists('get_date_year')) {
    function get_date_year($input)
    {
        Date::setLocale('th');
        $create_date = new Date($input);
        return $create_date->add('543 years')->format('Y');
    }
}


if(!function_exists('meaNumbermoney')){
    function meaNumbermoney($input){

        return number_format($input,2,'.',',');
    }
}

if(!function_exists('objectcheckdisplaynone')) {
    function objectcheckdisplaynone($obj)
    {

        $ret = "";

        if($obj){
            $ret = "display:block";
        }else{
            $ret = "display:none";
        }

        return $ret;
    }
}
if(!function_exists('objectcheckdisplayblock')) {
    function objectcheckdisplayblock($obj)
    {

        $ret = "";

        if($obj){
            $ret = "display:none";


        }else{
            $ret = "display:block";
        }

        return $ret;
    }
}

if(!function_exists('IsActive')) {
    function IsActive($page)
    {

        $routes = Route::getCurrentRoute()->getPath();
        $arrpages = explode(",", $page);



        foreach ($arrpages as $v) {
            if($routes == $v ){
                return "active";
            }
        }

        return "";
    }
}

if(!function_exists('quizScore')) {
    function quizScore($quiz_result)
    {

        $ret = 0;

        //1:B|2:B|3:C|4:B|5:C|6:A|7:B|8:B|9:B|10:B
        $arrtopic = explode("|", $quiz_result);

        foreach($arrtopic as $index=>$list){

            $arrtchoice = explode(":", $list);

            $ans = $arrtchoice[1];

            if($ans == "A"){
                $ret = $ret +1;
            }
            if($ans == "B"){
                $ret = $ret +2;
            }
            if($ans == "C"){
                $ret = $ret +3;
            }
            if($ans == "D"){
                $ret = $ret +4;
            }



        }




        return $ret;
    }
}



