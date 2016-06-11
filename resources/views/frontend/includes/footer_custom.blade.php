<?php
$data = getmemulist();
$current = Route::getCurrentRoute()->getPath();
?>
<div id="footer-v3" class="footer-v3">
    @if($current != "firstlogin")
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-sm-3 md-margin-bottom-40" style="text-align: center;">
                    <a href="index.html"><img id="logo-footer" class="footer-logo" src="{{asset('frontend/assets/img/logo2-default.png')}}" alt=""></a>
                    <p style="text-align: left">กองทุนสำรองเลี้ยงชีพพนักงานการไฟฟ้านครหลวง ซึ่งจดทะเบียนแล้ว(กสช.กฟน) </p>

                </div><!--/col-md-3-->
                <!-- End About -->

                <!-- Simple List -->
                <div class="col-sm-3 md-margin-bottom-40">
                    <div class="thumb-headline"><h2>{{ getGoupName($data,1) }}</h2></div>
                    <ul class="list-unstyled simple-list margin-bottom-20">
                        <li><a href="/valuefund">{{ getMenuName($data,1,1) }}</a></li>
                        <li><a href="/netasset">{{ getMenuName($data,1,2) }}</a></li>
                        <li><a href="/economic">{{ getMenuName($data,1,3) }}</a></li>

                    </ul>

                    <div class="thumb-headline"><h2>{{ getGoupName($data,2) }}</h2></div>
                    <ul class="list-unstyled simple-list">
                        <li><a href="/announce">{{ getMenuName($data,2,1) }}</a></li>
                        <li><a href="/actfund">{{ getMenuName($data,2,2) }}</a></li>
                        <li><a href="/board">{{ getMenuName($data,2,3) }}</a></li>
                        <li><a href="/fundregulations">{{ getMenuName($data,2,4) }}</a></li>

                    </ul>
                </div><!--/col-md-3-->

                <div class="col-sm-3">
                    <div class="thumb-headline"><h2>{{ getGoupName($data,3) }}</h2></div>
                    <ul class="list-unstyled simple-list margin-bottom-20">
                        <li><a href="/fundboard">{{ getMenuName($data,3,1) }}</a></li>
                        <li><a href="/structuralfunds">{{ getMenuName($data,3,2) }}</a></li>
                        <li><a href="/yearbook">{{ getMenuName($data,3,3) }}</a></li>

                    </ul>

                    <div class="thumb-headline"><h2>{{ getGoupName($data,4) }}</h2></div>
                    <ul class="list-unstyled simple-list">
                        <li><a href="/downloads">{{ getMenuName($data,4,1) }}</a></li>
                        <li><a href="/test">{{ getMenuName($data,4,2) }}</a></li>

                    </ul>

                    <div class="thumb-headline"><h2>{{ getGoupName($data,5) }}</h2></div>
                    <ul class="list-unstyled simple-list">
                        <li><a href="/membershipform">{{ getMenuName($data,5,1) }}</a></li>
                        <li><a href="/form">{{ getMenuName($data,5,2) }}</a></li>
                        <li><a href="/otherforms">{{ getMenuName($data,5,3) }}</a></li>
                    </ul>
                </div><!--/col-md-3-->

                <div class="col-sm-3">
                    <div class="thumb-headline"><h2>{{ getGoupName($data,7) }}</h2></div>
                    <ul class="list-unstyled simple-list margin-bottom-20">
                        <li><a href="/news">{{ getMenuName($data,7,1) }}</a></li>
                        <li><a href="/newsfund">{{ getMenuName($data,7,2) }}</a></li>

                    </ul>

                    <div class="thumb-headline"><h2>{{ getGoupName($data,8) }}</h2></div>
                    <ul class="list-unstyled simple-list">
                        <li><a href="/contact">{{ getMenuName($data,8,1) }}</a></li>
                        <li><a href="/contact">{{ getMenuName($data,8,2) }}</a></li>

                    </ul>

                    <div class="thumb-headline"><h2>{{ getGoupName($data,6) }}</h2>  </div>
                    <ul class="list-unstyled simple-list">
                        <li><a href="/qa">{{ getGoupName($data,6) }}</a></li>


                    </ul>
                </div><!--/col-md-3-->
                <!-- End Simple List -->
            </div>
        </div>
    </div><!--/footer-->
    @endif
    <div class="copyright">
        <div class="container">
            <div class="row">
                <!-- Terms Info-->
                <div class="col-md-12">
                    <p>
                        &copy; สงวนลิขสิทธิ์ 2559 : การไฟฟ้านครหลวง 30 ซอยชิดลม ถนนเพลินจิต แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330
                        {{--<a target="_blank" href="https://twitter.com/htmlstream">Htmlstream</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>--}}
                    </p>
                </div>
                <!-- End Terms Info-->


            </div>
        </div>
    </div><!--/copyright-->
</div>

