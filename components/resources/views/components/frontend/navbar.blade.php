    <header class="navbar navbar-expand-md navbar-light d-print-none @if ($header->sticky_header) sticky-top @endif">
        <div class="container-xl">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3" title="{{ __($homeTitle) }}" href="{{ route('home') }}">
                @if ( !empty($header->logo_light) )

                    @if ( Cookie::get('theme_mode') === 'theme-dark' )
                        <img src="{{ $header->logo_dark }}" width="110" height="32" alt="{{ __($homeTitle) }}" class="navbar-brand-image">
                    @elseif( Cookie::get('theme_mode') === 'theme-light' )
                        <img src="{{ $header->logo_light }}" width="110" height="32" alt="{{ __($homeTitle) }}" class="navbar-brand-image">
                    @else
                        <img src="{{ $header->logo_light }}" width="110" height="32" alt="{{ __($homeTitle) }}" class="navbar-brand-image">
                    @endif
                    
                @else
                  {{ $homeTitle }}
                @endif
            </a>

            <div class="navbar-nav flex-row order-md-last">

                @if ( $general->dir_mode == true )
                    <div class="nav-item me-2">
                        <a class="btn btn-icon bg-white btn-toggle-dir" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Direction Mode (LTR / RTL)') }}">
                            @if ( Cookie::get('dir_mode') == 'rtl' )
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M16 4h-6.5a3.5 3.5 0 0 0 0 7h.5"></path> <path d="M14 15v-11"></path> <path d="M10 15v-11"></path> <path d="M5 19h14"></path> <path d="M7 21l-2 -2l2 -2"></path> </svg>
                            @else
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 19h14"></path> <path d="M17 21l2 -2l-2 -2"></path> <path d="M16 4h-6.5a3.5 3.5 0 0 0 0 7h.5"></path> <path d="M14 15v-11"></path> <path d="M10 15v-11"></path> </svg>
                            @endif
                        </a>
                    </div>
                @endif

                @if ( $general->theme_mode == true )
                    <div class="nav-item me-2">
                        <a class="btn btn-icon bg-white btn-toggle-mode" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Theme Mode (Light / Dark)') }}">
                            
                            @if ( Cookie::get('theme_mode') == 'theme-light' )
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="4"></circle><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path></svg>
                            @endif
                        
                        </a>
                    </div>
                @endif

                <!-- Begin::Navbar Right -->
                @foreach($menus as $key => $value)

                    @if ( $value['type'] == 'button' )

                      @if( count($value['children']) )
                            <li class="nav-item dropdown">
                                <a class="btn dropdown-toggle me-2 {{ $value['class'] }}" href="#navbarDropdownMenuButton{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                   @if ( !empty($value['icon']) )
                                     <i class="{{ $value['icon'] }} icon"></i>
                                   @endif
                                   {{ __($value['text']) }}
                                </a>

                                <x-frontend.menu :childs="$value['children']" />
                            </li>

                      @else

                        <li class="nav-item">
                            <a class="btn me-2 {{ $value['class'] }}" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} icon"></i>
                               @endif
                              {{ __($value['text']) }}
                            </a>
                        </li>

                      @endif

                  @endif

                @endforeach
                <!-- End::Navbar Right -->

                <!-- Begin::Login -->
                @if ( \App\Models\Admin\AuthPages::where('name', 'Login')->first()->status == true )
                
                    @if ( Auth::user() )

                        <div class="nav-item dropdown">
                            <a class="nav-link d-flex lh-1 text-reset p-0 cursor-pointer" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                                <span class="avatar avatar-sm" style="background-image: url(https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=150&d=mm&r=g);"></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ Auth::user()->fullname }}</div>
                                    <div class="mt-1 small text-muted">{{ ( Auth::user()->is_admin == 1) ? __('Administrator') : __('Member') }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @if ( Auth::user()->is_admin == 1 )
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="13" r="2"></circle> <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line> <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path> </svg>
                                        {{ __('Admin Dashboard') }}
                                    </a>
                                @endif

                                @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status == true )
                                    <a href="{{ route('user-profile') }}" class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                        {{ __('Profile') }}
                                    </a>
                                @endif
                                
                                <a href="{{ route('user-logout') }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </div>

                    @else
                        <div class="nav-item">
                            <a class="btn btn-success" href="{{ route('login')}}">
                                <i class="fas fa-user icon"></i>
                                {{ __('Login') }}
                            </a>
                        </div>
                    @endif

                @endif
                <!-- End::Login -->

            </div>

            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">

                        <!-- Begin::Navbar Left -->
                        @foreach($menus as $key => $value)

                            @if ( $value['type'] == 'link' )

                              @if( count($value['children']) )
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#navbarDropdownMenuLink{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                           @if ( !empty($value['icon']) )
                                             <i class="{{ $value['icon'] }} me-2"></i>
                                           @endif
                                           {{ __($value['text']) }}
                                        </a>

                                        <x-frontend.menu :childs="$value['children']" />
                                    </li>

                              @else

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                                       @if ( !empty($value['icon']) )
                                         <i class="{{ $value['icon'] }} me-2"></i>
                                       @endif
                                      {{ __($value['text']) }}
                                    </a>
                                </li>

                              @endif

                            @endif

                        @endforeach
                        <!-- End::Navbar Left -->

                        <!-- Begin:Lang Menu -->
                        @if ( $general->language_switcher == true )

                          @php
                            $mobileLangMenu = '';
                          @endphp

                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-label="Open language menu">
                                    <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" class="lang-menu me-1 my-auto"> 
                                    {{ localization()->getCurrentLocaleNative() }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                   @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                                      <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $properties->key() }}" href="{{ url('/') . '/' .  $properties->key() }}">
                                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                                      </a>
                                   @endforeach
                                </div>
                            </div>
                          
                        @endif
                        <!-- End:Lang Menu -->
                    </ul>

                </div>
            </div>

        </div>
    </header>