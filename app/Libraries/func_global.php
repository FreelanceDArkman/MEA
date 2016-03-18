<?php
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;
/**
 * set document type
 * @param string $type type of document
 */
function set_content_type($type = 'application/json') {
    header('Content-Type: '.$type);
}

/**
 * Read CSV from URL or File
 * @param  string $filename  Filename
 * @param  string $delimiter Delimiter
 * @return array            [description]
 */
function read_csv($filename, $delimiter = ",") {
    $file_data = array();
    $handle = @fopen($filename, "r") or false;
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $file_data[] = $data;
        }
        fclose($handle);
    }
    return $file_data;
}

/**
 * Print Log to the page
 * @param  mixed  $var    Mixed Input
 * @param  boolean $pre    Append <pre> tag
 * @param  boolean $return Return Output
 * @return string/void     Dependent on the $return input
 */
function plog($var, $pre=true, $return=false) {
    $info = print_r($var, true);
    $result = $pre ? "<pre>$info</pre>" : $info;
    if ($return) return $result;
    else echo $result;
}

/**
 * Log to file
 * @param  string $log Log
 * @return void
 */
function elog($log, $fn = "debug.log") {
    $fp = fopen($fn, "a");
    fputs($fp, "[".date("d-m-Y h:i:s")."][Log] $log\r\n");
    fclose($fp);
}






function getSideBar($menulsit){

    $data = $menulsit;

//*navigation array config

    //ex:
//        "dashboard" => array(
//            "title" => "Display Title",
//            "url" => "http://yoururl.com",
//            "url_target" => "_self",
//            "icon" => "fa-home",
//            "label_htm" => "<span>Add your custom label/badge html here</span>",
//            "sub" => array() //contains array of sub items with the same format as the parent
//        )
    $page_nav = array();
    $page_nav["dashboard"] = array(
        "group_id" => 0,
        "title" => "Dashboard",
        "icon" => "fa-home",
        "url" => "/admin"
    );

    if(menu_access(1,50) || menu_access(2,50)){
        $page_nav["50"] = array(
            "group_id" => 50,
            "title" => getGoupName($data,50),
            "icon" => "fa-home",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,50,1),
                    "url" => "/admin/userGroup"
                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,50,2),
                    "url" => "/admin/users"
                )
            )
        );
    }



    foreach($page_nav as $index => $list){

//        var_dump(array_key_exists("url",$list));

        if(array_key_exists("url",$list)){
            if(Request::is( substr($list["url"],1,strlen($list["url"])))){
                $page_nav["dashboard"]["active"] = true;
            }

        }else{

            foreach($list["sub"] as $submenu){
                if(Request::is( substr($submenu["url"],1,strlen($submenu["url"])))){
                    $page_nav[$list["group_id"]]["sub"][$submenu["menu_id"]]["active"] = true;
                }
            }

        }


    }

    return $page_nav;
}


?>