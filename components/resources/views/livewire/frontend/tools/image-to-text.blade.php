<div>
      <form wire:submit.prevent="onImageToText">

        <div class="image-container">

            <div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            
            <div class="image-wrapper {{ ($convertType == 'remoteURL') ? 'show-remote-box' : '' }}">

                <div class="local-image-box dropzone d-flex flex-column p-3">
                    <div class="d-flex mt-auto mx-auto w-75">
                      <div class="row w-100">
                          <div class="col">
                            <div class="form-group">
                              <input type="file" class="form-control" wire:model="local_image">
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-flex mt-auto flex-end">
                        <small class="ms-auto badge bg-cyan-lt cursor-pointer" wire:click="onConvertType('remoteURL')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                            {{ __('Use Remote URL') }}
                        </small>
                    </div>
                </div>

                <div class="remote-box d-flex flex-column">
                      <div class="d-flex mt-auto mx-auto w-75">
                        <div class="row w-100">
                            <div class="col">
                                <div class="input-group input-group-flat">
                                    <input type="text" id="remote_url" class="form-control" wire:model="remote_url" placeholder="https://..." />
                                    <span class="input-group-text bg-white">
                                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="d-flex mt-auto flex-end">
                          <small class="ms-auto badge bg-cyan-lt cursor-pointer" wire:click="onConvertType('localImage')">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="19" x2="21" y2="19" /><rect x="5" y="6" width="14" height="10" rx="1" /></svg>
                              {{ __('Upload from device') }}
                          </small>
                      </div>
                </div>

            </div>
        </div>

          <div class="form-group my-3">
              <button class="btn btn-info mx-auto d-block">
                <span>
                  <div wire:loading.inline wire:target="onImageToText">
                    <x-loading />
                  </div>
                  <span wire:target="onImageToText">{{ __('Convert') }}</span>
                </span>
              </button>
          </div>

        @if ( !empty($data) )
            <fieldset class="form-fieldset">
                <div class="form-group mb-3">
                  <label class="form-label">{{ __('The text found on your image is') }}</label>
                  <textarea id="text" class="form-control" rows="10">
@foreach ($data as $value)
{{ $value }}
@endforeach</textarea>
                </div>

                <div class="form-group">
                    <a class="btn btn-lime" value="copy" onclick="copyToClipboard()">{{ __('Copy to Clipboard') }}</a>
                </div>
            </fieldset>
        @endif

      </form>
</div>

<script>

(function( $ ) {
  "use strict";

    document.addEventListener('livewire:load', function () {

		var el = document.getElementById('paste');

		if(el){

			el.addEventListener('click', function(paste) {

				paste = document.getElementById('paste');

				'<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>' === paste.innerHTML ? (remote_url.value = "", paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>') : navigator.clipboard.readText().then(function(clipText) {

					@this.set('remote_url', clipText);

				}, paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>');

			});
		}
		
        jQuery('input#remote_url').change(function() { 
          window.livewire.emit('onSetRemoteURL', this.value)
        });

    });

})( jQuery );
</script>