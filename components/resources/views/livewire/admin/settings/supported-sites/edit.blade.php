<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="onEditSite({{ $site_id }})">
        <div class="form-group">
            <label for="title" class="form-label">{{ __('Title') }}</label>
            <input class="form-control" type="text" id="title" wire:model="title">
        </div>

        <div class="form-group">
            <label for="site-source" class="form-label">{{ __('Source') }}</label>
            <div class="input-group">
                @php

                    $sources = json_decode($sources, true);

                @endphp
                <select wire:model="source" class="form-control">
                    <option value selected style="display:none;">{{ __('Choose a source...') }}</option>
                    @foreach ($sources as $source)
                        <option value="{{ __( $source ) }}">{{ __( $source ) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="url" class="form-label">{{ __('Link') }}</label>
            <select class="form-control" wire:model="link">
                <option value selected style="display:none;">{{ __('Choose a page...') }}</option>
                @if ( !empty($pages) )
                    @foreach ($pages as $page)
                        <option value="{{ $page['slug'] }}">{{ __( $page['slug'] ) }}</option>
                    @endforeach
                @endif
                
            </select>
        </div>
        
        <div class="form-group">
            <label for="site-image" class="form-label">{{ __('Image') }}</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="site-image" data-input="thumbnail" class="btn btn-primary mb-0 site-image">
                        <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                    </a>
                </span>
                <input id="thumbnail" class="form-control ps-2" type="text" wire:model="image">
            </div>
        </div>

        <div class="form-group">
            <label for="site-status" class="form-label">{{ __('Status') }}</label>
            <div class="input-group">
                <select wire:model="status" class="form-control">
                    <option value="1">{{ __('Enabled') }}</option>
                    <option value="0">{{ __('Disabled') }}</option>
                </select>
            </div>
        </div>
        
        <div class="float-end mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary">
                <span>
                    <div wire:loading wire:target="onEditSite({{ $site_id }})">
                        <x-loading />
                    </div>
                    <span>{{ __('Save changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>

<script>
(function( $ ) {
    "use strict";

    document.addEventListener('livewire:load', function () {

        jQuery('.site-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

        jQuery('input#thumbnail_edit').change(function() { 
            window.livewire.emit('onSetSiteImage', this.value)
        });

    });
    
})( jQuery );
</script>