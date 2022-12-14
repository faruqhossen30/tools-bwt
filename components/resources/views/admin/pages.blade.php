<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Pages - SumoWebTools') }}</title>

    <x-admin.headerAssets />

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

                        @switch(true)

                            @case( Route::is('page-translations') )
                                    @livewire('admin.pages.translations.showlist', ['page_id' => request()->route('page_id') ])
                                @break

                           @case( Route::is('create-page-translations') )
                                    @livewire('admin.pages.translations.create', ['page_id' => request()->route('page_id') ])
                                @break

                           @case( Route::is('edit-page-translations') )
                                    @livewire('admin.pages.translations.edit', ['trans_id' => request()->route('trans_id')])
                                @break

                           @case( Route::is('categories') )
                                    @livewire('admin.pages.categories.showlist')
                                @break

                           @case( Route::is('tools') )
                                    @livewire('admin.pages.tools.showlist')
                                @break

                           @case( Route::is('authentication') )
                                    @livewire('admin.pages.auth-pages')
                                @break

                            @default
                                    @livewire('admin.pages.posts.showlist')
                        @endswitch

                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

    @livewireScripts

</body>
</html>