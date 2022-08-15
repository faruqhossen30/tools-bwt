<div>

      <form wire:submit.prevent="onHexToRgb">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="input-group input-group-flat mb-3">
            <input type="text" class="form-control" wire:model="hex_color" placeholder="{{ __('Paste your HEX color here...') }}" required>
            <span class="input-group-text bg-white">
                <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                </a>
            </span>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onHexToRgb">
                  <x-loading />
                </div>
                <span wire:target="onHexToRgb">{{ __('Convert') }}</span>
              </span>
            </button>

            <button class="btn btn-lime" wire:click.prevent="onSample" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onSample">
                  <x-loading />
                </div>
                <span wire:target="onSample">{{ __('Sample') }}</span>
              </span>
            </button>

            <button class="btn btn-warning" wire:click.prevent="onReset" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onReset">
                  <x-loading />
                </div>
                <span wire:target="onReset">{{ __('Reset') }}</span>
              </span>
            </button>
        </div>

            @if ( !empty($data) )
                <div class="form-group mb-3" wire:loading.remove wire:target="onHexToRgb">
                    <label class="form-label">{{ __('Red color (R):') }}</label>
                    <input type="text" class="form-control" wire:model="red_color" readonly>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Green color (G):') }}</label>
                    <input type="text" class="form-control" wire:model="green_color" readonly>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Blue color (B):') }}</label>
                    <input type="text" class="form-control" wire:model="blue_color" readonly>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('CSS color') }}:</label>
                    <input type="text" class="form-control" wire:model="css_color" readonly>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Color preview:') }}</label>
                    <textarea class="form-control preview" readonly></textarea>
                </div>
            @endif
        
      </form>
</div>

<script>
(function( $ ) {
  "use strict";

    document.addEventListener('livewire:load', function () {

        window.addEventListener('showPreview', event => {
            jQuery('.preview').css('background', event.detail.css_color);
        });

    });

})( jQuery );
</script>