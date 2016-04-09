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

if (!function_exists('Paginatre_gen')) {

    function Paginatre_gen($total,$pagesize, $id,$active = 1)
    {

        $ret = "<ul class='pagination' id='".$id."'>";


        $TotalPage =ceil($total/$pagesize);
        if($active == 1){
//            $ret = $ret . "<li><a href='javascript:void(0);' data-page='pre' ><i class='fa fa-arrow-left'></i></a></li>";
        }else{
            $ret = $ret . "<li><a href='javascript:void(0);' data-page='pre' ><i class='fa fa-arrow-left'></i></a></li>";
        }


        for($i = 1; $i <= $TotalPage ; $i++){
            $classactive = "";
                if($active == $i){
                    $classactive = "class='active'";
                }
            $ret = $ret . "<li ".$classactive." ><a href='javascript:void(0);' data-page='".$i."'>".$i."</a></li>";
        }
        $ret = $ret . "<li><a href='javascript:void(0);' data-page='next' ><i class='fa fa-arrow-right'></i></a></li>";


        $ret = $ret . "</ul>";

        if($total<$pagesize){
            $ret = "";
        }
       // $ret = $total . "--".$pagesize. "--". $id . "--".$active;

        return $ret;
    }
}

if (!function_exists('DarkmanTable')) {

    function DarkmanTable($data,$model = null)
    {
        $ret ="";

        $defaultModel["darktable"] = array(
            "class" => "darkman3",
            "tblIDName" => "darkman2",
            "colume" => array(
                    "0" => array(
                        "title" => "colume1",
                        "width" => "10%",
                        "head_type" => "checkbox",
                        "headinput" => "checkbox",
                        "head_id" => "mainCheck",
                        "head_class" => "main_input_class",
                        "row_type"=>"checkbox",
                        "row_val_prefix" => "check_item_",
                        "row_val_data" => "FILE_NAME",
                        "row_value" => "1",
                        "row_class" => "classw"

                    ),
                    "1" => array(
                        "title" => "colume1",
                        "width" => "10%",
                        "head_type" => "checkbox",
                        "headinput" => "checkbox",
                        "head_id" => "mainCheck",
                        "head_class" => "main_input_class",
                        "row_type"=>"checkbox",
                        "row_val_prefix" => "check_item",
                        "row_val_data" => "NEWS_CATE_ID",
                        "row_value" => "1",
                        "row_class" => "classw"

                    ),
                    "2" => array(
                        "title" => "colume1",
                        "width" => "10%",
                        "head_type" => "checkbox",
                        "headinput" => "checkbox",
                        "head_id" => "mainCheck",
                        "head_class" => "main_input_class",
                        "row_type"=>"checkbox",
                        "row_val_prefix" => "check_item",
                        "row_val_data" => "NEWS_TOPIC_ID",
                        "row_value" => "1",
                        "row_class" => "classw"

                    )


            )
        );


//        if($model){
            $ret .="<table class='table table-bordered " .$defaultModel['darktable']['class']."'>";
            $ret .="";
            $ret .="<thead>";
            $ret .="<tr>";
            foreach($defaultModel['darktable']['colume'] as $key => $item){
                $ret .="<td>".$item["title"]."</td>";
            }
            $ret .="</tr>";



            $ret .="</thead>";
            $ret .="<tbody>";

            if($data){
                foreach($data as $index => $item){
                    $ret .="<tr>";
                    foreach($defaultModel['darktable']['colume'] as $key => $item_col){


                        $ele = "";
                        switch($item_col["row_type"]){
                            case "checkbox":
                                $ele = "<input type='checkbox' class='".$item_col["row_class"]."' name='".$item_col["row_val_prefix"].$item_col["row_value"]."' id='".$item_col["row_val_prefix"].$item_col["row_value"]."'  />";
                              $ret .="<td>".$ele."</td>";
                                break;
                            case  "textbox":
                                $ret .="<td>".$item->$item_col["row_val_data"]."</td>";
                                break;
                            case "txt":
                                $ret .="<td>".$item->$item_col["row_val_data"]."</td>";
                                break;

                        }



                    }

                    $ret .="</tr>";
                }

            }

            $ret .="</tbody>";
            $ret .= "</table>";

//        }else{
//            $ret .= "no data";
//        }





        $ret = $ret . "</ul>";



        return $ret;
    }
}



