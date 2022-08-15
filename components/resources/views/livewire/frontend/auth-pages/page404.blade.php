<div>
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center">
              <div class="empty-img">
                <img src="{{ asset('assets/img/404.svg') }}" height="128">
              </div>
                <p class="empty-title">{{ __('Oops… You just found an error page') }}</p>
                <p class="empty-subtitle text-muted">{{ __('We are sorry but the page you are looking for was not found!') }}</p>
                <div class="empty-action">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <line x1="5" y1="12" x2="11" y2="18"></line>
                            <line x1="5" y1="12" x2="11" y2="6"></line>
                        </svg>
                        {{ __('Go to Homepage') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
