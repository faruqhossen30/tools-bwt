  <div class="page">
    <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

    <main class="main">

        @if(Auth::user() && Auth::user()->email_verified_at == null)
            <div class="alert alert-important alert-warning alert-dismissible mb-0 text-center rounded-0" role="alert">
              {{ __('Your email address is not verified.') }} <a href="{{ route('verify-email') }}" class="alert-link text-decoration-underline">{{ __('Verify it here!') }}</a>
            </div>
        @endif

        @switch(true)

            @case( Route::is('login') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Login')->first()->status == true )
                        @livewire('frontend.auth-pages.login')
                    @else
                        @livewire('frontend.auth-pages.page404')
                    @endif
                @break

            @case( Route::is('register') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Register')->first()->status == true )
                        @livewire('frontend.auth-pages.register')
                    @else
                        @livewire('frontend.auth-pages.page404')
                    @endif
                @break

            @case( Route::is('forgot-password') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Forgot Password')->first()->status == true )
                        @livewire('frontend.auth-pages.forgot-password')
                    @else
                        @livewire('frontend.auth-pages.page404')
                    @endif
                @break

            @case( Route::is('reset-password') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Reset Password')->first()->status == true )
                        @livewire('frontend.auth-pages.reset-password', [
                                  'token' => request()->token,
                                  'email' => request()->email
                                ])
                    @else
                        @livewire('frontend.auth-pages.page404')
                    @endif
                @break

            @case( Route::is('verify-email') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status == true )
                        @livewire('frontend.auth-pages.verify-email')
                    @else
                        @livewire('frontend.auth-pages.page404')
                    @endif
                @break

            @case( Route::is('user-profile') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status == true )
                        @livewire('frontend.auth-pages.profile')
                    @else
                        @livewire('frontend.auth-pages.page404')
                    @endif
                @break

            @default
                @livewire('frontend.auth-pages.page404')
                
        @endswitch
        
    </main>

    <x-frontend.footer :footer="$footer" :general="$general" :socials="$socials" />

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>

    @if ( $captcha->status == true && !empty($captcha->site_key ) && !empty($captcha->secret_key ) )
      <script src="https://www.google.com/recaptcha/api.js?render={{ $captcha->site_key }}"></script>
    @endif

    @if (Cookie::get('cookies') == null)

      @if ( $notice->status == true )

            <div class="cookies-wrapper position-fixed {{ $notice->align }}">
                <div class="{{ $notice->background }} {{ ($notice->background != 'bg-white') ? 'text-white' : '' }} py-3 px-2 rounded shadow">
                    <div class="card-body">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cookie" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M8 13v.01"></path>
                               <path d="M12 17v.01"></path>
                               <path d="M12 12v.01"></path>
                               <path d="M16 14v.01"></path>
                               <path d="M11 8v.01"></path>
                               <path d="M13.148 3.476l2.667 1.104a4 4 0 0 0 4.656 6.14l.053 .132a3 3 0 0 1 0 2.296c-.497 .786 -.838 1.404 -1.024 1.852c-.189 .456 -.409 1.194 -.66 2.216a3 3 0 0 1 -1.624 1.623c-1.048 .263 -1.787 .483 -2.216 .661c-.475 .197 -1.092 .538 -1.852 1.024a3 3 0 0 1 -2.296 0c-.802 -.503 -1.419 -.844 -1.852 -1.024c-.471 -.195 -1.21 -.415 -2.216 -.66a3 3 0 0 1 -1.623 -1.624c-.265 -1.052 -.485 -1.79 -.661 -2.216c-.198 -.479 -.54 -1.096 -1.024 -1.852a3 3 0 0 1 0 -2.296c.48 -.744 .82 -1.361 1.024 -1.852c.171 -.413 .391 -1.152 .66 -2.216a3 3 0 0 1 1.624 -1.623c1.032 -.256 1.77 -.476 2.216 -.661c.458 -.19 1.075 -.531 1.852 -1.024a3 3 0 0 1 2.296 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2>{{ __('Cookies!') }}</h2>
                            <span class="text-start">{!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}</span>
                        </div>
                    </div>

                        @if ( $notice->button == true)
                            <div class="text-center">
                                <button id="acceptCookies" class="btn bg-white mb-0 text-capitalize"> {{ __('Accept all cookies') }} </button>
                            </div>
                         @endif
                    </div>

                </div>
            </div>

          <script>
             (function( $ ) {
                "use strict";
         
                    jQuery("#acceptCookies").click(function(){
                        jQuery.ajax({
                            type : 'get',
                            url : '{{ url('/') }}/cookies/accept',
                            success: function(e) {
                                jQuery('.cookies-wrapper').remove();
                            }
                        });
                    });

            })( jQuery );
          </script>
      @endif

    @endif

    @if ( $general->dir_mode == true )
      <script>
         (function( $ ) {
            "use strict";

                jQuery(".btn-toggle-dir").click(function(){
                    jQuery.ajax({
                        type : 'get',
                        url : '{{ url('/') }}/dir/mode',
                        success: function(e) {
                            window.location.reload();
                        }
                    });
                });

        })( jQuery );
      </script>
    @endif
        
    @if ( $general->theme_mode == true )
      <script>
         (function( $ ) {
            "use strict";

                jQuery(".btn-toggle-mode").click(function(){
                    jQuery.ajax({
                        type : 'get',
                        url : '{{ url('/') }}/theme/mode',
                        success: function(e) {
                            jQuery('body').toggleClass("theme-dark");
                        }
                    });
                });

        })( jQuery );
      </script>
    @endif

    @if ( $advanced->footer_status == true && $advanced->insert_footer != null )
      {!! $advanced->insert_footer !!}
    @endif

  </div>