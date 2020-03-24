<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
@include('layouts.components._head')

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">
@include('layouts.components._header')


<div class="app-content content" style="margin-left: 0">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- END: Content-->



<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-dark">

</footer>
<!-- END: Footer-->


@include('layouts.components._scripts')

</body>
</html>

