
<!-- JS Global Compulsory -->
<script type="text/javascript" src="{{asset('frontend/assets/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/jquery/jquery-migrate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="{{asset('frontend/assets/plugins/back-to-top.js')}}"></script>
{{--<script type="text/javascript" src="frontend/assets/plugins/smoothScroll.js"></script>--}}


{{--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
{{--<script type="text/javascript" src="{{asset('frontend/assets/plugins/gmap/gmap.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('frontend/assets/plugins/jquery.mixitup.min.js')}}"></script>
{{--<script type="text/javascript" src="frontend/assets/plugins/parallax-slider/js/modernizr.js"></script>--}}
{{--<script type="text/javascript" src="frontend/assets/plugins/parallax-slider/js/jquery.cslider.js"></script>--}}

<script type="text/javascript" src="{{asset('frontend/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js')}}"></script>

<script type="text/javascript" src="{{asset('frontend/assets/plugins/layer-slider/layerslider/js/greensock.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/layer-slider/layerslider/js/layerslider.transitions.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/assets/plugins/layer-slider/layerslider/js/layerslider.kreaturamedia.jquery.js')}}"></script>
<!-- JS Customization -->
<script type="text/javascript" src="{{asset('frontend/assets/js/custom.js')}}"></script>
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



{{--<script type="text/javascript" src="frontend/assets/js/plugins/parallax-slider.js"></script>--}}
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();

//        ContactPage.initMap();
//        LoginForm.initLoginForm();
//        ContactForm.initContactForm();

        LayerSlider.initLayerSlider();
        OwlCarousel.initOwlCarousel();

        StyleSwitcher.initStyleSwitcher();
        PortfolioPage.init();
//        ParallaxSlider.initParallaxSlider();

//        CirclesMaster.initCirclesMaster2();
//
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


