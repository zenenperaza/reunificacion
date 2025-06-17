<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Panel administrativo" name="description" />
    <meta content="ASONACOP" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- App CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading"
      data-layout-color="light"
      data-layout-mode="default"
      data-layout-size="fluid"
      data-topbar-color="light"
      data-leftbar-position="fixed"
      data-leftbar-color="light"
      data-leftbar-size="default"
      data-sidebar-user="true">

    <!-- Begin page -->
    <div id="wrapper">

        @include('partials.header')

        @include('partials.menu')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>

            @include('partials.footer')
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('partials.rightbar')

    <!-- App JS -->
    @include('partials.js')

    @yield('scripts')
</body>

</html>
