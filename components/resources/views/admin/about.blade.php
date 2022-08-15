<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('About - SumoWebTools') }}</title>

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

						<div class="card">
							<div class="card-body">
								<p>{{ __('Thank you for purchasing our SumoWebTools script. We have put in lots of love in developing this product and are excited that you have chosen this script for your website. We hope you find it easy to use our product.') }}</p>
								<a class="btn btn-success" href="https://codecanyon.net/item/sumowebtools-online-web-tools-script/34704474" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path> <polyline points="7 11 12 16 17 11"></polyline> <line x1="12" y1="4" x2="12" y2="16"></line> </svg>
                                    {{ __('Download Now') }}
                                </a>

								<a href="https://codecanyon.net/user/themeluxury" target="_blank" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="12" r="4"></circle> <circle cx="12" cy="12" r="9"></circle> <line x1="15" y1="15" x2="18.35" y2="18.35"></line> <line x1="9" y1="15" x2="5.65" y2="18.35"></line> <line x1="5.65" y1="5.65" x2="9" y2="9"></line> <line x1="18.35" y1="5.65" x2="15" y2="9"></line> </svg>
                                    {{ __('Get Support') }}
                                </a>

								<div class="mt-3">
									<h3>{{ __('Changelog') }}</h3>
									<pre>
										{{ file_get_contents('./changelog.txt') }}
									</pre>
								</div>

							</div>
						</div>

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