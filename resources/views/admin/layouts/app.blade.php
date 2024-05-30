<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ env('APP_NAME') }}</title>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="keywords"
            content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
        <meta name="description"
            content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
        <meta name="robots" content="noindex,nofollow" />
        <title>Matrix Admin Lite Free Versions Template by WrapPixel</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/logo-icon.png') }}" />
        <link href="{{ asset('public/dist/css/style.min.css') }}" rel="stylesheet" />
    </head>
    @stack('style')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        <div class="page-wrapper">
            @yield('content')
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('public/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('public/form-validator/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/bootstrap-notify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function message(msg, type = 'success') {
            $.notify({
                message: msg
            }, {
                type: type,
                z_index: 9999,
            });
        }
    </script>
    @if (Session::has('success'))
        <script>
            message("{{ session('success') }}");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            message("{{ session('error') }}", 'danger');
        </script>
    @endif
    @stack('scripts')
    @stack('custon-scripts')
    <!-- <script src="{{ asset('public/dist/js/demo.js') }}"></script> -->
</body>

</html>
