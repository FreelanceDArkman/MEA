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
@include('frontend.includes.header')
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">

    @yield('content')

</div>
<!-- END PAGE CONTAINER -->

@include('frontend.includes.footer')

</body>
<!-- END BODY -->
</html>