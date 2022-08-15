<aside class="navbar navbar-vertical navbar-expand-lg navbar-light shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="{{ route('home') }}">
                @if ( Cookie::get('theme_mode') === 'theme-dark' )
                    <img src="{{ asset('assets/img/logo-dark.svg') }}" width="110" height="32" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @elseif( Cookie::get('theme_mode') === 'theme-light' )
                    <img src="{{ asset('assets/img/logo-light.svg') }}" width="110" height="32" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @else
                    <img src="{{ asset('assets/img/logo-light.svg') }}" width="110" height="32" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @endif
            </a>
        </h1>

        <div class="navbar-nav d-lg-none">
            <a class="nav-link cursor-pointer" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                <span class="avatar avatar-sm" style="background-image: url(https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=150&d=mm&r=g);"></span>
                <div class="d-none d-xl-block">
                    <div>{{ Auth::user()->fullname }}</div>
                    <div class="small text-muted">{{ ( Auth::user()->level == 1) ? __('Administrator') : __('Member') }}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                    {{ __('Logout') }}
                </a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">

            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="13" r="2"></circle> <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line> <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('pages', 'create-page', 'page-translations', 'create-page-translations', 'edit-page-translations', 'posts', 'authentication', 'tools', 'categories') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('pages', 'create-page', 'page-translations', 'create-page-translations', 'edit-page-translations', 'posts', 'authentication', 'tools', 'categories') ? 'show' : '' }}" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="pages">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Pages') }}</span>
                    </a>

                    <div id="pages" class="multi-collapse collapse {{ Route::is('pages', 'create-page', 'page-translations', 'create-page-translations', 'edit-page-translations', 'posts', 'authentication', 'tools', 'categories') ? 'show' : '' }}">
                        <a class="nav-link {{ Route::is('authentication') ? 'active' : '' }}" href="{{ route('authentication') }}">
                            {{ __('Authentication') }}
                        </a>

                        <a class="nav-link {{ Route::is('posts') ? 'active' : '' }}" href="{{ route('posts') }}">
                            {{ __('Blog Posts') }}
                        </a>

                        <a class="nav-link {{ Route::is('tools') ? 'active' : '' }}" href="{{ route('tools') }}">
                            {{ __('Tools') }}
                        </a>

                        <a class="nav-link {{ Route::is('categories') ? 'active' : '' }}" href="{{ route('categories') }}">
                            {{ __('Categories') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'proxy', 'captcha', 'sidebar', 'gdpr', 'advertisement', 'smtp', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'proxy', 'captcha', 'sidebar', 'gdpr', 'advertisement', 'smtp', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'show' : '' }}" data-bs-toggle="collapse" href="#theme-settings" role="button" aria-expanded="false" aria-controls="theme-settings">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Settings') }}</span>
                    </a>

                    <div id="theme-settings" class="multi-collapse collapse {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'proxy', 'captcha', 'sidebar', 'gdpr', 'advertisement', 'smtp', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'show' : '' }}">
                        <a class="nav-link {{ Route::is('general') ? 'active' : '' }}" href="{{ route('general') }}">
                            {{ __('General') }}
                        </a>
                                        
                        <a class="nav-link {{ Route::is('header') ? 'active' : '' }}" href="{{ route('header') }}">
                            {{ __('Header') }}
                        </a>
                    
                        <a class="nav-link {{ Route::is('footer', 'create-footer-translations', 'edit-footer-translations') ? 'active' : '' }}" href="{{ route('footer') }}">
                            {{ __('Footer') }}
                        </a>

                        <a class="nav-link {{ Route::is('menu') ? 'active' : '' }}" href="{{ route('menu') }}">
                            {{ __('Menu') }}
                        </a>
                        
                        <a class="nav-link {{ Route::is('sidebar') ? 'active' : '' }}" href="{{ route('sidebar') }}">
                            {{ __('Sidebar') }}
                        </a>

                        <a class="nav-link {{ Route::is('gdpr') ? 'active' : '' }}" href="{{ route('gdpr') }}">
                            {{ __('GDPR') }}
                        </a>

                        <a class="nav-link {{ Route::is('advertisement') ? 'active' : '' }}" href="{{ route('advertisement') }}">
                            {{ __('Advertisement') }}
                        </a>
                    
                        <a class="nav-link {{ Route::is('smtp') ? 'active' : '' }}" href="{{ route('smtp') }}">
                            {{ __('SMTP') }}
                        </a>

                        <a class="nav-link {{ Route::is('api-keys') ? 'active' : '' }}" href="{{ route('api-keys') }}">
                            {{ __('API Keys') }}
                        </a>

                        <a class="nav-link {{ Route::is('proxy') ? 'active' : '' }}" href="{{ route('proxy') }}">
                            {{ __('Proxy') }}
                        </a>

                        <a class="nav-link {{ Route::is('captcha') ? 'active' : '' }}" href="{{ route('captcha') }}">
                            {{ __('Captcha') }}
                        </a>

                            
                        <a class="nav-link {{ ( Route::is('redirects') ) ? 'active' : '' }}" href="{{ route('redirects') }}">
                            {{ __('Redirects') }}
                        </a>
                    
                        <a class="nav-link {{ ( Route::is('translations') || Route::is('edit-translations') ) ? 'active' : '' }}" href="{{ route('translations') }}">
                            {{ __('Translations') }}
                        </a>
                    
                        <a class="nav-link {{ ( Route::is('advanced') ) ? 'active' : '' }}" href="{{ route('advanced') }}">
                            {{ __('Advanced') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item {{ Route::is('users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="9" cy="7" r="4"></circle> <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path> <path d="M16 3.13a4 4 0 0 1 0 7.75"></path> <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Users') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('history') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('history') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <polyline points="12 8 12 12 14 14"></polyline> <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Recent History') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('report') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('report') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Report') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('cache') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cache') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="4" width="18" height="4" rx="2" /><path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" /><line x1="10" y1="12" x2="14" y2="12" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Cache') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('About') }}</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>
</aside>
