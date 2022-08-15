<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Menu - SumoWebTools') }}</title>

    <x-admin.headerAssets />

    <!-- Nestable -->
    <script src="{{ asset('assets/js/jquery.nestable.min.js') }}"></script>

    <link type="text/css" href="{{ asset('assets/css/jquery.nestable.min.css') }}" rel="stylesheet">
    
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
                        @livewire('admin.settings.menu')
                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

    @livewireScripts

    <script src="{{ asset('assets/js/choices.min.js') }}"></script>
</body>
</html>