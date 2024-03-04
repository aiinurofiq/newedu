<!DOCTYPE html>

<html lang="en" class="light-style  layout-menu-fixed   " dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assetsadmin/') }}/" data-template="vertical-menu-theme-default-light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>JTLearning Perum Jasa Tirta I</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/select2/select2.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/dropzone/dropzone.css') }}" />

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assetsadmin/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assetsadmin/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assetsadmin/js/config.js') }}"></script>
    @livewireStyles
</head>

<body>
    <!-- Layout Content -->
    <div class="layout-wrapper layout-content-navbar ">
        <div class="layout-container">
            @include('layouts.admin.menu')
            <!-- Layout page -->
            <div class="layout-page">
                <!-- BEGIN: Navbar-->
                <!-- Navbar -->
                @include('layouts.admin.nav')
                <!-- / Navbar -->
                <!-- END: Navbar-->
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    {{ $slot }}
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('layouts.admin.footer')
                    <!-- Footer-->

                    <!--/ Footer-->
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    <!--/ Layout Content -->



    <!-- Include Scripts -->
    @livewireScripts
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assetsadmin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/autosize/autosize.js') }}"></script>
    {{-- <script src="{{ asset('assetsadmin/vendor/libs/dropzone/dropzone.js') }}"></script> --}}
    <script src="{{ asset('assetsadmin/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/js/menu.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assetsadmin/js/main.js') }}"></script>
    @yield('script')
    @stack('script')

</body>

</html>
