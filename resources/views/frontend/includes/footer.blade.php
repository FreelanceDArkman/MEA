<?php
$data = getmemulist();
?>

<div id="footer-v3" class="footer-v3">
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
                        <li><a href="/คณะกรรมการกองทุน">{{ getMenuName($data,3,1) }}</a></li>
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

    <div class="copyright">
        <div class="container">
            <div class="row">
                <!-- Terms Info-->
                <div class="col-md-12">
                    <p>
                        &copy; สงวนลิขสิทธิ์ 2559 : การไฟฟ้านครหลวง 30 ซอยชิดลม ถนนเพลินจิตร แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330
                        {{--<a target="_blank" href="https://twitter.com/htmlstream">Htmlstream</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>--}}
                    </p>
                </div>
                <!-- End Terms Info-->

                <!-- Social Links -->
                {{--<div class="col-md-6">--}}
                    {{--<ul class="social-icons pull-right">--}}
                        {{--<li><a href="#" data-original-title="Facebook" class="rounded-x social_facebook"></a></li>--}}
                        {{--<li><a href="#" data-original-title="Twitter" class="rounded-x social_twitter"></a></li>--}}
                        {{--<li><a href="#" data-original-title="Goole Plus" class="rounded-x social_googleplus"></a></li>--}}
                        {{--<li><a href="#" data-original-title="Linkedin" class="rounded-x social_linkedin"></a></li>--}}
                        {{--<li><a href="#" data-original-title="Pinterest" class="rounded-x social_pintrest"></a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                <!-- End Social Links -->
            </div>
        </div>
    </div><!--/copyright-->
</div>


<script type="text/javascript" src="{{asset('frontend/assets/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/jquery/jquery-migrate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="{{asset('frontend/assets/plugins/back-to-top.js')}}"></script>
{{--<script type="text/javascript" src="frontend/assets/plugins/smoothScroll.js"></script>--}}


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/gmap/gmap.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/jquery.mixitup.min.js')}}"></script>
{{--<script type="text/javascript" src="frontend/assets/plugins/parallax-slider/js/modernizr.js"></script>--}}
{{--<script type="text/javascript" src="frontend/assets/plugins/parallax-slider/js/jquery.cslider.js"></script>--}}

<script type="text/javascript" src="{{asset('frontend/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js')}}"></script>

<script type="text/javascript" src="{{asset('frontend/assets/plugins/layer-slider/layerslider/js/greensock.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/layer-slider/layerslider/js/layerslider.transitions.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/layer-slider/layerslider/js/layerslider.kreaturamedia.jquery.js')}}"></script>

<!-- JS Page Level -->

<script type="text/javascript" src="{{asset('frontend/assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/app.js')}}"></script>

<script type="text/javascript" src="{{asset('frontend/assets/js/forms/login.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/forms/contact.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/pages/page_contacts.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/circles-master/circles.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/counter/jquery.counterup.min.js')}}"></script>


<script type="text/javascript" src="{{asset('frontend/assets/js/plugins/layer-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/plugins/owl-carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/plugins/style-switcher.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/pages/page_portfolio.js')}}"></script>

<script type="text/javascript" src="{{asset('frontend/assets/js/plugins/circles-master.js')}}"></script>

<script type="text/javascript" src="{{asset('frontend/assets/highchart/highcharts.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/highchart/exporting.js')}}"></script>
<!-- JS Customization -->
<script type="text/javascript" src="{{asset('frontend/assets/js/custom.js')}}"></script>

{{--<script type="text/javascript" src="frontend/assets/js/plugins/parallax-slider.js"></script>--}}
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();

//        ContactPage.initMap();
        LoginForm.initLoginForm();
        ContactForm.initContactForm();

        LayerSlider.initLayerSlider();
        OwlCarousel.initOwlCarousel();

        StyleSwitcher.initStyleSwitcher();
        PortfolioPage.init();
//        ParallaxSlider.initParallaxSlider();
        CirclesMaster.initCirclesMaster1();
//        CirclesMaster.initCirclesMaster2();

        jQuery("DIV[id^='modol']").on('hidden.bs.modal', function (e) {
            // do something...
            jQuery("DIV[id^='modol'] video").get(0).pause();
//            jQuery("DIV[id^='modol'] video source").attr("src",  jQuery("DIV[id^='modol'] video source").attr("src"));
        })
    });



</script>
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/respond.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/html5shiv.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/placeholder-IE-fixes.js')}}"></script>


<![endif]-->