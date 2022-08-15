<div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
        <div class="form-group mb-3">
            <textarea class="form-control" wire:model="text" rows="10" placeholder="{{ __('Paste your text here...') }}" required></textarea>
        </div>

        <div class="form-group mb-3">

            <button class="btn btn-info" wire:click.prevent="onSentenceCase">
              <span>
                <div wire:loading.inline wire:target="onSentenceCase">
                  <x-loading />
                </div>
                <span wire:target="onSentenceCase">{{ __('Sentence case') }}</span>
              </span>
            </button>

            <button class="btn btn-info" wire:click.prevent="onLowerCase">
              <span>
                <div wire:loading.inline wire:target="onLowerCase">
                  <x-loading />
                </div>
                <span wire:target="onLowerCase">{{ __('lower case') }}</span>
              </span>
            </button>

            <button class="btn btn-info" wire:click.prevent="onUpperCase">
              <span>
                <div wire:loading.inline wire:target="onUpperCase">
                  <x-loading />
                </div>
                <span wire:target="onUpperCase">{{ __('UPPER CASE') }}</span>
              </span>
            </button>

            <button class="btn btn-info" wire:click.prevent="onCapitalizedCase">
              <span>
                <div wire:loading.inline wire:target="onCapitalizedCase">
                  <x-loading />
                </div>
                <span wire:target="onCapitalizedCase">{{ __('Capitalized Case') }}</span>
              </span>
            </button>

        </div>

        @if ( !empty($data) )
          <div class="form-group position-relative mb-3">
              <textarea id="text" class="form-control" rows="10">{{ $data['text'] }}</textarea>
              <a value="copy" onclick="copyToClipboard()" class="btn btn-icon cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
              </a>
          </div>
        @endif

</div>
