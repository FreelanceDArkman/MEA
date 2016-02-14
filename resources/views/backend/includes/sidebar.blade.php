<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item start active open">
            <a href="{{ action('DashboardController@showIndex') }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
        </li>
        @if(menu_access(1,50) || menu_access(2,50))
        <li class="heading">
            <h3 class="uppercase">จัดการผู้ใช้</h3>
        </li>
        @if(menu_access(1,50))
        <li class="nav-item  ">
            <a href="{{ action('UserGroupController@userGroups') }}" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">จัดการกลุ่มผู้ใช้</span>
                <span class="arrow"></span>
            </a>
        </li>
        @endif
        @if(menu_access(2,50))
        <li class="nav-item  ">
            <a href="{{ action('UserController@users') }}" class="nav-link nav-toggle">
                <i class="icon-user"></i>
                <span class="title">จัดการผู้ใช้</span>
                <span class="arrow"></span>
            </a>
        </li>
        @endif
        @endif
        <li class="heading">
            <h3 class="uppercase">จัดการสมาชิกกองทุน</h3>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-layers"></i>
                <span class="title">ข้อมูลทั่วไปของสมาชิก</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder-alt"></i>
                <span class="title">ข้อมูลการเลือกแผนการลงทุนของสมาชิก</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder-alt"></i>
                <span class="title">ข้อมูลการลงทุนของสมาชิก</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder-alt"></i>
                <span class="title">ข้อมูลผู้รับผลประโยชน์ของสมาชิก</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder-alt"></i>
                <span class="title">ข้อมูลสัดส่วนผลตอบแทนการลงทุน</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="heading">
            <h3 class="uppercase">จัดการนโยบายลงทุน</h3>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder-alt"></i>
                <span class="title">จัดการนโยบายลงทุน</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="heading">
            <h3 class="uppercase">จัดการข่าวประชาสัมพันธ์</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-newspaper-o"></i>
                <span class="title">สร้างหมวดหมู่ข่าว</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-newspaper-o"></i>
                <span class="title">สร้างหัวข้อข่าว</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="heading">
            <h3 class="uppercase">จัดการถาม-ตอบ</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-question"></i>
                <span class="title">สร้างหมวดหมู่คำถาม-คำตอบ</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-question"></i>
                <span class="title">สร้างหัวข้อคำถาม-คำตอบ</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="heading">
            <h3 class="uppercase">จัดการช่องทางติดต่อ</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-map-marker"></i>
                <span class="title">ข้อมูลที่อยู่</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">ตอบกลับการสอบถามข้อมูล</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="heading">
            <h3 class="uppercase">จัดการแบบประเมินความเสี่ยง</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">จัดการแบบประเมินความเสี่ยง</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="heading">
            <h3 class="uppercase">จัดการมูลค่าทรัพย์สินสุทธิ</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">จัดการมูลค่าทรัพย์สินสุทธิ</span>
                <span class="arrow"></span>
            </a>
        </li>

        <li class="heading">
            <h3 class="uppercase">รายงาน</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานข้อมูลสมาชิกที่เปลี่ยนแผนการลงทุน</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานข้อมูลสมาชิกที่มีการเปลี่ยนแปลงอัตราสะสม</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานข้อมูลสมาชิกที่มีการเปลี่ยนแปลงอัตราสมทบ</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานแสดงข้อมูลเงินสะสม เงินสมทบ ประโยชน์เงินสะสม ประโยชน์เงินสมทบ</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานข้อมูลสมาชิกทุกประเภท</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานข้อมูลสมาชิกที่พ้นสภาพสมาชิก</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานข้อมูลสมาชิกที่พ้นสภาพพนักงาน แต่ยังเป็นสมาชิกแบบคงเงินหรือรับเงินเป็นงวด</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานผลการทำแบบประเมินความเสี่ยง</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานแสดงข้อมูลเปรียบเทียบผลประโยชน์และเงินบำเหน็จ</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานจำนวนผู้ติดตั้ง Application บน Mobile</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานสรุปผลการเลือกแผนการลงทุน</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานการเข้าใช้งานระบบ</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">รายงานสถิติ Search Keyword</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="heading">
            <h3 class="uppercase">ตั้งค่าระบบ</h3>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">ตั้งค่า Organization Link</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">ตั้งค่า Slide Show</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">ตั้งค่าข้อมูลข่าวสารและข้อมูลผู้รับผลประโยชน์</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-basket"></i>
                <span class="title">ตั้งค่าการเปลี่ยนแผนและเปลี่ยนอัตราสะสม</span>
                <span class="arrow"></span>
            </a>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>