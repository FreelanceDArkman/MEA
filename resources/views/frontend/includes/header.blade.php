<?php
use Illuminate\Support\Facades\DB;
$data = getmemulist();
$current = Route::getCurrentRoute()->getPath();
?>

<div class="header">
    <div class="container">
        <!-- Logo -->
        @if($current != "firstlogin")
        <a class="logo" href="/" target="_blank">

            <img src="/frontend/assets/img/logo1-default.png" alt="Logo">
        </a>
            @else
            <a class="logo" href="#" >

                <img src="/frontend/assets/img/logo1-default.png" alt="Logo">
            </a>
            @endif

        <!-- End Logo -->

        <!-- Topbar -->
        <div class="topbar">

            <ul class="loginbar pull-right">
                {{--hoverSelector--}}
                @if($current != "firstlogin")
                <li ><a href="/qa"> <i class="fa fa-comment"></i> {{ getGoupName($data,6) }}</a></li>
                <li class="topbar-devider"></li>
                <li>
                    <a href="{{getManual()}}" target="_blank"> <i class="fa fa-cog"></i> คู่มือการใช้งาน</a>
                </li>
                <li class="topbar-devider"></li>
                <li><a href="/contact"><i class="fa fa-map-marker"></i> {{ getGoupName($data,8) }}</a></li>
                <li class="topbar-devider"></li>

                     @if(logged_in() && ($current != "firstlogin"))
                            <li> <a href="/profile"><i class="fa fa-user"></i> สวัสดี  {{get_username()}}</a>


                            </li>
                            <li class="topbar-devider"></li>
                        <li> <a href="/logout"><i class="fa fa fa-sign-out"></i> ออกจากระบบ</a> </li>


                       @else
                            <li><a href="/login"> <i class="fa fa-user"></i> เข้าสู่ระบบ </a></li>
                        @endif

                @endif

            </ul>

        </div>
        <!-- End Topbar -->

        <!-- Toggle get grouped for better mobile display -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>
        <!-- End Toggle -->
    </div><!--/end container-->


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
        <div class="container">
            @if($current != "firstlogin")
            <ul class="nav navbar-nav">
                <!-- Home -->
                <li class="dropdown dropdown-hide-sub {{IsActive('/')}}">
                    <a href="/"  >
                        หน้าแรก
                    </a>

                </li>
                <!-- End Home -->

                <!-- Demo Pages -->
               @if(menu_access(1,20) )
                <li class="dropdown {{IsActive('editprofile,informationbeneficiary,resetpassword,trends,reportingmemberbenefit,compares,changeplan,historyinvestmentplan,cumulative,historycumulative,riskassessment')}}" >
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">


                        {{ getGoupName($data,20) }}
                    </a>
                    <ul class="dropdown-menu">

                        <li class="dropdown-submenu" >
                            <a href="javascript:void(0);">{{ getGoupName($data,21) }}</a>
                            <ul class="dropdown-menu">
                                <li><a href="/trends">{{ getMenuName($data,21,1) }}</a></li>
                                <li><a href="/reportingmemberbenefit">{{ getMenuName($data,21,2)}}</a></li>
                                <li><a  href="/compares">{{ getMenuName($data,21,3) }}</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu" >
                            <a href="javascript:void(0);">{{ getGoupName($data,22) }}</a>
                            <ul class="dropdown-menu">
                                <li><a  href="/changeplan">{{ getMenuName($data,22,1) }}</a></li>
                                <li><a  href="/historyinvestmentplan">{{ getMenuName($data,22,2) }}</a></li>


                            </ul>
                        </li>
                        <li class="dropdown-submenu" >
                            <a href="javascript:void(0);">{{ getGoupName($data,23) }}</a>
                            <ul class="dropdown-menu">
                                <li><a  href="/cumulative">{{ getMenuName($data,23,1) }}</a></li>
                                <li><a  href="/historycumulative">{{ getMenuName($data,23,2) }}</a></li>


                            </ul>
                        </li>
                        <li>
                            <a href="/riskassessment">{{ getGoupName($data,24) }}</a>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="javascript:void(0);">{{ getMenuName($data,20,1) }}</a>
                            <ul class="dropdown-menu">
                                <li><a  href="/editprofile">{{ getMenuName($data,20,1) }}</a></li>
                                <li><a  href="/informationbeneficiary">{{ getMenuName($data,20,2) }}</a></li>
                                <li><a  href="/resetpassword">{{ getMenuName($data,20,3) }}</a></li>

                            </ul>
                        </li>

                    </ul>
                </li>
                    @endif
                <!-- End Demo Pages -->



                <!-- Pages -->
                <li class="dropdown {{IsActive('valuefund,netasset,economic')}}" >
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        {{ getGoupName($data,1) }}
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <a href="/valuefund">{{ getMenuName($data,1,1) }}</a>

                        </li>
                        <!-- About Pages -->
                        <li>
                            <a href="/netasset">{{ getMenuName($data,1,2) }}</a>

                        </li>
                        <!-- End About Pages -->

                        <!-- Service Pages -->
                        <li>
                            <a href="/economic">{{ getMenuName($data,1,3) }}</a>

                        </li>
                        <!-- End Service Pages -->

                        <!-- End Sub Level Menu -->
                    </ul>
                </li>
                <!-- End Pages -->

                <!-- Blog -->
                <li class="dropdown {{IsActive('announce,actfund,board,fundregulations')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        {{ getGoupName($data,2) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li >
                            <a href="/announce">{{ getMenuName($data,2,1) }}</a>

                        </li>
                        <li >
                            <a href="/actfund">{{ getMenuName($data,2,2) }}</a>

                        </li>
                        <li >
                            <a href="/board">{{ getMenuName($data,2,3) }}</a>

                        </li>
                        <li >
                            <a href="/fundregulations">{{ getMenuName($data,2,4) }}</a>

                        </li>

                    </ul>
                </li>
                <!-- End Blog -->

                <!-- Portfolio -->
                <li class="dropdown {{IsActive('fundboard,structuralfunds,yearbook')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        {{ getGoupName($data,3) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/fundboard">{{ getMenuName($data,3,1) }}</a> </li>
                        <li><a href="/structuralfunds">{{ getMenuName($data,3,2) }}</a> </li>
                        <li><a href="/yearbook">{{ getMenuName($data,3,3) }}</a> </li>
                    </ul>
                </li>
                <!-- End Portfolio -->

                <!-- Features -->
                <li class="dropdown {{IsActive('downloads,test')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        {{ getGoupName($data,4) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li >
                            <a href="/downloads">{{ getMenuName($data,4,1) }}</a>

                        </li>

                        <li><a href="/test">{{ getMenuName($data,4,2) }}</a></li>

                    </ul>
                </li>
                <!-- End Features -->

                <!-- Shortcodes -->
                <li class="dropdown {{IsActive('membershipform,form,otherforms')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        {{ getGoupName($data,5) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/membershipform">{{ getMenuName($data,5,1) }}</a></li>
                        <li><a href="/form">{{ getMenuName($data,5,2) }}</a></li>
                        <li><a href="/otherforms">{{ getMenuName($data,5,3) }}</a></li>
                    </ul>
                </li>
                <!-- End Shortcodes -->



                <!-- Demo Pages -->
                <li class="dropdown {{IsActive('news,newsfund')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        {{ getGoupName($data,7) }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/news">{{ getMenuName($data,7,1) }}</a></li>
                        <li><a href="/newsfund">{{ getMenuName($data,7,2) }}</a></li>
                    </ul>
                </li>
                <!-- End Demo Pages -->




                <!-- Search Block -->
                <li>
                    <i class="search fa fa-search search-btn"></i>
                    <div class="search-open">
                        {{--<form id="mea_search" action="{{action('SearchController@getIndex')}}" method="post">--}}
                            {{--{!! csrf_field() !!}--}}
                            <div class="input-group animated fadeInDown">
                                <input type="text" class="form-control" onkeypress="return clickButton(event,'search_go');" id="sKeys" name="sKeys" placeholder="Search">
								<span class="input-group-btn">
									<a class="btn-u" id="search_go" type="submit">ค้นหา</a>
								</span>
                            </div>
                        {{--</form>--}}

                    </div>
                </li>
                <!-- End Search Block -->
            </ul>
            @endif
        </div><!--/end container-->
    </div><!--/navbar-collapse-->
    </div>


<script type="text/javascript">

//    function clickButton(e, buttonid) {
//        var evt = e ? e : window.event;
//        var bt = document.getElementById(buttonid);
//        if (bt) {
//            if (evt.keyCode == 13) {
//                bt.click();
//                return false;
//            }
//        }
//    }

    $(document).ready(function(){


            $("#search_go").on('click',function(){

                var key= $("#sKeys").val();

                var arrkey = key.split(" ");

                var keyret = "";
                for(i = 0; i< arrkey.length; i++){

                    if(arrkey.length == 0){

                        if(arrkey[i] != ''){
                            keyret = keyret + arrkey[i] ;
                        }
                    }

                    if(arrkey.length > 0){

                        if(arrkey[i] != ''){

                            if( (i+1) < arrkey.length){
                                keyret = keyret + arrkey[i] + '+';
                            }else {
                                keyret = keyret + arrkey[i] ;
                            }


                        }
                    }

                }


                window.location.href = "/search?keys=" + encodeURIComponent(keyret);



            });


//        $("#sKeys").on('keypress' ,function(){
//            var code = (e.keyCode ? e.keyCode : e.which);
//            if(code == 13) { //Enter keycode
//                alert('enter press');
//            }
//
//        });




    });

</script>