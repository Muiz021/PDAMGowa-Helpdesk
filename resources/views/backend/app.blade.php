<!DOCTYPE html>
<html lang="en">

<head>

    @include('backend.template.meta')

    <!-- Title Page-->
    <title>@yield('title')</title>

    @stack('before-style')
    @include('backend.template.style')
    @stack('after-style')

</head>

<body class="animsition">
    <div class="page-wrapper">

        <!-- HEADER MOBILE-->
        @include('backend.template.header-mobile')
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        @include('backend.template.sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
           @include('backend.template.header-desktop')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    @stack('before-script')
    @include('backend.template.script')
    @stack('after-script')

</body>

</html>
<!-- end document-->
