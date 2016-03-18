<?php

//initilize the page
//require_once("backend/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("backend/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");


?>

@include("backend/includes/header")

@include("backend/includes/script")



        <!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
    <!--<span id="logo"></span>-->

    <div id="logo-group">
        <span id="logo"> <img src="{{asset('backend/img/logo.png')}}" alt="SmartAdmin"> </span>

        <!-- END AJAX-DROPDOWN -->
    </div>



</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        @yield('content')
    </div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->



        <!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->


<?php
include("backend/inc/footer.php");
?>
<?php
//include footer
//include("inc/google-analytics.php");
?>