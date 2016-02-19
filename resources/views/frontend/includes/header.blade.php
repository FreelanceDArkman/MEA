<div class="header">
    <div class="container">
        <!-- Logo -->
        <a class="logo" href="/">
            <img src="/frontend/assets/img/logo1-default.png" alt="Logo">
        </a>
        <!-- End Logo -->

        <!-- Topbar -->
        <div class="topbar">
            <ul class="loginbar pull-right">
                <li class="hoverSelector">
                    <i class="fa fa-globe"></i>
                    <a href="/qa">ถาม-ตอบ</a>

                </li>
                <li class="topbar-devider"></li>
                <li><a href="/contact">ติดต่อ กทช.</a></li>
                <li class="topbar-devider"></li>

             @if(logged_in())
                    <li><a href="/logout"> สวัสดี  {{get_username()}}</a></li>

               @else
                    <li><a href="/login">เข้าสู่ระบบ </a></li>
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
            <ul class="nav navbar-nav">
                <!-- Home -->
                <li class="dropdown dropdown-hide-sub {{IsActive('/')}}">
                    <a href="/"  >
                        หน้าแรก
                    </a>

                </li>
                <!-- End Home -->

                <!-- Demo Pages -->
               @if(menu_access(1,20))
                <li class="dropdown {{IsActive('editprofile,informationbeneficiary,resetpassword,trends,reportingmemberbenefit,compares,changeplan,historyinvestmentplan,cumulative,historycumulative,riskassessment')}}" >
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        ข้อมูลส่วนตัว
                    </a>
                    <ul class="dropdown-menu">

                        <li class="dropdown-submenu">
                            <a href="javascript:void(0);">แก้ไขข้อมูลส่วนตัว</a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="/editprofile">แก้ไขข้อมูลส่วนตัว</a></li>
                                <li><a target="_blank" href="/informationbeneficiary">ข้อมูลผู้รับผลประโยชน์</a></li>
                                <li><a target="_blank" href="/resetpassword">เปลี่ยนรหัสผ่าน</a></li>

                            </ul>
                        </li>

                        <li class="dropdown-submenu" >
                            <a href="javascript:void(0);">ข้อมูลการลงทุน</a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="/trends">แนวโน้มสัดส่วนการลงทุน</a></li>
                                <li><a target="_blank" href="/reportingmemberbenefit">รายงานผลประโยชน์สมาชิก</a></li>
                                <li><a target="_blank" href="/compares">รายงานเปรียบเทียบเงินกองทุนสำรองเลี้ยงชีพ กับเงินบำเหน็จ</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu" >
                            <a href="javascript:void(0);">แผนการลงทุน</a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="/changeplan">เปลี่ยนแผนการลงทุน</a></li>
                                <li><a target="_blank" href="/historyinvestmentplan">ประวัติการเปลี่ยนแผนการลงทุน</a></li>


                            </ul>
                        </li>
                        <li class="dropdown-submenu" >
                            <a href="javascript:void(0);">ข้อมูลอัตราสะสม</a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="/cumulative">เปลี่ยนอัตราสะสม</a></li>
                                <li><a target="_blank" href="/historycumulative">ประวัติการเปลี่ยนอัตราสะสม</a></li>


                            </ul>
                        </li>
                        <li>
                            <a href="/riskassessment">แบบประเมินความเสี่ยง</a>
                        </li>

                    </ul>
                </li>
                    @endif
                <!-- End Demo Pages -->



                <!-- Pages -->
                <li class="dropdown {{IsActive('valuefund,netasset,economic')}}" >
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        ผลการดำเนินงาน
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <a href="/valuefund">มูลค่ากองทุน</a>

                        </li>
                        <!-- About Pages -->
                        <li>
                            <a href="/netasset">รายงานมูลค่าทรัพย์สิน</a>

                        </li>
                        <!-- End About Pages -->

                        <!-- Service Pages -->
                        <li>
                            <a href="/economic">สรุปภาวะเศรษฐกิจและกลยุทธ์</a>

                        </li>
                        <!-- End Service Pages -->

                        <!-- End Sub Level Menu -->
                    </ul>
                </li>
                <!-- End Pages -->

                <!-- Blog -->
                <li class="dropdown {{IsActive('announce,actfund,board,fundregulations')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        ประมวลระเบียบ
                    </a>
                    <ul class="dropdown-menu">
                        <li >
                            <a href="/announce">ประกาศ</a>

                        </li>
                        <li >
                            <a href="/actfund">พระราชบัญญัติกองทุนสำรองเลี้ยงชีพ</a>

                        </li>
                        <li >
                            <a href="/board">คำสั่งแต่งตั้งคณะกรรมการ</a>

                        </li>
                        <li >
                            <a href="/fundregulations">ข้อบังคับกองทุน</a>

                        </li>

                    </ul>
                </li>
                <!-- End Blog -->

                <!-- Portfolio -->
                <li class="dropdown {{IsActive('fundboard,structuralfunds,yearbook')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        กองทุน
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/fundboard">คณะกรรมการกองทุน</a> </li>
                        <li><a href="/structuralfunds">โครงสร้างกองทุน</a> </li>
                        <li><a href="/yearbook">รายงานประจำปี</a> </li>
                    </ul>
                </li>
                <!-- End Portfolio -->

                <!-- Features -->
                <li class="dropdown {{IsActive('download,test')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        ความรู้การลงทุน
                    </a>
                    <ul class="dropdown-menu">
                        <li >
                            <a href="/download">เอกสารดาวน์โหลด</a>

                        </li>

                        <li><a href="/test">แบบทดสอบ</a></li>

                    </ul>
                </li>
                <!-- End Features -->

                <!-- Shortcodes -->
                <li class="dropdown {{IsActive('membershipform,form,otherforms')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        แบบฟอร์ม
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/membershipform">แบบฟอร์มกรณีพ้นสมาชิกภาพ</a></li>
                        <li><a href="/form">แบบฟอร์มกรณีขอคงเงินหรือขอรับเงินเป็นงวด</a></li>
                        <li><a href="/otherforms">แบบฟอร์มและใบคำร้องอื่นๆ</a></li>
                    </ul>
                </li>
                <!-- End Shortcodes -->



                <!-- Demo Pages -->
                <li class="dropdown {{IsActive('news,newsfund')}}">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        ข่าวประชาสัมพันธ์
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/news">ข่าวประชาสัมพันธ์</a></li>
                        <li><a href="/newsfund">ข่าวกองทุน</a></li>
                    </ul>
                </li>
                <!-- End Demo Pages -->




                <!-- Search Block -->
                <li>
                    <i class="search fa fa-search search-btn"></i>
                    <div class="search-open">
                        <div class="input-group animated fadeInDown">
                            <input type="text" class="form-control" placeholder="Search">
								<span class="input-group-btn">
									<button class="btn-u" type="button">Go</button>
								</span>
                        </div>
                    </div>
                </li>
                <!-- End Search Block -->
            </ul>
        </div><!--/end container-->
    </div><!--/navbar-collapse-->
</div>
