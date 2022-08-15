<div>
      <form wire:submit.prevent="onBase64ToImage">

          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <div class="form-group mb-3">
            <div class="form-label">{{ __('Base64 String') }}</div>
            <textarea class="form-control" rows="10" placeholder="{{ __('Paste your Base64 string') }}" wire:model="base64_string"></textarea>
          </div>

          <div class="form-group mb-3">
              <button class="btn btn-info mx-auto d-block">
                <span>
                  <div wire:loading.inline wire:target="onBase64ToImage">
                    <x-loading />
                  </div>
                  <span wire:target="onBase64ToImage">{{ __('Convert to Image') }}</span>
                </span>
              </button>
          </div>

      </form>

      @if ( !empty($data) )  
          <div class="card">
                <div class="card-body">
                    <div class="cursor-pointer mb-3 text-center">
                        <a class="btn btn-success mw-50 download-image" href="{{ $data['url'] }}" download="{{ $data['fileName'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg>
                            {{ __('Download Image') }}
                        </a>
                    </div>

                    <p><img class="preview-download-image img-fluid w-100" src="{{ $data['url'] }}"></p>
                    <p>{{ __('Note: This is a preview only. Click the "Download Image" button for the final image.') }}</p>
              </div>
          </div>
      @endif

</div>