@extends('backend.layouts.default')
@section('content')
<?php
$data = getmemulist();
$arrSidebar =getSideBar($data);
?>


<div id="content">

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-table fa-fw "></i>

                {{getMenutitle($arrSidebar)}}
            </h1>
        </div>

    </div>




</div>
<!-- END MAIN CONTENT -->



@stop