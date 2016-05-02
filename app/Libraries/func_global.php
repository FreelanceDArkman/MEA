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
            "icon" => "fa-user",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,50,1),
                    "url" => "/admin/userGroup",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างกลุ่มผู้ใช้",
                            "url" => "/admin/userGroup/add"

                        ),
                        "edit"=>array(
                            "title"=> "แก้ไขกลุ่มผู้ใช้",
                            "url" => "/admin/userGroup/edit"
                        )
                    )
                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,50,2),
                    "url" => "/admin/users",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างผู้ใช้",
                            "url" => "/admin/users/add"

                        ),
                        "edit"=>array(
                            "title"=> "แก้ไขผู้ใช้",
                            "url" => "/admin/users/edit"
                        ),
                        "getimport"=>array(
                            "title"=> "นำเข้าผู้ใช้",
                            "url" => "/admin/users/getimport"
                        )

                    )
                )
            )
        );
    }

    if(menu_access(1,51) || menu_access(2,51)|| menu_access(3,51)|| menu_access(4,51)|| menu_access(5,51)|| menu_access(6,51)|| menu_access(7,51)){
        $page_nav["51"] = array(
            "group_id" => 51,
            "title" => getGoupName($data,51),
            "icon" => "fa-group",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,51,1),
                    "url" => "/admin/simple"

                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,51,2),
                    "url" => "/admin/plan"

                ),
                "3" => array(
                    "menu_id" => 3,
                    "title" => getMenuName($data,51,3),
                    "url" => "/admin/fund"

                ),
                "4" => array(
                    "menu_id" => 4,
                    "title" => getMenuName($data,51,4),
                    "url" => "/admin/benefit"

                ),
                "5" => array(
                    "menu_id" => 5,
                    "title" => getMenuName($data,51,5),
                    "url" => "/admin/profit"

                ),
                "6" => array(
                    "menu_id" => 6,
                    "title" => getMenuName($data,51,6),
                    "url" => "/admin/extendrate"

                ),
                "7" => array(
                    "menu_id" => 7,
                    "title" => getMenuName($data,51,7),
                    "url" => "/admin/currentrate"

                )
            )
        );
    }

    if(menu_access(1,52)){
        $page_nav["52"] = array(
            "group_id" => 52,
            "title" => getGoupName($data,52),
            "icon" => "fa-gavel",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,52,1),
                    "url" => "/admin/chooseplan",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างแผนการลงทุน",
                            "url" => "/admin/chooseplan/add"

                        ),
                        "edit" => array(
                            "title"=>"แก้ไขแผนการลงทุน",
                            "url" => "/admin/chooseplan/edit"

                        )
                    )

                )

            )
        );
    }
    if(menu_access(1,53) || menu_access(2,53)){
        $page_nav["53"] = array(
            "group_id" => 53,
            "title" => getGoupName($data,53),
            "icon" => "fa-bullhorn",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,53,1),
                    "url" => "/admin/newstopic",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างหมวดหมู่ข่าว",
                            "url" => "/admin/newstopic/add"

                        ),
                        "edit" => array(
                            "title"=>"แกไข้หมวดหมู่ข่าว",
                            "url" => "/admin/newstopic/edit"

                        )
                    )

                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,53,2),
                    "url" => "/admin/news",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างหัวข้อข่าว",
                            "url" => "/admin/news/add"

                        ),
                        "edit" => array(
                            "title"=>"แก้ไขหัวข้อข่าว",
                            "url" => "/admin/news/edit"

                        )
                    )

                )

            )
        );
    }

    if(menu_access(1,54) || menu_access(2,54)){
        $page_nav["54"] = array(
            "group_id" => 54,
            "title" => getGoupName($data,54),
            "icon" => "fa-comments-o",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,54,1),
                    "url" => "/admin/faqcate",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างหมวดหมู่ข่าว",
                            "url" => "/admin/faqcate/add"

                        ),
                        "edit" => array(
                            "title"=>"แกไข้หมวดหมู่ข่าว",
                            "url" => "/admin/faqcate/edit"

                        )
                    )

                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,54,2),
                    "url" => "/admin/faqtopic",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างหัวข้อข่าว",
                            "url" => "/admin/faqtopic/add"

                        ),
                        "edit" => array(
                            "title"=>"แก้ไขหัวข้อข่าว",
                            "url" => "/admin/faqtopic/edit"

                        )
                    )

                )

            )
        );
    }

    if(menu_access(1,55) || menu_access(2,55)){
        $page_nav["55"] = array(
            "group_id" => 55,
            "title" => getGoupName($data,55),
            "icon" => "fa-map-marker",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,55,1),
                    "url" => "/admin/contact"


                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,55,2),
                    "url" => "/admin/cmail",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"ตอบกลับ",
                            "url" => "/admin/cmail/forward"

                        ),
                        "edit" => array(
                            "title"=>"ส่งต่อ",
                            "url" => "/admin/cmail/reply"

                        )
                    )

                )

            )
        );
    }

    if(menu_access(1,56)){
        $page_nav["56"] = array(
            "group_id" => 56,
            "title" => getGoupName($data,56),
            "icon" => "fa-signal",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,56,1),
                    "url" => "/admin/risk",
                    "sub_mini" => array(
                        "add" => array(
                            "title"=>"สร้างแบบประเมินความเสี่ยง",
                            "url" => "/admin/risk/add"

                        ),
                        "edit" => array(
                            "title"=>"แก้ไขแบบประเมินความเสี่ยง",
                            "url" => "/admin/risk/edit"

                        )
                    )


                )


            )
        );
    }

    if(menu_access(1,57)){
        $page_nav["57"] = array(
            "group_id" => 57,
            "title" => getGoupName($data,57),
            "icon" => "fa-trophy",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,57,1),
                    "url" => "/admin/nav"


                )


            )
        );
    }


    if(menu_access(1,58) || menu_access(2,58)|| menu_access(3,58)|| menu_access(4,58)|| menu_access(5,58)|| menu_access(6,58)|| menu_access(7,58)|| menu_access(8,58)|| menu_access(9,58)|| menu_access(10,58)|| menu_access(11,58)|| menu_access(12,58)|| menu_access(13,58)){
        $page_nav["58"] = array(
            "group_id" => 58,
            "title" => getGoupName($data,58),
            "icon" => "fa-table",

            "sub" => array(
                "1" => array(
                    "menu_id" => 1,
                    "title" => getMenuName($data,58,1),
                    "url" => "/admin/report1"


                ),
                "2" => array(
                    "menu_id" => 2,
                    "title" => getMenuName($data,58,2),
                    "url" => "/admin/report2"

                ),
                "3" => array(
                    "menu_id" => 3,
                    "title" => getMenuName($data,58,3),
                    "url" => "/admin/report3"

                ),
                "4" => array(
                    "menu_id" => 4,
                    "title" => getMenuName($data,58,4),
                    "url" => "/admin/report4"

                ),
                "5" => array(
                    "menu_id" => 5,
                    "title" => getMenuName($data,58,5),
                    "url" => "/admin/report5"

                ),
                "6" => array(
                    "menu_id" => 6,
                    "title" => getMenuName($data,58,6),
                    "url" => "/admin/report6"

                ),
                "7" => array(
                    "menu_id" => 7,
                    "title" => getMenuName($data,58,7),
                    "url" => "/admin/report7"

                ),
                "8" => array(
                    "menu_id" => 8,
                    "title" => getMenuName($data,58,8),
                    "url" => "/admin/report8"

                ),
                "9" => array(
                    "menu_id" => 9,
                    "title" => getMenuName($data,58,9),
                    "url" => "/admin/report9"

                ),
                "10" => array(
                    "menu_id" => 10,
                    "title" => getMenuName($data,58,10),
                    "url" => "/admin/report10"

                ),
                "11" => array(
                    "menu_id" => 11,
                    "title" => getMenuName($data,58,11),
                    "url" => "/admin/report11"

                ),
                "12" => array(
                    "menu_id" => 12,
                    "title" => getMenuName($data,58,12),
                    "url" => "/admin/report12"

                ),
                "13" => array(
                    "menu_id" => 13,
                    "title" => getMenuName($data,58,13),
                    "url" => "/admin/report13"

                )
            )
        );
    }





    foreach($page_nav as $index => $list){



        if(array_key_exists("url",$list)){
            if(Request::is( substr($list["url"],1,strlen($list["url"])))){
                $page_nav["dashboard"]["active"] = true;
            }

        }else{

            foreach($list["sub"] as $submenu){

                $arrurlsub = explode('/',$submenu["url"]);
                $path = $arrurlsub[1]. "/" . $arrurlsub[2];

                if(Request::is($path)){

                    $page_nav[$list["group_id"]]["sub"][$submenu["menu_id"]]["active"] = true;


                }

                if(array_key_exists("sub_mini",$submenu)){


                    foreach($submenu["sub_mini"] as $mini){
                        $arrurlsub = explode('/',$mini["url"]);
                        $path = $arrurlsub[1]. "/" . $arrurlsub[2] . "/" . $arrurlsub[3];

                        $current = Route::getCurrentRoute()->getPath();
                        $arrCount = explode('/',$current);

                        if(count($arrCount) > 2 ){

                            $Cpath = $arrCount[0] . "/" . $arrCount[1] . "/" . $arrCount[2];

                            if( $Cpath == $path){
                                $page_nav[$list["group_id"]]["sub"][$submenu["menu_id"]]["active"] = true;
                                break;
                            }

                        }else{
                            if(Request::is($path)){
                                $page_nav[$list["group_id"]]["sub"][$submenu["menu_id"]]["active"] = true;
                                break;
                            }
                        }



                    }
                }


            }

        }


    }

    return $page_nav;
}


 function getMenutitle($arrSidebar){
 $ret = "";
     foreach($arrSidebar as $index => $list){
         if(!array_key_exists("url",$list)){

             foreach($list["sub"] as $submenu){
                 $arrurlsub = explode('/',$submenu["url"]);
                 $path = $arrurlsub[1]. "/" . $arrurlsub[2];
                 if(Request::is($path)){
                     $ret = $submenu["title"];

                     break;
                 }

                if(array_key_exists("sub_mini",$submenu)){


                    foreach($submenu["sub_mini"] as $mini){
                        $arrurlsub = explode('/',$mini["url"]);
                        $path = $arrurlsub[1]. "/" . $arrurlsub[2] . "/" . $arrurlsub[3];

                        $current = Route::getCurrentRoute()->getPath();
                        $arrCount = explode('/',$current);

                        if(count($arrCount) > 2 ){

                            $Cpath = $arrCount[0] . "/" . $arrCount[1] . "/" . $arrCount[2];

                            if( $Cpath == $path){
                                $ret = $mini["title"];
                                break;
                            }

                        }else{
                            if(Request::is($path)){
                                $ret = $mini["title"];
                                break;
                            }
                        }



                    }
                }

             }

         }
     }

     return $ret;
 }


?>