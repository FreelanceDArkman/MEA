<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    @include('frontend.includes.head')
    @include('frontend.includes.head_script')
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>

<div class="wrapper">
    <!--=== Header ===-->
    @include('frontend.includes.header')
<!--=== End Header ===-->
    @include('frontend.includes.content_head')


    {{--<div class="bg-color-light">--}}
    <!-- BEGIN PAGE CONTAINER -->
        <div class="container content-sm">

            @yield('content')


            @include('frontend.includes.client')

        </div>
    <!-- END PAGE CONTAINER -->
{{--</div>--}}



</div>




{{--@include('frontend.includes.footer')--}}

@include('frontend.includes.footer_custom')

</body>
<!-- END BODY -->
</html>