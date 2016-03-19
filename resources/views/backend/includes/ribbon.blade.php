<!-- RIBBON -->
<div id="ribbon">

		<span class="ribbon-button-alignment"> 
			<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> 
		</span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <?php
        foreach ($breadcrumbs as $display => $url) {
            $breadcrumb = $url != "" ? '<a href="'.$url.'">'.$display.'</a>' : $display;
            echo '<li>'.$breadcrumb.'</li>';
        }

        foreach($arrSidebar as $index => $list){
            if(!array_key_exists("url",$list)){

                foreach($list["sub"] as $submenu){
                    $arrurlsub = explode('/',$submenu["url"]);
                    $path = $arrurlsub[1]. "/" . $arrurlsub[2];
                    if(Request::is($path)){
                        echo '<li>'.$submenu["title"].'</li>';


                    }

                    if(array_key_exists("sub_mini",$submenu)){



                        foreach($submenu["sub_mini"] as $mini){
                            $arrurlsub = explode('/',$mini["url"]);

                            $path = $arrurlsub[1]. "/" . $arrurlsub[2] . "/" . $arrurlsub[3];



//

                           $current = Route::getCurrentRoute()->getPath();
                            $arrCount = explode('/',$current);

                            if(count($arrCount) > 2 ){

                                $Cpath = $arrCount[0] . "/" . $arrCount[1] . "/" . $arrCount[2];
//                                var_dump($Cpath);
                                if( $Cpath == $path){
                                    echo '<li><a href="'.$submenu['url'].'">'.$submenu["title"].'</a></li>';
                                    echo '<li>'.$mini["title"].'</li>';
                                    break;
                                }

                            }else{
                                if(Request::is($path)){
                                    echo '<li><a href="'.$submenu['url'].'">'.$submenu["title"].'</a></li>';
                                    echo '<li>'.$mini["title"].'</li>';
                                    break;
                                }
                            }
                           //var_dump(Route::getCurrentRoute()->getPath());




                        }

                    }
                }

            }
        }

        ?>
    </ol>
    <!-- end breadcrumb -->

    <!-- You can also add more buttons to the
    ribbon for further usability

    Example below:

    <span class="ribbon-button-alignment pull-right">
    <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
    <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
    <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
    </span> -->

</div>
<!-- END RIBBON -->