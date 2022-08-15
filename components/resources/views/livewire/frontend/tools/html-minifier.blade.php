<div>

      <form wire:submit.prevent="onHtmlMinifier">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
        <div class="form-group mb-3">
            <textarea class="form-control" wire:model="code" rows="10" placeholder="{{ __('Paste your code here...') }}" required></textarea>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-info">
              <span>
                <div wire:loading.inline wire:target="onHtmlMinifier">
                  <x-loading />
                </div>
                <span wire:target="onHtmlMinifier">{{ __('Minify') }}</span>
              </span>
            </button>
        </div>

        <div class="form-group mb-3">
            <textarea class="form-control" rows="10">{{ ($data) ? $data['code'] : '' }}</textarea>
        </div>    

      </form>
</div>