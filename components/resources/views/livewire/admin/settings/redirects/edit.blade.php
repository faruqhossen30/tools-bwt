<div>

    <form wire:submit.prevent="onEditRedirect({{ $redirect_id }})">
        <div class="modal-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
            <div class="form-group mb-3">
                <label for="old_slug" class="form-label">{{ __('Old Slug') }}</label>
                <input class="form-control" type="text" id="old_slug" wire:model="old_slug">
            </div>

            <div class="form-group">
                <label for="new_slug" class="form-label">{{ __('New Slug or URL') }}</label>
                <input class="form-control" type="text" id="new_slug" wire:model="new_slug">
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary">
                <span>
                    <div wire:loading wire:target="onEditRedirect{{ $redirect_id }}">
                        <x-loading />
                    </div>
                    <span>{{ __('Save changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
