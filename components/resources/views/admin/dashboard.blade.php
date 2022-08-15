<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Dashboard - SumoWebTools') }}</title>

    <x-admin.headerAssets />

    <link href="{{ asset('assets/css/apexcharts.min.css') }}" rel="stylesheet">

    @livewireStyles

</head>
<body class="antialiased {{ Cookie::get('theme_mode') }}">

    <div class="wrapper">
      <x-admin.sidebar />
      <div class="page-wrapper">
        
            <!-- Begin::Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg" id="navbarBlur" navbar-scroll="false">
             <div class="container-fluid">

                <x-admin.breadcrumbs />

                <x-admin.navright />

             </div>
            </nav>
            <!-- End::Navbar -->

            <div class="page-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col">
                        @livewire('admin.dashboard')
                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>

    @livewireScripts

</body>
</html>