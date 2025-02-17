<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>Admin | @yield('title')</title>
    <!--  Required Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('meta.description', config('variable.DESCRIPTION'))">
    <meta name="author" content="@yield('meta.author', config('variable.AUTHOR'))">
    <meta name="keywords" content="@yield('meta.keywords', config('variable.KEYWORDS'))">
    <meta name="robots" content="index, follow">
    <!--  Logo Website -->
    <link rel="icon" href="{{ asset('assets/img/cce.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/cce.png') }}">
    <!--  Favicon -->
    {{-- <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" /> --}}
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />

    <!-- Bootstrap 5 (Jika belum ada) -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- jQuery (Diperlukan untuk DataTables) -->

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        {{-- Sidebar --}}
        @include('admin.layout.side')
        @include('admin.layout.side')

        <div class="body-wrapper">
            {{-- navbar --}}
            @include('admin.layout.nav')

            <!-- Content Page -->
            <div class="content-page" style="padding: 100px 20px;">
                @yield('content')
                {{-- @include('layout.profile-modal') --}}
                <!-- Footer -->
            </div>
        </div>
    </div>

    <!--  Customizer -->
    <!--  Import Js Files -->
    <script src="{{ asset ('dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset ('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset ('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ asset ('dist/js/app.min.js') }}"></script>
    <script src="{{ asset ('dist/js/app.init.js') }}"></script>
    <script src="{{ asset ('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset ('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset ('dist/js/custom.js') }}"></script>
    <!--  current page js files -->
    <script src="{{ asset ('dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset ('dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset ('dist/js/dashboard.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true
            });
        });
    </script>
</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jul 2023 01:55:21 GMT -->

</html>