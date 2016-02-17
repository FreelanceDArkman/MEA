<?php


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

if(!function_exists('get_username')) {
    function get_username()
    {
        if(session()->has('user_data')){

            return session()->get('user_data')->full_name;
        }
        return '';
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



