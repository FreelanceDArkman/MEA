<?php

use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;


if (!function_exists('getManual')) {

    function getManual(){
        $sql44  = "SELECT * FROM TBL_NEWS_TOPIC WHERE NEWS_CATE_ID = 99 AND NEWS_TOPIC_ID = 2";


        $man = DB::select(DB::raw($sql44));


//        $user_group = DB::table('TBL_MENU_LIST')->get();
        return $man[0]->FILE_PATH;
    }

}



if (!function_exists('getmemulist')) {

    function getmemulist()
    {

        $sql44  = "SELECT * FROM TBL_MENU_GROUP mg
        INNER JOIN TBL_MENU_LIST ml ON ml.MENU_GROUP_ID = mg.MENU_GROUP_ID";

        $menu = DB::select(DB::raw($sql44));

//        $user_group = DB::table('TBL_MENU_LIST')->get();
        return $menu;

    }
}


if (!function_exists('Logprocess')) {

    function Logprocess($logtype,$val = [])
    {
            $activity ="";
            $value = "";
            $remark ="";


        switch ($logtype){
            case 1:
                $activity = "FUND_PLAN_TERMINATE";
               // [stamp ‘FUND_PLAN_TERMINATE’ ลงในฟิลด์ Activity] ยกเลกิ การเปลยี  นแผนลงทนุ
                break;
            case 2:
                $activity = "FUND_PLAN_UPDATE";
                $arr = [];
                $arr[0] = $val;
                $arrVal = array(
                    "function" => "FUND_PLAN_UPDATE",
                    "parameters" => $arr);
                $remark = json_encode($arrVal);

                break;
            case 3:
                $activity = "SAVING_RATE_TERMINATE";
                $arr = [];
                $arr[0] = $val;
                $arrVal = array(
                    "function" => "SAVING_RATE_TERMINATE",
                    "parameters" => $arr);
                $remark = json_encode($arrVal);

                break;
            case 4:
                $activity = "SAVING_RATE_UPDATE";
                $arr = [];
                $arr[0] = $val;
                $arrVal = array(
                    "function" => "SAVING_RATE_UPDATE",
                    "parameters" => $arr);
                $remark = json_encode($arrVal);

                break;
            case 5:
                $activity = "CHANGE_USER_INFO";
                $arr = [];
                $arr[0] = $val;
                $arrVal = array(
                    "function" => "CHANGE_USER_INFO",
                    "parameters" => $arr);
                $remark = json_encode($arrVal);

                break;
            case 6:
                $activity = "INFORMER";
                $arr = [];
                $arr[0] = $val;
                $arrVal = array(
                    "function" => "INFORMER",
                    "parameters" => $arr);
                $remark = json_encode($arrVal);
                $value = "";
                //(เมนตู ิดตอ่ กสช สอบถามแนะนําบริการ) [stamp ‘INFORMER’ ลง ในฟิลด์ Activityและ value (ข้อมลู ที  user กรอก) ลงในฟิลด์ Remark]
                break;
            case 7:
                $activity = "CHANGE_PASSWORD";

                break;
            case 8:
                $activity = "REQUEST_NEW_PASS";

                break;

        }

        $today = new Date();

        $sql = "INSERT INTO TBL_HISTORY_LOG (USERNAME,ACTIVITY, REMARK, DATETIME) VALUES ('".get_userID()."','".$activity."','".$remark."' , '".$today."')";
        return DB::insert(DB::raw($sql));



    }
}


if (!function_exists('getGoupName')) {

    function getGoupName($menulist, $grouid)
    {
        $ret = "";
        foreach($menulist as $item){
            if($item->MENU_GROUP_ID == $grouid){
                $ret = $item->MENU_GROUP_NAME;
                break;
            }
        }

        return $ret;

    }
}


if (!function_exists('getMenuName')) {

    function getMenuName($menulist, $grouid, $menuid)
    {
        $ret = "";
        foreach($menulist as $item){
            if($item->MENU_GROUP_ID == $grouid && $item->MENU_ID == $menuid ){
                $ret = $item->MENU_NAME;
                break;
            }
        }

        return $ret;

    }
}


if (!function_exists('checkShowList_valid')) {

    function checkShowList_valid($validata, $dateCompare)
    {
       $ret = false;

        $today = New Date();

        $arrmaxdate=  explode('-',$validata);
        $max = $arrmaxdate[1];

        $datecheck = new Date($dateCompare);
        //return $create_date->add('543 years')->format('j F Y');

        if($today > $datecheck){
            $ret = true;
        }



        if(get_date_month($today) == get_date_month($datecheck) && get_date_year($today) == get_date_year($datecheck)){

           if((int)get_date_day($today) <= (int)$max) {
               $ret = false;
           }

        }

        return $ret;
    }
}



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

if(!function_exists('get_user_access_status_flag')) {
    function get_user_access_status_flag()
    {
        if(session()->has('user_data')){

            return session()->get('user_data')->access_status_flag;
        }
        return '';
    }
}

if(!function_exists('get_is_before_status_2538')) {
    function get_is_before_status_2538()
    {
        if(session()->has('user_data')){
//            var_dump(session()->get('user_data'));

            return session()->get('user_data')->is_before_2538;
        }
        return '';
    }
}


if(!function_exists('meaFormatDate')){
    function meaFormatDate($input){

        $create_date = new Date($input);



        if($create_date->isLeapYear() == 1 && date("m",strtotime($create_date)) == 2 && date("d",strtotime($create_date)) == 29){

//            $LeapDate = New Date(date("Y",strtotime($create_date))  ."-".date("m",strtotime($create_date))."-".date("d",strtotime($create_date)));
//            var_dump($LeapDate->format('j F Y'));

            return "29 ก.พ. " . (date("Y",strtotime($create_date)) + 543). " " . $create_date->format('H:i:s');

        }else{
            return $create_date->add('543 years')->format('d M Y H:i:s');
        }
       // $create_date_str = $create_date->add('543 years')->format('d M Y H:i:s');

//        return $create_date_str;
    }
}

if(!function_exists('get_date')) {
    function get_date($input)
    {
        Date::setLocale('th');
        $create_date = new Date($input);

        if($create_date->isLeapYear() == 1 && date("m",strtotime($create_date)) == 2 && date("d",strtotime($create_date)) == 29){

            return "29 ก.พ. " . (date("Y",strtotime($create_date)) + 543) . " " . $create_date->format('H:i:s');

        }else{
            return $create_date->add('543 years')->format('j F Y H:i:s');
        }

    }
}


if(!function_exists('get_date_sql')) {
    function get_date_sql($input)
    {
        Date::setLocale('th');
        $create_date = new Date($input);

//        if($create_date->isLeapYear() == 1 && date("m",strtotime($create_date)) == 2 && date("d",strtotime($create_date)) == 29){
//
//            return "29 ก.พ. " . (date("Y",strtotime($create_date)) + 543) . " " . $create_date->format('H:i:s');
//
//        }else{
//            return $create_date->add('543 years')->format('j F Y H:i:s');
//        }

        return date("Y",strtotime($create_date)). '-' . date("m",strtotime($create_date)) . '-' .date("d",strtotime($create_date));

    }
}


if(!function_exists('get_date_period')) {
    function get_date_period($input)
    {

        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $ret = "";
        if($input != ""){
                $ar = explode('.',$input);
            $ret = $strMonthCut[(int)$ar[1]] . ' '. (((int)$ar[0]) + 543);
        }
        return $ret;
    }
}

if(!function_exists('get_date_notime')) {
    function get_date_notime_en($input)
    {
//        Date::setLocale('th');
//var_dump(($create_date->isLeapYear() == 1) ? "Leap Year" : "Not Leap Year");
        //->addDay(1)->format('j F Y')
        Date::setLocale('th');
        $create_date = new Date($input);

        if($create_date->isLeapYear() == 1 && date("m",strtotime($create_date)) == 2 && date("d",strtotime($create_date)) == 29){

//            $LeapDate = New Date(date("Y",strtotime($create_date))  ."-".date("m",strtotime($create_date))."-".date("d",strtotime($create_date)));
//            var_dump($LeapDate->format('j F Y'));

            return "29 ก.พ. " . (date("Y",strtotime($create_date)) );

        }else{
            return $create_date->format('j F Y');
        }

    }
}



if(!function_exists('get_date_notime')) {
    function get_date_notime($input)
    {
//        Date::setLocale('th');
//var_dump(($create_date->isLeapYear() == 1) ? "Leap Year" : "Not Leap Year");
        //->addDay(1)->format('j F Y')
        Date::setLocale('th');
        $create_date = new Date($input);

        if($create_date->isLeapYear() == 1 && date("m",strtotime($create_date)) == 2 && date("d",strtotime($create_date)) == 29){

//            $LeapDate = New Date(date("Y",strtotime($create_date))  ."-".date("m",strtotime($create_date))."-".date("d",strtotime($create_date)));
//            var_dump($LeapDate->format('j F Y'));

            return "29 ก.พ. " . (date("Y",strtotime($create_date)) + 543);

        }else{
            return $create_date->add('543 years')->format('j F Y');
        }

    }
}

if(!function_exists('get_date_nodate')) {
    function get_date_nodate($input)
    {
        Date::setLocale('th');
        $create_date = new Date($input);
//        return $create_date->add('543 years')->format('F Y');

        if($create_date->isLeapYear() == 1 && date("m",strtotime($create_date)) == 2 && date("d",strtotime($create_date)) == 29){


            return "ก.พ. " . (date("Y",strtotime($create_date)) + 543);

        }else{
            return $create_date->add('543 years')->format('F Y');
        }
    }
}

if(!function_exists('get_date_day')) {
    function get_date_day($input)
    {
        //Date::setLocale('th');
        $create_date = new Date($input);
        return $create_date->format('d');
    }
}

if(!function_exists('get_date_month')) {
    function get_date_month($input)
    {
        //Date::setLocale('th');
        $create_date = new Date($input);
        return $create_date->format('m');
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

if(!function_exists('meaNumbermoney4')){
    function meaNumbermoney4($input){

        return number_format($input,4,'.',',');
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




if(!function_exists('getfilesize')) {
    function getfilesize($file_path)
    {
        $arrfile  = explode("/", $file_path);


        $arrfileName= $arrfile[count($arrfile) - 1];

        $file = 'contents/' . $arrfileName;
        $bytes = File::size($file);

        $filesize = round(($bytes / 1000)) ;

        if($filesize < 1000){

            return  $filesize . " KB";
        }else{
            return  round(($filesize  / 1000)) . " MB";
        }

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



