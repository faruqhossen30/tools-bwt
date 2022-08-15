<div class="collapse navbar-collapse mt-2" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
    <ul class="navbar-nav justify-content-end">

        <div class="nav-item me-2">
            <button class="btn bg-white btn-icon btn-toggle-dir" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dir Mode (LTR / RTL)">
                @if ( Cookie::get('dir_mode') == 'rtl' )
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M16 4h-6.5a3.5 3.5 0 0 0 0 7h.5"></path> <path d="M14 15v-11"></path> <path d="M10 15v-11"></path> <path d="M5 19h14"></path> <path d="M7 21l-2 -2l2 -2"></path> </svg>
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 19h14"></path> <path d="M17 21l2 -2l-2 -2"></path> <path d="M16 4h-6.5a3.5 3.5 0 0 0 0 7h.5"></path> <path d="M14 15v-11"></path> <path d="M10 15v-11"></path> </svg>
                @endif
            </button>
        </div>

        <div class="nav-item me-2">
            <button class="btn bg-white btn-icon btn-toggle-mode" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Theme Mode (Light / Dark)">
                @if ( Cookie::get('theme_mode') == 'theme-light' )
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="4"></circle><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path></svg>
                @endif
            </button>
        </div>

        <!-- Begin:Lang Menu -->
        @php
            $mobileLangMenu = '';
        @endphp

        <li class="nav-item dropdown d-flex align-items-center">
            <a href="javascript:;" class="nav-link dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                 <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" class="lang-menu me-1 my-auto">
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                    <li class="mb-2">
                      <a class="dropdown-item mb-1" rel="alternate" hreflang="{{ $localeCode }}" href="{{ localization()->getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                      </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <!-- End:Lang Menu -->

        <div class="nav-item dropdown d-none d-md-flex me-3">
            <a class="nav-link px-0 cursor-pointer" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path> <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path> </svg>
                <span class="badge bg-red"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-arrow">
                <div class="card">
                    <div class="card-body">
                        {{ __('Script version') }}: <span class="badge bg-success">{{ env('APP_VERSION') }}</span>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <li class="nav-item dropdown">
            <a href="javascript:;" class="nav-link" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                <li>
                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                        {{ __('Profile') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
