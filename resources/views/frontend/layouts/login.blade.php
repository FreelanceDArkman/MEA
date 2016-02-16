<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    @include('frontend.includes.head')
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>

<div class="wrapper">
    <!--=== Header ===-->
    @include('frontend.includes.header')
<!--=== End Header ===-->




    <!-- BEGIN PAGE CONTAINER -->
    <div class="container content-sm">

        @yield('content')


        @include('frontend.includes.client')

    </div>
    <!-- END PAGE CONTAINER -->


</div>




@include('frontend.includes.footer')

</body>
<!-- END BODY -->
</html>