<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true  }' src="{{asset('backend/js/plugin/pace/pace.min.js')}}"></script>

<!-- These scripts will be located in Header So we can add scripts inside body (used in class.datatables.php) -->
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="{{asset('backend/js/libs/jquery-2.0.2.min.js')}}"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="{{asset('backend/js/libs/jquery-ui-1.10.3.min.js')}}"><\/script>');
			}
		</script> -->

<!-- IMPORTANT: APP CONFIG -->
<script src="{{asset('backend/js/app.config.js')}}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{{asset('backend/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('backend/js/bootstrap/bootstrap.min.js')}}"></script>


{{--Custom By Darkman--}}

{{--<script src="{{asset('backend/js/bootstrap/bootstrap-datepicker.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/bootstrap/bootstrap-datepicker-thai.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/bootstrap/locales/bootstrap-datepicker.th.js')}}"></script>--}}


<!-- CUSTOM NOTIFICATION -->
<script src="{{asset('backend/js/notification/SmartNotification.min.js')}}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{asset('backend/js/smartwidgets/jarvis.widget.min.js')}}"></script>

<!-- EASY PIE CHARTS -->
<script src="{{asset('backend/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')}}"></script>

<!-- SPARKLINES -->
<script src="{{asset('backend/js/plugin/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- JQUERY VALIDATE -->
<script src="{{asset('backend/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{asset('backend/js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{asset('backend/js/plugin/select2/select2.min.js')}}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{asset('backend/js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

<!-- browser msie issue fix -->
<script src="{{asset('backend/js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{asset('backend/js/plugin/fastclick/fastclick.min.js')}}"></script>

<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- Demo purpose only -->
<script src="{{asset('backend/js/demo.min.js')}}"></script>

<!-- MAIN APP JS FILE -->
<script src="{{asset('backend/js/app.min.js')}}"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="{{asset('backend/js/speech/voicecommand.min.js')}}"></script>

<!-- SmartChat UI : plugin -->
<script src="{{asset('backend/js/smart-chat-ui/smart.chat.ui.min.js')}}"></script>
<script src="{{asset('backend/js/smart-chat-ui/smart.chat.manager.min.js')}}"></script>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{asset('backend/js/plugin/jquery-form/jquery-form.min.js')}}"></script>

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    $(document).ready(function() {
        pageSetUp();
    })
</script>