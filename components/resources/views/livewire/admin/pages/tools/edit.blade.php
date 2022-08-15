<div>
    
    <form wire:submit.prevent="onEditPage({{ $this->page_id }})">
        <div class="modal-body">
            
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="form-group mb-3">
                <label for="edit_slug" class="form-label">{{ __('Slug') }}</label>
                <div class="input-group">
                    <input class="form-control @error('slug') is-invalid @enderror" type="text" wire:model="slug" id="edit_slug" required>
                    <button type="button" class="btn btn-info" wire:click="createSlug">{{ __('Create slug') }}</button>
                </div>
                <small class="form-hint">{{ __('Generate SEO-Friendly URL Slug.') }}</small>
            </div>

            <div class="form-group mb-3">
                <label for="tool" class="form-label">{{ __('Tools') }}</label>
                <div class="input-group">
                    @php

                        $tools = json_decode($tools, true);

                    @endphp
                    <select wire:model="tool_name" class="form-control">
                        <option value selected style="display:none;">{{ __('Choose a tool...') }}</option>
                        @foreach ($tools as $tool)
                            <option value="{{ __( $tool ) }}">{{ __( $tool ) }}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-hint">{{ __('Select the tool you want to add.') }}</small>
            </div>

            <div class="form-group mb-3">
                <label for="tool" class="form-label">{{ __('Categories') }}</label>
                <div class="input-group">
                    <select wire:model="category_id" class="form-control">
                        <option value selected style="display:none;">{{ __('Choose a category...') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ __( $category['id'] ) }}">{{ __( $category['title'] ) }}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-hint">{{ __('Select the category you want to show.') }}</small>
            </div>
            
            <div class="form-group mb-3">
                <label for="edit_icon_image" class="form-label">{{ __('Icon image') }}</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="edit_icon_image" data-input="icon_edit" class="btn btn-success featured-image">
                            <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                        </a>
                    </span>
                    <input id="icon_edit" class="form-control ps-2" type="text" wire:model="icon_image">
                </div>
                <small class="form-hint">{{ __('This icon will appear before the tool\'s name on the homepage.') }}</small>
            </div>

            <div class="form-group">
                <label for="edit_featured_image" class="form-label">{{ __('Featured image') }}</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="edit_featured_image" data-input="thumbnail_edit" class="btn btn-success featured-image">
                            <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                        </a>
                    </span>
                    <input id="thumbnail_edit" class="form-control ps-2" type="text" wire:model="featured_image">
                </div>
                <small class="form-hint">{{ __('This image will show up on search engines.') }}</small>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary">
                <span>
                    <div wire:loading wire:target="onEditPage({{ $this->page_id }})">
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

        jQuery('.featured-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

        jQuery('input#thumbnail_edit').change(function() { 
            window.livewire.emit('onSetFeaturedImage', this.value)
        });

        jQuery('input#icon_edit').change(function() { 
            window.livewire.emit('onSetIconImage', this.value)
        });

    });
    
})( jQuery );
</script>
