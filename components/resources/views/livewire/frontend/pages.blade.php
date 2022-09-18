  <div class="page">
    <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

    <main class="main">

        @if(Auth::user() && Auth::user()->email_verified_at == null)
            <div class="alert alert-important alert-warning alert-dismissible mb-0 text-center rounded-0" role="alert">
              {{ __('Your email address is not verified.') }} <a href="{{ route('verify-email') }}" class="alert-link text-decoration-underline">{{ __('Verify it here!') }}</a>
            </div>
        @endif

        @if ( $general->parallax_status == true )
            <section id="parallax" class="text-white">
                <div class="position-relative overflow-hidden text-center bg-light">
                  <span class="mask" style="
                        @if ( $general->overlay_type == 'solid' )

                        background: {{ $general->solid_color }};opacity: {{ $general->opacity }};

                        @elseif( $general->overlay_type == 'gradient' )

                        background: {{ $general->gradient_first_color }};
                        background: -moz-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }}  );
                        background: -webkit-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                        background: linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                        opacity: {{ $general->opacity }};

                        @endif

                  "></span>

                  @if ( !empty($general->parallax_image) )
                    <div class="position-absolute start-0 top-0 w-100 parallax-image" style="background-image: url({{ $general->parallax_image }});filter: blur({{ $general->blur }}px);"></div>
                  @else
                    <div class="position-absolute start-0 top-0 w-100 parallax-image" style="background-image: url({{ asset('assets/img/parallax.jpg') }});filter: blur({{ $general->blur }}px);"></div>
                  @endif
                    {{-- This is Page title content --}}
                  {{-- <div class="container position-relative zindex-1">
                      <div class="col text-center p-lg-5 mx-auto my-5">

                          @if ( $page->ads_status == true && $advertisement->area1_status == true && $advertisement->area1 != null )
                            <x-frontend.advertisement.area1 :advertisement="$advertisement" />
                          @endif

                          <h1 class="display-5 font-weight-normal">{{ __($pageTrans->title) }}</h1>
                          <h2 class="font-weight-normal">{{ __($pageTrans->subtitle) }}</h2>

                          @if ( $page->ads_status == true && $advertisement->area2_status == true && $advertisement->area2 != null )
                            <x-frontend.advertisement.area2 :advertisement="$advertisement" />
                          @endif
                      </div>
                  </div> --}}

                </div>
            </section>
        @endif

        <section>
            <div class="container py-4">
                <div class="row">
                    <div class="{{ ( $page->ads_status == true && ( ( $advertisement->sidebar_top_status == true && $advertisement->sidebar_top != null ) || ( $advertisement->sidebar_middle_status == true && $advertisement->sidebar_middle != null ) || ( $advertisement->sidebar_bottom_status == true && $advertisement->sidebar_bottom != null ) ) || $sidebar->tool_status == true || $sidebar->post_status == true ) ? 'col-lg-9' : 'col' }}">
                        @if ( $page->ads_status == true && $advertisement->area3_status == true && $advertisement->area3 != null )
                          <x-frontend.advertisement.area3 :advertisement="$advertisement" />
                        @endif

                        @if ( $page->type == 'home' )

                          @if ( $general->search_box_status == true )
                            <section id="search-box" class="mb-3">
                              <div class="input-icon">
                                  <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg>
                                  </span>
                                  <input type="text" class="form-control search-input" wire:model="searchQuery" placeholder="{{ __('Search for your tool') }}" />
                              </div>

                              @if ( !empty($search_queries) && !empty($searchQuery) )
                                <div class="card mb-3 overflow-auto" style="max-height: 18rem">
                                  <div class="card-body pb-0">
                                    <div class="row">
                                        @foreach ($search_queries as $key => $value)
                                          <div class="col-12 col-md-6 col-lg-4 mb-3">
                                              <a class="card text-decoration-none cursor-pointer item-box" href="{{ localization()->localizeUrl( $value['slug'] ) }}">
                                                  <div class="card-body">
                                                      <div class="d-flex align-items-center">
                                                          <span class="avatar me-3 bg-transparent" style="background-image: url({{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }});"></span>
                                                          <div>
                                                              <div class="font-weight-medium">{{ $value['title'] }}</div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </a>
                                          </div>
                                        @endforeach
                                    </div>
                                  </div>
                                </div>
                              @endif

                            </section>
                          @endif

                          <section id="tools-box">
                                @if ( !empty($tool_with_categories) )

                                      @foreach ($tool_with_categories as $key => $value)
                                       <div class="card mb-3">
                                          <div class="d-block card-header category-box text-{{ $value['align'] }} {{ ($value['background'] == 'bg-white') ? $value['background'] : $value['background'] . ' text-white'}}">
                                            <h3 class="card-title">{{ __($value['title']) }}</h3>
                                            <span>{{ __($value['description']) }}</span>
                                          </div>
                                          <div class="card-body pb-0">
                                                <div class="row">
                                                    @foreach ($value['pages'] as $key2 => $value2)
                                                      <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                          <a class="card text-decoration-none cursor-pointer item-box" href="{{ localization()->localizeUrl( $value2['slug'] ) }}">
                                                              <div class="card-body">
                                                                  <div class="d-flex align-items-center">
                                                                      <span class="avatar me-3 bg-transparent" style="background-image: url({{ ($value2['icon_image']) ? $value2['icon_image'] : asset('assets/img/no-thumb.svg') }});"></span>
                                                                      <div>
                                                                          <div class="font-weight-medium">{{ $value2['title'] }}</div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </a>
                                                      </div>
                                                    @endforeach
                                                </div>
                                          </div>
                                        </div>
                                      @endforeach

                                @else

                                    <div class="row">
                                      @foreach ($tools as $key => $value)
                                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                                            <a class="card text-decoration-none cursor-pointer item-box" href="{{ localization()->getLocalizedURL(localization()->getCurrentLocale(), $value['slug'], [], true) }}">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar me-3 bg-transparent" style="background-image: url({{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }});"></span>
                                                        <div>
                                                            <div class="font-weight-medium">{{ $value['title'] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                      @endforeach
                                    </div>
                                @endif
                          </section>

                        @endif

                            <section id="content-box" class="mb-3 page-{{$page->id}}">

                                @if ( $page->type == 'tool')
                                  <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">{{$page->tool_name}}</h5>
                                    </div>
                                    <div class="card-body">

                                      @switch($page->tool_name)

                                          @case('Random Word Generator')
                                                @livewire('frontend.tools.random-word-generator')
                                              @break

                                          @case('Image To Text')
                                                @livewire('frontend.tools.image-to-text')
                                              @break

                                          @case('WebP to JPG')
                                                @livewire('frontend.tools.webp-to-jpg')
                                              @break

                                          @case('JPG Converter')
                                                @livewire('frontend.tools.jpg-converter')
                                              @break

                                          @case('PNG to JPG')
                                                @livewire('frontend.tools.png-to-jpg')
                                              @break

                                          @case('JPG to PNG')
                                                @livewire('frontend.tools.jpg-to-png')
                                              @break

                                          @case('RGB to HEX')
                                                @livewire('frontend.tools.rgb-to-hex')
                                              @break

                                          @case('HEX to RGB')
                                                @livewire('frontend.tools.hex-to-rgb')
                                              @break

                                          @case('Random Word Generator')
                                                @livewire('frontend.tools.random-word-generator')
                                              @break

                                          @case('Online Text Editor')
                                                @livewire('frontend.tools.online-text-editor')
                                              @break

                                          @case('Binary to Text')
                                                @livewire('frontend.tools.binary-to-text')
                                              @break

                                          @case('Text to Binary')
                                                @livewire('frontend.tools.text-to-binary')
                                              @break

                                          @case('SRT to VTT')
                                                @livewire('frontend.tools.srt-to-vtt')
                                              @break

                                          @case('VTT to SRT')
                                                @livewire('frontend.tools.vtt-to-srt')
                                              @break

                                          @case('YouTube Thumbnail Downloader')
                                                @livewire('frontend.tools.youtube-thumbnail-downloader')
                                              @break

                                          @case('Image Resizer')
                                                @livewire('frontend.tools.image-resizer')
                                              @break

                                          @case('Image Converter')
                                                @livewire('frontend.tools.image-converter')
                                              @break

                                          @case('Image Compressor')
                                                @livewire('frontend.tools.image-compressor')
                                              @break

                                          @case('Image Enlarger')
                                                @livewire('frontend.tools.image-enlarger')
                                              @break

                                          @case('Image Cropper')
                                                @livewire('frontend.tools.image-cropper')
                                              @break

                                          @case('Rotate Image')
                                                @livewire('frontend.tools.rotate-image')
                                              @break

                                          @case('Flip Image')
                                                @livewire('frontend.tools.flip-image')
                                              @break

                                          @case('Base64 to Image')
                                                @livewire('frontend.tools.base64-to-image')
                                              @break

                                          @case('Image to Base64')
                                                @livewire('frontend.tools.image-to-base64')
                                              @break

                                          @case('Find Facebook ID')
                                                @livewire('frontend.tools.find-facebook-id')
                                              @break

                                          @case('Remove Line Breaks')
                                                @livewire('frontend.tools.remove-line-breaks')
                                              @break

                                          @case('Word Counter')
                                                @livewire('frontend.tools.word-counter')
                                              @break

                                          @case('Password Generator')
                                                @livewire('frontend.tools.password-generator')
                                              @break

                                          @case('Color Converter')
                                                @livewire('frontend.tools.color-converter')
                                              @break

                                          @case('ICO Converter')
                                                @livewire('frontend.tools.ico-converter')
                                              @break

                                          @case('ICO to PNG')
                                                @livewire('frontend.tools.ico-to-png')
                                              @break

                                          @case('Case Converter')
                                                @livewire('frontend.tools.case-converter')
                                              @break

                                          @case('Lorem Ipsum Generator')
                                                @livewire('frontend.tools.lorem-ipsum-generator')
                                              @break

                                          @case('QR Code Generator')
                                                @livewire('frontend.tools.qr-code-generator')
                                              @break

                                          @case('QR Code Decoder')
                                                @livewire('frontend.tools.qr-code-decoder')
                                              @break

                                          @case('Javascript Obfuscator')
                                                @livewire('frontend.tools.javascript-obfuscator')
                                              @break

                                          @case('Javascript DeObfuscator')
                                                @livewire('frontend.tools.javascript-de-obfuscator')
                                              @break

                                          @case('Base64 Encode')
                                                @livewire('frontend.tools.base64-encode')
                                              @break

                                          @case('Base64 Decode')
                                                @livewire('frontend.tools.base64-decode')
                                              @break

                                          @case('HTML Encode')
                                                @livewire('frontend.tools.html-encode')
                                              @break

                                          @case('HTML Decode')
                                                @livewire('frontend.tools.html-decode')
                                              @break

                                          @case('URL Encode')
                                                @livewire('frontend.tools.url-encode')
                                              @break

                                          @case('URL Decode')
                                                @livewire('frontend.tools.url-decode')
                                              @break

                                          @case('HTML Minifier')
                                                @livewire('frontend.tools.html-minifier')
                                              @break

                                          @case('HTML Beautifier')
                                                @livewire('frontend.tools.html-beautifier')
                                              @break

                                          @case('CSS Minifier')
                                                @livewire('frontend.tools.css-minifier')
                                              @break

                                          @case('CSS Beautifier')
                                                @livewire('frontend.tools.css-beautifier')
                                              @break

                                          @case('JavaScript Minifier')
                                                @livewire('frontend.tools.javascript-minifier')
                                              @break

                                          @case('JavaScript Beautifier')
                                                @livewire('frontend.tools.javascript-beautifier')
                                              @break

                                          @case('Text to Slug')
                                                @livewire('frontend.tools.text-to-slug')
                                              @break

                                          @case('MD5 Generator')
                                                @livewire('frontend.tools.md5-generator')
                                              @break

                                          @case('What Is My IP')
                                                @livewire('frontend.tools.what-is-my-ip')
                                              @break

                                          @case('IP Address Lookup')
                                                @livewire('frontend.tools.ip-address-lookup')
                                              @break

                                          @default
                                      @endswitch

                                    </div>
                                  </div>
                                @endif

                                <div class="card">
                                    @if ( $general->parallax_status == false )
                                        <div class="card-header d-block">
                                              <h1 class="page-title">{{ __($pageTrans->title) }}</h1>
                                              <p class="mb-0">{{ __($pageTrans->subtitle) }}</p>
                                        </div>
                                    @endif

                                    <div class="card-body pb-0">
                                        @if ( Auth::user() )
                                          <div class="d-flex justify-content-center mb-3">
                                            <a href="{{ localization()->getLocalizedURL($pageTrans->locale, route('edit-page-translations', $pageTrans->translations[0]['id']), [], true) }}" class="btn btn-primary">{{ __('Edit Page') }}</a>
                                          </div>
                                        @endif

                                        @if ( $page->ads_status == true && $advertisement->area4_status == true && $advertisement->area4 != null )
                                          <x-frontend.advertisement.area4 :advertisement="$advertisement" />
                                        @endif

                                        {!! $pageTrans->description !!}

                                        @if ( $page->ads_status == true && $advertisement->area5_status == true && $advertisement->area5 != null )
                                          <x-frontend.advertisement.area5 :advertisement="$advertisement" />
                                        @endif

                                        @switch( $page->type )

                                            @case('report')
                                                  @livewire('frontend.report')
                                                @break

                                            @case('contact')
                                                  @livewire('frontend.contact')
                                                @break

                                            @default
                                        @endswitch

                                      @if ( $general->share_icons_status == true )
                                        <div class="social-share text-center">
                                          <div class="is-divider"></div>
                                          <div class="share-icons relative">

                                              <a wire:ignore href="https://www.facebook.com/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','facebook','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  data-label="Facebook"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-facebook btn-simple rounded p-2">
                                                  <i class="fab fa-facebook"></i>
                                              </a>

                                              <a wire:ignore href="https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','twitter','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-twitter btn-simple rounded p-2">
                                                  <i class="fab fa-twitter"></i>
                                              </a>

                                              <a wire:ignore href="https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                                  onclick="window.open('https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}','pinterest','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-pinterest btn-simple rounded p-2">
                                                  <i class="fab fa-pinterest"></i>
                                              </a>

                                              <a wire:ignore href="https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','linkedin','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-linkedin btn-simple rounded p-2">
                                                  <i class="fab fa-linkedin"></i>
                                              </a>

                                              <a wire:ignore href="https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                                  onclick="window.open('https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}','reddit','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  rel="noopener noreferrer nofollow"
                                                  target="_blank"
                                                  class="btn btn-reddit btn-simple rounded p-2">
                                                  <i class="fab fa-reddit"></i>
                                              </a>

                                              <a wire:ignore href="https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                                  onclick="window.open('https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','tumblr','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                  target="_blank"
                                                  class="btn btn-tumblr btn-simple rounded p-2"
                                                  rel="noopener noreferrer nofollow">
                                                  <i class="fab fa-tumblr"></i>
                                              </a>

                                          </div>
                                        </div>
                                      @endif

                                      @if ( $general->author_box_status == true )

                                        <hr class="horizontal dark">
                                        <div class="my-3">
                                          <div class="row">

                                            <div class="col-lg-2">
                                                <div class="position-relative mb-3">
                                                  <div class="blur-shadow-image">
                                                    <img class="w-100 rounded-3 shadow-sm" src="{{ $profile->avatar }}">
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-10 ps-0">
                                              <div class="card-body text-start py-0">

                                                <div class="p-md-0 pt-3">
                                                  <h5 class="font-weight-bolder mb-0">{{ $profile->fullname }}</h5>
                                                  <p class="text-uppercase text-sm font-weight-bold mb-2">{{ $profile->position }}</p>
                                                </div>

                                                <p class="mb-3">{{ __($profile->bio) }}</p>

                                                @if ( ($profile->social_status == true) && !empty($profile->user_socials) )

                                                  @foreach ($profile->user_socials as $element)

                                                    <a class="btn btn-{{ $element->name }} btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $element->url }}" target="blank">
                                                      <i class="fab fa-{{ $element->name }} fa-lg" aria-hidden="true"></i>
                                                    </a>

                                                  @endforeach

                                                @endif

                                              </div>
                                            </div>

                                          </div>
                                        </div>

                                      @endif

                                    </div>
                                </div>
                            </section>
                    </div>

                    @if ( $page->ads_status == true && ( ( $advertisement->sidebar_top_status == true && $advertisement->sidebar_top != null ) || ( $advertisement->sidebar_middle_status == true && $advertisement->sidebar_middle != null ) || ( $advertisement->sidebar_bottom_status == true && $advertisement->sidebar_bottom != null ) ) || $sidebar->tool_status == true || $sidebar->post_status == true)
                      <div class="col-lg-3 ml-auto">
                          <x-frontend.sidebar :page="$page" :advertisement="$advertisement" :sidebar="$sidebar" :recentPosts="$recent_posts" :popularTools="$popular_tools" />
                      </div>
                    @endif

                </div>
            </div>

        </section>
    </main>

    <x-frontend.footer :footer="$footer" :general="$general" :socials="$socials" />

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>

    @if ( $captcha->status == true && !empty($captcha->site_key ) && !empty($captcha->secret_key ) )
      <script src="https://www.google.com/recaptcha/api.js?render={{ $captcha->site_key }}"></script>
    @endif

    @if ( $general->adblock_detection == true )

      <!-- Sweetalert2 -->
      <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

      <script src="{{ asset('assets/js/prebid-ads.js') }}"></script>

      <script>
      (function( $ ) {
        "use strict";

              if( window.canRunAds === undefined ){
                  Swal.fire({
                    title: "{{ __('You\'re blocking ads') }}",
                    text: "{{ __('Our website is made possible by displaying online ads to our visitors. Please consider supporting us by disabling your ad blocker.') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "{{ __('I have disabled Adblock') }}",
                    cancelButtonText: "{{ __('No, thanks!') }}"
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.reload();
                    }
                  });
              }

      })( jQuery );
      </script>

    @endif

    @if (Cookie::get('cookies') == null)

      @if ( $notice->status == true )

            <div class="cookies-wrapper position-fixed {{ $notice->align }}">
                <div class="{{ $notice->background }} {{ ($notice->background != 'bg-white') ? 'text-white' : 'text-dark' }} py-3 px-2 rounded shadow">
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
                            window.location.reload();
                        }
                    });
                });

        })( jQuery );
      </script>
    @endif

    <script>
        function copyToClipboard() {
          document.getElementById("text").select();
          document.execCommand('copy');
        }
    </script>

    @if ( $advanced->footer_status == true && $advanced->insert_footer != null )
      {!! $advanced->insert_footer !!}
    @endif

  </div>
