<?php

//initilize the page
//require_once("backend/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
//require_once("backend/md5/md5.php");
$breadcrumbs = array(
        "DashBoard" => "/admin"
);
//var_dump($breadcrumbs);
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */



/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$data = getmemulist();
$page_title = "";
$arrSidebar =getSideBar($data);

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//



?>

@include("backend/includes/header")

@include("backend/includes/script")

{{--@include("backend/includes/sidebar")--}}

@include("backend/includes/nav")
        <!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    @include("backend/includes/ribbon")

            <!-- MAIN CONTENT -->


    @yield('content')

    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
include("backend/inc/footer.php");
?>
        <!-- END PAGE FOOTER -->




